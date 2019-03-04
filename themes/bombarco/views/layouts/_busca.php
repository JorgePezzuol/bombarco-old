
<!--Start Filtro Principal-->
<section class="main-filter">
	<div class="container">
		
		<h1 class="title">Bombarco. <b>Líder em classificados náuticos.</b></h1>

		<?php echo CHtml::form(array('busca'), 'get', array('id'=>'form-general-search')); ?>
		<input name="busca" placeholder="ou digite aqui o que você procura" class="terms-ok" type="text">
		<input class="find-ok" type="submit">
		<?php echo CHtml::endForm(); ?>
		
		<ul class="options-category">
			<li class="tab speedboat active"><h2><a href="#">Lanchas</a></h2></li>
			<li class="tab sailboat"><h2><a href="#">Veleiros</a></h2></li>
			<li class="tab jetski"><h2><a href="#">Jet Skis</a></h2></li>
			<li class="tab pesca"><h2><a href="#">Barcos de Pesca</a></h2></li>
			<li style="margin-top:20px;" class="motor"><h2><a href="https://www.bombarco.com.br/motores">Motores</a></h2></li>
		</ul>
		
		<?php echo CHtml::form(array('site/url'), 'get', array('id'=>'form-search')); ?>
		<!--Start Filtro de Busca-->
		<div class="form-filter">
			<!--Start Coluna 1-->
			<?php $str = EmbarcacaoFabricantes::dropDown('marca', 'brand', 2, 'Marca');?>
			
			<div class="col">
				<span class="title">Busque por <br>marca e modelo</span>
				<span class="brand close-dd"><?php echo EmbarcacaoFabricantes::dropDown('marca', 'brand', 2, 'Marca', '', array('class'=>'select-search search-home'));?></span>
				<span class="model close-dd"><select id="model" name="modelo" class="select-search search-home"><option value="-1" selected>Selecione o modelo</option></select>
				</span>
			</div>

			<!--End Coluna 1-->

			<!--Start Coluna 2-->
			<div class="col">
					
				<span class="slide-price">
					
						<span class="title">Qual faixa de preço?</span>

						<input data-prettify="false" type="text" id="price"/>

						<span class="under">de 
							<span class="b">R$ 
								<span></span>
								<input name="preco-min" type="hidden" />
							</span>
						</span>
						<span class="above"><span class="prefix">até</span> 
							<span class="b">R$ 
								<span></span>
								<input name="preco-max" type="hidden" />
							</span>
						</span>
				
				</span>
				
				<span class="slide-feet">
					<div class="validate-opacity-range"></div>
						<span class="title">Quantos pés?</span>

						<input data-prettify="false" type="text" id="feets" />

						<span class="under">de 
							<span class="b">
								<span></span> pés
								<input name="pes-min" type="hidden" />
							</span>
						</span>
						<span class="above"><span class="prefix">até</span> 
							<span class="b">
								<span></span> pés
								<input name="pes-max" type="hidden" />
							</span>
						</span>
					
				</span>
				
				
			</div>
			<!--End Coluna 2-->

			<!--Start Coluna 3-->
			<div class="col">
				<span class="title">Novo <br>ou usado?</span>

				<span class="condition close-dd">
					<select id="condition" name="condicao" class="select-search search-home">
						<option value="-1" selected>Novos ou Usados</option>						
						<option value="0" class="nx-boats">Novo</option>
						<option value="1" class="nx-boats">Usado</option>
					</select>
				</span>

				<span class="discover">
					<input type="hidden" id="macro" name="macro" value="2">
					<input type="submit" name="Busca" id="submit-discover" value="Buscar" />
				</span>
			</div>
			<!--End Coluna 3-->			

		</div>
		<!--End Filtro de Busca-->
		<?php echo CHtml::endForm(); ?>

	</div>
</section>
<!--End Filtro Principal-->