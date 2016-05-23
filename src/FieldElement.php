<?php
/**
 * Code written is strictly used within this program.
 * Any other use of this code is in violation of copy rights.
 *
 * @package   Components
 * @author    Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright 2016 Developer
 * @license   - No License
 * @version   GIT: $Id$
 * @link      -
 */
namespace Bridge\Components\Exporter;

/**
 * FieldElement class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class FieldElement implements \Bridge\Components\Exporter\Contracts\FieldElementInterface
{

    /**
     * Get data constraints array property.
     *
     * @return array
     */
    public function getConstraints()
    {
        # TODO: Implement getConstraints() method.
    }

    /**
     * Get field name property.
     *
     * @return string
     */
    public function getName()
    {
        # TODO: Implement getName() method.
    }

    /**
     * Set field as primary key.
     *
     * @param boolean $isPrimaryKey Primary key option parameter.
     *
     * @return void
     */
    public function setAsPrimaryKey($isPrimaryKey = true)
    {
        # TODO: Implement setAsPrimaryKey() method.
    }

    /**
     * Set field default value.
     *
     * @param string $defaultValue Default value parameter.
     *
     * @return void
     */
    public function setDefaultValue($defaultValue = '')
    {
        # TODO: Implement setDefaultValue() method.
    }

    /**
     * Set field dependency.
     *
     * @param \Bridge\Components\Exporter\Contracts\TableEntityInterface $dependencyTable     Dependency table object
     *                                                                                        parameter.
     * @param string                                                     $dependencyFieldName Dependency field name
     *                                                                                        parameter.
     *
     * @return void
     */
    public function setDependency(
        \Bridge\Components\Exporter\Contracts\TableEntityInterface $dependencyTable,
        $dependencyFieldName
    ) {
        # TODO: Implement setDependency() method.
    }

    /**
     * Set field enum data property.
     *
     * @param array $enumData Enum data array parameter.
     *
     * @return void
     */
    public function setEnum(array $enumData)
    {
        # TODO: Implement setEnum() method.
    }

    /**
     * Set field basic information property.
     *
     * @param integer $fieldType   Field type parameter.
     * @param integer $fieldLength Field length parameter.
     *
     * @return void
     */
    public function setField($fieldType, $fieldLength)
    {
        # TODO: Implement setField() method.
    }

    /**
     * Set field length property.
     *
     * @param integer $fieldLength Field length parameter.
     *
     * @return void
     */
    public function setFieldLength($fieldLength)
    {
        # TODO: Implement setFieldLength() method.
    }

    /**
     * Set field type property.
     *
     * @param integer $fieldType Field type parameter.
     *
     * @return void
     */
    public function setFieldType($fieldType)
    {
        # TODO: Implement setFieldType() method.
    }

    /**
     * Set field is required (mandatory) or not.
     *
     * @param boolean $isRequired Required option parameter.
     *
     * @return void
     */
    public function setRequired($isRequired = true)
    {
        # TODO: Implement setRequired() method.
    }
}
