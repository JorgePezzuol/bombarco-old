<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

?>

<h1>Tipo de Embarcacão - <?php echo GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
echo CHtml::link('Cadastrar Novo', array('EmbarcacaoTipos/create'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('EmbarcacaoTipos/admin'), array('class'=>'pure-button pure-button-primary'));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
		'id',
		array(
			'name' => 'embarcacaoMacros',
			'type' => 'raw',
			'value' => $model->embarcacaoMacros !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->embarcacaoMacros)), array('embarcacaoMacros/view', 'id' => GxActiveRecord::extractPkValue($model->embarcacaoMacros, true))) : null,
			),
		'titulo',
		array(
			'name' => 'status',
			'type' => 'raw',
			'value' => ($model->status == 1) ? "Ativado" : "Desativado"
			),
	),
)); ?>

<?php /* ?>
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
<?php */ ?>