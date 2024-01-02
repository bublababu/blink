<?php

namespace Blink\Customerapi\Controller\Account;

use Magento\Customer\Controller\Account\Login as MagentoLogin;

class Login extends MagentoLogin
{
    public function execute()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $customerSession->setMyValue($this->getRequest()->getParam('client_id'));
        $customerSession->setMyTransId($this->getRequest()->getParam('response_code'));
       
     //  $customerSession->getMyValue();
        
    
        // For example, modify the login functionality

        // Call parent execute method
        return parent::execute();
    }
}
