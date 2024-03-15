<?php
namespace Blink\Email\Controller\Adminhtml\Email;

/**
 * New Banner action.
 */

class NewAction extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        $resultForward = $this->_resultForwardFactory->create();

        return $resultForward->forward('edit');
    }
}
