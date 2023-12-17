<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Model\Quote\Address;

use Amasty\CustomerAttributes\Api\Data\CustomerAttributesQuoteAddressInterface;
use Amasty\CustomerAttributes\Model\ResourceModel\Quote\Address\CustomerAttributesQuoteAddress as QuoteAddressResource;
use Magento\Framework\Model\AbstractModel;

class CustomerAttributesQuoteAddress extends AbstractModel implements CustomerAttributesQuoteAddressInterface
{
    public function _construct()
    {
        $this->_init(QuoteAddressResource::class);
    }

    public function getRowId(): int
    {
        return (int) $this->getData(self::ROW_ID);
    }

    public function setRowId(int $rowId): void
    {
        $this->setData(self::ROW_ID, $rowId);
    }

    public function getAddressId(): int
    {
        return (int) $this->getData(self::ADDRESS_ID);
    }

    public function setAddressId(int $addressId): void
    {
        $this->setData(self::ADDRESS_ID, $addressId);
    }

    public function getSerializedData(): string
    {
        return (string) $this->getData(self::SERIALIZED_DATA);
    }

    public function setSerializedData(string $serializedData): void
    {
        $this->setData(self::SERIALIZED_DATA, $serializedData);
    }

    public function getAttributesData(): array
    {
        return empty($this->getSerializedData())
            ? []
            : json_decode($this->getSerializedData(), true);
    }
}
