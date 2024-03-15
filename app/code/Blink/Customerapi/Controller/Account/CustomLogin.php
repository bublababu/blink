<?php
// Vendor/Module/Controller/Account/CustomLogin.php
namespace Blink\Customerapi\Controller\Account;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class CustomLogin extends AbstractAccount
{
    protected $resultPageFactory;
    protected $blockdata; 
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        \Blink\Customerapi\Block\Login $blockdata
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->blockdata = $blockdata;
        parent::__construct($context);
    }

    public function execute()
    { $data = $this->getRequest()->getParam('client_id');
    
      
      /////////////// get data based on client ID /////
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
            $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
             $customerSession = $objectManager->create('Magento\Customer\Model\Session');
             if($customerSession->getMyValue()=='' ) {  $customerSession->setMyValue($data);
            $customerSession->setMyTransId($this->getRequest()->getParam('response_code'));
            
            
          //  $this->getRequest()->getParam('response_code') ; exit;
             
             }
             
            $connection = $resource->getConnection();
            $tableOauth = $resource->getTableName('oauth_consumer');
            $tableIntegration = $resource->getTableName('integration');
     $sql = "SELECT endpoint FROM " . $tableOauth ." , " . $tableIntegration. " WHERE ". $tableOauth.".entity_id=".$tableIntegration.".consumer_id  AND " . $tableOauth.".key='".$data."'  AND ". $tableIntegration.".status=1";
      
        $result=array();
        
        $result['callback'] = $connection->fetchOne($sql);
        $result['client']=$data;
        $result['ref']=0;
        
        $customerData = $customerSession->getCustomer()->getData(); //get all data of customerData
        
        //print_r($customerData);
        $result['name']=$customerData['firstname'] . ' ' . $customerData['lastname'] ; 
         
        // print_r($result);
        
        if($result['callback']!='')
        {
           $pieces = parse_url($result['callback']);
         $result['ref']=$pieces['host'];
        }
    
   // print_r($result);
   
        /** @var \Magento\Framework\View\Result\Page $resultPage */
     //  $resultPage = $this->resultPageFactory->create();
       $resultPage=$this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $this->blockdata->setColl($result);
        
        $resultPage->getConfig()->getTitle()->set(__('Authorization'));
        return $resultPage;
    }
    
   
}
