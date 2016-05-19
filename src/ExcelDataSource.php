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
     * Excel object property.
     *
     * @var \Bridge\Components\Exporter\ExcelFile $ExcelFileObject
     */
    private $ExcelFileObject;

    /**
     * ExcelDataSource constructor.
     *
     * @param string $filePath Excel file path parameter.
     * @param string $type     The reader type that indicates the excel file type.
     */
    public function __construct($filePath, $type = 'Excel5')
    {
        try {
            if (trim($filePath) !== '' or $filePath !== null) {
                $this->ExcelFileObject = new \Bridge\Components\Exporter\ExcelFile($filePath, $type);
            }
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Update data set.
     *
     * @param array $data Data that will be updated into data source.
     *
     * @return boolean
     */
    public function doMassImport(array $data)
    {
        # TODO: Implement updateDataSet() method.
        return true;
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
