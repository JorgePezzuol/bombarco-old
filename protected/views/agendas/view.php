<section class="content">
	<div class="line-postp-1">
	 	<div class="container">	
		 	<div class ="div-bloco-textos">
		 		<span class="text-depp-1">Agenda</span>
		 		<span class="text-depp-title"><?php echo $model->titulo; ?></span>

		 		<?php if (isset($model->conteudoCategorias) && !empty($model->conteudoCategorias)): ?>
		 			<span class="text-depp-subtitle"><?php echo $model->conteudoCategorias->titulo; ?></span>	
		 		<?php endif ?>		 		

		 		<span class="text-depp-data"><?php echo $model->data_inicio; ?></span>
		 		
		 	</div>	
		 	<div class ="div-bloco-compartilhar">
		 		<span class="text-depp-compart">Compartilhar</spa><i class="icon-comp-depp1"></i><i class="icon-comp-depp2"></i><i class="icon-comp-c2-depp2"></i>
		 	</div>
		 	<div class="btn-voltar-depp">
		 		<i class="icon-voltar-depp"></i>
		 	</div>
		 	<div class="div-text-depp-desc">
		 		<span class="text-depp-desc"></span>
		 		<span class="text-depp-desc"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
		 	</div>	
	 	</div>		
	</div>	
					
	<div class="line-postp-2">
		<div class="container">	
			<div class="line-gray-depp">	
					<div id="div-depp">
						<div class="controls">
							<span class="prev"></span>
							<i class="icon"></i>
							<span class="next"></span>
							<i class="icon"></i>
						</div>
						<ul class="slide-depp">	

						<?php if (isset($model->conteudoImagens) && $model->conteudoImagens != null): ?>

							<?php foreach ($model->conteudoImagens as $key => $value): ?>

								<li class="category-depp">
									<a href="#">
										<img class="img-depp" src="<?php echo Yii::app()->theme->baseUrl; ?>/img/lancha-pesca.jpg">			
									</a>
								</li>
								
							<?php endforeach ?>
												
						<?php endif ?>					
							
						</ul>
					</div>
			</div>	
	 	</div>	
	</div>
	 
	<div class="line-postp-3">
	 	<div class="container">	
	 		<div class="box-text-l3-depp">
	 			<span class="texto-l3-depp">
	 				<?php echo $model->texto; ?>
	 			</span>
	 			<section style="text-align:center;" class="advertise-depp advertise-agenda">
					<?php echo Banners::loadBanner(Banners::LATERAL, null, array('width'=>200, 'height'=>446), true); ?>
				</section>	
	 		</div>	
	 	</div>
	</div>

	<?php if (isset($mais_desta_categoria) && !empty($mais_desta_categoria)): ?>

		<div class="line-postp-4">
		 	<div class="container" >
		 		<div class="btn-l4-depp">
				 	<a href="<?php echo Yii::app()->createUrl('comunidade/'.$model->conteudoCategorias->slug); ?>" class="botao-l4-depp" id="btn-l4-depp">Ver todas</a>
				</div>
		 		<div class="title-l4-depp">	
		 			<span class ="texto-title-depp">Mais de: <?php echo $model->conteudoCategorias->titulo; ?><span>
		 		</div>	
		 		<div class="box-img-l4-depp">
					<ul class="categories-depp">

						<?php foreach ($mais_desta_categoria as $key => $value): ?>

							<li class="category-depp">
								<a href="#">
									<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-depp'), false); ?>
									<span class="table-depp"></span>
								</a>
							</li>
							
						<?php endforeach ?>
						
					</ul>
				</div>		
		 	</div>	
		</div>

	<?php endif ?>

</section>