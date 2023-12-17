<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package App for Payments with Stripe for Magento 2
 */

namespace Amasty\Stripe\Api\Data;

interface CustomerInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    public const ENTITY_ID = 'entity_id';
    public const CUSTOMER_ID = 'customer_id';
    public const STRIPE_CUSTOMER_ID = 'stripe_customer_id';
    public const STRIPE_ACCOUNT_ID = 'stripe_account_id';
    /**#@-*/

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @param int $entityId
     *
     * @return \Amasty\Stripe\Api\Data\CustomerInterface
     */
    public function setEntityId($entityId);

    /**
     * @return int
     */
    public function getCustomerId();

    /**
     * @param int $customerId
     *
     * @return \Amasty\Stripe\Api\Data\CustomerInterface
     */
    public function setCustomerId($customerId);

    /**
     * @return string|null
     */
    public function getStripeCustomerId();

    /**
     * @param string|null $stripeCustomerId
     *
     * @return \Amasty\Stripe\Api\Data\CustomerInterface
     */
    public function setStripeCustomerId($stripeCustomerId);

    /**
     * @return string|null
     */
    public function getStripeAccountId();

    /**
     * @param string|null $stripeCustomerId
     *
     * @return \Amasty\Stripe\Api\Data\CustomerInterface
     */
    public function setAccountCustomerId($stripeCustomerId);
}
