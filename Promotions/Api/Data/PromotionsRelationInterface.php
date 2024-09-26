<?php

declare(strict_types=1);

namespace Kodano\Promotions\Api\Data;

interface PromotionsRelationInterface
{
    public const ENTITY_ID = 'entity_id';
    public const PROMOTIONS_ID = 'promotions_id';
    public const GROUP_ID = 'group_id';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    public const TABLE_NAME = 'kodano_promotions_group_relation';

    /**
     * @return int|null
     */
    public function getEntityId(): ?int;

    /**
     * @param int $entityId
     *
     * @return self
     */
    public function setEntityId(int $entityId): self;

    /**
     * @return int
     */
    public function getPromotionsId(): int;

    /**
     * @param int $promotionsId
     *
     * @return self
     */
    public function setPromotionsId(int $promotionsId): self;

    /**
     * @return int
     */
    public function getGroupId(): int;

    /**
     * @param int $groupId
     * @return self
     */
    public function setGroupId(int $groupId): self;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @param string $createdAt
     * @return self
     */
    public function setCreatedAt(string $createdAt): self;

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * @param string|null $updatedAt
     * @return self
     */
    public function setUpdatedAt(?string $updatedAt): self;
}
