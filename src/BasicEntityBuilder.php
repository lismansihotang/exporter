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
 * BasicEntityBuilder class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class BasicEntityBuilder extends \Bridge\Components\Exporter\AbstractEntityBuilder
{

    /**
     * Constraint instance property.
     *
     * @var \Bridge\Components\Exporter\Contracts\ConstraintInterface $Constraint
     */
    protected $Constraint;

    /**
     * BasicEntityBuilder constructor.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource    Data source instance parameter.
     * @param \Bridge\Components\Exporter\Contracts\ConstraintInterface $objConstraint Constraint entity instance
     *                                                                                 parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when construct and build the object.
     */
    public function __construct(
        \Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource,
        \Bridge\Components\Exporter\Contracts\ConstraintInterface $objConstraint
    ) {
        try {
            $this->setConstraint($objConstraint);
            parent::__construct($dataSource);
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Set the entity constraint property.
     *
     * @param \Bridge\Components\Exporter\Contracts\ConstraintInterface $objConstraint Constraint entity instance
     *                                                                                 parameter.
     *
     * @return void
     */
    public function setConstraint(\Bridge\Components\Exporter\Contracts\ConstraintInterface $objConstraint)
    {
        $this->Constraint = $objConstraint;
    }
}
