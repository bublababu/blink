<?php
namespace Blink\Email\Model;

/**
 * Status
 */

class Status
{
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 2;
    
    const MOB_ENABLED = 1;
    const MOB_DISABLED = 0;

    public static function getAvailableStatuses()
    {
        return [
            self::STATUS_ENABLED => __('Enabled')
            , self::STATUS_DISABLED => __('Disabled'),
        ];
    }
    
    public static function getMobileStatuses()
    {
        return [
            self::MOB_DISABLED => __('No')
            , self::MOB_ENABLED => __('Yes'),
        ];
    }
}
