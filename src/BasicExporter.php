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
 * BasicExporter class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class BasicExporter implements \Bridge\Components\Exporter\Contracts\ExporterInterface
{

    /**
     * Exporter log data property.
     *
     * @var array $Log
     */
    protected $Log;

    /**
     * Exported Source data array property.
     *
     * @var array $ExportedData
     */
    private $ExportedData;

    /**
     * Exporter status property.
     *
     * @var self::STATE_ERROR|self::STATE_FAILED|self::STATE_SUCCESS $Status
     */
    private $Status;

    /**
     * Target object property
     *
     * @var \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $TargetObject
     */
    private $TargetObject;

    /**
     * Required log key array data property.
     *
     * @var array $RequiredLogKey
     */
    private static $RequiredLogKey = ['message', 'time', 'code'];

    /**
     * BasicExporter constructor.
     *
     * @param array                                 $exportedData Exported data array parameter.
     * @param Contracts\ExporterDataSourceInterface $targetObject Data target object parameter.
     */
    public function __construct(array $exportedData = [], Contracts\ExporterDataSourceInterface $targetObject = null)
    {
        $this->setExportedData($exportedData);
        $this->setTargetObject($targetObject);
    }

    /**
     * Do export the source data to target.
     *
     * @return boolean
     */
    public function doExport()
    {
        if ($this->getTargetObject() === null) {
            die('Please assign the target object to the exporter');
        }
        return $this->getTargetObject()->doMassImport($this->getExportedData());
    }

    /**
     * Get exported data property
     *
     * @return array
     */
    public function getExportedData()
    {
        return $this->ExportedData;
    }

    /**
     * Get log data property.
     *
     * @return array
     */
    public function getLog()
    {
        return $this->Log;
    }

    /**
     * Get exporter status.
     *
     * @return self::STATE_ERROR|self::STATE_FAILED|self::STATE_SUCCESS
     */
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * Get exporter target object property.
     *
     * @return \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface
     */
    public function getTargetObject()
    {
        return $this->TargetObject;
    }

    /**
     * Set exported data array as source.
     *
     * @param array $data Source data array parameter.
     *
     * @return void
     */
    public function setExportedData(array $data)
    {
        $this->ExportedData = $data;
    }

    /**
     * Set exporter target object property.
     *
     * @param \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $targetObject Target object parameter.
     *
     * @return void
     */
    public function setTargetObject(\Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $targetObject)
    {
        $this->TargetObject = $targetObject;
    }

    /**
     * Add log data into log data array property.
     *
     * @param array $logData Log data array parameter.
     *
     * @return void
     */
    protected function addLog(array $logData)
    {
        if ($this->validateLogItem($logData) === true) {
            $this->Log[] = $logData;
        }
    }

    /**
     * Set exporter status property.
     *
     * @param self ::STATE_ERROR|self::STATE_FAILED|self::STATE_SUCCESS $status Exporter status parameter.
     *
     * @return void
     */
    protected function setStatus($status)
    {
        $this->Status = $status;
    }

    /**
     * Validate the log item data that want to be added into exporter log property.
     *
     * @param array $logData Log data array parameter.
     *
     * @return boolean
     */
    private function validateLogItem(array $logData)
    {
        foreach (static::$RequiredLogKey as $requiredKey) {
            if (array_key_exists($requiredKey, $logData) === false) {
                return false;
            }
        }
        return true;
    }
}
