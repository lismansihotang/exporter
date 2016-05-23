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
 * ExcelFile class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class BasicExcelFile extends \Bridge\Components\Exporter\AbstractExcelFile
{

    /**
     * Add one row to the excel file.
     *
     * @param array  $row       Complete array for one row to add.
     * @param string $sheetName Sheet name parameter.
     * @param string $gridType  Grid type parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when adding row into the grid.
     *
     * @return void
     */
    public function addRow(array $row, $sheetName = '0', $gridType = 'content')
    {
        try {
            $nextGridRow = $this->getNextGridRow($sheetName, $gridType);
            $filteredValue = array_walk(array_values($row), 'doConvertBrToNl');
            $this->Grid['worksheet'][$sheetName][$gridType][$nextGridRow] = $filteredValue;
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Printing the excel document.
     *
     * @param array $options Option array set to printing mode parameter.
     *
     * @return void
     */
    public function doPrinting(array $options = [])
    {
    }

    /**
     * Returns the number of lines in the grid.
     *
     * @param string $sheetName Sheet name parameter.
     * @param string $gridType  Grid type parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid worksheet or grid type given.
     * @throws \Bridge\Components\Exporter\ExporterException If cannot get next grid row number.
     *
     * @return integer Returns the next grid row number
     */
    public function getNextGridRow($sheetName = '0', $gridType = 'content')
    {
        try {
            if ($this->validateGridWorkSheet($sheetName) === false or $this->validateGridType($gridType) === false) {
                throw new \Bridge\Components\Exporter\ExporterException('Cannot get next grid row number');
            }
            return count($this->Grid['worksheet'][$sheetName][$gridType]);
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Set the complete grid.
     *
     * @param array $grid The complete grid.
     *
     * @return void
     */
    public function setGrid(array $grid)
    {
        $this->Grid = $grid;
    }

    /**
     * Get the complete grid as a string.
     *
     * @return void
     */
    protected function doRenderGrid()
    {
        $gridData = $this->getGrid();
        if ($this->validateGridData($gridData) === true) {
            $gridWorksheet = (array)$gridData['worksheet'];
            $objPhpExcel = $this->getPhpExcelObject();
            $worksheetIndex = 0;
            foreach ($gridWorksheet as $sheetKey => $sheetData) {
                # Create the worksheet instance.
                $sheetKeyAsString = $sheetKey;
                if (is_numeric($sheetKeyAsString) === true) {
                    $sheetKeyAsString = 'sheet' . $sheetKey;
                }
                $objWorksheet = new \PHPExcel_Worksheet($objPhpExcel, $sheetKeyAsString);
                $objWorksheet->setTitle($sheetKeyAsString);
                # Attach the worksheet to php excel object.
                $objPhpExcel->addSheet($objWorksheet, $worksheetIndex);
                $objPhpExcel->setActiveSheetIndex($worksheetIndex);
                # Parse all the sheet data to variable.
                # Process and render the header data.
                if (array_key_exists('header', $sheetData) === true) {
                    $this->doRenderGridItems($sheetData['header']);
                }
                if (array_key_exists('content', $sheetData) === true) {
                    $this->doRenderGridItems($sheetData['content']);
                }
                if (array_key_exists('footer', $sheetData) === true) {
                    $this->doRenderGridItems($sheetData['footer']);
                }
                $worksheetIndex++;
            }
        }
        # Remove all the grid content after rendering the grid.
        $this->doUnsetGrid();
    }

    /**
     * Render the grid item.
     *
     * @param array $gridItems Grid item array data parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid grid item given.
     *
     * @return void
     */
    protected function doRenderGridItems(array $gridItems)
    {
        try {
            if (array_key_exists('data', $gridItems) === true) {
                foreach ($gridItems['data'] as $rowNumber => $rows) {
                    foreach ($rows as $columnNumber => $value) {
                        $this->getSheet()->getColumnDimension($columnNumber)->setAutoSize(true);
                        $cellData = $value;
                        if (is_array($cellData) === false) {
                            $cellData = ['data' => $value];
                        }
                        if ($this->validateGridItem($cellData) === true) {
                            $this->setCell($cellData['data'], $columnNumber, $rowNumber);
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Validate the given grid data.
     *
     * @param array $gridData
     *
     * @return boolean
     */
    private function validateGridData(array $gridData)
    {
    }

    /**
     * Validate the grid item content.
     *
     * @param array $gridItem Grid item data array parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid grid item given.
     *
     * @return boolean
     */
    private function validateGridItem(array $gridItem)
    {
        if (array_key_exists('data', $gridItem) === false) {
            throw new \Bridge\Components\Exporter\ExporterException('Invalid grid item');
        }
        return true;
    }

    /**
     * Validate the given grid type.
     *
     * @param string $gridType Grid type parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If invalid grid type given.
     *
     * @return boolean
     */
    private function validateGridType($gridType)
    {
        $validGridType = ['header', 'content', 'footer'];
        if (in_array($gridType, $validGridType, true) === false) {
            throw new \Bridge\Components\Exporter\ExporterException('Invalid grid type');
        }
        return true;
    }

    /**
     * Validate the grid worksheet if exist or not.
     *
     * @param string $sheetName Sheet name parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If selected worksheet not exists.
     *
     * @return boolean
     */
    private function validateGridWorkSheet($sheetName)
    {
        if (array_key_exists($sheetName, $this->getGrid()['worksheet']) === false) {
            throw new \Bridge\Components\Exporter\ExporterException('Selected worksheet not exist on grid');
        }
        return true;
    }
}
