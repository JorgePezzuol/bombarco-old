<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
	<div class="container">
		<h1 class="title-admin-form">Gerenciar Fabricantes de Embarcação</h1>
		<?php echo CHtml::link('CADASTRAR FABRICANTE', array('admin/embarcacoes/fabricantes/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
	</div>
</div>



<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'embarcacao-fabricantes-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => "table table-bordered table-hover",
	'columns' => array(
		'id',
		'titulo',
		array(
			'name' => 'status',
			'value' => '($data->status == 0) ? "Desativado" : "Ativado"',
			'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),
		array(
				'name'=>'embarcacao_macros_id',
				'value'=>'$data->embarcacaoMacros->titulo',
				'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
				),
		 array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{activate}',
			'buttons' => array(
        'view' => array('options' => array('class' => 'fa fa-search')),
        'update' => array('options' => array('class' => 'fa fa-pencil')),
				'activate' => array(
					'label' => "Status",

					'url' => 'Yii::app()->createUrl("embarcacaoFabricantes/changeStatus", array("id"=>$data->id))'
				)
			)
		),
	),
)); ?>
