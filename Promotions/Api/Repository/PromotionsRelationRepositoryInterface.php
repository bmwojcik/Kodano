<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api\Repository;

use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface PromotionsRelationRepositoryInterface
{
    public function save(PromotionsRelationInterface $promotionsRelation): PromotionsRelationInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): \Magento\Framework\Api\SearchResultsInterface;
}
