<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);
?>

<h1>Redirect - <?php echo GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
echo CHtml::link('Cadastrar Novo', array('Redirects/create'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('Redirects/admin'), array('class'=>'pure-button pure-button-primary'));
?>

<?php $this->widget('zii.widgets.CDetailView', array(
			'data' => $model,
			'attributes' => array(
			'id',
			'de',
			'para',
			array(
				'label' => 'Status',
				'type' => 'raw',
				'value' => ($model->status === '1') ? 'Ativado' : 'Desativado'
			),
		),	
	)
); ?>

