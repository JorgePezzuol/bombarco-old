<?php
echo CHtml::link('Cadastrar Novo', array('motorFabricantes/create'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('motorFabricantes/admin'), array('class'=>'pure-button pure-button-primary'));
?>

<h1><?php echo Yii::t('app', 'Motor') . ' ' . GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data' => $model,
	'attributes' => array(
'titulo',
	),
)); ?>
