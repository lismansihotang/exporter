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
 * DataMapper class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class DataMapper implements \Bridge\Components\Exporter\Contracts\MapperInterface
{



    /**
     * Data mapper property.
     *
     * @var array $DataMapper
     */
    private $DataMapper;

    /**
     * Result of data mapper and matcher processing.
     *
     * @var array $Result
     */
    private $Result;

    /**
     * Data record source instance.
     *
     * @var \Bridge\Components\Exporter\Contracts\DataSourceInterface $Source
     */
    private $Source;

    /**
     * Table entity object that will be used as the constraint of valid model.
     *
     * @var \Bridge\Components\Exporter\Contracts\TableEntityInterface $TableEntity
     */
    private $TableEntity;

    /**
     * Data record target instance.
     *
     * @var \Bridge\Components\Exporter\Contracts\DataSourceInterface $Target
     */
    private $Target;

    /**
     * DataMatcher constructor.
     *
     * @param \Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntity Table entity parameter.
     */
    public function __construct(\Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntity)
    {
        $this->TableEntity = $tableEntity;
    }

    /**
     * Get the mapper data property.
     *
     * @return array
     */
    public function getDataMapper()
    {
        return $this->DataMapper;
    }

    /**
     * Get mapper and matcher result data.
     *
     * @return array
     */
    public function getResult()
    {
        return $this->Result;
    }

    /**
     * Get the data record source object property.
     *
     * @return \Bridge\Components\Exporter\Contracts\DataSourceInterface
     */
    public function getSourceObject()
    {
        return $this->Source;
    }

    /**
     * Get the table entity object property.
     *
     * @return \Bridge\Components\Exporter\Contracts\TableEntityInterface
     */
    public function getTableEntityObject()
    {
        return $this->TableEntity;
    }

    /**
     * Get the data record target object.
     *
     * @return \Bridge\Components\Exporter\Contracts\DataSourceInterface
     */
    public function getTargetObject()
    {
        return $this->Target;
    }

    /**
     * Run mapper as matcher procedure result.
     *
     * @return boolean
     */
    public function runMapper()
    {
        # Get the table entity data.

        # Get the record source data.
        # Get the record target data.

    }

    /**
     * Set the array data mapper property.
     *
     * @param array $dataMapper Data mapper property.
     *
     * @return void
     */
    public function setDataMapper(array $dataMapper = [])
    {
        $this->DataMapper = $dataMapper;
    }

    /**
     * Set source data property.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $sourceObj Data record source object parameter.
     *
     * @return void
     */
    public function setSource(\Bridge\Components\Exporter\Contracts\DataSourceInterface $sourceObj)
    {
        $this->Source = $sourceObj;
    }

    /**
     * Set table entity property that will act as the virtual document rules.
     *
     * @param \Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntityObj Table entity object parameter.
     *
     * @return void
     */
    public function setTableEntity(\Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntityObj)
    {
        $this->TableEntity = $tableEntityObj;
    }

    /**
     * Set the data target that will be compared and matched with the data source.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $targetObj Data record target object parameter.
     *
     * @return void
     */
    public function setTarget(\Bridge\Components\Exporter\Contracts\DataSourceInterface $targetObj)
    {
        $this->Target = $targetObj;
    }
}
