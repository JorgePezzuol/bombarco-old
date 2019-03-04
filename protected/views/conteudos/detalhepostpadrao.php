<?php
	// scripts
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/detalhe_post.js', CClientScript::POS_END);

	// meta tags compartilhar fb/twitter
	if(count($model->conteudoImagens)) {
		// se tiver imagem, vamos por uma thumb ao compartilhar
		//Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true).'/public/embarcacoes/'.$model->embarcacaoImagens[0]->imagem, 'og:image:secure_url');
		Yii::app()->clientScript->registerMetaTag(Yii::app()->request->baseUrl.'/public/conteudos/'.$model->conteudoImagens[0]->imagem, 'og:image:secure_url');
	}

	// não tem imagem
	else {
		Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true).'/img/sem_foto_bb.jpg', 'og:image');
	}

	Yii::app()->clientScript->registerMetaTag($model->titulo, 'og:title');
	Yii::app()->clientScript->registerMetaTag(Yii::app()->getBaseUrl(true), 'og:site_name');
	Yii::app()->clientScript->registerMetaTag(strip_tags($model->texto),  'og:description');
?>
<style>
	.footer .line-blue { padding: 40px 0 54px 0px; }
	.line-postp-1 { height: 250px; }
	@media screen and (max-width: 768px) {
    .hidden-md-down { display: none }
    .hidden-md-up { display: block }
	}	
	@media screen and (min-width: 769px) { 
    .hidden-md-down { display: block }
    .hidden-md-up { display: none }
	}
</style>

<?php if(isset($titulo) != null):?>
	<title><?php echo $model->titulo; ?></title>
<?php endif; ?>
<section class="content">

	<div class="line-postp-1">
	 	<div class="container">
		 	<div class ="div-bloco-textos">
		 		<h2 class="text-depp-1"><?php echo $titulo; ?></h2>
		 		<h1 class="text-depp-title"><?php echo $model->titulo; ?></h1>

		 		<?php if (isset($model->conteudoCategorias) && !empty($model->conteudoCategorias) && ($model->conteudoCategorias->id != 0)): ?>
		 			<span class="text-depp-subtitle"><?php echo $model->conteudoCategorias->titulo; ?></span>
		 		<?php endif ?>

		 		<span class="text-depp-data"><?php echo $model->data; ?></span>

		 	</div>
		 	<div class ="div-bloco-compartilhar">
		 		<span class="text-depp-compart">
		 			Compartilhar

		 			<!-- link compartilhar twitter -->
		 			<a href="#" target="_blank" class="icon-comp-depp1" id="compartilhar-twitter"></a>

		 			<a href="#" class="icon-comp-depp2"></a>

		 			<!-- link compartilhar fb -->
		 			<a href="#" target="_blank" id="compartilhar-fb" class="icon-comp-c2-depp2"></a>
		 		</span>
		 	</div>
		 	<div class="btn-voltar-depp">
		 		<a href="javascript:history.back()" class="icon-voltar-depp"></a>
		 	</div>
		 	<div class="div-text-depp-desc">
		 		<span class="text-depp-desc"></span>
		 		<span class="text-depp-desc"><?php echo Utils::breadCrumbs($breadcrumbs); ?></span>
		 	</div>
	 	</div>
	</div>

		<div class="container hidden-md-up" style="padding:20px;">
			<div class="advertise-home_banner" style="text-align: left;">
                            <span>Publicidade</span>

				<?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>

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

						<?php if ($model->conteudoImagens != null): ?>

							<?php foreach ($model->conteudoImagens as $key => $value): ?>

								<li class="category-depp">
									<img class="img-depp" style="width:100% !important;" src="<?php echo Yii::app()->baseUrl; ?>/public/conteudos/<?php echo $value->imagem; ?>">
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
	 				<section style="text-align:left;" class="advertise-depp">
                                             <span>Publicidade</span>
						<?php echo Banners::loadBanner(Banners::LATERAL, null, array('width'=>200, 'height'=>446), true); ?>
					</section>
	 			</span>
	 		</div>
	 	</div>
	</div>

	<?php if (isset($mais_desta_categoria) && !empty($mais_desta_categoria)): ?>

		<div class="line-postp-4">
		 	<div class="container" >
		 		<div class="btn-l4-depp">
				 	<a href="<?php echo Yii::app()->createUrl('comunidade/'.Conteudos::$categorias_by_char[$model->macro].'/'.$model->conteudoCategorias->slug); ?>" class="botao-l4-depp" id="btn-l4-depp">Ver todas</a>
				</div>
		 		<div class="title-l4-depp">
		 			<span class ="texto-title-depp">Mais de: <?php echo $model->conteudoCategorias->titulo; ?><span>
		 		</div>
		 		<div class="box-img-l4-depp">
					<ul class="categories-depp">

						<?php foreach ($mais_desta_categoria as $key => $value): ?>

							<li class="category-depp" >
								<a href="<?php echo Conteudos::mountUrl($value); ?>">
									<?php echo Conteudos::getThumb($value, array('class'=>'bg-img-depp'), false); ?>
									<span class="blend"></span>
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

	<?php endif ?>

		<div class="container hidden-md-down" style="padding:20px;">
			<div class="advertise-home_banner" style="text-align: left;">
                            <span>Publicidade</span>

				<?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>

			</div>
		</div>

</section>
