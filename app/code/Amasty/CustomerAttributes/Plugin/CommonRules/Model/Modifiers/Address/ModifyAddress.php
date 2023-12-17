<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Plugin\CommonRules\Model\Modifiers\Address;

use Amasty\CommonRules\Model\Modifiers\Address;
use Amasty\CustomerAttributes\Api\CustomerAttributesQuoteAddressRepositoryInterface;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;
use Magento\Quote\Model\Quote\Address as QuoteAddress;

class ModifyAddress
{
    /**
     * @var CustomerAttributesQuoteAddressRepositoryInterface
     */
    private $customerAttributesQuoteAddressRepository;

    /**
     * @var AttributeValueFactory
     */
    private $attributeValueFactory;

    public function __construct(
        CustomerAttributesQuoteAddressRepositoryInterface $customerAttributesQuoteAddressRepository,
        AttributeValueFactory $attributeValueFactory
    ) {
        $this->customerAttributesQuoteAddressRepository = $customerAttributesQuoteAddressRepository;
        $this->attributeValueFactory = $attributeValueFactory;
    }

    public function afterModify(Address $subject, DataObject $address): DataObject
    {
        if (!$this->isValid($address)) {
            return $address;
        }

        /** @var QuoteAddress $address */
        try {
            $customerAttributesQuoteAddress = $this->customerAttributesQuoteAddressRepository->getByAddressId(
                (int) $address->getId()
            );
        } catch (LocalizedException $e) {
            return $address;
        }

        if (empty($customerAttributesQuoteAddress) || empty($customerAttributesQuoteAddress->getAttributesData())) {
            return $address;
        }

        $customAttributes = [];
        foreach ($customerAttributesQuoteAddress->getAttributesData() as $attributeCode => $attributeValue) {
            $attribute = $this->attributeValueFactory->create();
            $attribute->setAttributeCode($attributeCode);
            $attribute->setValue($attributeValue);
            $customAttributes[$attributeCode] = $attribute;
        }

        $address->setCustomAttributes($customAttributes);

        return $address;
    }

    private function isValid(DataObject $address): bool
    {
        return $address instanceof QuoteAddress
            && $address->getAddressType() === QuoteAddress::ADDRESS_TYPE_SHIPPING
            && !empty($address->getId())
            && empty($address->getCustomAttributes());
    }
}
