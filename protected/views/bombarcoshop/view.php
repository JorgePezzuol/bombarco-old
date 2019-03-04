<html lang="pt-BR">

   <head>

      <meta charset="UTF-8">

      <title>Bombarco E-book</title>

      	<?php 

	         Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/admin/css/bootstrap.min.css');

	         Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/bombarcoshop/css/customizado.css?e='.microtime());

	         Yii::app()->getClientScript()->registerCssFile("https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery_1.9.1.min.js', CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/admin/js/bootstrap.min.js', CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/functions.js?e='.microtime(), CClientScript::POS_END);

	         Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/bombarcoshop/view.js?e='.microtime(), CClientScript::POS_END);

	         /* swiper */

	         //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/bombarcoshop/assets/js/main.js', CClientScript::POS_END);

	         //Yii::app()->getClientScript()->registerScriptFile("https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.min.js", CClientScript::POS_END);

	         //Yii::app()->getClientScript()->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css");

         ?>

      <!--<meta name="description" content="Bombarco E-book">-->

      <?php Utils::metaTags($this); ?>

      <meta name="viewport" content="width=device-width, initial-scale=1">

      <!--[if lt IE 9]>

      <script src="js/html5shiv.js"></script>

      <![endif]-->

   </head>

   <body>

        <section class="preloader">
            <img src="<?php echo Yii::app()->createUrl('img/loader.gif'); ?>" alt=""/>
        </section>

      <header role="banner" id="header_site">

         <div class="container">

            <div class="col-md-3">

               <img class="logo-header" src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/logo-bombarco.png'?>" />

            </div>

         </div>

      </header>

      <section class="slider-ebook">

         <!-- Swiper -->

         <div class="swiper-container">

            <div class="swiper-wrapper">

               <div class="swiper-slide"><img alt="img-banner" class="img-slider" src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/pagina-venda-ebook.jpg'?>" /></div>

               <!--<div class="swiper-slide"><img class="img-slider" src="assets/img/pagina-venda-ebook.jpg" /></div>-->

            </div>

            <!-- Add Pagination -->

            <div class="swiper-pagination"></div>

            <!-- Add Arrows -->

            <div class="swiper-button-next"></div>

            <div class="swiper-button-prev"></div>

         </div>

         <!-- Swiper JS -->

         <!--<script src="../dist/js/swiper.min.js"></script>-->

         <!-- Initialize Swiper -->

         <script>

            /*var swiper = new Swiper('.swiper-container', {

                pagination: '.swiper-pagination',

                slidesPerView: 1,

                paginationClickable: true,

                spaceBetween: 30,

                keyboardControl: true,

                nextButton: '.swiper-button-next',

                prevButton: '.swiper-button-prev',

                loop: true

            });*/

         </script>

      </section>

      <section class="section-about-the-ebook">

         <div class="container">

            <p class="about-ebook-text">

               Criamos esse e-book porque sabemos que comprar uma embarcação não faz parte do dia a dia de qualquer pessoa. Entenda mais sobre as questões que envolvem a compra do seu barco ideal com o ebook que fizemos especialmente para você

            </p>

            <div class="wrapper-preco-post-about">

               <div class="col-md-4 left-side-price">por apenas</div>

               <div class="col-md-8 right-side-price">R$ 75,00</div>

            </div>

            <!--<a class="button-comprar-bombarco" href="#">COMPRAR</a>-->

         </div>

      </section>

      <section class="section-contents-list">

         <div class="container">

            <h2 class="title-contents-list">O que você vai encontar neste E-book?</h2>

            <div class="col-md-6 column-contents">

               <ul class="contents-list">

                  <li class="item-list">Quem eu sou? <span style="color:#016969;">vs</span>. O tipo ideal de embarcação para mim </li>

                  <li class="item-list">Como tirar habilitação náutica? </li>

                  <li class="item-list">Quanto custa ter e manter? </li>

                  <li class="item-list">Quais as opções de compra existente no mercado? 

                     <small>

                     Financiamento, Consórcio, Compartilhamento e direto com o vendedor, Broker, Revenda, Estaleiro. 

                     </small>

                  </li>

                  <li class="item-list">Como guardar e transportar o meu barco?</li>

               </ul>

            </div>

            <div class="col-md-6 column-contents">

               <ul class="contents-list">

                  <li class="item-list">Seguro de barco </li>

                  <li class="item-list">Quais documentos pedir na hora da compra? </li>

                  <li class="item-list">Quais os tipos de motorização ideal para mim? </li>

                  <li class="item-list">Como escolher um nome para o meu barco? </li>

                  <li class="item-list">Dicas para iniciante </li>

                  <li class="item-list">Dicionário náutico </li>

               </ul>

            </div>

         </div>

      </section>

      <section class="form-cadastro-email">

         <div class="container">

            <h3 class="title-form">Preencha seus dados no formulário abaixo:</h3>

            <form id="form-cadastro" 

               action="#" 

               method="POST" 

               class="form-cadastro">

               <input type="text" class="campo-form person" id="nome" name="nome" placeholder="Nome" />

               <input type="text" id="email" name="email" class="campo-form mail" placeholder="E-mail" />

               <h3 class="title-cupom">Tem um cupom?</h3>

               <p class="subtitle-cupom">

                  Adicione o código e valide o seu desconto.

               </p>

               <input type="text" id="cupom" name="cupom" class="campo-form cupom" placeholder="Seu Cupom " />

               <button id="btn-pagar" type="submit" class="button-comprar-bombarco">COMPRAR</button>

            </form>

         </div>

      </section>

      <section id="news">

         <div class="container">

            <div class="alinhar">

               <div id="cadastro">

                  <p>Acompanhe o Bombarco</p>

                  <div class="input">

                     <input type="text" id="email-mailing" />

                     <button id="btn-mailing"></button>

                  </div>

                  <!--input-->

               </div>

               <!--cadastro-->

               <div class="redes">

                  <p>Siga-nos e mantenha contato</p>

                  <ul>

                     <li><a href="mailto:atendimento@bombarco.com.br"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/icon-mail.jpg'?>" alt="Email"></a></li>

                     <li><a target="_blank" href="https://twitter.com/bombarco"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/icon-twitter.jpg';?>" alt="Twitter"></a></li>

                     <li><a target="_blank" href="https://www.facebook.com/bombarco"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/icon-face.jpg';?>" alt="Facebook"></a></li>

                     <li><a target="_blank" href="https://www.linkedin.com/company/bombarco"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/icon-linkedin.jpg';?>" alt="Linkedin"></a></li>

                     <li><a target="_blank" href="https://instagram.com/bombarco"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/icon-instagram.jpg';?>" alt="Instagram"></a></li>

                  </ul>

               </div>

               <!--redes-->

            </div>

            <!--alinhar-->

         </div>

      </section>

      <div class="container" id="container-footer">

         <section id="mapa-site">

            <div class="alinhar">

               <ul id="col-mapa">

                  <p>Classificados</p>

                  <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda'); ?>" class="lista-itens " data-ax-trackname="link rodape - lanchas">Lanchas</a></li>

                  <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda'); ?>" class="lista-itens " data-ax-trackname="link rodape - veleiros">Veleiros</a></li>

                  <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda'); ?>" class="lista-itens " data-ax-trackname="link rodape - jet skis">Jet Skis</a></li>

                 <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda'); ?>" class="lista-itens " data-ax-trackname="link rodape - barcos pesca">Barcos Pesca</a></li>

                 <li><a href="<?php echo Yii::app()->createUrl('estaleiros'); ?>" class="lista-itens " data-ax-trackname="link rodape - estaleiros"><b>Estaleiros</b></a></li>

                  <li><a href="http://guiadocapitao.com.br/" target="_blank" class="lista-itens "><b>Guia do capitão</b></a></li>

               </ul>

               <ul id="col-mapa">

                  <p>Comunidade</p>

                 <li><a href="<?php echo Yii::app()->createUrl('comunidade/raio-x'); ?>" class="lista-itens " data-ax-trackname="link rodape - raiox">Raio X</a></li>

                  <li><a href="<?php echo Yii::app()->createUrl('comunidade/tabela-bombarco'); ?>" class="lista-itens " data-ax-trackname="link rodape - tabela bombarco">Tabela Bombarco</a></li>

                  <li><a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>" class="lista-itens " data-ax-trackname="link rodape - noticias">Notícias</a></li>

                  <li><a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>" class="lista-itens " data-ax-trackname="link rodape - primeiro barco">Primeiro Barco</a></li>

                  <li><a href="<?php echo Yii::app()->createUrl('comunidade/blog'); ?>" class="lista-itens " data-ax-trackname="link rodape - blog">Blog</a></li>

               </ul>

               <ul id="col-mapa">

                  <p>Sobre</p>

	                 <li><a href="<?php echo Yii::app()->createUrl('institucional'); ?>" class="lista-itens " data-ax-trackname="link rodape - institucional">Institucional</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('por-que-anunciar'); ?>" class="lista-itens " data-ax-trackname="link rodape - porque anunciar">Por que Anunciar?</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('como-anunciar-site'); ?>" class="lista-itens " data-ax-trackname="link rodape - como anunciar">Como Anunciar</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('planos'); ?>" class="lista-itens " data-ax-trackname="link rodape - planos">Planos</a></li>
					<li><a href="http://bommarinheiro.com.br/pages/" target="_blank" class="lista-itens " data-ax-trackname="link rodape - bom marinheiro">Bom Marinheiro</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('financiamento-lancha-veleiro-jetski'); ?>" id="btn-footer-financiamento" class="lista-itens " data-ax-trackname="link rodape - financiamento">Financiamento</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('consorcio-lancha-veleiro-jetski'); ?>" id="btn-footer-consorcio" class="lista-itens ">Consórcio</a></li>
	                <li><a href="<?php echo Yii::app()->createUrl('contato'); ?>" class="lista-itens " data-ax-trackname="link rodape - contato">Contato</a></li>
               </ul>

               <ul id="col-mapa">

                  <p>Anuncie no BomBarco</p>

                  <li><a href="" title="Termos de Uso">Termos de Uso</a></li>

                  <li><a href="" title="Política de Privacidade">Política de Privacidade</a></li>

                  <!--<li class="last"><a href="" title="Anunciar" class="bt-anunciar">Anunciar</a></li>-->

               </ul>

               <div id="assinatura">

                  <p><span style="color: #016969;
    font-family: 'Montserrat';
    font-weight: bolder;" class="font-green">BomBarco.</span> Todos os Direitos Reservados.</p>

                  <img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/logo-bombarco.jpg';?>" alt="BomBarco" class="logo-rodape" />

               </div>

               <!--assinatura-->

            </div>

            <!--alinhar-->

         </section>

      </div>


<div class="modal fade" id="modalpagamento" role="dialog">

	 <div class="modal-dialog">

	    <div class="modal-content">

	       <div class="modal-header">

	          <button type="button" class="close" data-dismiss="modal">&times;</button>

	          <h4 class="modal-title">Total: <strong id="titulo-modal">75,00</strong></h4>

	       </div>

	       <div class="modal-body">

	          <div class="row">

	             <div class="col-md-12">

	                <div class="panel-default credit-card-box">

	                   <div class="panel-heading display-table" >

	                      <div class="row display-tr" >

	                         <h3 class="panel-title display-td">BANDEIRAS ACEITAS</h3>

	                         <div class="display-td" >                            

	                            <img class="img-responsive pull-right" src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/accepted_c22e0.png'?>">

	                         </div>

	                      </div>

	                   </div>

	                   <br/>

	                   <div class="row display-tr alert-error" style="display:none;">

	                      <div class="alert alert-danger">

	                         <strong>Erro!</strong> Ocorreu um erro ao realizar o pagamento.

	                      </div>

	                   </div>

	                   <div class="row display-tr alert-success" style="display:none;">

	                      <div class="alert alert-success" style="margin-bottom:0px;">

	                         <strong>Successo!</strong> O E-book foi enviado para o email cadastrado.

	                      </div>

	                   </div>

	                   <div class="panel-body">

	                      <?php echo "<input type='hidden' name='id_produto' value='".$produto->id."' id='id_produto'/>" ?>

	                      <?php echo "<input type='hidden' name='valor' value='".$produto->valor."' id='valor'/>" ?>

	                      <input type="hidden" id="card_flag" name="card_flag" />

	                      <input type="hidden" id="card_validate_month" name="card_validate_month" />

	                      <input type="hidden" id="card_validate_year" name="card_validate_year" />

	                      <div class="row">

	                         <div class="col-xs-12">

	                            <div class="form-group">

	                               <label for="cardNumber">NÚMERO DO CARTÃO</label>

	                               <div class="input-group">

	                                  <input 

	                                     type="text"

	                                     class="form-control required"

	                                     name="card_number"

	                                     id="card_number"

	                                     placeholder="Número válido"

	                                     required autofocus 

	                                     />

	                                  <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

	                               </div>

	                            </div>

	                         </div>

	                      </div>

	                      <div class="row">

	                         <div class="col-md-12">

	                            <div class="form-group">

	                               <label for="cardNumber">NOME NO CARTÃO</label>

	                               <input 

	                                  type="text"

	                                  class="form-control required"

	                                  name="card_name"

	                                  id="card_name"

	                                  placeholder="Nome válido"

	                                  required autofocus 

	                                  />

	                            </div>

	                         </div>

	                      </div>

	                      <div class="row">

	                         <div class="col-xs-7 col-md-7">

	                            <div class="form-group">

	                               <label for="card_validate">DATA EXPIRAÇÃO <smal> (Ex: 12/2024)</smal></label>

	                               <input 

	                                  type="text" 

	                                  class="form-control required" 

	                                  id="card_validate"

	                                  placeholder="MM / AAAA"

	                                  required 

	                                  />

	                            </div>

	                         </div>

	                         <div class="col-xs-5 col-md-5 pull-right">

	                            <div class="form-group">

	                               <label for="cardCVC">CÓDIGO CVV</label>

	                               <input 

	                                  type="text" 

	                                  class="form-control required"

	                                  name="card_cvv"

	                                  id="card_cvv"

	                                  placeholder="CVV"

	                                  required

	                                  />

	                            </div>

	                         </div>

	                      </div>

	                      <div class="row">

	                         <div class="col-xs-12">

	                            <button id="btn-confirmarpagamento" class="subscribe btn btn-success btn-lg btn-block" type="button">CONFIRMAR PAGAMENTO</button>

	                         </div>

	                      </div>

	                      <div class="row" style="display:none;">

	                         <div class="col-xs-12">

	                            <p class="payment-errors"></p>

	                         </div>

	                      </div>

	                   </div>

	                </div>

	             </div>

	          </div>

	       </div>

	       <div class="modal-footer">

	          <button type="button" class="btn btn-default" data-dismiss="modal">FECHAR</button>

	       </div>

	    </div>

	 </div>

</div>



</body>


</html>