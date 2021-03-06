<?php 
	// scripts
	//Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/anunciar.js?23', CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/anunciar_index.js?'.microtime(), CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
?>



<!--
Quando a pessoa tem pacote de empresas, ao clicar em Anunciar, 
tem que ir para a pagina de Pacote de Empresas e não de plano individual
-->
<?php if(PlanoUsuarios::verificarSePossuiPacoteEmpresa(Yii::app()->user->id) == true): ?>
	<input type="hidden" id="plano_embarcacao" value="1"/>
<?php else: ?>
	<input type="hidden" id="plano_embarcacao" value="0"/>
<?php endif; ?>


<section class="content" id="alterada-sm">
    <div class="line-anunciar-1">
        <div class="container" id="anuncios">
            <div class="div-text-l1-an" >
                <span class="text-l1-an"><a class="link-bd" href="<?php echo Yii::app()->createUrl('index.php'); ?>">Home</a> > Anunciar</span>
            </div>
            <div id="armored_website" style="width: 115px; height: 32px;"></div>
            <div class="abas">
				<ul class="tab-links">
					<li class="active li-menu" id="li-plano-gratis">	
						<!--<a href="#embarcacoes" id="botao-emba-an" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Embaracacao']);">Anúncio Individual</a>-->
						<a href="#embarcacoes" id="botao-emba-an">Anúncio <br/>Individual</a>
						<?php if(Yii::app()->user->isGuest == true): ?>
							<span class="tag-gratis"></span>
						<?php endif ;?>
						<?php if(Yii::app()->user->isGuest == false): ?>
							<?php if(PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id) == false): ?>
								<span class="tag-gratis"></span>
							<?php endif; ?>
						<?php endif;?>
					</li>
					<li class="li-menu" id="li-pacotes">
						<!--<a href='#empservicos' id='botao-empser-an' onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Empresa']);">Pacotes para Empresas</a>-->
						<a href='#empservicos' id="botao-empser-an">Pacotes <br/>para Empresas</a>
					</li>
					<li class="li-menu">
						<!--<a href="#estaleiros" id="botao-estaleiros-an" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Estaleiros']);">Estaleiros</a>-->
						<a href="#estaleiros" id="botao-estaleiros-an">Estaleiros</a>
					</li>
					<li class="li-menu">
						<!--<a href="banners" id="botao-banner-an" onclick="_gaq.push(['_trackEvent', 'anuncios', 'click', 'Banners']);">Banners</a>-->
						<a href="banners" id="botao-banner-an">Banners</a>
					</li>
				</ul>
            </div>
        </div>
    </div> 
    <div class="line-anunciar-2">
        <div class="container">
            <div class="div-textos-bloco esconde">
                <div class="div-text-l2-an1">
                    <span class="text-l2-an1">Anunciar Embarcações</span>
                </div>
                <div class="div-text-l2-an2">
                    <span class="text-l2-an2">(Lanchas, Veleiros, Jet Skis ou Barcos de Pesca)</span>
                </div>
                <div class="div-text-l2-an3">
                    <span class="text-l2-an3">Crie e publique seu anúncio facilmente e de acordo com as suas necessidades. Ainda oferecemos combos de 6, 15, 30 ou 60 anúncios com valores especiais caso você precise anunciar diversos produtos.</span>
                </div>

            </div>
            <!-- Conteudo Guia de Empresas -->
            <div class="div-textos-bloco-b" style="display:none; width: auto;">
                <div class="div-text-l2-an1-b" style="width:auto;">
                    <span class="text-l2-an1-b verde">Aproveite as vantagens de ser um anunciante empresarial e venda muito mais</span>
                </div>
                <!--<div class="div-text-l2-an2">
                    <span class="text-l2-an2">(texto)</span>
                </div>-->
                <div class="div-text-l2-an2-b">
                    <span class="text-l2-an2-b">Temos combos de 6,15 30 e 60 anúncios para sua empresa. Todos com valores especiais caso você precise anunciar diversos produtos.</span>
                </div>

            </div>
            <!-- Conteudo Estaleiros -->
            <div class="div-textos-bloco-c" style="display:none">
                <div class="div-text-l2-an1-c">
                    <span class="text-l2-an1-c verde">Anunciar Estaleiro</span>
                </div>
                <div class="div-text-l2-an2-c">
                    <span class="text-l2-an2-c">Todas as grandes marcas estão no Bombarco. O seu estaleiro também precisa estar.
                        Adicione uma página do seu estaleiro com as suas informações, embarcações e um contato direto.
                        Oferecemos planos diferenciados para estaleiros. Para conhecê-los, deixe aqui seu contato.</span>
                </div>

            </div>
            <!-- Conteudo Banners -->
            <div class="div-textos-bloco-d" style="display:none">
                <div class="div-text-l2-an1-d">
                    <span class="text-l2-an1-d verde">Anunciar Banners Publicitários</span>
                </div>
                <div class="div-text-l2-an2-d">
                    <span class="text-l2-an2-d">Temos diferentes banners e ferramentas de publicidade disponíveis para o seu negócio.
                        Deixe o seu contato para lhe apresentarmos as diversas opções disponíveis no portal.</span>
                </div>
            </div>
        </div>
    </div>
	

	<?php
		if(Yii::app()->user->isGuest == false) {
			if(PlanoUsuarios::verificarSePossuiPlanoGrats(Yii::app()->user->id) == true) {
				$this->renderPartial('_index_ja_tem_plano_gratis');		
			}
			else {
				$this->renderPartial('_index_nao_tem_plano_gratis');
			}
		}
		else {
			$this->renderPartial('_index_nao_tem_plano_gratis');	
		}
		
		
	?>
	

    <div id="div-anun-bloq" style="display:none;">
	<?php

		if ($flgPlanoAnuncio) {
			$this->renderPartial('_planos_embarcacao_desabilitado', array('plano' => $plano,
				'qtdeAnunciosCadastrados' => $qtdeAnunciosCadastrados));
		} else {
			$this->renderPartial('_planos_embarcacao');
		}
	?>
	</div>
 
    <div class="line-anunciar-3-estban line-3-an bg-branco" style="display:none;">
        <div class="container">
            <div class="box-estban-l3">
                <div class="box-col1-estban-l3">

                    <div class="quad-estban-l3">

                        <span class="text-l3-estban label-verde">*Nome</span>
                        <div class="campo-nome-anunciar campo-quadrado">
                            <input name="Contatos[nome]" id="nome" class="required font-form" type="text">
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">
                        <span class="text-l3-estban label-verde">*Nome da Empresa</span>
                        <div class="campo-nome-anunciar campo-quadrado">
                            <input class="required font-form" id="nome_empresa" type="text">
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">
                        <span class="text-l3-estban label-verde">*E-mail</span>
                        <div class="campo-nome-anunciar campo-quadrado">
                            <input name="Contatos[email]" id="email" class="required font-form" type="text">
                            <div class="errorMessage"></div>
                        </div>
                    </div>
                    <div class="quad-estban-l3">
                        <span class="text-l3-estban label-verde">*Telefone</span>
                        <div class="campo-nome-anunciar campo-quadrado">
                            <input name="telefone" id="telefone" class="required font-form" type="text">
                            <div class="errorMessage" id="telefone"></div>
                        </div>
                    </div>
                    <div class="campo">
                        <input type="submit" id="botao-contato" class="botao-enviar-an btn-quadrado" value="ENVIAR" onclick="_gaq.push(['_trackEvent', 'Institucional', 'click', 'Enviar']);" >
                    </div>
                </div>
                <!--<div class="box-col2-estban-l3"> 
					<div class="blocos-ajuda">
						<div class="div-icontext1-l4">
							<div class="div-text-l4-an-a">
								<span class="text-l4-an-a">Deixe seu contato</span>
								<icon class="icon3-l4-an-a"></i>
							</div>
						</div>
						<div class="div-icontext2-l4">
							<icon class="icon-seta-l4-an-a"></i>
						</div>
						<div class="div-icontext1-l4">
							<div class="div-text-l4-an-a">
								<span class="text-l4-an-a">Aguarde o retorno de um de nossos atendentes</span>
								<icon class="icon2-l4-an-a"></i>
							</div>
						</div>
					</div>-->
					
					<div class="bloco-precisaajuda">
						<span class="title-l3-bloco2-deemb">Precisa de ajuda? <span class="title-l3-bloco2-deemb preto">Fale Conosco</span></span>
                            
                                    <span class="text3-l3-estban-col2 bloco-contatos">(11) 98969-8912 - Horário de atendimento Ligação/Whatsapp Seg a Sex das 8h10 às 18h00<br/> <a href="mailto:atendimento@bombarco.com.br" class="link-verde">atendimento@bombarco.com.br</a></span>
                                            </div>
                                            </div>
                                            </div>
                                            </div>
                                            </div>

		<!--<div class="quebra-campos">-->
		<!-- lightbox msg de sucesso form de contato -->
		<div class="lbox-msgenviada" id="lbox-msgok">
			<div class="texts-lbox-ag">
				<div class="div-title-form-msgok">
					<span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
				</div>
			</div>
			<input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
		</div>

		<!--<div class="line-anunciar-4 line-4-an">
			<div class="container-fluido" id="alterada-sm">
				<div class="box-line-4-a">
					<div class="titulo-anuncf-div">
						<span class="titulo-anun-cf"><b>Como funciona?</b></span>
					</div>
					<div class="div-icontext1-l4">
						<div class="div-text-l4-an-a">
							<span class="text-l4-an-a">Escolha o tipo de anúncio ideal</span>
							<icon class="icon1-l4-an-a"></i>
						</div>
					</div>
					<div class="div-icontext2-l4">
						<icon class="icon-seta-l4-an-a"></i>
					</div>
					<div class="div-icontext1-l4">
						<div class="div-text-l4-an-a">
							<span class="text-l4-an-a">Cadastre-se em nossa plataforma</span>
							<icon class="icon2-l4-an-a"></i>
						</div>
					</div>
					<div class="div-icontext2-l4">
						<icon class="icon-seta-l4-an-a"></i>
					</div>
					<div class="div-icontext1-l4">
						<div class="div-text-l4-an-a">
							<span class="text-l4-an-a">Cadastre o seu anúncio</span>
							<icon class="icon3-l4-an-a"></i>
						</div>
					</div>
					<div class="div-icontext2-l4">
						<icon class="icon-seta-l4-an-a"></i>
					</div>
					<div class="div-icontext1-l4">
						<div class="div-text-l4-an-a">
							<span class="text-l4-an-a">Efetue o pagamento</span>
							<icon class="icon4-l4-an-a"></i>
						</div>
					</div>
				</div>
				
				<div class="line-anunciar-3-forpag">
			   
					<div class="bloco-anunciar-3-forpag">

						<span class="titulo-anun-cf2">Formas de  pagamento</span>

						<div class="bloco2-anunciar-3-forpag">
							<icon class="icone-cartao-anun-1"></icon>
						</div>
						<div class="bloco2-anunciar-3-forpag">
							<icon class="icone-cartao-anun-2"></icon>
						</div>
						<div class="bloco2-anunciar-3-forpag">
							<icon class="icone-cartao-anun-3"></icon>
						</div>
					</div>
				</div>
		
			</div>
		</div>-->

		

		<!--<div class="line-anunciar-5">
			<div class="container">
				<div class="box-line-5-an">
					<div class="box-text-l5-an">
						<span class="title-l5-an"><b> Anunciar no Bombarco é garantir que o seu negócio ganhe visibilidade qualificada.</b> Dotada de anúncios segmentados por categoria, maleáveis de acordo com as necessidades do anunciante e com páginas personalizadas para estaleiros e empresas, nossa plataforma torna-se uma potente ferramenta para a otimização de qualquer negócio náutico.</span>
					</div>
					<div class="box-text2-l5-an">
						<span class="title2-l5-an">No Bombarco você encontra</span>
					</div>
					<div class="box-icones-l5-an">
						<div class="box-sup-icones-l5-an">
							<div class="quad-box-sup-icones-l5-an">
								<span class="text-l5-an">Conteúdo segmentado por gênero e categoria</span>
								<icon class="icon4-l5-an-a"></i>
							</div>
							<div class="quad-box-sup-icones-l5-an">
								<span class="text-l5-an">Conceitos de usabilidade aplicados à risca, tornando a navegação ainda mais simplificada</span>
								<icon class="icon6-l5-an-a"></i>
							</div>
							<div class="quad-box-sup-icones-l5-an">
								<span class="text-l5-an">Sistema de busca e filtros otimizados</span>
								<icon class="icon7-l5-an-a"></i>
							</div>
							<div class="quad-box-inf-icones-l5-an">
								<span class="text2-l5-an">Velocidade e ótimo desempenho na navegação de todas as páginas internas</span>
								<icon class="icon8-l5-an-a"></i>
							</div>
						</div>
						<div class="box-inf-icones-l5-an">


								<div class="quad-box-inf-icones-l5-an" style= "position: relative; right: 30px;">
										<span class="text2-l5-an">Versão mobile disponível para acesso através de diferentes dispositivos</span>
										<icon class="icon9-l5-an-a"></i>
								</div>

						</div>
						
					</div>
				</div>
			</div>
		</div>-->
		&nbsp;
		</section>

		<script type="text/javascript">
			//gambiarra problema news
			/*getUrlParameterCiorreria();
			 function getUrlParameterCiorreria()
			 {
			 var sPageURL = window.location.search.substring(1);
			 var sURLVariables = sPageURL.split('&');
			 var flgAchouParam = false;
			 var parametro = '';
			 for (var i = 0; i < sURLVariables.length; i++)
			 {
			 var sParameterName = sURLVariables[i].split('=');
			 if(sParameterName[0] == 'utm_content') {
			 if(sParameterName[1] == 'pacotes') {
			 location.href = 'https://docs.google.com/forms/d/1ROXnZlLtua2KI_M5p3OLuI77I2ed_P7tYoui90S-wzY/viewform';
			 }
			 }
			 }
			 }*/
			//final gambiarra
		</script>
	</div>


	<?php if(Yii::app()->user->id != null): ?>
		<input type="hidden" value="<?php echo Yii::app()->user->id; ?>" id="logado"/>
	<?php else: ?>
		<input type="hidden" value="0" id="logado"/>
	<?php endif;?>