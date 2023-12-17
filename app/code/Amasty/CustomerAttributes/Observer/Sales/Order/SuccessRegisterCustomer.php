<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Observer\Sales\Order;

use Amasty\CustomerAttributes\Helper\Session as SessionHelper;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SuccessRegisterCustomer for save attributes to customer when place order with registration
 */
class SuccessRegisterCustomer implements ObserverInterface
{
    /**
     * @var SessionHelper
     */
    private $sessionHelper;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    public function __construct(SessionHelper $sessionHelper, CustomerRepositoryInterface $customerRepository)
    {
        $this->sessionHelper = $sessionHelper;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($observer->getData('amasty_checkout_register')) {
            /** @var CustomerInterface $customer */
            $customer = $observer->getData('customer');
            $customerAttributes = $this->sessionHelper->getCustomerAttributesFromSession();

            foreach ($customerAttributes as $code => $value) {
                $customer->setCustomAttribute($code, $value);
            }

            $this->customerRepository->save($customer);
        }
    }
}
