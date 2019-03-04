<?php
/* @var $this OrdensController */
/* @var $model Ordens */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Ordens', 'url'=>array('index')),
	array('label'=>'Create Ordens', 'url'=>array('create')),
	array('label'=>'View Ordens', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Ordens', 'url'=>array('admin')),
);
?>

<h1>Update Ordens <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>