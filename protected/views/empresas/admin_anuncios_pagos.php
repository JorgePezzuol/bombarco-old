<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
  <h1 class="title-admin-form">Gerenciar Empresas - Anúncios Pagos</h1>
</div>

<?php
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'empresas-grid',
    'dataProvider' => $model->searchAnunciosPagos(),
    'itemsCssClass' => "table table-bordered table-hover",
    'filter' => $model,
    'columns' => array(
        'id',
        'email',
        'razao',
        'cnpj',
        'telefone',

        array(
            'name' => 'empresa_categorias_id',
            'value' => 'GxHtml::valueEx($data->empresaCategorias)',
            'filter' => GxHtml::listDataEx(EmpresaCategorias::model()->findAllAttributes(null, true)),
        ),
        array(
            'name' => 'status',
            'value' => 'Anuncio::$_status_anuncio_by_number[$data->status]',
        //'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
        ),
        array(
            'class' => 'CButtonColumn',
            'template' => '{view}{update}{activate}',
            'buttons' => array(
              'view' => array('options'=>array('class' => 'fa fa-search')),
              'update' => array('options'=>array('class' => 'fa fa-pencil')),
                'activate' => array(
                    'label' => "Ativar",
                    'url' => 'Yii::app()->createUrl("empresas/ativarAnuncio", array("id"=>$data->id))',
                    'options' => array('id' => 'btn-ativar', 'class' => 'fa fa-check'),
                    'click' => "function() {
						if(!confirm('" . Yii::t('warnings', 'Confirme para ativar o anúncio') . "')) return false;
							$.ajax({
							type:'GET',
							url:$(this).attr('href'),
								success:function(resp) {
									//console.log(resp);
									if(resp != '-1') {
										alert('Anúncio ativado com sucesso');
										location.reload();
									}

									else {
										alert('Falha ao ativar o anúncio. Tente mais tarde.');
									}
								},

								error:function(x, h,z) {
								alert('Falha ao ativar o anúncio. Tente mais tarde.');
								}
							});
							return false;
						}",
                ),
                'view' => array(
                    'url' => 'Empresas::mountUrl($data, $data->macros_id)',
                ),
            )
        ),
    ),
));
?>
