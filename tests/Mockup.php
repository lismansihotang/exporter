<?php
/**
 * Contains code written by the Invosa Systems Company and is strictly used within this program.
 * Any other use of this code is in violation of copy rights.
 *
 * @package   -
 * @author    Bambang Adrian Sitompul <bambang@invosa.com>
 * @copyright 2016 Invosa Systems Indonesia
 * @license   http://www.invosa.com/license No License
 * @version   GIT: $Id:$
 * @link      http://www.invosa.com
 */
include_once 'TestBootstrap.php';
# -------------------------------------------------------------------------------
# Mock-up for excel file.
# Using read mode.
$excelFile = new \Bridge\Components\Exporter\BasicExcelFile('../resources/files/Constraints/MasterData.xlsx');
$excelFile->doRead();
$excelArrayContents = $excelFile->getData();
# Using write mode.
$excelData = [];
$excelFile->setGrid($excelData);
$excelFile->doSave();
# General/public client access
$excelFile->doDownload();
# --------------------------------------------------------------------------------
# Data source decorator mock-up.
$dataSource = new \Bridge\Components\Exporter\ExcelDataSource('file-path');
$baseDataSource = new \Bridge\Components\Exporter\StandardDataSource($dataSource);
# Mock-up for table rules.
$tableSource = new \Bridge\Components\Exporter\AbstractEntity('tableName');
$tableDependency = new \Bridge\Components\Exporter\AbstractEntity('tableDependencyName');
# Mock-up for field constraint.
$fieldElement = new \Bridge\Components\Exporter\FieldElement('fieldName', $tableSource);
$fieldElement->setDependency($tableDependency, 'dependencyFieldName');
$fieldElement->setField('type', 'length');
$fieldElement->setEnum(['enumData']);
$fieldElement->setRequired(true);
$fieldElement->setDefaultValue('defaultValue');
$fieldElement->setAsPrimaryKey(true);
$fieldElement->getConstraints();
# Mock-up to adding fields into table.
$tableSource->setFields(['fieldsCollectionOfFieldElementObject']);
$tableSource->addField($fieldElement);
$tableSource->getFields();
# ----------------------------------------------------------------------------------
# Excel entity builder mock-up
$excelEntityBuilder = new \Bridge\Components\Exporter\ConstraintEntityBuilder('TableConstraint.xlsx');
# Mock-up for Excel data source.
$source = new \Bridge\Components\Exporter\ExcelDataSource('file path');
$target = new \Bridge\Components\Exporter\ExcelDataSource('file path');
# Mock-up for excel data master object
$matcher = new \Bridge\Components\Exporter\DataMapper($tableSource);
# Mock-up to set table entity under the matcher object.
$matcher->setSourceEntity($tableSource);
# Or if use excel entity
$matcher->setSourceEntity($excelEntityBuilder->getEntity('table-entity-name'));
# Mock-up for run the matcher excel data.
$matcher->setSource($source);
$matcher->setTargetEntity($target);
$matcher->runMapper();
$matcherResult = $matcher->getMappedData();
# -------------------------------------------------------------------------------------
# Mock-up for data source connection (DB access layer).
$exportTarget = new \Bridge\Components\Exporter\DbDataSource();
# Mock-up for run the exporter process.
$exporter = new \Bridge\Components\Exporter\BasicExporter();
$exporter->setExportedData($matcherResult);
# Mock-up for exporter process.
$exporter->setTargetObject($exportTarget);
$exporter->doExport();
$exporter->getStatus();
$exporter->getLog();
