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
 * MapperInterface class description.
 *
 * @package    Components
 * @subpackage Exporter\Contracts
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
interface MapperInterface
{

    /**
     * Get the mapper data property.
     *
     * @return array
     */
    public function getDataMapper();

    /**
     * Get matcher result data.
     *
     * @return array
     */
    public function getResult();

    /**
     * Run mapper as matcher procedure result.
     *
     * @return boolean
     */
    public function runMapper();
}
