<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category  Mageplaza
 * @package   Mageplaza_CustomerApproval
 * @copyright Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license   https://www.mageplaza.com/LICENSE.txt
 */

namespace Blink\Email\Observer;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Customer\Model\Session;



/**
 * Class CustomerSaveAfter
 *
 * @package Mageplaza\CustomerApproval\Observer
 */
class AddCustomerData  implements ObserverInterface
{
    /**
     * @var HelperData
     */
   

    /**
     * @var Session
     */
    private $_customerSession;


   
    public function __construct(
       
        Session $customerSession
        ){
        $this->_customerSession = $customerSession;
     
    }

    /**
     * @param Observer $observer
     * @return $this|void
     * @throws LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $customerId = $customer->getId();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();
        $customerObj =  $objectManager->get('\Magento\Customer\Model\CustomerFactory')->create()->load($customerId);
        $transport = $objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
      
       $select="SELECT *  from blink_email WHERE customer='Available' LIMIT 1";
       $email= $connection->fetchAll($select);
      
      $sql= "INSERT INTO `customer_entity_varchar` (`value_id`, `attribute_id`, `entity_id`, `value`) VALUES (NULL, '138', $customerId, '".$email[0]['email']."')";
     $connection->query($sql);
     
     $name=$customerObj->getFirstname() . " ".$customerObj->getLastname() ;
     $customerEmail=$customerObj->getEmail();
     $name=$name. ' (' .$customerEmail .')';
     $upd="UPDATE blink_email SET customer='".$name."' WHERE id=".$email[0]['id'];
    $connection->query($upd);
        
     //// Transactional email ///
     
      $templateVars = [
                'customerName' => $customerObj->getFirstname(),
                'user' =>$email[0]['email']
            ];
     
      $emailTemplate =1;
	 $mailto= $customerEmail;
	  $transport = $objectManager->create('Magento\Framework\Mail\Template\TransportBuilder');
	   $data = $transport->setTemplateIdentifier($emailTemplate) ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => \Magento\Store\Model\Store::DEFAULT_STORE_ID])
                ->setTemplateVars($templateVars)
                ->setFrom(['name' => 'blinksignup', 'email' => 'dev@blinksignup.com'])
                ->addto($mailto)
              	->addCc($email[0]['email'])
                ->getTransport();
            $data->sendMessage();

            
        
    }
}
