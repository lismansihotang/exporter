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
 * DbDataSource class description (Only connect via postgres dbms for now).
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class DbDataSource implements \Bridge\Components\Exporter\Contracts\DataSourceInterface
{

    /**
     * Do mass import data set.
     *
     * @param array $data Data that will be updated into data source.
     *
     * @return void
     */
    public function doMassImport(array $data)
    {
        # TODO: Implement doMassImport() method.
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
        # TODO: Implement getData() method.
    }

    /**
     * Get field lists from data source.
     *
     * @return array
     */
    public function getFields()
    {
        # TODO: Implement getFields() method.
    }
}
