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
 * ExcelDataSource class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class ExcelDataSource implements \Bridge\Components\Exporter\Contracts\DataSourceInterface
{

    /**
     * Data row collection property.
     *
     * @var array $Data
     */
    private $Data = [];

    /**
     * Excel file object property.
     *
     * @var \Bridge\Components\Exporter\AbstractExcelFile $ExcelFile
     */
    private $ExcelFile;

    /**
     * Field read filter that will be used to filter the field row.
     *
     * @var \Bridge\Components\Exporter\ExcelEntityFieldsReadFilter $FieldReadFilter
     */
    private $FieldReadFilter;

    /**
     * Fields data collection property.
     *
     * @var array $Fields
     */
    private $Fields = [];

    /**
     * Multiple source options.
     *
     * @var boolean $MultipleSource
     */
    private $MultipleSource = false;

    /**
     * Record read filter that will be used to filter the contents row.
     *
     * @var \Bridge\Components\Exporter\ExcelEntityRecordReadFilter $RecordReadFilter
     */
    private $RecordReadFilter;

    /**
     * ExcelDataSource constructor.
     *
     * @param string $filePath Excel file path parameter.
     * @param string $type     The reader type that indicates the excel file type.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid excel data source file path given.
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when construct the instance.
     */
    public function __construct($filePath, $type = 'Excel2007')
    {
        try {
            if (trim($filePath) === '' or $filePath === null or file_exists($filePath) === false) {
                throw new \Bridge\Components\Exporter\ExporterException('Invalid excel data source file path');
            }
            $this->ExcelFile = new \Bridge\Components\Exporter\BasicExcelFile($filePath);
            $this->ExcelFile->setReaderAndWriterType($type);
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Update data set.
     *
     * @param array $data Data that will be updated into data source.
     *
     * @return void
     */
    public function doMassImport(array $data)
    {
        $this->getExcelFileObject()->setGrid($data);
        $this->getExcelFileObject()->doSave();
    }

    /**
     * Get resource data.
     *
     * @param array $sheetFilters Selected table that will be parsed.
     *
     * @return array
     */
    public function getData(array $sheetFilters = [])
    {
        $filteredData = $this->Data;
        if (count(array_filter($sheetFilters)) > 0 and $this->isMultipleSource() === true) {
            $existingSheets = array_keys($filteredData);
            foreach ($existingSheets as $sheetName) {
                if (in_array($sheetName, $sheetFilters, true) === false) {
                    unset($filteredData[$sheetName]);
                }
            }
        }
        return $filteredData;
    }

    /**
     * Get fields data array from data source.
     *
     * @return array
     */
    public function getFields()
    {
        return $this->Fields;
    }

    /**
     * Check if instance handle multiple data source.
     *
     * @return boolean
     */
    public function isMultipleSource()
    {
        return $this->MultipleSource;
    }

    /**
     * Load the excel file and run initial process.
     *
     * @return void
     */
    public function doLoad()
    {
        # Set the default field read filter if no given.
        if ($this->getFieldReadFilter() === null) {
            $this->setFieldReadFilter(1);
        }
        $this->getExcelFileObject()->doRead();
        $excelFileDataArr = $this->getExcelFileObject()->getData();
        if (array_key_exists('worksheets', $excelFileDataArr) === true) {
            $worksheetData = $excelFileDataArr['worksheets'];
            if (count($worksheetData) > 1) {
                $this->setMultipleSource(true);
            }
        }
        # Get the fields data.
        # Build the recordSet data by grouping the fields column as the index key.
        $fields = [];
        $data = [];
        foreach ($excelFileDataArr as $worksheets) {
            foreach ((array)$worksheets as $sheetName => $sheet) {
                foreach ($sheet['contents'] as $rowNumber => $rowGroup) {
                    foreach ($rowGroup['data'] as $columnNumber => $cell) {
                        if ($rowNumber === $this->FieldReadFilter->getStartRow()) {
                            $fields[$sheetName][$columnNumber] = $cell;
                        } else {
                            $data[$sheetName][$fields[$sheetName][$columnNumber]] = $cell;
                        }
                    }
                }
            }
        }
        $this->setFields($fields);
        $this->setData($data);
    }

    /**
     * Set field read filter object property.
     *
     * @param integer $startRow      Field row number parameter.
     * @param array   $columns       Column range data parameter.
     * @param string  $workSheetName Work sheet name parameter.
     *
     * @return void
     */
    public function setFieldReadFilter($startRow, array $columns = [], $workSheetName = '')
    {
        $this->FieldReadFilter = new \Bridge\Components\Exporter\ExcelEntityFieldsReadFilter(
            $startRow,
            $columns,
            $workSheetName
        );
        $this->RecordReadFilter = new \Bridge\Components\Exporter\ExcelEntityRecordReadFilter($this->FieldReadFilter);
    }

    /**
     * Get excel file object property.
     *
     * @return \Bridge\Components\Exporter\BasicExcelFile
     */
    protected function getExcelFileObject()
    {
        return $this->ExcelFile;
    }

    /**
     * Get field read filter object.
     *
     * @return \Bridge\Components\Exporter\ExcelEntityFieldsReadFilter
     */
    protected function getFieldReadFilter()
    {
        return $this->FieldReadFilter;
    }

    /**
     * Get record read filter instance property.
     *
     * @return \Bridge\Components\Exporter\ExcelEntityRecordReadFilter
     */
    protected function getRecordReadFilter()
    {
        return $this->RecordReadFilter;
    }

    /**
     * Set record set data from excel data source.
     *
     * @param array $data Data array that contain record set parameter.
     *
     * @return void
     */
    protected function setData(array $data = [])
    {
        $this->Data = $data;
    }

    /**
     * Set fields property
     *
     * @param array $fields Fields data array parameter.
     *
     * @return void
     */
    protected function setFields($fields)
    {
        $this->Fields = $fields;
    }

    /**
     * Set the multiple source flag option into
     *
     * @param boolean $multipleSource Multi source option flag parameter.
     *
     * @return void
     */
    protected function setMultipleSource($multipleSource = true)
    {
        $this->MultipleSource = $multipleSource;
    }
}
