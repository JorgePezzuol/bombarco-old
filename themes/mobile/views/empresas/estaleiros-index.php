<?php
//var_dump($estaleiros);
//var_dump($destaques);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/estaleiros_busca.js', CClientScript::POS_END);
?>


<?php  
	//var_dump($array_params['termo']);
	//var_dump($destaques);

	$term_busca = $array_params['termo'];
?>

<div class="header-search full-width">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<article class="title-categorie inline-block">Estaleiros</article>
		<i class="ico-search-header inline-block sprite flt-right"></i>
		<?php echo CHtml::form(array('site/urlestaleiro'), 'get', array('id'=>'form-search', 'class'=>'form-global-search')); ?>
			<input name="termo" placeholder="Buscar Estaleiros" class="input-text" type="text">
			<input class="input-submit sprite" type="submit">
		<?php echo CHtml::endForm(); ?>
		<br class="clear" />
	</div>
</div>

<?php if ($term_busca) : ?>
	<article class="article-search">Resultados para <span class="text-term">"<?php echo $term_busca; ?>"</span></article>
<?php endif ?>

<?php if (count($destaques) > 0) : ?>
	<div class="header-title full-width">
	<div class="container">
		<p class="title-text">Em Destaque <span class="count-text">(<?php echo count($destaques); ?>)</span></p>
	</div>
	</div>
	<div class="results-search full-width">
		<div class="container">
				<?php foreach ($destaques as $key => $value): ?>
					<div class="result-content result-middle pure-g">
						<a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>" class="link-result">
							<div class="result-image pure-u-1-3">
								<?php  
									if ($value->logo != null) {
										echo '<img class="bg-img-guia-gl" src="' . Yii::app()->baseUrl . '/public/empresas/' . $value->logo . '" />';
									} else {
										echo '<img class="bg-img-guia-gl" src="' . Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg">';
									}
								?>
							</div>
							<div class="result-infos pure-u-2-3">
								<div class="infos-content">
									<article class="result-title-middle"><?php echo $value->razao; ?></article>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>

<?php if (count($estaleiros) > 0) { ?>
	<div class="header-title full-width">
	<div class="container">
		<p class="title-text">Todos <span class="count-text">(<?php echo count($estaleiros); ?>)</span></p>
	</div>
	</div>
	<div class="results-search full-width results-empresas">
		<div class="container">

				<?php foreach ($estaleiros as $key => $value): ?>

					
					<div class="result-content result-middle pure-g">
						<a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>" class="link-result">
							<div class="result-image pure-u-1-3">
								<?php  
									if ($value->logo != null) {
										echo '<img class="bg-img-guia-gl" src="' . Yii::app()->baseUrl . '/public/empresas/' . $value->logo . '" />';
									} else {
										echo '<img class="bg-img-guia-gl" src="' . Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg">';
									}
								?>
							</div>
							<div class="result-infos pure-u-2-3">
								<div class="infos-content">
									<article class="result-title-middle"><?php echo $value->razao; ?></article>
								</div>
							</div>
						</a>
					</div>

				<?php endforeach; ?>
		</div>
		<?php if (count($estaleiros) == Empresas::LIMIT_SEARCH): ?>
			<div class="div-botao-carregar-esta inline-block">
				<a class="btn-seemore btn-carregar-empresas" data-tipo="estaleiro" id="carregarmais-estaleiro" data-limit="<?php echo Empresas::LIMIT_SEARCH; ?>" data-termo="<?php echo $array_params['termo'] ?>" data-localizacao="<?php echo $array_params['localizacao'] ?>" data-categoria="<?php echo $array_params['categoria'] ?>">Carregar mais</a>	
			</div>
		<?php endif ?>
		<i class="btn-slide-top inline-block sprite"></i>
		<br class="clear" />
	</div>
<?php } else{ ?>
	<article class="text-noresults">Nenhum resultado encontrado</article>
<?php } ?>