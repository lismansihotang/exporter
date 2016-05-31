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
     * Constraint data array property.
     *
     * @var array $Constraints
     */
    private $Constraints;

    /**
     * Field length property.
     *
     * @var integer $FieldLength
     */
    private $FieldLength;

    /**
     * Field name property.
     *
     * @var string $FieldName
     */
    private $FieldName;

    /**
     * Field type property.
     *
     * @var string $FieldType
     */
    private $FieldType;

    /**
     * Primary key state property.
     *
     * @var boolean
     */
    private $PrimaryKey = false;

    /**
     * Required state property.
     *
     * @var boolean
     */
    private $Required = false;

    /**
     * Valid field constraint name data array property.
     *
     * @var array $ValidFieldConstraints
     */
    protected static $ValidFieldConstraints = [
        'primaryKey'  => 'setAsPrimary',
        'fieldType'   => 'setFieldType',
        'required'    => 'setRequired',
        'fieldLength' => 'setFieldLength',
        'default'     => 'setDefaultValue',
        'foreignKey'  => 'setDependency'
    ];

    /**
     * Field type constraint data mapper property.
     *
     * @var array $FieldTypeMapper
     */
    protected static $FieldTypeMapper = [
        'string' => \Bridge\Components\Exporter\Contracts\FieldElementInterface::FIELD_TYPE_STRING,
        'char'   => \Bridge\Components\Exporter\Contracts\FieldElementInterface::FIELD_TYPE_CHAR,
        'number' => \Bridge\Components\Exporter\Contracts\FieldElementInterface::FIELD_TYPE_NUMBER,
        'date'   => \Bridge\Components\Exporter\Contracts\FieldElementInterface::FIELD_TYPE_DATE,
        'enum'   => \Bridge\Components\Exporter\Contracts\FieldElementInterface::FIELD_TYPE_ENUM
    ];

    /**
     * FieldElement constructor.
     *
     * @param string $fieldName   Field name data parameter.
     * @param array  $constraints Constraints data array parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when init the instance.
     */
    public function __construct(
        $fieldName,
        array $constraints = []
    ) {
        try {
            $this->setFieldName($fieldName);
            if (count($constraints) > 0) {
                $this->setConstraints($constraints);
            }
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Add constraint data to constraints property
     *
     * @param string $constraintName  Constraint name parameter.
     * @param mixed  $constraintValue Constraint value parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid constraint name or value given.
     *
     * @return void
     */
    public function addConstraint($constraintName, $constraintValue)
    {
        if (array_key_exists($constraintName, static::$ValidFieldConstraints) === false) {
            throw new \Bridge\Components\Exporter\ExporterException(
                'Invalid constraint name given: ' . $constraintName
            );
        }
        $callableMethod = static::$ValidFieldConstraints[$constraintName];
        if (method_exists($this, $callableMethod) === true) {
            $this->{$callableMethod}($constraintValue);
        }
    }

    /**
     * Get data constraints array property.
     *
     * @return array
     */
    public function getConstraints()
    {
        return $this->Constraints;
    }

    /**
     * Get the field name property
     *
     * @return string
     */
    public function getFieldName()
    {
        return $this->FieldName;
    }

    /**
     * Get field type constraints data property.
     *
     * @return array
     */
    public static function getFieldTypeConstraints()
    {
        return array_keys(static::$FieldTypeMapper);
    }

    /**
     * Map the given field type to the correct number that registered on the mapper data property.
     *
     * @param string $fieldType Field type parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid type given.
     *
     * @return integer
     */
    public static function getFieldTypeMapper($fieldType)
    {
        if (in_array(strtolower($fieldType), static::$FieldTypeMapper, true) === true) {
            return static::$FieldTypeMapper[strtolower($fieldType)];
        }
        throw new \Bridge\Components\Exporter\ExporterException('Invalid field type given');
    }

    /**
     * Get primary key state property.
     *
     * @return boolean
     */
    public function isPrimaryKey()
    {
        return $this->PrimaryKey;
    }

    /**
     * Get the field required constraint.
     *
     * @return boolean
     */
    public function isRequired()
    {
        return $this->Required;
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
        $this->Constraints['primaryKey'] = (boolean)$isPrimaryKey;
        $this->PrimaryKey = (boolean)$isPrimaryKey;
    }

    /**
     * Set the constraints data array property.
     *
     * @param array $constraints Constraints data array parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid constraints data given.
     *
     * @return void
     */
    public function setConstraints(array $constraints)
    {
        try {
            foreach ($constraints as $constraintName => $constraintValue) {
                $this->addConstraint($constraintName, $constraintValue);
            }
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
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
        $this->Constraints['default'] = $defaultValue;
    }

    /**
     * Set field dependency.
     *
     * @param \Bridge\Components\Exporter\FieldElement $dependencyFieldName Dependency field name parameter.
     *
     * @return void
     */
    public function setDependency(\Bridge\Components\Exporter\FieldElement $dependencyFieldName)
    {
        $this->Constraints['foreignKey'] = $dependencyFieldName;
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
        $this->Constraints['fieldType'] = 'enum';
        $this->Constraints['fieldLength'] = $enumData;
    }

    /**
     * Set field basic information property.
     *
     * @param string $fieldType   Field type parameter.
     * @param mixed  $fieldLength Field length parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when set the field property.
     *
     * @return void
     */
    public function setField($fieldType, $fieldLength = null)
    {
        try {
            $this->setFieldType($fieldType);
            $this->setFieldLength($fieldLength);
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Set field length property.
     *
     * @param integer $fieldLength Field length parameter.
     *
     * @return void
     */
    public function setFieldLength($fieldLength = null)
    {
        $this->Constraints['fieldLength'] = (integer)$fieldLength;
        $this->FieldLength = (integer)$fieldLength;
    }

    /**
     * Set field name property.
     *
     * @param string $fieldName Field name parameter.
     *
     * @return void
     */
    public function setFieldName($fieldName)
    {
        $this->FieldName = $fieldName;
    }

    /**
     * Set field type property.
     *
     * @param string $fieldType Field type parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid field element type given.
     *
     * @return void
     */
    public function setFieldType($fieldType)
    {
        if (in_array($fieldType, static::getFieldTypeConstraints(), true) === false) {
            throw new \Bridge\Components\Exporter\ExporterException('Invalid field element type given: ' . $fieldType);
        }
        $this->Constraints['fieldType'] = $fieldType;
        $this->FieldType = $fieldType;
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
        $this->Constraints['required'] = (boolean)$isRequired;
        $this->Required = (boolean)$isRequired;
    }
}
