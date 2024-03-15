<?php
namespace Blink\Email\Model;

/**
 * Status
 */

class Store
{

    public static function getAvailableStore()
    {
    
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->create("\Magento\Store\Model\StoreManagerInterface");
        $stores = $storeManager->getStores(true, false);
        $store_arr = array();
        foreach($stores as $store){
            if($store->getId() > 0){
                //$store_arr[$store->getId()] = $store->getName();
                //echo $store->getId()."-".$store->getCode()."-".$store->getName()."<br>";
                $store_arr[] = array('value'=>$store->getCode(),'label'=>$store->getCode());
            }
        }
        return $store_arr;
        
        
    }
}
