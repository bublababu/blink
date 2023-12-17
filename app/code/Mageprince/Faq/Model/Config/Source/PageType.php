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

namespace Mageprince\Faq\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PageType implements OptionSourceInterface
{
    const SCROLL = 'scroll';
    const AJAX = 'ajax';

    /**
     * Get page type
     *
     * @return array
     */
    public function toOptionArray()
    {
        return  [
            ['value' => self::SCROLL, 'label' => 'Scroll'],
            ['value' => self::AJAX, 'label' => 'Ajax']
        ];
    }
}
