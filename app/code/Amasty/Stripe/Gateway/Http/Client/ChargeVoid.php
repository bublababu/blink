<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Http\Client;

use Amasty\Stripe\Gateway\Request\VoidCancelDataBuilder;

/**
 * Charge Refund in stripe
 */
class ChargeVoid extends AbstractClient
{
    /**
     * Create Refund
     *
     * @param array $data
     * @return \Stripe\PaymentIntent|null
     */
    protected function process(array $data)
    {
        $storeId = null;
        if (!empty($data[AbstractClient::STORE_ID])) {
            $storeId = (int)$data[AbstractClient::STORE_ID];
            unset($data[AbstractClient::STORE_ID]);
        }

        $stripeAdapter = $this->adapterProvider->get($storeId);
        $paymentIntent = $stripeAdapter->paymentIntentRetrieve($data[VoidCancelDataBuilder::PAYMENT_INTENT]);

        if ($paymentIntent) {
            $stripeAdapter->paymentIntentCancel($paymentIntent);
        }

        return $paymentIntent;
    }
}
