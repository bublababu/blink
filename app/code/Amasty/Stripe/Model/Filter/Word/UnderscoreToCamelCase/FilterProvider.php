<?php

declare(strict_types=1);

/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Model\Filter\Word\UnderscoreToCamelCase;

use Laminas\Filter\FilterInterface;
use Magento\Framework\ObjectManagerInterface;

class FilterProvider
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var array
     */
    private $filters;

    public function __construct(
        ObjectManagerInterface $objectManager,
        array $filters = []
    ) {
        $this->objectManager = $objectManager;
        $this->filters = $filters;
    }

    /**
     * @return FilterInterface
     * @throws \InvalidArgumentException
     */
    public function get()
    {
        foreach ($this->filters as $filter) {
            if (class_exists($filter)) {
                $existingFilter = $this->objectManager->get($filter);
                break;
            }
        }
        if (empty($existingFilter)) {
            throw new \InvalidArgumentException(
                (string) __('Implementation of the "Underscore To Camel Case" filter was not found.')
            );
        }

        return $existingFilter;
    }
}
