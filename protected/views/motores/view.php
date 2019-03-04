<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);
?>

<h1>Motor - <?php echo GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
	'id',
	'titulo',
	'horas',
	array(
			'label' => 'Status',
			'type' => 'raw',
			'value' => ($model->status === '1') ? "Ativado" : "Desativado"
			),
		),
)); ?>

<?php /* ?>
<h2><?php echo GxHtml::encode($model->getRelationLabel('embarcacoes')); ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->embarcacoes as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel)), array('embarcacoes/view', 'id' => GxActiveRecord::extractPkValue($relatedModel, true)));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');
?>
<?php */ ?>