<?php

$this->breadcrumbs = array(
	$model->label(2) => array('index'),
	Yii::t('app', 'Manage'),
);
?>
<div class="line-admin-top2">
	<h1 class="title-admin-form">Gerenciar Usuários</h1>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'grid-minha-conta',
	'dataProvider' => $model->search(),
	'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'columns' => array(
		'id',
		array(
			'name'=>'usuario_classificacoes_id',
			'value'=>'GxHtml::valueEx($data->usuarioClassificacoes)',
			'filter'=>GxHtml::listDataEx(UsuarioClassificacoes::model()->findAllAttributes(null, true)),
		),
		'pessoa',
		'nome',
		'email',
		'cpf',
		'telefone',
		/*array(
			'header' => 'Plano',
			'value' => 'GxHtml::valueEx($data->planoUsuarioses)',
		),*/
		array(
				'name'=>'estados_id',
				'value'=>'GxHtml::valueEx($data->estados)',
				'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
				),
		array(
				'name'=>'cidades_id',
				'value'=>'GxHtml::valueEx($data->cidades)',
				'filter'=>GxHtml::listDataEx(Cidades::model()->findAllAttributes(null, true)),
				),
		array(
			'class' => 'CButtonColumn',
			'template'=>'{view}{switch}',
			'buttons' => array(
				'switch' => array(
					'label' => 'Simular',
					'url'=>'Yii::app()->createUrl("usuarios/switchuser", array("id"=>$data->id))',
					'options' => array('class'=>'pure-button')
					//'imageUrl' => Yii::app()->baseUrl.'/images/email.png'
				),
				'view' => array(
					'label' => 'Abrir',
					'url'=>'Yii::app()->createUrl("admin/usuarios/ver/$data->id")',
					'options' => array('class'=>'pure-button fa fa-search'),
					'visible' => 'Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()'
				)
			)
		),
	),
)); ?>
