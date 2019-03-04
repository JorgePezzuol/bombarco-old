
<?php
	
	// gambiarra para exibir o estado do barco **NÃO TIRE ISSO DAQUI**
	$novoOuUsado = $model->estado;
	if($novoOuUsado == "U") {
		$novoOuUsado = "Usado";
	}
	else {
		$novoOuUsado = "Novo";
	}

	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/embarcacoes_detalhe.js', CClientScript::POS_END);
	
?>
<section class="content">
	<div class="line-deemb1">
		<div class="container">
			<div class="box-deemb1">
				<div class="quadro-l1-deemb1">
					<span class="text-top-deemb" style="margin-top:30px !important"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
					<div class="search-deemb">

						<?php echo CHtml::form(array('site/url'), 'get', array('id'=>'form-search', 'name'=>'buscando')); ?>
							<input name="buscando" placeholder="Buscar <?php echo EmbarcacaoMacros::$macro[$model->embarcacao_macros_id] ?>" class="terms-deemb" type="text">
							<input class="find-deemb" type="submit">
							<input type="hidden" name="macro" value="<?php echo EmbarcacaoMacros::$macro_by_slug[$model->embarcacaoMacros->alias]; ?>"/>
						<?php echo CHtml::endForm(); ?>
						
					</div>
				</div>	
				<div class="quadro-l1-deemb2">

					<a href="<?php echo EmbarcacaoFabricantes::mountUrl($model); ?>">
						<?php
						$imagem = Yii::app()->theme->baseUrl.'/img/sem_foto_bb.jpg';
						if (!empty($model->embarcacaoModelos->embarcacaoFabricantes->logo)) {
							$imagem = Yii::app()->baseUrl.'/public/fabricantes/'.$model->embarcacaoModelos->embarcacaoFabricantes->logo;
						}
						?>
						<img class="bg-img-deemb" src="<?php echo $imagem;?>"/>	
					</a>

				</div>	
				<div class="quadro-l1-deemb3">
					<h1 class="title-emb-deemb" style="width:520px !important; font-size:24px !important; margin-left:0px !important;"><?php echo$model->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '. $model->embarcacaoModelos->titulo; ?></h1>
					<span class="subtitle-emb-deemb">
							<?php
								// exibe titulo, caso tenha e esteja pago
								if($flgTitulo) {
									echo '<b>'.$model->titulo.'</b>';
								}
							?>
					</span>
				</div>	
				<div class="quadro-l1-deemb4">
					 <a class="botao-deemb-1" href="<?php echo Yii::app()->createUrl('comparador/comparar', array('id_embarcacao'=>$model->id));?>" id="botao-deemb1" style="display:inline !important;">Comparar</a>
					 <a class="botao-deemb-2" id="compartilhar" target="_blank"><!-- <i class="ico-face"></i> -->Compartilhar no Facebook</a>
					 <a class="botao-deemb-3 add-favoritos" id="add-favoritos">Adicionar aos Favoritos</a>
					 <i class="icone-favorito-detemba"></i>
				</div>
				<div class="quadro-l1-deemb5">
					<div class="box-video">

					</div>
					<a href="#">
						
						<?php
							$imagem = Yii::app()->request->baseUrl.'/img/sem_foto_bb.jpg'; 
							if(count($model->embarcacaoImagens) > 0) {
								$imagem = Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[0]->imagem;
							}
							echo '<img class="bg-img-slide-deemb" src="'.$imagem.'">';
						?>
					</a>
				</div>	
				<div class="quadro-l1-deemb6" >
					<?php
						if($model->valor != '') {
							echo '<div class="quadro-l1-deemb6b "style ="border-top: 0px;">
							<div class="div-info-quadros-view3">
								<icon class="icon1-deemb "></i>
									<span class="text-fixo-deemb">Preço:</span>
									</div>
									<div class="div-info-quadros-view4">
									<span class="text-dnmc-deemb1">';
										if($model->valor == 0.00 || $model->valor == "") {
											echo 'Não informado';
										}
										else {
											echo 'R$ '.Utils::formataValorView((float)$model->valor);
										}
								echo '</span>
								</div>
							</div>';
						}
					?>
					
					<?php
						if($model->embarcacaoModelos->embarcacaoTipos->titulo != "") {
							echo '<div class="quadro-l1-deemb6b" >
							<div class="div-info-quadros-view3">
								<icon class="icon2-deemb "></i>
								<span class="text-fixo-deemb">Tipo:</span>
								</div>
								<div class="div-info-quadros-view3">
								<span class="text-dnmc-deemb1">';
									echo $model->embarcacaoModelos->embarcacaoTipos->titulo;
								echo '</span>
								</div>
						</div>';
						}
					?>

					<?php
						if($model->estado != "") {
							echo '<div class="quadro-l1-deemb6b">
							<div class="div-info-quadros-view3">
							<icon class="icon3-deemb "></i>
								<span class="text-fixo-deemb">Estado:</span>
								</div>
								<div class="div-info-quadros-view4">
								<span class="text-dnmc-deemb1">';
									//echo $model->estado = ('U') ? 'Usado' : 'Novo';
									echo $novoOuUsado;
								echo '</span>
								</div>
							</div>';
						}
					?>

					<?php

						if($model->ano != null) {
							echo '<div class="quadro-l1-deemb6b">
							<div class="div-info-quadros-view4" style="width:190px">
								<icon class="icon4-deemb"></i>
									<span class="text-fixo-deemb" style="width:200px">Ano de Fabricação:</span>
									</div>
									<div class="div-info-quadros-view3">
									<span class="text-dnmc-deemb1">';
										if($model->ano == 0) {
											echo 'Não informado';
										}
										else {
											echo $model->ano;
										}
									echo '</span>
									</div>
							</div>';
						}
					?>
					
					<?php
						// jetski n tem esse campo
						if($model->embarcacaoModelos->tamanho != null && $model->embarcacao_macros_id != 1) {
							echo '<div class="quadro-l1-deemb6b">
							<div class="div-info-quadros-view3">
								<icon class="icon5-deemb "  style="margin-top: 5px !important;"></i>
									<span class="text-fixo-deemb" style="margin-top: -5px;">Tamanho:</span>
									</div>
									<div class="div-info-quadros-view4">
									<span class="text-dnmc-deemb1">';
										if($model->embarcacaoModelos->tamanho == 0.00) {
											echo 'Não informado';
										}
										else {
											echo number_format($model->embarcacaoModelos->tamanho, 0, '.', ''). ' pés';
										}
									echo '</span>
									</div>
							</div>';
						}
					?>

					<?php
						if($model->embarcacao_macros_id != 1 && $model->embarcacaoModelos->passageiros > 0 && $model->embarcacaoModelos->acomodacoes > 0) {
							echo '<div class="quadro-l1-deemb6b">
							<div class="div-info-quadros-view3" style="margin-right:10px">
								<icon class="icon6-deemb "></i>
								<span class="text-fixo-deemb">Tripulação:</span>
								</div>
								<div class="div-info-quadros-view3">
									<span class="text-dnmc-deemb1">'; echo 'Pass Dia: '.$model->embarcacaoModelos->passageiros. ' / Pass Noite: '.$model->embarcacaoModelos->acomodacoes.'</span>';
							echo '</div>';
							echo '</div>';
						}
						
					?>
					
					
					<?php
						if($model->estados != null) {
							echo '<div class="quadro-l1-deemb6b">
								<icon class="icon7-deemb "></i>
									<span class="text-fixo-deemb">Local:</span>
									<span class="text-dnmc-deemb7">';
										echo $model->estados->uf;
									echo '</span>
							</div>';
						}
					?>
					
				</div>	
				<div class="quadro-l1-deemb7">
					<div id="div-deemb1">	
						<?php if (count($model->embarcacaoImagens) > 5 ) { ?>
							<ul class="slide-deemb">
								<?php
									for($i = 0; $i < count($model->embarcacaoImagens); $i++) {

										if($flgVideo && $i == 0) {
											echo '<li class="category-deemb">';
												echo '<a href="#" class="">';
												echo '<div class="lazyYT-button" data-video="'. $model->video .'"></div>';
												echo '</a>';
											echo '</li>';
										}

										echo '<li class="category-deemb">';
											echo '<a href="#" class="img-thumbnail-emb">';
												echo '<img class="img-deemb-slide" src="'.Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem.'"/>';
											echo '</a>';
										echo '</li>';
									}
								?>	
							</ul>
						<?php } else { ?>
							<ul class="slide-deemb2">
								<?php
									for($i = 0; $i < count($model->embarcacaoImagens); $i++) {

										if($flgVideo && $i == 0) {
											echo '<li class="category-deemb">';
												echo '<a href="#" class="">';
												echo '<div class="lazyYT-button" data-video="'. $model->video .'"></div>';
												echo '</a>';
											echo '</li>';
										}

										echo '<li class="category-deemb">';
											echo '<a href="#" class="img-thumbnail-emb">';
												echo '<img class="img-deemb-slide" src="'.Yii::app()->request->baseUrl.'/public/embarcacoes/'.$model->embarcacaoImagens[$i]->imagem.'"/>';
											echo '</a>';
										echo '</li>';
									}
								?>	
							</ul>
						<?php } ?>
					</div>	

				</div>
				<div class="quadro-l1-deemb8">
					<a class="botao-deemb-contato" id="btn-contato-detemba" onclick="_gaq.push(['_trackEvent', 'detalhe-emb', 'click', 'ENTRE EM CONTATO']);">ENTRE EM CONTATO</a>
					<icon class="icon8-deemb"></icon>
				</div>	
			</div>	
		</div>
	</div>
	<div class="line-deemb2">
		<div class="container">
			<div class="box-deemb2">


				<?php
					// motores
					if($model->embarcacao_macros_id != Anuncio::$_categoria_embarcacao['JETSKI']) {

						if(count($model->motores) > 0) {

							echo '<div class="quadro-l2-deemb1">
								<div class="div-title-bloco-l2-deemb">
									<h2 class="title-l2-bloco-deemb">Motorização</h2>
								</div>
								<div class="div-text-bloco-l2-deemb">
									<span class="text-l2-bloco-deemb">';


										echo 'Quantidade de motores: '.count($model->motores).'x ';
										echo '<br/><br/>';
										$motor = $model->motores[0];
										echo 'Modelo: '.$motor->motorModelos->titulo;
										echo ' / ';
										echo 'Potência: '.number_format($motor->motorModelos->potencia, 0, '.', '') . ' HP';



										echo ' / ';
										echo 'Tipo: '.$motor->motorModelos->motorTipos->titulo;
										echo ' / ';
										echo 'Fabricante: '. $motor->motorModelos->motorFabricantes->titulo;
										echo ' / ';
										echo 'Horas de uso: '.$motor->horas.'h';

									echo '</span>
								</div>
							</div>';
						}

						else {
								echo '<div class="quadro-l2-deemb1">
								<div class="div-title-bloco-l2-deemb">
									<h2 class="title-l2-bloco-deemb">Motorização</h2>
								</div>
								<div class="div-text-bloco-l2-deemb">
									<span class="text-l2-bloco-deemb">';
										echo 'Não foi informado o motor ou não possui.';
									echo '</span>
								</div>
							</div>';
						}
					}

					// jetski
					else {
						if($model->embarcacaoModelos->motor_de_fabrica != null) {

							echo '<div class="quadro-l2-deemb1">
								<div class="div-title-bloco-l2-deemb">
									<h2 class="title-l2-bloco-deemb">Motorização</h2>
								</div>
								<div class="div-text-bloco-l2-deemb">
									<span class="text-l2-bloco-deemb">';
										echo $model->embarcacaoModelos->motor_de_fabrica;
									echo '</span>
								</div>
							</div>';
						}
						else {
							echo '<div class="quadro-l2-deemb1">
								<div class="div-title-bloco-l2-deemb">
									<h2 class="title-l2-bloco-deemb">Motorização</h2>
								</div>
								<div class="div-text-bloco-l2-deemb">
									<span class="text-l2-bloco-deemb">';
										echo 'Não foi informado o motor do jetski';
									echo '</span>
								</div>
							</div>';
						}
					}
				?>


				
				<div id="acessorios-emb">

						<?php

							// acessórios e equipamentos
							if(count($model->embarcacaoAcessorioses) > 0) {

								$flgAchouAcessorio = false;

								foreach($model->embarcacaoAcessorioses as $acessorio) {
					                if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {			                        	
					                   $flgAchouAcessorio = true;
					                   break;
					                } 
					            }

					            if($flgAchouAcessorio) {

					            	echo '<div class="quadro-l2-deemb1">
										<div class="div-title-bloco-l2-deemb">
											<h2 class="title-l2-bloco-deemb">Acessórios e Equipamentos</h2>
										</div>
										<div class="div-text-bloco-l2-deemb">';
										
											echo '<span class="text-l2-bloco-deemb">';

											foreach($model->embarcacaoAcessorioses as $acessorio) {
						                        if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ACESSORIOS']) {			                        	
						                            $array_acessorios[] = $acessorio->acessorios->titulo;
						                        } 
						                    }

						                    echo implode(' / ', $array_acessorios);
						                     
						                    echo '</span>';

									 	echo '</div>
									</div>';
					            }
							}

						?>
						
				
					<?php

							// acessórios e equipamentos
							if(count($model->embarcacaoAcessorioses) > 0) {

								$flgAchouAcessorio = false;

								foreach($model->embarcacaoAcessorioses as $acessorio) {
					                if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {			                        	
					                   $flgAchouAcessorio = true;
					                   break;
					                } 
					            }

					            if($flgAchouAcessorio) {

					            	echo '<div class="quadro-l2-deemb1">
										<div class="div-title-bloco-l2-deemb">
											<h2 class="title-l2-bloco-deemb">Comunicação e Navegação</h2>
										</div>
										<div class="div-text-bloco-l2-deemb">';
										
											echo '<span class="text-l2-bloco-deemb">';

											foreach($model->embarcacaoAcessorioses as $acessorio) {
						                        if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['COMUNICACAO_NAVEGACAO']) {			                        	
						                            $array_acessorios_equipamentos[] = $acessorio->acessorios->titulo;
						                        } 
						                    }

						                    echo implode(' / ', $array_acessorios_equipamentos);
						                     
						                    echo '</span>';

									 	echo '</div>
									</div>';
					            }
							}

						?>


					<?php

							// acessórios e equipamentos
							if(count($model->embarcacaoAcessorioses) > 0) {

								$flgAchouAcessorio = false;

								foreach($model->embarcacaoAcessorioses as $acessorio) {
					                if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {			                        	
					                   $flgAchouAcessorio = true;
					                   break;
					                } 
					            }

					            if($flgAchouAcessorio) {

					            	echo '<div class="quadro-l2-deemb1">
										<div class="div-title-bloco-l2-deemb">
											<h2 class="title-l2-bloco-deemb">Equipamentos Eletrônicos</h2>
										</div>
										<div class="div-text-bloco-l2-deemb">';
										
											echo '<span class="text-l2-bloco-deemb">';

											foreach($model->embarcacaoAcessorioses as $acessorio) {
						                        if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['ELETROELETRONICOS']) {			                        	
						                            $array_acessorios_eletronicos[] = $acessorio->acessorios->titulo;
						                        } 
						                    }

						                    echo implode(' / ', $array_acessorios_eletronicos);
						                     
						                    echo '</span>';

									 	echo '</div>
									</div>';
					            }
							}

						?>

					<?php

							// acessórios e equipamentos
							if(count($model->embarcacaoAcessorioses) > 0) {

								$flgAchouAcessorio = false;

								foreach($model->embarcacaoAcessorioses as $acessorio) {
					                if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_MESTRA']) {			                        	
					                   $flgAchouAcessorio = true;
					                   break;
					                } 
					            }

					            if($flgAchouAcessorio) {

					            	echo '<div class="quadro-l2-deemb1">
										<div class="div-title-bloco-l2-deemb">
											<h2 class="title-l2-bloco-deemb">Vela Mestra</h2>
										</div>
										<div class="div-text-bloco-l2-deemb">';
										
											echo '<span class="text-l2-bloco-deemb">';

											foreach($model->embarcacaoAcessorioses as $acessorio) {
						                        if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_MESTRA']) {			                        	
						                            $array_acessorios_vela_mestra[] = $acessorio->acessorios->titulo;
						                        } 
						                    }

						                    echo implode(' / ', $array_acessorios_vela_mestra);
						                     
						                    echo '</span>';

									 	echo '</div>
									</div>';
					            }
							}

						?>	

					<?php

							// acessórios e equipamentos
							if(count($model->embarcacaoAcessorioses) > 0) {

								$flgAchouAcessorio = false;

								foreach($model->embarcacaoAcessorioses as $acessorio) {
					                if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_GENOA']) {			                        	
					                   $flgAchouAcessorio = true;
					                   break;
					                } 
					            }

					            if($flgAchouAcessorio) {

					            	echo '<div class="quadro-l2-deemb1">
										<div class="div-title-bloco-l2-deemb">
											<h2 class="title-l2-bloco-deemb">Vela Genoa</h2>
										</div>
										<div class="div-text-bloco-l2-deemb">';
										
											echo '<span class="text-l2-bloco-deemb">';

											foreach($model->embarcacaoAcessorioses as $acessorio) {
						                        if($acessorio->acessorios->acessorio_tipos_id == Anuncio::$_tipos_acessorio['VELA_GENOA']) {			                        	
						                            $array_acessorios_vela_genoa[] = $acessorio->acessorios->titulo;
						                        } 
						                    }

						                    echo implode(' / ', $array_acessorios_vela_genoa);
						                     
						                    echo '</span>';

									 	echo '</div>
									</div>';
					            }
							}

						?>

				</div>

			</div>	
		</div>
	</div>
	<div class="line-deemb3">
		<div class="container">
			<div class="box-deemb3">

				<?php

					if($model->descricao != "") {

						echo '<div class="quadro-l3-deemb1">
							<div class="div-title-bloco-l3-deemb">
								<h2 class="title-l3-bloco-deemb">Descrição da embarcação</h2>
								<div class="div-text-bloco-l3-deemb">
								<span class="text-l3-bloco-deemb">';
								
									echo $model->descricao;

									echo '</span>
								</div>
							</div>
						</div>';

					}
				?>

				

				<div class="quadro-l3-deemb2">
					
					<?php if($logo != null):?>
					<div class="quadro-l3-deemb2b">
						
						<a href="#">
							<img class="bg-img-l3-deemb" src="<?php echo $logo;?>">
						</a>
						
					</div>
					<?php endif;?>
			

					<div class="quadro-l3-deemb2c">
						<div class="div-textos-l3-deemb">
							<div class="div-title-bloco2-l3-deemb">
								<span class="title-l3-bloco2-deemb">Sobre o anunciante</span>
							</div>
							<div class="div-text-bloco2-l2-deemb">
								<span class="text-l3-bloco3-deemb">
									<b><?php echo $nomeEmpresa; ?></b>
								</span>
							</div>
							<div class="div-text-end-bloco2-l3-deemb">
								<span class="text-l3-bloco3-deemb tel-add"><a href="#" class="link-view-tel" data-tel="<?php echo $telefone; ?>" onclick="_gaq.push(['_trackEvent', 'detalhe-emb', 'click', 'Telefone']);">Ver telefone</a></span>
							</div>
							<div class="div-text-end-bloco2-l3-deemb">
								<span class="text-l3-bloco3-deemb"><?php echo 'UF: '. $estado; ?></span>
							</div>
							<div class="div-text-end-bloco2-l3-deemb">
								<span class="text-l3-bloco3-deemb"><?php echo 'Cidade: '.$cidade;?></span>
							</div>
							<div class="div-text-end-bloco2-l3-deemb">
								<span class="text-l3-bloco3-deemb"></span>
							</div>
						</div>		
					</div>
					<div class="quadro-l3-deemb2d">
						<a class="botao-deemb-4" id="btn-contato2-detemba" onclick="_gaq.push(['_trackEvent', 'detalhe-emb', 'click', 'CONTATO']);">Contato</a>
					</div>
				</div>	
				<div class="quadro-l3-deemb3">
					<div class="quadro-l3-deemb3b">
						<a href="#">
							<img class="bg-img-l3-deemb" src="<?php echo $logo;?>">
						</a>
					</div>	
					<div class="quadro-l3-deemb3c">
						<div class="div-title-bloco3-l3-deemb">
							<span class="title-l3-bloco2-deemb">Procurando uma seguradora?</span>
						</div>	
					</div>
					<div class="quadro-l3-deemb3d">
						<a class="botao-deemb-4" id="btn-seguro-detemba">Opcções de Seguro</a>
					</div>
				</div>	
				<div class="quadro-l3-deemb3">
					<div class="quadro-l3-deemb3b">
						<a href="#">
							<img class="bg-img-l3-deemb" src="<?php echo $logo;?>">
						</a>
					</div>	
					<div class="quadro-l3-deemb3c">
						<div class="div-title-bloco3-l3-deemb">
							<span class="title-l3-bloco2-deemb">Pensando em financiar?</span>
						</div>	
					</div>
					<div class="quadro-l3-deemb3d">
						<a class="botao-deemb-4" id="btn-financ-detemba">Financiamento</a>
					</div>
				</div>	
				<div class="quadro-l3-deemb4">
						<section style="text-align:center;" class="advertise-deemb">
							<?php 
								echo Banners::loadBanner(Banners::LATERAL, $model->embarcacao_macros_id, array('width'=>200, 'height'=>446), true);
							?>
						</section>
				</div>	
			</div>	
		</div>
		<br class="clear" />
	</div>

	<!-- mais deste anunciante -->
	<?php
		if(count($embarcacoes) > 0) {
			$this->renderPartial('_embarcacoes_anunciante', array('embarcacoes'=>$embarcacoes));
		}
	?>

	<!--Lboxs da Pagina-->
		<div class="lbox-msgenviada" id="lbox-msgok">	
			<div class="texts-lbox-ag">	
				<div class="div-title-form-msgok">
					<span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
				</div>
			</div>	
				<input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
		</div>



				<div class="lbox-ag" id="lbox-detemba">	
					<div class="texts-lbox-ag">	
						<div class="title-lbox-menor-div">
							<span class="ev-titleb">Envie uma mensagem para o vendedor desta embarcação</br></span>
							<span id="erro-contato" style="color:red;"></span>
						</div>

					</div>

						<div id="erro-contato-anunciante" class="div-sucess-lbox">
				</div>	
			
				<div class="form-nome-ag">
					<?php if(!Yii::app()->user->isGuest):?>
						<input placeholder="Seu nome"id="nome-contato-anunciante" value="<?php echo Usuarios::getUsuarioLogado()->nome;?>" class="terms-ag-1" type="text">
					<?php else:?>
						<input placeholder="Seu nome"id="nome-contato-anunciante" class="terms-ag-1" type="text">
					<?php endif;?>
				</div>
				<div class="form-nome-ag-2">
					<?php if(!Yii::app()->user->isGuest):?>
						<input placeholder="Seu e-mail" value="<?php echo Usuarios::getUsuarioLogado()->email;?>" id="email-contato-anunciante" class="terms-ag-2" type="text">
					<?php else:?>
						<input placeholder="Seu e-mail" id="email-contato-anunciante" class="terms-ag-2" type="text">
					<?php endif;?>
					
				</div>
				<div class="form-nome-ag-3">
					<?php if(!Yii::app()->user->isGuest):?>
						<input placeholder="Telefone" value="<?php Usuarios::getUsuarioLogado()->celular;?>" id="telefone-contato-anunciante" class="terms-ag-3" type="text">
					<?php else:?>
						<input placeholder="Telefone" id="telefone-contato-anunciante" class="terms-ag-3" type="text">
					<?php endif;?>
				</div>
				<div class="form-nome-ag-4">
					
					<textarea style="height:130px; width:365px;" id="mensagem-contato-anunciante" class="terms-ag-4" placeholder="Mensagem"></textarea>
				</div>
					 <input type="button" onclick="_gaq.push(['_trackEvent', 'Lightbox-form', 'click', 'Enviar Mensagem']);ads_conversor('pl26CITUvFgQkLPC4wM');" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-contato-anunciante" value="ENVIAR MENSAGEM">
					 <input type="button" id="close-form-contato" class="fechar-form-b close" value="X">
		
			</div>

		<div class="lbox-ag" id="lbox-detemba2">	
						<div class="texts-lbox-ag">	
						<span class="ev-titlec">Envie uma mensagem para</br></span>
						<span class="ev-title2c">pedir uma cotação</span>
					</div>
			<form>
				<div class="form-nome-ag">
					<input placeholder="Seu nome"id="form-1-ag-lb" class="terms-ag-1" type="text">
				</div>
				<div class="form-nome-ag-2">
					<input placeholder="Seu telefone" class="terms-ag-2" type="text">
				</div>
				<div class="form-nome-ag-3">
					<input placeholder="Seu e-mail" class="terms-ag-3" type="text">
				</div>
				<div class="box-title-detemba">
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Valor: <b> R$ 100.000,00 </span>
					</div>
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Ano: <b> 1992 </span>
					</div>
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Marca: <b> Não especificada</span>
					</div>
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Modelo: <b> Não especificado</span>
					</div>
				</div>	

					 <input type="submit" name="botao-cadastrar-form" class="botao-cadastrar-form" value="ENVIAR PEDIDO">
					 <input type="button" id="close" class="fechar-form close" value="X" style="margin-top:5px">
			</form>
		</div>

		<div class="lbox-ag" id="lbox-detemba3">	
					<div class="texts-lbox-ag">	
						<span class="ev-titlec">Envie uma mensagem para</br></span>
						<span class="ev-title2c">pedir uma cotação</span>
					</div>
			<form>
				<div class="form-nome-ag">
					<input placeholder="Seu nome"id="form-1-ag-lb" class="terms-ag-1" type="text">
				</div>
				<div class="form-nome-ag-2">
					<input placeholder="Seu telefone" class="terms-ag-2" type="text">
				</div>
				<div class="form-nome-ag-3">
					<input placeholder="Seu e-mail" class="terms-ag-3" type="text">
				</div>
				<div class="box-title-detemba">
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Valor: <b> R$ 100.000,00 </span>
					</div>
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Ano: <b> 1992 </span>
					</div>
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Marca: <b> Não especificada</span>
					</div>
					<div class="div-title-detemba">
						<span class="title-lb-detemba">Modelo: <b> Não especificado</span>
					</div>
				</div>	

					 <input type="submit" name="botao-cadastrar-form" class="botao-cadastrar-form" value="ENVIAR PEDIDO">
					 <input type="button" id="close" class="fechar-form close" value="X" style="margin-top:5px">
			</form>
		</div>
	<!---->				

</section>

<!-- campos hidden -->

<!-- contem o id da embarcação -->
<input type="hidden" id="id_embarcacao" value="<?php echo $model->id;?>"/>

<!-- contem a flag que indica se o usuario ja favoritou a embarcação -->
<?php
	if($flgJaFavoritou) {
		// ja favoritou, gerar campo hidden com value 1
		echo CHtml::hiddenField('flgFavoritou', '1', array('id'=>'flgFavoritou'));
	}
	else {
		echo CHtml::hiddenField('flgFavoritou', '0', array('id'=>'flgFavoritou'));
	}

	// id do usuario dono da embarcação
	echo CHtml::hiddenField('idUsuarioDonoEmbarc', $idUsuarioDonoEmbarc, array('id'=>'idUsuarioDonoEmbarc'));

	// id da embarcação
	echo CHtml::hiddenField('idEmbarcacao', $model->id, array('id'=>'idEmbarcacao'));	

	// email da embarcação
	echo CHtml::hiddenField('emailEmbarcacao', $model->email, array('id'=>'emailEmbarcacao'));

	// indica se há usuario logado ou não
	// 0 => não está logado
	// 1 => está logado
	if(!Yii::app()->user->isGuest) {
		echo CHtml::hiddenField('isGuest', 1, array('id'=>'isGuest'));		
	}
	else {
		echo CHtml::hiddenField('isGuest', 0, array('id'=>'isGuest'));			
	}

	// form de contato (campo que indica se é uma resposta ao anunciante ou nao (aqui no caso nao é, valor zero então))
	echo CHtml::hiddenField('resposta', 0, array('id'=>'resposta'));

?>

