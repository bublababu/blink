<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */
namespace Amasty\CustomerAttributes\Controller\Adminhtml\Attribute;

class Index extends \Amasty\CustomerAttributes\Controller\Adminhtml\Attribute
{
    /**
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->createActionPage();
        $resultPage->addContent(
            $resultPage->getLayout()->createBlock('Amasty\CustomerAttributes\Block\Adminhtml\Customer\Attribute')
        );
        return $resultPage;
    }
}
