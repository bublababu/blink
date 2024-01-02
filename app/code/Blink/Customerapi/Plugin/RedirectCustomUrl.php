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
     $data=1;
      $result="customer/account/dashboard";
        if ($data!='')
        {
        $customUrl = 'customerapi/account/customlogin/';
        $result->setPath($customUrl);
        }
        return $result;
    }

}