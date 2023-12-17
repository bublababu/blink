<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Model\ResourceModel\Quote\Address;

use Amasty\CustomerAttributes\Api\Data\CustomerAttributesQuoteAddressInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class CustomerAttributesQuoteAddress extends AbstractDb
{
    public const MAIN_TABLE = 'amasty_customer_attributes_quote_address';

    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, CustomerAttributesQuoteAddressInterface::ROW_ID);
    }

    /**
     * @throws LocalizedException
     */
    public function getRowIdByAddressId(int $addressId): int
    {
        $select = $this->getConnection()->select()
            ->from($this->getMainTable(), [CustomerAttributesQuoteAddressInterface::ROW_ID])
            ->where(CustomerAttributesQuoteAddressInterface::ADDRESS_ID . ' = ?', $addressId);

        return (int) $this->getConnection()->fetchOne($select);
    }
}
