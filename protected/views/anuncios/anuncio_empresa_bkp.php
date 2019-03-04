<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'empresas-form',
	'enableAjaxValidation' => false,
	'enableClientValidation' => true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),

	
));
// usuario logado
	$usuarioLogado = Usuarios::getUsuarioLogado();




?>

<section class="preloader">
	<img src="<?php echo Yii::app()->createUrl('img/loader.gif'); ?>" alt=""/>
</section>

<section class="content">

	<?php
		if(!$flgEstaleiro) {
			echo '<div class="line-header-cad">
				<div class="container">
					<div class="box-cadastro-line-header">
						<div class="quadro-box-cadastro-lh-a">';
							echo '<a href="'.Yii::app()->createUrl('site/index').'" class="icone-foto-cadastro-lh1"></a>
						</div>	
						<div class="quadro-box-cadastro-lh-b">
							<div class="div-text-cadastro-lh1">
								<span class="text-cadastro-lh1">';
									
									echo Yii::app()->request->getParam('qnt').' ANÚNCIOS POR '.Yii::app()->request->getParam('meses').' MESES';
								echo '</span>
							</div>	
							<icon class="icone-foto-cadastro-lh4"></i>
						</div>
						<div class="quadro-box-cadastro-lh-c">
							
							<div class="div-text-cadastro-lh1">
								<span class="text-cadastro-lh1">CADASTRO DO ANÚNCIO</span>
							</div>	
							<div class="div-text-cadastro-lh2">
								<span class="text-cadastro-lh2">2.</span>
							</div>	
						</div>
						<div class="quadro-box-cadastro-lh-d">
							<div class="div-text-cadastro-lh1">
								<span class="text-cadastro-lh1">EFETUE O PAGAMENTO</span>
							</div>
							<div class="div-text-cadastro-lh2">
								<span class="text-cadastro-lh2">3.</span>
							</div>	

						</div>
						<div class="quadro-box-cadastro-lh-e">
							<div class="div6-cadastro-green">
										<span class="text-cadastro-green6">TOTAL:</span>
									</div>
									<div class="div-text-cadastro-lh3">
										<span class="text-cadastro-lh3">R$</span>
									</div>
									<div class="div-text-cadastro-lh4">';
										echo '<span class="text-cadastro-lh4">'.Utils::formataValorView(Yii::app()->request->getParam('valor')).'</span>';
									echo '</div>
									<icon class="icone-foto-cadastro-lh3"></i>
						</div>
					</div>	
				</div>	
			</div>';
		}
	?>

	<div class="line-cadastro-1">
		<div class="container">
			<div class="box-cadastro-1">
				<span class="title-cad-2"> Home > Anunciar > Cadastro </span>
				<span class="title-cad-1"> Cadastre sua empresa </span>
				<span class="title-cad-3">Preencha os campos abaixo para cadastrar sua empresa</span>
			</div>	
		</div>
	</div>
	<div class="empresa-form-content">
		<div class="container">
			<div class="span-cadastro-top">
				<span class="text-cadastro-top"><b>Atenção:</b> Os campos com * são de preenchimento obrigatório.</span>
			</div>
			<div style="font-weight:bolder; color:red; font-style:italic;">
				<?php
					//echo $erro;
					//echo $form->errorSummary($empresa);


					$flashMessages = Yii::app()->user->getFlashes();
					if ($flashMessages) {
						echo '<ul class="flashes">';
						foreach($flashMessages as $key => $message) {
							echo '<li><div class="flash-' . $key . '">' . $message . "</div></li>\n";
						}
							echo '</ul>';
						
					}
				?>
			</div>

			<?php
				// se for estaleiro, temos que exibir os planos de estaleiro para o 
				// usuario escolher
				if($flgEstaleiro) {
					echo '<div class="row">';
						echo CHtml::label('Plano', 'pid');
						echo Planos::dropDownPlanos('pid', 'estaleiro');
					echo '</div>';
				}
			?>

			<div class="row row-2">
				<div class="row-1 rowemail">
					<?php echo $form->labelEx($empresa,'email'); ?>
					<?php
						echo CHtml::textField('Empresas[email]', $email,
									 array('id'=>'Empresas_email', 
									       'width'=>100, 
									       'maxlength'=>100)); 
					?>
					<div class="errorMessage" id="error-email"></div>
				</div>

				<div class="row-1 rowrazao">
					<?php echo $form->labelEx($empresa,'razao'); ?>

					<?php if($usuarioLogado->razaosocial != ""):?>
						<?php echo $form->textField($empresa, 'razao', array('maxlength' => 45, 'value'=>$usuarioLogado->razaosocial)); ?>
					<?php else:?>
						<?php echo $form->textField($empresa, 'razao', array('maxlength' => 45)); ?>
					<?php endif;?>
						
					<?php echo $form->error($empresa,'razao'); ?>
					<div class="errorMessage" id="error-razao"></div>

				</div>

			</div>

			<div class="row row-2">	

				<div class="row-1">
					<?php echo $form->labelEx($empresa,'cnpj'); ?>
					<?php if($usuarioLogado->cnpj != ""):?>
						
						<?php echo $form->textField($empresa, 'cnpj', array('maxlength' => 45, 'value'=>$usuarioLogado->cnpj)); ?>
					
					<?php else:?>
						<?php echo $form->textField($empresa, 'cnpj', array('maxlength' => 45)); ?>
					<?php endif;?>
						<?php echo $form->error($empresa,'cnpj'); ?>
				</div>

				<div class="row-1">
					<?php echo $form->labelEx($empresa,'nomefantasia'); ?>
					<?php if($usuarioLogado->nomefantasia != ""):?>
						
						<?php echo $form->textField($empresa, 'nomefantasia', array('maxlength' => 120, 'value'=>$usuarioLogado->nomefantasia)); ?>
					
					<?php else:?>
						<?php echo $form->textField($empresa, 'nomefantasia', array('maxlength' => 120)); ?>
					<?php endif;?>
						<?php echo $form->error($empresa,'nomefantasia'); ?>
				</div>
			</div><!-- row -->

			<div class="row row-2">
				<div class="row-1 rowfile">
					<label>Logo</label>
					<?php echo $form->fileField($empresa, 'logo'); ?>
					<a href="#" class="btn-file">Adicionar</a>
					<?php echo $form->error($empresa,'logo'); ?>
					<br />
					<span class="text-images">Formatos aceitos: JPEG; PNG; GIF. Tam. máx. 20mb.</span>
				</div>
				<div class="row-1 rowfile">
					<label>Capa</label>
					<?php echo $form->fileField($empresa, 'capa'); ?>
					<a href="#" class="btn-file">Adicionar</a>
					<?php echo $form->error($empresa,'capa'); ?>
					<br />
					<span class="text-images">Formatos aceitos: JPEG; PNG; GIF. Tam. máx. 20mb.</span>
				</div>
				 <div class="row-1 rowmaps">
					<?php //echo $form->labelEx($empresa,'maps'); ?>
					<?php echo $form->textField($empresa, 'maps', array('hidden' => true)); ?>
					<?php //echo $form->error($empresa,'maps'); ?>
				</div> 
			</div>

			<div class="row row-3">
				<div class="row-1">
					<?php echo $form->labelEx($empresa,'cep'); ?>
					<?php if($usuarioLogado->cep != ""):?>
						
						<?php echo $form->textField($empresa, 'cep', array('maxlength' => 120, 'value'=>$usuarioLogado->cep)); ?>
					
					<?php else:?>
						<?php echo $form->textField($empresa, 'cep', array('maxlength' => 120)); ?>
					<?php endif;?>
						<?php echo $form->error($empresa,'cep'); ?>
				</div>
				<div class="row-1 row-address">
					<?php echo $form->labelEx($empresa,'endereco'); ?>
					<?php if($usuarioLogado->endereco != ""):?>
						
						<?php echo $form->textField($empresa, 'endereco', array('maxlength' => 120, 'value'=>$usuarioLogado->endereco)); ?>
					
					<?php else:?>
						<?php echo $form->textField($empresa, 'endereco', array('maxlength' => 120)); ?>
					<?php endif;?>
						<?php echo $form->error($empresa,'endereco'); ?>
				</div>
				<div class="row-1 row-number">
					<?php echo $form->labelEx($empresa,'numero'); ?>
					<?php if($usuarioLogado->numero != ""):?>
						
						<?php echo $form->textField($empresa, 'numero', array('maxlength' => 120, 'value'=>$usuarioLogado->numero)); ?>
					
					<?php else:?>
						<?php echo $form->textField($empresa, 'numero', array('maxlength' => 120)); ?>
					<?php endif;?>
						<?php echo $form->error($empresa,'numero'); ?>
				</div>
			</div><!-- row -->

			<div class="row row-3">
				<div class="row-1">
					<?php echo $form->labelEx($empresa,'uf'); ?>
					<?php Estados::getModelDropDown($form, $empresa,'Empresas_cidades_id'); ?>
					<?php echo $form->error($empresa,'uf'); ?>
				</div>
				<div class="row-1">
					<?php echo $form->labelEx($empresa,'cidade'); ?>
					<?php echo $form->dropDownList($empresa,'cidades_id', array('empty'=>'selecione')); ?>
					<?php echo $form->error($empresa,'cidade'); ?>
				</div>
				<div class="row-1">
					<?php echo $form->labelEx($empresa,'bairro'); ?>
					<?php if($usuarioLogado->bairro != ""):?>
						
						<?php echo $form->textField($empresa, 'bairro', array('maxlength' => 120, 'value'=>$usuarioLogado->bairro)); ?>
					
					<?php else:?>
						<?php echo $form->textField($empresa, 'bairro', array('maxlength' => 120)); ?>
					<?php endif;?>
						<?php echo $form->error($empresa,'bairro'); ?>
				</div>
			</div><!-- row -->

			<div class="row row-2">
				<div class="row-1 rowempresacat">
					<?php echo $form->labelEx($empresa,'empresa_categorias_id'); ?>
					<?php echo $form->dropDownList($empresa, 'empresa_categorias_id', GxHtml::listDataEx(EmpresaCategorias::model()->findAll(array('condition'=>'status=1', 'order'=>'titulo asc'))), array('empty'=>'Selecione')); ?>
					<?php echo $form->error($empresa,'empresa_categorias_id'); ?>
					<div class="errorMessage" id="error-categoria"></div>
				</div>
				<div class="row-1 rowfanpage">
					<?php echo $form->labelEx($empresa,'fanpage'); ?>
					<?php echo $form->textField($empresa, 'fanpage', array('maxlength' => 100)); ?>
					<?php echo $form->error($empresa,'fanpage'); ?>
				</div>
			</div><!-- row -->
			
			<div class="row rowdescription">
				<?php echo $form->labelEx($empresa,'minidescricao'); ?>
				<?php echo $form->textArea($empresa, 'minidescricao', array('maxlength' => 100)); ?>
				<?php echo $form->error($empresa,'minidescricao'); ?>
			</div><!-- row -->
		</div>	

		<div class="line-cadastro-11">
			<div class="container">
				<div class="box-cadastro-11">
					<div class="quadro-box-cadastro-11a">
						<icon class="icone-foto-cadastro3"></i>
						<div class="div-text-blue-cadastro-l10">
							<span class="text-blue-cadastro-l10">Turbine sua página!</span>
						</div>	
					</div>
					<div class="quadro-box-cadastro-11b">
						<div class="div-cadastro-light2">
						<span class="text-cadastro-light">
Agora você pode turbinar o seu anúncio com as nossas opções de adicionais, tornando seu anúncio mais completo e aumentando suas chances de conversão!
.</span>
						</div>	
					</div>
				</div>	
			</div>	
		</div>

		<div class="container content-turbinados">
			<!-- listar checkboxes dos recursos adicionais -->

			<?php
				// verificar se é estaleiro, caso não for, é empresa, então devemos
				// exibir os recs adicionais
				if(!$flgEstaleiro) {
					for($i = 0; $i < count($recursosAdicionais); $i++) {
						echo '<div class="row">';
						if($recursosAdicionais[$i]->id == Anuncio::$_turbinados_empresa['FOTOS']) {

							echo CHtml::CheckBox('Empresas[recursos_adicionais]['.$i.']', false , array ('data-valor'=>$recursosAdicionais[$i]->valor, 'data-attribute' => $recursosAdicionais[$i]->flag, 'value'=>$recursosAdicionais[$i]->id, 'class'=>'recursos-adicionais')); 
							echo '<div class="label-content">';
							echo '<label class="label-text">'.$recursosAdicionais[$i]->titulo.'</label>';
							echo '<label class="label-value" id="valor'.$recursosAdicionais[$i]->id.'">(R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</label>';
							echo '</div>';
							echo '<br class="clr" />';
							echo '<div id="div-turbo-fotos" class="sub-row sub-fotos" style="display:none;">';
							for($j = 0; $j < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMPRESA']; $j++) {
								
								echo '<div class="item-foto">';
								echo CHtml::image(Yii::app()->theme->baseUrl.'/img/addfoto.png',
			                                          "alt", array('id'=>$j, 'class'=>'img-upload img-turbinada', 'width' => '80%', 'height' => '80%'));
															 echo CHtml::fileField('Empresas[foto-turbinada]['.$j.']', null, array('id'=>'file-'.$j, 'class'=>'hide file-img-turbinada', 'disabled'=>true));
							 
							 echo '</div>';

							}
							 echo '</div>';
						}

						if($recursosAdicionais[$i]->flag == 'cpm') {

							echo CHtml::CheckBox('Empresas[recursos_adicionais]['.$i.']', false , array ('data-valor'=>$recursosAdicionais[$i]->valor, 'data-attribute' => $recursosAdicionais[$i]->flag, 'value'=>$recursosAdicionais[$i]->id, 'class'=>'recursos-adicionais', 'id'=>"check-cpm")); 
							echo '<div class="label-content label-margin">';
							echo '<label class="label-text">'.$recursosAdicionais[$i]->titulo.'</label>';
							echo '<label class="label-value" id="valor'.$recursosAdicionais[$i]->id.'"><b id="bold-valor-cpm"> (R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).'</label>';
							echo '</div>';
							echo '	
							<div id="div-periodo-impressoes" class="sub-row" style="display:none; margin-top:25px">
								<div class="row-1" id="div-limite-impressoes">	
									<label class="label-text label-margin">Quantidade de <br /> impressões:</label>	
									<select id="qtde-impressoes" name="EmpresasImpressoes[limitviews]">
										<option value="10" selected>10 mil impressões</option>
										<option value="20">20 mil impressões</option>
										<option value="30">30 mil impressões</option>
										<option value="40">40 mil impressões</option>
										<option value="50">50 mil impressões</option>
										<option value="60">60 mil impressões</option>
									</select>
								</div>	
								<div class="row-1">
									<label class="label-text">Período:</label>	
									<select id="periodo-impressoes" name="EmpresasImpressoes[limitdate]">
									</select>
								</div>
							</div>';
							echo '<div style="clear:both;"></div>';
						}

						if($recursosAdicionais[$i]->flag == 'telefone') {
							echo CHtml::CheckBox('Empresas[recursos_adicionais]['.$i.']', false , array ('data-valor'=>$recursosAdicionais[$i]->valor, 'data-attribute' => $recursosAdicionais[$i]->flag, 'value'=>$recursosAdicionais[$i]->id, 'class'=>'recursos-adicionais')); 
							echo '<div class="label-content">';
							echo '<label class="label-text">'.$recursosAdicionais[$i]->titulo.'</label>';
							echo '<label class="label-value" id="valor'.$recursosAdicionais[$i]->id.'">(R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</label>';
							echo '</div>';
							echo '<div class="sub-row" id="div-turbo-telefone" style="display:none;">';
							//echo $form->labelEx($empresa,'telefone');
							echo $form->textField($empresa, 'telefone', array('maxlength' => 20, 'id'=>'telefone'));
							echo $form->error($empresa,'telefone');
							echo '</div>';
						}

						if($recursosAdicionais[$i]->flag == 'video') {
							echo CHtml::CheckBox('Empresas[recursos_adicionais]['.$i.']', false , array ('data-valor'=>$recursosAdicionais[$i]->valor, 'data-attribute' => $recursosAdicionais[$i]->flag, 'value'=>$recursosAdicionais[$i]->id, 'class'=>'recursos-adicionais')); 
							echo '<div class="label-content">';
							echo '<label class="label-text">'.$recursosAdicionais[$i]->titulo.'</label>';
							echo '<label class="label-value" id="valor'.$recursosAdicionais[$i]->id.'">(R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</label>';
							echo '</div>';
							echo '<div class="sub-row video" id="div-turbo-video" style="display:none;">';
							//echo $form->labelEx($empresa,'video');
							echo $form->textField($empresa, 'video', array('maxlength' => 150, 'id'=>'video'));
							echo $form->error($empresa,'video');
							echo '</div>';
						}

						if($recursosAdicionais[$i]->flag == 'descricao') {
							echo CHtml::CheckBox('Empresas[recursos_adicionais]['.$i.']', false , array ('data-valor'=>$recursosAdicionais[$i]->valor, 'data-attribute' => $recursosAdicionais[$i]->flag, 'value'=>$recursosAdicionais[$i]->id, 'class'=>'recursos-adicionais')); 
							echo '<div class="label-content">';
							echo '<label class="label-text">'.$recursosAdicionais[$i]->titulo.'</label>';
							echo '<label class="label-value" id="valor'.$recursosAdicionais[$i]->id.'">(R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</label>';
							echo '</div>';
							echo '<div class="sub-row" id="div-turbo-descricao" style="display:none;">';
							//echo $form->labelEx($empresa,'descricao'); 
							echo $form->textArea($empresa, 'descricao', array('maxlength' => 1000, 'id'=>'descricao'));
							echo $form->error($empresa,'descricao');
							echo '</div>';
						}
						echo '</div>';
					}

				}
			?>
		


			<br/><br/><br/>

		</div>
		<div class="line-cadastro-15">
			<div class="container">
				<div class="box-cadastro-15">
					<div class="quadro-box-cadastro-15a">
						<div class="div-text-white-cadastro">
							<span class="text-white-cadastro">Seu anúncio está pronto!</span>
						</div>
						<icon class="icone-foto-cadastro6"></i>
					</div>	
					<div class="quadro-box-cadastro-15b">
						<div class="line-box-cadastro-15">
							<div class="quadro-box-cadastro-15d">
								<div class="div5-cadastro-green">
									<span class="text-cadastro-green6">ANÚNCIO:</span>
								</div>
								<div class="div-text-cadastro-white-2">
									<span class="text-white-cadastro-2">R$</span>
								</div>
								<div class="div-text-cadastro-white-3">
									<span class="text-white-cadastro-3" id="valor-anuncio">
										<?php
											echo Utils::formataValorView(Yii::app()->request->getParam('valor'));
										?>
									</span>
								</div>

							</div>
							<div class="quadro-box-cadastro-15d">
								<div class="div5-cadastro-green">
									<span class="text-cadastro-green6">TURBINADA:</span>
								</div>
								<div class="div-text-cadastro-white-2">
									<span class="text-white-cadastro-2">R$</span>
								</div>
								<div class="div-text-cadastro-white-3">
									<span class="text-white-cadastro-3" id="valor-turbinada">0,00</span>
								</div>
							</div>
							<div class="quadro-box-cadastro-15d">
								<div class="div5-cadastro-green">
									<span class="text-cadastro-green6">TOTAL:</span>
								</div>
								<div class="div-text-cadastro-white-2">
									<span class="text-white-cadastro-2">R$</span>
								</div>
								<div class="div-text-cadastro-white-3">
									<span class="text-white-cadastro-3" id="valor-total">
										<?php
											echo Utils::formataValorView(Yii::app()->request->getParam('valor'));
										?>
									</span>
								</div>
							</div>	
						</div>	
					</div>	
					<div class="quadro-box-cadastro-15c">
						<div style="display:none;">
							 <a class="botao-cadastro-1" id="botao-cad-visualizar">VISUALIZAR</a>
						</div>
						<!-- mudar isso aqui de lugar -->
					<!--<span>Aceito os termos de condição</span>
					<input type="checkbox" id="check-termos-condicao"/>-->
					<div class="errorMessage" id="error-termo"></div>
						<div>
							<?php
								echo $form->hiddenField($empresa, 'usuarios_id');
								
								if(isset($meses)) {
									// hidden que indica a qtde de mes do anuncio
								echo CHtml::hiddenField('duracaomeses', $meses, array('id'=>'duracaomeses'));
								}

								echo CHtml::hiddenField('hidden-valor-cpm', 99.00, array('id'=>'hidden-valor-cpm'));

								echo GxHtml::submitButton(Yii::t('app', 'Finalizar'), array('class'=>'botao-cadastro-2', 'id'=>'btn-form', 'onclick' => '_gaq.push(["_trackEvent", "Empresa", "click", "Finalizar"]);'));
								$this->endWidget();
							?>
						</div>

					</div>	
				</div>	
			</div>
		</div>
	</div>
</section><!-- form -->
<footer class="footer">
	<div class="line-footer-cad">
		<div class="container">
			<div class="box-mfoter-6">
				<div class="">
					<a href="<?php echo Yii::app()->createUrl('site/index'); ?>" class="icone-footer"></a>
				</div>	
			</div>		
		</div>
	</div>
</footer>

<!-- campo hidden valor total turbinada -->
<input type="hidden" id="valor-total-turbinada" value="0"/>
<input type="hidden" id="valor-anuncio-hidden" value="<?php echo Yii::app()->request->getParam('valor');?>"/>