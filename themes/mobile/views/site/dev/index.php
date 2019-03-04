<?php

?>
<!--Start home busca-->
<div class="home-search full-width">
	<article class="title text-center">Bombarco. <span class="bold-title">Líder em <br /> classificados náuticos.</span></article>
	<article class="description text-center">Procurando uma embarcação <br /> específica? <span class="white-description">Busque abaixo.</span></article>
	<?php echo CHtml::form(array('busca'), 'get', array('id'=>'form-general-search')); ?>
		<input name="busca" placeholder="O que procura?" class="terms-ok input-text" type="text">
		<input class="find-ok input-submit sprite" type="submit" onclick="_gaq.push(['_trackEvent', 'Home', 'click', 'barra-de-busca']);">
	<?php echo CHtml::endForm(); ?>
</div>
<!--End home busca-->



<!--Start home categorias-->
<div class="home-categories full-width box-categories">
	<div class="container">
		<div class="pure-u-1 categorie categories-lanchas sprite-bg">
			<a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda');?>" class="title-categorie text-center">Lanchas</a>
		</div>
		<div class="pure-g">
			<div class="pure-u-1-2 categorie categories-veleiros sprite-bg">
				<a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda');?>" class="title-categorie text-center">Veleiros</a>
			</div>
			<div class="pure-u-1-2 categorie categories-jetskis sprite-bg">
				<a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda');?>" class="title-categorie text-center">Jet Skis</a>
			</div>
		</div>
	</div>
</div>
<!--End home categorias-->

<!--Start home more categories-->
<div class="home-more-categories full-width box-categories">
	<div class="container">
		<p class="text-more text-center">Encontre Também...</p>
		<div class="pure-u-1 categorie categories-estaleiros sprite-bg">
			<a href="<?php echo Yii::app()->createUrl('estaleiros'); ?>" class="title-categorie text-center">Estaleiros</a>
		</div>
		<div class="pure-u-1 categorie categories-empresas sprite-bg">
			<a href="<?php echo Yii::app()->createUrl('guia-de-empresas/todas'); ?>" class="title-categorie text-center">Guia de Empresas</a>
		</div>
	</div>
</div>
<!--End home more categories-->

<!--Start home institucional-->
<div class="home-institucional full-width box-categories">
	<div class="container">
		<p class="text-institucional text-center">Sobre o Bombarco</p>
		<div class="full-width">
			<div class="categorie categories-institucional">
				<a href="<?php echo Yii::app()->createUrl('site/institucional'); ?>" class="title-categorie text-center">Institucional</a>
			</div>
			<div class="categorie categories-anunciar">
				<a href="<?php echo Yii::app()->createUrl('site/comoAnunciar'); ?>" class="title-categorie text-center">Como <br /> Anunciar</a>
			</div>
			<br class="clear" />
		</div>
		<div class="pure-u-1 categorie categories-contato">
			<div class="title-categorie link-home-contato">
				<i class="ico-contato sprite"></i>
				Contato
			</div>
		</div>
	</div>
</div>
<!--End home institucional-->

<!--Start home social-->
<div class="home-social full-width">
	<div class="container container-social">
		<ul class="social-menu">
			<li class="item-menu"><a href="https://instagram.com/bombarco/" onclick="javascript: return ! window.open(this.href);" class="link-menu sprite link-instagram link-newtab"></a></li>
			<li class="item-menu"><a href="https://twitter.com/bombarco" onclick="javascript: return ! window.open(this.href);" class="link-menu sprite link-twitter link-newtab"></a></li>
			<li class="item-menu"><a href="https://www.facebook.com/bombarco" onclick="javascript: return ! window.open(this.href);" class="link-menu sprite link-facebook link-newtab"></a></li>
			<li class="item-menu"><a href="https://www.linkedin.com/company/bombarco" onclick="javascript: return ! window.open(this.href);" class="link-menu sprite link-linkedin link-newtab"></a></li>
		</ul>
	</div>
</div>
<!--End home social-->
