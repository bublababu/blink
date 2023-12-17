<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Controller\Adminhtml\Relation;

class NewAction extends \Amasty\CustomerAttributes\Controller\Adminhtml\Relation
{
    /**
     * @return void
     */
    public function execute()
    {
        return $this->_forward('edit');
    }
}
