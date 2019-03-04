<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
	<div class="container">
		<h1 class="title-admin-form">Gerenciar Modelos de Embarcação</h1>
		<?php echo CHtml::link('CADASTRAR MODELO', array('admin/embarcacoes/modelos/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
	</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'embarcacao-modelos-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'columns' => array(
		'id',
		array(
			'name'=>'embarcacao_macros_id',
			'value'=>'GxHtml::valueEx($data->embarcacaoMacros)',
			'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
		),
		array(
			'name'=>'embarcacao_fabricantes_id',
			'value'=>'GxHtml::valueEx($data->embarcacaoFabricantes)',
			'filter' => GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAllAttributes(null, true, 'status = 1')),
		),
		array(
			'name'=>'embarcacao_tipos_id',
			'value'=>'GxHtml::valueEx($data->embarcacaoTipos)',
			'filter'=>GxHtml::listDataEx(EmbarcacaoTipos::model()->findAllAttributes(null, true)),
		),
		'titulo',
		'tamanho',
		'passageiros',
		'acomodacoes',
		'comprimento',
		/*'boca',
		'calado',
		'pedireito',
		'pesocasco',
		'tanquecombustivel',
		'tanqueagua',
		'consumo',
		'ncamarotes',
		'nbanheiros',*/
		array(
			'name' => 'status',
			'value' => '($data->status == 0) ? "Desativado" : "Ativado"',
			'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{activate}',
			'buttons' => array(
        'view' => array('options' => array('class' => 'fa fa-search')),
        'update' => array('options' => array('class' => 'fa fa-pencil')),
				'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("EmbarcacaoModelos/changeStatus", array("id"=>$data->id))'
					)
			)
		),
	),
)); ?>
