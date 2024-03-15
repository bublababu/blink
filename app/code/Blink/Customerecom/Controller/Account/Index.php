<?php
// Vendor/Module/Controller/Account/CustomLogin.php
namespace Blink\Customerecom\Controller\Account;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractAccount
{
    protected $resultPageFactory;
    protected $blockdata; 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Blink\Customerecom\Block\Account $blockdata
        
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->blockdata = $blockdata;
        parent::__construct($context);
      }

    public function execute()
    { 
      
       // $resultPage=$this->resultFactory->create(ResultFactory::TYPE_PAGE);
      //  $resultPage->getConfig()->getTitle()->set(__('history'));
       // return $resultPage;
       
               $this->_view->loadLayout();
               $this->_view->renderLayout();
    }
    
   
}
