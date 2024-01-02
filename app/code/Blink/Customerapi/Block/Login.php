<?php

namespace Blink\Customerapi\Block;

use Magento\Framework\View\Element\Template;

class Login extends Template
{
    private static $coll;
     public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {          
        parent::__construct($context, $data);
    }
    public function setColl($c)
    {        
        self::$coll = $c;     
    }
    public function getCustomdata()
    {
        $coll = self::$coll;
        
        
        return $coll;
    }
}

?>
