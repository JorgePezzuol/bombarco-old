<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar agenda</h1>
	<?php echo CHtml::link('Cadastrar', array('admin/comunidade/agendas/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'agendas-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => "table table-bordered table-hover",
	'columns' => array(
		'id',
		'titulo',
		'texto',
		'local',
		'data_inicio',
		'data_fim',
		/*
		'imagem',
		'fanpage',
		*/
		array(
			'class' => 'CButtonColumn',
			'buttons' => array(
				'view' => array('options' => array('class'=> 'fa fa-search')),
				'update' => array('options' => array('class'=> 'fa fa-pencil')),
				'delete' => array('options' => array('class'=> 'fa fa-trash')),
			)
		),
	),
)); ?>
