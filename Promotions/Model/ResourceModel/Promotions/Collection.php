<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\ResourceModel\Promotions;

use Kodano\Promotions\Api\Data\PromotionsInterface;
use Kodano\Promotions\Model\Data\Promotions as PromotionsModel;
use Kodano\Promotions\Model\ResourceModel\Promotions as PromotionsResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /** {@inheritDoc} */
    public $_idFieldName = PromotionsInterface::ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsModel::class, PromotionsResourceModel::class);
    }
}
