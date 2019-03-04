<?php
/* @var $this OrdensController */
/* @var $model Ordens */

$this->breadcrumbs=array(
	'Ordens'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Ordens', 'url'=>array('index')),
	array('label'=>'Create Ordens', 'url'=>array('create')),
	array('label'=>'Update Ordens', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Ordens', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Ordens', 'url'=>array('admin')),
);
?>

<h1>View Ordens #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'transacoes_id',
		'usuarios_id',
		'ordem_tipos_id',
		'id_item',
		'data_criacao',
		'data_ativacao',
		'valor',
		'descricao',
		'status',
	),
)); ?>
