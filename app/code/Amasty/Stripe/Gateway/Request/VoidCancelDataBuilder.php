<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Request;

use Amasty\Stripe\Gateway\Http\Client\AbstractClient;
use Amasty\Stripe\Gateway\Helper\SubjectReader;
use Magento\Payment\Gateway\Request\BuilderInterface;

/**
 * Building Data For Void and Cancel order
 */
class VoidCancelDataBuilder implements BuilderInterface
{
    /**
     * Key for get charge
     */
    public const PAYMENT_INTENT = 'payment_intent';

    /**
     * @var SubjectReader
     */
    protected $subjectReader;

    public function __construct(
        SubjectReader $subjectReader
    ) {
        $this->subjectReader = $subjectReader;
    }

    /**
     * @param array $buildSubject
     *
     * @return array
     */
    public function build(array $buildSubject)
    {
        $paymentDO = $this->subjectReader->readPayment($buildSubject);
        $order = $paymentDO->getOrder();
        try {
            $paymentIntentId = $paymentDO->getPayment()->getAdditionalInformation('stripe_charge_id');
            $storeId = (int)$order->getStoreId();

        } catch (\InvalidArgumentException $e) {
            return [];
        }

        return [
            self::PAYMENT_INTENT => $paymentIntentId,
            AbstractClient::STORE_ID => $storeId
        ];
    }
}
