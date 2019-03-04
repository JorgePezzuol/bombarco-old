
<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Fabricantes de Motor</h1>
	<?php echo CHtml::link('CADASTRAR FABRICANTE', array('motorFabricantes/create'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>
<?php


 $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'motor-fabricantes-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'columns' => array(
		'titulo',
		array(
			'name' => 'status',
			'value' => '($data->status == 1) ? "Ativado" : "Desativado"',
			'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{activate}',
			'buttons' => array(
				'update' => array('options'=>array('class' => 'fa fa-pencil')),
				'view' => array('options'=>array('class' => 'fa fa-search	')),
				'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("motorFabricantes/changeStatus", array("id"=>$data->id))'
					)
			)
		),
	),
));

 ?>
