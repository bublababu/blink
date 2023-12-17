<?php
/**
 * MagePrince
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the mageprince.com license that is
 * available through the world-wide-web at this URL:
 * https://mageprince.com/end-user-license-agreement
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MagePrince
 * @package     Mageprince_Faq
 * @copyright   Copyright (c) MagePrince (https://mageprince.com/)
 * @license     https://mageprince.com/end-user-license-agreement
 */

namespace Mageprince\Faq\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Theme\Block\Html\Title as HtmlTitle;
use Mageprince\Faq\Helper\Data;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Index constructor.
     * @param Context $context
     * @param Data $helper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Data $helper,
        PageFactory $resultPageFactory
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        if ($this->helper->getConfig('faqtab/general/enable')) {
            $pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title');
            $pageTitle = $this->helper->getConfig('faqtab/general/page_title');

            if ($pageMainTitle && $pageMainTitle instanceof HtmlTitle) {
                $pageMainTitle->setPageTitle($pageTitle);
            }

            $metaTitleConfig = $this->helper->getConfig('faqtab/seo/meta_title');
            $metaKeywordsConfig = $this->helper->getConfig('faqtab/seo/meta_keywords');
            $metaDescriptionConfig = $this->helper->getConfig('faqtab/seo/meta_description');

            $resultPage->getConfig()->getTitle()->set($metaTitleConfig);
            $resultPage->getConfig()->setDescription($metaDescriptionConfig);
            $resultPage->getConfig()->setKeywords($metaKeywordsConfig);
        }
        return $resultPage;
    }
}
