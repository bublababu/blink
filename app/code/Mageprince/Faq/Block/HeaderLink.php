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

namespace Mageprince\Faq\Block;

use Magento\Framework\View\Element\Html\Link;
use Magento\Store\Model\ScopeInterface;

class HeaderLink extends Link
{
    public function _toHtml()
    {
        $isEnable = $this->_scopeConfig->isSetFlag(
            'faqtab/general/enable',
            ScopeInterface::SCOPE_STORE
        );
        $isHeaderLinkEnable = $this->_scopeConfig->isSetFlag(
            'faqtab/design/headerlink',
            ScopeInterface::SCOPE_STORE
        );
        if (!$isEnable || !$isHeaderLinkEnable) {
            return '';
        }
        return parent::_toHtml();
    }
}
