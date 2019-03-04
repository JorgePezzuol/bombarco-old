<?php
/* @var $this OrdensController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Ordens',
);

$this->menu=array(
	array('label'=>'Create Ordens', 'url'=>array('create')),
	array('label'=>'Manage Ordens', 'url'=>array('admin')),
);
?>

<h1>Ordens</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
