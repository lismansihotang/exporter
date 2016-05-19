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
 * DataMatcher class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class DataMatcher implements \Bridge\Components\Exporter\Contracts\MatcherInterface
{

    /**
     * Table entity object that will be used as the constraint of valid model.
     *
     * @var \Bridge\Components\Exporter\Contracts\TableEntityInterface $TableEntity
     */
    private $TableEntity;

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
     * Add the data target that will be compared and matched with the data source.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $target Data target object parameter.
     *
     * @return void
     */
    public function addTarget(\Bridge\Components\Exporter\Contracts\DataSourceInterface $target)
    {
        # TODO: Implement addTarget() method.
    }

    /**
     * Get matcher result data.
     *
     * @return array
     */
    public function getResult()
    {
        # TODO: Implement getResult() method.
    }

    /**
     * Run mapper as matcher procedure result.
     *
     * @return boolean
     */
    public function runMapper()
    {
        # TODO: Implement runMapper() method.
    }

    /**
     * Set source data property.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $source Data source parameter.
     *
     * @return void
     */
    public function setSource(\Bridge\Components\Exporter\Contracts\DataSourceInterface $source)
    {
        # TODO: Implement setSource() method.
    }

    /**
     * Set table entity property that will act as the virtual document rules.
     *
     * @param \Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntity Table entity object parameter.
     *
     * @return void
     */
    public function setTableEntity(\Bridge\Components\Exporter\Contracts\TableEntityInterface $tableEntity)
    {
        # TODO: Implement setTableEntity() method.
    }
}
