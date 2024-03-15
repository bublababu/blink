<?php
namespace Blink\Email\Controller\Adminhtml\Email;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * Save Banner action.
 */

class Save extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        $resultRedirect = $this->_resultRedirectFactory->create();

        if ($data = $this->getRequest()->getPostValue()) {
            
            
	    
	    $model = $this->_emailFactory->create();
            $storeViewId = $this->getRequest()->getParam('store');

            //if ($id = $this->getRequest()->getParam('id')) {
            //    $model->load($id);
            //}

            try {
                
               $pre=$data['email'];
               $suf=$data['pass'];
		for($i=0;$i<=9;$i++){
	//	$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
   
       $data['email']=$pre.".".$suf.$i.rand(10,100).'@blinksignup.com';
       $data['pass']="Password@123";
		$model->setData($data)
                  ->setStoreViewId($storeViewId);
                $model->save();
        }      
           
                $this->messageManager->addSuccess(__('The Email has been saved.'));
                $this->_getSession()->setFormData(false);

                if ($this->getRequest()->getParam('back') === 'edit') {
                    return $resultRedirect->setPath(
                        '*/*/edit',
                        [
                            'id' => $model->getId(),
                            '_current' => true,
                            'store' => $storeViewId,
                            'saveandclose' => $this->getRequest()->getParam('saveandclose'),
                        ]
                    );
                } elseif ($this->getRequest()->getParam('back') === 'new') {
                    return $resultRedirect->setPath(
                        '*/*/new',
                        ['_current' => TRUE]
                    );
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                $this->messageManager->addException($e, __('Something went wrong while saving the banner.'));
            }

            $this->_getSession()->setFormData($data);

            return $resultRedirect->setPath(
                '*/*/edit',
                ['id' => $this->getRequest()->getParam('id')]
            );
        }

        return $resultRedirect->setPath('*/*/');
    }
}
