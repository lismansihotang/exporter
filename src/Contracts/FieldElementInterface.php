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
     * Enumeration field type.
     *
     * @constant integer FIELD_TYPE_ENUM
     */
    const FIELD_TYPE_ENUM = 0;

    /**
     * String field type.
     *
     * @constant integer FIELD_TYPE_STRING
     */
    const FIELD_TYPE_STRING = 1;

    /**
     * Number field type.
     *
     * @constant integer FIELD_TYPE_NUMBER
     */
    const FIELD_TYPE_NUMBER = 2;

    /**
     * Date field type.
     *
     * @constant integer FIELD_TYPE_DATE
     */
    const FIELD_TYPE_DATE = 3;

    /**
     * Character field type.
     *
     * @constant string FIELD_TYPE_CHAR
     */
    const FIELD_TYPE_CHAR = 4;

    /**
     * Get data constraints array property.
     *
     * @return array
     */
    public function getConstraints();

    /**
     * Get the field name property.
     *
     * @return string
     */
    public function getFieldName();

    /**
     * Get field type constraints data property.
     *
     * @return array
     */
    public static function getFieldTypeConstraints();

    /**
     * Get primary key state property.
     *
     * @return boolean
     */
    public function isPrimaryKey();

    /**
     * Get the field required constraint.
     *
     * @return boolean
     */
    public function isRequired();
}
