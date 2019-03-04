<?php
$this->breadcrumbs = array(
    $model->label(2) => array('index'),
    Yii::t('app', 'Manage'),
);
?>

<div class="line-admin-top2">
  <h1 class="title-admin-form">Notícias</h1>
	<?php echo CHtml::link('Cadastrar notícia', array('admin/comunidade/adicionar'), array('class'=>'botao-cad-admin btn btn-primary'));?>

	<?php echo CHtml::link('Voltar ao site', array('site/index'), array('class'=>'botao-cad-admin btn btn-primary'));?>
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id' => 'conteudos-grid',
	'dataProvider' => $model->search(),
	'itemsCssClass' => "table table-bordered table-hover",
	'filter' => $model,
	'columns' => array(
		'id',
		'titulo',
		//'texto',
		array(
			'name'=>'macro',
			'header' => 'Categoria',
			'value'=>'Conteudos::$macros[$data->macro]',
			'filter' => array('B' => 'Blog', 'T' => 'Raio X', 'N'=>'Notícias', 'P'=>'Primeiro Barco'),
		),

		array(
			'name' => 'status',
			'header' => 'Status',
			'value' => '($data->status == 0) ? "Desativado" : "Ativado"',
			'filter' => array('0' => 'Desativado', '1' => 'Ativado'),
		),


		array(
			'class' => 'CButtonColumn',
			'template' => '{view}{update}{activate}',
			'buttons' => array(
        'update' => array('options' => array('class' => 'fa fa-pencil')),
				'view' => array(
          'options' => array('class' => 'fa fa-search'),
					'url' => 'Conteudos::mountUrl($data)',
				),
				'activate' => array(
					'label' => "Ativar/Desativar",
					'url' => 'Yii::app()->createUrl("conteudos/changeStatus", array("id"=>$data->id))',
					'options'=>array('id' => 'btn-cancelar '),
					'click'=>"function() {
						if(!confirm('".Yii::t('warnings','Confirme para desativar a notícia')."')) return false;

							var id = $(this).attr('href').split('/').pop();

							$.ajax({
							type:'post',
							data: {
								id: id
							},
							url:$(this).attr('href'),
								success:function(resp) {
									if(resp != '-1') {
										alert('Alteração de status da notícia realizado com sucesso');
										//location.reload();
										$.fn.yiiGridView.update('conteudos-grid');
									}
									else {
										alert('Ocorreu uma falha inesperada');
									}
								}
							});
							return false;
						}",
				),
			)
		),
	),
)); ?>
