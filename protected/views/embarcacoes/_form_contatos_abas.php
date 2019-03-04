<form id="form_lbox" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
											<div class="form-nome-ag">
												<input name="finan_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="terms-ag-1" value="<?php echo $nome; ?>" type="text" required="required">
											</div>
											<div class="form-nome-ag">
												<input name="finan_email" placeholder="Seu e-mail*" class="terms-ag-1" type="email" value="<?php echo $email; ?>" required="required">
											</div>
											<div class="form-nome-ag">
												<input name="finan_phone" placeholder="Seu telefone*" class="terms-ag-1" type="tel" value="<?php echo $celular; ?>" required="required">
											</div>
											<input type="text" name="C7RiUSGm" value="" style="display:none !important;" />
											<input type="submit" name="botao-cadastrar-form" class="botao-cadastrar-form" value="ENVIAR PEDIDO" onclick="_gaq.push(['_trackEvent', 'detalhe-emb', 'click', 'enviar finanorcio'])" sax-track="detalhe-emb" sax-properties="click:enviar finanorcio;macro:Empresa/Vendedor" />
											<input type="hidden" name="finan_id" value="<?php echo $model->id; ?>" />
											<input type="hidden" name="finan_titulo" value="<?php echo $fabricante->titulo . ' ' . $modelo->titulo; ?>" />
											<input type="hidden" name="finan_valor" value="<?php echo $model->valor; ?>" />
											<input type="hidden" name="finan_link" value="<?php echo Embarcacoes::mountUrl($model); ?>" />
											<input type="hidden" name="finan_parceiro" value="Unifisa" />
											<input type="hidden" name="partner_type" value="finan" />
										</form>