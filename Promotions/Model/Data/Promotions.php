<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\Data;

use Kodano\Promotions\Api\Data\PromotionsInterface;
use Kodano\Promotions\Model\ResourceModel\Promotions as PromotionsResource;
use Magento\Framework\Model\AbstractExtensibleModel;

class Promotions extends AbstractExtensibleModel implements PromotionsInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = PromotionsInterface::TABLE_NAME;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsResource::class);
    }

    /** @inheritdoc */
    public function getId(): ?string
    {
        return $this->getData(self::ID);
    }

    /** @inheritdoc */
    public function setId($id): void
    {
        $this->setData(self::ID, $id);
    }

    /** @inheritdoc */
    public function getName(): string
    {
        return $this->getData(self::NAME);
    }

    /** @inheritdoc */
    public function setName(string $name): void
    {
        $this->setData(self::NAME, $name);
    }

    /** @inheritdoc */
    public function getCreatedAt(): string
    {
        return $this->getData(self::CREATED_AT);
    }

    /** @inheritdoc */
    public function setCreatedAt(string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /** @inheritdoc */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /** @inheritdoc */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
