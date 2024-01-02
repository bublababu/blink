<?php

namespace Blink\Customerapi\Controller\Account;

use Magento\Customer\Controller\Account\Login as MagentoLogin;

class Login extends MagentoLogin
{
    public function execute()
    {
        // Your custom logic here
        
        echo 'I am here1234'; 
        // For example, modify the login functionality

        // Call parent execute method
        return parent::execute();
    }
}
