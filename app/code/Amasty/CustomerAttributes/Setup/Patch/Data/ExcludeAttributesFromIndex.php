<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Setup\Patch\Data;

use Magento\Customer\Api\Data\AttributeMetadataInterface;
use Magento\Customer\Model\ResourceModel\Attribute\CollectionFactory;
use Magento\Eav\Api\Data\AttributeInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class ExcludeAttributesFromIndex implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    public function __construct(ModuleDataSetupInterface $moduleDataSetup, CollectionFactory $collectionFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return void
     */
    public function apply(): void
    {
        $collection = $this->collectionFactory->create();
        $attributeIds = $collection
            ->addFieldToFilter(AttributeInterface::IS_USER_DEFINED, ['eq' => 1])
            ->addFieldToFilter(AttributeInterface::ATTRIBUTE_CODE, ['neq' => 'customer_activated'])
            ->getAllIds();
        if (!empty($attributeIds)) {
            $this->moduleDataSetup->getConnection()->update(
                $this->moduleDataSetup->getTable('customer_eav_attribute'),
                [AttributeMetadataInterface::IS_SEARCHABLE_IN_GRID => 0],
                'attribute_id IN(' . implode(',', $attributeIds) . ')'
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
