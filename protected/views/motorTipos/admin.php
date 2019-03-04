<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Tipos de Motores</h1>
	<?php echo CHtml::link('CADASTRAR TIPO', array('admin/motores/tipos/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'motor-tipos-grid',
	'itemsCssClass' => "table table-bordered table-hover",
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'titulo',
		array(
			'name' => 'status'
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{view} {update} {activate}',
			'buttons' => array(
				'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("motorTipos/changeStatus", array("id"=>$data->id))'
					)
			)
		),
	),
)); ?>
