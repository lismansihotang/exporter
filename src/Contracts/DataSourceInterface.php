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
 * ExporterDataSourceInterface class description.
 *
 * @package    Components
 * @subpackage Exporter\Contracts
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
interface DataSourceInterface
{

    /**
     * Load the data source and run initial process.
     *
     * @return void
     */
    public function doLoad();

    /**
     * Do mass import data set.
     *
     * @param array $data Data that will be updated into data source.
     *
     * @return void
     */
    public function doMassImport(array $data);

    /**
     * Get the resource data.
     *
     * @param array $tableName Table name filter parameter.
     *
     * @return array
     */
    public function getData(array $tableName = []);

    /**
     * Get field lists from data source.
     *
     * @return array
     */
    public function getFields();
}
