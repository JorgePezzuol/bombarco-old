<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
	<div class="container">
		<h1 class="title-admin-form">Gerenciar Motores</h1>
	</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'motores-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		//'id',
		array(
			'name'=>'motor_modelos_id',
			'value'=>'GxHtml::valueEx($data->motorModelos)',
			'filter'=>GxHtml::listDataEx(MotorModelos::model()->findAllAttributes(null, true)),
		),
		'titulo',
		'horas',
		array(
			'name' => 'status',
			'value' => '($data->status == 0) ? "Desativado" : "Ativado"',
			'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),		
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{activate}',
			'buttons' => array(
				'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("Motores/changestatus", array("id"=>$data->id))'
					)
			)
		),
	),
)); ?>