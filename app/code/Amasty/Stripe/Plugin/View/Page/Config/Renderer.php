<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Plugin\View\Page\Config;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\View\Asset\File;
use Magento\Framework\View\Page\Config\Renderer as MagentoRenderer;
use Magento\Framework\View\Page\Config;

class Renderer
{
    public const CACHE_KEY = 'amasty_stripe_should_load_css';

    /**
     * @var string[]
     */
    protected $filesToCheck = ['css/styles-l.css', 'css/styles-m.css'];

    /**
     * @var Config
     */
    private $config;

    /**
     * @var CacheInterface
     */
    private $cache;

    public function __construct(
        Config $config,
        CacheInterface $cache
    ) {
        $this->config = $config;
        $this->cache = $cache;
    }

    /**
     * @param MagentoRenderer $subject
     * @param array $resultGroups
     * @return array
     */
    public function beforeRenderAssets(
        MagentoRenderer $subject,
        $resultGroups = []
    ) {
        $shouldLoad = $this->cache->load(self::CACHE_KEY);

        if ($shouldLoad === false) {
            $shouldLoad = $this->isShouldLoadCss();
            $this->cache->save($shouldLoad, self::CACHE_KEY);
        }

        if ($shouldLoad) {
            $this->config->addPageAsset('Amasty_Stripe::css/source/mkcss/amstripe.css');
        }

        return [$resultGroups];
    }

    /**
     * @return int
     */
    private function isShouldLoadCss()
    {
        $collection = $this->config->getAssetCollection();
        $found = 0;
        foreach ($collection->getAll() as $item) {
            /** @var File $item */
            if ($item instanceof File
                && in_array($item->getFilePath(), $this->filesToCheck)
            ) {
                $found++;
            }
        }

        return (int)($found < count($this->filesToCheck));
    }
}
