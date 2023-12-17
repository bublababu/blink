<?php
/**
 * @author Amasty Team
 * @copyright Copyright (c) Amasty (https://www.amasty.com)
 * @package Customer Attributes Base for Magento 2
 */

namespace Amasty\CustomerAttributes\Api\Data;

interface RelationInterface
{
    /**#@+
     * Constants defined for keys of data array
     */
    public const RELATION_ID = 'relation_id';

    public const NAME = 'name';
    /**#@-*/

    /**
     * Returns Relation ID
     *
     * @return int
     */
    public function getRelationId();

    /**
     * @param int $relationId
     *
     * @return $this
     */
    public function setRelationId($relationId);

    /**
     * Returns Relation name
     *
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @return \Amasty\CustomerAttributes\Api\Data\RelationDetailInterface[]
     */
    public function getDetails();

    /**
     * @param \Amasty\CustomerAttributes\Api\Data\RelationDetailInterface[] $relationDetails
     *
     * @return $this
     */
    public function setDetails($relationDetails);
}
