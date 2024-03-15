<?php
namespace Blink\Email\Block\Adminhtml;

/**
 * Banner grid container.
 */

class Email extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_email';
        $this->_blockGroup = 'Blink_Email';
        $this->_headerText = __('Email');
        $this->_addButtonLabel = __('Add New Email');
        parent::_construct();
    }
}
