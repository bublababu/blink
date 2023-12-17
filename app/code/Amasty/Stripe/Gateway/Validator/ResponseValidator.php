<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Validator;

class ResponseValidator extends GeneralResponseValidator
{
    /**
     * Key get failed status
     */
    public const STATUS_FAILED = 'failed';

    /**
     * @return array
     */
    protected function getResponseValidators()
    {
        return array_merge(
            parent::getResponseValidators(),
            [
                function ($response) {
                    return [
                        ($response instanceof \Stripe\Charge || $response instanceof \Stripe\PaymentIntent)
                        && isset($response->status)
                        && $response->status != self::STATUS_FAILED,
                        [__('Wrong transaction status')],
                    ];
                },
            ]
        );
    }
}
