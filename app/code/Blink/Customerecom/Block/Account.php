<?php

namespace Blink\Customerecom\Block;

use Magento\Framework\View\Element\Template;

class Account extends Template
{
    private static $coll;
    protected $_curl;
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
         \Magento\Framework\HTTP\Client\Curl $curl,
        array $data = []
    ) {
         $this->_curl = $curl;
        parent::__construct($context, $data);
    }
    public function setColl($c)
    {        
        self::$coll = $c;     
    }
    public function getApidata()
    {
        $coll = self::$coll;
        return $coll;
    }
    
   public function generateRandomString($length = 10) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[random_int(0, $charactersLength - 1)];
                }
                return $randomString;
            }
    
    public function generateQrCode($order) {
        
             $url = $order;
             
             $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $fileSystem = $objectManager->create('\Magento\Framework\Filesystem');
            $mediaPath = $fileSystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)->getAbsolutePath();
           $fname= $this->generateRandomString(10).".png";
            $QR_DIR = $mediaPath.'/qr/img/'.$fname;
            
             $size = '250x250';
            //$content = $url;
            $content = urlencode($url);
            $correction = 'L';
            $encoding = 'UTF-8';
            $filename = $QR_DIR;
        
        
        //Generate QR Code Using Google Api
            $rootUrl = "http://chart.googleapis.com/chart?cht=qr&chs=".$size."&chl=".$content."&choe=".$encoding;
            
            if (function_exists("curl_init")) {
                $this->_curl->setOptions(array(CURLOPT_CONNECTTIMEOUT => 30, CURLOPT_SSL_VERIFYPEER => 0, CURLOPT_RETURNTRANSFER => 1));
                $this->_curl->get($rootUrl);
                $get_image = $this->_curl->getBody();
                $image_to_fetch = $get_image;
                $image_path_qr = $QR_DIR ;
    
                $local_image_file = fopen($image_path_qr, 'w');
                $fp = fwrite($local_image_file, $image_to_fetch);
                fclose($local_image_file);            
            }
            return $fname;
            
        }
    
    
}

?>
