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
 * AbstractEntityBuilder class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
abstract class AbstractEntityBuilder
{

    /**
     * Data source instance property.
     *
     * @var \Bridge\Components\Exporter\Contracts\DataSourceInterface $DataSource
     */
    protected $DataSource;

    /**
     * Data source entity collection property.
     *
     * @var array $Entities
     */
    protected $Entities;

    /**
     * Property that handle all the data contains on data source instance property.
     *
     * @var array $EntitiesData
     */
    protected $EntitiesData = [];

    /**
     * Field mapper data property.
     *
     * @var array
     */
    protected $FieldMapper = [];

    /**
     * Field type mapper data property.
     *
     * @var array
     */
    protected $FieldTypeMapper = [];

    /**
     * AbstractEntityBuilder constructor.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource Data source instance parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when construct the instance.
     */
    public function __construct(\Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource)
    {
        try {
            # Set the data source property.
            $this->DataSource = $dataSource;
            $dataSource->doLoad();
            $this->EntitiesData = $dataSource->getData();
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Load initialization of data source entities builder.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If Invalid field mapper array data given.
     *
     * @return void
     */
    public function doBuild()
    {
        # Run the build entities procedure.
        try {
            # Load and validate the data source and
            $this->doLoad();
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Get data source instance.
     *
     * @return \Bridge\Components\Exporter\Contracts\DataSourceInterface
     */
    public function getDataSourceObject()
    {
        return $this->DataSource;
    }

    /**
     * Get entity collections.
     *
     * @return array
     */
    public function getEntities()
    {
        return $this->Entities;
    }

    /**
     * Entities data array property.
     *
     * @return array
     */
    public function getEntitiesData()
    {
        return $this->EntitiesData;
    }

    /**
     * Get entity object.
     *
     * @param string $tableName Table entity name parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If table entity name not found on collections.
     *
     * @return \Bridge\Components\Exporter\Contracts\TableEntityInterface
     */
    public function getEntity($tableName)
    {
        if (array_key_exists($tableName, $this->getEntities()) === false) {
            throw new \Bridge\Components\Exporter\ExporterException('Table entity not found on collections');
        }
        return $this->getEntities()[$tableName];
    }

    /**
     * Get the field mapper data property.
     *
     * @return array
     */
    public function getFieldMapper()
    {
        return $this->FieldMapper;
    }

    /**
     * Get the field type mapper data property.
     *
     * @return array
     */
    public function getFieldTypeMapper()
    {
        return $this->FieldTypeMapper;
    }

    /**
     * Set field type mapper data property.
     *
     * @param array $fieldTypeMapper Field type mapper data parameter.
     *
     * @return void
     */
    public function setFieldTypeMapper(array $fieldTypeMapper = [])
    {
        $this->FieldTypeMapper = $fieldTypeMapper;
    }

    /**
     * Do field mapping based on the given field mapper data array property.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If field mapping failed.
     *
     * @return void
     */
    protected function doFieldMapping()
    {
        try {
            # Get the entities data.
            $entitiesData = $this->getEntitiesData();
            # Map the entities data using the valid mapper.
            $fieldMapper = $this->getFieldMapper();
            foreach ($entitiesData as $entityName => $entity) {
                foreach ((array)$entity as $rowNumber => $rows) {
                    foreach ((array)$rows as $field => $value) {
                        if (in_array($field, $fieldMapper, true) === true) {
                            unset($entitiesData[$entityName][$rowNumber][$field]);
                            $entitiesData[$entityName][$rowNumber][array_search(
                                $field,
                                $fieldMapper,
                                true
                            )] = $value;
                        }
                    }
                }
            }
            # Set the entities data.
            $this->EntitiesData = $entitiesData;
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException('Field mapping failed: ' . $ex->getMessage());
        }
    }

    /**
     * Validate the data source property.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid data source (null object) given.
     *
     * @return void
     */
    protected function doLoad()
    {
        try {
            $entitiesData = $this->getEntitiesData();
            if ($entitiesData === null or count($entitiesData) === 0) {
                throw new \Bridge\Components\Exporter\ExporterException('Invalid data source, null object given');
            }
            # Do field mapping first if the field mapper property has been defined.
            # First validate the field data mapper if set.
            if ($this->validateFieldMapper() === true) {
                $this->doFieldMapping();
            }
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Get mapped field type.
     *
     * @param string $fieldType Field type parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException Invalid field type given.
     *
     * @return mixed
     */
    protected function getFieldTypeMap($fieldType)
    {
        try {
            if ($this->validateFieldTypeMapper() === true and
                ($mappedType = array_search($fieldType, $this->getFieldTypeMapper(), true)) !== false
            ) {
                $fieldType = $mappedType;
            }
            $validType = \Bridge\Components\Exporter\FieldElement::getFieldTypeConstraints();
            if (in_array($fieldType, $validType, true) === false) {
                throw new \Bridge\Components\Exporter\ExporterException('Invalid field type given: ' . $fieldType);
            }
            return $fieldType;
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Set entities data property.
     *
     * @param array $entitiesData Entities data parameter.
     *
     * @return void
     */
    protected function setEntitiesData(array $entitiesData)
    {
        $this->EntitiesData = $entitiesData;
    }

    /**
     * Validate the field mapper property.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid field mapper array data given.
     *
     * @return boolean
     */
    protected function validateFieldMapper()
    {
        # Validate the field mapper by comparing all the value are exists on the data source fields.
        $dataSourceFields = $this->getDataSourceObject()->getFields();
        $dataSourceFields = array_pop($dataSourceFields);
        if (count($this->getFieldMapper()) > 0 and
            count(array_diff($this->getFieldMapper(), $dataSourceFields)) !== 0
        ) {
            throw new \Bridge\Components\Exporter\ExporterException('Invalid field mapper array data given');
        }
        return true;
    }

    /**
     * Validate the field type mapper property.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid field type mapper array data given.
     *
     * @return boolean
     */
    protected function validateFieldTypeMapper()
    {
        $validType = \Bridge\Components\Exporter\FieldElement::getFieldTypeConstraints();
        if (count($this->getFieldTypeMapper()) > 0 and
            count(array_diff(array_keys($this->getFieldTypeMapper()), $validType)) !== 0
        ) {
            throw new \Bridge\Components\Exporter\ExporterException('Invalid field type mapper array data given');
        }
        return true;
    }
}
