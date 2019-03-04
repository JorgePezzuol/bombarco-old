<div class="line-admin-top2">
		<h1 class="title-admin-form">Embarcações de Estaleiros</h1>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'embarcacoes-grid',
	'dataProvider' => $model->searchEmbarcacoesEstaleiro(),
	'filter' => $model,
	'itemsCssClass' => "table table-bordered table-hover",
	'columns' => array(
		'id',
		array(
			'name'=>'embarcacao_macros_id',
			'value'=>'$data->embarcacaoModelos->embarcacaoFabricantes->embarcacaoMacros->titulo',
			'filter'=>GxHtml::listDataEx(EmbarcacaoMacros::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'embarcacao_fabricantes_id',
			'header'=>'Fabricante',
			'value'=>'GxHtml::valueEx($data->embarcacaoFabricantes)',
			'filter'=>GxHtml::listDataEx(EmbarcacaoFabricantes::model()->findAll(array('condition'=>'status=1', 'order'=>'titulo asc'))),
			),
		array(
			'name'=>'embarcacao_modelos_id',
			'value'=>'GxHtml::valueEx($data->embarcacaoModelos)',
			'filter'=>GxHtml::listDataEx(EmbarcacaoModelos::model()->findAll(array('condition'=>'status=1', 'order'=>'titulo asc'))),
			),

		array(
			'name'=>'estados_id',
			'value'=>'GxHtml::valueEx($data->estados)',
			'filter'=>GxHtml::listDataEx(Estados::model()->findAllAttributes(null, true)),
			),
		array(
			'name'=>'valor',
			'value' =>'($data->valor == "") ? "Não informado" : "R$ ".Utils::formataValorView($data->valor)',
		),
			array(
			'name'=>'email',
			'value'=>'$data->email',
			'filter'=>GxHtml::listDataEx(Usuarios::model()->findAll(array('order'=>'email asc'))),
		),


		array(
			'name'=> 'ano',
			'value' => '($data->ano == "") ? "Não informado" : $data->ano',
		),
		/*array(
			'name' => 'qntmotores',
			'value' => '($data->qntmotores === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			),*/
		//'descricao',
		array(
			'name'=> 'views',
			'value' => '($data->views == 0) ? "Nenhuma visualização" : $data->views',
		),
		//'video',
		/*array(
			'name' => 'destaque',
			'value' => '($data->destaque === 0) ? Yii::t(\'app\', \'No\') : Yii::t(\'app\', \'Yes\')',
			'filter' => array('0' => Yii::t('app', 'No'), '1' => Yii::t('app', 'Yes')),
			),*/

		array(
			'name'=> 'status',
			'value' => 'Anuncio::$_status_anuncio_by_number[$data->status]',
			'filter'=>array(Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]=>'Ativados',
							Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"]=>'Vendidos',
							Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"]=>'Expirados'),
		),

		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{deactivate}{activate}',
			'buttons' => array(
				'view' => array(
					'label' => '',
					'url' => 'Embarcacoes::mountUrl($data)',
					'options'=>array('class'=>'ic-view fa fa-search'),
					'imageUrl' => ''
				),
				'update'=> array(
					'label' => '',
					//'visible'=>'$data->status != Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"] && $data->status != Anuncio::$_status_anuncio["ANUNCIO_VENDIDO"]',
					'options'=>array('class'=>'ic-update fa fa-pencil'),
					'imageUrl' => ''
				),
				'deactivate' => array(
					// só aparecer o botao de cancelar se tiver editado (editado = 1)
					'label' => '',
					'visible'=>'$data->status == Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]',
					'url' => 'Yii::app()->createUrl("Embarcacoes/statusAnuncio", array("id"=>$data->id))',
					'options'=>array('id'=>'btn_desativar','class'=>'ic-delete fa fa-times btn-change-status', 'data-status'=>Anuncio::$_status_anuncio['ANUNCIO_EXPIRADO']),
					'click' => "function(e) {
						e.preventDefault();
						var s = confirm('Deseja confirmar?');
						if(s) {
							$.ajax({
								url: $(this).attr('href'),
								data: {
									status: $(this).data('status')
								},
								type: 'POST',
								success: function(resp) {
									var json = JSON.parse(resp);
									alert(json.msg);
									$.fn.yiiGridView.update('embarcacoes-grid');	
									
								},
								error: function(x, h, z) {

								}
							});
						}
					}"
				),
				'activate' => array(
					'label' => '',
					'visible'=>'$data->status == Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"]',
					'url' => 'Yii::app()->createUrl("Embarcacoes/statusAnuncio", array("id"=>$data->id))',
					'options'=>array('class'=>'ic-continue fa fa-check btn-change-status', 'data-status'=>Anuncio::$_status_anuncio['ANUNCIO_ATIVADO']),
					'click' => "function(e) {
						e.preventDefault();
						var s = confirm('Deseja confirmar?');
						if(s) {
							$.ajax({
								url: $(this).attr('href'),
								data: {
									status: $(this).data('status')
								},
								type: 'POST',
								success: function(resp) {
									var json = JSON.parse(resp);
									alert(json.msg);
									$.fn.yiiGridView.update('embarcacoes-grid');
								},
								error: function(x, h, z) {

								}
							});
						}
					}"
				),
			)
		),
	),
)); ?>
