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
 * ExcelEntitiesBuilder class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class ExcelEntitiesBuilder
{

    /**
     * Data source entity collection property.
     *
     * @var array $Entities
     */
    private $Entities;

    /**
     * Excel file object property.
     *
     * @var \Bridge\Components\Exporter\BasicExcelFile
     */
    private $ExcelFileObject;

    /**
     * Excel file path that contains all the entities builder content property.
     *
     * @var string $FilePath
     */
    private $FilePath;

    /**
     * ExcelEntitiesBuilder constructor.
     *
     * @param string $filePath File path parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when construct the instance.
     */
    public function __construct($filePath)
    {
        try {
            $this->setFilePath($filePath);
            $this->load();
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Get entity collections.
     *
     * @return array
     */
    public function getEntities()
    {
        return $this->Entities;
    }

    /**
     * Get entity object.
     *
     * @param string $tableName Table entity name parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If table entity name not found on collections.
     *
     * @return \Bridge\Components\Exporter\Contracts\TableEntityInterface
     */
    public function getEntity($tableName)
    {
        if (array_key_exists($tableName, $this->getEntities()) === false) {
            throw new \Bridge\Components\Exporter\ExporterException('Table entity not found on collections');
        }
        return $this->getEntities()[$tableName];
    }

    /**
     * Get file path property.
     *
     * @return string
     */
    public function getFilePath()
    {
        return $this->FilePath;
    }

    /**
     * Load initialization of excel entities builder.
     *
     * @return void
     */
    protected function load()
    {
        $this->ExcelFileObject = new \Bridge\Components\Exporter\BasicExcelFile();
    }

    /**
     * Set the file path property
     *
     * @param string $filePath Excel file path parameter.
     *
     * @return void
     */
    protected function setFilePath($filePath)
    {
        $this->FilePath = $filePath;
    }
}
