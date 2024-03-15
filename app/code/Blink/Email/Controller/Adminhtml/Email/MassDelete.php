<?php
namespace Blink\Email\Controller\Adminhtml\Email;

/**
 * MassDelete action.
 */

class MassDelete extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        $Ids = $this->getRequest()->getParam('email');
        
       // print_r($this->getRequest()->getPostValue()); exit;
        if (!is_array($Ids) || empty($Ids)) {
            $this->messageManager->addError(__('Please select Email(s).'));
        } else {
            $emailCollection = $this->_emailCollectionFactory->create()
                ->addFieldToFilter('id', ['in' => $Ids]);
            try {
                foreach ($emailCollection as $banner) {
                    $banner->delete();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been deleted.', count($Ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/');
    }
}
