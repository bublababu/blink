<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Request;

use Amasty\Stripe\Gateway\Helper\AmountHelper;
use Amasty\Stripe\Gateway\Helper\SubjectReader;
use Amasty\Stripe\Gateway\Http\Client\AbstractClient;
use Magento\Payment\Gateway\Request\BuilderInterface;

/**
 * Data Builder For Charge Capture
 */
class ChargeCaptureDataBuilder implements BuilderInterface
{
    /**
     * Charge id for Stripe
     */
    public const CHARGE_ID = 'chargeId';

    /**
     * Amount for Invoice
     */
    public const AMOUNT = 'amount_to_capture';

    /**
     * @var SubjectReader
     */
    protected $subjectReader;

    /**
     * @var AmountHelper
     */
    protected $amountHelper;

    /**
     * @param SubjectReader $subjectReader
     * @param AmountHelper  $amountHelper
     */
    public function __construct(
        SubjectReader $subjectReader,
        AmountHelper $amountHelper
    ) {
        $this->subjectReader = $subjectReader;
        $this->amountHelper = $amountHelper;
    }

    /**
     * @param array $buildSubject
     *
     * @return array
     */
    public function build(array $buildSubject)
    {
        $chargeId = $amount = null;
        $paymentDO = $this->subjectReader->readPayment($buildSubject);
        $order = $paymentDO->getOrder();

        try {
            $chargeId = $this->subjectReader->readPayment($buildSubject)->getPayment()->getAdditionalInformation(
            )['stripe_charge_id'];
            $amount = $this->amountHelper->getAmountForStripe(
                $this->subjectReader->readAmount($buildSubject),
                $order->getCurrencyCode()
            );
            $storeId = (int)$order->getStoreId();
        } catch (\InvalidArgumentException $e) {
            return [];
        }

        return [
            self::CHARGE_ID => $chargeId,
            self::AMOUNT => $amount,
            AbstractClient::STORE_ID => $storeId
        ];
    }
}
