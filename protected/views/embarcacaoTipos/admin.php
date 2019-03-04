<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);

?>

<div class="line-admin-top2">
	<div class="container">
		<h1 class="title-admin-form">Gerenciar Tipos de Embarcacões</h1>
			<div class="div-botao-cad-admin">
				<?php echo CHtml::link('CADASTRAR TIPO', array('EmbarcacaoTipos/create'), array('class'=>'botao-cad-admin'));?>
			</div>
	</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'embarcacao-tipos-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
			'name'=>'embarcacao_macros_id',
			'value'=>'GxHtml::valueEx($data->embarcacaoMacros)',
			'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
		),
		'titulo',
		array(
			'name' => 'status',
			'value' => '($data->status == 1) ? "Ativado" : "Desativado"',
			'filter' => array('0' => 'Ativados', '1' => 'Desativados'),
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}{activate}',
			'buttons' => array(
				'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("EmbarcacaoTipos/changestatus", array("id"=>$data->id))'
				)
			)
		),
	),
)); ?>