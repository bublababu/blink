<?php

namespace Blink\Customerapi\Plugin;
use Magento\Framework\App\Action\Context;

class RedirectCustomUrl
{
protected $request;
    public function __construct(
        \Magento\Framework\App\Request\Http $request
    ) {
       $this->request = $request;
      
    }


    public function afterExecute(
        \Magento\Customer\Controller\Account\LoginPost $subject,
        $result, )
    {
   //  echo 'asdsa00'.   $data = $this->getRequest()->getParam('client_id');
   
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        
        
      $clientId= $customerSession->getMyValue(); 
    
        if ($clientId!='')
        {
        $customUrl = 'customerapi/account/customlogin/';
        $result->setPath($customUrl);
        }
        else {
             $customUrl = 'customer/account/';
             $result->setPath($customUrl);
        }
        return $result;
    }

}