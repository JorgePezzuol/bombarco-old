
<?php if(Yii::app()->controller->getRoute() == 'site/index'):?>


<!--<span class="banner-float" style="display:none;">
			<div id="ajax_video"></div>
			<a href="#" class="action-float"><img class="img-float" src="<?php //echo Yii::app()->baseUrl . '/img/Banner_Float-06.png'?>"></a>
			<a href="#" class="close-float">x</a>
</span>-->
<?php endif;?>


<!--Start footer-->
<footer class="footer">

	<!--Start Linha Azul-->
	<section class="line-blue">
		<div class="container" >
			<div class="col-left">
				<span class="title">Acompanhe o Bombarco</span>
				<span class="form-newsletter">
					<form>
						<input type="email" placeholder="Receba nossa newsletter" class="email" id="email"/>
						<!--<input type="submit" id="btn-mailling" class="send" onclick="_gaq.push(['_trackEvent', 'news', 'click', 'bnt-cadastro']);"/>-->
						<input type="submit" id="btn-mailling" class="send"/>
					</form>
				</span>
			</div>
			<div class="col-right">
				<span class="title">Siga-nos e mantenha contato</span>
				<ul class="socials">
					<li class="email"><a href="mailto:atendimento@bombarco.com.br"></a></li>
					<li class="twitter"><a target="_blank" href="https://twitter.com/bombarco" target="_blank"></a></li>
					<li class="facebook"><a target="_blank" href="https://www.facebook.com/bombarco" target="_blank"></a></li>
					<li class="linkedin"><a target="_blank" href="https://www.linkedin.com/company/bombarco" target="_blank"></a></li>
					<li class="instagram"><a target="_blank" href="https://instagram.com/bombarco" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/ic-instagram.png"></a></li>
				</ul>
			</div>
		</div>
	</section>
	<!--End Linha Azul-->
	<section class="end-footer">
		<div class="container">
			<!-- Links Footer -->

			<div class="links-footer">
				<div class="links-footer-bloco">
					<span class="bloco-title">Classificados</span>
					<ul class="links-footer-lista">
						<li><a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - lanchas">Lanchas</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - veleiros">Veleiros</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - jet skis">Jet Skis</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - barcos pesca">Barcos Pesca</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('catalogo'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - estaleiros"><b>Zeromilhas</b></a></li>
						<li><a target="_blank" href="http://guiadocapitao.com.br/" class="lista-itens ax-track-event" data-ax-trackname="link rodape - guia empresas"><b>Guia do Capitão</b></a></li>
					</ul>
				</div>
				<div class="links-footer-bloco">
					<span class="bloco-title">Comunidade</span>
					<ul class="links-footer-lista">
						<li><a href="<?php echo Yii::app()->createUrl('comunidade/raio-x'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - raiox">Raio X</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('tabela'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - tabela bombarco">Tabela Bombarco</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - noticias">Notícias</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - primeiro barco">Primeiro Barco</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('comunidade/blog'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - blog">Blog</a></li>
						<?php /* ?><li><a href="<?php echo Yii::app()->createUrl('agendas'); ?>" class="lista-itens">Agenda</a></li><?php */ ?>
					</ul>

				</div>
				<div class="links-footer-bloco">
					<span class="bloco-title">Sobre</span>
					<ul class="links-footer-lista">
						<li><a href="<?php echo Yii::app()->createUrl('institucional'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - institucional">Institucional</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('por-que-anunciar'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - porque anunciar">Por que Anunciar?</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('como-anunciar-site'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - como anunciar">Como Anunciar</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('planos'); ?>" class="lista-itens ax-track-event" data-ax-trackname="link rodape - planos">Planos</a></li>
						<li><a href="http://bommarinheiro.com.br/pages/" target="_blank" class="lista-itens ax-track-event" data-ax-trackname="link rodape - bom marinheiro">Bom Marinheiro</a></li>
						<!--<li><a href="<?php //echo Yii::app()->createUrl('financiamento-lancha-veleiro-jetski'); ?>" id="btn-footer-financiamento" class="lista-itens ax-track-event" data-ax-trackname="link rodape - financiamento">Financiamento</a></li>-->
						<li><a href="<?php echo Yii::app()->createUrl('consorcio-lancha-veleiro-jetski'); ?>" id="btn-footer-consorcio" class="lista-itens ax-track-event" data-ax-trackname="link rodape - consorcio">Consórcio Náutico</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('transporte-de-lancha-veleiro-jetski'); ?>" id="btn-footer-transporte" class="lista-itens">Transporte Náutico</a></li>
						<!--<li><a href="<?php //echo Yii::app()->createUrl('preco-de-marina'); ?>" class="lista-itens">Preço de Marina</a></li>-->
						<li><a href="<?php echo Yii::app()->createUrl('arrais-mestre-capitao-amador'); ?>" class="lista-itens">Arrais amador, Mestre ou Capitão</a></li>
						<!--<li><a href="<?php //echo Yii::app()->createUrl('plataforma-submergivel-lancha'); ?>" class="lista-itens">Plataforma Submergivel</a></li>-->
						<li><a href="<?php echo Yii::app()->createUrl('jettdeck'); ?>" class="lista-itens">Jett Deck - piso náutico</a></li>
						<li><a href="<?php echo Yii::app()->createUrl('pranchamotorizada'); ?>" class="lista-itens">Jetsurf Prancha Motorizada</a></li>
						<!--<li><a href="<?php //echo Yii::app()->createUrl('aluguel-de-lancha-barco-veleiro'); ?>" class="lista-itens">Aluguel de lancha, veleiro ou barco</a></li>-->
						<li><a href="<?php echo Yii::app()->createUrl('contato'); ?>" class="lista-itens ax-track-event">Contato</a></li>
					</ul>

				</div>
				<div class="links-footer-bloco">
					<span class="bloco-title">Anuncie no Bombarco</span>
					<ul class="links-footer-lista">
						<li><a href="#" id="btn-footer-termos" class="lista-itens ax-track-event" data-ax-trackname="link rodape - termos uso">Termos de Uso</a></li>
						<li><a href="#" id="btn-footer-politica" class="lista-itens ax-track-event" data-ax-trackname="link rodape - politica privacidade">Política de privacidade</a></li>
						<a href="<?php echo Yii::app()->createUrl('anunciar'); ?>" class="botao-footer-m ax-track-event" data-ax-trackname="link rodape - anunciar" id="btn-footer-m" onclick="_gaq.push(['_trackEvent', 'Home', 'click', 'Anunciar-rodape']);ads_conversor('ISlSCJb7iVkQkLPC4wM');">ANUNCIAR</a>
					</ul>

				</div>
			</div>

			<!-- Fim links Footer -->
			<div class="line-mfoter-3">
				<span class="title-mfooter" style="cursor:default !important;"><e>Bombarco.</e><d>Todos os direitos reservados</d></span>
				<a href="<?php echo Yii::app()->homeUrl; ?>" class="icone-footer"></a>
				<div id="armored_website" style="width: 115px; height: 32px;"></div>
			</div>
		</div>
	</section>

	<!-- lightbox termos de condição -->
	<div class="lbox-footer" id="lbox-footer-termos">

			<div class="texts-lbox-footer">
				<span class="ev-titleb">Termos e Condições de Uso</br></span>
			</div>

			<div id="texto_termos" class="text-terms-lb">

			</div>

			<input type="button" name="botao-cadastrar-form" class="botao-concordar-footer close" id="close" value="FECHAR">

		</div>
		<!-- fim lightbox -->
<!-- lightbox termos de condição -->
	<div class="lbox-footer" id="lbox-footer-politica">

			<div class="texts-lbox-footer">
				<span class="ev-titleb">Política de Privacidade</br></span>
			</div>

			<div id="texto_politica" class="text-terms-lb">

			</div>

			<input type="button" name="botao-cadastrar-form" class="botao-concordar-footer close" id="close" value="FECHAR">

		</div>
		<!-- fim lightbox -->


		<!-- light box msg sucesso mailling -->
		<div class="lbox-msgenviada" id="lbox-mailling">
			<div class="texts-lbox-ag">
				<div class="div-title-form-msgok">
					<span class="form-lb-title" id="msg-lgbox">E-mail cadastrado com sucesso!</span>
				</div>
			</div>
				<input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
		</div>
		<!-- fim lightbox msg sucesso mailling -->


</footer>

<script>
    $(document).ajaxStart(function () {$('.preloader').show();});
    $(document).ajaxStop(function () {$('.preloader').hide();});
</script>

<?php if (!YII_DEBUG): ?>
<!-- Hotjar Tracking Code for www.bombarco.com.br -->
<script>
  (function(f,b){
      var c;
      f.hj=f.hj||function(){(f.hj.q=f.hj.q||[]).push(arguments)};
      f._hjSettings={hjid:11685, hjsv:3};
      c=b.createElement("script");c.async=1;
      c.src="//static.hotjar.com/c/hotjar-11685.js?sv=3";
      b.getElementsByTagName("head")[0].appendChild(c);
  })(window,document);
</script>
<?php endif ?>


<!-- tag remarketing dinamico -->
	<script type="text/javascript">
	/*
		var local_id= '';
		var local_pagetype= 'other';
		var local_totalvalue= '';
		var google_tag_params = {};
		if(jQuery('#btn-contato-anunciante_principal').length == 1 && window.location.pathname.split('/')[6] != '') 
		{
			var productId='';
			var price=0;
			try{
				productId = window.location.pathname.split('/').pop(-1);
				price	=	jQuery('#valor_barco').text().trim().replace(/[^0-9,]/g,'').replace(/[^0-9]/g,'.');
			}catch(e){}
		  
		  local_id= productId; 
		  local_pagetype= 'offerdetail';
		  local_totalvalue= price;
		  jQuery('.btn-envia-proposta').click(function(){
		  local_pagetype = 'conversion';
			var timer = setInterval(function() { 
			if(jQuery('#msg-lgbox:contains("sucesso")').is(':visible')){
			var urldata='&data=local_id%3D'+local_id+'%3Blocal_pagetype%3D'+local_pagetype+'%3Blocal_totalvalue%3D'+local_totalvalue+'%3B';;
			(new Image()).src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1014012304/?value=0&guid=ON&script=0"+urldata
			clearInterval(timer);
			}
			},1000);
			});
		}
		else
			if(jQuery('.div-btn-mais-filtros-list').length == 1){
			local_pagetype= 'searchresults';
		}
		else
		if(window.location.pathname == "/")
		{
		  local_pagetype= 'home';
		}
		if(local_id!='')
		{
		  google_tag_params.local_id=local_id;
		}
		google_tag_params.local_pagetype=local_pagetype;
		if(local_totalvalue!='')
		{
		  google_tag_params.local_totalvalue=parseFloat(local_totalvalue);
		}
		*/

	 
	</script>
	</script>
<!--<script type="text/javascript">

var google_conversion_id = 1014012304;
var google_custom_params = window.google_tag_params;
var google_remarketing_only = true;

</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/1014012304/?guid=ON&amp;script=0"/>
</div>
</noscript>-->





