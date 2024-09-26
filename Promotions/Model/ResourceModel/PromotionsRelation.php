<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\ResourceModel;

use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PromotionsRelation extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsRelationInterface::TABLE_NAME, PromotionsRelationInterface::ENTITY_ID);
    }
}
