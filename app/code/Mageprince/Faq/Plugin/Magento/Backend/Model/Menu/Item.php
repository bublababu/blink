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

namespace Mageprince\Faq\Plugin\Magento\Backend\Model\Menu;

class Item
{
    /**
     * @param $subject
     * @param $result
     * @return string
     */
    public function afterGetUrl($subject, $result)
    {
        $menuId = $subject->getId();

        if ($menuId == 'Mageprince_Faq::faq_user_guid') {
            $result = 'https://marketplace.magento.com/media/catalog/product/prince-module-faq-2-0-10-ce/user_guides.pdf';
        }

        return $result;
    }
}
