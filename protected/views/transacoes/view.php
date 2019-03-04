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
'tid',
'tid_externo',
'valor',
'descricao',
'data_criacao',
'data_confirmacao',
'formapagamento',
'status:boolean',
'detalhes',
array(
			'name' => 'usuarios',
			'type' => 'raw',
			'value' => $model->usuarios !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->usuarios)), array('usuarios/view', 'id' => GxActiveRecord::extractPkValue($model->usuarios, true))) : null,
			),
array(
			'name' => 'planoUsuarios',
			'type' => 'raw',
			'value' => $model->planoUsuarios !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->planoUsuarios)), array('planoUsuarios/view', 'id' => GxActiveRecord::extractPkValue($model->planoUsuarios, true))) : null,
			),
array(
			'name' => 'embarcacoes',
			'type' => 'raw',
			'value' => $model->embarcacoes !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacoes)), array('embarcacoes/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacoes, true))) : null,
			),
	),
)); ?>

