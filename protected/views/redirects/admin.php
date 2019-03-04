<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
	<div class="container">
		<h1 class="title-admin-form">Gerenciar Redirect</h1>
			<div class="div-botao-cad-admin">
				<?php echo CHtml::link('CADASTRAR REDIRECT', array('Redirects/create'), array('class'=>'botao-cad-admin'));?>
			</div>
	</div>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'redirects-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		'de',
		'para',
		array(
			'name' => 'status',
			//'value' => '($data->status == 0) ? Desativado : Ativado',
			//'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{delete}{activate}',
			'buttons' => array(
				'activate' => array(
					'label' => "Status",
					'url' => 'Yii::app()->createUrl("Redirects/changestatus", array("id"=>$data->id))'
					)
			)
		),
	),
)); ?>