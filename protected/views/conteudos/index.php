<section class="content">
		<div class="line-gray-emb-top">
			<div class="container">	
				<div>	
					<span class="title-embc-1 ">Comunidade</span>
					<span class="title-embc-2">Home > Comunidade</span>
				</div>	
				<?php /* ?>
				<div class="search-emb">
					<?php echo CHtml::form(array('site/url'), 'get', array('id'=>'form-search')); ?>
						<input name="buscando" placeholder="Buscar Embarcações" class="terms-emb" type="text">
						<input class="find-emb" type="submit">
					<?php echo CHtml::endForm(); ?>
				</div>
				<?php */ ?>
			</div>
		</div>			
		<div class="line-white-emb">
			<div class="container">				
				<div class="div-class-box-emb">					

					<div class="box-l2-emba-1">	
						<div class="div-title-l2-emba">
							<span class="title-l2-emba"> Notícias </span>
							<div class="btn-emba-div" style="top:-10px !important;">
			 					<a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>" class="botao-emba" id="btn-ver-todas-#">Ver todas</a>
							</div>
						</div>	

						<div class="boxes-home-nt">
							<ul class="categories-nt">
								
								<?php foreach ($noticias as $key => $value): ?>

									<li class="category-nt" >
										<a href="<?php echo Conteudos::mountUrl($value, Conteudos::$categorias_by_char[$value->macro]); ?>">
											<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-nt'), false); ?>
											<span class="table-nt">
												<span class="texts-nt">
													<span class="text-data-nt"><?php echo $value->data; ?></span>	
													<span class="text-tipo-nt"><?php if(isset($value->embarcacaoMacros)) echo $value->embarcacaoMacros->titulo; ?></span>
													<h2 class="text-barco-nt"><?php echo $value->titulo; ?></h2>	
												</span>		
											</span>
										</a>
									</li>							
									
								<?php endforeach ?>	
								
							</ul>
						</div>
							
					</div>

					<div class="box-l2-emba-2">	
						<div class="div-title-l2-emba">
							<span class="title-l2-emba"> Primeiro Barco </span>
							<div class="btn-emba-div" style="top:-10px !important;">
			 					<a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>" class="botao-emba" id="btn-ver-todas-#">Ver todas</a>
							</div>
						</div>		
						<div class="boxes-home-nt">
							<ul class="categories-nt">
								
								<?php foreach ($primeiro_barco as $key => $value): ?>

									<li class="category-nt" >
										<a href="<?php echo Conteudos::mountUrl($value, Conteudos::$categorias_by_char[$value->macro]); ?>">
											<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-nt'), false); ?>
											<span class="table-nt">
												<span class="texts-nt">
													<span class="text-data-nt"><?php echo $value->data; ?></span>	
													<span class="text-tipo-nt"><?php if(isset($value->embarcacaoMacros)) echo $value->embarcacaoMacros->titulo; ?></span>
													<h2 class="text-barco-nt"><?php echo $value->titulo; ?></h2>	
												</span>		
											</span>
										</a>
									</li>							
									
								<?php endforeach ?>	
								
							</ul>
						</div>
					</div>

					<div class="box-l2-emba-3">	
						<div class="div-title-l2-emba">
							<span class="title-l2-emba"> Blog </span>
							<div class="btn-emba-div" style="top:-10px !important;">
			 					<a href="<?php echo Yii::app()->createUrl('comunidade/blog'); ?>" class="botao-emba" id="btn-ver-todas-#">Ver todas</a>
							</div>
						</div>		
						<div class="boxes-home-nt">
							<ul class="categories-nt">
								
								<?php foreach ($blog as $key => $value): ?>

									<li class="category-nt" >
										<a href="<?php echo Conteudos::mountUrl($value, Conteudos::$categorias_by_char[$value->macro]); ?>">
											<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-nt'), false); ?>
											<span class="table-nt">
												<span class="texts-nt">
													<span class="text-data-nt"><?php echo $value->data; ?></span>	
													<span class="text-tipo-nt"><?php if(isset($value->embarcacaoMacros)) echo $value->embarcacaoMacros->titulo; ?></span>
													<h2 class="text-barco-nt"><?php echo $value->titulo; ?></h2>	
												</span>		
											</span>
										</a>
									</li>							
									
								<?php endforeach ?>	
								
							</ul>
						</div>	
					</div>
				</div>	

				<?php $embarcacoes_destaque = Embarcacoes::anunciosRelacionados(); ?>

				<div class="box-cinza-lateral-bb">	
						<div class="div-title-lateral-anuncios">
							<span class="title-lateral-anuncios">Anúncios Patrocinados</span>
						</div>	
					<div class="bloco-tabela-1">
		 		 		<div class="title-lat-tabela-div">
		 					<span class="title-lat-tabela"> 
		 						Classificados
		 					</span>
		 				</div>	
		 				<div class="box-tabela-lat-tab">
		 					<?php foreach ($embarcacoes_destaque as $key => $value): ?>

			 					<ul class="categories-tabela-lat">
				 					<li class="category-tabela–lat">
				 						<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-listagem-lat'), true); ?>						
									</li>
								</ul> 	
								<div class="textos-lat-tab">
									<span class="text-list-lat-title"> <?php echo $value->embarcacaoModelos->titulo; ?> </span>
									<span class="text-list-tab-ano"> Ano: </span>
									<span class="text-list-tab-ano-rnd"> <?php echo $value->ano; ?> </span>
									<span class="text-list-tab-price"> R$ <?php echo Utils::formataValorView($value->valor); ?> </span>	
								</div>
		 						
		 					<?php endforeach ?>
		 				</div>	
					</div>


					<?php $empresas_relacionadas = Empresas::anunciosRelacionados(Macros::$macro_by_slug['empresa']); ?>

					<div class="bloco-tabela-2">
		 		 		<div class="title-lat-tabela-div2">
		 					<span class="title-lat-tabela2"> Guia de Empresas </span>
		 				</div>	
		 				<div class="box-tabela-lat-tab2">

		 					<?php foreach ($empresas_relacionadas as $key => $value): ?>

			 					<ul class="categories-tabela-lat2">
				 					<li class="category-tabela–lat2">
				 						<?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-listagem-lat')); ?>						
									</li>
								</ul> 	
								<div class="textos-lat-tab2">
									<span class="text-list-lat-title"> <?php echo $value->razao; ?> </span>
									<!--<span class="text-list-tab-ano2"> Localizacão: </span>
									<span class="text-list-tab-ano-rnd2"> <?php echo $value->cidades->nome . ' / ' . $value->estados->nome; ?> </span>-->
								</div>	
		 						
		 					<?php endforeach ?>

		 				</div>	
					</div>
			 	</div>	

				<div class="fundo-cinza-lateral"></div>			 		
			</div>	
		</div>			
</section>