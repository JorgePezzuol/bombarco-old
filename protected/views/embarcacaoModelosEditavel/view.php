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
			'name' => 'embarcacaoMacros',
			'type' => 'raw',
			'value' => $model->embarcacaoMacros !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoMacros)), array('embarcacaoMacros/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoMacros, true))) : null,
			),
array(
			'name' => 'embarcacaoFabricantes',
			'type' => 'raw',
			'value' => $model->embarcacaoFabricantes !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoFabricantes)), array('embarcacaoFabricantes/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoFabricantes, true))) : null,
			),
array(
			'name' => 'embarcacaoTipos',
			'type' => 'raw',
			'value' => $model->embarcacaoTipos !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoTipos)), array('embarcacaoTipos/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoTipos, true))) : null,
			),
array(
			'name' => 'embarcacaoModelos',
			'type' => 'raw',
			'value' => $model->embarcacaoModelos !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoModelos)), array('embarcacaoModelos/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoModelos, true))) : null,
			),
'titulo',
'slug',
'tamanho',
'passageiros',
'acomodacoes',
'comprimento',
'boca',
'calado',
'pedireito',
'pesocasco',
'tanquecombustivel',
'tanqueagua',
'consumo',
'ncamarotes',
'nbanheiros',
'status:boolean',
'motordefabrica',
	),
)); ?>

