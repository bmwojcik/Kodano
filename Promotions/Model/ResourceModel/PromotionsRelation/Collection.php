<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\ResourceModel\PromotionsRelation;

use Kodano\Promotions\Api\Data\PromotionsGroupInterface;
use Kodano\Promotions\Api\Data\PromotionsInterface;
use Kodano\Promotions\Model\Data\PromotionsRelation;
use Kodano\Promotions\Model\ResourceModel\PromotionsRelation as PromotionsRelationResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsRelation::class, PromotionsRelationResource::class);
    }

    /**
     * @return void
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->joinPromotionsTable();
        $this->joinPromotionsGroupTable();
    }

    /**
     * @return $this
     */
    public function joinPromotionsTable(): self
    {
        $this->getSelect()->joinLeft(
            ['promotions' => $this->getTable(PromotionsInterface::TABLE_NAME)],
            'main_table.promotions_id = promotions.entity_id',
            ['promotion_name' => 'promotions.name']
        );

        return $this;
    }

    /**
     * @return $this
     */
    public function joinPromotionsGroupTable(): self
    {
        $this->getSelect()->joinLeft(
            ['promotions_group' => $this->getTable(PromotionsGroupInterface::TABLE_NAME)],
            'main_table.group_id = promotions_group.entity_id',
            ['group_name' => 'promotions_group.name']
        );

        return $this;
    }
}
