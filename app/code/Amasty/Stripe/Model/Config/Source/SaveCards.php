<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * Save Card In Config Field Data
 */
class SaveCards implements ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [['value' => 0, 'label' => __('Disabled')], ['value' => 1, 'label' => __('Ask the customer')]];
    }
}
