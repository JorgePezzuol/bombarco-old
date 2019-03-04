<?php  
	//var_dump($array_params['termo']);
	//var_dump($destaques);

	$term_busca = $array_params['termo'];
?>

<div class="header-search full-width">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<article class="title-categorie inline-block">Empresas</article>
		<i class="ico-search-header inline-block sprite flt-right"></i>
		<?php echo CHtml::form(array('site/urlguia'), 'get', array('id'=>'form-search', 'class'=>'form-global-search')); ?>
			<input name="termo" placeholder="Buscar Empresas" class="input-text" type="text">
			<input class="input-submit sprite" type="submit">
		<?php echo CHtml::endForm(); ?>
		<br class="clear" />
	</div>
</div>

<?php if ($term_busca) : ?>
	<article class="article-search">Resultados para <span class="text-term">"<?php echo $term_busca; ?>"</span></article>
<?php endif ?>

<div class="header-filters">
	<div class="container">
		<?php echo CHtml::form(array('site/urlguia'), 'get', array('id'=>'form-search')); ?>
			<div class="box-filter inline-block first-box">
				<label class="label-filter inline-block">Categorias</label>
				<?php echo EmpresaCategorias::dropDown(); ?>
			</div>
			<div class="box-filter inline-block flt-right second-box">
				<label class="label-filter inline-block">Localização</label>
				<?php echo Estados::dropDown(); ?>
				<input type="submit" class="input-submit" name="Busca" id="submit-discover" value="BUSCAR" />	
			</div>
			<br class="clear" />
		<?php echo CHtml::endForm(); ?>
	</div>
</div>


<?php if (count($empresas) > 0) : ?>
	<div class="header-title full-width">
	<div class="container">
		<p class="title-text">Em Destaque <span class="count-text">(<?php echo count($empresas); ?>)</span></p>
	</div>
	</div>
	<div class="results-search full-width">
		<div class="container">
				<?php foreach ($empresas as $key => $value): ?>
					<div class="result-content result-middle pure-g">
						<a href="<?php echo Empresas::mountUrl($value, $value->macros_id); ?>" class="link-result">
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

<?php if (count($gratuitas) > 0) { ?>
	<div class="header-title full-width">
	<div class="container">
		<p class="title-text">Todos <span class="count-text">(<?php echo count($gratuitas); ?>)</span></p>
	</div>
	</div>
	<div class="results-search full-width results-empresas">
		<div class="container">

				<?php foreach ($gratuitas as $key => $value): ?>

					<div class="result-content result-middle pure-g">
						<a href="<?php echo Empresas::mountUrl($value, $value->macros_id); ?>" class="link-result">
							<div class="result-infos pure-u-2-3">
								<div class="infos-content">
									<article class="result-title-middle"><?php echo $value->razao; ?></article>
								</div>
							</div>
						</a>
					</div>
				
				<?php endforeach; ?>
		</div>
		<?php if (count($gratuitas) == Empresas::LIMIT_SEARCH): ?>
			<div class="div-botao-carregar-esta inline-block">
				<div class="btn-seemore btn-carregar-empresas" id="carregar-gl" data-tipo="empresa" data-limit="<?php echo Empresas::LIMIT_SEARCH; ?>">Carregar mais</div>	
			</div>
		<?php endif ?>
		<i class="btn-slide-top inline-block sprite"></i>
		<br class="clear" />
	</div>


<?php } else{ ?>
	<article class="text-noresults">Nenhum resultado encontrado</article>
<?php } ?>






