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
 * AbstractDataSourceDecorator class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
abstract class AbstractDataSourceDecorator implements \Bridge\Components\Exporter\Contracts\DataSourceInterface
{

    /**
     * Data source real object.
     *
     * @var \Bridge\Components\Exporter\Contracts\DataSourceInterface $DataSourceInstance
     */
    protected $DataSourceInstance;

    /**
     * Data set property that contains all the entity/record data.
     *
     * @var array $DataSet
     */
    private $DataSet;

    /**
     * AbstractDataSourceDecorator constructor.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource Data source instance parameter.
     */
    public function __construct(\Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource)
    {
        $this->DataSourceInstance = $dataSource;
    }

    /**
     * Do mass import data set.
     *
     * @param array $data Data that will be updated into data source.
     *
     * @return boolean
     */
    public function doMassImport(array $data)
    {
        return $this->DataSourceInstance->doMassImport($data);
    }

    /**
     * Get resource data.
     *
     * @param array $fieldFilters Array field filters data parameter.
     *
     * @return array
     */
    public function getData(array $fieldFilters = [])
    {
        return $this->DataSourceInstance->getData($fieldFilters);
    }

    /**
     * Get data set property.
     *
     * @return array
     */
    public function getDataSet()
    {
        return $this->DataSet;
    }

    /**
     * Get field lists from data source.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->DataSourceInstance->getFields();
    }
}
