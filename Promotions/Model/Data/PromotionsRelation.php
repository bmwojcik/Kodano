<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\Data;

use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Magento\Framework\Model\AbstractModel;

class PromotionsRelation extends AbstractModel implements PromotionsRelationInterface
{
    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(\Kodano\Promotions\Model\ResourceModel\PromotionsRelation::class);
    }

    /** @inheritdoc */
    public function getEntityId(): ?int
    {
        return $this->getData(self::ENTITY_ID);
    }

    /** @inheritdoc */
    public function setEntityId($entityId): PromotionsRelationInterface
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /** @inheritdoc */
    public function getPromotionsId(): int
    {
        return $this->getData(self::PROMOTIONS_ID);
    }

    /** @inheritdoc */
    public function setPromotionsId(int $promotionsId): PromotionsRelationInterface
    {
        return $this->setData(self::PROMOTIONS_ID, $promotionsId);
    }

    /** @inheritdoc */
    public function getGroupId(): int
    {
        return $this->getData(self::GROUP_ID);
    }

    /** @inheritdoc */
    public function setGroupId(int $groupId): PromotionsRelationInterface
    {
        return $this->setData(self::GROUP_ID, $groupId);
    }

    /** @inheritdoc */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /** @inheritdoc */
    public function setCreatedAt(string $createdAt): PromotionsRelationInterface
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /** @inheritdoc */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /** @inheritdoc */
    public function setUpdatedAt(?string $updatedAt): PromotionsRelationInterface
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
