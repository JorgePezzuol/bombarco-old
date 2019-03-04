<?php

/*$titulo = '';
if (isset($array_params['macro']) && !isset($array_view['fabricante']) && !isset($array_view['modelo'])) {
	$titulo .= EmbarcacaoMacros::$macro[$array_params['macro']];
	$titulo .= ' à venda';
}
if (isset($array_view['fabricante'])) {
	$titulo .= ' ' . $array_view['fabricante']->titulo;
}
if (isset($array_view['modelo'])) {
	$titulo .= ' ' . $array_view['modelo']->titulo;
}*/

?>

<?php echo CHtml::form(array('site/url'), 'get', array('id'=>'form-search', 'class' => 'form-search-list')); ?>

<div class="line-white-listagem">
 	<div class="container">	
	 	<div class="logo-listagem">
	 		<icon class="icone_buscar-lvj-<?php echo $array_params['macro']; ?>"></icon>
	 	</div>
	 	<div class="div-topo-listagem">
 			<h1 class="title-list-1"><?php echo str_replace(" | Bombarco", "", $this->pageTitle); ?></h1>
 			<span class="title-list-2">
 				<?php echo Utils::breadCrumbs($breadcrumbs); ?>
 			</span>
 		</div>	
 		<div class="div-search-ok-5">	 			
			<div class="search-ok-5">			
				<input name="buscando" id="texto_busca" placeholder="Buscar <?php echo EmbarcacaoMacros::$macro[$array_params['macro']]; ?>" class="terms-ok-3" type="text" value="<?php echo $array_params['busca']; ?>">
				<input class="find-ok-3" type="submit">
			</div>
		</div>
 	</div>		
</div>

<div class="line-white-2-listagem">
	<form>	
	<div class="container">	
		
		<div class="select-listagem1">
			
			<span class="select-listagem1 select-fabricantes close-dd">
				<?php 
					$fabricanteId = (isset($array_view['fabricante'])) ? $array_view['fabricante']->id : '';
					echo EmbarcacaoFabricantes::dropDown('marca', 'brand', $array_view['macro'], 'Marcas', $fabricanteId, array('class'=>'select-search search-bar')); 
				?>
			</span>			
			
				
			<?php if ($fabricanteId != null): ?>

				<span class="select-listagem2 select-modelos close-dd">
				<?php
					$modeloId = (isset($array_view['modelo'])) ? $array_view['modelo']->id : '';
					//$placeholder = (isset($array_view['modelo'])) ? 'Modelos' : 'Selecione';
					$placeholder = "Selecione";
					echo EmbarcacaoModelos::dropDown('modelo', 'model', $fabricanteId, $placeholder, $modeloId, array('class'=>'select-search search-bar'));
				?>
				</span>

			<?php else: ?>

				<span class="select-listagem2 select-modelos close-dd locked">
					<select id="model" name="modelo" class="select-search search-bar">
						<option value="-1" selected>Selecione</option>
					</select>
				</span>				
				
			<?php endif ?>			
			

		</div>		

		
			<div class="div-selects-pf">	
				
				<div class="div-select-price">
					
					<span class="slide-price">
						
						<input data-prettify="false" type="text" id="price" data-from="<?php  echo ($array_params['preco_min'] != NULL) ? str_replace('.', '', $array_params['preco_min']) : 0; ?>" data-to="<?php echo ($array_params['preco_max'] != NULL) ? str_replace('.', '', $array_params['preco_max']) : 2000000; ?>" />
						
						<span class="under" style="position: relative; font-size: 13px; left: -40px; margin-left: 20px;">de 
							
							<span class="b">R$ 
								<span></span>
								<input name="preco-min" type="hidden" value="<?php echo ($array_params['preco_min'] != NULL) ? $array_params['preco_min'] : 0; ?>" />
							</span>

						</span>
						
						<span class="above" style="margin-left: -28px;font-size:13px;position: relative;left: 12px;">
							<span class="prefix"><?php echo ($array_params['preco_max'] == '2.000.000') ? '+ de' : 'até'; ?></span> 
							
							<span class="b">R$ 
								<span></span>
								<input name="preco-max" type="hidden" value="<?php echo ($array_params['preco_max'] != NULL) ? $array_params['preco_max'] : 2000000; ?>" />
							</span>

						</span>

					</span>

				</div>	


			<!--divisão-->		

			<?php if ($array_params['macro'] != EmbarcacaoMacros::$macro_by_slug['jetski']): // Se for Jetski não mostra Pés ?>
				<div class="div-select-feet">
					<div class="validate-opacity-range2"></div>
						<span class="slide-feet" style="<?php if($array_params['modelo'] != null) echo 'display:none;'; ?>">
							
							<input data-prettify="false" type="text" id="feets" data-from="<?php echo ($array_params['pes_min'] != NULL) ? $array_params['pes_min'] : 0; ?>" data-to="<?php echo ($array_params['pes_max'] != NULL) ? $array_params['pes_max'] : 200; ?>" />

							<span class="under" style="position: relative; font-size: 13px; left: -50px; margin-left: 28px;">de 
								<span class="b">
									<span></span> pés
									<input name="pes-min" type="hidden" value="<?php echo $array_params['pes_min']; ?>" />
								</span>
							</span>
							
							<span class="above" style="margin-left: 0px;font-size: 13px;position: relative;left: 18px;"><span class="prefix">até</span> 
								<span class="b">
									<span></span> pés
									<input name="pes-max" type="hidden" value="<?php echo $array_params['pes_max']; ?>" />
								</span>
							</span>

						</span>
				
				</div>
			<?php endif ?>

			</div>	

			<div class="div-btn-mais-filtros-list">
				<input type="hidden" id="macro" name="macro" value="<?php echo $array_params['macro']; ?>">
				<input name="ordem" type="hidden" />
				<a class="botao-mais-filtros" id="botao-mais-filtros-list">+ Filtros</a>
				<a class="botao-mais-filtros2" id="botao-mais-filtros-list2">- Filtros</a>
				<input type="submit" class="botao-mais-filtros-buscar" id="btn-buscar-mais-filtro" value="Buscar">
			</div>
			
			

 	</div>	

</div>

<div class="linha-mais-opcoes">

	<div class="container">

		<div class="div-text-box-checkbox-list">
			<span class="title-linha-mf">Tipo</span>
		</div>		

		<div class="box-checkbox-list">

			<div class="box-listagem-lw3">
 				
 				<ul class="categories-listagem-linha-mf">
 				<div class="validate-opacity-tipo"></div>	
 					<?php
 					//if (array_key_exists('modelo', $array_params) && $array_params['modelo'] == null) {
 						if (isset($array_view['tipos'])) {
 							echo EmbarcacaoTipos::listTypes($array_params['macro'], $array_view['tipos']);
 						} else {
 							echo EmbarcacaoTipos::listTypes($array_params['macro']);
 						}
 						
 					//} 					
 					?>

				</ul>	

			</div>

		</div>	

			<div class="box-checkbox-list2">

				<div class="div-text-box-checkbox-list2">
					<span class="title-linha-mf">Localização</span>
				</div>	
				<div class="select-listagem4">

					<span class="select-listagem4 close-dd">
						
						<?php
						$ufId = (isset($array_view['uf'])) ? $array_view['uf']->id : '';
						echo Estados::dropDown($ufId, array('class'=>'select-search search-bar'));
						?>

					</span>	

				</div>	
				
				<div class="novo-usado-cb">
					<div class="div-text-box-checkbox-list4">
						<span class="title-linha-mf2">Novo ou Usado</span>
					</div>								
					<span class="select-listagem5 close-dd">
						<select name="condicao" class="select-search search-home">							
							<option value="-1" <?php if ($array_params['condicao'] == null) echo 'selected'; ?> >Estado da Embarcação</option>						
							<option value="0" class="nx-boats" <?php if ($array_params['condicao'] == 'N') echo 'selected'; ?> >Novo</option>
							<option value="1" class="nx-boats" <?php if ($array_params['condicao'] == 'U') echo 'selected'; ?> >Usado</option>
						</select>
					</span>	
				</div>			

			</div>

			<br class="clear">
		</div>	

	</div>	
	</form>
</div>
<?php echo CHtml::endForm(); ?>