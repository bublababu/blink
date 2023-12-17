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

namespace Mageprince\Faq\Model\Config;

class DefaultConfig
{
    /**
     * Is enabled module config path
     */
    const CONFIG_PATH_IS_ENABLE = 'faqtab/general/enable';

    /**
     * Is enable show group config path
     */
    const CONFIG_PATH_IS_SHOW_GROUP = 'faqtab/design/showgroup';

    /**
     * Is enable show group title
     */
    const CONFIG_PATH_IS_SHOW_GROUP_TITLE = 'faqtab/design/showgrouptitle';

    /**
     * Faq page type config path
     */
    const CONFIG_PATH_PAGE_TYPE = 'faqtab/design/page_type';

    /**
     * Faq url config path
     */
    const FAQ_URL_CONFIG_PATH = 'faqtab/seo/faq_url';

    /**
     * Is faqs collapse expand enabled config path
     */
    const CONFIG_PATH_IS_ENABLED_COLLAPSE_EXPAND = 'faqtab/design/is_collapse_expand';
}
