<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */
namespace Amasty\CustomerAttributes\Block\Data\Form\Element;

class Note extends \Magento\Framework\Data\Form\Element\Note
{
    /**
     * @return string
     */
    public function getElementHtml()
    {
        $html = $this->getBeforeElementHtml()
            . '<div id="'
            . $this->getHtmlId()
            . '" class="control-value admin__field-value">'
            . $this->getEscapedValue()
            . '</div>'
            . $this->getAfterElementHtml();

        return $html;
    }
}
