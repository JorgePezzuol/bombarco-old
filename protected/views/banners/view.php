<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);

?>

<div class="container">


<h1>Banner cadastrado com sucesso</h1>

    <?php echo CHtml::link('Voltar a Lista', array('banners/admin'), array('class'=>'botao-cad-admin')); ?>

    <br/><br/>

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
			'name' => 'usuarios',
			'type' => 'raw',
			'value' => $model->usuarios !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->usuarios)), array('usuarios/view', 'id' => GxActiveRecord::extractPkValue($model->usuarios, true))) : null,
			),

	),
)); 
?>


</div>


