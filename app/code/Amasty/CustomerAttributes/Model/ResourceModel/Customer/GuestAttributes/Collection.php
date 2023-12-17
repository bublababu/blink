<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Model\ResourceModel\Customer\GuestAttributes;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'Amasty\CustomerAttributes\Model\Customer\GuestAttributes',
            'Amasty\CustomerAttributes\Model\ResourceModel\Customer\GuestAttributes'
        );
    }
}
