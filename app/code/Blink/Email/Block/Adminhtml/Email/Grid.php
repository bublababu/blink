<?php

namespace Blink\Email\Block\Adminhtml\Email;

use Blink\Email\Model\Status;

/**
 * Banner grid.
 */

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_emailCollectionFactory;
	
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Blink\Email\Model\ResourceModel\Email\CollectionFactory $emailCollectionFactory,
        array $data = []
    ) {
         $this->_emailCollectionFactory = $emailCollectionFactory;

        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('emailGrid');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $storeViewId = $this->getRequest()->getParam('store');

        $collection = $this->_emailCollectionFactory->create()->setStoreViewId($storeViewId);
	
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
		$this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id',
            ]
        );
        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'index' => 'email',
                'class' => '',
            ]
        );
		 $this->addColumn(
            'pass',
            [
                'header' => __('Password'),
                'index' => 'pass',
                'class' => '',
            ]
        );
	
	
		
		$this->addColumn(
            'customer',
            [
                'header' => __('Customer'),
                'index' => 'customer',
                'class' => 'xxx',
                'width' => '20px',
            ]
        );
        
		
        
        //$this->addColumn(
        //    'status',
        //    [
        //        'header' => __('Status'),
        //        'index' => 'status',
        //        'type' => 'options',
        //        'options' => Status::getAvailableStatuses(),
        //    ]
        //);
	
        //$this->addColumn(
        //    'edit',
        //    [
        //        'header' => __('Edit'),
        //        'type' => 'action',
        //        'getter' => 'getId',
        //        'actions' => [
        //            [
        //                'caption' => __('Edit'),
        //                'url' => ['base' => '*/*/edit'],
        //                'field' => 'id',
        //            ],
        //        ],
        //        'filter' => false,
        //        'sortable' => false,
        //        'index' => 'stores',
        //        'header_css_class' => 'col-action',
        //        'column_css_class' => 'col-action',
        //    ]
        //);
        $this->addExportType('*/*/exportCsv', __('CSV'));
       // $this->addExportType('*/*/exportXml', __('XML'));
       // $this->addExportType('*/*/exportExcel', __('Excel'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('email');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('email/*/massDelete'),
                'confirm' => __('Are you sure?'),
            ]
        );

        $statuses = Status::getAvailableStatuses();

        array_unshift($statuses, ['label' => '', 'value' => '']);
        //$this->getMassactionBlock()->addItem(
        //    'status',
        //    [
        //        'label' => __('Change status'),
        //        'url' => $this->getUrl('email/*/massStatus', ['_current' => true]),
        //        'additional' => [
        //            'visibility' => [
        //                'name' => 'status',
        //                'type' => 'select',
        //                'class' => 'required-entry',
        //                'label' => __('Status'),
        //                'values' => $statuses,
        //            ],
        //        ],
        //    ]
        //);

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', ['_current' => true]);
    }

    public function getRowUrl($row)
    {
        return $this->getUrl(
            '*/*/edit',
            ['id' => $row->getId()]
        );
    }
}
