<?php
// Vendor/Module/Controller/Account/CustomLogin.php
namespace Blink\Customerapi\Controller\Account;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Datasend extends AbstractAccount
{
    protected $resultPageFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    { 
     $post = $this->getRequest()->getPost();
      print_r($post);
    
       
    }
    
   
}
