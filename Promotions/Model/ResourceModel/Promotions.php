<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model\ResourceModel;

use Kodano\Promotions\Api\Data\PromotionsInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Promotions extends AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(PromotionsInterface::TABLE_NAME, PromotionsInterface::ID);
        $this->_useIsObjectNew = true;
    }
}
