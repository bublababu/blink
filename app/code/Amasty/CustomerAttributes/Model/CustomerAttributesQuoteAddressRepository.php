<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Model;

use Amasty\CustomerAttributes\Api\CustomerAttributesQuoteAddressRepositoryInterface;
use Amasty\CustomerAttributes\Api\Data\CustomerAttributesQuoteAddressInterface;
use Amasty\CustomerAttributes\Api\Data\CustomerAttributesQuoteAddressInterfaceFactory;
use Amasty\CustomerAttributes\Model\ResourceModel\Quote\Address\CustomerAttributesQuoteAddress
    as CustomerAttributesQuoteAddressResource;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;

class CustomerAttributesQuoteAddressRepository implements CustomerAttributesQuoteAddressRepositoryInterface
{
    /**
     * @var CustomerAttributesQuoteAddressResource
     */
    private $customerAttributesQuoteAddressResource;

    /**
     * @var CustomerAttributesQuoteAddressInterfaceFactory
     */
    private $customerAttributesQuoteAddressFactory;

    public function __construct(
        CustomerAttributesQuoteAddressResource $customerAttributesQuoteAddressResource,
        CustomerAttributesQuoteAddressInterfaceFactory $customerAttributesQuoteAddressFactory
    ) {
        $this->customerAttributesQuoteAddressResource = $customerAttributesQuoteAddressResource;
        $this->customerAttributesQuoteAddressFactory = $customerAttributesQuoteAddressFactory;
    }

    /**
     * @throws LocalizedException
     */
    public function getByAddressId(int $addressId): ?CustomerAttributesQuoteAddressInterface
    {
        $rowId = $this->customerAttributesQuoteAddressResource->getRowIdByAddressId($addressId);
        if (!$rowId) {
            return null;
        }

        $customerAttributesQuoteAddress = $this->customerAttributesQuoteAddressFactory->create();
        $customerAttributesQuoteAddress->setRowId($rowId);
        $this->customerAttributesQuoteAddressResource->load($customerAttributesQuoteAddress, $rowId);

        return $customerAttributesQuoteAddress;
    }

    /**
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function save(CustomerAttributesQuoteAddressInterface $customerAttributesQuoteAddress): void
    {
        $rowId = $this->customerAttributesQuoteAddressResource->getRowIdByAddressId(
            $customerAttributesQuoteAddress->getAddressId()
        );

        if ($rowId) {
            $customerAttributesQuoteAddress->setRowId($rowId);
        }

        $this->customerAttributesQuoteAddressResource->save($customerAttributesQuoteAddress);
    }
}
