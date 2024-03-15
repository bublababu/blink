<?php
namespace Blink\Email\Controller\Adminhtml\Email;

/**
 * Index action.
 */

class Index extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        
      
        if ($this->getRequest()->getQuery('ajax')) {
            
            $resultForward = $this->_resultForwardFactory->create();
            $resultForward->forward('grid');

            return $resultForward;
        }

        $resultPage = $this->_resultPageFactory->create();

        $this->_addBreadcrumb(__('Email'), __('Email'));
        $this->_addBreadcrumb(__('Manage Email'), __('Manage Email'));

        return $resultPage;
    }
}
