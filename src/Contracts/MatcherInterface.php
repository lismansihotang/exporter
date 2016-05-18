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
 * MatcherInterface class description.
 *
 * @package    Components
 * @subpackage Exporter\Contracts
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
interface MatcherInterface
{

    /**
     * Add the data target that will be compared and matched with the data source.
     *
     * @param \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $target Data target object parameter.
     *
     * @return void
     */
    public function addTarget(\Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $target);

    /**
     * Get matcher result data.
     *
     * @return array
     */
    public function getResult();

    /**
     * Run mapper as matcher procedure result.
     *
     * @return boolean
     */
    public function runMapper();

    /**
     * Set source data property.
     *
     * @param \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $source Data source parameter.
     *
     * @return void
     */
    public function setSource(\Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $source);

    /**
     * Set table entity property that will act as the virtual document rules.
     *
     * @param \Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntity Table entity object parameter.
     *
     * @return void
     */
    public function setTableEntity(\Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntity);
}
