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

use Magento\Backend\Model\Auth\Session as BackendSession;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Mageprince\Base\Helper\Validate;

class GetMagePrinceModuleUpdate implements ObserverInterface
{
    /**
     * @var BackendSession
     */
    protected $backendSession;

    /**
     * @var Validate
     */
    protected $helper;

    /**
     * GetMagePrinceModuleUpdate constructor.
     *
     * @param Validate $helper
     * @param BackendSession $backendSession
     */
    public function __construct(
        Validate $helper,
        BackendSession $backendSession
    ) {
        $this->helper = $helper;
        $this->backendSession = $backendSession;
    }

    /**
     * Get module updates
     *
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if ($this->backendSession->isLoggedIn() && $this->helper->checkIsAllowed()) {
            $this->helper->validateModule();
        }
    }
}
