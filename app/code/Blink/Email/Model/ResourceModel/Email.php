<?php
namespace Blink\Email\Model\ResourceModel;

/**
 * Banner Resource Model
 */

class Email extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('blink_email', 'id');
    }
}
