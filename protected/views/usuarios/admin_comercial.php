<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Usuários</h1>
</div>

 <?php echo CHtml::link('Voltar ao site', array('site/index'), array('class'=>'botao-cad-admin btn btn-primary'));?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'grid-minha-conta',
	'dataProvider' => $model->search(),
	'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'columns' => array(
		'id',
		'nome',
		'email',
		//'cpf',
		//'telefone',
		array(
			'class' => 'CButtonColumn',
			'template'=>'{view}{switch}',
			'buttons' => array(
				'switch' => array(
					'label' => 'Simular',
					'url'=>'Yii::app()->createUrl("usuarios/switchuser", array("id"=>$data->id))',
					'options' => array('class'=>'pure-button')
					//'imageUrl' => Yii::app()->baseUrl.'/images/email.png'
				)
			)
		),
	),
)); ?>
