<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model;

use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Kodano\Promotions\Api\Data\PromotionsRelationInterfaceFactory;
use Kodano\Promotions\Api\PromotionsManagerInterface;
use Kodano\Promotions\Api\Repository\PromotionsRelationRepositoryInterface;
use Kodano\Promotions\Logger\Promotions as PromotionsLogger;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\AlreadyExistsException;

class PromotionsManager implements PromotionsManagerInterface
{
    /**
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param PromotionsRelationRepositoryInterface $promotionsRelationRepository
     * @param PromotionsRelationInterfaceFactory $promotionsRelationFactory
     */
    public function __construct(
        private SearchCriteriaBuilder                 $searchCriteriaBuilder,
        private PromotionsRelationRepositoryInterface $promotionsRelationRepository,
        private PromotionsRelationInterfaceFactory    $promotionsRelationFactory,
        private PromotionsLogger                      $promotionsLogger
    )
    {
    }

    /** @inheritdoc */
    public function assignPromotionsToGroup(int $promotionsId, int $promotionsGroupId): bool
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter(PromotionsRelationInterface::PROMOTIONS_ID, $promotionsId)
            ->addFilter(PromotionsRelationInterface::GROUP_ID, $promotionsGroupId)
            ->create();

        $result = $this->promotionsRelationRepository->getList($searchCriteria);

        if ($result->getTotalCount() > 0) {
            throw new AlreadyExistsException(
                __(
                    sprintf('The promotion with ID %d is already assigned to the group with ID %d.',
                        $promotionsId,
                        $promotionsGroupId
                    )
                )
            );
        }

        /** @var PromotionsRelationInterface $relation */
        $relation = $this->promotionsRelationFactory->create();
        $relation->setPromotionsId($promotionsId);
        $relation->setGroupId($promotionsGroupId);

        $this->promotionsRelationRepository->save($relation);
        $this->promotionsLogger->logPromotionAssignment($relation);

        return true;
    }

    /** @inheritdoc */
    public function getPromotionsByGroupId(int $groupId): array
    {
        $this->searchCriteriaBuilder->addFilter(PromotionsRelationInterface::GROUP_ID, $groupId);
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $result = $this->promotionsRelationRepository->getList($searchCriteria)->getItems();

        return array_map(function ($relation) {
            return $relation->getPromotionName();
        }, $result);
    }

    /** @inheritdoc */
    public function getGroupsByPromotionsId(int $promotionsId): array
    {
        $this->searchCriteriaBuilder->addFilter(PromotionsRelationInterface::PROMOTIONS_ID, $promotionsId);
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $result = $this->promotionsRelationRepository->getList($searchCriteria)->getItems();

        return array_map(function ($relation) {
            return $relation->getGroupName();
        }, $result);
    }
}
