
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'plano-usuarios-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'fim',
		'qntpermitida',
		array(
				'name'=>'planos_id',
				'value'=>'GxHtml::valueEx($data->planos)',
				'filter'=>GxHtml::listDataEx(Planos::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'usuarios_id',
				'value'=>'GxHtml::valueEx($data->usuarios)',
				'filter'=>GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)),
				),
		
		array(
			'name' => 'status',
			'value' => 'Anuncio::$_status_plano_id[$data->status]',
			'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),		
		
		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}',
		),
	),
)); ?>