<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;
use Amasty\Stripe\Gateway\Helper\SubjectReader;
use Amasty\Stripe\Observer\DataAssignObserver;

/**
 * Build data from payment method
 */
class SourceDataBuilder implements BuilderInterface
{
    /**
     * Key for get Source Stripe (Payment Intent)
     */
    public const SOURCE = 'source';

    /**
     * Key for get Payment Method Stripe
     */
    public const PAYMENT_METHOD = 'payment_method';

    /**
     * Increment Order Id
     */
    public const INCREMENT_ID = 'increment_id';

    /**
     * Save Card Flag
     */
    public const SAVE_CARD = 'save_card';

    /**
     * @var SubjectReader
     */
    protected $subjectReader;

    /**
     * @param SubjectReader $subjectReader
     */
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
        $payment = $paymentDO->getPayment();

        // Otherwise assign the payment source
        return [
            self::SOURCE => $payment->getAdditionalInformation(DataAssignObserver::KEY_SOURCE),
            self::PAYMENT_METHOD => $payment->getAdditionalInformation(DataAssignObserver::KEY_PAYMENT),
            self::INCREMENT_ID => $payment->getOrder()->getIncrementId(),
            self::SAVE_CARD => $payment->getAdditionalInformation(DataAssignObserver::SAVE_CARD)
        ];
    }
}
