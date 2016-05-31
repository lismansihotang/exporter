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
 * TableEntity class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class TableEntity implements \Bridge\Components\Exporter\Contracts\TableEntityInterface
{

    /**
     * Fields data property.
     *
     * @var array $Fields
     */
    private $Fields;

    /**
     * Table name property.
     *
     * @var string $Name
     */
    private $Name;

    /**
     * TableEntity constructor.
     *
     * @param string $tableName Table name parameter.
     */
    public function __construct($tableName)
    {
        $this->setName($tableName);
    }

    /**
     * Add field element object into fields collection property
     *
     * @param \Bridge\Components\Exporter\Contracts\FieldElementInterface $fieldElementObject Field element object
     *                                                                                        parameter.
     *
     * @return void
     */
    public function addField(\Bridge\Components\Exporter\Contracts\FieldElementInterface $fieldElementObject)
    {
        $this->Fields[$fieldElementObject->getFieldName()] = $fieldElementObject;
    }

    /**
     * Get selected field property.
     *
     * @param string $fieldName Field name parameter.
     *
     * @return \Bridge\Components\Exporter\Contracts\FieldElementInterface
     */
    public function getField($fieldName)
    {
        if (array_key_exists($fieldName, $this->Fields) === true) {
            return $this->Fields[$fieldName];
        }
        return null;
    }

    /**
     * Get fields collection information.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->Fields;
    }

    /**
     * Get table name property.
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set fields collection property.
     *
     * @param array $fields Field elements data array collection parameter.
     *
     * @return void
     */
    public function setFields(array $fields)
    {
        foreach ($fields as $field) {
            if ($fields instanceof \Bridge\Components\Exporter\Contracts\FieldElementInterface) {
                $this->addField($field);
            }
        }
    }

    /**
     * Set table name property.
     *
     * @param string $tableName Table name parameter.
     *
     * @return void
     */
    public function setName($tableName)
    {
        $this->Name = $tableName;
    }
}
