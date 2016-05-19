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
 * AbstractExcelReaderFilter class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
abstract class AbstractExcelReadFilter implements \Bridge\Components\Exporter\Contracts\ExcelReadFilterInterface
{

    /**
     * Column range data collection property.
     *
     * @var array $Columns
     */
    protected $Columns = [];

    /**
     * End cell row number property
     *
     * @var integer $EndRow
     */
    protected $EndRow = 0;

    /**
     * Start cell row number property.
     *
     * @var integer $StartRow
     */
    protected $StartRow = 0;

    /**
     * Work sheet name property.
     *
     * @var string $WorkSheetName
     */
    protected $WorkSheetName;

    /**
     * ExcelEntityFieldsReadFilter constructor.
     *
     * @param integer $startRow Start cell row number parameter.
     * @param integer $endRow   End cell row number parameter.
     * @param array   $columns  Column range data parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when construct this instance.
     */
    public function __construct($startRow, $endRow, array $columns)
    {
        try {
            $this->setStartRow($startRow);
            $this->setEndRow($endRow);
            $this->setColumns($columns);
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Get columns data range collection property.
     *
     * @return array
     */
    public function getColumns()
    {
        return $this->Columns;
    }

    /**
     * Get end cell row number property.
     *
     * @return integer
     */
    public function getEndRow()
    {
        return $this->EndRow;
    }

    /**
     * Get start cell row number property.
     *
     * @return integer
     */
    public function getStartRow()
    {
        return $this->StartRow;
    }

    /**
     * Get work sheet name property.
     *
     * @return string
     */
    public function getWorkSheetName()
    {
        return $this->WorkSheetName;
    }

    /**
     * Read cell filter.
     *
     * @param string  $column        Column name parameter.
     * @param integer $row           Cell row number parameter.
     * @param string  $workSheetName Work sheet name parameter.
     *
     * @return boolean
     */
    public function readCell($column, $row, $workSheetName = '')
    {
        # Only read the rows, columns, and worksheet name that were configured
        return (
            $row >= $this->getStartRow() and
            $row <= $this->getEndRow() and
            in_array($column, $this->getColumns(), true) === true and
            $workSheetName === $this->getWorkSheetName()
        );
    }

    /**
     * Set columns data range property.
     *
     * @param array $columns Columns data range parameter.
     *
     * @return void
     */
    public function setColumns(array $columns)
    {
        $this->Columns = $columns;
    }

    /**
     * Set end cell row number property.
     *
     * @param integer $endRow End cell row number parameter.
     *
     * @return void
     */
    public function setEndRow($endRow)
    {
        $this->EndRow = $endRow;
    }

    /**
     * Set start cell row number property.
     *
     * @param integer $startRow Start cell row number parameter.
     *
     * @return void
     */
    public function setStartRow($startRow)
    {
        $this->StartRow = $startRow;
    }

    /**
     * Set work sheet name property.
     *
     * @param string $workSheetName Work sheet name parameter.
     *
     * @return void
     */
    public function setWorkSheetName($workSheetName)
    {
        $this->WorkSheetName = $workSheetName;
    }

    /**
     * Do validate the row filter parameter.
     *
     * @param integer $startRow Start cell row number parameter.
     * @param integer $endRow   End cell row number parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid start and end row given to the filter.
     *
     * @return boolean
     */
    protected function validateRowFilter($startRow, $endRow)
    {
        if (is_int($startRow) === false and is_int($endRow) === false and $endRow < $startRow) {
            throw new \Bridge\Components\Exporter\ExporterException('Invalid start and end row given to the filter');
        }
        return true;
    }
}
