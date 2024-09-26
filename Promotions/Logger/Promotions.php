<?php
declare(strict_types=1);

namespace Kodano\Promotions\Logger;

use Kodano\Promotions\Api\Data\PromotionsRelationInterface;
use Kodano\Promotions\Model\Config;
use Monolog\Logger;

class Promotions
{
    /**
     * @param Logger $logger
     * @param Config $config
     */
    public function __construct(
        private Logger $logger,
        private Config $config
    ){
    }

    /**
     * @param PromotionsRelationInterface $relation
     *
     * @return void
     */
    public function logPromotionAssignment(PromotionsRelationInterface $relation): void
    {
        if ($this->config->isLoggingEnabled()) {
            $this->logger->debug(sprintf(
                'Promotion %s is now assigned to group %s',
                $relation->getPromotionsId(),
                $relation->getGroupId()
            ));
        }
    }
}
