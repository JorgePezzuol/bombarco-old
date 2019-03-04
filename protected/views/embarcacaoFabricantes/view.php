<?php
echo CHtml::link('Cadastrar Novo', array('embarcacaoFabricantes/create'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('embarcacaoFabricantes/admin'), array('class'=>'pure-button pure-button-primary'));
?>

<h1><?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label()) . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'id',
'titulo',
'status:boolean',
array(
			'name' => 'embarcacaoMacros',
			'type' => 'raw',
			'value' => $model->embarcacaoMacros !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoMacros)), array('embarcacaoMacros/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoMacros, true))) : null,
		),
	),
)); ?>

<h2><?php echo GxHtml::encode($model->getRelationLabel('embarcacaoModeloses')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->embarcacaoModeloses as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('embarcacaoModelos/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>





