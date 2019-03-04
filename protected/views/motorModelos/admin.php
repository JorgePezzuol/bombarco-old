<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Modelo de Motor</h1>
	<?php echo CHtml::link('CADASTRAR MODELO', array('admin/motores/modelos/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'motor-modelos-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => "table table-bordered table-hover",
	'columns' => array(
		'id',
		array(
				'name'=>'embarcacao_macros_id',
				'value'=>'GxHtml::valueEx($data->embarcacaoMacros)',
				'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
				),
		'titulo',
		'potencia',
		array(
				'name'=>'motor_fabricantes_id',
				'value'=>'GxHtml::valueEx($data->motorFabricantes)',
				'filter'=>GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'motor_tipos_id',
				'value'=>'GxHtml::valueEx($data->motorTipos)',
				'filter'=>GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true)),
				),
		array(
			'name' => 'status',
			'value' => '($data->status == 0) ? "Desativado" : "Ativado"',
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
					'url' => 'Yii::app()->createUrl("motorModelos/changeStatus", array("id"=>$data->id))'
					)
			)
		),
	),
)); ?>
