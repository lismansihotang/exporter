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
 * TableEntityBuilder class description.
 *
 * @package    Components
 * @subpackage Exporter
 * @author     Bambang Adrian Sitompul <bambang.adrian@gmail.com>
 * @copyright  2016 -
 * @release    $Revision$
 */
class TableEntityBuilder extends \Bridge\Components\Exporter\AbstractEntityBuilder
{

    /**
     * Constraint instance property.
     *
     * @var array $Constraints
     */
    protected $Constraints;

    /**
     * Field constraint that will mapped to the table entity instance.
     *
     * @var array $FieldConstraintMapper
     */
    protected $FieldConstraintMapper;

    /**
     * TableEntityBuilder constructor.
     *
     * @param \Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource  Data source instance parameter.
     * @param array                                                     $constraints Constraint entity instance
     *                                                                               collection data parameter.
     *
     * @throws \Bridge\Components\Exporter\ExporterException If any error raised when construct and build the object.
     */
    public function __construct(
        \Bridge\Components\Exporter\Contracts\DataSourceInterface $dataSource,
        array $constraints = []
    ) {
        try {
            $this->setConstraints($constraints);
            parent::__construct($dataSource);
        } catch (\Exception $ex) {
            throw new \Bridge\Components\Exporter\ExporterException($ex->getMessage());
        }
    }

    /**
     * Get field constraint mapper data property.
     *
     * @return array
     */
    public function getFieldConstraintMapper()
    {
        return $this->FieldConstraintMapper;
    }

    /**
     * Set the entity constraint property.
     *
     * @param array $constraints Constraint entity instance collection data parameter.
     *
     * @return void
     */
    public function setConstraints(array $constraints = [])
    {
        foreach ($constraints as $constraintName => $constraintData) {
            if ($constraintData instanceof \Bridge\Components\Exporter\Contracts\ConstraintInterface) {
                $this->Constraints[$constraintName] = $constraintData;
            }
        }
    }

    /**
     * Set the field constraint mapper data property.
     *
     * @param array $fieldConstraintMapper Field constraint mapper data parameter.
     *
     * @return void
     */
    public function setFieldConstraintMapper($fieldConstraintMapper)
    {
        $this->FieldConstraintMapper = $fieldConstraintMapper;
    }
}
