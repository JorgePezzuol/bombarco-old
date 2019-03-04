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
'email',
'razao',
'tipo',
'logo',
'capa',
'maps',
'cnpj',
'telefone',
array(
			'name' => 'estados',
			'type' => 'raw',
			'value' => $model->estados !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->estados)), array('estados/view', 'id' => GxActiveRecord::extractPkValue($model->estados, true))) : null,
			),
array(
			'name' => 'cidades',
			'type' => 'raw',
			'value' => $model->cidades !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->cidades)), array('cidades/view', 'id' => GxActiveRecord::extractPkValue($model->cidades, true))) : null,
			),
'cep',
'endereco',
'numero',
'bairro',
'fanpage',
array(
			'name' => 'empresaCategorias',
			'type' => 'raw',
			'value' => $model->empresaCategorias !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->empresaCategorias)), array('empresaCategorias/view', 'id' => GxActiveRecord::extractPkValue($model->empresaCategorias, true))) : null,
			),
array(
			'name' => 'usuarios',
			'type' => 'raw',
			'value' => $model->usuarios !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->usuarios)), array('usuarios/view', 'id' => GxActiveRecord::extractPkValue($model->usuarios, true))) : null,
			),
array(
			'name' => 'macros',
			'type' => 'raw',
			'value' => $model->macros !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->macros)), array('macros/view', 'id' => GxActiveRecord::extractPkValue($model->macros, true))) : null,
			),
'status:boolean',
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('empresaImagens')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->empresaImagens as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('empresaImagens/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('empresaSeos')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->empresaSeos as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('empresaSeo/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('empresaRecursosAdicionaises')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->empresaRecursosAdicionaises as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('empresaRecursosAdicionais/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?><h2><?php echo GxHtml::encode($model->getRelationLabel('usuariosEmbarcacoes')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->usuariosEmbarcacoes as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('usuariosEmbarcacoes/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>