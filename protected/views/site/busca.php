<?php
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/_busca.js?'.microtime(), CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/embarcacoes_busca.js?'.microtime(), CClientScript::POS_END);

	// verificar se n tem resultado 
	// o campo hidden ´e usado em embarcacoes_busca.js para alterar css q esta qebrando qndo n tem nenhum resultado
	if( count($lanchas) == 0 && count($jetskis) == 0 && count($veleiros) == 0 && count($pesca) == 0 && count($empresas) == 0 && count($estaleiros) == 0 && count($blog) == 0 && count($noticias) == 0 && count($primeiro_barco) == 0 ) {

		$flgSemResultado = true;
		echo "<input type='hidden' value='1' id='semresultado'/>";
	}
	else {
		echo "<input type='hidden' value='0' id='semresultado'/>";
		$flgSemResultado = false;
	}

	$embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); 
	$empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']);
	
	// se n tiver anuncio em destaque, arruma o css pelo js
	if(count($embarcacoes_destaque) == 0 && count($empresas_relacionadas) == 0) {
		echo "<input type='hidden' value='1' id='semdestaque'/>";
	}
	else {
		echo "<input type='hidden' value='0' id='semdestaque'/>";
	}



?>


<?php if(isset($busca) && $busca != null): ?>
	<title>Busca | <?php echo $busca; ?></title>
<?php else: ?>
	<title>Bombarco | Busca; ?></title>
<?php endif; ?>
<section class="content">

	<div class="line-resbus-1">
		<div class="container">

			<?php if (isset($breadCrumbs)): ?>
				<span class="title-resbus-top "><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
				<span class="title-resbus-procura"> Você procurou por:</span>
				<span class="title-resbus-principal">"<?php echo $busca; ?>"</span>
			<?php endif; ?>
			
			<?php echo CHtml::form(array('/site/busca'), 'get', array('id'=>'form-search')); ?>
			<div class="search-nt">
				<input name="busca" id="txt-busca" placeholder="Digite algo que você procura" class="terms-nt" type="text" value="<?php echo $busca; ?>">
				<input class="find-nt" type="submit">
			</div>
			<?php echo CHtml::endForm(); ?>
		</div>
	</div>

	<div class="line-resbus-2" id="wrap-container">
		<div class="container">

			<!--Blocos Laterais #1-->
			
            	<?php if($flgSemResultado == true): ?>
	            	<div class="resultados-box">
	                    <span class='resultados-title'>Nenhum resultado encontrado.</span>
	                    <span class="resultados-tip">Faça uma nova busca ou navegue nas categorias abaixo.</span>
	                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda');?>" class="resultados-categorias resultados-tip-lancha">Lanchas</a>
	                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda');?>" class="resultados-categorias resultados-tip-veleiro">Veleiros</a>
	                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda');?>" class="resultados-categorias resultados-tip-jet-skis">Jet Skis</a>
	                    <a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda');?>" class="resultados-categorias resultados-tip-pesca">Pesca</a>
	                </div>
            	<?php endif; ?>

				<?php if(count($embarcacoes_destaque) > 0): ?>
					<div class="box-cinza-lateral-bb">

						<div class="bloco-tabela-1">
							<div class="div-title-lateral-anuncios">
								<span class="title-lateral-anuncios">Anúncios Patrocinados</span>
							</div>
			 		 		<div class="title-lat-tabela-div">
			 					<span class="title-lat-tabela">
			 						Classificados
			 					 </span>
			 				</div>
			 				<div class="box-tabela-lat-tab">
			 					<?php $i = 0;?>
				 				<?php foreach ($embarcacoes_destaque as $key => $value): ?>

				 					<?php if($i != 0) : echo "<br/>"; ?>
				 					<?php endif; ?>

				 					<?php $i++; ?>

				 					<ul class="categories-tabela-lat">
					 					<li class="category-tabela–lat">
					 						<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-tabela-lat'), true); ?>
										</li>
										<?php
											// se tiver destaque poe a classe com o selo de destaque
											if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
												echo '<i class="faixa-destaque-emba"></i>';

											$titulo = "";
			                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
			                                    $titulo = "<b> - " .$value->titulo."</b>";
			                                }
					 					?>
									</ul>
									<div class="textos-lat-tab">
										<span class="text-list-lat-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' .$value->embarcacaoModelos->titulo.$titulo; ?> </span>
										<span class="text-list-tab-ano"> Ano: </span>
										<span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span><br>
										<span class="text-list-tab-price"><?php echo ($value->valor > 0?"R$ " . number_format($value->valor, 2, ',', '.'):" R$ não informado"); ?></span><br/><br/>
										<div  style="cursor:pointer;" class="balao_contato" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>">
		                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
		                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                	</div>


									</div>

				 				<?php endforeach ?>

			 				</div>
						</div>
				<?php endif; ?>

				<?php if(count($empresas_relacionadas) > 0): ?>
					<div class="bloco-tabela-2">
		 		 		<div class="title-lat-tabela-div2">
		 					<span class="title-lat-tabela2"> Guia de Empresas </span>
		 				</div>
		 				<div class="box-tabela-lat-tab2">

		 					<?php foreach ($empresas_relacionadas as $key => $value): ?>

			 					<ul class="categories-tabela-lat2">
				 					<li class="category-tabela–lat2">
				 						<?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-tabela-lat2')); ?>
									</li>
								</ul>
								<div class="textos-lat-tab2">
									<span class="text-list-lat-title"> <?php echo $value->nomefantasia; ?> </span>
									<span class="text-list-tab-ano2"> Localizacão: </span>
									<span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>
								</div>

		 					<?php endforeach ?>

		 				</div>
		 				<div class="div-voltar-ao-topo-list">
							<a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>
						</div>

					</div>
				<?php endif; ?>
		 		</div>
			<!-- Inicio do conteudo abaixo do resultado-->
			<div class="content-left" id="resultados">


			<?php if (count($lanchas) > 0): ?>

				<div class="box-l2-resbus-1">
					<div class="div-title-l2-resbus">
						<span class="title-l2-resbus"> Lanchas </span>
					</div>
	 				<ul class="categories-resbus">
	 					<?php foreach ($lanchas as $key => $value): ?>
 							<li class="category-resbus">
 								<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
 								<?php
									// se tiver destaque poe a classe com o selo de destaque
									if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
										echo '<i style="left:-20px !important;" class="faixa-destaque-emba"></i>';

			                        $titulo = "";
	                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
	                                    $titulo = "<b> - " .$value->titulo."</b>";
	                                }    
			 					?>
								<div class="textos-resbus">
									<span class="text-resbus-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo.$titulo; ?> </span>
									<span class="text-resbus-ano"> Ano: </span>
									<span class="text-resbus-estado"> Estado: </span>
									<span class="text-resbus-price" style="font-size:15px !important;"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?>
									</span>
									<div  style="cursor:pointer;" class="balao_contato2" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>">
	                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
	                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                </div>
									<span class="text-resbus-ano-rnd"> <?php echo $value->ano; ?> </span>
									<span class="text-resbus-estado-rnd"> <?php echo $value->estados->uf; ?> </span>
								</div>
							</li>
	 					<?php endforeach ?>
					</ul>
					<?php if (count($lanchas) > 1): ?>
						<div class="btn-resbus-div">
				 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('buscando'=>$busca, 'macro'=>Anuncio::$_categoria_embarcacao['LANCHA'])); ?>" class="botao-resbus" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

							<?php if (count($zeromilhas) > 0): ?>

				<div class="box-l2-resbus-1">
					<div class="div-title-l2-resbus">
						<span class="title-l2-resbus"> Zeromilhas </span>
					</div>
	 				<ul class="categories-resbus">
	 					<?php foreach ($zeromilhas as $key => $value): ?>
 							<li class="category-resbus">
 								<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
 								<?php
									// se tiver destaque poe a classe com o selo de destaque
									if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
										echo '<i style="left:-20px !important;" class="faixa-destaque-emba"></i>';

			                        $titulo = "";
	                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
	                                    $titulo = "<b> - " .$value->titulo."</b>";
	                                }    
			 					?>
								<div class="textos-resbus">
									<span class="text-resbus-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo.$titulo; ?> </span>
									<!--<span class="text-resbus-ano"> Ano: </span>-->
									<!--<span class="text-resbus-estado"> Estado: </span>-->
									<span class="text-resbus-price" style="font-size:15px !important;"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?>
									</span>
									<div  style="cursor:pointer;" class="balao_contato2" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>">
	                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
	                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                </div>
									<!--<span class="text-resbus-ano-rnd"> <?php //echo $value->ano; ?> </span>-->
									<!--<span class="text-resbus-estado-rnd"> <?php //echo $value->estados->uf; ?> </span>-->
								</div>
							</li>
	 					<?php endforeach ?>
					</ul>
					<?php if (count($zeromilhas) > 1): ?>
						<div class="btn-resbus-div">
				 			<a href="<?php echo Yii::app()->createUrl('catalogo/fibrafort'); ?>" class="botao-resbus" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (@count($veleiros) > 0): ?>

				<div class="box-l2-resbus-1">
					<div class="div-title-l2-resbus">
						<span class="title-l2-resbus"> Veleiros </span>
					</div>
	 				<ul class="categories-resbus">
	 					<?php foreach ($veleiros as $key => $value): ?>
 							<li class="category-resbus">
 								<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
 								<?php
									// se tiver destaque poe a classe com o selo de destaque
									if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
										echo '<i style="left:-20px !important;" class="faixa-destaque-emba"></i>';

			                        $titulo = "";
	                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
	                                    $titulo = "<b> - " .$value->titulo."</b>";
	                                }    
			 					?>
								<div class="textos-resbus">
									<span class="text-resbus-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo.$titulo; ?> </span>
									<span class="text-resbus-ano"> Ano: </span>
									<span class="text-resbus-estado"> Estado: </span>
									<span class="text-resbus-price" style="font-size:15px !important;"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?>
									</span>
									<div  style="cursor:pointer;" class="balao_contato2" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>">
	                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
	                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                </div>
									<span class="text-resbus-ano-rnd"> <?php echo $value->ano; ?> </span>
									<span class="text-resbus-estado-rnd"> <?php echo $value->estados->uf; ?> </span>
								</div>
							</li>
	 					<?php endforeach ?>
					</ul>

					<?php if(@count($velerios) > 1): ?>
						<div class="btn-resbus-div">
				 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('macro'=>Anuncio::$_categoria_embarcacao['VELEIRO'])); ?>" class="botao-resbus" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (count($jetskis) > 0): ?>

				<div class="box-l2-resbus-1">
					<div class="div-title-l2-resbus">
						<span class="title-l2-resbus"> Jetskis </span>
					</div>
	 				<ul class="categories-resbus">
	 					<?php foreach ($jetskis as $key => $value): ?>
 							<li class="category-resbus">
 								<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
 								<?php
									// se tiver destaque poe a classe com o selo de destaque
									if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
										echo '<i style="left:-20px !important;" class="faixa-destaque-emba"></i>';

			                        $titulo = "";
	                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
	                                    $titulo = "<b> - " .$value->titulo."</b>";
	                                }    
			 					?>
								<div class="textos-resbus">
									<span class="text-resbus-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo.$titulo; ?> </span>
									<span class="text-resbus-ano"> Ano: </span>
									<span class="text-resbus-estado"> Estado: </span>
									<span class="text-resbus-price" style="font-size:15px !important;"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?>
									</span>
									<div  style="cursor:pointer;" class="balao_contato2" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>">
	                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
	                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                </div>
									<span class="text-resbus-ano-rnd"> <?php echo $value->ano; ?> </span>
									<span class="text-resbus-estado-rnd"> <?php echo $value->estados->uf; ?> </span>
								</div>
							</li>
	 					<?php endforeach ?>
					</ul>
					<?php if (count($jetskis) > 1): ?>
						<div class="btn-resbus-div">
				 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('macro'=>Anuncio::$_categoria_embarcacao['JETSKI'])); ?>" class="botao-resbus" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (count($pesca) > 0): ?>

				<div class="box-l2-resbus-1">
					<div class="div-title-l2-resbus">
						<span class="title-l2-resbus"> Barcos de Pesca </span>
					</div>
	 				<ul class="categories-resbus">
	 					<?php foreach ($pesca as $key => $value): ?>
 							<li class="category-resbus">
 								<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
 								<?php
									// se tiver destaque poe a classe com o selo de destaque
									if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
										echo '<i style="left:-20px !important;" class="faixa-destaque-emba"></i>';

			                        $titulo = "";
	                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
	                                    $titulo = "<b> - " .$value->titulo."</b>";
	                                }    
			 					?>
								<div class="textos-resbus">
									<span class="text-resbus-title"> <?php echo $value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo.$titulo; ?> </span>
									<span class="text-resbus-ano"> Ano: </span>
									<span class="text-resbus-estado"> Estado: </span>
									<span class="text-resbus-price" style="font-size:15px !important;"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?>
									</span>
									<div  style="cursor:pointer;" class="balao_contato2" data-email="<?php echo $value->email;?>" data-embarcid="<?php echo $value->id; ?>">
	                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php echo $value->email; ?>" data-embarcid="<?php echo $value->id;?>" src="<?php echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
	                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                </div>
									<span class="text-resbus-ano-rnd"> <?php echo $value->ano; ?> </span>
									<span class="text-resbus-estado-rnd"> <?php echo $value->estados->uf; ?> </span>
								</div>
							</li>
	 					<?php endforeach ?>
					</ul>
					<?php if (count($pesca) > 1): ?>
						<div class="btn-resbus-div">
				 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('buscando'=>$busca, 'macro'=>Anuncio::$_categoria_embarcacao['PESCA'])); ?>" class="botao-resbus" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (count($motores) > 0): ?>

				<div class="box-l2-resbus-1">
					<div class="div-title-l2-resbus">
						<span class="title-l2-resbus"> Motores </span>
					</div>
	 				<ul class="categories-resbus">
	 					<?php foreach ($motores as $key => $value): ?>
 							<li class="category-resbus">
 								<?php echo MotorAnuncio::getThumb($value, array('class'=>'bg-img-tabela'), true); ?>
 								<?php
 									$titulo = "";
									// se tiver destaque poe a classe com o selo de destaque
 									/*
									if(Embarcacoes::checkTurbo($value, 'destaque_busca'))
										echo '<i style="left:-20px !important;" class="faixa-destaque-emba"></i>';

			                        
	                                if(Embarcacoes::checkTurbo($value, "titulo") == true) {
	                                    $titulo = "<b> - " .$value->titulo."</b>";
	                                }*/    
			 					?>
								<div class="textos-resbus" style="top: -15px !important;">
									<span class="text-resbus-title" style="top: 30px !important;"> <?php echo MotorAnuncio::nomeAnuncio($value)." ".$titulo; ?> </span>
									<!--<span class="text-resbus-ano"> Potência: </span>
									<span class="text-resbus-estado"> Estado: </span>-->
									<span class="text-resbus-price" style="font-size:15px !important;"> <?php echo ($value->valor > 0?"R$ " . number_format($value -> valor, 2, ',', '.'):" R$ não informado"); ?>
									</span>
									<!--<div  style="cursor:pointer;" class="balao_contato2" data-email="<?php //echo $value->email;?>" data-embarcid="<?php //echo $value->id; ?>">
	                                    <img style="cursor:pointer; float:left;" class="balao" data-email="<?php //echo $value->email; ?>" data-embarcid="<?php //echo $value->id;?>" src="<?php //echo Yii::app()->createUrl('img/icon_chat.png'); ?>"/>
	                                    <span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>
	                                </div>-->
									<!--<span class="text-resbus-ano-rnd"> <?php //echo $value->potencia; ?> </span>-->
									<!--<span class="text-resbus-estado-rnd"> <?php //echo Embarcacoes::$_estado[$value->estado]; ?> </span>-->
								</div>
							</li>
	 					<?php endforeach ?>
					</ul>
					<?php if (count($motores) > 1): ?>
						<div class="btn-resbus-div">
				 			<a href="<?php echo Yii::app()->createUrl('motores?busca-texto='.$busca); ?>" class="botao-resbus" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php //if (count($estaleiros) > 0): ?>
				<!--<div class="box-l2-resbus-2">
					<div class="div-title-l2-resbus-box2">
						<span class="title-l2-resbus-box2"> Zeromilhas </span>
					</div>
					<ul class="categories-resbus-box2">
						<?php //foreach ($estaleiros as $key => $value): ?>
							<li class="category-resbus-box2">
								<a href="<?php //echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>">
									<a href="<?php //echo Yii::app()->createUrl('catalogo/'.$value->slug); ?>">
									<?php //if ($value->logo != null): ?>
										<img class="bg-img-resbus-box2" src="<?php //echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $value->logo; ?>"/>
									<?php //else: ?>
										<img class="bg-img-resbus-box2" src="<?php //echo Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';?>"/>
									<?php //endif ?>
									<span class="title-razao"><?php //echo $value->nomefantasia; ?></span>
								</a>
							</li>
						<?php //endforeach ?>
					</ul>
					<?php //if(count($estaleiros) > 1): ?>
					<div class="btn-resbus-div-box">
			 			<a href="<?php //echo Yii::app()->createUrl('estaleiros/busca/'.$busca); ?>" class="botao-resbus-box" id="btn-ver-todas-#">VER MAIS</a>
					</div>
					<?php //endif ?>
				</div>-->

			<?php //endif ?>


			<?php if (count($empresas) > 0): ?>

				<div class="box-l2-resbus-3">
					<div class="div-title-l2-resbus-box3">
						<span class="title-l2-resbus-box3"> Guia de Empresas</span>
					</div>
					<ul class="categories-resbus-box3">
						<?php foreach ($empresas as $key => $value):  ?>
							<li class="category-resbus-box3">
								<?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-resbus-box3')); ?>
							</li>						
						<?php endforeach ?>

					</ul>
					<?php if(count($empresas) > 1): ?>
						<div class="btn-resbus-div-box" style="top: 20px;">
				 			<a href="<?php echo Yii::app()->createUrl('guia-de-empresas/busca/'.$busca); ?>" class="botao-resbus-box" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (count($noticias) > 0): ?>

				<div class="box-l2-resbus-4">
					<div class="div-title-l2-resbus-box4">
						<span class="title-l2-resbus-box4"> Notícias </span>
					</div>
					<ul class="categories-pb" style="margin-top: 100px;
						display: inline-block;
						letter-spacing: normal;
						word-spacing: normal;
						vertical-align: top;
						text-rendering: auto;
						width: 100%;">

							<?php foreach ($noticias as $key => $value): ?>

								<li class="category-pb">
									<a href="<?php echo Conteudos::mountUrl($value, 'primeiro-barco'); ?>">
										<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-pb'), false); ?>
										<span class="blend"></span>
										<span class="table-pb">
											<span class="texts-pb">
												<span class="text-data"><?php echo $value->data; ?></span>
												<span class="text-tipo"><?php echo (isset($value->embarcacaoMacros)) ? $value->embarcacaoMacros->titulo : ''; ?></span>
												<h2 class="text-barco"><?php echo $value->titulo; ?></h2>
											</span>
										</span>
									</a>
								</li>

							<?php endforeach ?>

						</ul>
					<?php if(count($noticias) > 1): ?>
						<div class="btn-resbus-div-box2" style="top:-322px !important;">
				 			<a href="<?php echo Yii::app()->createUrl('comunidade/noticias/busca/'.$busca); ?>" class="botao-resbus-box" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (count($blog) > 0): ?>

				<div class="box-l2-resbus-4">
					<div class="div-title-l2-resbus-box4">
						<span class="title-l2-resbus-box4"> Blog </span>
					</div>
					<ul class="categories-pb" style="margin-top: 100px;
						display: inline-block;
						letter-spacing: normal;
						word-spacing: normal;
						vertical-align: top;
						text-rendering: auto;
						width: 100%;">

							<?php foreach ($blog as $key => $value): ?>

								<li class="category-pb">
									<a href="<?php echo Conteudos::mountUrl($value, 'primeiro-barco'); ?>">
										<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-pb'), false); ?>
										<span class="blend"></span>
										<span class="table-pb">
											<span class="texts-pb">
												<span class="text-data"><?php echo $value->data; ?></span>
												<span class="text-tipo"><?php echo (isset($value->embarcacaoMacros)) ? $value->embarcacaoMacros->titulo : ''; ?></span>
												<h2 class="text-barco"><?php echo $value->titulo; ?></h2>
											</span>
										</span>
									</a>
								</li>

							<?php endforeach ?>

						</ul>
					<?php if(count($blog) > 1): ?>
						<div class="btn-resbus-div-box2" style="top:-322px !important;">
				 			<a href="<?php echo Yii::app()->createUrl('comunidade/blog/busca/'.$busca); ?>" class="botao-resbus-box" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			<?php if (count($primeiro_barco) > 0): ?>

				<div class="box-l2-resbus-4">
					<div class="div-title-l2-resbus-box4">
						<span class="title-l2-resbus-box4"> Primeiro Barco </span>
					</div>
					<ul class="categories-pb" style="margin-top: 100px;
						display: inline-block;
						letter-spacing: normal;
						word-spacing: normal;
						vertical-align: top;
						text-rendering: auto;
						/*width: 100%;*/">

							<?php foreach ($primeiro_barco as $key => $value): ?>

								<li class="category-pb">
									<a href="<?php echo Conteudos::mountUrl($value, 'primeiro-barco'); ?>">
										<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-pb'), false); ?>
										<span class="blend"></span>
										<span class="table-pb">
											<span class="texts-pb">
												<span class="text-data"><?php echo $value->data; ?></span>
												<span class="text-tipo"><?php echo (isset($value->embarcacaoMacros)) ? $value->embarcacaoMacros->titulo : ''; ?></span>
												<h2 class="text-barco"><?php echo $value->titulo; ?></h2>
											</span>
										</span>
									</a>
								</li>

							<?php endforeach ?>

						</ul>
					<?php if (count($primeiro_barco) > 1): ?>
						<div class="btn-resbus-div-box2" style="top:-322px !important;">
				 			<a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco/busca/'.$busca); ?>" class="botao-resbus-box" id="btn-ver-todas-#">VER MAIS</a>
						</div>
					<?php endif ?>
				</div>

			<?php endif ?>

			</div>

		</div>
		<br class="clear">
		<div class="fundo-cinza-lateral"></div>
	</div>

</section>
	

	   <?php

        // cookies
         $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
         $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
         $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";

    ?> 

        <!-- Contato -->
    <div class="lbox-ag" id="lbox-detemba">
        <div class="texts-lbox-ag">
            <input type="button" id="close-form-contato" class="fechar-form close" value="X">
            <div>
                <span class="ev-titleb">Envie uma mensagem para o vendedor desta embarcação</br></span>
                <span id="erro-contato" style="color:red;"></span>
            </div>
        </div>

        <div id="erro-contato-anunciante" class="div-sucess-lbox"></div>

        <div class="form-nome-ag nome-contato-anunciante">
                <input placeholder="Seu nome*" id="nome-contato-anunciante" value="<?php echo $nome; ?>" class="terms-ag-1" type="text" required="required">
        </div>
        <div class="form-nome-ag email-contato-anunciante">

                <input placeholder="Seu e-mail*" value="<?php echo $email; ?>" id="email-contato-anunciante" class="terms-ag-1" type="text" required="required">
        </div>
        <div class="form-nome-ag telefone-contato-anunciante">
                <input placeholder="Telefone*" value="<?php echo $celular; ?>" id="telefone-contato-anunciante" class="terms-ag-1" type="tel">
        </div>
        <div class="form-nome-ag mensagem-contato-anunciante">
            <textarea style="height:100px; width:430px;" id="mensagem-contato-anunciante" class="terms-ag-1" placeholder="Mensagem*" required="required"></textarea>
        </div>
        <span class="sub-detail">Campos obrigatórios*</span>

        <div class="div-pergunta-partners">
            <!--<div style="margin-bottom: 3px;">Tenho interesse em:</div>-->
            <div style="margin-bottom: 10px; padding-left: 30px; font-weight: bold;">Consórcio <input type="checkbox" id="partner_cons" class="checkl1" value="1"></div>
            <div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Financiamento <input type="checkbox" id="partner_finan" class="checkl1" value="1"></div>
            <!--<div style="padding-left: 30px; margin-bottom: 10px; font-weight: bold;">Seguro <input type="checkbox" id="partner_seg" class="checkl1" value="1"></div>-->
        </div>

        <input type="text" name="j8BSVuvy" class="j8BSVuvy" value="" style="display:none !important;" />
        <input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-contato-anunciante" value="ENVIAR MENSAGEM" />
    </div>

        <!-- auxilia na hr de mandar a msg de contato -->
    <input type="hidden" id="idUsuarioDonoEmbarc"/>
    <input type="hidden" id="nome_destinatario"/>
    <input type="hidden" id="idEmbarcacao"/>
    <input type="hidden" id="emailEmbarcacao"/>
