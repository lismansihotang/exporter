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
 * ExcelReaderInterface class description.
 *
 * @package    Components
 * @subpackage Exporter\Contracts
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
interface ExcelReaderInterface
{

    /**
     * Printing the excel document.
     *
     * @param array $options Option array set to printing mode parameter.
     *
     * @return void
     */
    public function doPrinting(array $options = []);

    /**
     * Load and read excel file.
     *
     * @param \Bridge\Components\Exporter\Contracts\ExcelReadFilterInterface $readFilter Excel read filter parameter.
     * @param array                                                          $sheetNames Sheet name data collection
     *                                                                                   parameter.
     * @param string                                                         $readerType Excel reader type parameter.
     *
     * @throws \PHPExcel_Reader_Exception If invalid reader type or the file cannot be loaded.
     * @return void
     */
    public function doRead(
        \Bridge\Components\Exporter\Contracts\ExcelReadFilterInterface $readFilter = null,
        array $sheetNames = [],
        $readerType = 'Excel2007'
    );

    /**
     * Get excel file data property.
     *
     * @return array
     */
    public function getData();

    /**
     * Set read filter object property.
     *
     * @param \Bridge\Components\Exporter\Contracts\ExcelReadFilterInterface $readFilter Excel read filter parameter.
     *
     * @return void
     */
    public function setReadFilter(\Bridge\Components\Exporter\Contracts\ExcelReadFilterInterface $readFilter);
}
