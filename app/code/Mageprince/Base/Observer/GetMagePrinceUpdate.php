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
 * @package     Mageprince_Base
 * @copyright   Copyright (c) MagePrince (https://mageprince.com/)
 * @license     https://mageprince.com/end-user-license-agreement
 */

namespace Mageprince\Base\Observer;

use Magento\Backend\Model\Auth\Session;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Mageprince\Base\Helper\Data;
use Mageprince\Base\Model\Feed;

class GetMagePrinceUpdate implements ObserverInterface
{
    /**
     * @var Session
     */
    protected $backendAuthSession;

    /**
     * @var AbstractData
     */
    protected $helper;

    /**
     * GetMagePrinceUpdate constructor.
     *
     * @param Session $backendAuthSession
     * @param Data $helper
     */
    public function __construct(
        Session $backendAuthSession,
        Data $helper
    ) {
        $this->backendAuthSession = $backendAuthSession;
        $this->helper = $helper;
    }

    /**
     * Get updates
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->backendAuthSession->isLoggedIn()
            && $this->helper->isModuleOutputEnabled('Magento_AdminNotification')) {
            /* @var $feedModel Feed */
            $feedModel = $this->helper->createObject(Feed::class);
            $feedModel->checkUpdate();
        }
    }
}
