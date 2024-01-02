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
      echo 'Please wait , do not close window.....';
     
     
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $customerSession = $objectManager->create('Magento\Customer\Model\Session');
        $connection = $resource->getConnection();
        $tableOauth = $resource->getTableName('oauth_consumer');
        $tableIntegration = $resource->getTableName('integration');
         $clientId= $customerSession->getMyValue();
         $transId=$customerSession->getMyTransId();
        $sql = "SELECT endpoint FROM " . $tableOauth ." , " . $tableIntegration. " WHERE ". $tableOauth.".entity_id=".$tableIntegration.".consumer_id  AND " . $tableOauth.".key='".$clientId."' AND ". $tableIntegration.".status=1" ;
        
        $result=array();
        
        $result['callback'] = $connection->fetchOne($sql);
      
        
        $customerData = $customerSession->getCustomer()->getData(); //get all data of customerData
        
        //print_r($customerData);
        $result['name']=$customerData['firstname'] . ' ' . $customerData['lastname'] ; 
               
            // Sample JSON data to be sent
                        $data = [
                            'name' => $result['name'],
                            'email' => $customerData['email'],
                            'response_code' =>$transId
                        ];
                        
                        // Encode data to JSON format
                        $jsonData = json_encode($data);
                        
                        // URL to send the JSON data
                           $url =$result['callback'];
                        
                        // Initialize cURL session
                        $ch = curl_init($url);
                        
                        // Set cURL options for POST request with JSON data
                        curl_setopt($ch, CURLOPT_POST, 1);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                            'Content-Type: application/json',
                            'Content-Length: ' . strlen($jsonData)
                        ]);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        
                        // Execute cURL session
                        $response = curl_exec($ch);
                        
                        // Check for errors
                        if (curl_errno($ch)) {
                           // echo 'Error: ' . curl_error($ch);
                        } else {
                            // Decode the JSON response
                            $responseData = json_decode($response, true);
                        
                            if ($responseData === null && json_last_error() !== JSON_ERROR_NONE) {
                                // Handle JSON decoding error
                               // echo 'Error decoding JSON: ' . json_last_error_msg();
                            } else {
                                // Process the received JSON response
                              //  echo 'Response: ';
                               // print_r($responseData);
                            }
                        }
                        
                        // Close cURL session
                        curl_close($ch);
                             
     
     $customerSession->setMyValue('');
     $customerSession->setMyTransId('');
     
     
    // print_r($data);
      
      ?>
      <script>
// Automatically submit the form when the window loads
window.onload = function() {
    
  setTimeout(function() {window.close();}, 3000);
 // window.close();


};
</script>
      <?php
    
       
    }
    
   
}
