<?php
/* @var $this OrdensController */
/* @var $model Ordens */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Ordens', 'url'=>array('index')),
	array('label'=>'Manage Ordens', 'url'=>array('admin')),
);
?>

<h1>Create Ordens</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>