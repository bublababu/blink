<?php
namespace Blink\Email\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Blink\Email\Model\EmailFactory;


class Index extends \Magento\Framework\App\Action\Action
{	
	protected $_modelEmailFactory;
	
	public function __construct(
		Context $context,
		EmailFactory $modelEmailFactory
	) {
		parent::__construct($context);
		$this->_modelEmailFactory = $modelEmailFactory;
        }
	
	public function execute()
        {
			
			 $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
         $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
          $connection = $resource->getConnection();
			echo   $select="SELECT *  from blink_email WHERE customer='Available' LIMIT 1";
      
      
      
    $email= $connection->fetchAll($select);
	
	print_r($email);
	
	 $templateVars = [
                'customerName' => 'biplab',
                'user' =>$email[0]['email']
            ];
	
	
	 $emailTemplate =1;
	 $mailto= 'jill@blinksignup.com';
	  $transport = $objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
	   $data = $transport->setTemplateIdentifier($emailTemplate) ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
                ->setTemplateVars($templateVars)
                ->setFrom(['name' => 'blinksignup', 'email' => 'dev@blinksignup.com'])
                ->addto($mailto)
              	->addCc('biplab.nandi@gmail.com')
                ->getTransport();
            $data->sendMessage();
	//$name="AAA"."  " ."BB";
	// $upd="UPDATE blink_email SET customer='".$name."' WHERE id=".$email[0]['id'];
    //  $connection->query($upd);
			
			echo 'here11' ; exit;
	   //$this->_view->loadLayout();
          // $this->_view->renderLayout();
	}
}
