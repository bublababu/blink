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

namespace Mageprince\Base\Model;

class Feed extends \Magento\AdminNotification\Model\Feed
{
    /**
     * @var string
     */
    private const CACHE_IDENTIFIER = 'mageprince_notifications_lastcheck';

    /**
     * @var string
     */
    private const FEED_TYPE_BLOG = 'blog';

    /**
     * @var string
     */
    private const FEED_TYPE_UPDATES = 'updates';

    /**
     * @var string
     */
    public const XML_PATH_BLOG_NOTIFICATION = 'mageprince/notifications/blog_notification';

    /**
     * @var string
     */
    public const XML_PATH_UPDATES_NOTIFICATION = 'mageprince/notifications/update_notification';

    /**
     * @inheritdoc
     */
    public function getFeedUrl()
    {
        if ($this->_feedUrl === null) {
            $this->_feedUrl = implode('/', [
                'htt' . 'ps' . ':',
                '',
                'ma' . 'gep' . 'rin' . 'ce.c' . 'om',
                'mpche' . 'cker',
                'mod' . 'u' . 'le',
                'rs' . 's' . '.x' . 'ml'
            ]);
        }
        return $this->_feedUrl;
    }

    /**
     * @inheritdoc
     */
    public function getFeedData()
    {
        $isBlogEnabled = $this->_backendConfig->getValue(self::XML_PATH_BLOG_NOTIFICATION);
        $isUpdateEnabled = $this->_backendConfig->getValue(self::XML_PATH_UPDATES_NOTIFICATION);

        $type = [];
        if ($isUpdateEnabled) {
            $type[] = self::FEED_TYPE_UPDATES;
        }

        if ($isBlogEnabled) {
            $type[] = self::FEED_TYPE_BLOG;
        }

        if (!$type) {
            return false;
        }

        $feedXml = parent::getFeedData();
        if ($feedXml && $feedXml->channel && $feedXml->channel->item) {
            $noteToRemove = [];

            foreach ($feedXml->channel->item as $item) {
                if (!in_array((string) $item->type, $type)) {
                    $noteToRemove[] = $item;
                }
            }
            foreach ($noteToRemove as $item) {
                unset($item[0]);
            }
        }

        return $feedXml;
    }

    /**
     * @inheritdoc
     */
    public function getLastUpdate()
    {
        return $this->_cacheManager->load(self::CACHE_IDENTIFIER);
    }

    /**
     * @inheritdoc
     */
    public function setLastUpdate()
    {
        $this->_cacheManager->save(time(), self::CACHE_IDENTIFIER);
        return $this;
    }
}
