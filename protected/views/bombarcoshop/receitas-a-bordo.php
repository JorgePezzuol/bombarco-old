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

           //Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/bombarcoshop/view.js?e='.microtime(), CClientScript::POS_END);

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


      <header role="banner" id="header_site">

         <div class="container">

            <div class="col-md-3">

               <!--<img class="logo-header" src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/logo-bombarco.png'?>" />-->

            </div>

         </div>

      </header>
      <style>
      .no-padding { padding:0!important }
      .img-banner { width:100%; }
      </style> 
<div class="container-fluid no-padding">
     <img alt="img-banner img-responsive" class="img-responsive img-banner" src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/img/cardapio/capa.jpg';?>"/>
     </div>

      <section class="section-about-the-ebook">

         <div class="container">

            <p class="about-ebook-text">

               Não é preciso ser um super chef de cozinha para montar um cardápio que agrade a todos. Mas, cozinhar em um barco, demanda perspicácia ao selecionar ingredientes e receitas práticas, além de saber calcular bem as porções para não faltar suprimentos. Por isso, fizemos esse guia prático para você!

            </p>

           <!-- <div class="wrapper-preco-post-about">

               <div class="col-md-4 left-side-price">por apenas</div>

               <div class="col-md-8 right-side-price">R$ 75,00</div>

            </div>

            <a class="button-comprar-bombarco" href="#">COMPRAR</a>-->

         </div>

      </section>

      <section class="section-contents-list">

         <div class="container">

            <h2 class="title-contents-list">O que você vai encontar neste E-book?</h2>

            <div class="col-md-6 column-contents">

               <ul class="contents-list">

                  <li class="item-list">Saiba como escolher os ingredientes ideais</li>

                  <li class="item-list">Aprenda como calcular suprimentos para levar a bordo</li>

                  <li class="item-list">Descubra o que pode ficar armazenado no barco</li>

                  <li class="item-list">Como guardar e transportar o meu barco?</li>

               </ul>

            </div>

            <div class="col-md-6 column-contents">

               <ul class="contents-list">

                  <li class="item-list">Leve 5 receitas dos Chefs Giba Guanaes (do KeelaWee) e Gisella Schmitt (da Gastromar)</li>

               </ul>

            </div>

         </div>

      </section>

      <section class="form-cadastro-email">

         <div class="container">

         <br/><br/>
          <div id="msg-sucesso" class="alert alert-success" style="display:none;">
            <strong>Successo!</strong> Aproveite
          </div>


            <h3 class="title-form">Para receber o e-book, preencha abaixo e continue recebendo as novidades do Bombarco!</h3>

            <form id="form-cadastro" 

               action="#" 

               method="POST" 

               class="form-cadastro">

               <input type="text" class="campo-form person" id="nome" name="nome" placeholder="Nome" />

               <input type="text" id="email" name="email" class="campo-form mail" placeholder="E-mail" />

               <!--<h3 class="title-cupom">Tem um cupom?</h3>

               <p class="subtitle-cupom">

                  Adicione o código e valide o seu desconto.

               </p>

               <input type="text" id="cupom" name="cupom" class="campo-form cupom" placeholder="Seu Cupom " />-->

               <button id="btn-baixar" type="submit" class="button-comprar-bombarco">BAIXAR</button>

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
</body>
<script>
  $(document).ready(function() {

      $("#btn-baixar").on("click", function(e) {

          e.preventDefault();

          var flgok = true;

          $("#email").css("border-color", "inherit");
          $("#nome").css("border-color", "inherit");

          if(validateEmail($("#email").val()) == false) {
              $("#email").css("border-color", "red");
              flgok = false;
          }

          if($("#nome").val() == "") {
              $("#nome").css("border-color", "red");
              flgok = false;
          }

          if(flgok) {

              $.ajax({
                  url: Yii.app.createUrl("bombarcoshop/cadastrarEmail"),
                  data: {
                    nome: $("#nome").val(),
                    email: $("#email").val(),
                    link: "http://www.bombarco.com.br/bombarcoshop/cardapio"
                  },
                  async: false,
                  type: "POST",
                  success: function(resp) {


                    if(resp == 1) {
                       $("#msg-sucesso").show();
                    }
                    

                  },
                  error: function(x, h,z) {
                      return false;
                  }
              });

              $("#nome").val("");
              $("#email").val("");

              var link = document.createElement("a");
              link.download = "Ebook- Dicas para montar seu cardápio a bordo.pdf";
              link.href = "https://www.bombarco.com.br/public/bombarcoshop/Ebook- Dicas para montar seu cardápio a bordo.pdf";
              document.body.appendChild(link);
              link.click();
              document.body.removeChild(link);
              delete link;
          }
      });


  });
</script>


</html>