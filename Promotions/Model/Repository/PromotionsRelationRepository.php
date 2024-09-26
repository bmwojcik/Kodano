<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\Repository;

use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Kodano\Promotions\Api\Repository\PromotionsRelationRepositoryInterface;
use Kodano\Promotions\Model\ResourceModel\PromotionsRelation as PromotionsRelationResoure;
use Kodano\Promotions\Model\ResourceModel\PromotionsRelation\CollectionFactory as PromotionsRelationCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchResults;
use Magento\Framework\Api\SearchResultsFactory;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractExtensibleModel;

class PromotionsRelationRepository implements PromotionsRelationRepositoryInterface
{
    /**
     * @param PromotionsRelationResoure $promotionsRelationResoure
     * @param PromotionsRelationCollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param SearchResultsFactory $searchResultFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        private PromotionsRelationResoure $promotionsRelationResoure,
        private PromotionsRelationCollectionFactory $collectionFactory,
        private CollectionProcessorInterface        $collectionProcessor,
        private SearchResultsFactory                $searchResultFactory,
        private SearchCriteriaBuilder               $searchCriteriaBuilder
    ) {
    }

    /** @inheritdoc */

    public function save(PromotionsRelationInterface $promotionsRelation): PromotionsRelationInterface
    {
        try {
            $this->promotionsRelationResoure->save($promotionsRelation);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $promotionsRelation;
    }

    /** @inheritdoc */
    public function getList(SearchCriteriaInterface $searchCriteria): \Magento\Framework\Api\SearchResultsInterface
    {
        /** @var PromotionsRelationCollectionFactory $collection */
        $collection = $this->collectionFactory->create();

        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }

        /** $items must be mapped to array otherwise records are not displayed as objects */
        $items = $collection->getItems();
        /** @var SearchResults $searchResult */
        $searchResult = $this->searchResultFactory->create();
        $searchResult->setItems($items);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
