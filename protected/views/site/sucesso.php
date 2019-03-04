<section class="content">
	<div class="line-cad-sucess">
		<div class="container">
				<div class="box-cad-sucess">
					<div class="quad-sup-cad-sucess">
						<icon class="icon-cad-sucess"></i>
						<span class="text1-cad-sucess">Anuncio Cadastrado!</span>
						<span class="text2-cad-sucess">Iremos analisar o seu anuncio e validar seu pagamento, em breve estará no ar, aguarde contato.</span>
					</div>	
					<div class="quad-inf-cad-sucess">

						<?php if(isset($tipo) && $tipo == 'anuncio'): ?>
							<a class="botao-sucess-cad-2" href="<?php echo Yii::app()->createUrl("anuncios/anunciarEmbarcacao?tipo_anuncio=plano"); ?>" id="btn-sucess-cad-2">Cadastrar novo anúncio</a>
							<a class="botao-sucess-cad-1" href="<?php echo Yii::app()->homeUrl ?>" id="btn-sucess-cad-1">Voltar para home</a>
						<?php else: ?>
							<a class="botao-sucess-cad-2" href="<?php echo Yii::app()->createUrl("anuncios/index"); ?>" id="btn-sucess-cad-2">Cadastrar novo anúncio</a>
							<a class="botao-sucess-cad-1" href="<?php echo Yii::app()->homeUrl ?>" id="btn-sucess-cad-1">Voltar para home</a>
						<?php endif ?>

						<?php if (isset($_GET['urlBoleto']) && !empty($_GET['urlBoleto'])): ?>
							<a class="botao-sucess-cad-2" href="<?php echo $_GET['urlBoleto']; ?>" id="btn-sucess-cad-2" target="_blank">Pagar Boleto</a>
						<?php endif ?>
					</div>
				</div>	
		</div>	
	</div>
</section>

<footer class="footerr">
	<div class="line-footer-cad">
		<div class="container" style="text-align:center;">
			<div class="box-mfoter-6">
				<div class="">
					<a href="<?php echo Yii::app()->homeUrl; ?>" class="icone-footer"></a>

					<div id="armored_website" style="width: 115px; height: 32px; position: absolute; top: 20px;  right: 15px;"></div>
				</div>	
			</div>		
		</div>
</footer>


<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 1014012304;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "0nP5CLiZvlgQkLPC4wM";
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/1014012304/?label=0nP5CLiZvlgQkLPC4wM&amp;guid=ON&amp;script=0"/>
</div>


