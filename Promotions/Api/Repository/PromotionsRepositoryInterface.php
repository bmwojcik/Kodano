<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api\Repository;

use Kodano\Promotions\Api\Data\PromotionsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;

interface PromotionsRepositoryInterface
{
    /**
     * @param PromotionsInterface $promotions
     *
     * @return PromotionsInterface
     */
    public function save(PromotionsInterface $promotions): PromotionsInterface;

    /**
     * @param int $promotionsId
     *
     * @return PromotionsInterface
     */
    public function getById(int $promotionsId): PromotionsInterface;

    /**
     * @param PromotionsInterface $promotions
     *
     * @return bool
     */
    public function delete(PromotionsInterface $promotions): bool;

    /**
     * @param int $promotionsId
     * @return bool
     *
     * @throws CouldNotDeleteException|NoSuchEntityException
     */
    public function deleteById(int $promotionsId): bool;

    /**
     * @param SearchCriteriaInterface | null $searchCriteria
     *
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(?SearchCriteriaInterface $searchCriteria = null): \Magento\Framework\Api\SearchResultsInterface;
}
