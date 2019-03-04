<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Tipos de Empresa</h1>
	<?php echo CHtml::link('CADASTRAR', array('admin/empresas/tipos/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'empresa-categorias-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'columns' => array(
		'id',
		'titulo',
		array(
			'class' => 'CButtonColumn',
			'buttons' => array(
				'view' => array('options' => array('class'=>'fa fa-search')),
				'update' => array('options' => array('class'=>'fa fa-pencil')),
				'delete' => array('options' => array('class'=>'fa fa-trash')),
			)
		),
	),
)); ?>
