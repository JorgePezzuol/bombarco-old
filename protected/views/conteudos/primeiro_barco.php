<?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/bootstrap-datepicker.js?11'); ?>
<section class="content">
		<div class="line-gray-pb-top">
				<div class="container">	
					<div>	
						<h1 class="title-pb-1">Primeiro Barco</h1>
						<span class="title-pb-2"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
					</div>	
						<div class="search-pb">
							<?php echo CHtml::form(array('site/urlconteudos'), 'get', array('id'=>'form-search')); ?>
								<input name="busca" placeholder="Buscar dentro de Primeiro Barco" class="terms-pb" type="text" value="<?php echo $array_params['busca']; ?>">
								<input type="hidden" value="primeiro-barco" name="url">
								<input class="find-pb" type="submit">
							<?php echo CHtml::endForm(); ?>					
						</div>
				</div>
		</div>	
		
		<div class="line-white-pb">	
			<div class="container" style="min-height: auto !important;">
				<div class="conteudo-box-pb">
					<div class="div-box-pb">

					    <?php if(count($primeiro_barco) == 0): ?>
	                        <div class="resultados-box">
	                            <span class='resultados-title'>Nenhum resultado encontrado.</span>
	                            <span class="resultados-tip">Faça uma nova busca ou navegue nas categorias abaixo.</span>
	                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda');?>" class="resultados-categorias resultados-tip-lancha">Lanchas</a>
	                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda');?>" class="resultados-categorias resultados-tip-veleiro">Veleiros</a>
	                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda');?>" class="resultados-categorias resultados-tip-jet-skis">Jet Skis</a>
	                            <a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda');?>" class="resultados-categorias resultados-tip-pesca">Pesca</a>
	                        </div>
	                    <?php endif; ?>

						<ul class="categories-pb">

							<?php foreach ($primeiro_barco as $key => $value): ?>

								<li class="category-pb">
									<a href="<?php echo Conteudos::mountUrl($value, 'primeiro-barco'); ?>">
										<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-pb'), false); ?>
										<span class="blend"></span>
										<span class="table-pb">
											<span class="texts-pb">
												<span class="text-data"><?php echo $value->data; ?></span>	
												<span class="text-tipo"><?php echo (isset($value->embarcacaoMacros) && $value->embarcacaoMacros->id != 0) ? $value->embarcacaoMacros->titulo : ''; ?></span>
												<h2 class="text-barco"><?php echo $value->titulo; ?></h2>	
											</span>		
										</span>
									</a>
								</li>
								
							<?php endforeach ?>

						</ul>
					</div>


					<?php if (count($primeiro_barco) == Conteudos::LIMIT_SEARCH): ?>
						<div class="div-botao-carregar-pb">
							<a class="botao-carregar-guia-pb" id="carregar_pb" data-limit="<?php echo Conteudos::LIMIT_SEARCH; ?>" data-busca="<?php echo $array_params['busca'] ?>">CARREGAR MAIS SOBRE O PRIMEIRO BARCO</a>	
						</div>		
					<?php endif ?>

					<div class="div-box-pb3" style="margin-left:-26px;">
						<section style="text-align:center;" class="advertise-guia-pb2">
								<div class="container" style="padding:20px;">
					<div class="advertise-home_banner">

						<?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>

					</div>		
				</div>	
						</section>
					</div>

				</div>	
				
				<div class="box-cinza-lateral-bb">

					<?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>

					<?php if(count($embarcacoes_destaque) > 0): ?>
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

			 				<?php foreach ($embarcacoes_destaque as $key => $value): ?>

			 					<ul class="categories-tabela-lat">
				 					<li class="category-tabela–lat">
				 						<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-tabela-lat'), true); ?>						
									</li>
								</ul> 	
								<div class="textos-lat-tab">
										<span class="text-list-lat-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
										<span class="text-list-tab-ano"> Ano: </span>
										<span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span><br>
										<span class="text-list-tab-price">
                                            <?php  
                                                if($value->valor > 0){
                                                    echo "R$ ". number_format($value -> valor, 2, ",", ".");
                                                }else{
                                                    echo "Não informado";
                                                }
                                            ?> </span>	
									</div>
			 					
			 				<?php endforeach ?>	

		 				</div>	
					</div>
					<?php endif; ?>

					<?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>

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
										<span class="text-list-lat-title"> <?php echo $value->razao; ?> </span>
										<span class="text-list-tab-ano2"> Localizacão: </span>
										<span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>
									</div>
		 						
		 					<?php endforeach ?>	

		 				</div>	

					</div>
					<?php endif; ?>

	 			</div>

	 			<br class="clear">
	 		</div>	
	 		<div class="fundo-cinza-lateral2"></div>			 			

			</div>
		</div>	

		<?php $this->renderPartial('_footer_menu'); ?>
</section>
<div class="div-voltar-ao-topo-list">	
	<a class="botao-voltar-ao-topo-list" id="btn-subir-bb">VOLTAR AO TOPO</a>	
</div>