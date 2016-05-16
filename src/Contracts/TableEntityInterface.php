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
 * TableEntityInterface class description.
 *
 * @package    Components
 * @subpackage Exporter\Contracts
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
interface TableEntityInterface
{

    /**
     * Get selected field property.
     *
     * @param string $fieldName Field name parameter.
     *
     * @return array
     */
    public function getField($fieldName);

    /**
     * Get fields collection information.
     *
     * @return array
     */
    public function getFields();

    /**
     * Get table name property.
     *
     * @return string
     */
    public function getName();
}
