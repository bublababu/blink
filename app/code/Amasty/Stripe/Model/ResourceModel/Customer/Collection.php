<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Model\ResourceModel\Customer;

use Amasty\Stripe\Model\Customer;
use Amasty\Stripe\Model\ResourceModel\Customer as CustomerResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Customer::class, CustomerResource::class);
    }
}
