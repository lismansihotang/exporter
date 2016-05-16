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
namespace Bridge\Components\Exporter\Contracts;

/**
 * FieldElementInterface class description.
 *
 * @package    Components
 * @subpackage Exporter\Contracts
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
interface FieldElementInterface
{

    /**
     * Get data constraints array property.
     *
     * @return array
     */
    public function getConstraints();

    /**
     * Get field name property.
     *
     * @return string
     */
    public function getName();

    /**
     * Set field as primary key.
     *
     * @param boolean $isPrimaryKey Primary key option parameter.
     *
     * @return void
     */
    public function setAsPrimaryKey($isPrimaryKey = true);

    /**
     * Set field default value.
     *
     * @param string $defaultValue Default value parameter.
     *
     * @return void
     */
    public function setDefaultValue($defaultValue = '');

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
    );

    /**
     * Set field enum data property.
     *
     * @param array $enumData Enum data array parameter.
     *
     * @return void
     */
    public function setEnum(array $enumData);

    /**
     * Set field basic information property.
     *
     * @param integer $fieldType   Field type parameter.
     * @param integer $fieldLength Field length parameter.
     *
     * @return void
     */
    public function setField($fieldType, $fieldLength);

    /**
     * Set field length property.
     *
     * @param integer $fieldLength Field length parameter.
     *
     * @return void
     */
    public function setFieldLength($fieldLength);

    /**
     * Set field type property.
     *
     * @param integer $fieldType Field type parameter.
     *
     * @return void
     */
    public function setFieldType($fieldType);

    /**
     * Set field is required (mandatory) or not.
     *
     * @param boolean $isRequired Required option parameter.
     *
     * @return void
     */
    public function setRequired($isRequired = true);
}
