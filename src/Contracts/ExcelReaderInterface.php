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
interface ExcelReaderInterface extends \PHPExcel_Reader_IReader
{

    /**
     * Set read data only
     *        Set to true, to advise the Reader only to read data values for cells, and to ignore any formatting
     *        information. Set to false (the default) to advise the Reader to read both data and formatting for cells.
     *
     * @param boolean $pValue Read-only flag parameter.
     *
     * @return \Bridge\Components\Exporter\Contracts\ExcelReaderInterface
     */
    public function setReadDataOnly($pValue = false);
}
