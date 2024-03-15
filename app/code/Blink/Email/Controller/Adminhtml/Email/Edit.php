<?php
namespace Blink\Email\Controller\Adminhtml\Email;

/**
 * Edit Banner action.
 */

class Edit extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        
       
        $id = $this->getRequest()->getParam('id');
        $storeViewId = $this->getRequest()->getParam('store');
        $model = $this->_emailFactory->create();

        if ($id) {
            $model->setStoreViewId($storeViewId)->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This Email no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $data = $this->_getSession()->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        $this->_coreRegistry->register('email', $model);

        $resultPage = $this->_resultPageFactory->create();

        return $resultPage;
    }
}
