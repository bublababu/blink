<?php
namespace Blink\Email\Controller\Adminhtml\Email;

/**
 * MassStatus Change action.
 */

class MassStatus extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        $Ids = $this->getRequest()->getParam('email');
        $status = $this->getRequest()->getParam('status');
        $storeViewId = $this->getRequest()->getParam('store');

        if (!is_array($Ids) || empty($Ids)) {
            $this->messageManager->addError(__('Please select email(s).'));
        } else {
            $bannerCollection =  $this->_bannerCollectionFactory->create()
                ->setStoreViewId($storeViewId)
                ->addFieldToFilter('id', ['in' => $Ids]);
            try {
                foreach ($bannerCollection as $banner) {
                    $banner->setStoreViewId($storeViewId)
                        ->setStatus($status)
                        ->setIsMassupdate(true)
                        ->save();
                }
                $this->messageManager->addSuccess(
                    __('A total of %1 record(s) have been changed status.', count($Ids))
                );
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }
        }
        $resultRedirect = $this->_resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/', ['store' => $this->getRequest()->getParam('store')]);
    }
}
