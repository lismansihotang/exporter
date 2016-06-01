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
 * AbstractEntity class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
abstract class AbstractEntity implements \Bridge\Components\Exporter\Contracts\EntityInterface
{

    /**
     * Entity data array property.
     *
     * @var array $Data
     */
    private $Data;

    /**
     * Fields data property.
     *
     * @var array $Fields
     */
    private $Fields;

    /**
     * Entity name property.
     *
     * @var string $Name
     */
    private $Name;

    /**
     * AbstractEntity constructor.
     *
     * @param string $entityName Entity name parameter.
     */
    public function __construct($entityName)
    {
        $this->setName($entityName);
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
     * Get entity data property.
     *
     * @return array
     */
    public function getData()
    {
        return $this->Data;
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
     * Get entity name property.
     *
     * @return string
     */
    public function getName()
    {
        return $this->Name;
    }

    /**
     * Set the entity data array property.
     *
     * @param array $data Array data of entity parameter.
     *
     * @return void
     */
    public function setData(array $data = [])
    {
        $this->Data = $data;
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
     * Set entity name property.
     *
     * @param string $entityName Entity name parameter.
     *
     * @return void
     */
    public function setName($entityName)
    {
        $this->Name = $entityName;
    }
}
