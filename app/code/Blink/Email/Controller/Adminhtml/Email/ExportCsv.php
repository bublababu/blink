<?php
namespace Blink\Email\Controller\Adminhtml\Email;

use Magento\Framework\App\Filesystem\DirectoryList;

/**
 * ExportCsv action.
 */

class ExportCsv extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
        $fileName = 'email.csv';
		
        $resultPage = $this->_resultPageFactory->create();
        $content = $resultPage->getLayout()->createBlock('Blink\Email\Block\Adminhtml\Email\Grid')->getCsv();

        return $this->_fileFactory->create($fileName, $content, DirectoryList::VAR_DIR);
    }
}
