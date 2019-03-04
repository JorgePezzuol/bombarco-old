<?php
/* @var $this ContratoController */
/* @var $model Contrato */

$this->breadcrumbs=array(
	'Contratos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Contrato', 'url'=>array('index')),
	array('label'=>'Create Contrato', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#contrato-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Contratos</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'contrato-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'nome_fantasia',
		'razao_social',
		'data_fundacao',
		'rua',
		'numero',
		/*
		'complemento',
		'bairro',
		'cidade',
		'estado',
		'cep',
		'cnpj',
		'inscricao_estadual',
		'telefone',
		'site',
		'nome_representante_legal',
		'funcao_representante_legal',
		'cpf_representante_legal',
		'rg_representante_legal',
		'data_nascimento_representante_legal',
		'cel_representante_legal',
		'email_representante_legal',
		'email_pergunta',
		'resp_financeiro_nome',
		'resp_financeiro_email',
		'resp_financeiro_tel',
		'resp_anuncios_nome',
		'resp_anuncios_email',
		'resp_anuncios_tel',
		'resp_pecas_nome',
		'resp_pecas_email',
		'resp_pecas_tel',
		'plano_classificados_desc',
		'plano_classificados_periodo',
		'plano_classificado_valor',
		'plano_banner_site_bb_desc',
		'plano_banner_site_bb_periodo',
		'plano_banner_site_bb_valor',
		'plano_classificados_subtotal',
		'plano_banner_site_bb_subtotal',
		'plano_banner_news_desc',
		'plano_banner_news_periodo',
		'plano_banner_news_valor',
		'plano_banner_news_subtotal',
		'plano_emkt_desc',
		'plano_emkt_periodo',
		'plano_emkt_valor',
		'plano_emkt_subtotal',
		'plano_zeromilhas_desc',
		'plano_zeromilhas_periodo',
		'plano_zeromilhas_valor',
		'plano_zeromilhas_subtotal',
		'plano_impresso_guia_desc',
		'plano_impresso_guia_periodo',
		'plano_impresso_guia_valor',
		'plano_impresso_guia_subtotal',
		'plano_site_guia_desc',
		'plano_site_guia_periodo',
		'plano_site_guia_valor',
		'plano_site_guia_subtotal',
		'plano_raiox_desc',
		'plano_raiox_periodo',
		'plano_raiox_valor',
		'plano_raiox_subtotal',
		'plano_outros_desc',
		'plano_outros_periodo',
		'plano_outros_valor',
		'plano_outros_subtotal',
		'valor_total_contrato',
		'forma_pagamento',
		'num_parcelas_pagamento',
		'valor_parcelas_pagamento',
		'vencimento_parcelas_pagamento',
		'vencimento_primeira_parcela_pagamento',
		'observacao',
		'visto_bombarco',
		'visto_contratante',
		'segundo_visto_bombarco',
		'segundo_visto_contratante',
		'flg_renovacao',
		'num_contrato',
		'data',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
