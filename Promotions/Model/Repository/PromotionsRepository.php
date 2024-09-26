<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\Repository;

use Kodano\Promotions\Api\Repository\PromotionsRepositoryInterface;
use Kodano\Promotions\Model\ResourceModel\Promotions as PromotionsResource;
use Kodano\Promotions\Model\ResourceModel\Promotions\CollectionFactory as PromotionsCollectionFactory;
use Kodano\Promotions\Api\Data\PromotionsInterface;
use Kodano\Promotions\Api\Data\PromotionsInterfaceFactory as PromotionsFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsFactory;
use Magento\Framework\Api\SearchResultsInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\AbstractExtensibleModel;

class PromotionsRepository implements PromotionsRepositoryInterface
{
    /**
     * @param PromotionsResource $promotionsResource
     * @param PromotionsCollectionFactory $collectionFactory
     * @param PromotionsFactory $promotionsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsFactory $searchResultFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        private PromotionsResource           $promotionsResource,
        private PromotionsCollectionFactory  $collectionFactory,
        private PromotionsFactory           $promotionsFactory,
        private CollectionProcessorInterface $collectionProcessor,
        private SearchResultsFactory         $searchResultFactory,
        private SearchCriteriaBuilder        $searchCriteriaBuilder
    ) {
    }

    /** @inheritdoc */
    public function save(PromotionsInterface $promotions): PromotionsInterface
    {
        try {
            $this->promotionsResource->save($promotions);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $promotions;
    }

    /** @inheritdoc */
    public function getById(int $promotionsId): PromotionsInterface
    {
        $promotions = $this->collectionFactory->create()->getItemById($promotionsId);
        if (!$promotions) {
            throw new NoSuchEntityException(__(sprintf('Promotion with id %d does not exist.', $promotionsId)));
        }

        return $promotions;
    }

    /** @inheritdoc */
    public function delete(PromotionsInterface $promotions): bool
    {
        try {
            $this->promotionsResource->delete($promotions);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /** @inheritdoc */
    public function deleteById(int $promotionsId): bool
    {
        return $this->delete($this->getById($promotionsId));
    }

    /** @inheritdoc */
    public function getList(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var PromotionsCollectionFactory $collection */
        $collection = $this->collectionFactory->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        /** $items must be mapped to array otherwise records are not displayed as objects */
        $items = array_map(function ($record) {
            /** @var AbstractExtensibleModel $record $items */
            return $record->toArray();
        }, $collection->getItems());

        /** @var SearchResults $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($items);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
