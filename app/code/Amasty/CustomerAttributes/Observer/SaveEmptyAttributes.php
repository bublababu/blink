<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Observer;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\EntityManager\Operation\AttributePool;
use Magento\Framework\EntityManager\TypeResolver;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Magento does not save custom attributes if they are empty,
 * so we need to implement the saving ourselves.
 * @see \Magento\Eav\Model\Entity\AbstractEntity::_collectSaveData
 */
class SaveEmptyAttributes implements ObserverInterface
{
    /**
     * @var TypeResolver
     */
    private $typeResolver;

    /**
     * @var AttributePool
     */
    private $attributePool;

    /**
     * @var MetadataPool
     */
    private $metadataPool;

    public function __construct(
        TypeResolver $typeResolver,
        AttributePool $attributePool,
        MetadataPool $metadataPool
    ) {
        $this->typeResolver = $typeResolver;
        $this->attributePool = $attributePool;
        $this->metadataPool = $metadataPool;
    }

    public function execute(Observer $observer): void
    {
        /** @var CustomerInterface $customer */
        $customer = $observer->getData('customer');
        if (empty($customer)) {
            return;
        }

        $customAttributes = $customer->getCustomAttributes();
        if (empty($customAttributes)) {
            return;
        }

        try {
            $entityType = $this->typeResolver->resolve($customer);
            $metadata = $this->metadataPool->getMetadata($entityType);
        } catch (\Exception $e) {
            return;
        }

        foreach ($customAttributes as $customAttributeCode => $customAttribute) {
            if ($customAttribute->getValue() !== '') {
                continue;
            }

            $customAttribute->setValue(null);
            try {
                $actions = $this->attributePool->getActions($entityType, 'update');
                foreach ($actions as $action) {
                    $action->execute(
                        $entityType,
                        [
                            $metadata->getLinkField() => $customer->getId(),
                            $customAttributeCode => null,
                        ]
                    );
                }
            } catch (\Exception $e) {
                continue;
            }
        }
    }
}
