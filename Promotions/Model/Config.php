<?php

declare(strict_types=1);

namespace Kodano\Promotions\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Config
{
    public const KODANO_PROMOTIONS_LOG_ENABLED = 'kodano_promotions/api/debug_log';

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ){
    }

    /**
     * @param int|null $websiteId
     *
     * @return bool
     */
    public function isLoggingEnabled(?int $websiteId = null): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::KODANO_PROMOTIONS_LOG_ENABLED,
            ScopeInterface::SCOPE_WEBSITE,
            $websiteId
        );
    }
}
