<?php
 //var_dump($embarcacoes);
?>

<div class="header-search full-width header-result-categorie">
	<div class="container">
		<a href="javascript:history.back();" class="header-back sprite inline-block"></a>
		<article class="title-categorie inline-block">Favoritos</article>
		<br class="clear" />
	</div>
</div>

<div class="results-search full-width content-favoritos">
	<div class="container">
		<?php if (count($embarcacoes) == 0) { ?>
			<article class="article-favoritos">Nenhuma embarcacao favoritada.</article>
		<?php } else { ?>
			<?php foreach ($embarcacoes as $embarc): ?>
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
								<article class="result-title"><?php echo $result_title; ?></article>
								<i class="ico-pes inline-block sprite"></i>
								<span class="result-pes inline-block"><?php echo $result_pes; ?> PÉS</span>
								<span class="result-price inline-block">R$ <?php echo $result_price; ?> </span>
							</div>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		<?php } ?>	
	</div>
</div>