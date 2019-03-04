<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Tipos de acessórios</h1>
	<?php echo CHtml::link('Cadastrar', array('admin/acessorios/criar'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'acessorio-tipos-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'itemsCssClass' => "table table-bordered table-hover",
	'columns' => array(
		'id',
		'embarcacao_macros_id',
		'titulo',
		array(
			'name' => 'status',
			'value' => '($data->status === 0) ? Yii::t(\'app\', \'Inativo\') : Yii::t(\'app\', \'Ativo\')',
			'filter' => array('0' => Yii::t('app', 'Inativo'), '1' => Yii::t('app', 'Ativo')),
			),
		array(
			'class' => 'CButtonColumn',
			'buttons' => array(
				'view' => array(
					'options' => array('class'=>'pure-button fa fa-search pull-left')
				),
				'update' => array(
					'options' => array('class'=>'pure-button fa fa-pencil pull-left margin')
				),
				'delete' => array(
					'options' => array('class'=>'pure-button fa fa-trash pull-left')
				)
			)
		),
	),
)); ?>
