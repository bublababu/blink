<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Plugin\Webapi;

class ServiceInputProcessor
{
    public const CUSTOMER_ATTRIBUTES_TYPE = "Magento\Customer\Api\Data\CustomerInterface";

    /**
     * @param \Magento\Framework\Webapi\ServiceInputProcessor $subject
     * @param mixed $data
     * @param string $type Convert given value to the this type
     *
     * @return array|null
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeConvertValue($subject, $data, $type)
    {
        if (!is_array($data) || $type !== self::CUSTOMER_ATTRIBUTES_TYPE) {
            return null;
        }
        $attributeType = ['custom_attributes', 'customAttributes'];
        /* fix fatal error with array value from multiselect attributes*/
        foreach ($attributeType as $name) {
            if (array_key_exists($name, $data) && is_array($data[$name])) {
                foreach ($data[$name] as $key => $attributeValue) {
                    if (is_array($attributeValue)) {
                        if (isset($attributeValue['value']) && is_array($attributeValue['value'])) {
                            $data[$name][$key]['value'] = implode(',', $attributeValue['value']);
                        } elseif (!isset($attributeValue['value'])) {
                            $data[$name][$key] = implode(',', $attributeValue);
                        }
                    }
                }
            }
        }

        return [$data, $type];
    }
}
