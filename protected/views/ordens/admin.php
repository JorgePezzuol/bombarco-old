<div class="container">
<h1>Compras com cartão - Turbinadas</h1>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'ordens-grid',
	'dataProvider'=>$model->searchTurbinadas(),
	'filter'=>$model,
	'columns'=>array(
		/*array(
			'name'=>'tid_externo', 
			'value'=>'Transacoes::model()->findByPk($data->transacoes_id)->tid_externo'
		),*/
		array('header' => 'Identificação', 'name'=>'tid_externo', 'value'=>'$data->transacoes->tid_externo' ),
		array(
			'name'=>'descricao',
			
			'filter' => false,
			//'filter'=>GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)),
		),
		array(
			'header' => 'Valor',
			'name' => 'valor',
			'value' =>'($data->valor == 0.00) ? "Não informado" : "R$ ".number_format($data->valor, 2, ",", ".")',
			'filter' => false
		),
		array(
			'name'=>'usuarios_id',
			'value'=>'GxHtml::valueEx($data->usuarios)',
			'filter' => false,
			//'filter'=>GxHtml::listDataEx(Usuarios::model()->findAllAttributes(null, true)),
		),

		array(
			'header' => 'Data',
			'name' => 'data_criacao',
			'value' => 'Utils::formatDateTimeToView($data->data_criacao)',
			'filter' => false
		),

		/*
		'data_ativacao',
		'valor',
		'descricao',
		'status',
		*/

	),
)); ?>
</div>
