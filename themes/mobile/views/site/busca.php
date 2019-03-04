<?php

	/*
	
	$lanchas
	$jetskis
	$veleiros
	$empresas
	$estaleiros
	$comunidades
	$noticias
	$primeiro_barco
	$busca
	$breadcrumbs

	*/

	//search term
	//$busca

	//count total
	$count_lanchas = count($lanchas);
	$count_jetskis = count($jetskis);
	$count_veleiros = count($veleiros);
	$count_empresas = count($empresas);
	//$count_comunidades = count($comunidades);
	$count_noticias = count($noticias);
	$count_primeirobarco = count($primeiro_barco);
	$count_total = $count_lanchas + $count_jetskis + $count_veleiros + $count_empresas + $count_noticias + $count_primeirobarco;

	//echo '<pre>';
	//		var_dump($lanchas);
	//echo '</pre>';


?>

<div class="header-search full-width">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<?php echo CHtml::form(array('site/busca'), 'get', array('id'=>'form-general-search')); ?>
			<input name="busca" placeholder="O que procura?" class="terms-ok input-text" type="text">
			<input class="find-ok input-submit sprite" type="submit" onclick="_gaq.push(['_trackEvent', 'Home', 'click', 'barra-de-busca']);">
		<?php echo CHtml::endForm(); ?>
		<br class="clear" />
	</div>
</div>

<article class="article-search"><span class="count-results"><?php echo $count_total; ?> </span>Resultados para <span class="text-term">"<?php echo $busca; ?>"</span></article>

<div class="results-search full-width">
	<div class="container">
		<?php if (count($lanchas) > 0) : ?>
			<p class="title-categorie">Lanchas</p>
			<?php foreach ($lanchas as $key => $value): ?>
				<div class="result-content pure-g">
					<a href="<?php echo Embarcacoes::mountUrl($value); ?>" class="link-result">
						<div class="result-image pure-u-1-4">
							<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
						</div>
						<div class="result-infos pure-u-3-4">
							<?php  
								$result_title = $value->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo;
								$result_pes = substr($value->embarcacaoModelos->tamanho, 0, strpos($value->embarcacaoModelos->tamanho, '.'));
								$result_price = $value->valor != '0.00' ? Utils::formataValorView($value->valor) : "N/Info.";
							?>
							<div class="infos-content">
								<?php if($value->destaque == 2) : ?>
									<div class="box-featured sprite"></div>
								<?php endif; ?>
								<article class="result-title"><?php echo $result_title; ?></article>
								<i class="ico-pes inline-block sprite"></i>
								<span class="result-pes inline-block"><?php echo $result_pes; ?> PÉS</span>
								<span class="result-price inline-block">R$ <?php echo $result_price; ?> </span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

			<?php if (count($lanchas) > 1): ?>
		 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('buscando'=>$busca, 'macro'=>Anuncio::$_categoria_embarcacao['LANCHA'])); ?>" class="btn-seemore seemore-center">Ver Mais</a>
			<?php endif ?>

		<?php endif; ?>

		<?php if (count($veleiros) > 0) : ?>
			<p class="title-categorie">Veleiros</p>
			<?php foreach ($veleiros as $key => $value): ?>
				<div class="result-content pure-g">
					<a href="<?php echo Embarcacoes::mountUrl($value); ?>" class="link-result">
						<div class="result-image pure-u-1-4">
							<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
						</div>
						<div class="result-infos pure-u-3-4">
							<?php  
								$result_title = $value->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo;
								$result_pes = substr($value->embarcacaoModelos->tamanho, 0, strpos($value->embarcacaoModelos->tamanho, '.'));
								$result_price = $value->valor != '0.00' ? Utils::formataValorView($value->valor) : "N/Info.";
							?>
							<div class="infos-content">
								<?php if($value->destaque == 2) : ?>
									<div class="box-featured sprite"></div>
								<?php endif; ?>
								<article class="result-title"><?php echo $result_title; ?></article>
								<i class="ico-pes inline-block sprite"></i>
								<span class="result-pes inline-block"><?php echo $result_pes; ?> PÉS</span>
								<span class="result-price inline-block">R$ <?php echo $result_price; ?> </span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

			<?php if (count($veleiros) > 1): ?>
		 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('buscando'=>$busca, 'macro'=>Anuncio::$_categoria_embarcacao['VELEIRO'])); ?>" class="btn-seemore seemore-center">Ver Mais</a>
			<?php endif ?>

		<?php endif; ?>

		<?php if (count($jetskis) > 0) : ?>
			<p class="title-categorie">Jetskis</p>
			<?php foreach ($jetskis as $key => $value): ?>
				<div class="result-content pure-g">
					<a href="<?php echo Embarcacoes::mountUrl($value); ?>" class="link-result">
						<div class="result-image pure-u-1-4">
							<?php echo Embarcacoes::getThumb($value, array('class'=>'bg-img-resbus'), true); ?>
						</div>
						<div class="result-infos pure-u-3-4">
							<?php  
								$result_title = $value->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo;
								$result_pes = substr($value->embarcacaoModelos->tamanho, 0, strpos($value->embarcacaoModelos->tamanho, '.'));
								$result_price = $value->valor != '0.00' ? Utils::formataValorView($value->valor) : "N/Info.";
							?>
							<div class="infos-content">
								<?php if($value->destaque == 2) : ?>
									<div class="box-featured sprite"></div>
								<?php endif; ?>
								<article class="result-title"><?php echo $result_title; ?></article>
								<i class="ico-pes inline-block sprite"></i>
								<span class="result-pes inline-block"><?php echo $result_pes; ?> PÉS</span>
								<span class="result-price inline-block">R$ <?php echo $result_price; ?> </span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

			<?php if (count($jetskis) > 1): ?>
		 			<a href="<?php echo Yii::app()->createUrl('embarcacoes/busca/termo/'.$busca, array('buscando'=>$busca, 'macro'=>Anuncio::$_categoria_embarcacao['JETSKI'])); ?>" class="btn-seemore seemore-center">Ver Mais</a>
			<?php endif ?>

		<?php endif; ?>

		<?php if (count($estaleiros) > 0) : ?>
			<p class="title-categorie">Estaleiros</p>
			<?php foreach ($estaleiros as $key => $value): ?>
				<div class="result-content result-middle pure-g">
					<a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>" class="link-result">
						<div class="result-image pure-u-1-3">
							<?php if ($value->logo != null): ?>
								<img class="bg-img-resbus-box2" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $value->logo; ?>"/>
							<?php else: ?>
								<img class="bg-img-resbus-box2" src="<?php echo Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';?>"/>
							<?php endif ?>
						</div>
						<div class="result-infos pure-u-2-3">
							<div class="infos-content">
								<article class="result-title-middle"><?php echo $value->razao; ?></article>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

			<?php if (count($estaleiros) > 1): ?>
		 			<a href="<?php echo Yii::app()->createUrl('estaleiros/busca/'.$busca); ?> " class="btn-seemore seemore-center">Ver Mais</a>
			<?php endif ?>

		<?php endif; ?>

		<?php if (count($empresas) > 0) : ?>
			<p class="title-categorie">Empresas</p>
			<?php foreach ($empresas as $key => $value): ?>
				<div class="result-content result-middle pure-g">
					<a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>" class="link-result">
						<div class="result-image pure-u-1-3">
							<?php echo Empresas::getThumb($value, Empresas::PATH_IMAGES_EMPRESAS, true, array('class'=>'bg-img-resbus-box3')); ?>
						</div>
						<div class="result-infos pure-u-2-3">
							<div class="infos-content">
								<article class="result-title-middle"><?php echo $value->razao; ?></article>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>

			<?php if (count($empresas) > 1): ?>
		 			<a href="<?php echo Yii::app()->createUrl('gui-de-empresas/busca/'.$busca); ?>" class="btn-seemore seemore-center">Ver Mais</a>
			<?php endif ?>

		<?php endif; ?>

	</div>
</div>

