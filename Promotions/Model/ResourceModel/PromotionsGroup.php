<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\ResourceModel;

use Kodano\Promotions\Api\Data\PromotionsGroupInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class PromotionsGroup extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsGroupInterface::TABLE_NAME, PromotionsGroupInterface::ID);
        $this->_useIsObjectNew = true;
    }
}
