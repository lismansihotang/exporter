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
 * AbstractDataSourceDecorator class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
abstract class AbstractExporterDataSourceDecorator implements \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface
{

    /**
     * Source adapter object.
     *
     * @var \Bridge\Components\Exporter\Contracts\ExporterDataSourceInterface $SourceAdapter
     */
    protected $SourceAdapter;


}
