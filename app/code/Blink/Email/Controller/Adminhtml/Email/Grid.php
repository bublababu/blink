<?php

namespace Blink\Email\Controller\Adminhtml\Email;

/**
 * Grid action.
 */

class Grid extends \Blink\Email\Controller\Adminhtml\Email
{
    public function execute()
    {
	
        $resultLayout = $this->_resultLayoutFactory->create();
        return $resultLayout;
    }
}
