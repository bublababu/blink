<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Observer;

use Amasty\CustomerAttributes\Api\CustomerAttributesQuoteAddressRepositoryInterface;
use Amasty\CustomerAttributes\Api\Data\CustomerAttributesQuoteAddressInterfaceFactory;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\Quote\Address;
use Psr\Log\LoggerInterface;

class SaveQuoteAddress implements ObserverInterface
{
    /**
     * @var CustomerAttributesQuoteAddressRepositoryInterface
     */
    private $customerAttributesQuoteAddressRepository;

    /**
     * @var CustomerAttributesQuoteAddressInterfaceFactory
     */
    private $customerAttributesQuoteAddressFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var array
     */
    private $processedAddresses = [];

    public function __construct(
        CustomerAttributesQuoteAddressRepositoryInterface $customerAttributesQuoteAddressRepository,
        CustomerAttributesQuoteAddressInterfaceFactory $customerAttributesQuoteAddressFactory,
        LoggerInterface $logger
    ) {
        $this->customerAttributesQuoteAddressRepository = $customerAttributesQuoteAddressRepository;
        $this->customerAttributesQuoteAddressFactory = $customerAttributesQuoteAddressFactory;
        $this->logger = $logger;
    }

    public function execute(Observer $observer): void
    {
        $shippingAssignment = $observer->getData('shipping_assignment');
        if (empty($shippingAssignment)) {
            return;
        }

        $address = $shippingAssignment->getShipping()->getAddress();
        if (!$this->validateAddress($address)) {
            return;
        }

        $data = [];
        $this->processedAddresses[] = $address->getId();

        foreach ($address->getCustomAttributes() as $customAttribute) {
            $data[$customAttribute->getAttributeCode()] = $customAttribute->getValue();
        }

        $customerAttributesQuoteAddress = $this->customerAttributesQuoteAddressFactory->create();
        $customerAttributesQuoteAddress->setAddressId((int) $address->getId());
        $customerAttributesQuoteAddress->setSerializedData(json_encode($data));

        try {
            $this->customerAttributesQuoteAddressRepository->save($customerAttributesQuoteAddress);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }

    private function validateAddress(Address $address): bool
    {
        return $address->getId()
            && $address->getAddressType() === Address::ADDRESS_TYPE_SHIPPING
            && !empty($address->getCustomAttributes())
            && !in_array($address->getId(), $this->processedAddresses);
    }
}
