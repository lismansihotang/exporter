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
 * DataSourceInterface class description.
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
     * Get resource data.
     *
     * @param array $fieldFilters Array field filters data parameter.
     *
     * @return array
     */
    public function getData(array $fieldFilters = []);

    /**
     * Get field lists from data source.
     *
     * @return array
     */
    public function getFields();

    /**
     * Update data set.
     *
     * @param array $data Data that will be updated into data source.
     *
     * @return boolean
     */
    public function updateDataSet(array $data);
}
