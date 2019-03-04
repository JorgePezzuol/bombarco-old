<?php
	
	// fineuploader
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/js/fineuploader/fine-uploader-new.css');
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/fineuploader/jquery.fine-uploader.js?'.microtime(), 
		CClientScript::POS_END);

	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/vendor/jquery-ui.js?e='.microtime(), CClientScript::POS_END);

	// wysig
	Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg-editor.min.css');
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg-editor.min.js');
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg.min.js');

    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/embarcacoes.js?'.microtime(), CClientScript::POS_END);

    
$form = $this->beginWidget('GxActiveForm', array(
	'id' => 'embarcacoes-form',
	'enableAjaxValidation' => true,
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableClientValidation'=>true,
));
// calculamos o ID do anuncio para conseguir linkar ao das fotos (meio gambs)
$criteria = new CDbCriteria;
$criteria->order = "id DESC";
$criteria->limit = 1;
do {
	$flg = false;
	$id = Embarcacoes::model()->find($criteria)->id + 5;	
	$id_anuncio = rand($id, 99999);
	if(Embarcacoes::model()->findByPk($id_anuncio) == null) {
		$flg = true;
	}
} while(!$flg);
echo "<input name='id_anuncio' id='id_anuncio' type='hidden' value='".$id_anuncio."'/>";
// fim gambs
?>

<?php $this->renderPartial('templates'); ?>
	

<section class="content">
	<?php
		if(!$flgEstaleiro) {
			echo '<div class="line-header-cad">
				<div class="container">
					<div class="box-cadastro-line-header">
						<div class="quadro-box-cadastro-lh-a">';
							echo '<a href="'.Yii::app()->homeUrl.'" class="icone-foto-cadastro-lh1"></a>
							<br/><br/>
							<div id="erro_topo" class="errorMessage" style="width:1020px; top: 0px !important;margin-left:10px;"></div>
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

							<div class="div-text-cadastro-lh1">';
								if(Yii::app()->request->getParam('individual') == null) {
									echo '<span class="text-cadastro-lh1">CADASTRO DO ANÚNCIO '.($qntAnunciosCadastrados+1).'/'.$qntPermitida.'</span>';
								}
								else {
									echo '<span class="text-cadastro-lh1">CADASTRO DO ANÚNCIO</span>';
								}
							echo '</div>
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
										// se for o segundo anuncio pra cima, n exibir preço do plano
										$valorPlano = Yii::app()->request->getParam('valor');
										$tipo_anuncio = Yii::app()->request->getParam('tipo_anuncio');

										if($tipo_anuncio == "plano") {

											if($qntAnunciosCadastrados > 0) {
												
												echo '<span class="text-cadastro-lh4">0,00</span>';
											}
											else {

												echo '<span class="text-cadastro-lh4">'.Utils::formataValorView(Yii::app()->request->getParam('valor')).'</span>';	
											}

										}

										// anuncio individual
										else {

											// se é plano gratuito, mostrar valor zero
											if(PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id) == true) {
												echo '<span class="text-cadastro-lh4">'.Utils::formataValorView(Yii::app()->request->getParam('valor')).'</span>';	
											}
											else {
												echo '<span class="text-cadastro-lh4">0,00</span>';	
											}
										}

									
									echo '</div>
									<icon class="icone-foto-cadastro-lh3"></i>
						</div>

					</div>
				</div>
			</div>';
		}
	?>


	<?php if($flgEstaleiro): ?>
		<div class="line-cadastro-1" style="margin-top:0px !IMPORTANT;">
	<?php else: ?>
		<div class="line-cadastro-1">
	<?php endif ?>
		<div class="container">
			<div class="box-cadastro-1">
				<span class="title-cad-2"> Home > Anunciar > Cadastro </span>
				<span class="title-cad-1"> Cadastre seu anúncio </span>
				<span class="title-cad-3">	Preencha os campos abaixo para criar seu anúncio</span>
			</div>
		</div>
	</div>
<div class="embarcacoes-form-content">
	<div class="line-cadastro-2">
		<div class="container">
			<div class="box-cadastro-2">
					<div class="span-cadastro-top">
						<span class="text-cadastro-top"><b>Atenção:</b> Os campos com * são de preenchimento obrigatório. <?php if($flgEstaleiro) echo '| <b>'.($qntAnunciosCadastrados+1) . ' / '. $qntPermitida.'</b>'; ?></span>

					</div>
					<!-- mensagem de erro gerado no servidor -->
					<?php

						echo $form->errorSummary($model);
						echo $form->errorSummary($motorModelo);
						echo $form->errorSummary($motorFabricante);

						$flashMessages = Yii::app()->user->getFlashes();
						if ($flashMessages) {
							echo '<ul class="flashes">';
							foreach($flashMessages as $key => $message) {
								echo '<li><div style="position:relative; top:10px;font-size:22px; font-weight:bolder; color:#00918E;" class="flash-' . $key . '">' . $message . "</div></li>\n";
							}
								echo '</ul>';
						}

					?>
					<?php
						// estaleiro nao tem email, nem cidade nem uf
						if(!$flgEstaleiro) {
							echo '<div class="quadro-box-cadastro-2">
									<span class="text-sup-form-cadastro">E-mail para contato*:</span>
								<div class="campo-form-cadastro">';
									//echo $form->textField($model, 'email', array('class' => 'font-form'));
									echo CHtml::textField('Embarcacoes[email]', $email,
									 array('id'=>'Embarcacoes_email',
									       'width'=>100,
									       'maxlength'=>100));
								echo '</div><br class="clr" />
								<div class="errorMessage" id="error-email"></div>
							</div>';

							// n preencheu estado
							if($model->estados_id == "") {
								echo '<div class="quadro-box-cadastro-2">
									<span class="text-sup-form-cadastro">Localização (UF)*:</span>
									<div>';
										echo Estados::getModelDropDown($form, $model,'Embarcacoes_cidades_id');
									echo '</div>
									<div class="errorMessage" id="error-uf"></div>
								</div>';
							}

							// ja vir estado preenchido
							else {

								echo '<div class="quadro-box-cadastro-2" id="div-estados-hidden" style="display:none;">
									<span class="text-sup-form-cadastro">Localização (UF)*:</span>
									<div>';
										echo Estados::getModelDropDown($form, $model,'Embarcacoes_cidades_id');
									echo '</div>
									<div class="errorMessage" id="error-uf"></div>
								</div>';

								echo '<div class="quadro-box-cadastro-2" id="div-cache-estados">
								<input type="hidden" name="Embarcacoes[estados_id]" value="'.$model->estados_id.'"/>
									<span class="text-sup-form-cadastro">Localização (UF)*:</span>
								<div class="campo-form-cadastro" id="cache-estados-id" style="cursor:pointer;">';
									echo '<input disabled type="text" style="width:100%; padding-left:10px; height:40px;" value="'.$model->estados->nome.'"  />';
								echo '</div><br class="clr" />
								<div class="errorMessage" id="error-email"></div>
							</div>';
							}


							// n preencheu cidade
							if($model->cidades_id == "") {
								echo '<div class="quadro-box-cadastro-2">
										<span class="text-sup-form-cadastro">Cidade*:</span>
									<div>';
										echo $form->dropDownList($model,'cidades_id', array('empty'=>'selecione'));
									echo '</div>
									<div class="errorMessage" id="error-cidade"></div>
								</div>';
							}

							// ja vir cidade preenchida
							else {

								echo '<div class="quadro-box-cadastro-2" id="div-cidades-hidden" style="display:none;">
										<span class="text-sup-form-cadastro">Cidade*:</span>
									<div>';
										echo $form->dropDownList($model,'cidades_id', array('empty'=>'selecione'), array('id'=>'embarc_cid'));
									echo '</div>
									<div class="errorMessage" id="error-cidade"></div>
								</div>';

								echo '<div class="quadro-box-cadastro-2" id="div-cache-cidades">
									<input type="hidden" id="Embarcacoes_cidades_id" name="Embarcacoes[cidades_id]" value="'.$model->cidades_id.'"/>
									<span class="text-sup-form-cadastro">Cidade*:</span>
								<div class="campo-form-cadastro" id="cache-cidades-id" style="cursor:pointer;">';
									echo '<input disabled type="text" style="width:100%; padding-left:10px; height:40px;" value="'.$model->cidades->nome.'"  />';
								echo '</div><br class="clr" />
								<div class="errorMessage" id="error-email"></div>
							</div>';

							}




						}
					?>

			</div>
		</div>
	</div>
	<div class="line-cadastro-3">
		<div class="container">
			<div class="box-cadastro-3">
							<span class="text-cadastro-green4">Categoria do Anúncio*:</span>
					<div class="quadro-box-cadastro-3b">

			             <div class="compactRadioGroup">
				            <?php
				                   echo $form->radioButtonList($model, 'embarcacaoMacros',
				                    array(4 => 'Barco de Pesca',
				                          2 => 'Lancha',
				                          3 => 'Veleiro',
				                          1 => 'Jet Ski'),
				                    array('name' => 'Embarcacoes[embarcacao_macros_id]', 'class'=>'Embarcacao-macros-id', 'separator' => "  " ) );
				            ?>
				         </div>

				         <div class="errorMessage" id="error-macro"></div>

					</div>
			</div>
		</div>
	</div>
	<div class="line-cadastro-4">
		<div class="container">
			<div class="box-cadastro-4">

				<?php
					// estaleiro é sempre novo
					if(!$flgEstaleiro) {
						echo '<div class="quadro-box-cadastro-4a">
							<span class="text-cadastro-green4">Estado do produto*:</span>
						</div>
						<div class="quadro-box-cadastro-4b">';

		                        echo $form->radioButtonList($model, 'estado',
		                        array(  'N' => 'Novo',
		                                'U' => 'Usado'),
		                        array('separator' => "  ", 'class'=>'estado' ) );

		                    echo '<div class="errorMessage" id="error-estado"></div>';
		              echo '</div>';
					}
				?>

				<?php
					// array com anos para o usuario escolher
					$anos = array();
					for($i = 1976; $i < 2020; $i++) {
						$anos[$i] = $i;
					}
				?>

				<div class="quadro-box-cadastro-4c">
						<div class="div-cadastro-green">
							<span class="text-cadastro-green2">Ano*:</span>
						</div>
						<div class="select-form-cadastrar2">
								<?php echo $form->dropDownList($model,'ano', $anos, array('prompt'=>'Selecione'), array('class'=>'select-anuncio-pad'))?>
						</div>
						<div style="top: 0px !important; left: 0px !important; position: inherit !important;" class="errorMessage" id="error-ano"></div>
				</div>

				<?php

						echo '<div class="quadro-box-cadastro-4d div-valor">
						<div class="div-cadastro-green">
							<span class="text-cadastro-green3">Valor (R$):</span>
						</div>
						<div class="campo-form-cadastro2">';
								echo $form->textField($model, 'valor', array('class' => 'font-form', 'data-maxprice'=>"$maxprice"));
								echo '<section class="section-duvida-form">
									<a href="#" class="btn-duvida-form"></a>
									<section class="none-duvidas">
										<article class="article-duvida">
											Anúncios sem valor tem menos prioridade na busca.
										</article>
										<i class="ico-arrow-down"></i>
									</section>
									<div id="div-check-valor" style="position: relative;top: 15px; width: 500px;font-size: 12px;right: 105px;" class="div-check-valor">
										<input type="checkbox" style="display:none;" value="0" id="check-valor" name="check-valor"/>
										<label id="label-check-valor" for="check-valor">Não desejo informar o valor do anúncio.</label>
									</div>
								</section>';
						echo '</div>
					</div>';

				?>

			</div>
		</div>
	</div>
	<div class="line-cadastro-5">
		<div class="container">
			<div class="box-cadastro-5">
				<div class="quadro-box-cadastro-5a">
								<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2"></a>
									<section class="none-duvidas2">
										<article class="article-duvida2">
											Escolha o fabricante/estaleiro da sua embarcação.
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>

					<div class="validate-opacity"></div>
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Fabricante*:</span>
					</div>
					<div class="select-form-cadastrar3" id="input-fabricante">
						<select id="fabricante-embarcacao" name="Embarcacoes[embarc_fab]">
							<option value="" selected="selected">Nome do fabricante</option>
						</select>
					</div>
					<div class="errorMessage" id="error-fabricante"></div>
				</div>
				<div class="quadro-box-cadastro-5a quadro-5b">
								<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2"></a>
									<section class="none-duvidas2">
										<article class="article-duvida2">
											Qual o modelo da sua embarcação?
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>
					<div class="validate-opacity"></div>
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Modelo*:</span>
					</div>
					<div class="select-form-cadastrar3" id="input-modelo">
						<select id="modelo-embarcacao" name="Embarcacoes[embarcacao_modelos_id]">
							<option value="" selected="selected">Nome do modelo</option>
						</select>
					</div>
					<div class="errorMessage" id="error-modelo"></div>
				</div>
				<br class="clr" />
				<div class="quadro-box-cadastro-5b" id="div-n-encontrou-fabricante">
					<input type="checkbox" id="n-encontrou-fabricante" disabled name="fabricante-nao-tinha"/>
					<label for="n-encontrou-fabricante">Não encontrou o fabricante? Digite no campo acima.</label>
				</div>
				<div class="quadro-box-cadastro-5b" id="div-n-encontrou-modelo-fabricante">
					<input type="checkbox" id="n-encontrou-modelo-fabricante" disabled/>
					<label for="n-encontrou-modelo">Não encontrou o modelo? Digite no campo acima.</label>
				</div>

			</div>

			<div class="box-cadastro-5" style="height:115px !important;">
				<div class="quadro-box-cadastro-5a">
								

					<div class="validate-opacity combustivel"></div>
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Combustível*:</span>
					</div>
					<div class="select-form-cadastrar3" id="input-fabricante">
						<select style="width: 165px !important; margin-left:15px;" id="combustivel" name="Embarcacoes[combustivel]">
							<option selected value="NULL">Selecione</option>
							<option value="Gasolina">Gasolina</option>
							<option value="Diesel">Diesel</option>
						</select>
					</div>
					<div class="errorMessage" id="error-fabricante"></div>
				</div>
				
				<br class="clr">
				
				<div class="quadro-box-cadastro-5b" id="div-n-encontrou-modelo-fabricante" style="
    /* display: none; */
    visibility: hidden;
">
					<input type="checkbox" id="n-encontrou-modelo-fabricante"><span class="span-checkbox"><i class="ico-radio"></i></span>
					<label for="n-encontrou-modelo">Não encontrou o modelo? Digite no campo acima.</label>
				</div>

			</div>

		</div>
	</div>




	<?php
		// se for estaleiro, exibiremos os campos de estaleiro
		if($flgEstaleiro) {
			echo '<div class="line-cadastro-6 hidden-depende-modelo" style="display:none">
					<div class="container">
						<div class="box-cadastro-6">
							<div class="quadro-box-cadastro-6b" style="width:320px">

								<div class="div-cadastro-green">
									<span class="text-cadastro-green">Tipo:</span>
									<div class="campo-form-cadastro2" id="div-embarcacoes-tipo" style="margin-left:60px">';
									echo CHtml::textField('Embarcacoes[tipo]', '', array('class' => 'font-form', 'disabled'=>true));
								echo '</div>
								</div>
								<div class="errorMessage" id="error-tipo"></div>
								<br />
								<div class="checkbox-cadastro" style="margin-top: 31px">
									<input type="checkbox" id="check-editar-dados" name="check-editar-dados" style="display:none"/>
									<label>Editar Dados</label>
								</div>
							</div>

							<div class="quadro-box-cadastro-6c" style="width:320px">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green">Boca <br> <small>(metros)</small>:</span>
									<div class="campo-form-cadastro2" style="margin-left: 44px">';
										echo CHtml::textField('Embarcacoes[Boca]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'boca'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-boca"></div>
							</div>
							<div class="quadro-box-cadastro-6a" style="border:solid 0px">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Calado <br> <small>(metros)</small>:</span>
									<div class="campo-form-cadastro2" style="margin-left: 40px">';
									echo CHtml::textField('Embarcacoes[calado]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'calado'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-calado"></div>
							</div>

							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Pé Direito <br> <small>(metros)</small>:</span>
									<div class="campo-form-cadastro2" style="margin-left: 6px">';
									echo CHtml::textField('Embarcacoes[pedireito]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'pedireito'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-pedireito"></div>
							</div>
							<div class="quadro-box-cadastro-6a" >
								<div class="div-cadastro-green" >
									<span class="text-cadastro-green2">Tanque <br>Água <small>(litros)</small>:</span>
									<div class="campo-form-cadastro2" style="margin-left: 0px">';
									echo CHtml::textField('Embarcacoes[tanqueagua]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'tanqueagua'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-tanqueagua"></div>
							</div>
							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Número de<br> Camarotes:</span>
									<div class="campo-form-cadastro2" style="margin-left: 9px">';
									echo CHtml::textField('Embarcacoes[ncamarotes]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'ncamarotes'));
								echo '</div>
								</div>
								<div class="errorMessage" id="error-ncamarotes"></div>
							</div>

							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Número de<br> Banheiros:</span>
									<div class="campo-form-cadastro2" style="margin-left: -1px">';
									echo CHtml::textField('Embarcacoes[nbanheiros]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'nbanheiros'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-nbanheiros"></div>
							</div>
							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green">Tamanho* <br> <small>(pés)</small>:</span>
									<div class="campo-form-cadastro2" style="margin-left: 10px">';
									echo CHtml::textField('Embarcacoes[tamanho]', '', array('class' => 'font-form'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-tamanho"></div>
							</div>
							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2" style="margin-top: 20px;">Tanque<br> Combustível <br> <small>(litros)</small>:</span>
									<div class="campo-form-cadastro2" style="margin-left: -7px">';
									echo CHtml::textField('Embarcacoes[tanquecombustivel]', '', array('class' => 'font-form', 'disabled'=>true, 'id'=>'tanquecombustivel'));
									echo '</div>
								</div>
								<div class="errorMessage" id="error-nbanheiros"></div>
							</div>

							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Passageiros<br> Dia*:</span>
								<div class="campo-form-cadastro2" style="margin-left: -6px">';
									echo CHtml::textField('Embarcacoes[dia]', '', array('class' => 'font-form'));
								echo '</div>
								</div>
								<div class="errorMessage" id="error-pass-dia"></div>
							</div>
							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Passageiros<br> Noite*:</span>
								<div class="campo-form-cadastro2" style="margin-left: 2px;">';
									echo CHtml::textField('Embarcacoes[noite]', '', array('class' => 'font-form'));
								echo '</div>
								</div>
								<div class="errorMessage" id="error-pass-noite"></div>
							</div>
							<div class="quadro-box-cadastro-6a">
								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Peso<br> Casco <small>(kg)</small>:</span>
								<div class="campo-form-cadastro2" style="margin-left: 12px;">';
									echo CHtml::textField('Embarcacoes[pesocasco]', '', array('class' => 'font-form', 'id'=>'pesocasco'));
								echo '</div>
								</div>
								<div class="errorMessage" id="error-pass-noite"></div>
							</div>
						</div>
					</div>

			</div>';

			// anuncio normal - jetski (campos é diferentes)
			echo '<div class="line-cadastro-6 hidden-depende-modelo-jetski" style="display:none;">
				<div class="container">

					<div class="box-cadastro-6">
						<div class="quadro-box-cadastro-6b" id="tipo-jetski" style="height:64px !important; width:433px !important; margin-top:28px;" >

						</div>
						<div class="quadro-box-cadastro-6b" style="width:433px !important" >
							<div class="div-cadastro-green">
								<span class="text-cadastro-green">Tempo do Motor:</span>
								<div class="campo-form-cadastro2" id="div-embarcacoes-tipo">';
								echo CHtml::textField('Embarcacoes[motor_de_fabrica]', '', array('class' => 'font-form', 'disabled'=>true));
							echo '</div>
							</div>
							<div class="checkbox-cadastro" id="div-editar-dados-jetski">
								<input type="checkbox" style="display:none" id="check-editar-dados-jetski" name="check-editar-dados"/>
								<label>Editar Dados</label>
							</div>
							<div class="errorMessage" id="error-motor-de-fabrica"></div>
						</div>
					</div>
				</div>
			</div>';
		}


		// anuncio normal
		else {
			// atributos do modelo caso a embarcação não seja um jetski
			echo '<div class="line-cadastro-6 hidden-depende-modelo" style="display:none;">
				<div class="container">

					<div class="box-cadastro-6" >
						<div class="quadro-box-cadastro-6b">
								<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2"></a>
									<section class="none-duvidas2" style="right:220px;top:38px">
										<article class="article-duvida2">
											Qual a versão da sua Lancha, Veleiro ou Jet Ski?
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>
							<div class="div-cadastro-green">
								<span class="text-cadastro-green">Tipo*:</span>
								<div class="campo-form-cadastro2" id="div-embarcacoes-tipo">';
								echo CHtml::textField('Embarcacoes[tipo]', '', array('class' => 'font-form'));
							echo '</div>
							</div>
							<div class="errorMessage" id="error-tipo"></div>
							<div class="checkbox-cadastro" id="div-editar-dados">
								<input type="checkbox" id="check-editar-dados" style="display:none" name="check-editar-dados"/>
								<label>Editar Dados</label>
							</div>
						</div>
						<div class="quadro-box-cadastro-6c">
								<!--<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2"></a>
									<section class="none-duvidas2" style="right:260px;top:38px">
										<article class="article-duvida2">
											Qual o tamanho da sua lancha em pés?
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>-->
							<div class="div-cadastro-green">
								<span class="text-cadastro-green">Tamanho* <br> <small>(pés)</small>:</span>
								<div class="campo-form-cadastro2">';
								echo CHtml::textField('Embarcacoes[tamanho]', '', array('class' => 'font-form'));
							echo '</div>
							</div>
							<div class="errorMessage" id="error-tamanho"></div>
						</div>
						<div class="quadro-box-cadastro-6a box-small-6" style="border:solid 0px">
								<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2"></a>
									<section class="none-duvidas2" style="right:166px;top:38px">
										<article class="article-duvida2">
											Quantos passageiros podem navegar na sua embarcação?
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>

							<div class="div-cadastro-green">
								<span class="text-cadastro-green2">Passageiros <br /> Dia*:</span>
								<div class="campo-form-cadastro2">';
								echo CHtml::textField('Embarcacoes[dia]', '', array('class' => 'font-form'));
							echo '</div>
							</div>
							<div class="errorMessage" id="error-pass-dia"></div>

						</div>

							<div class="quadro-box-cadastro-6a box-small-6" style="border:solid 0px">
							<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2"></a>
									<section class="none-duvidas2" style="right:166px;top:38px">
										<article class="article-duvida2">
											Para quantos passageiros existem acomodações para dormir na embarcação?
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>

								<div class="div-cadastro-green">
									<span class="text-cadastro-green2">Passageiros <br /> Noite*:</span>
									<div class="campo-form-cadastro2">';
									echo CHtml::textField('Embarcacoes[noite]', '', array('class' => 'font-form'));
								echo '</div>
								</div>
								<div class="errorMessage" id="error-pass-noite"></div>
							</div>
						</div>
					</div>
				</div>';


			// anuncio normal - jetski (campos é diferentes)
			echo '<div class="line-cadastro-6 hidden-depende-modelo-jetski" style="display:none;">
					<div class="container">

						<div class="box-cadastro-6">

							<div class="quadro-box-cadastro-6b" id="tipo-jetski"style="height:64px !important; width:433px !important; margin-top:28px;" >
								<span class="text-cadastro-green">Tipo:</span>
							</div>

							<div class="quadro-box-cadastro-6b" style="width:433px !important"  >
								<div class="div-cadastro-green">
									<span class="text-cadastro-green">Motor:</span>
									<div class="campo-form-cadastro2" id="div-embarcacoes-tipo">';
									echo CHtml::textField('Embarcacoes[motor_de_fabrica]', '', array('class' => 'font-form', 'disabled'=>true));
								echo '</div>
								</div>
								<div class="checkbox-cadastro" id="div-editar-dados-jetski">
									<input type="checkbox" style="display:none" id="check-editar-dados-jetski" name="check-editar-dados"/>
									<label>Editar Dados</label>
								</div>
								<div class="errorMessage" id="error-motor-de-fabrica"></div>
							</div>
						</div>
					</div>
				</div>';
		}
	?>

	<div class="line-cadastro-7" style="display:none;" id="div-motor">
		<div class="container" style="width:955px">
			<div class="box-cadastro-7" style="position:relative;">
				<div class="validate-opacity"></div>

				<div class="quadro-box-cadastro-7b">

					<div class="div-cadastro-gray">
						<div class="checkbox-cadastro">
							<input type="checkbox" id="check-nao-tem-motor" name="cad" class="checkcad1"/>
							<label for="check-nao-tem-motor">Minha embarcação não possui motor.</label>
						</div>
						<div class="errorMessage" id="error-motor"></div>
					</div>



				</div>

				<div class="quadro-box-cadastro-7a">
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Motor:</span>
						<div class="select-form-cadastrar8">
							<?php echo CHtml::dropDownList('Embarcacoes[qntmotores]', '',array(1, 2, 3, 4, 5), array('id'=>'qnt-motores')); ?>
						</div>
					</div>
				</div>
				<div class="quadro-box-cadastro-7a">
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Marca:</span>
						<div class="select-form-cadastrar8">

							<?php /*MotorFabricantes::getDropDown('Embarcacoes[motor_marca]', 'Embarcacoes_motor_modelo'); */?>

								<?php echo CHtml::dropDownList('Embarcacoes[motor_marca]', '',
							GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1))),
							array('prompt'=>'Selecione', 'id'=>'Embarcacoes_motor_marca', 'class'=>'motor_fabricante')); ?>

							<div class="errorMessage" id="error-motor-marca"></div>
						</div>
						<div class="quadro-box-cadastro-7b" style="margin-top: -18px;">
							<div class="div-cadastro-gray" id="div-check-n-achou-marca-motor">
								<div class="checkbox-cadastro">
									<input type="checkbox" id="n-encontrou-marca-motor" name="n-encontrou-marca-motor" class="checkcad1">
									<label for="n-encontrou-marca-motor">Não achei a Marca</label>
								</div>
								<div class="errorMessage" id="error-motor"></div>
							</div>
						</div>

					</div>
				</div>
				<div class="quadro-box-cadastro-7a box-cadastro-large">
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Modelo:</span>
						<div class="select-form-cadastrar8">
							<?php echo CHtml::dropDownList('Embarcacoes[motor_modelo]','', array(), array('prompt'=>'Selecione', 'class'=>'modelo-motor')); ?>
							<div class="errorMessage" id="error-motor-modelo"></div>
						</div>
					</div>
					<div class="quadro-box-cadastro-7b" style="margin-top: -3px;">
						<div class="div-cadastro-gray" id="div-check-n-achou-modelo-motor">
							<div class="checkbox-cadastro">
								<input type="checkbox" id="n-encontrou-modelo-motor" name="n-encontrou-modelo-motor" class="checkcad1">
								<label for="n-encontrou-modelo-motor">Não achei o Modelo</label>
							</div>
							<div class="errorMessage" id="error-motor"></div>
						</div>
					</div>
				</div>
				<div class="quadro-box-cadastro-7a">
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Tipo:</span>
						<div class="select-form-cadastrar8">
							<?php echo CHtml::textField('Embarcacoes[motor_tipo]','', array('class'=>'font-form motor_tipo', 'disabled' => true)); ?>
							<div class="errorMessage" id="error-motor-tipo"></div>
						</div>
					</div>
				</div>
				<div class="quadro-box-cadastro-7a box-cadastro-small">
					<div class="div-cadastro-green">
						<span class="text-cadastro-green" style="font-size:17px;">Potência (HP):</span>
						<div class="campo-form-cadastro2" id="div-potencia-motor">
							<?php echo CHtml::textField('Embarcacoes[motor_potencia]', '', array('class' => 'font-form motor-potencia', 'disabled' => true)); ?>

						</div>
					</div>
				</div>

				<div class="quadro-box-cadastro-7a box-cadastro-last">
					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Horas de Utilização:</span>
						<div class="campo-form-cadastro2">
							<?php echo CHtml::textField('Embarcacoes[motor_horas]', '', array('class' => 'font-form motor-horas')); ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>



	<div class="group-none">
		<!-- estaleiro não tem acessório -->
		<?php if(!$flgEstaleiro): ?>
		<div class="line-cadastro-8">
			<div class="container">
				<!-- essa div contem os acessorios -->
				<div id="div-acessorios">

					<!-- div de acessorios do jetski -->
					<div id="acessorios-jetski" style="display:none;">
						<div id="equipamentos-jetski" class="block-acessorios">
							<label class="label-title">Acessórios <br /> e Equipamentos</label>
							<br />
							<?php
								foreach($acessoriosJetSki as $acessorio) {
									print '<div class="div-itens">';
									print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][jetski][]"/>';
									print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
									print '</div>';
								}
							?>
						</div>
					</div>
					<!-- fim acessorios jetski -->

					<!-- div de acessorios de lancha -->
					<div id="acessorios-lancha" style="display:none;">
						<div id="equipamentos-lancha" class="block-acessorios">
							<label class="label-title">Acessórios e Equipamentos</label>
							<br />
							<?php
								foreach($acessoriosLancha as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
						<div id="navegacao-lancha" class="block-acessorios">
							<label class="label-title">Comunicação <br /> e Navegação</label>
							<br />
							<?php
								foreach($acessoriosLancha as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
						<div id="eletronicos-lancha" class="block-acessorios">
							<label class="label-title">Eletrônicos</label>
							<br />
							<?php
								foreach($acessoriosLancha as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][lancha][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
					</div>
					<!-- fim acessorios lancha -->

					<!-- div de acessorios de veleiro -->
					<div id="acessorios-veleiro" style="display:none;">
						<div id="equipamentos-veleiro" class="block-acessorios">
							<label class="label-title">Acessórios <br /> e Equipamentos</label>
							<br />
							<?php
								foreach($acessoriosVeleiro as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
						<div id="navegacao-veleiro" class="block-acessorios">
							<label class="label-title">Comunicação <br /> e Navegação</label>
							<br />
							<?php
								foreach($acessoriosVeleiro as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
						<div id="eletronicos-veleiro" class="block-acessorios">
							<label class="label-title">Eletrônicos</label>
							<br />
							<?php
								foreach($acessoriosVeleiro as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>

						<div id="velamestra-veleiro" class="block-acessorios">
							<label class="label-title">Vela Mestra</label>
							<br />
							<?php
								foreach($acessoriosVeleiro as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_MESTRA']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>

						<div id="velagenoa-veleiro" class="block-acessorios">
							<label class="label-title">Vela Genoa</label>
							<br />
							<?php
								foreach($acessoriosVeleiro as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_GENOA']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][veleiro][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
					</div>
					<!-- fim acessorios veleiro -->


					<!-- div de acessorios de pesca -->
					<div id="acessorios-pesca" style="display:none;">
						<div id="equipamentos-pesca" class="block-acessorios">
							<label class="label-title">Acessórios e Equipamentos</label>
							<br />
							<?php
								foreach($acessoriosPesca as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][pesca][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
						<div id="navegacao-pesca" class="block-acessorios">
							<label class="label-title">Comunicação <br /> e Navegação</label>
							<br />
							<?php
								foreach($acessoriosPesca as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][pesca][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
						<div id="eletronicos-pesca" class="block-acessorios">
							<label class="label-title">Eletrônicos</label>
							<br />
							<?php
								foreach($acessoriosPesca as $acessorio) {
									if($acessorio->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {
										print '<div class="div-itens">';
										print '<input type="checkbox" value="'.$acessorio->id.'" name="Embarcacoes[acessorios][pesca][]"/>';
										print '<label for="'.$acessorio->id.'">'.$acessorio->titulo.'</label>';
										print '</div>';
									}
								}
							?>
						</div>
					</div>
					<!-- fim acessorios pesca -->

					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
		<?php endif; ?>

	<?php
		// se for estaleiro, nao tem acessorios
		if(!$flgEstaleiro) {

			$this->renderPartial('_acessorios',
				array('acessoriosJetSki'=>$acessoriosJetSki,
					'acessoriosLancha'=>$acessoriosLancha,
					'acessoriosVeleiro'=>$acessoriosVeleiro,
					'acessoriosPesca'=>$acessoriosPesca)
				);
		}
	?>

		<div class="line-cadastro-9">
			<div class="container" style="width:955px">
				<div class="box-cadastro-9">
					<div class="quadro-box-cadastro-9a">


						<div class="div-cadastro-green">
								<section class="section-duvida-form2">
									<a href="#" class="btn-duvida-form2" style="top:45px"></a>
									<section class="none-duvidas2" style="right:106px;top:76px">
										<article class="article-duvida2" style="height: 100px; top: -168px;">
											Os clientes gostam de saber todas as informações sobre sua embarcação, forneça detalhes que possam tornar seu anuncio ainda mais atrativo.
										</article>
										<i class="ico-arrow-down2"></i>
									</section>
								</section>
							<span class="text-cadastro-green">Descrição*:</span>
						</div>
					</div>
					<div class="quadro-box-cadastro-9b">
						<div class="box-description-cadastro">

							<?php echo $form->textArea($model, 'descricao',
							array('maxlength' => 765, 'class' => 'description-cadastro')); ?>


						</div>
					</div>
				</div>
			</div>
		</div>


		<div class="line-cadastro-10" id="div-fotos-estaleiro">
			<div class="container">
				<div class="box-cadastro-10">
					<div class="quadro-box-cadastro-10a">
						<icon class="icone-foto-cadastro"></i>
						<div class="div-text-blue-cadastro-l10">
							<span class="text-blue-cadastro-l10">Adicionar fotos:</span>
						</div>
						<div class="div3-cadastro-green">
							<span class="text-cadastro-green">
								<?php
									if($flgEstaleiro) {
										echo Anuncio::$_max_fotos['MAX_FOTOS_ESTALEIRO'].' fotos máx.';
									}
									else {
										echo Anuncio::$_max_fotos['MAX_FOTOS_EMBARCACAO'].' fotos máx.';
									}
								?>
							</span>
						</div>
						<div class="div-cadastro-light">
							<span class="text-cadastro-light">Formatos aceitos: JPEG; PNG;. Tam. máx. 1mb.</span>
						</div>
					</div>
					<div class="quadro-box-cadastro-10b">
						<span class="text-featured2"></span>
						<div class="line-box-cadastro-10">
							<!-- div do plugin de multiupload -->
							<div id="uploader"></div>
						</div>
					</div>
				</div>
			</div>
		</div>


		<?php
			// testar se é estaleiro, se não for, vamos renderizar a view que contém
			// os recursos adicionais
			if(!$flgEstaleiro) {
				echo '<div class="line-cadastro-11">
					<div class="container">
						<div class="box-cadastro-11">
							<div class="quadro-box-cadastro-11a">
								<icon class="icone-foto-cadastro3"></i>
								<div class="div-text-blue-cadastro-l10">
									<span class="text-blue-cadastro-l10">Turbine seu anúncio!</span>
								</div>
							</div>
							<div class="quadro-box-cadastro-11b">
								<div class="div-cadastro-light2">
								<span class="text-cadastro-light">Agora você pode turbinar o seu anúncio com as nossas opções de adicionais, tornando seu anúncio mais completo e aumentando suas chances de conversão!</span>
								</div>
							</div>
						</div>
					</div>
				</div>';
			for($i = 0; $i < count($recursosAdicionais); $i++) {

				// CPM
				if($recursosAdicionais[$i]->flag == 'cpm') {
					echo '<div class="line-cadastro-12">
							<div class="container">
								<div class="box-cadastro-12">
									<div class="quadro-box-cadastro-12a">
											<div class="checkbox-cadastro2">
												<input type="checkbox" data-valor="'.$recursosAdicionais[$i]->valor.'" value="'.$recursosAdicionais[$i]->id.'" data-attribute="'.$recursosAdicionais[$i]->flag.'" id="check-cpm" name="Embarcacoes[recursos_adicionais]['.$i.']" class="recursos-adicionais checkcad1">
											</div>
									</div>
									<div class="quadro-box-cadastro-12b">
									<section class="section-duvida-form2">
										<a href="#" class="btn-duvida-form2" style="top:7px; right:261px"></a>
										<section class="none-duvidas2" style="right:249px;top:42px">
											<article class="article-duvida2" style="height: 173px; top: -241px;">

												Você escolhe quantas vezes (numero de impressões) e por quanto tempo (período) deseja ser visto, então seu anúncio aparecerá sempre nas áreas "Anúncios Patrocinados" do bombarco, aumentando bastante as suas chances de conversão.

											</article>
											<i class="ico-arrow-down2"></i>
										</section>
									</section>
										<div class ="div-cadastro-green-tb">
											<span id="span-cpm" class="text-cadastro-green-tb">'.$recursosAdicionais[$i]->titulo.'<b id="bold-valor-cpm"> (R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</b></span>
										</div>
									</div>
									<div class="quadro-box-cadastro-12d" style="display:none;" id="div-periodo-impressoes">
										<div class="div4-cadastro-green">
											<span class="text-cadastro-green5">Período:</span>
										</div>
										<div class="select-form-cadastrar8">

											<select style="margin-left:0px;" id="periodo-impressoes" name="EmbarcacaoImpressoes[limitdate]">
											</select>
										</div>

									</div>
									<div class="quadro-box-cadastro-12c" style="display:none;" id="div-limite-impressoes">

										<div class="div4-cadastro-green">
											<span class="text-cadastro-green5" style="margin-left:-55px !IMPORTANT;">Quantidade de Impressões:</span>
										</div>
										<div class="select-form-cadastrar8">


											<select id="qtde-impressoes" name="EmbarcacaoImpressoes[limitviews]">
												<option value="10000" selected>10 mil impressões</option>
												<option value="20000">20 mil impressões</option>
												<option value="30000">30 mil impressões</option>
												<option value="40000">40 mil impressões</option>
												<option value="50000">50 mil impressões</option>
												<option value="60000">60 mil impressões</option>
											</select>
										</div>

									</div>
								</div>
							</div>
						</div>';
				} // destaque busca

				// titulo
				if($recursosAdicionais[$i]->flag == 'titulo') {
					echo '<div class="line-cadastro-14">
						<div class="container">
							<div class="box-cadastro-14">
								<div class="quadro-box-cadastro-14a">
										<div class="checkbox-cadastro2">
											<input type="checkbox" data-valor="'.$recursosAdicionais[$i]->valor.'" value="'.$recursosAdicionais[$i]->id.'" data-attribute="'.$recursosAdicionais[$i]->flag.'" id="check-titulo-embarcacao" name="Embarcacoes[recursos_adicionais]['.$i.']" class="recursos-adicionais checkcad1">
										</div>
								</div>
								<div class="quadro-box-cadastro-14b">
									<div class ="div-cadastro-green-tb">
										<span class="text-cadastro-green-tb">'.$recursosAdicionais[$i]->titulo.'<b> (R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</b></span>
										<span style="font-size:13px; position:relative; top:-5px;">(40 caractéres máx)</span>
									</div>

								</div>

								<div class="quadro-box-cadastro-14d">
									<div class="campo-form-cadastro3" style="display:none;" id="div-titulo"/>
										<input id="embarcacoes-titulo" maxlength="40" type="text" class="font-form3" disabled name="Embarcacoes[titulo]"/>
									</div>
								</div>
							</div>';
				} // destaque busca

					// destaque na busca
					if($recursosAdicionais[$i]->flag == 'destaque_busca') {
						echo '<div class="line-cadastro-12">
								<div class="container">
									<div class="box-cadastro-12">
										<div class="quadro-box-cadastro-12a">
												<div class="checkbox-cadastro2">
													<input type="checkbox" data-valor="'.$recursosAdicionais[$i]->valor.'" value="'.$recursosAdicionais[$i]->id.'" data-attribute="'.$recursosAdicionais[$i]->flag.'" id="cb-cadastro-" name="Embarcacoes[recursos_adicionais]['.$i.']" class="recursos-adicionais checkcad1">
												</div>
										</div>
										<div class="quadro-box-cadastro-12b">
										<section class="section-duvida-form2">
											<a href="#" class="btn-duvida-form2" style="top:7px; right:261px"></a>
											<section class="none-duvidas2" style="right:249px;top:42px">
												<article class="article-duvida2" style="height: 80px;top: -148px;">
													Nas listagens sua embarcação irá aparecer com um selo de destaque, chamando mais atenção do usuário.

												</article>
												<i class="ico-arrow-down2"></i>
											</section>
										</section>
											<div class ="div-cadastro-green-tb">
												<span class="text-cadastro-green-tb">'.$recursosAdicionais[$i]->titulo.'<b> (R$ '.$recursosAdicionais[$i]->valor.')</b></span>
											</div>
										</div>
									</div>
								</div>
							</div>';
					} // destaque busca

					// turbinado fotos
					if($recursosAdicionais[$i]->flag == 'fotos') {

						echo '<div class="line-cadastro-13">
								<div class="container">
									<div class="box-cadastro-13">
										<div class="quadro-box-cadastro-13a">
												<div class="checkbox-cadastro3">
													<input type="checkbox" data-valor="'.$recursosAdicionais[$i]->valor.'" value="'.$recursosAdicionais[$i]->id.'" data-attribute="'.$recursosAdicionais[$i]->flag.'" id="cb-cadastro-" name="Embarcacoes[recursos_adicionais]['.$i.']" class="recursos-adicionais checkcad1">
												</div>
										</div>
										<div class="quadro-box-cadastro-13b">
											<div class ="div-cadastro-green-tb">
												<span class="text-cadastro-green-tb">'.$recursosAdicionais[$i]->titulo.'<b> (R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</b></span>
											</div>
										</div>';

										echo '<div class="quadro-box-cadastro-13c">';
											echo'<div class="line-box-cadastro-13">';
												echo '<div id="uploader-turbo"></div>';
												/*for($j = 0; $j < Anuncio::$_max_fotos['MAX_FOTOS_TURBINADO_EMBARCACAO']; $j++) {
													echo '<div class="div-img2 quadro-box-cadastro-13d">
													<span style="color: red; display:none; margin-left:17px; font-size:13px !important;" class="error-foto text2-blue-cadastro-l10">Máx 1Mb</span>
													<img class="img-upload img-turbinada2 img-preview icone-foto-cadastro4"></img>
													<input type="file" name="Embarcacoes[foto-turbinada][]" class="hide-file-turbinada" disabled/>
													<div class="div-text2-blue-cadastro-l10 div-foto-turbinada">
														<span class="text2-blue-cadastro-l10 span-foto-turbinada">Adicionar foto</span>
													</div>
												</div>';
												}*/
											echo '</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
							
					} // fotos

					// video
					if($recursosAdicionais[$i]->flag == 'video') {
						echo '<div class="line-cadastro-14">
								<div class="container">
									<div class="box-cadastro-12">
										<div class="quadro-box-cadastro-14a">
												<div class="checkbox-cadastro2">
													<input type="checkbox" data-valor="'.$recursosAdicionais[$i]->valor.'" value="'.$recursosAdicionais[$i]->id.'" data-attribute="'.$recursosAdicionais[$i]->flag.'" id="cb-cadastro-" name="Embarcacoes[recursos_adicionais]['.$i.']" class="recursos-adicionais checkcad1">
												</div>
										</div>
										<div class="quadro-box-cadastro-14b">
											<div class ="div-cadastro-green-tb">
												<span class="text-cadastro-green-tb">'.$recursosAdicionais[$i]->titulo.' <b>(R$ '.Utils::formataValorView($recursosAdicionais[$i]->valor).')</b></span>
											</div>

										</div>
										<div class="quadro-box-cadastro-14d">
											<div class="campo-form-cadastro3" id="div-video" style="display:none;">
												<input id="Embarcacoes_video"  type="text" class="font-form3" disabled name="Embarcacoes[video]"/>
											</div>
										</div>
									</div>
								</div>
							</div>';
					}
				} // for
			}
			// loop turbinados

		?></div></div>

		<div class="line-cadastro-15">
			<div class="container">
				<div class="box-cadastro-15">
					<?php
						if(Yii::app()->request->getParam('individual') == null) {} else {
					?>
						<div class="quadro-box-cadastro-15a">
							<div class="div-text-white-cadastro">
								<span class="text-white-cadastro">Seu anúncio está pronto!</span>
							</div>
							<icon class="icone-foto-cadastro6"></i>
						</div>
					<?php } ?>
					<div class="quadro-box-cadastro-15b">
						<div class="line-box-cadastro-15">

							<?php if(Yii::app()->request->getParam('valor') != null && $qntAnunciosCadastrados == 0): ?>
								<div class="quadro-box-cadastro-15d">
									<div class="div5-cadastro-green">
										<span class="text-cadastro-green6">ANÚNCIO</span>
									</div>
									<div class="div-text-cadastro-white-2">
										<span class="text-white-cadastro-2">R$</span>
									</div>
									<div class="div-text-cadastro-white-3">
										<span class="text-white-cadastro-3" id="valor-anuncio">
											<?php

												// se for o segundo anuncio pra cima, n exibir preço do plano
												$valorPlano = Yii::app()->request->getParam('valor');
												$tipo_anuncio = Yii::app()->request->getParam('tipo_anuncio');

												if($tipo_anuncio == "plano") {

													if($qntAnunciosCadastrados > 0) {
														
														echo '0,00';
													}
													else {

														echo Utils::formataValorView(Yii::app()->request->getParam('valor'));	
													}

												}

												// anuncio individual
												else {

													// se é plano gratuito, mostrar valor zero
													if(PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id) == true) {
														echo Utils::formataValorView(Yii::app()->request->getParam('valor'));	
													}
													else {
														echo '0,00';	
													}
												}
											?>
										</span>
									</div>
								</div>
							<?php endif?>

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
										// se for o segundo anuncio pra cima, n exibir preço do plano
										$valorPlano = Yii::app()->request->getParam('valor');
										$tipo_anuncio = Yii::app()->request->getParam('tipo_anuncio');

										if($tipo_anuncio == "plano") {

											if($qntAnunciosCadastrados > 0) {
												
												echo '0,00';
											}
											else {

												echo Utils::formataValorView(Yii::app()->request->getParam('valor'));	
											}

										}

										// anuncio individual
										else {

											// se é plano gratuito, mostrar valor zero
											if(PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id) == true) {
												echo Utils::formataValorView(Yii::app()->request->getParam('valor'));	
											}
											else {
												echo '0,00';	
											}
										}
													
										?>
									</span>
								</div>
							</div>
						</div>
					</div>

					<!-- mudar isso aqui de lugar -->
					<!--<span>Aceito os termos de condição</span>
					<input type="checkbox" id="check-termos-condicao"/>
					<div class="errorMessage" id="error-termo"></div>
					-->
					<div id="div-campos-hidden">
							<?php

								// indica se é estaleiro ou nao (0 não é 1 é)
								if($flgEstaleiro) {
									echo CHtml::hiddenField('flgEstaleiro', 1, array('id'=>'flgEstaleiro'));
								}

								else {
									echo CHtml::hiddenField('flgEstaleiro', 0, array('id'=>'flgEstaleiro'));
								}

								// hidden que indica a qtde de mes do anuncio
								echo CHtml::hiddenField('duracaomeses', $meses, array('id'=>'duracaomeses'));

								echo CHtml::hiddenField('hidden-valor-cpm', 99.00, array('id'=>'hidden-valor-cpm'));

								// soh aparece botao de outro anuncio se n for anuncio individual
								if(Yii::app()->request->getParam('individual') == null && ( ($qntAnunciosCadastrados+1) < $qntPermitida)) {
									echo GxHtml::button(Yii::t('app', 'PRÓXIMO ANÚNCIO'), array('class'=>'botao-cadastro-2 btn-next-anuncio', 'id'=>'btn-outro-anuncio', 'data-outro-anuncio'=>1));
								}


								echo GxHtml::button(Yii::t('app', 'FINALIZAR'), array('class'=>'botao-cadastro-2', 'id'=>'btn-form', 'data-outro-anuncio'=>0));
								
								/*echo GxHtml::button(Yii::t('app', 'FINALIZAR'), array('class'=>'botao-cadastro-2', 'id'=>'btn-form', 'data-outro-anuncio'=>0, 'onclick' => '_gaq.push(["_trackEvent", "anuncios", "click", "Finalizar"]);'));*/
							?>
						</div>
					<div class="quadro-box-cadastro-15c" >
						<div>
							 <a style="display:none;" class="botao-cadastro-1" id="botao-cad-visualizar">VISUALIZAR</a>
						</div>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="lbox-form" id="lbox-revise">
	<div class="texts-lbox-ag">
		<div class="div-title-form-lb">
			<span class="form-lb-title">Revise seu anúncio antes de prosseguir!</span>
		</div>
		<div class="div-title-form-lb2">
			<span class="form-lb-title"><b>Algumas características do seu anúncio não poderão ser editadas depois, com exceção de (fotos, localização, acessórios, motor, descrição). <br> Certifique-se de que seu anúncio foi cadastrado corretamente antes de continuar.</b></span>
		</div>
	</div>
	<div id="botoes_revisar" style="margin-left:18px;">
		<input type="button" name="botao-revisar" class="botao-lb-form-anun close" id="revisar-btn" value="REVISAR">
		<input type="button" name="botao-finalizar" class="botao-lb-form-anun2" id="finalizar-btn" value="FINALIZAR">
	</div>
</div>

	
</section>
<footer class="footerr">
	<div class="line-footer-cad">
		<div class="container" style="text-align:center;">
			<div class="box-mfoter-6">
				<div class="">
					<a href="<?php echo Yii::app()->homeUrl; ?>" class="icone-footer"></a>

					<div id="armored_website" style="width: 115px; height: 32px; position: absolute; top: 20px;  right: 15px;"></div>
				</div>
			</div>
		</div>
</footer>

<!-- campos hidden que servem para calcular os valores dos turbinados -->
<?php

	// se for o segundo anuncio pra cima, n exibir preço do plano
	$valorPlano = Yii::app()->request->getParam('valor');
	$tipo_anuncio = Yii::app()->request->getParam('tipo_anuncio');
	$valor = 0.00;

	if($tipo_anuncio == "plano") {

		if($qntAnunciosCadastrados > 0) {
			
			$valor = 0.00;
		}
		else {

			$valor = Yii::app()->request->getParam('valor');	
		}

	}

	// anuncio individual
	else {

		// se é plano gratuito, mostrar valor zero
		if(PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id) == true) {
			$valor = Yii::app()->request->getParam('valor');	
		}
		else {
			$valor = 0.00;
		}
	}
?>
<input type="hidden" id="valor-total-anuncio" value="<?php echo $valor;?>"/>
<input type="hidden" id="valor-total-turbinada" value="0"/>
<input type="hidden" id="valor-anuncio-hidden" value="<?php echo $valor;?>"/>


<?php
$this->endWidget();
?>
