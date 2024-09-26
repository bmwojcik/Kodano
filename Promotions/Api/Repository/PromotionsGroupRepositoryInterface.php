<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api\Repository;

use Kodano\Promotions\Api\Data\PromotionsGroupInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PromotionsGroupRepositoryInterface
{
    /**
     * @param PromotionsGroupInterface $promotionsGroup
     *
     * @return PromotionsGroupInterface
     */
    public function save(PromotionsGroupInterface $promotionsGroup): PromotionsGroupInterface;

    /**
     * @param int $promotionsGroupId
     *
     * @return PromotionsGroupInterface
     */
    public function getById(int $promotionsGroupId): PromotionsGroupInterface;

    /**
     * @param PromotionsGroupInterface $promotionsGroups
     *
     * @return bool
     */
    public function delete(PromotionsGroupInterface $promotionsGroups): bool;

    /**
     * @param int $promotionsGroupsId
     * @return bool
     *
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function deleteById(int $promotionsGroupsId): bool;

    /**
     * @param SearchCriteriaInterface | null $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(?SearchCriteriaInterface $searchCriteria = null): \Magento\Framework\Api\SearchResultsInterface;
}
