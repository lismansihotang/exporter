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
class ExcelFile implements Contracts\ExcelReaderInterface, Contracts\ExcelWriterInterface
{

    /**
     * The data contain that will be filled by excel data document content.
     *
     * @var array $Data
     */
    private $Data;

    /**
     * File name property.
     *
     * @var string $FileName
     */
    private $FileName;

    /**
     * File path property.
     *
     * @var string $FilePath
     */
    private $FilePath;

    /**
     * Php excel object property.
     *
     * @var \PHPExcel $PhpExcel
     */
    private $PhpExcel;

    /**
     * Excel reader type property.
     *
     * @var string $ReaderType
     */
    private $ReaderType;

    /**
     * Excel writer type property.
     *
     * @var string $WriterType
     */
    private $WriterType;

    /**
     * ExcelFile constructor.
     */
    public function __construct()
    {
        $this->PhpExcel = new \PHPExcel();
    }

    /**
     * Load and read excel file.
     *
     * @param string $filePath   Excel or csv file path that want to be load.
     * @param string $readerType The reader type that indicate the file type.
     *
     * @throws \PHPExcel_Reader_Exception If invalid reader type or the file cannot be loaded.
     * @return void
     */
    public function doRead($filePath, $readerType = 'Excel5')
    {
        try {
            $this->createReader();
        } catch (\PHPExcel_Reader_Exception $ex) {
            throw new \PHPExcel_Reader_Exception($ex->getMessage());
        }
    }

    /**
     * Get excel file name property.
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->FileName;
    }

    /**
     * Get excel file path property.
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->FilePath;
    }

    /**
     * Get excel reader type property.
     *
     * @return string
     */
    public function getReaderType()
    {
        return $this->ReaderType;
    }

    /**
     * Get excel writer type property.
     *
     * @return string
     */
    public function getWriterType()
    {
        return $this->WriterType;
    }

    /**
     * Set filename to be opened or created.
     *
     * @param string $fileName The filename.
     *
     * @return void
     */
    public function setFileName($fileName)
    {
        $this->FileName = $fileName;
    }

    /**
     * Set excel reader type property.
     *
     * @param string $readerType The excel reader type parameter.
     *
     * @return void
     */
    public function setReaderType($readerType)
    {
        $this->ReaderType = $readerType;
    }

    /**
     * Set excel writer type property.
     *
     * @param string $WriterType Excel writer type parameter.
     *
     * @return void
     */
    public function setWriterType($WriterType)
    {
        $this->WriterType = $WriterType;
    }

    /**
     * Create excel reader object.
     *
     * @param string $readerType Excel reader type parameter.
     *
     * @throws \PHPExcel_Reader_Exception If invalid reader type or the file cannot be loaded.
     *
     * @return \Bridge\Components\Exporter\Contracts\ExcelReaderInterface
     */
    private function createReader($readerType = 'Excel5')
    {
        try {
            # Create the reader.
            /**
             * Convert the object reader to ExcelReaderInterface via annotation.
             *
             * @var \Bridge\Components\Exporter\Contracts\ExcelReaderInterface $objReader
             */
            $objReader = \PHPExcel_IOFactory::createReader($readerType);
            $objReader->setReadDataOnly(true);
            return $objReader;
            # Set the PhpExcel object as the handler of file that want to be loaded.
        } catch (\PHPExcel_Reader_Exception $ex) {
            throw new \PHPExcel_Reader_Exception($ex->getMessage());
        }
    }

    /**
     * Create excel writer object.
     *
     * @param string $writerType Excel writer type parameter.
     *
     * @throws \PHPExcel_Reader_Exception If invalid writer type or the file cannot be loaded.
     *
     * @return \Bridge\Components\Exporter\Contracts\ExcelWriterInterface
     */
    private function createWriter($writerType = 'Excel5')
    {
        try {
            # Create the reader.
            /**
             * Convert the object reader to ExcelReaderInterface via annotation.
             *
             * @var \Bridge\Components\Exporter\Contracts\ExcelWriterInterface $objWriter
             */
            return \PHPExcel_IOFactory::createWriter($this->PhpExcel, $writerType);
        } catch (\PHPExcel_Writer_Exception $ex) {
            throw new \PHPExcel_Reader_Exception($ex->getMessage());
        }
    }

    /**
     * Convert BR tags to nl.
     *
     * @param array $originalArray The string to convert.
     *
     * @return array The converted values of the array.
     */
    private function doConvertBrToNl(array $originalArray)
    {
        $returnArray = [];
        foreach ($originalArray as $key => $value) {
            $returnArray[$key] = preg_replace('/\<br(\s*)?\/?\>/i', "\r\n", $value);
        }
        return $returnArray;
    }

    /**
     * Get the coordinate from row and column number.
     *
     * @param integer $row    The selected row number.
     * @param integer $column The selected column number.
     *
     * @return string
     */
    private function getCoordinate($row = 1, $column = 0)
    {
        $columnLetter = $this->getStringFromColumnIndex($column);
        return $columnLetter . $row;
    }

    /**
     * Get string value of column index from number.
     *
     * @param integer $column The column number.
     *
     * @return string
     * @throws \PHPExcel_Exception If invalid column number.
     */
    private function getStringFromColumnIndex($column = 0)
    {
        try {
            return \PHPExcel_Cell::stringFromColumnIndex($column);
        } catch (\PHPExcel_Exception $ex) {
            throw new \PHPExcel_Exception($ex->getMessage());
        }
    }

    /**
     * Set read data only
     *        Set to true, to advise the Reader only to read data values for cells, and to ignore any formatting
     *        information. Set to false (the default) to advise the Reader to read both data and formatting for cells.
     *
     * @param boolean $pValue Read-only flag parameter.
     *
     * @return \Bridge\Components\Exporter\Contracts\ExcelReaderInterface
     */
    public function setReadDataOnly($pValue = false)
    {
        # TODO: Implement setReadDataOnly() method.
    }

    /**
     * Can the current PHPExcel_Reader_IReader read the file?
     *
     * @param    string $pFilename
     *
     * @return    boolean
     */
    public function canRead($pFilename)
    {
        # TODO: Implement canRead() method.
    }

    /**
     * Loads PHPExcel from file
     *
     * @param    string $pFilename
     *
     * @return  \PHPExcel
     * @throws    \PHPExcel_Reader_Exception
     */
    public function load($pFilename)
    {
        # TODO: Implement load() method.
    }

    /**
     *  Save PHPExcel to file
     *
     * @param   string $pFilename Name of the file to save
     *
     * @throws  \PHPExcel_Writer_Exception
     */
    public function save($pFilename = null)
    {
        # TODO: Implement save() method.
    }
}
