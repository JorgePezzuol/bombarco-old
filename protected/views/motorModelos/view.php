<?php
echo CHtml::link('Cadastrar Novo', array('motorModelos/create'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('motorModelos/admin'), array('class'=>'pure-button pure-button-primary'));
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
array(
			'name' => 'embarcacaoMacros',
			'type' => 'raw',
			'value' => $model->embarcacaoMacros !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoMacros)), array('embarcacaoMacros/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoMacros, true))) : null,
			),
'titulo',
'potencia',
array(
			'name' => 'motorFabricantes',
			'type' => 'raw',
			'value' => $model->motorFabricantes !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->motorFabricantes)), array('motorFabricantes/view', 'id' => GxActiveRecord::extractPkValue($model->motorFabricantes, true))) : null,
			),
array(
			'name' => 'motorTipos',
			'type' => 'raw',
			'value' => $model->motorTipos !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->motorTipos)), array('motorTipos/view', 'id' => GxActiveRecord::extractPkValue($model->motorTipos, true))) : null,
			),
	),
)); ?>


<?php
/*
	echo GxHtml::openTag('ul');
	foreach($model->motores as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('motores/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
	*/
?>