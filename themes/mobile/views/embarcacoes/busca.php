<?php  
	$url_order = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

	if (strpos($url_order,'ordem') && strpos($url_order,'desc') !== false) {
    	$order_price = 'desc';
	} elseif(strpos($url_order,'ordem') && strpos($url_order,'asc') !== false) {
		$order_price = 'asc';
	} else {
		$order_price = '';
	}

?>


<div class="header-search full-width header-result-categorie">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<article class="title-categorie inline-block">
			<?php 
				if (EmbarcacaoMacros::$macro[$array_params['macro']] == 'Jetskis') {
					echo 'Jet Skis';
				} else {
					echo EmbarcacaoMacros::$macro[$array_params['macro']];
				}
			?>
		</article>
		
		<i class="ico-search-header inline-block sprite flt-right"></i>

		<?php echo CHtml::form(array('site/url'), 'get', array('id'=>'form-search', 'class'=>'form-global-search')); ?>
			<input name="buscando" id="buscando" placeholder="Buscar" class="input-text" type="text">
			<input class="input-submit sprite" id="btn-busca-digitada" type="submit">
  
						<input type="hidden" name="macro" value="<?php echo $array_view['macro'];?>"/>
                        <input id="ordem" type="hidden" name="ordem"/>
                        <input id="pes-min" type="hidden" name="pes-min"/>
                        <input id="pes-max" type="hidden" name="pes-max"/>
                        <input id="preco-min" type="hidden" name="preco-min"/>
                        <input id="preco-max" type="hidden" name="preco-max"/>

		<br class="clear" />
	</div>
</div>

<div class="results-filters">
	<div class="container">
		<div class="checkbox-price inline-block">
			<div data-ordem="desc" class="content-checkbox checkbox-one inline-block <?php if($order_price == 'desc') {echo 'active';} ?>">
				<i class="ico-checkbox inline-block sprite"></i>
				<span id="desc" class="text-checkbox inline-block">$$$</span>
			</div>
                    <div data-ordem="asc" class="content-checkbox checkbox-two inline-block <?php if($order_price == 'asc') {echo 'active';} ?>">
				<i class="ico-checkbox inline-block sprite"></i>
				<span  class="text-checkbox inline-block">$</span>
			</div>
		</div>
		<i class="filter-btn flt-right">Filtros</i>
	</div>
	<br class="clear" />
</div>
<div class="box-filters">
	
	<div class="header-box">
		<div class="container-filter">
			<p class="title-box inline-block">Todos os filtros</p>
			<i class="btn-close-box inline-block sprite flt-right"></i>
			<br class="clear" />
		</div>
	</div>


	<div class="select-filter">
		<div class="container-filter">

			<label class="label-select">Novo ou Usado</label>
			<select class="select" name="condicao">
				<option selected="selected" value="-1">Selecione</option>
				<option value="0">Novo</option>
				<option value="1">Usado</option>
			</select>

			<label class="label-select">Marca</label>
			<?php

				$with = array('embarcacaoModeloses'=>array(
					'with'=>array(
						'embarcacoes'
						)
					)
				);
				// Condições:
				// Fabricante ativo (t.status = 1)
				// Modelo ativo (embarcacaoModeloses.status = 1)
				// Embarcação ativa (embarcacoes.status = :status_emb)
				// Embarcação não pode ser de Estaleiro (embarcacoes.macros_id != :macro_estaleiros)
				// O Plano deve estar ativo (planoUsuarios.status = 1)
				// O Plano deve ter iniciado (planoUsuarios.inicio < NOW())
				// O Plano não pode ter acabado (planoUsuarios.fim > NOW())		
				$condition = 't.status = 1
							  AND embarcacaoModeloses.status = 1
							  AND embarcacoes.status = :status_emb
							  AND embarcacoes.macros_id != :macro_estaleiros
							  AND t.embarcacao_macros_id =:macro';

				$params = array(':status_emb'=>Embarcacoes::ACTIVE, ':macro_estaleiros'=>Macros::$macro_by_slug['estaleiro'], ':macro'=>$array_view['macro']);


				echo CHtml::dropDownList('marca', '', GxHtml::listDataEx(EmbarcacaoFabricantes::model()
					->with($with)->findAll($condition, $params)), 
				array('class'=>'select',
					'empty'=>'Selecione',
				'ajax' => array(
					'type'=>'POST', 
					'url'=>Yii::app()->createUrl('utils/loadModelosEmbarcacoes2'),
					'update'=>'#select-modelo',
					'data'=>array('embarcacao_fabricantes_id'=>'js:this.value')
				)));
			?>

			<!-- select de modelos atualizado dinamicante com base na escolha da marca -->
			<label class="label-select">Modelo</label>
			<select name="modelo" id="select-modelo" class="select">
				<option value="-1">Selecione a Marca</option>
			</select>


			<!-- select de modelos atualizado dinamicante com base na escolha da marca -->
			<div class="filter-select-tipo">
				<label class="label-select">Tipos</label>
				<?php
					$tipos = EmbarcacaoTipos::model()
						->findAll('embarcacao_macros_id=:macro and status = 1 order by titulo asc', array(':macro'=>$array_view['macro']));

					echo '<select name="tipos[]" class="select last">Selecione>';
					echo '<option value="" selected="selected">Selecione</option>';
					foreach($tipos as $tipo) {

						echo '<option value="'.$tipo->slug.'">'.$tipo->slug.'</option>';
					}
					echo '</select>';
					
				?>
			</div>

		</div>
	</div>

	<div class="slider-filter">
		<?php if(EmbarcacaoMacros::$macro[$array_params['macro']] != 'Jetskis'): ?>
			<div class="container-filter">
				<p class="title">Quantos pés?</p>
				<div class="drag" id="slider-peh"></div>
				<p class="text-filter flt-left">de <span class="bold-text"><span id="peh-value-lower">0</span> pés</span></p>
				<p class="text-filter flt-right">a <span class="bold-text"><span id="peh-value-upper">200</span> pés</span></p>
				<br class="clear" />
			</div>
			<hr class='divider' />
		<?php endif; ?>
		
		<div class="container-filter">
			<p class="title">Qual faixa de preço?</p>
			<div class="drag" id="slider-price"></div>
			<p class="text-filter flt-left">de <span class="bold-text">R$ <span id="price-value-lower">0</span></span></p>
			<p class="text-filter flt-right"><span class="text-ate display-none">até</span> <span class="bold-text"><span class="text-plus">+ de </span> R$ <span id="price-value-upper">20000000</span></span></p>
			<br class="clear" />
		</div>
		
		<hr class='divider' />
	</div>




		<input type="button" name="botao-cadastrar-form" class="btn-seemore input-submit " id="btn-busca" value="Buscar" />
</div>

	<?php echo CHtml::endForm(); ?>

	<?php if(Yii::app()->request->getQuery('buscando') != "" && count($array_view['embarcacoes']) > 0):?>
		<article class="article-search">
			
			Você buscou por:
			<span class="text-term">
				"<?php echo Yii::app()->request->getQuery('buscando'); ?>"
			</span>
		</article>
	<?php endif;?>
	

<div class="results-search full-width">
	<div class="container">
		<div class="list-results">
			<?php foreach ($array_view['embarcacoes'] as $embarc): ?>
				<div class="result-content pure-g">
					<a href="<?php echo Embarcacoes::mountUrl($embarc); ?>" class="link-result">
						<div class="result-image pure-u-1-4">
							<?php echo Embarcacoes::getThumb($embarc, array('class'=>'bg-img-resbus'), true); ?>
						</div>
						<div class="result-infos pure-u-3-4">
							<?php  
								$result_title = $embarc->embarcacaoFabricantes->titulo . ' '.$embarc->embarcacaoModelos->titulo;
								$result_pes = substr($embarc->embarcacaoModelos->tamanho, 0, strpos($embarc->embarcacaoModelos->tamanho, '.'));
								$result_price = $embarc->valor != '0.00' ? Utils::formataValorView($embarc->valor) : "N/Info.";
							?>
							<div class="infos-content">
								<?php if($embarc->destaque == 2) : ?>
									<div class="box-featured sprite"></div>
								<?php endif; ?>
								<article class="result-title"><?php echo $result_title; ?></article>
								<?php if($embarc->embarcacao_macros_id == 1):?>
									<!--<i class="ico-dianoite sprite inline-block"></i>
									<article class="info-content inline-block">
										<span class="info-text">Dia: <span class="bold"><?php echo $embarc->embarcacaoModelos->passageiros; ?></span></span> <br />
										<span class="info-text">Noite: <span class="bold"><?php echo $embarc->embarcacaoModelos->acomodacoes; ?></span></span>
									</article>-->
									<article class="info-content inline-block">
									<span class="info-text info-text-passageiros"><?php echo $embarc->embarcacaoModelos->embarcacaoTipos->titulo;?></span>
									</article>
								<?php else:?>
									<i class="ico-pes inline-block sprite"></i>
									<span class="result-pes inline-block"><?php echo $result_pes; ?> PÉS</span>
								<?php endif;?>
								<span class="result-price inline-block">R$ <?php echo $result_price; ?> </span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
		<?php if (count($array_view['embarcacoes']) == 0): ?>
			<article class="article-search">Sem Resultados para <span class="text-term">"<?php echo Yii::app()->request->getQuery('buscando');?>"</span></article>
		<?php endif ?>

		<?php if (count($array_view['embarcacoes']) == Embarcacoes::LIMIT_SEARCH): ?>
					
			<div class="div-btn-carregar-list inline-block">
				<div class="botao-carregar-list btn-seemore" id="carregar-list"
					 data-limit="<?php echo Embarcacoes::LIMIT_SEARCH; ?>"
					 data-macro="<?php echo $array_params['macro']; ?>"
					 data-condicao="<?php echo $array_params['condicao']; ?>"
					 data-fabricante="<?php echo $array_params['fabricante']; ?>"
					 data-modelo="<?php echo $array_params['modelo']; ?>"
					 data-preco-min="<?php echo $array_params['preco_min']; ?>"
					 data-preco-max="<?php echo $array_params['preco_max']; ?>"
					 data-pes-min="<?php echo $array_params['pes_min']; ?>"
					 data-pes-max="<?php echo $array_params['pes_max']; ?>"
					 data-local="<?php echo $array_params['uf']; ?>"
					 data-tipos="<?php echo $array_params['tipos']; ?>"
					 data-ordem="<?php echo $array_params['ordem']; ?>"
					 data-buscando="<?php echo $array_params['busca']; ?>">VER MAIS
				</div>
			</div>	

		<?php endif ?>
		<i class="btn-slide-top inline-block sprite"></i>
		<br class="clear" />
	</div>
</div>

<input type="hidden" id="embarcacao_macros_id" value="<?php echo $array_params['macro'];?>"/>
