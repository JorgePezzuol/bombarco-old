<?php
//var_dump($estaleiros);
//var_dump($destaques);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/estaleiros_busca.js', CClientScript::POS_END);
?>

<section class="content">	
		<div class="line-gray-estaleiros">
			<div class="container">
				<div class="div-title-top1-esta">
					<span class="title-top1-esta"><a class="link-bd2" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > <a class="link-bd2" href="<?php echo Yii::app()->createUrl('estaleiros'); ?>">Estaleiros</a></span>
				</div>
				<div class="div-title-top2-esta">
					<span class="title-top2-esta">Estaleiros</span>
				</div>	
				<div class="div-title-top3-esta">
					<span class="title-top3-esta">Os melhores estaleiros do país listados em um só lugar</span>
				</div>
				<div class="div-search-ok-3">
					<?php echo CHtml::form(array('site/urlestaleiro'), 'get', array('id'=>'form-search', 'class'=>'search-ok-2', 'style'=>'position:relative;')); ?>
					<?php /* ?>
					<ul class="options-category-esta">
						<li class="tab todos active"><a href="#">Todos</a></li>
						<li class="tab speedboat "><a href="#">Lanchas</a></li>
						<li class="tab sailboat"><a href="#">Veleiros</a></li>
						<li class="tab jetski"><a href="#">Jet Skis</a></li>
						<li class="search"></li>
					</ul>
					<?php */ ?>

						<input name="termo" placeholder="Procure dentro de Estaleiros" class="terms-ok-2" type="text" value="<?php echo $array_params['termo']; ?>">
						<input class="find-ok-2" type="submit" style="top: 12px;
right: 0px;
position: absolute;">
					<?php echo CHtml::endForm(); ?>		
				</div>	
			</div>	
		</div>	
		<div class="container">
		</div>		
		<div class="line-white">
			<div class="container">
				<span class="title-esta">Destaques do Bombarco</span>
			</div>	
		</div>

		<div class="box-estaleiros">
			<div class="container">
				<ul class="categories-est">

					<?php foreach ($destaques as $key => $value): ?>

						<li class="category" >		
							<a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>">
								<?php if ($value->logo != null): ?>
									<img class="bg-img-est" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $value->logo; ?>"/>
								<?php else: ?>
									<img class="bg-img-est" src="<?php echo Empresas::getPath(); ?>">
								<?php endif ?>
							</a>		
						</li>
						
					<?php endforeach ?>

				</ul>

				<div style="text-align:center;" class="advertise-estaleiro">
					<?php echo Banners::loadBanner(Banners::HORIZONTAL, null, array('width'=>728, 'height'=>90), true); ?>
				</div>

			</div>

			<div class="line-white-2">
				<div class="div-title-esta-2">
					<span class="title-esta-2">Todos</span>
				</div>
			</div>

		</div>	
			
		<div class="box-estaleiros">
			<div class="container">
				<ul class="categories-est">

					<?php foreach ($estaleiros as $key => $value): ?>

						<li class="category" >		
							<a href="<?php echo Empresas::mountUrl($value, Macros::$macro_by_slug['estaleiro']); ?>">
								<?php if ($value->logo != null): ?>
									<img class="bg-img-est" src="<?php echo Yii::app()->baseUrl . '/' . Empresas::PATH_IMAGES_EMPRESAS . '/' . $value->logo; ?>"/>
								<?php else: ?>
									<img class="bg-img-est" src="<?php echo Empresas::getPath(); ?>"/>
								<?php endif ?>
							</a>		
						</li>
						
					<?php endforeach ?>

				</ul>
			</div>	
		</div>		
		<div class="line-white-3">	
			<div class="container">
				<div class="div-botoes-bottom">
					
					<?php if (count($estaleiros) == Empresas::LIMIT_SEARCH): ?>

						<div class="div-botao-carregar-esta">
							<a class="botao-carregar" id="carregar" data-limit="<?php echo Empresas::LIMIT_SEARCH; ?>" data-termo="<?php echo $array_params['termo'] ?>" data-localizacao="<?php echo $array_params['localizacao'] ?>" data-categoria="<?php echo $array_params['categoria'] ?>">VER MAIS</a>
						</div>
						
					<?php endif ?>

					<div class="div-botao-voltar-ao-topo-esta">	
						<a class="botao-voltar-ao-topo-esta" id="btn-subir-bb">VOLTAR AO TOPO</a>
					</div>		
					
				</div>
			</div>			
		</div>					
</section>