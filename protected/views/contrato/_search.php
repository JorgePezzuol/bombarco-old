<?php
/* @var $this ContratoController */
/* @var $model Contrato */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome_fantasia'); ?>
		<?php echo $form->textArea($model,'nome_fantasia',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'razao_social'); ?>
		<?php echo $form->textArea($model,'razao_social',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_fundacao'); ?>
		<?php echo $form->textArea($model,'data_fundacao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rua'); ?>
		<?php echo $form->textArea($model,'rua',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'numero'); ?>
		<?php echo $form->textArea($model,'numero',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'complemento'); ?>
		<?php echo $form->textArea($model,'complemento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'bairro'); ?>
		<?php echo $form->textArea($model,'bairro',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cidade'); ?>
		<?php echo $form->textArea($model,'cidade',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'estado'); ?>
		<?php echo $form->textArea($model,'estado',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cep'); ?>
		<?php echo $form->textArea($model,'cep',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cnpj'); ?>
		<?php echo $form->textArea($model,'cnpj',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'inscricao_estadual'); ?>
		<?php echo $form->textArea($model,'inscricao_estadual',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'telefone'); ?>
		<?php echo $form->textArea($model,'telefone',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'site'); ?>
		<?php echo $form->textArea($model,'site',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'nome_representante_legal'); ?>
		<?php echo $form->textArea($model,'nome_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'funcao_representante_legal'); ?>
		<?php echo $form->textArea($model,'funcao_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cpf_representante_legal'); ?>
		<?php echo $form->textArea($model,'cpf_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'rg_representante_legal'); ?>
		<?php echo $form->textArea($model,'rg_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data_nascimento_representante_legal'); ?>
		<?php echo $form->textArea($model,'data_nascimento_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cel_representante_legal'); ?>
		<?php echo $form->textArea($model,'cel_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_representante_legal'); ?>
		<?php echo $form->textArea($model,'email_representante_legal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email_pergunta'); ?>
		<?php echo $form->textArea($model,'email_pergunta',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_financeiro_nome'); ?>
		<?php echo $form->textArea($model,'resp_financeiro_nome',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_financeiro_email'); ?>
		<?php echo $form->textArea($model,'resp_financeiro_email',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_financeiro_tel'); ?>
		<?php echo $form->textArea($model,'resp_financeiro_tel',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_anuncios_nome'); ?>
		<?php echo $form->textArea($model,'resp_anuncios_nome',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_anuncios_email'); ?>
		<?php echo $form->textArea($model,'resp_anuncios_email',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_anuncios_tel'); ?>
		<?php echo $form->textArea($model,'resp_anuncios_tel',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_pecas_nome'); ?>
		<?php echo $form->textArea($model,'resp_pecas_nome',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_pecas_email'); ?>
		<?php echo $form->textArea($model,'resp_pecas_email',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'resp_pecas_tel'); ?>
		<?php echo $form->textArea($model,'resp_pecas_tel',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_classificados_desc'); ?>
		<?php echo $form->textArea($model,'plano_classificados_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_classificados_periodo'); ?>
		<?php echo $form->textArea($model,'plano_classificados_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_classificado_valor'); ?>
		<?php echo $form->textArea($model,'plano_classificado_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_site_bb_desc'); ?>
		<?php echo $form->textArea($model,'plano_banner_site_bb_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_site_bb_periodo'); ?>
		<?php echo $form->textArea($model,'plano_banner_site_bb_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_site_bb_valor'); ?>
		<?php echo $form->textArea($model,'plano_banner_site_bb_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_classificados_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_classificados_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_site_bb_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_banner_site_bb_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_news_desc'); ?>
		<?php echo $form->textArea($model,'plano_banner_news_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_news_periodo'); ?>
		<?php echo $form->textArea($model,'plano_banner_news_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_news_valor'); ?>
		<?php echo $form->textArea($model,'plano_banner_news_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_banner_news_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_banner_news_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_emkt_desc'); ?>
		<?php echo $form->textArea($model,'plano_emkt_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_emkt_periodo'); ?>
		<?php echo $form->textArea($model,'plano_emkt_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_emkt_valor'); ?>
		<?php echo $form->textArea($model,'plano_emkt_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_emkt_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_emkt_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_zeromilhas_desc'); ?>
		<?php echo $form->textArea($model,'plano_zeromilhas_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_zeromilhas_periodo'); ?>
		<?php echo $form->textArea($model,'plano_zeromilhas_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_zeromilhas_valor'); ?>
		<?php echo $form->textArea($model,'plano_zeromilhas_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_zeromilhas_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_zeromilhas_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_impresso_guia_desc'); ?>
		<?php echo $form->textArea($model,'plano_impresso_guia_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_impresso_guia_periodo'); ?>
		<?php echo $form->textArea($model,'plano_impresso_guia_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_impresso_guia_valor'); ?>
		<?php echo $form->textArea($model,'plano_impresso_guia_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_impresso_guia_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_impresso_guia_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_site_guia_desc'); ?>
		<?php echo $form->textArea($model,'plano_site_guia_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_site_guia_periodo'); ?>
		<?php echo $form->textArea($model,'plano_site_guia_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_site_guia_valor'); ?>
		<?php echo $form->textArea($model,'plano_site_guia_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_site_guia_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_site_guia_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_raiox_desc'); ?>
		<?php echo $form->textArea($model,'plano_raiox_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_raiox_periodo'); ?>
		<?php echo $form->textArea($model,'plano_raiox_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_raiox_valor'); ?>
		<?php echo $form->textArea($model,'plano_raiox_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_raiox_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_raiox_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_outros_desc'); ?>
		<?php echo $form->textArea($model,'plano_outros_desc',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_outros_periodo'); ?>
		<?php echo $form->textArea($model,'plano_outros_periodo',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_outros_valor'); ?>
		<?php echo $form->textArea($model,'plano_outros_valor',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'plano_outros_subtotal'); ?>
		<?php echo $form->textArea($model,'plano_outros_subtotal',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor_total_contrato'); ?>
		<?php echo $form->textArea($model,'valor_total_contrato',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'forma_pagamento'); ?>
		<?php echo $form->textArea($model,'forma_pagamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_parcelas_pagamento'); ?>
		<?php echo $form->textArea($model,'num_parcelas_pagamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'valor_parcelas_pagamento'); ?>
		<?php echo $form->textArea($model,'valor_parcelas_pagamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vencimento_parcelas_pagamento'); ?>
		<?php echo $form->textArea($model,'vencimento_parcelas_pagamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vencimento_primeira_parcela_pagamento'); ?>
		<?php echo $form->textArea($model,'vencimento_primeira_parcela_pagamento',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'observacao'); ?>
		<?php echo $form->textArea($model,'observacao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visto_bombarco'); ?>
		<?php echo $form->textArea($model,'visto_bombarco',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'visto_contratante'); ?>
		<?php echo $form->textArea($model,'visto_contratante',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'segundo_visto_bombarco'); ?>
		<?php echo $form->textArea($model,'segundo_visto_bombarco',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'segundo_visto_contratante'); ?>
		<?php echo $form->textArea($model,'segundo_visto_contratante',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'flg_renovacao'); ?>
		<?php echo $form->textArea($model,'flg_renovacao',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'num_contrato'); ?>
		<?php echo $form->textArea($model,'num_contrato',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'data'); ?>
		<?php echo $form->textArea($model,'data',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->