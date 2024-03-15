<?php
// Vendor/Module/Controller/Account/CustomLogin.php
namespace Blink\Customerecom\Controller\Account;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\ResultFactory;

class Api extends AbstractAccount
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
      
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $connection = $resource->getConnection();
        $tableOauth = $resource->getTableName('oauth_consumer');
        $tableIntegration = $resource->getTableName('integration');
       
        $customerData = $customerSession->getCustomer()->getData(); //get all data of customerData
        
        //print_r($customerData);
       
         //$customerId = $customerData['entity_id'];
        // $customerObj = $objectManager->create('Magento\Customer\Model\Customer')->load($customerId);
         
       
       $sql = "SELECT * FROM " . $tableOauth ." , " . $tableIntegration. " WHERE ". $tableOauth.".entity_id=".$tableIntegration.".consumer_id  AND ". $tableIntegration.".email='".$customerData['email']."'" ; 
        
        $result=array();
        $result = $connection->fetchAll($sql);
        
        $resultPage=$this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $this->blockdata->setColl($result);
      //  $this->blockdata->generateQrCode($result[0]['identity_link_url']);
       
       
       
       
               $this->_view->loadLayout();
               $this->_view->renderLayout();
    }
    
   
}
