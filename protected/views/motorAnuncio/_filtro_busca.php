<?php

/*$titulo = '';
if (isset($array_view['macro']) && !isset($array_view['fabricante']) && !isset($array_view['modelo'])) {
	$titulo .= EmbarcacaoMacros::$macro[$array_view['macro']];
	$titulo .= ' à venda';
}
if (isset($array_view['fabricante'])) {
	$titulo .= ' ' . $array_view['fabricante']->titulo;
}
if (isset($array_view['modelo'])) {
	$titulo .= ' ' . $array_view['modelo']->titulo;
}*/

?>

<?php echo CHtml::form(array('motorAnuncio/busca'), 'get', array('id'=>'form-search', 'class' => 'form-search-list')); ?>

<div class="line-white-listagem">
 	<div class="container">	
	 	<div class="logo-listagem">
	 		<!--<icon class="icone_buscar-lvj-<?php //echo $array_view['macro']; ?>"></icon>-->
	 		<icon class="icone_buscar-lvj-5"></icon>
	 	</div>
	 	<div class="div-topo-listagem">
 			<!--<h1 class="title-list-1"><?php //echo str_replace(" | Bombarco", "", $this->pageTitle); ?></h1>-->
 			<h1 class="title-list-1">Motores à venda</h1>
			<span class="title-list-2">
 				<a href="/">Home</a> &gt; <a href="/motores">Motores</a> 			
 			</span>
 		</div>	
 		<div class="div-search-ok-5">	 			
			<div class="search-ok-5">		
				<input name="ordem" type="hidden" />	
				<input name="busca-texto" id="texto_busca" placeholder="Buscar motores" class="terms-ok-3" type="text" value="<?php echo $array_view['busca']; ?>">
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
					$marcaId = ($array_view['marca'] != "") ? $array_view['marca']->id : '';
					echo MotorFabricantes::dropDown('marca', 'marca', 'Marcas', $marcaId, array('class'=>'select-search search-bar')); 
				?>
			</span>			
			
			<span class="select-listagem2 select-modelos close-dd">
				<?php 
					$motor_tipos_id = ($array_view['tipo'] != "") ? $array_view['tipo']->id : '';
					echo MotorTipos::dropDown('tipo', 'tipo', 'Tipos', $motor_tipos_id, array('class'=>'select-search search-bar')); 
				?>
			</span>

			<span class="select-listagem1 select-fabricantes close-dd" style="margin-left:560px;">
				<select name="estado" class="select-search search-bar" style="width:160px;">							
					<option value="" <?php if ($array_view['estado'] == null) echo 'selected'; ?> >Estado do motor</option>						
					<option value="N" class="nx-boats" <?php if ($array_view['estado'] == 'N') echo 'selected'; ?> >Novo</option>
					<option value="U" class="nx-boats" <?php if ($array_view['estado'] == 'U') echo 'selected'; ?> >Usado</option>
				</select>
			</span>
		

		</div>		

			
			<?php if(!Utils::checarSeEhMobile()): ?>
			<div class="div-selects-pf" style="width: 0px !important;">	
				
				<div class="div-select-price">
					
					<span class="slide-price">
						
						<input data-prettify="false" type="text" id="price" data-from="<?php  echo ($array_view['preco-min'] != NULL) ? str_replace('.', '', $array_view['preco-min']) : 0; ?>" data-to="<?php echo ($array_view['preco-max'] != NULL) ? str_replace('.', '', $array_view['preco-max']) : 2000000; ?>" />
						
						<span class="under" style="position: relative; font-size: 13px; left: -40px; margin-left: 20px;">de 
							
							<span class="b">R$ 
								<span></span>
								<input name="preco-min" type="hidden" value="<?php echo ($array_view['preco-min'] != NULL) ? $array_view['preco-min'] : 0; ?>" />
							</span>

						</span>
						
						<span class="above" style="margin-left: -28px;font-size:13px;position: relative;left: 12px;">
							<span class="prefix"><?php echo ($array_view['preco-max'] == '2.000.000') ? '+ de' : 'até'; ?></span> 
							
							<span class="b">R$ 
								<span></span>
								<input name="preco-max" type="hidden" value="<?php echo ($array_view['preco-max'] != NULL) ? $array_view['preco-max'] : 2000000; ?>" />
							</span>

						</span>

					</span>

				</div>	
	

			</div>	
		<?php endif; ?>

			<div class="div-btn-mais-filtros-list">
				<!--<a class="botao-mais-filtros" id="botao-mais-filtros-list">+ Filtros</a>
				<a class="botao-mais-filtros2" id="botao-mais-filtros-list2">- Filtros</a>-->
				<input style="width: 240px !important;" type="submit" class="botao-mais-filtros-buscar" id="btn-buscar-mais-filtro" value="Buscar">
			</div>
			
			

 	</div>	

</div>

<!--<div class="linha-mais-opcoes">

	<div class="container">

		<div class="div-text-box-checkbox-list">
			<span class="title-linha-mf">Tipo</span>
		</div>		

		<div class="box-checkbox-list">

			<div class="box-listagem-lw3">
 				
 				<ul class="categories-listagem-linha-mf">
 				<div class="validate-opacity-tipo"></div>	
 					<?php

 						/*if (isset($array_view['tipos'])) {
 							echo EmbarcacaoTipos::listTypes($array_view['macro'], $array_view['tipos']);
 						} else {
 							echo EmbarcacaoTipos::listTypes($array_view['macro']);
 						}*/
 						
					
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
						
						<?php/*
						$ufId = (isset($array_view['uf'])) ? $array_view['uf']->id : '';
						echo Estados::dropDown($ufId, array('class'=>'select-search search-bar'));
						*/
						?>

					</span>	

				</div>
				
				<div class="novo-usado-cb" style="margin-left: -15px;">
					<div class="div-text-box-checkbox-list4">
						<span class="title-linha-mf2">Novo ou Usado</span>
					</div>								
					<span class="select-listagem5 close-dd">
						<select name="condicao" class="select-search search-home" style="width:160px;">							
							<option value="-1" <?php //if ($array_view['estado'] == null) echo 'selected'; ?> >Estado do motor</option>						
							<option value="0" class="nx-boats" <?php //if ($array_view['estado'] == 'N') echo 'selected'; ?> >Novo</option>
							<option value="1" class="nx-boats" <?php //if ($array_view['estado'] == 'U') echo 'selected'; ?> >Usado</option>
						</select>
					</span>	
				</div>			

			</div>

			<br class="clear">
		</div>	

	</div>-->
	</form>
</div>
<?php echo CHtml::endForm(); ?>