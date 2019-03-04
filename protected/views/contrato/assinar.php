<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="UTF-8" />
		<title>Bombarco - Líder em Negócios Náuticos</title>

		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/contrato/print.css?e=' . microtime());?>

	</head>
	<body>
		<?php
$form = $this->beginWidget('GxActiveForm', array(
    'id' => 'contrato-form',
    'enableAjaxValidation' => false,
));
?>

<?php if ($msg != ''): ?>

         <div class="alert alert-success">
               <?php echo $msg; ?>
		</div>
         <br/>

    <?php endif;?>

		<?php if($model->status == 2): ?>
			<a href="#" title="Imprimir contrato" onclick="window.print();" id="imprimir"><img alt="Imprimir contrato" src="/img/printer_64.png"></a>

		<?php else:?>
			<a href="#assinar" id="proxima"><img src="/img/arrow_down.png"></a>			
		<?php endif; ?>
		
		<table cellpadding="10" cellspacing="10">
			<thead>
				<tr>
					<th colspan="3">
						<table class="interna">
							<tr>
								<th><img src="/themes/bombarco/img/bombarco.png" alt="Bombarco" width="250"/></th>
								<th>
									<div class="form-inline">
										<label class="control-label">FICHA CADASTRAL nº: </label>
										<?php echo $form->textField($model, 'num_contrato', array("class" => "num")); ?>
									</div>
						            <div class="form-inline">
						                          <?php $model->flg_renovacao = '0';?>
						            <?php echo $form->radioButtonList($model, 'flg_renovacao', array('1' => 'Renovação', '0' => '1º Contrato'), array('class' => 'radio', 'labelOptions' => array('display: inline; margin-right: 20px;'), 'separator' => '&nbsp;&nbsp;&nbsp;')); ?>
						            </div>
								</th>
								<th>
									<p class="a-right ptopo">
										<b>E-mail: </b>atendimento@bombarco.com.br<br/>
										<b>Tel.: </b>(11) 4796-4062 / 2629-2170 / 9 6839-0408
									</p>
								</th>
							</tr>
						</table>
					</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td colspan="3">
						<table class="interna">
							<tr>
								<td colspan="3">
									<label>Nome Fantasia: </label>
									<span class="campo w-100">
										<?php echo $form->textField($model, 'nome_fantasia', array("id" => "nome_fantasia", "class" => "w-50 required input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Razão Social: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'razao_social', array("class" => "w-50 required input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>Data da Fundação: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'data_fundacao', array("class" => "dt input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Com sede na: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'rua', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>Complemento: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'complemento', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<label>Bairro: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'bairro', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>N°: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'numero', array("class" => "input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<table class="interna tab4">
										<tr>
											<td>
												<label>Cidade: </label>
												<span class="campo w-100">
												<?php echo $form->textField($model, 'cidade', array("class" => "w-50 input_line form-control")); ?>
													<i></i>
												</span>
											</td>
											<td>
												<label>Estado: </label>
												<span class="campo w-100">
												<?php echo $form->textField($model, 'estado', array("class" => "w-30 input_line form-control")); ?>
													<i></i>
												</span>
											</td>
											<td>
												<label>CEP: </label>
												<span class="campo w-100">
												<?php echo $form->textField($model, 'cep', array("class" => "w-50 cep input_line form-control")); ?>
													<i></i>
												</span>
											</td>
											<td>
												<label>CNPJ: </label>
												<span class="campo w-100">
												<?php echo $form->textField($model, 'cnpj', array("id" => "cnpj", "class" => "cnpj w-50 input_line form-control")); ?>
													<i></i>
												</span>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="interna">
										<tr>
											<td>
												<label>Inscrição Estadual N°: </label>
												<span class="campo w-50">
												<?php echo $form->textField($model, 'inscricao_estadual', array("class" => "w-50 input_line form-control")); ?>
													<i></i>
												</span>
											</td>
											<td>
												<label>Telefone: </label>
												<span class="campo w-50">
												<?php echo $form->textField($model, 'telefone', array("class" => "tel input_line form-control")); ?>
													<i></i>
												</span>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<label>Site: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'site', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<label>Neste ato representada por seu representante legal: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'nome_representante_legal', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Função: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'funcao_representante_legal', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>CPF Nº: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'cpf_representante_legal', array("class" => "cpf input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>e RG Nº: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'rg_representante_legal', array("class" => "input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<table class="interna">
										<tr>
											<td>
												<label>Data de Nascimento: </label>
												<span class="campo w-50">
												<?php echo $form->textField($model, 'data_nascimento_representante_legal', array("class" => "dt input_line form-control")); ?>
													<i></i>
												</span>
											</td>
											<td>
												<label>Celular: </label>
												<span class="campo w-50">
												<?php echo $form->textField($model, 'cel_representante_legal', array("class" => "tel input_line form-control")); ?>
													<i></i>
												</span>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<label>E-mail: </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'email_representante_legal', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<label>E-mail para receber perguntas (site): </label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'email_pergunta', array("class" => "w-50 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Resp. Financeiro: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_financeiro_nome', array("class" => "w-75 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>E-mail: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_financeiro_email', array("class" => "w-75 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>Telefone: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_financeiro_tel', array("class" => "tel input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Resp. por Anúncios: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_anuncios_nome', array("class" => "w-75 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>E-mail: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_anuncios_email', array("class" => "w-75 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>Telefone: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_anuncios_tel', array("class" => "tel input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td>
									<label>Resp. por Peças: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_pecas_nome', array("class" => "w-75 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>E-mail: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_pecas_email', array("class" => "w-75 input_line form-control")); ?>
										<i></i>
									</span>
								</td>
								<td>
									<label>Telefone: </label>
									<span class="campo w-30">
									<?php echo $form->textField($model, 'resp_pecas_tel', array("class" => "tel input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
							<tr>
								<td colspan="3">
									<table class="tabela-dados">
										<thead>
										   <tr>
											  <th>PLANO</th>
											  <th>DESCRIÇÃO</th>
											  <th>PERÍODO DE VEICULAÇÃO</th>
											  <th>VALOR MENSAL R$</th>
											  <th>SUB TOTAL R$ </th>
										   </tr>
										</thead>
										<tbody class="responsive">
										   <tr>
											  <th data-title="Plano">Classificados</th>
											  <td data-title="Descrição">
												<div class="textarea" name="Contrato[plano_classificados_desc]" id="Contrato_plano_classificados_desc" disabled=""><?php echo $model->plano_classificados_desc; ?></div></td>
											  <td data-title="Período de Veiculação">
												<div class="textarea" name="Contrato[plano_classificados_periodo]" id="Contrato_plano_classificados_periodo" disabled=""><?php echo $model->plano_classificados_periodo; ?></div></td>
											  <td data-title="Valor Mensal - R$">
												<div class="textarea" name="Contrato[plano_classificado_valor]" id="Contrato_plano_classificado_valor" disabled=""><?php echo $model->plano_classificado_valor; ?></div></td>
											  <td data-title="SubTotal - R$"><div class="textarea" name="Contrato[plano_classificados_subtotal]" id="Contrato_plano_classificados_subtotal" disabled=""><?php echo $model->plano_classificados_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th data-title="Plano">Banner no site Bombarco</th>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_site_bb_desc]" id="Contrato_plano_banner_site_bb_desc" disabled=""><?php echo $model->plano_banner_site_bb_desc; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_site_bb_periodo]" id="Contrato_plano_banner_site_bb_periodo" disabled=""></div><?php echo $model->plano_banner_site_bb_periodo; ?></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_site_bb_valor]" id="Contrato_plano_banner_site_bb_valor" disabled=""></div><?php echo $model->plano_banner_site_bb_valor; ?></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_site_bb_subtotal]" id="Contrato_plano_banner_site_bb_subtotal" disabled=""></div><?php echo $model->plano_banner_site_bb_subtotal; ?></td>
										   </tr>
										   <tr>
											  <th>Banner na News</th>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_news_desc]" id="Contrato_plano_banner_news_desc" disabled=""><?php echo $model->plano_banner_news_desc; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_news_periodo]" id="Contrato_plano_banner_news_periodo" disabled=""></div><?php echo $model->plano_banner_news_periodo; ?></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_news_valor]" id="Contrato_plano_banner_news_valor" disabled=""><?php echo $model->plano_banner_news_valor; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_banner_news_subtotal]" id="Contrato_plano_banner_news_subtotal" disabled=""><?php echo $model->plano_banner_news_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th>E-mail Marketing</th>
											  <td><div class="textarea nao-muda" name="Contrato[plano_emkt_desc]" id="Contrato_plano_emkt_desc" disabled=""><?php echo $model->plano_emkt_desc; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_emkt_periodo]" id="Contrato_plano_emkt_periodo" disabled=""><?php echo $model->plano_emkt_periodo; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_emkt_valor]" id="Contrato_plano_emkt_valor" disabled=""><?php echo $model->plano_emkt_valor; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_emkt_subtotal]" id="Contrato_plano_emkt_subtotal" disabled=""><?php echo $model->plano_emkt_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th>Zero Milhas</th>
											  <td><div class="textarea nao-muda" name="Contrato[plano_zeromilhas_desc]" id="Contrato_plano_zeromilhas_desc" disabled=""><?php echo $model->plano_zeromilhas_desc; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_zeromilhas_periodo]" id="Contrato_plano_zeromilhas_periodo" disabled=""><?php echo $model->plano_zeromilhas_periodo; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_zeromilhas_valor]" id="Contrato_plano_zeromilhas_valor" disabled=""><?php echo $model->plano_zeromilhas_valor; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_zeromilhas_subtotal]" id="Contrato_plano_zeromilhas_subtotal" disabled=""><?php echo $model->plano_zeromilhas_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th>Impresso - Guia do Capitão</th>
											  <td><div class="textarea nao-muda" name="Contrato[plano_impresso_guia_desc]" id="Contrato_plano_impresso_guia_desc" disabled=""><?php echo $model->plano_impresso_guia_desc; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_impresso_guia_periodo]" id="Contrato_plano_impresso_guia_periodo" disabled=""><?php echo $model->plano_impresso_guia_periodo; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_impresso_guia_valor]" id="Contrato_plano_impresso_guia_valor" disabled=""><?php echo $model->plano_impresso_guia_valor; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_impresso_guia_subtotal]" id="Contrato_plano_impresso_guia_subtotal" disabled=""><?php echo $model->plano_impresso_guia_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th>Site - Guia do Capitão</th>
											  <td><div class="textarea nao-muda" name="Contrato[plano_site_guia_desc]" id="Contrato_plano_site_guia_desc" disabled=""><?php echo $model->plano_site_guia_desc; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_site_guia_periodo]" id="Contrato_plano_site_guia_periodo" disabled=""><?php echo $model->plano_site_guia_periodo; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_site_guia_valor]" id="Contrato_plano_site_guia_valor" disabled=""><?php echo $model->plano_site_guia_valor; ?></div></td>
											  <td><div class="textarea nao-muda" name="Contrato[plano_site_guia_subtotal]" id="Contrato_plano_site_guia_subtotal" disabled=""><?php echo $model->plano_site_guia_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th data-title="Raio-X">Raio X</th>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_raiox_desc; ?></div></td>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_raiox_periodo; ?></div></td>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_raiox_valor; ?></div></td>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_raiox_subtotal; ?></div></td>
										   </tr>
										   <tr>
											  <th>Outros</th>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_outros_desc; ?></div></td>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_outros_periodo; ?></div></td>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_outros_valor; ?></div></td>
											  <td><div class="textarea nao-muda" disabled=""><?php echo $model->plano_outros_subtotal; ?></div></td>
										   </tr>
										</tbody>
									 </table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<label>Valor Total do Contrato R$: </label>
						<span class="campo w-50">
						<?php echo $form->textField($model, 'valor_total_contrato', array("readOnly" => true, "class" => "nao-muda moeda input_line form-control")); ?>
							<i></i>
						</span>
					</td>
					<td>
						<label></label>
						<span class="campo w-50">
						<?php echo $form->textField($model, 'valor_total_contrato_extenso', array("readOnly" => true, "class" => "nao-muda input_line form-control")); ?>
							<i></i>
						</span>
					</td>
					<td>
					<label>Forma de Pagamento: </label>
					<span class="campo w-50">
					<?php echo $form->textField($model, 'num_parcelas_pagamento', array("readOnly" => true, "class" => "nao-muda input_line form-control")); ?>
						<i></i>
					</span>
				</td>

				</tr>
				<tr>
					<td colspan="2">
						<table class="interna">
							<tr>

								<td>
									<label>Parcela(s) de R$</label>
									<span class="campo w-50">
									<?php echo $form->textField($model, 'valor_parcelas_pagamento', array("readOnly" => true, "class" => "nao-muda moeda input_line form-control")); ?>
										<i></i>
									</span>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<label></label>
						<span class="campo w-100">
						<?php echo $form->textField($model, 'valor_parcelas_pagamento_extenso', array("readOnly" => true, "class" => "nao-muda input_line form-control")); ?>
							<i></i>
						</span>
					</td>
				</tr>
				<tr>
					<td>
						<label>com vencimento todo dia: </label>
						<span class="campo w-30">
						<?php echo $form->textField($model, 'vencimento_parcelas_pagamento', array("readOnly" => true, "class" => "nao-muda moeda input_line form-control")); ?>
							<i></i>
						</span>
					</td>
					<td colspan="2">
						<table class="interna tab2">
							<tr>
								<td>
									<label>de cada mês, sendo primeira parcela com vencimento dia:</label>
									<span class="campo w-100">
									<?php echo $form->textField($model, 'vencimento_primeira_parcela_pagamento', array("readOnly" => true, "class" => "nao-muda input_line form-control")); ?>
									<i></i>
									</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<label>em forma de boleto bancário.</label>
						<span class="campo w-100"></span>
					</td>
				</tr>
				<tr>
					<td colspan="3" class="pt-3">
						<label>Obs.:</label>
						<span class="campo w-100">

							<?php echo $form->textArea($model, 'observacao', array("id" => "obs", "readOnly" => true)); ?>
						</span>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						<label>Autorizo a(s) publicação(ções) acima descriminada(as).</label>
					</td>
				</tr>

				<tr>
					<td colspan="3">
						<table class="interna">
							<tr>
								<!--<td class="assinatura a-center pt-10">-->
								<td class="assinatura a-center">
									<img class="visto" src="<?php echo $model->visto_bombarco; ?>"/>
									<span style="text-align:center !important; margin-top:10px;" class="ass"><b>Visto Bombarco</b></span>
								</td>
								<?php if ($model->status == 2): ?>
									<!--<td class="assinatura a-center pt-10">-->
									<td class="assinatura a-center">
										<img class="visto" src="<?php echo $model->visto_contratante; ?>"/>
										<span style="text-align:center !important; margin-top:10px;" class="ass"><b>Visto Contratante</b></span>
									</td>
								<?php else: ?>
									<td class="assinatura a-center pt-10">
										<div id="visto_contratante"></div>
										<span class="ass"><b>Visto Contratante</b></span>
										<a id="btn-refazer-ass" href="#">Refazer assinatura</a>
									</td>
								<?php endif;?>
							</tr>
						</table>
					</td>
				</tr>

				<tr>
					<td colspan="3" class="pt-3">
						<h2 class="a-center">Contrato de cessão de espaço em mídia digital e impressa</h2>
						<p>
						 Pelo presente instrumento, de um lado, como CONTRATADA, Bombarco Serviços de Informação na Internet Ltda. ME, pessoa jurídica de direito privado, com sede em Mogi das Cruzes, Estado de São Paulo, na Rua Cruzeiro do Sul, nº323, Vila Oliveira, CEP 08790-170, CNPJ/MF sob nº 10.352.973/0001-43, e, de outro lado, como <b>CONTRATANTE</b>, qualificado(a) na frente da presente folha em sua Ficha Cadastral e, em conjunto, denominadas PARTES; resolvem firmar o presente Contrato, que será regido pelas seguintes condições:
						 OBJETO DO CONTRATO
						 CLÁUSULA 1. O presente Contrato tem como objeto a “cessão” de espaço em mídia digital e impressa, pelo Bombarco à <b>CONTRATANTE</b>, para divulgação e veiculação de conteúdo, promoções ou ações comerciais, sem exclusividade, pela forma acordada entre as partes, no espaço publicitário do website www.bombarco.com.br, www.guiadocapitao.com.br, www.zeromilhas.com.br, no Impresso ou ainda nas redes sociais do Bombarco.
						 Parágrafo Único: A contraprestação pela cessão (“preço”), prazo de vigência do contrato, planos contratados e demais condições comerciais aplicáveis ao negócio estão contidas na Ficha Cadastral, cujos termos e condições devem ser interpretados em conjunto com as condições ora previstas neste instrumento, e, só serão modificados através de aditivo contratual.
						 CLÁUSULA 1.1. O produto Impresso, trata-se tão somente de divulgação e veiculação de conteúdo informativo ou publicitário em mídia impressa.
						 CLÁUSULA 1.2. Independentemente do plano e produto contratado (mídia digital ou impressa), a <b>CONTRATANTE</b> se responsabiliza pelo envio de todo material (layout, informações, logo, e demais materiais que se fizerem necessários), para o e-mail atendimento@bombarco.com.br, sendo que a arte será enviada já de acordo com as especificações do espaço contratado.
						 CLÁUSULA 1.3. A <b>CONTRATANTE</b> com a assinatura do presente contrato e envio do material a ser divulgado, autoriza expressamente a CONTRATADA o uso de seu nome, marca, sinais distintivos e demais informações contidas no material enviado para postagem no Espaço e para os fins exclusivos desse Contrato.
						 OBRIGAÇÕES DA CONTRATADA
						 CLÁUSULA 2. O presente instrumento de contrato começa a contar a partir da assinatura desse instrumento, por esse motivo, a CONTRATADA obriga-se:
						 A) Publicar  a publicidade no “Impresso”, desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
						 B) Publicar os banners no site, enviar e-mail marketing e enviar banner na news, desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
						 C) Liberar no sistema o espaço contratado para a <b>CONTRATANTE</b> anunciar suas embarcações e/ou empresa em até 2 (dois) dias úteis da assinatura desse contrato.
						 D) Publicar as embarcações novas no website zeromilhas.com.br , de acordo com as especificações fornecidas, desde que cumpridas as obrigações da <b>CONTRATANTE</b>
						 E) Gravar o Raio X no local e data previamente combinado e publicá-lo desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
						 F) Fazer o post na rede social do Bombarco, desde que cumpridas as obrigações da <b>CONTRATANTE</b>.
						 OBRIGAÇÕES DA <b>CONTRATANTE</b>
						 CLÁUSULA 3. Da assinatura do contrato, ocorre automaticamente a reserva do espaço virtual e/ou impresso, portanto, a <b>CONTRATANTE</b> obriga-se a fornecer e enviar material publicitário, estipulados, conforme o plano adquirido, sendo:
						 A) Contratando o Plano Banner na news, disparo de e-mail marketing e/ou post na rede social deverá a <b>CONTRATANTE</b> fornecer à CONTRATADA o material publicitário de acordo com as orientações enviadas pela CONTRATADA com até 07 dias corridos de antecedência da data agendada para o envio.
						 B) Contratando o Plano de Classificados, Site - Guia do Capitão, Banner e/ou Zero Milhas deverá cadastrar as embarcações, empresas e/ou enviar o material publicitário tão logo  da assinatura desse contrato.
						 CLÁUSULA 3.1. No Impresso, a <b>CONTRATANTE</b> enviará o material desejável, adequado e necessário via e-mail (atendimento@bombarco.com.br) até 7 (sete) dias corridos da assinatura do contrato.
						 CLÁUSULA 3.2. Contratando o Raio X o <b>CONTRATANTE</b> deverá disponibilizar o barco a ser divulgado, barco de apoio se necessário, bem como o local que será gravado o vídeo e o todas as especificações técnicas necessárias do barco.
						 CLÁUSULA 3.3. Atualizar as informações contidas no site, sempre que houver alguma alteração.
						 CLÁUSULA 3.4. Efetuar o pagamento no valor, prazo e nas condições estabelecidas na Ficha Cadastral, sob pena de aplicação de multa moratória no valor de 2% (dois por cento) e juros de 5,9% ao mês, ambos calculados sobre o valor em atraso; bem como estará sujeito a protesto e inclusão nas entidades de protesto em caso superior a 30 dias.
						 CLÁUSULA 3.5. Efetuar o pagamento da ajuda de custo com alimentação, hospedagem e transporte para a gravação do Raio X de toda a equipe disponibilizada para a execução da gravação.
						 DAS CONDIÇÕES EM GERAL
						 CLÁUSULA 4. A <b>CONTRATANTE</b> deverá ler, certificar-se de haver entendido e aceitar todas as condições estabelecidas neste contrato, bem como na Política de Privacidade e Termo de Uso que consta no site Bombarco, Guia do Capitão e do Zero Milhas, antes de efetivar a contratação. A aceitação das condições descritas nestes instrumentos é absolutamente indispensável para a utilização do site.
						 CLÁUSULA 5. A CONTRATADA não é proprietária, ou intermediadora de venda das embarcações comercializadas, em hipótese alguma fará a guarda, terá posse, ou realizará as ofertas de venda. Tampouco, se responsabiliza pela entrega das mesmas, ou intervirá em negociações iniciadas através do site ou Impresso.
						 CLÁUSULA 6. A <b>CONTRATANTE</b> se obriga e se responsabiliza de forma exclusiva pelo conteúdo comercial das suas informações disponibilizadas no Site www.bombarco.com.br, www.guiadocapitao.com.br, www.zeromilhas.com.br ou no Impresso, por suas negociações e/ou contratações, por quaisquer defeitos ou vícios de seus produtos ou serviços, violação de direitos autorais, de imagem, de privacidade, de propriedade industrial e do consumidor, bem como, legalidade, qualidade, segurança, entrega, transporte, informação e disponibilidade em estoque, respondendo por quaisquer prejuízos que possa vir a causar à CONTRATADA ou a terceiros.
						 CLÁUSULA 7. Este contrato não implica e nem obriga as partes na intermediação de negócios, não representa joint venture ou sociedade entre as partes, ficando esclarecido que as ações ora estabelecidas serão executadas em caráter de total autonomia, sem qualquer obrigação de exclusividade, subordinação, obtenção de resultados comerciais ou não, assim como, quantitativos de negócios oriundos da presente contratação.
						 CLÁUSULA 8. A <b>CONTRATANTE</b> fornecerá, bem como, se responsabiliza pelas informações contidas nos diversos canais dos sites e do Impresso, devendo, portanto, conferi-la.
						 DO PRAZO
						 CLÁUSULA 9. O prazo para cadastro de embarcações, cadastro da empresa no site - guia do capitão e envio de material de Banner e/ou zero milhas deverão ser respeitados conforme Cláusula terceira e suas alíneas, estando ciente a <b>CONTRATANTE</b> que o prazo de contratação começa a contar a partir do dia seguinte da assinatura do contrato independente se o material foi enviado e se os espaços foram preenchidos.
						 Parágrafo Primeiro: O prazo para enviar peças de E-mail marketing, banner na news, post da rede social e/ou para o Impresso deverá ser respeitado conforme Cláusula terceira e suas alíneas, estando ciente a <b>CONTRATANTE</b> que em caso contrário perderá o direito do envio ou publicação. No caso do e-mail marketing a CONTRATADA remarcará um novo envio, uma única vez e de acordo com a disponibilidade da agenda. Em se tratando do Raio X, caso a equipe do Bombarco for até o local da gravação e não for possível realizar a gravação por qualquer motivo, deverá a <b>CONTRATANTE</b> arcar novamente com as despesas previstas na CLÁUSULA 3.5 deste contrato.
						 Parágrafo Segundo: Caso a <b>CONTRATANTE</b> não cumpra com os prazos da Cláusula Terceira e suas alíneas, a CONTRATADA não devolverá nenhuma quantia paga, nem tampouco estenderá o prazo já previamente acordado. A <b>CONTRATANTE</b> se responsabiliza pelas consequências que poderão surgir pela falta do cumprimento.
						 RESCISÃO
						 CLÁUSULA 10. O presente contrato poderá ser rescindido a qualquer momento pela <b>CONTRATANTE</b>, mediante aviso por escrito sendo que: se cancelado até 10 dias corridos da assinatura do contrato, será cobrado multa rescisória referente a 1 (uma) parcela do valor do contrato; se cancelado após o 11º dia, será cobrada multa rescisória referente a 50% do valor em aberto que falta pagar.
						 Parágrafo Primeiro: Caso o contrato seja rescindido pela CONTRATADA ambas as partes estarão isentas de qualquer multa contratual.
						 Parágrafo Segundo: Havendo falta ou atraso de pagamento por mais de 10 dias, o contrato poderá ser automaticamente rescindido e a CONTRATADA não manterá a “cessão” do espaço virtual ou do Impresso, sem prejuízo de ser cobrada a multa rescisória pertinente.
						 CLÁUSULA 10.1 – Fica vedada a cessão ou transferência, total ou parcial das responsabilidades e direitos assumidos pelas partes, exceto havendo autorização expressa da CONTRATADA.
						 CLÁUSULA 10.2 – A tolerância de qualquer das PARTES, com relação ao estrito cumprimento das obrigações ora previstas, não constituirá em novação, renúncia ou revogação aos direitos ou cumprimento das demais disposições e obrigações.
						 DA VIGÊNCIA DO CONTRATO
						 CLÁUSULA 11. O presente contrato é renovado automaticamente, por iguais e sucessivos períodos, nos casos de contratação de Classificados, Site- Guia do Capitão, Zero Milhas, e Banner o site, sendo comunicado antecipadamente via e-mail se houver alteração em relação ao preço. A <b>CONTRATANTE</b> é a única responsável pelo cancelamento do serviço, que deverá enviar um e-mail para <u>milena@bombarco.com.br</u> solicitando o cancelamento.
						 Parágrafo único: Após o cancelamento, o <b>CONTRATANTE</b> perderá todas as informações, dados e arquivos inseridos no espaço disponibilizado enquanto da vigência do contrato.
						 DO FORO
						 CLÁUSULA 12. Caso as dúvidas e divergências decorrentes desse Contrato não possam ser dirimidas de comum acordo entre as partes, fica eleito o Foro da Comarca de Mogi das Cruzes - SP, como competente para solucioná-las, renunciando as partes a qualquer outro, por mais privilegiado que seja. E, por estarem justos e contratados, assinam as partes o presente Contrato em 02 (duas) vias de iguais teor e forma, para que se produzam os efeitos jurídicos e legais.
					  </p>
					</td>
				</tr>

				<tr>
					<td colspan="2" class="assinatura">
						<?php if($model->status == 2): ?>
							<?php 
								$timestamp = strtotime($model->data);
								$dia = date('d', $timestamp);
								$mes = date('m', $timestamp);
								$ano = date('Y', $timestamp);
							?>
							<span style="font-size:15px;font-weight:bolder;"> Mogi das Cruzes, <?php echo $dia; ?> de <?php echo Contrato::dataExtenso($mes); ?> de <?php echo $ano; ?></span>
						<?php else: ?> 
							<span style="font-size:15px;font-weight:bolder;"> Mogi das Cruzes, <?php echo date('d'); ?> de <?php echo Contrato::dataExtenso(date('m')); ?> de <?php echo date('Y'); ?></span>
						<?php endif; ?> 
						

					</td>
					<td class="assinatura"></td>
				</tr>
				<tr>
					<td colspan="3">
						<table class="interna">
							<tr>
								<td class="assinatura a-center pt-10">
									<img class="visto" src="<?php echo $model->visto_bombarco; ?>"/>
									<span class="ass"><b>Bombarco Serviços de Informação na Internet Ltda ME</b></span>
								</td>
								<?php if ($model->status == 2): ?>
									<td class="assinatura a-center pt-10">
										<img class="visto" src="<?php echo $model->segundo_visto_contratante; ?>"/>
										<span class="ass"><b>Visto Contratante</b></span>
									</td>
								<?php else: ?>
									<td class="assinatura a-center pt-10">
										<div id="visto_contratante2"></div>
										<span class="ass"><b>Contratante</b></span>
										<a id="btn-refazer-ass-2" href="#">Refazer assinatura</a>
									</td>
								<?php endif;?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<table class="interna">
							<tr>
								<td class="assinatura">
									<span class="ass"><small>
									<label class="form-check-label">
									<input checked="" class="check-li form-check-input" type="checkbox" id="check1"> Li, e concordo com os termos da Ficha Cadastral e do Contrato acima.
									</label></small></span>
								</td>
								<td class="assinatura">
									<span class="ass"><small>
										<label class="form-check-label">
										<input class="check-li form-check-input" checked="" type="checkbox" id="check2"> Estou ciente que estou assinando esse contrato eletronicamente e que este terá validade jurídica.
										</label>
									</small></span>
								</td>
							</tr>
						</table>
					</td>
				</tr>

			</tbody>

			<tfoot id="assinar">
				<tr>
					<td colspan="3" class="a-center">
						<button id="btn-assinar">ASSINAR CONTRATO</button>
					</td>
				</tr>
			</tfoot>

		</table>
	<?php echo $form->hiddenField($model, 'visto_contratante', array("id" => "visto_contratante_hidden")); ?>
	<?php echo $form->hiddenField($model, 'segundo_visto_contratante', array("id" => "visto_contratante_hidden2")); ?>
	<?php echo $form->hiddenField($model, 'base64_contrato', array("id" => "base64_contrato")); ?>
	<?php echo $form->hiddenField($model, 'base64_termos', array("id" => "base64_termos")); ?>
	<?php echo $form->hiddenField($model, 'status', array("id" => "status")); ?>
	<?php $this->endWidget();?>
	</body>
	<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/jquery.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jSignature/jSignature.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/jquery-confirm/jquery-confirm.css');
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/promise/promise.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/html2canvas.js', CClientScript::POS_END);
?>
	<script>
		$(document).ready(function() {

			$('.data').mask('00/00/0000');
			$('.cep').mask('99999-999');
			$('.tel').mask('(99) 99999-9999');
			$('.cpf').mask('000.000.000-00');
			$('.cnpj').mask('99.999.999/9999-99');

			if($("#status").val() == 2) {

				$("input").prop("disabled", true);
				$("#btn-assinar").remove();
			}

			$(".nao-muda").on("change", function() {
				location.reload();
				return false;
			});

			$("#proxima").on("click", function(e) {
            	e.preventDefault();
				$("html, body").animate({ scrollTop: $(document).height() }, 1000);
			});

			$("#visto_contratante").jSignature();
			$("#visto_contratante2").jSignature();

			$("#btn-refazer-ass").on("click", function(e) {
				e.preventDefault();
				$("#visto_contratante").jSignature("reset");
			});

			$("#btn-refazer-ass-2").on("click", function(e) {
				e.preventDefault();
				$("#visto_contratante2").jSignature("reset");
			});

			$("#btn-assinar").on("click", function(e) {
				e.preventDefault();

				var tipo = $("#visto_contratante").jSignature("getData","svgbase64")[0];
				var assinatura = $("#visto_contratante").jSignature("getData","svgbase64")[1];

				tipo = "data:"+tipo+",";

				var base64_visto_contratante = tipo+assinatura;

				tipo = $("#visto_contratante2").jSignature("getData","svgbase64")[0];
				assinatura = $("#visto_contratante2").jSignature("getData","svgbase64")[1];

				tipo = "data:"+tipo+",";

				var base64_visto_contratante2 = tipo+assinatura;

				$("#visto_contratante_hidden").val(base64_visto_contratante);
				$("#visto_contratante_hidden2").val(base64_visto_contratante2);

				if( $("#visto_contratante").jSignature('getData', 'native').length == 0 ||
					$("#visto_contratante2").jSignature('getData', 'native').length == 0) {
					$.alert({
						title: 'Erro',
						content: 'Por favor de os 2 vistos no contrato',
					});
					return false;
				}

				$.confirm({
					//confirmButtonClass: 'btn-success',
					//cancelButtonClass: 'btn-danger',
					useBootstrap: false,
					icon: 'fa fa-warning',
					title: 'Contrato online',
					content: 'Deseja confirmar o preenchimento do contrato?',
					confirmButton: 'SIM',
					cancelButton: 'NÃO',

					confirm: function() {

						$("#contrato-form").submit();
					},
					cancel: function() {

					}
				});

			});
		});
	</script>
</html>