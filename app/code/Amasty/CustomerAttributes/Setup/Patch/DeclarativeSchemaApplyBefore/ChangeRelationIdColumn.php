<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Setup\Patch\DeclarativeSchemaApplyBefore;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\PatchInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class ChangeRelationIdColumn implements PatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup)
    {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply(): void
    {
        $relationTableName = $this->moduleDataSetup->getTable('amasty_customer_attributes_relation');
        $detailsTableName = $this->moduleDataSetup->getTable('amasty_customer_attributes_details');
        
        /** @var AdapterInterface $adapter */
        $adapter = $this->moduleDataSetup->getConnection();

        if ($adapter->isTableExists($relationTableName) && $adapter->tableColumnExists($relationTableName, 'id')) {
            $oldFkName = $adapter->getForeignKeyName(
                $detailsTableName,
                'relation_id',
                $relationTableName,
                'id'
            );
            $adapter->dropForeignKey($detailsTableName, $oldFkName);
            $adapter->changeColumn(
                $relationTableName,
                'id',
                'relation_id',
                [
                    'IDENTITY' => true,
                    'UNSIGNED' => true,
                    'NULLABLE' => false,
                    'PRIMARY'  => true,
                    'TYPE'     => Table::TYPE_INTEGER,
                    'COMMENT' => 'Relation Id'
                ]
            );
            $adapter->addForeignKey(
                $adapter->getForeignKeyName(
                    $detailsTableName,
                    'relation_id',
                    $relationTableName,
                    'relation_id'
                ),
                $detailsTableName,
                'relation_id',
                $relationTableName,
                'relation_id',
                Table::ACTION_CASCADE
            );
        }
    }

    /**
     * @return array
     */
    public function getAliases(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public static function getDependencies(): array
    {
        return [];
    }
}
