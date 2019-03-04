

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'transacoes-grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'tid_externo',
		array(
			'name'=>'descricao_ordem',
			'header'=>"Descrição",
			'value'=>'Ordens::model()->find(":transacoes_id=:transacoes_id", array(":transacoes_id"=>$data->id))->descricao',
			'filter'=>false,
		),
		'valor',

		'data_criacao',

		/*
		'data_confirmacao',
		'formapagamento',
		array(
					'name' => 'status',
					'value' => '($data->status === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
					'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
					),
		'detalhes',
		array(
				'name'=>'usuarios_id',
				'value'=>'GxHtml::valueEx($data->usuarios)',
				'filter'=>GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'plano_usuarios_id',
				'value'=>'GxHtml::valueEx($data->planoUsuarios)',
				'filter'=>GxHtml::listDataEx(PlanoUsuarios::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'embarcacoes_id',
				'value'=>'GxHtml::valueEx($data->embarcacoes)',
				'filter'=>GxHtml::listDataEx(Embarcacoes::model()->findAllAttributes(null, true)),
				),
		*/
		/*array(
			'class' => 'CButtonColumn',
		),*/
	),
)); ?>