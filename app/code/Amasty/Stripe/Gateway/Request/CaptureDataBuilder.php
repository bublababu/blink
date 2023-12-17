<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Gateway\Request;

use Magento\Payment\Gateway\Request\BuilderInterface;

/**
 * Data Builder for Capture
 */
class CaptureDataBuilder implements BuilderInterface
{
    public const CAPTURE = 'capture';

    /**
     * @param array $buildSubject
     *
     * @return array
     */
    public function build(array $buildSubject)
    {
        return [
            self::CAPTURE => true,
        ];
    }
}
