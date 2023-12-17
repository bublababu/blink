<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Api\Data;

interface CustomerAttributesQuoteAddressInterface
{
    public const ROW_ID = 'row_id';
    public const ADDRESS_ID = 'address_id';
    public const SERIALIZED_DATA = 'serialized_data';

    /**
     * @return int
     */
    public function getRowId(): int;

    /**
     * @param int $rowId
     * @return void
     */
    public function setRowId(int $rowId): void;

    /**
     * @return int
     */
    public function getAddressId(): int;

    /**
     * @param int $addressId
     * @return void
     */
    public function setAddressId(int $addressId): void;

    /**
     * @return string
     */
    public function getSerializedData(): string;

    /**
     * @param string $serializedData
     * @return void
     */
    public function setSerializedData(string $serializedData): void;

    /**
     * @return array
     */
    public function getAttributesData(): array;
}
