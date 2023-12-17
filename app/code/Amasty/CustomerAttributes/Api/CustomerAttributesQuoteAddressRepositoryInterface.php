<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Api;

use Amasty\CustomerAttributes\Api\Data\CustomerAttributesQuoteAddressInterface;
use Magento\Framework\Exception\LocalizedException;

interface CustomerAttributesQuoteAddressRepositoryInterface
{
    /**
     * @param int $addressId
     * @return CustomerAttributesQuoteAddressInterface|null
     * @throws LocalizedException
     */
    public function getByAddressId(int $addressId): ?CustomerAttributesQuoteAddressInterface;

    /**
     * @param CustomerAttributesQuoteAddressInterface $customerAttributesQuoteAddress
     * @return void
     * @throws LocalizedException
     */
    public function save(CustomerAttributesQuoteAddressInterface $customerAttributesQuoteAddress): void;
}
