<?php

namespace Blink\Email\Controller\Adminhtml;


abstract class Email extends \Blink\Email\Controller\Adminhtml\AbstractAction
{
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Blink_Email::email_email');
    }
}
