<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api;

interface PromotionsManagerInterface
{
    /**
     * @param int $promotionsId
     * @param int $promotionsGroupId
     *
     * @return bool
     */
    public function assignPromotionsToGroup(int $promotionsId, int $promotionsGroupId): bool;

    /**
     * @param int $groupId
     *
     * @return array
     */
    public function getPromotionsByGroupId(int $groupId): array;

    /**
     * @param int $promotionsId
     *
     * @return array
     */
    public function getGroupsByPromotionsId(int $promotionsId): array;
}
