<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Response;

use Magento\Payment\Gateway\Response\HandlerInterface;
use Magento\Sales\Api\Data\OrderPaymentInterface;
use Amasty\Stripe\Gateway\Helper\SubjectReader;

/**
 * Handle Payment Details
 */
class PaymentDetailsHandler implements HandlerInterface
{
    /**
     * Failude Code Stripe
     */
    public const FAILURE_CODE = 'failure_code';

    /**
     * Failude  Message Stripe
     */
    public const FAILURE_MESSAGE = 'failure_message';

    /**
     * Outcome Stripe
     */
    public const OUTCOME = 'outcome';

    /**
     * Outcome Type Stripe
     */
    public const OUTCOME_TYPE = 'type';

    /**
     * Outcome Network Status Stripe
     */
    public const OUTCOME_NETWORK_STATUS = 'network_status';

    /**
     * Outcome Reason Stripe
     */
    public const OUTCOME_REASON = 'reason';

    /**
     * Outcome Seller Message Stripe
     */
    public const OUTCOME_SELLER_MESSAGE = 'seller_message';

    /**
     * Outcome Risk Level Stripe
     */
    public const OUTCOME_RISK_LEVEL = 'risk_level';

    /**
     * @var array
     */
    protected $additionalInfoMap = [
        self::FAILURE_CODE,
        self::FAILURE_MESSAGE,
        self::OUTCOME => [
            self::OUTCOME_TYPE,
            self::OUTCOME_NETWORK_STATUS,
            self::OUTCOME_REASON,
            self::OUTCOME_SELLER_MESSAGE,
            self::OUTCOME_RISK_LEVEL,
        ],
    ];

    /**
     * @var SubjectReader
     */
    protected $subjectReader;

    /**
     * @param SubjectReader $subjectReader
     */
    public function __construct(SubjectReader $subjectReader)
    {
        $this->subjectReader = $subjectReader;
    }

    /**
     * @param array $handlingSubject
     * @param array $response
     */
    public function handle(array $handlingSubject, array $response)
    {
        $paymentDO = $this->subjectReader->readPayment($handlingSubject);
        /** @var \Stripe\Charge $charge */
        $charge = $this->subjectReader->readCharge($response);
        /** @var OrderPaymentInterface $payment */
        $payment = $paymentDO->getPayment();

        foreach ($this->additionalInfoMap as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    // Skip empty values
                    if (!isset($charge->$key->$item)) {
                        continue;
                    }
                    // Copy over nested element
                    $payment->setAdditionalInformation(
                        $key . '_' . $item,
                        $charge->$key->$item
                    );
                }
            } elseif (isset($charge->$value)) {
                // Copy over element on base level
                $payment->setAdditionalInformation($value, $charge->$value);
            }
        }
    }
}
