<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\ResourceModel\PromotionsGroup;

use Kodano\Promotions\Api\Data\PromotionsGroupInterface;
use Kodano\Promotions\Model\Data\PromotionsGroup;
use Kodano\Promotions\Model\ResourceModel\PromotionsGroup as PromotionsGroupResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /** {@inheritDoc} */
    public $_idFieldName = PromotionsGroupInterface::ID;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsGroup::class, PromotionsGroupResource::class);
    }
}
