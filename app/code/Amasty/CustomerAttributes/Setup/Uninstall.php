<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UninstallInterface;

class Uninstall implements UninstallInterface
{
    /**
     * @var string[]
     */
    private $tableNames = [
        'amasty_customer_attributes_relation',
        'amasty_customer_attributes_details',
        'amasty_customer_attributes_guest',
        'amasty_customer_attributes_relation_grid'
    ];

    /**
     * @var string[]
     */
    private $eavAttributeColumns = [
        'used_in_product_listing',
        'store_ids',
        'sorting_order',
        'is_visible_on_front',
        'type_internal',
        'on_order_view',
        'on_registration',
        'is_read_only',
        'used_in_order_grid',
        'file_size',
        'file_types',
        'file_dimensions',
        'account_filled',
        'billing_filled',
        'required_on_front'
    ];
    
    /**
     * @param SchemaSetupInterface $installer
     * @param ModuleContextInterface $context
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function uninstall(SchemaSetupInterface $installer, ModuleContextInterface $context): void
    {
        $installer->startSetup();
        
        foreach ($this->tableNames as $tableName) {
            $installer->getConnection()->dropTable($installer->getTable($tableName));
        }
        
        $installer->getConnection()->dropColumn($installer->getTable('eav_attribute_option'), 'group_id');

        foreach ($this->eavAttributeColumns as $columnName) {
            $installer->getConnection()->dropColumn($installer->getTable('customer_eav_attribute'), $columnName);
        }
        
        $installer->endSetup();
    }
}
