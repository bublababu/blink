<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Plugin\Form;

class Fieldset
{
    protected $formElementMap = [
        'statictext'       => 'Amasty\CustomerAttributes\Block\Data\Form\Element\Note',
        'selectimg'        => 'Amasty\CustomerAttributes\Block\Data\Form\Element\Selectimg',
        'multiselectimg'   => 'Amasty\CustomerAttributes\Block\Data\Form\Element\Multiselectimg'
    ];

    public function aroundAddType($subject, \Closure $proceed, $type, $className)
    {
        $proceed($type, $className);
        foreach ($this->formElementMap as $type => $className) {
            $proceed($type, $className);
        }

        return $subject;
    }
}
