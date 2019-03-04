<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

$this->menu=array(
	array('label'=>Yii::t('app', 'List') . ' ' . $model->label(2), 'url'=>array('index')),
	array('label'=>Yii::t('app', 'Create') . ' ' . $model->label(), 'url'=>array('create')),
	array('label'=>Yii::t('app', 'Update') . ' ' . $model->label(), 'url'=>array('update', 'id' => $model->id)),
	array('label'=>Yii::t('app', 'Delete') . ' ' . $model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url'=>array('admin')),
);
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
array(
			'name' => 'empresas',
			'type' => 'raw',
			'value' => $model->empresas !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->empresas)), array('empresas/view', 'id' => GxActiveRecord::extractPkValue($model->empresas, true))) : null,
			),
array(
			'name' => 'empresaCategorias',
			'type' => 'raw',
			'value' => $model->empresaCategorias !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->empresaCategorias)), array('empresaCategorias/view', 'id' => GxActiveRecord::extractPkValue($model->empresaCategorias, true))) : null,
			),
'title',
'description',
'keywords',
'follow:boolean',
'index:boolean',
	),
)); ?>

