<?php
$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	GxHtml::valueEx($model),
);
?>

<h1>Modelo - <?php echo GxHtml::encode(GxHtml::valueEx($model)); ?></h1>

<?php
echo CHtml::link('Cadastrar Novo', array('/admin/embarcacoes/modelos/criar'), array('class'=>'pure-button pure-button-primary'));
echo CHtml::link('Voltar a Lista', array('/admin/embarcacoes/modelos'), array('class'=>'pure-button pure-button-primary'));
?>

<?php
	if($model->embarcacao_macros_id == 1) {
		 $this->widget('zii.widgets.CDetailView', array(
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
			'titulo',
			'motor_de_fabrica',

			array(
				'label' => 'Status',
				'type' => 'raw',
				'value' => ($model->status === '1') ? 'Ativado' : 'Desativado'
				),
			),
		));
	}

	else {
		$this->widget('zii.widgets.CDetailView', array(
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
		'titulo',
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
		'motor_de_fabrica',
		'consumo',
		'ncamarotes',
		'nbanheiros',
		array(
			'label' => 'Status',
			'type' => 'raw',
			'value' => ($model->status === '1') ? 'Ativado' : 'Desativado'
			),
		),
	));
	}
?>



<br/><br/>
<h2><?php echo 'Embarcações relacionadas a este modelo'; ?></h2>
<?php
	echo GxHtml::openTag('ul');
	foreach($model->embarcacoes as $relatedModel) {
		echo GxHtml::openTag('li');
		echo GxHtml::link(GxHtml::encode(GxHtml::valueEx($relatedModel).' / '.$relatedModel->email), Embarcacoes::model()->mountUrl($relatedModel));
		echo GxHtml::closeTag('li');
	}
	echo GxHtml::closeTag('ul');

?>
