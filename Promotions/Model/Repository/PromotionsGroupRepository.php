<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\Repository;

use Kodano\Promotions\Api\Repository\PromotionsGroupRepositoryInterface;
use Kodano\Promotions\Model\ResourceModel\PromotionsGroup as PromotionsGroupResource;
use Kodano\Promotions\Model\ResourceModel\PromotionsGroup\CollectionFactory as PromotionsGroupCollectionFactory;
use Kodano\Promotions\Api\Data\PromotionsGroupInterface;
use Kodano\Promotions\Api\Data\PromotionsGroupInterfaceFactory as PromotionsGroupFactory;
use Kodano\Promotions\Api\Data\PromotionsGroupSearchResultsInterfaceFactory as PromotionsGroupSearchResultsFactory;
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

class PromotionsGroupRepository implements PromotionsGroupRepositoryInterface
{
    /**
     * @param PromotionsGroupResource $promotionsGroupResource
     * @param PromotionsGroupCollectionFactory $collectionFactory
     * @param PromotionsGroupFactory $promotionsGroupFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsFactory $searchResultFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        private PromotionsGroupResource             $promotionsGroupResource,
        private PromotionsGroupCollectionFactory    $collectionFactory,
        private PromotionsGroupFactory              $promotionsGroupFactory,
        private CollectionProcessorInterface        $collectionProcessor,
        private SearchResultsFactory                $searchResultFactory,
        private SearchCriteriaBuilder               $searchCriteriaBuilder
    ) {
    }

    /** @inheritdoc */
    public function save(PromotionsGroupInterface $promotionsGroup): PromotionsGroupInterface
    {
        try {
            $this->promotionsGroupResource->save($promotionsGroup);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $promotionsGroup;
    }

    /** @inheritdoc */
    public function getById(int $promotionsGroupId): PromotionsGroupInterface
    {
        $promotionsGroup = $this->collectionFactory->create()->getItemById($promotionsGroupId);
        if (!$promotionsGroup) {
            throw new NoSuchEntityException(__(sprintf('Promotion Group with id %d does not exist.', $promotionsGroupId)));
        }

        return $promotionsGroup;
    }

    /** @inheritdoc */
    public function delete(PromotionsGroupInterface $promotionsGroups): bool
    {
        try {
            $this->promotionsGroupResource->delete($promotionsGroups);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }

    /** @inheritdoc */
    public function deleteById(int $promotionsGroupsId): bool
    {
        return $this->delete($this->getById($promotionsGroupsId));
    }

    /** @inheritdoc */
    public function getList(?SearchCriteriaInterface $searchCriteria = null): SearchResultsInterface
    {
        /** @var PromotionsGroupCollectionFactory $collection */
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
