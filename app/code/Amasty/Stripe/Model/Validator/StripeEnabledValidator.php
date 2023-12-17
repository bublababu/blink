<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Model\Validator;

use Amasty\Stripe\Gateway\Config\Config;

class StripeEnabledValidator
{
    /**
     * @var Config
     */
    private $config;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        if (!class_exists(\Stripe\Stripe::class)) {
            return false;
        }

        return $this->config->isActive() && $this->config->getPublicKey() && $this->config->getPrivateKey();
    }
}
