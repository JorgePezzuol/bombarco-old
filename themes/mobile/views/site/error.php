<?php Utils::redirect(); ?>

<div class="container">

	<!-- <h2>Error <?php echo $code; ?></h2>

	<div class="error">
		<?php echo CHtml::encode($message); ?>
	</div> -->

</div>

<div class="error-page">
	<div class="bgfull"></div>
	<div class="nav-links">
		<div class="container">
			<article class="text-nav">Continue navegando nas categorias</article>
			<ul class="options-category">
				<li class="tab speedboat"><h2><a href="<?php echo $projecturl ?>/embarcacoes/lanchas-a-venda">Lanchas</a></h2></li>
				<li class="tab sailboat"><h2><a href="<?php echo $projecturl ?>/embarcacoes/veleiros-a-venda">Veleiros</a></h2></li>
				<li class="tab jetski"><h2><a href="<?php echo $projecturl ?>/embarcacoes/jet-skis-a-venda">Jet Skis</a></h2></li>
			</ul>
		</div>
	</div>
</div>
