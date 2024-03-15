<?php
namespace Blink\Email\Block\Adminhtml\Email\Edit\Tab;

use Blink\Email\Model\Status;
use Blink\Email\Model\Store;

/**
 * Banner Edit tab.
 */

class Email extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    protected $_objectFactory;

    protected $_email;
    
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\DataObjectFactory $objectFactory,
        \Blink\Email\Model\Email $email,
        array $data = []
    ) {
        $this->_objectFactory = $objectFactory;
        $this->_email = $email;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareLayout()
    {
        $this->getLayout()->getBlock('page.title')->setPageTitle($this->getPageTitle());

        \Magento\Framework\Data\Form::setFieldsetElementRenderer(
            $this->getLayout()->createBlock(
                'Blink\Email\Block\Adminhtml\Form\Renderer\Fieldset\Element',
                $this->getNameInLayout().'_fieldset_element'
            )
        );

        return $this;
    }

    protected function _prepareForm()
    {
	$emailAttributes = $this->_email->getStoreAttributes();
        $emailAttributesInStores = ['store_id' => ''];

        foreach ($emailAttributes as $emailAttribute) {
            $emailAttributesInStores[$emailAttribute.'_in_store'] = '';
        }

        $dataObj = $this->_objectFactory->create(
            ['data' => $emailAttributesInStores]
        );
        $model = $this->_coreRegistry->registry('email');

        $dataObj->addData($model->getData());

        $storeViewId = $this->getRequest()->getParam('store');
		
        $form = $this->_formFactory->create();
		
        $form->setHtmlIdPrefix($this->_email->getFormFieldHtmlIdPrefix());
		
        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Email Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $elements = [];
        $elements['email'] = $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Prefix'),
                'title' => __('Prefix'),
                'required' => true,
            ]
        );
		
	 
	 
	 $elements['pass'] = $fieldset->addField(
            'pass',
            'text',
            [
                'name' => 'pass',
                'label' => __('Sufix'),
                'title' => __('Sufix'),
                'required' => false,
            ]
        );
	
		
        //$elements['status'] = $fieldset->addField(
        //    'status',
        //    'select',
        //    [
        //        'label' => __('Status'),
        //        'title' => __('Status'),
        //        'name' => 'status',
        //        'options' => Status::getAvailableStatuses(),
        //    ]
        //);

        $form->addValues($dataObj->getData());
        $this->setForm($form);
    }     
        
    public function getEmail()
        {
            return $this->_coreRegistry->registry('email');
        }

    public function getPageTitle()
    {
        return 'NEW Email';
    }

    public function getTabLabel()
    {
        return __('Email Information');
    }

    public function getTabTitle()
    {
        return __('Email Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
