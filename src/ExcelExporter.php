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
 * ExcelExporter class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class ExcelExporter implements \Bridge\Components\Exporter\Contracts\ExporterInterface
{

    /**
     * Source data array property.
     *
     * @var array $Data
     */
    private $Data;

    /**
     * Target object property
     *
     * @var \Bridge\Components\Exporter\Contracts\DataSourceInterface $TargetObject
     */
    private $TargetObject;

    /**
     * ExcelExporter constructor.
     */
    public function __construct()
    {
    }

    /**
     * Do export the source data to target.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $target Data target object parameter.
     *
     * @return boolean
     */
    public function doExport(\Bridge\Components\Exporter\Contracts\DataSourceInterface $target)
    {
        # TODO: Implement doExport() method.
    }

    /**
     * Get log data property.
     *
     * @return array
     */
    public function getLog()
    {
        # TODO: Implement getLog() method.
    }

    /**
     * Get exporter status.
     *
     * @return self::STATE_ERROR|self::STATE_FAILED|self::STATE_SUCCESS
     */
    public function getStatus()
    {
        # TODO: Implement getStatus() method.
    }

    /**
     * Set data array as source.
     *
     * @param array $data Source data array parameter.
     *
     * @return void
     */
    public function setData(array $data)
    {
    }
}
