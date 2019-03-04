<?php
/* @var $this ContratoController */
/* @var $data Contrato */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_fantasia')); ?>:</b>
	<?php echo CHtml::encode($data->nome_fantasia); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('razao_social')); ?>:</b>
	<?php echo CHtml::encode($data->razao_social); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_fundacao')); ?>:</b>
	<?php echo CHtml::encode($data->data_fundacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rua')); ?>:</b>
	<?php echo CHtml::encode($data->rua); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('numero')); ?>:</b>
	<?php echo CHtml::encode($data->numero); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('complemento')); ?>:</b>
	<?php echo CHtml::encode($data->complemento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('bairro')); ?>:</b>
	<?php echo CHtml::encode($data->bairro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cidade')); ?>:</b>
	<?php echo CHtml::encode($data->cidade); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('estado')); ?>:</b>
	<?php echo CHtml::encode($data->estado); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cep')); ?>:</b>
	<?php echo CHtml::encode($data->cep); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cnpj')); ?>:</b>
	<?php echo CHtml::encode($data->cnpj); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('inscricao_estadual')); ?>:</b>
	<?php echo CHtml::encode($data->inscricao_estadual); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefone')); ?>:</b>
	<?php echo CHtml::encode($data->telefone); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nome_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->nome_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('funcao_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->funcao_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cpf_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->cpf_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rg_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->rg_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data_nascimento_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->data_nascimento_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cel_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->cel_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_representante_legal')); ?>:</b>
	<?php echo CHtml::encode($data->email_representante_legal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_pergunta')); ?>:</b>
	<?php echo CHtml::encode($data->email_pergunta); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_financeiro_nome')); ?>:</b>
	<?php echo CHtml::encode($data->resp_financeiro_nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_financeiro_email')); ?>:</b>
	<?php echo CHtml::encode($data->resp_financeiro_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_financeiro_tel')); ?>:</b>
	<?php echo CHtml::encode($data->resp_financeiro_tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_anuncios_nome')); ?>:</b>
	<?php echo CHtml::encode($data->resp_anuncios_nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_anuncios_email')); ?>:</b>
	<?php echo CHtml::encode($data->resp_anuncios_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_anuncios_tel')); ?>:</b>
	<?php echo CHtml::encode($data->resp_anuncios_tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_pecas_nome')); ?>:</b>
	<?php echo CHtml::encode($data->resp_pecas_nome); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_pecas_email')); ?>:</b>
	<?php echo CHtml::encode($data->resp_pecas_email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('resp_pecas_tel')); ?>:</b>
	<?php echo CHtml::encode($data->resp_pecas_tel); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_classificados_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_classificados_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_classificados_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_classificados_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_classificado_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_classificado_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_site_bb_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_site_bb_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_site_bb_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_site_bb_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_site_bb_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_site_bb_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_classificados_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_classificados_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_site_bb_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_site_bb_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_news_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_news_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_news_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_news_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_news_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_news_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_banner_news_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_banner_news_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_emkt_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_emkt_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_emkt_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_emkt_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_emkt_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_emkt_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_emkt_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_emkt_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_zeromilhas_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_zeromilhas_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_zeromilhas_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_zeromilhas_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_zeromilhas_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_zeromilhas_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_zeromilhas_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_zeromilhas_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_impresso_guia_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_impresso_guia_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_impresso_guia_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_impresso_guia_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_impresso_guia_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_impresso_guia_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_impresso_guia_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_impresso_guia_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_site_guia_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_site_guia_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_site_guia_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_site_guia_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_site_guia_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_site_guia_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_site_guia_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_site_guia_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_raiox_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_raiox_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_raiox_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_raiox_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_raiox_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_raiox_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_raiox_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_raiox_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_outros_desc')); ?>:</b>
	<?php echo CHtml::encode($data->plano_outros_desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_outros_periodo')); ?>:</b>
	<?php echo CHtml::encode($data->plano_outros_periodo); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_outros_valor')); ?>:</b>
	<?php echo CHtml::encode($data->plano_outros_valor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('plano_outros_subtotal')); ?>:</b>
	<?php echo CHtml::encode($data->plano_outros_subtotal); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_total_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->valor_total_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forma_pagamento')); ?>:</b>
	<?php echo CHtml::encode($data->forma_pagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_parcelas_pagamento')); ?>:</b>
	<?php echo CHtml::encode($data->num_parcelas_pagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('valor_parcelas_pagamento')); ?>:</b>
	<?php echo CHtml::encode($data->valor_parcelas_pagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vencimento_parcelas_pagamento')); ?>:</b>
	<?php echo CHtml::encode($data->vencimento_parcelas_pagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vencimento_primeira_parcela_pagamento')); ?>:</b>
	<?php echo CHtml::encode($data->vencimento_primeira_parcela_pagamento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('observacao')); ?>:</b>
	<?php echo CHtml::encode($data->observacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visto_bombarco')); ?>:</b>
	<?php echo CHtml::encode($data->visto_bombarco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('visto_contratante')); ?>:</b>
	<?php echo CHtml::encode($data->visto_contratante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('segundo_visto_bombarco')); ?>:</b>
	<?php echo CHtml::encode($data->segundo_visto_bombarco); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('segundo_visto_contratante')); ?>:</b>
	<?php echo CHtml::encode($data->segundo_visto_contratante); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flg_renovacao')); ?>:</b>
	<?php echo CHtml::encode($data->flg_renovacao); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('num_contrato')); ?>:</b>
	<?php echo CHtml::encode($data->num_contrato); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('data')); ?>:</b>
	<?php echo CHtml::encode($data->data); ?>
	<br />

	*/ ?>

</div>