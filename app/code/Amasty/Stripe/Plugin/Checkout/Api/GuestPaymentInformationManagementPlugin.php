<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Plugin\Checkout\Api;

use Amasty\Stripe\Gateway\Command\PaymentCancellation;
use Magento\Checkout\Api\GuestPaymentInformationManagementInterface;
use Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface;

class GuestPaymentInformationManagementPlugin
{
    /**
     * @var PaymentCancellation
     */
    private $paymentCancellation;

    /**
     * @var MaskedQuoteIdToQuoteIdInterface
     */
    private $maskedQuoteIdToQuoteId;

    public function __construct(
        MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId,
        PaymentCancellation $paymentCancellation
    ) {
        $this->maskedQuoteIdToQuoteId = $maskedQuoteIdToQuoteId;
        $this->paymentCancellation = $paymentCancellation;
    }

    /**
     * @param GuestPaymentInformationManagementInterface $subject
     * @param \Closure $proceed
     * @param string $cartId
     * @param string $email
     * @param \Magento\Quote\Api\Data\PaymentInterface $paymentMethod
     * @param \Magento\Quote\Api\Data\AddressInterface|null $billingAddress
     * @return int|void
     * @throws \Exception
     */
    public function aroundSavePaymentInformationAndPlaceOrder(
        GuestPaymentInformationManagementInterface $subject,
        \Closure $proceed,
        $cartId,
        $email,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    ) {
        try {
            return $proceed($cartId, $email, $paymentMethod, $billingAddress);
        } catch (\Exception $e) {
            $quoteId = $this->maskedQuoteIdToQuoteId->execute($cartId);
            $this->paymentCancellation->execute($paymentMethod, $quoteId);

            throw $e;
        }
    }
}
