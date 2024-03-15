<?php
namespace Blink\Email\Block\Adminhtml\Email\Edit;

/**
 * Banner Tabs.
 */

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{
    protected function _construct()
    {
        parent::_construct();
        $this->setId('email_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(__('Email Information'));
    }
}
