<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="author" content="Bombarco - Líder em Negócios Náuticos" />
  <meta name="description" content="<?php echo Embarcacoes::getAlt($modelo) . " " .$modelo->descricao; ?>" />
  <meta name="keywords" content="bombarco, zeromilhas, nautico, lider, marinha, <?php echo Embarcacoes::getAlt($modelo); ?>" />
  <meta name="geo.region" content="BR-SP" />
  <meta name="geo.placename" content="Brasil" />
  <meta name="geo.position" content="-14.2392976,-53.1805017,4z" />
  <meta name="ICBM" content="-14.2392976,-53.1805017,4z" />
  <meta name="robots" content="follow,index" />
  <link rel="shortcut icon" href="/favicon.ico" />
  <title>Catálogo Bombarco | <?php echo Embarcacoes::getAlt($modelo); ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />

  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bootstrap.min.css'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/fancybox.css'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bootstrap-slider.css'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/fancybox-buttons.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/tether.min.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/jquery.ez-plus.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/reset.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bjqs.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/style.css' );?> 

  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/responsive.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/owl.carousel.min.css');?>

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js', CClientScript::POS_END); ?>

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/tether.min.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap.min.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/counter.min.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/numeral.min.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/fancybox.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/fancybox-buttons.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.ez-plus.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-ui.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/owl.carousel.min.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bjqs.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/maskedinput.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap-slider.min.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/vue-2.5.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/axios-0.17.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/contato.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.lightbox_me.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/scripts.js', CClientScript::POS_END); ?>

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/functions_zeromilhas.js', CClientScript::POS_END); ?>

  <script src="https://www.youtube.com/iframe_api"></script>

<style>
  .js-lazyYT{height:225px !important;width:225px !important}
  #lbox-videos .js-lazyYT{height:100% !important;width:100% !important}
  .lazyYT-title{z-index:100 !important;color:#fff !important;font-family:sans-serif !important;font-size:12px !important;top:10px !important;left:12px !important;position:absolute !important;margin:0 !important;padding:.5em !important;line-height:1 !important;font-style:normal !important;font-weight:normal !important;background-color:rgba(0,0,0,0.8) !important;border-radius:.5em !important}
  .lazyYT-button{background:url(http://www.bombarco.com.br/themes/bombarco/img/sprite_v1.png) no-repeat;background-position:-380px -328px;margin:0 !important;padding:0 !important;width:47px !important;height:47px !important;position:absolute !important;top:50% !important;margin-top:-22px !important;left:50% !important;margin-left:-30px !important}.lazyYT-button:hover{background-position:-322px -329px}
  #lbox-videos2 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos3 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos4 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos5 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos6 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos7 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos8 .js-lazyYT{height:100% !important;width:100% !important}
  #lbox-videos9 .js-lazyYT{height:100% !important;width:100% !important}
  .lbox-videos{position:relative;display:block;height:619px;width:1100px;border:solid 1px #cbcbcb;background-color:#fff;-webkit-box-shadow:0 1px 7px -3px #000;-moz-box-box-shadow:0 1px 7px -3px #000;box-shadow:0 1px 7px -3px #000;left:50%;margin-left:-5000px;z-index:1002;position:fixed;top:50%;margin-top:-159px}
  .lbox-videos-full{position:relative;display:block;overflow:hidden;height:100%;width:100%;border:solid 1px #cbcbcb;background-color:#fff;-webkit-box-shadow:0 1px 7px -3px #000;-moz-box-box-shadow:0 1px 7px -3px #000;box-shadow:0 1px 7px -3px #000;left:50%;margin-left:-5000px;z-index:1002;position:fixed;top:50%;margin-top:-159px}
  #lbox-videos-full .js-lazyYT{height:100% !important;width:100% !important}
  .textos-videos-lw4-2{height:150px;width:223px;position:relative;left:262px;bottom:150px}
  .textos-videos-lw4-3{height:150px;width:223px;position:relative;left:507px;bottom:300px}
  .textos-videos-lw4-4{height:150px;width:223px;position:relative;left:752px;bottom:450px}
  .category-deemb { margin-bottom: 70px; }
  .controls-deemb{clear:both;position:relative;width:1014px;width:608px !important;left:0;top:27px !important;right:0;margin:0 auto;z-index:99}.controls-deemb .prev{position:relative;width:30px;height:30px;display:block;float:left}.controls-deemb .prev a{line-height:0;font-size:0;text-indent:-9999px;background:url(http://www.bombarco.com.br/themes/bombarco/img/sprite_v1.png) no-repeat;background-position:-326px -273px;position:relative;width:32px;height:31px;display:block;top:0;-moz-opacity:1;-khtml-opacity:1;-webkit-opacity:1;opacity:1;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);filter:alpha(opacity=100)}.controls-deemb .prev a:hover{-moz-opacity:1;-khtml-opacity:1;-webkit-opacity:1;opacity:1;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);filter:alpha(opacity=100)}
  .controls-deemb .next{position:relative;width:30px;height:30px;display:block;float:right}.controls-deemb .next a{line-height:0;font-size:0;text-indent:-9999px;background:url(../img/sprite_v1.png) no-repeat;background-position:-285px -273px;position:relative;width:32px;height:31px;display:block;top:0;-moz-opacity:1;-khtml-opacity:1;-webkit-opacity:1;opacity:1;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);filter:alpha(opacity=100)}.controls-deemb .next a:hover{-moz-opacity:1;-khtml-opacity:1;-webkit-opacity:1;opacity:1;-ms-filter:progid:DXImageTransform.Microsoft.Alpha(opacity=100);filter:alpha(opacity=100)}
  .slide-deemb2{margin-top:10px;margin-left:25px}
  .slide-deemb,.slide-deemb2{display:inline-block;*display:inline;zoom:1;letter-spacing:normal;word-spacing:normal;vertical-align:top;text-rendering:auto;width:100%}.slide-deemb .lazyYT-button:hover,.slide-deemb2 .lazyYT-button:hover{background-position:-380px -328px}
  .slide-deemb .category-deemb,.slide-deemb2 .category-deemb{overflow:hidden;display:inline-block;vertical-align:top;margin:0;position:relative;background-color:#fff;height:78px !important;width:78px !important;margin-right:20px; border:1px solid #e2e2e2 }
  .slide-deemb .category-deemb:hover .img-deemb-slide,.slide-deemb2 .category-deemb:hover .img-deemb-slide{-webkit-transform:scale(1.1);-moz-transform:scale(1.1);-ms-transform:scale(1.1);-o-transform:scale(1.1)}
  .slide-deemb .category-deemb a,.slide-deemb2 .category-deemb a{display:block;float:left;display:inline-block;*display:inline;zoom:1;letter-spacing:normal;word-spacing:normal;vertical-align:top;text-rendering:auto;width:100%}
  .slide-deemb .category-deemb .img-deemb-slide,.slide-deemb2 .category-deemb .img-deemb-slide{width:80px;height:auto;}
  #fechar-video { margin-left: 30px;}
  .ajustar-img { margin: 0 auto;max-width: 30%; }
  .materia-zeromilhas { display:flex; align-items:center;justify-content: space-around;flex-direction: inherit;min-height: 185px;}
  .materia-zeromilhas img { width: 200px;}
  #destaque .card-img-top { width: 200px; height: 120px; max-height: 100%; background-repeat: no-repeat; background-position: left center; background-size: contain; padding: 0; }
  .pure-u-1, .pure-u-1-2, .pure-u-1-3, .pure-u-2-3, .pure-u-1-4, .pure-u-3-4, .pure-u-1-5, .pure-u-2-5, .pure-u-3-5, .pure-u-4-5, .pure-u-1-6, .pure-u-5-6, .pure-u-1-8, .pure-u-3-8, .pure-u-5-8, .pure-u-7-8, .pure-u-1-12, .pure-u-5-12, .pure-u-7-12, .pure-u-11-12, .pure-u-1-24, .pure-u-5-24, .pure-u-7-24, .pure-u-11-24, .pure-u-13-24, .pure-u-17-24, .pure-u-19-24, .pure-u-23-24 { display: inline-block; zoom: 1; letter-spacing: normal; word-spacing: normal; vertical-align: top; text-rendering: auto;}
    .zoomWindow { cursor:-webkit-zoom-in!important; cursor:-moz-zoom-in!important; border:none!important;}
  .img-principal { height:auto; border:1px solid transparent; background:transparent; position:relative; }
  .quadro-l1-deemb5 { vertical-align: top; width: 800px; display: inline-block; position: relative; }
  .quadro-l1-deemb5 .bg-img-slide-deemb { max-width: 100%; width: auto; height: auto; max-height: 100%; position: static; top: inherit; left: inherit; float: none; margin-left: auto; margin-right: auto; display: block; width: 800px; }
  .bg-img-slide-deemb { width: 800px; height: auto; position: relative; top: 1px; left: 1px; }
  .quadro-l1-deemb5 a { height: 500px; overflow: hidden; float: left; width: 100%; display: flex; align-items: center; background: rgba(255, 255, 255, 0.65); border:1px solid #f7f7f7 }
  .quadro-l1-deemb5 .box-video { width: 100%; height: 410px; position: absolute; top: 0; z-index: 999; display: none; }
 
  @media (max-width:1440px) { .bg-imagem { background-position-y: -18%; } }
  @media (max-width:690px) { 
    #destaque .card-img-top { max-height: 80px!important; } 
    .quadro-l1-deemb5 .bg-img-slide-deemb, .quadro-l1-deemb5 a { max-height:250px; margin:0; }
    .galeria-owl { display: table; width: 99%; margin: 0 auto; }
    .galeria-owl .col-lg-12 { padding:0 4px; margin-left: 2px; }
    #destaque .owl-carousel.owl-loaded { max-width: 80%; margin: 1em auto; display: table; }
    .owl-carousel.owl-carousel-thumbs.owl-loaded.owl-drag .owl-item { max-height: 80px; }
    figure.anuncio-lateral { margin: 5em auto!important; display: table!important; }
  }
</style> 

<!-- Permite que o IE interprete as tags do HTML 5 -->
<!--[if lt IE 9]>
<script src="media/http://html5shim.googlecode.com/svn/trunk/html5.js?e=344"></script>
<link rel="stylesheet" type="text/css" href="http://domain.tld/path/ie-specific.css" />
<![endif]-->

<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800,900" rel="stylesheet">
<?php $this->renderPartial('analytics'); ?>

</head> <!-- FIM HEAD -->

<body id="topo" class="side-collapse-container">
    <div id="app">
    <?php $this->renderPartial('_menu'); ?>

    <section id="titulo">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <a href="javascript:history.back()" class="btn btn-padrao-branco borda-cinza pull-left"><i class="fa fa-angle-left"></i> voltar</a>
            <ul class="breadcumbs">
            <li><a href="/catalogo">catálogo</a></li>
            <li>    
            <?php $slug_categoria = $modelo->embarcacaoModelos->embarcacaoTipos->slug; ?>
            <?php if($slug_categoria == "2-passageiros"): ?>
            <?php $slug_categoria = "jet-ski"; ?>
            <?php endif; ?>
            <?php $href = "/catalogo?categoria=".$slug_categoria; ?>
            <a href="/catalogo?categoria=<?php echo $slug_categoria;?>">
            <?php echo $modelo->embarcacaoModelos->embarcacaoTipos->titulo;?></a>
            </li>
            <li>
            <a disabled="disabled"><?php echo Embarcacoes::getAlt($modelo); ?></a>
            </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

  <!-- Destaques -->
  <section id="destaque" class="bg-imagem">
    <div class="container">

      <!-- mobile -->
      <div class="row">
        <div class="col-lg-8 col-sm-12 quadro-l1-deemb5" id="div-img">
          <div class="text-left hidden-md-up">
            <?php $imagem = Yii::app()->baseUrl . '/public/fabricantes/' . $modelo->embarcacaoFabricantes->logo; ?>
            <?php if($imagem != "/public/fabricantes/"): ?>
            <div class="card-img-top">
              <img style="width:200px; height:80px;" src="<?php echo $imagem; ?>" class="img-fluid bitmap" alt="Marca" />
            </div>
            <?php endif; ?>
              
            <h2><?php echo $modelo->embarcacaoModelos->embarcacaoFabricantes->titulo; ?></h2>
            <h1><?php echo $modelo->embarcacaoModelos->titulo; ?></h1>
            <?php 
              if ($modelo->valor != '0.00') {
                echo '<h1>R$ ' . Utils::formataValorView((float) $modelo->valor).'</h1>';
              } 
            ?>
          </div>

          <?php //$imagem = Yii::app()->request->baseUrl.'/public/embarcacoes/'.$modelo->imagemprincipal; ?>
          <?php //if($imagem == "/public/embarcacoes/"): ?>
          <?php //$imagem = "/img/sem_foto_bb.jpg"; ?>
          <?php //endif; ?>

          <?php $imagem = EmbarcacaoImagens::obterImgPrincipalAbs($modelo->id); ?>                   



          <div class="zoom-wrapper">
          <div class="zoom-left">
          <div class="box-video">

          </div>
          <a class="img-principal pure-u-1">
            <img class="bg-img-slide-deemb zoom-img" id="zoom_03" src="<?php echo $imagem; ?>" data-zoom-image="<?php echo $imagem; ?>" />
          </a>
          <!--<video preload="none" loop="loop" autoplay="autoplay" style="max-width: 100%;"><source src="media/videos/loop.mp4" type="video/mp4"> </video> -->
          </div></div>

          <?php if(count($modelo->embarcacaoImagens) > 1): ?>
          <div class="row hidden-md-up galeria-owl">
          <div class="col-lg-12 col-sm-12">
            <ul class="owl-carousel owl-carousel-thumbs" id="gallery_01" >

              <?php foreach($modelo->embarcacaoImagens as $img): ?>
              
              <?php $src = Yii::app()->request->baseUrl . '/public/embarcacoes/' . $img->imagem; ?>
              <?php if($src != "/public/embarcacoes/"): ?>
                <li><a @click.stop.prevent="mudarImagem($event)" class="elevatezoom-gallery" data-image="<?php echo $src; ?>" data-zoom-image="<?php echo $src; ?>" class="slide-content"><img src="<?php echo $src; ?>"/></a></li>
              <?php endif; ?>
                    
              <?php endforeach; ?>
                
              <?php if($modelo->video != null): ?>
                <!--<li><a @click.stop.prevent="mudarImagem($event)" class="elevatezoom-gallery active" data-update="" data-image="media/videos/bg.jpg" data-zoom-image="media/videos/bg.jpg"><iframe width="144" height="80" src="<?php //echo $modelo->video; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></a></li>-->

                <li class="category-deemb">
                <a href="#" class="ax-track-event" data-ax-trackname="detalhe galeria video">
                <div class="lazyYT-button" data-video="<?php echo $modelo->video; ?>"></div>
                </a>
                </li>
                
              <?php endif; ?>

            </ul>
          </div>
          </div>
          <?php endif; ?>
          </div>
          <div class="col-lg-4 col-sm-12">
            <div class="card">
              <div class="card-flutuante hidden-md-down">
            <?php $imagem = Yii::app()->baseUrl . '/public/fabricantes/' . $modelo->embarcacaoFabricantes->logo; ?>
            <?php if($imagem != "/public/fabricantes/"): ?>
                <div class="card-img-top" style="background-image:url(<?php echo $imagem; ?>);"></div>
            <?php endif; ?>
              <h2><?php echo $modelo->embarcacaoModelos->embarcacaoFabricantes->titulo; ?></h2>
              <h1><?php echo $modelo->embarcacaoModelos->titulo; ?></h1>
              <?php
                  if ($modelo->valor != '0.00') {
                      echo '<h1>R$ ' . Utils::formataValorView((float) $modelo->valor).'</h1>';
                  } 
              ?>
              </div>
              <div class="card-block">
                <div class="quadro">
                  <div class="row">

                    <div class="col-md-6 col-sm-12">
                      <a href="<?php echo Zeromilhas::mountUrlOfertas($modelo); ?>" target="_blank" class="btn btn-padrao-branco w-100 text-left"><span class="pull-left">ofertas </span><i class="fa fa-angle-right pull-right"></i></a>
                    </div>

                    <div class="col-md-6 col-sm-12">
                      <a href="<?php echo Zeromilhas::mountUrlTabela($modelo); ?>" target="_blank" class="btn btn-padrao-branco w-100 text-left"><span class="pull-left">tabela </span><i class="fa fa-angle-right pull-right"></i></a>
                    </div>

                    <hr/>

                    <div class="col-lg-12">
                      <a href="#" @click.stop.prevent="abrirModalPergunta($event)" class="card-link w-100"><h4 class="card-title">consórcio, transporte e arrais <i class="fa fa-angle-down"></i></h4></a>
                    </div>

                    <hr/>
                  </div>
                </div>
                <div class="card-footer">
                  <a href="#" @click.stop.prevent="abrirModalPergunta($event)" class="btn btn-padrao-azul text-center"><span class="pull-left">enviar mensagem </span><i class="fa fa-envelope-o pull-right"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- desktop -->
        <?php if(count($modelo->embarcacaoImagens) > 1): ?>

        <div class="row hidden-md-down">
          <div class="col-lg-8 col-sm-12">
            <ul class="owl-carousel owl-carousel-thumbs" id="gallery_01" >

                <?php foreach($modelo->embarcacaoImagens as $img): ?>

                    <?php $src = Yii::app()->request->baseUrl . '/public/embarcacoes/' . $img->imagem; ?>

                    <?php if($src != "/public/embarcacoes/"): ?>
                        <li>
                            <a @click.stop.prevent="mudarImagem($event)" class="elevatezoom-gallery" data-image="<?php echo $src; ?>" data-zoom-image="<?php echo $src; ?>" class="slide-content">
                                <?php 
                                    $data = getimagesize("https://www.bombarco.com.br".$src);
                                    $width = $data[0];
                                    $height = $data[1];
                                    // @@
                                ?>
                                <img data-height="<?php echo $height; ?>" data-width="<?php echo $width; ?>" src="<?php echo $src; ?>"/>
                            </a>
                        </li>
                    <?php endif; ?>

                <?php endforeach; ?>
                

                <?php if($modelo->video != null): ?>
                    <?php //$video = substr($modelo->video, strrpos($modelo->video, '/') + 1); ?>
                    <!--<li><a @click.stop.prevent="mudarImagem($event)" class="elevatezoom-gallery active" data-update="" data-image="media/videos/bg.jpg" data-zoom-image="media/videos/bg.jpg"><iframe width="144" height="80" src="<?php //echo $modelo->video; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></a></li>-->

                    <li class="category-deemb">
                      <a href="#" class="ax-track-event" data-ax-trackname="detalhe galeria video">
                      <div class="lazyYT-button" data-video="<?php echo $modelo->video; ?>"></div>
                      </a>
                    </li>
                <?php endif; ?>

                  

                  </ul>
                </div>
              </div>
            <?php endif; ?>
            </div>
          </section>


          <!-- Destaque -->
          <section id="menu-detalhes">
            <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <nav class="navbar navbar-toggleable-md navbar-light nav-detalhes">
                    <div class="navbar-collapse" id="navDetalhes">
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                          <a class="nav-link" href="#">Visão Geral</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#espec">Especificações Técnicas</a>
                        </li>
                        <?php if(count($materiasRelacionadas) > 0): ?>
                        <li class="nav-item">
                          <a class="nav-link" href="#materias">Matérias</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item">
                          <a class="nav-link" @click.stop.prevent="abrirModalPergunta($event)" href="#">Parceiros</a>
                        </li>
                        <?php if(count($semelhantes) > 0): ?>
                        <li class="nav-item">
                          <a class="nav-link" href="#semelhantes">Embarcações Semelhantes</a>
                        </li>
                        <?php endif; ?>
                      </ul>
                      <form class="form-inline my-2 my-lg-0">
                        <a href="#" @click.stop.prevent="abrirModalPergunta($event)" class="btn-enviar-msg btn btn-padrao-azul-invert"><span class="pull-left">enviar mensagem </span><i class="fa fa-envelope-o"></i></a>
                      </form>
                    </div>
                  </nav>
                </div>
              </div>
            </div>
          </section>

          <section id="dados-produto">
            <div class="container">
              <div class="row">
                <div class="col-lg-9 col-md-8 col-sm-12">

                <?php if($modelo->descricao != ""): ?>
                  <div id="visao-geral" class="conteudo">
                    <h3>Descrição da <?php echo Embarcacoes::getAlt($modelo);?></h3>
                    <p><?php echo $modelo->descricao; ?></p>
                  </div>
                <?php endif; ?>

                  <a name="espec" id="espec"></a>
                  <div id="especificacoes-tecnicas" class="conteudo">
                    <h3>Especificações Técnicas</h3>
                    <table class="table-striped zebrada">
                      <tbody>

                        <?php if($modelo->embarcacaoModelos->tamanho > 0.00): ?>
                            <tr>
                              <td>
                                Comprimento
                                <span><?php echo (float)$modelo->embarcacaoModelos->tamanho. " pés"; ?></span>
                              </td>
                            </tr>
                        <?php endif; ?>

                        <?php if($modelo->embarcacaoModelos->boca > 0.00): ?>
                        <tr>
                          <td>
                            Boca 
                            <span><?php echo (float)$modelo->embarcacaoModelos->boca . " metros"; ?></span>
                          </td>
                        </tr>
                        <?php endif; ?>

                        <?php if($modelo->embarcacaoModelos->calado > 0.00): ?>
                        <tr>
                          <td>
                            Calado Máximo
                            <span><?php echo (float)$modelo->embarcacaoModelos->calado. " metros"; ?></span>
                          </td>
                        </tr>
                        <?php endif; ?>

                        <?php if($modelo->embarcacaoModelos->pesocasco > 0.00): ?>
                        <tr>
                          <td>
                            Peso do casco
                            <span><?php echo (float)$modelo->embarcacaoModelos->pesocasco. " Kg"; ?></span>
                          </td>
                        </tr>
                        <?php endif; ?>

                        <tbody>
                        </table>
                        <table class="table-striped zebrada zebrada-invert">
                          <tbody>

                        <?php if($modelo->embarcacaoModelos->tanqueagua > 0.00): ?>

                            <tr>
                              <td>
                                Tanque de Água
                                <span><?php echo (float)$modelo->embarcacaoModelos->tanqueagua . " Litros"; ?></span>
                              </td>
                            </tr>
                        <?php endif; ?>

                        <?php if($modelo->embarcacaoModelos->passageiros > 0.00): ?>
                        <tr>
                          <td>
                            Qtde passageiros dia
                            <span><?php echo (float)$modelo->embarcacaoModelos->passageiros. " pessoas"; ?></span>
                          </td>
                        </tr>
                        <?php endif; ?>


                        <?php if($modelo->embarcacaoModelos->acomodacoes > 0.00): ?>
                        <tr>
                          <td>
                            Qtde passageiros noite
                            <span><?php echo (float)$modelo->embarcacaoModelos->acomodacoes. " pessoas"; ?></span>
                          </td>
                        </tr>
                        <?php endif; ?>

                       
                        <?php if($modelo->embarcacaoModelos->nbanheiros > 0): ?>
                        <tr>
                          <td>
                            Número de banheiros
                            <span><?php echo (float)$modelo->embarcacaoModelos->nbanheiros; ?></span>
                          </td>
                        </tr>
                        <?php endif; ?>



                          </tbody>
                        </table>
                      </div>


                          <!--<div id="itens-serie" class="conteudo no-border">
                            <h3>Itens da Série</h3>
                            <p>sadsadasd</p>
                          </div>-->
                    

                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-12">
                      <figure class="anuncio-lateral">
                        <?php echo Banners::loadBanner(Banners::LATERAL, null, array('width'=>230, 'height'=>450), true); ?>
                        <figcaption>publicidade</figcaption>
                      </figure>
                    </div>



                  </div>
                </div>
              </section>

              <!-- Matérias -->
              <?php $count = count($materiasRelacionadas); ?>
              <?php if($count > 0): ?>
              <a name="materias"></a>
              <section id="materias" class="bg-faded">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-7 col-sm-12 title">
                      <h3>Matérias Relacionadas</h3>
                    </div>


                    <?php foreach($materiasRelacionadas as $index => $materia): ?>
                        <?php $texto = preg_replace('/[^a-zA-Z0-9\s]/', '', strip_tags(html_entity_decode($materia->texto)));?>
                        <div class="col-lg-6 col-sm-12">
                          <div class="well materia-zeromilhas">
                            <?php if ($materia->conteudoImagens != null): ?>
                                <img src="<?php echo Yii::app()->baseUrl ?>/public/conteudos/<?php echo $materia->conteudoImagens[0]->imagem; ?>" alt="Matéria" />
                            <?php endif; ?>
                            <span class="">
                            <h2><?php echo $materia->titulo; ?></h2>
                            <p><?php echo substr($texto, 0, 150) . "...";?></p>
                            <a target="_blank" href="<?php echo Conteudos::mountUrl($materia)?>" class="card-link leia-mais">ler matéria completa <i class="fa fa-angle-right"></i></a>
                          </span>
                          </div>
                        </div>

                    <?php endforeach;?>
                  </div>
                </div>
              </section>
              <?php endif; ?>

              		<!-- pog parceiros -->
              		<?php
					    // id do usuario dono da embarcação
					    $usuarioDonoEmbarc = UsuariosEmbarcacoes::model()->find('embarcacoes_id = :embarcacoes_id', array(':embarcacoes_id' => $modelo->id));
					    $user = Usuarios::model()->findByPk($usuarioDonoEmbarc->usuarios_id);
					    $idUsuarioDonoEmbarc = $usuarioDonoEmbarc->usuarios_id;
					    $nome_destinatario = ($user->pessoa == 'J') ? $user->nomefantasia : $user->nome;
			            $email_dest = $user->email;
			            if($nome_destinatario == "") {
			                $emp = Empresas::model()->find("usuarios_id=:usuarios_id", array(":usuarios_id"=>$idUsuarioDonoEmbarc));
			                if($emp != null) {
			                    $nome_destinatario = $emp->nomefantasia;
			                }
			            }

			            $emailEmbarcacao = $modelo->email;
			            if($emailEmbarcacao == "") {
			            	$emailEmbarcacao = Usuarios::model()->findByPk($idUsuarioDonoEmbarc)->email;
			            }

					    echo CHtml::hiddenField('idUsuarioDonoEmbarc', $idUsuarioDonoEmbarc, array('id' => 'idUsuarioDonoEmbarc'));
					    // id da embarcação
					    echo CHtml::hiddenField('idEmbarcacao', $modelo->id, array('id' => 'idEmbarcacao'));
					    // email da embarcação
					    echo CHtml::hiddenField('emailEmbarcacao', $emailEmbarcacao, array('id' => 'emailEmbarcacao'));
					    // nome destinatário
					    echo CHtml::hiddenField('nome_destinatario', $nome_destinatario, array('id' => 'nome-contato'));

                        echo CHtml::hiddenField('titulo', Embarcacoes::getAlt($modelo), array('id' => 'titulo-embarc'));

                        //$link_detalhe = Zeromilhas::gerarLinkDetalhe($modelo->id, $modelo->slug);
                        $link_detalhe = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

                        echo CHtml::hiddenField('link_detalhe', $link_detalhe, array('id' => 'link_detalhe'));

                        echo CHtml::hiddenField('valor', $modelo->valor, array('id' => 'valor'));

					?>
					<input type="text" name="j8BSVuvy" class="j8BSVuvy" value="" style="display:none !important;" />
              		<!-- fim pog -->
              

                      <!-- Parceiros -->
                      <a name="enviarMsg" id="enviarMsg"></a>
                      <section id="parceiros" class="bg-faded">
                        <div class="container">
                          <div class="row">
                            <div class="col-lg-7 col-sm-12 title">
                              <h3>Parceiros</h3>
                            </div>
                          </div>

                          <div class="row justify-content-center">
                            <div class="col-lg-4 col-sm-12 parceiros">
                            	<div class="well disabled box-parceiro" data-form="form_cons">
                                <img src="/img/logo-unifisa-novo.png" alt="Parceiro" />
                                <div class="ajusta-altura"><a class="card-link"><small>Consórcio por</small> Unifisa Consórcio <i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                              <!--<div class="well disabled box-parceiro" data-form="form_marina">
                                <img style="display:none;" src="/img/logo-unifisa-novo.png" alt="Parceiro" />-
                                <div style="width:200px;height:150px;">&nbsp;</div>
                                <div class="ajusta-altura"><a class="card-link"><small>Encontre uma marina</small> Preço de marina <i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>-->
                              <div class="well disabled box-parceiro" data-form="form_trans">
                                <img src="/img/transporte2.jpg" alt="Parceiro" />
                                <!--<div style="width:200px;height:150px;">&nbsp;</div>-->
                                <div class="ajusta-altura"><a class="card-link"><small>Ajudamos a transportar</small> Transporte <i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                              <div class="well disabled box-parceiro">
                                <img src="/img/arrais-amador.jpg" alt="Parceiro" />
                                <!--<div style="width:200px;height:150px;">&nbsp;</div>-->
                                <div class="ajusta-altura"><a class="card-link"><small>Arrais</small> amador, mestre ou capitão <i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>

                            <div class="col-lg-4 col-sm-12 hidden-md-down divForm">
                              <!-- Este form será repetido para cada parceiro sem a classe active (selecionado ao lado) -->
                              <form id="contatoParceiro" class="form-branco show">
                                <p>Fale diretamente com nossos parceiros e tire suas dúvidas</p>
                                <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                  <input type="text" class="form-control" id="inputNomeParceiro" placeholder="Nome*" required />
                                </div>
                                <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                  <input type="email" class="form-control" id="inputEmailParceiro" placeholder="E-mail*" required />
                                </div>
                                <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                  <input type="text" class="form-control" id="inputTelefoneParceiro" placeholder="Telefone*" required />
                                </div>
                                <div class="form-group input-group">
                                  <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                                  <textarea class="form-control" id="inputMensagemParceiro" rows="8" placeholder="Olá, gostaria de mais informações sobre a embarcação."></textarea>
                                </div>

                                <a href="#" id="btn-contato-parceiro" class="btn btn-padrao-azul text-left w-100"><span class="pull-left">enviar mensagem </span><i class="fa fa-envelope pull-right"></i></a>

                              </form>
                            </div>
                          </div>
                        </section>

                        <!-- Semelhantes -->
                        <?php if(count($semelhantes) > 0): ?>
                        <a name="semelhantes" id="semelhantes"></a>

                        <section id="semelhantes" class="bg-faded">
                          <div class="container">
                            <div class="row">
                              <div class="col-lg-7 col-sm-12 title">
                                <h3>Embarcações Semelhantes</h3>
                              </div>

                              <div class="col-lg-12 col-sm-12">
                                <div class="row noticias owl-carousel owl-carousel-semelhantes">

                                    <?php foreach($semelhantes as $sem): ?>
                                        <?php $imagem = EmbarcacaoImagens::obterImgPrincipalAbs($sem['id']); ?>
                                        <?php if($imagem == "/public/embarcacoes/"): ?>
                                            <?php $imagem = "/img/sem_foto_bb.jpg"; ?>
                                        <?php endif; ?>
                                        <a href="<?php echo Zeromilhas::gerarLinkDetalhe($sem['id'], $sem['slug']);?>">
                                            <div class="card">
                                              <div class="card-img-top">
                                                <img src="<?php echo $imagem; ?>" class="img-fluid bitmap" alt="<?php echo $sem['titulo'];?>" />
                                              </div>
                                              <span class="card-block">
                                                <h2><?php echo $sem['fabricante'];?></h2>
                                                <h1><?php echo $sem['modelo'];?></h1>
                                              </span>
                                            </div>
                                        </a>
                                    <?php endforeach; ?>

                                </div>
                                <!--<div class="row justify-content-center">
                                  <div class="col-lg-4 col-md-6 col-sm-12">
                                    <a href="#" class="btn btn-padrao-branco text-left w-100 espaco2"><span class="pull-left">ver todas semelhantes </span><i class="fa fa-angle-right pull-right"></i></a>
                                  </div>
                                </div>-->
                              </div>
                            </div>
                          </div>
                        </section>
                        <?php endif; ?>
    <!-- fim listagem -->
    <!-- pog -->
    <?php
    // cookies
        $email = Yii::app()->request->cookies->contains('email') ? Yii::app()->request->cookies['email']->value : "";
        $celular = Yii::app()->request->cookies->contains('celular') ? Yii::app()->request->cookies['celular']->value : "";
        $nome = Yii::app()->request->cookies->contains('nome') ? Yii::app()->request->cookies['nome']->value : "";
    ?> 
    <div style="display:none;">
        <form id="form_finan" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
            <div class="form-nome-ag">
                <input name="finan_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1 contatos_parceiros" value="<?php echo $nome; ?>" type="text" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="finan_email" placeholder="Seu e-mail*" class="terms-ag-1 contatos_parceiros" type="email" value="<?php echo $email; ?>" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="finan_phone" placeholder="Seu telefone*" class="terms-ag-1 contatos_parceiros" type="tel" value="<?php echo $celular; ?>" required="required">
            </div>
            
            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />
            <input type="submit" data-form="form_finan" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form envelope-envia" value="SOLICITAR CONTATO" />
            <input type="hidden" name="finan_id" class="parceiro_embarc_id" value="<?php echo $modelo->id; ?>" />
            <input type="hidden" name="finan_titulo" class="parceiro_titulo"  value="<?php echo Embarcacoes::getAlt($modelo); ?>" />
            <input type="hidden" name="finan_valor" class="parceiro_valor" value="<?php echo $modelo->valor; ?>" />
            <input type="hidden" name="finan_link" class="parceiro_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
            <input type="hidden" name="finan_parceiro" value="Alfa Financeira" />
            <input type="hidden" name="partner_type" value="finan" />
        </form>

        <form id="form_trans" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST">
            <div class="form-nome-ag">
                <input name="trans_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1" value="<?php echo $nome; ?>" type="text" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="trans_email" placeholder="Seu e-mail*" class="terms-ag-1" type="email" value="<?php echo $email; ?>" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="trans_phone" placeholder="Seu telefone*" class="terms-ag-1" type="tel" value="<?php echo $celular; ?>" required="required">
            </div>
            
            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />
            <input type="submit" data-form="form_trans" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" />
            <input type="hidden" name="trans_id" class="parceiro_embarc_id" value="<?php echo $modelo->id; ?>" />
            <input type="hidden" name="trans_titulo" class="parceiro_titulo" value="<?php echo Embarcacoes::getAlt($modelo); ?>" />
            <input type="hidden" name="trans_valor" class="parceiro_valor" value="<?php echo $modelo->valor; ?>" />
            <input type="hidden" name="trans_link" class="parceiro_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
            <input type="hidden" name="trans_parceiro" value="Transporte " />
            <input type="hidden" name="partner_type" value="trans" />
        </form>

        <form id="form_marina" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
            <div class="form-nome-ag">
                <input name="marina_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1 contatos_parceiros" value="<?php echo $nome; ?>" type="text" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="marina_email" placeholder="Seu e-mail*" class="terms-ag-1 contatos_parceiros" type="email" value="<?php echo $email; ?>" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="marina_phone" placeholder="Seu telefone*" class="terms-ag-1 contatos_parceiros" type="tel" value="<?php echo $celular; ?>" required="required">
            </div>
            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />

            <input type="submit" data-form="form_marina" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" />
            <input type="hidden" name="marina_id" class="parceiro_embarc_id" value="<?php echo $modelo->id; ?>" />
            <input type="hidden" name="marina_titulo" class="parceiro_titulo" value="<?php echo Embarcacoes::getAlt($modelo); ?>" />
            <input type="hidden" name="marina_valor" class="parceiro_valor" value="<?php echo $modelo->valor; ?>" />
            <input type="hidden" name="marina_link" class="parceiro_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
            <input type="hidden" name="marina_parceiro" value="Preço de Marina" />
            <input type="hidden" name="partner_type" value="marina" />
        </form>

        <form id="form_cons" action="<?php echo Yii::app()->createUrl('contatos/partners'); ?>" method="POST" class="data-ax-form">
            <div class="form-nome-ag">
                <input name="cons_nome" placeholder="Seu nome*" id="form-1-ag-lb" class="nome terms-ag-1 contatos_parceiros" value="<?php echo $nome; ?>" type="text" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="cons_email" placeholder="Seu e-mail*" class="terms-ag-1 contatos_parceiros" type="email" value="<?php echo $email; ?>" required="required">
            </div>
            <div class="form-nome-ag">
                <input name="cons_phone" placeholder="Seu telefone*" class="terms-ag-1 contatos_parceiros" type="tel" value="<?php echo $celular; ?>" required="required">
            </div>
            <input type="text" name="C7RiUSGm" class="honey_pot" value="" style="display:none !important;" />

            <input type="submit" data-form="form_cons" name="botao-cadastrar-form" class="botao_contato_partners botao-cadastrar-form" value="SOLICITAR CONTATO" />
            <input type="hidden" name="cons_id" class="parceiro_embarc_id" value="<?php echo $modelo->id; ?>" />
            <input type="hidden" name="cons_titulo" class="parceiro_titulo" value="<?php echo Embarcacoes::getAlt($modelo); ?>" />
            <input type="hidden" name="cons_valor" class="parceiro_valor" value="<?php echo $modelo->valor; ?>" />
            <input type="hidden" name="cons_link" class="parceiro_link" value="<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" />
            <input type="hidden" name="cons_parceiro" value="Unifisa" />
            <input type="hidden" name="partner_type" value="cons" />
        </form>
    </div>
    <!-- fim pog -->

    <!-- modal -->
    <div class="modal fade" id="fazerPergunta" tabindex="-1" role="dialog" aria-labelledby="fazerPergunta" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="fazerPergunta"></h5>
            <button type="button" class="close" id="fechaModal" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h1>Fazer uma pergunta ao anunciante</h1>
            <h2>Tire suas dúvidas sobre esta embarcação</h2>
            <form method="post" class="form-login">
              <div class="row">
                <div class=" col-lg-6 col-sm-12">
                  <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-user-o"></i></span>
                    <input style="height:46px !important;" type="text" class="form-control required" id="primeiroNome" value="<?php echo $nome;?>" placeholder="Seu nome" required />
                  </div>
                  <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
                    <input style="height:46px !important;" type="email" class="form-control required" id="inputEmail" value="<?php echo $email;?>" placeholder="Seu e-mail" required />
                  </div>
                  <div class="form-group input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input style="height:46px !important;" type="tel" class="form-control required" id="inputTelefone" value="<?php echo $celular;?>" placeholder="Seu telefone" required />
                  </div>
                </div>
                <div class=" col-lg-6 col-sm-12">
                  <div class="form-group input-group campo-mensagem">
                    <span class="input-group-addon"><i class="fa fa-comments"></i></span>
                    <textarea class="form-control required" id="inputMensagem" rows="8">Olá, gostaria de mais informações sobre a embarcação.</textarea>
                  </div>
                </div>
                <div class=" col-lg-12 col-sm-12">
                  <span class="erro-pergunta" style="color:red; display:none;">Preencha todos os campos!</span>
                  <p>Quero receber também informações sobre: </p>
                  <div class="row">
                    <div class="form-check checkbox col-lg-3">
                      <input type="checkbox" data-form="form_cons" class="checkbox_partners form-check-input check-servico" value="1" id="qroConsorcio">
                      <label class="form-check-label" for="qroConsorcio">
                        Consórcio
                      </label>
                    </div>
                    <!--<div class="form-check checkbox col-lg-3">
                      <input v-model="check_financiamento" type="checkbox" class="checkbox_partners form-check-input check-servico" value="1" id="qroFinanciamento">
                      <label class="form-check-label" for="qroFinanciamento">
                        Financiamento
                      </label>
                    </div>-->             
                    <!--<div class="form-check checkbox col-lg-3">
                      <input data-form="form_marina" type="checkbox" class="checkbox_partners form-check-input check-servico" value="1" id="qroMarina">
                      <label class="form-check-label" for="qroMarina">
                        Preço de Marina
                      </label>
                    </div>-->              
                    <div class="form-check checkbox col-lg-3">
                      <input data-form="form_trans" type="checkbox" class="checkbox_partners form-check-input check-servico" value="1" id="qroTransporte">
                      <label class="form-check-label" for="qroTransporte">
                        Transporte
                      </label>
                    </div>
                    <div class="form-check checkbox col-lg-3">
                      <input data-form="form_trans" type="checkbox" class="form-check-input check-servico" value="1" id="qeroArrais">
                      <label class="form-check-label" for="qeroArrais">
                        Arrais amador, mestre ou capitão
                      </label>
                    </div>
                    <br/>
                    <div class="form-check checkbox col-lg-12">
                      <input type="checkbox" class="form-check-input check-servico" value="1" id="quero_receber">
                      <label class="form-check-label" for="quero_receber">
                        Desejo receber informações exclusivas por e-mail
                      </label>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <a href="#" id="btn-contato-anunciante_principal" class="btn btn-verde btn-large text-left">enviar mensagem <i class="fa fa-envelope-o pull-right azul"></i></a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- fim modal -->


    <?php $this->renderPartial("_marcas"); ?>

      <!-- Newsletter -->
      <section id="newsletter">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
              <form class="form-newsletter form-inline">
                <h6 class="h6-news"><i class="ico"></i> Acompanhe o Bombarco</h6>
                <div class="input-group input-news">
                  <span class="input-group-addon" id="email-news"><i class="fa fa-envelope"></i></span>
                  <input v-model="emailnews" type="text" class="form-control" placeholder="Receba nossa newsletter" aria-describedby="email-news">
                  <a href="#" @click.stop.prevent="newsLetter()" class="btn btn-link"><i class="fa fa-angle-right"></i></a>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                <form class="form-newsletter">
                  <h6 class="h6-redes"><i class="ico"></i> Siga-nos e mantenha contato</h6>
                  <ul class="redes">
                    <li><a href="mailto:atendimento@bombarco.com.br" alt="Contato Direto"><i class="fa fa-envelope"></i></a></li>
                    <li><a href="http://www.twitter.com/bombarco" class="Siga-nos no Twitter"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="http://www.facebook.com/bombarco" class="Siga-nos no Facebook"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="http://www.linkedin.com/company/bombarco" class="Siga-nos no Linkedin"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="http://www.instagram.com/bombarco" class="Siga-nos no Instagram"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                </div>
              </section>

              <footer>
                <div class="container">
                  <div class="row">
                    <div class="col-xl-3 col-md-3 col-sm-6">
                      <div class="bloco">
                        <h4>Classificados</h4>
                        <ul class="links">
                          <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/lanchas-a-venda'); ?>">Lanchas</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/veleiros-a-venda'); ?>">Veleiros</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/jet-skis-a-venda'); ?>">Jet Skis</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('embarcacoes/barcos-pesca-a-venda'); ?>">Barcos Pesca</a></li>
                          <li class="destaque"><a href="<?php echo Yii::app()->createUrl('catalogo'); ?>">Estaleiros</a></li>
                          <li class="destaque"><a target="_blank" href="http://guiadocapitao.com.br/">Guia do Capitão</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-3 col-sm-6">
                      <div class="bloco">
                        <h4>Comunidade</h4>
                        <ul class="links">
                          <li><a href="<?php echo Yii::app()->createUrl('comunidade/raio-x'); ?>">Raio X</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('tabela'); ?>">Tabela Bombarco</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('comunidade/noticias'); ?>">Notícias</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('comunidade/primeiro-barco'); ?>">Primeiro Barco</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('comunidade/blog'); ?>">Blog</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-3 col-sm-6">
                      <div class="bloco">
                        <h4>Sobre</h4>
                        <ul class="links">
                          <li><a href="<?php echo Yii::app()->createUrl('institucional'); ?>">Institucional</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('por-que-anunciar'); ?>">Por que Anunciar?</a></li>
                          <li><a href="<?php echo Yii::app()->createUrl('como-anunciar-site'); ?>">Como Anunciar</a></li>
                        <li><a href="/planos" class="lista-itens ax-track-event" data-ax-trackname="link rodape - planos">Planos</a></li>
                        <li><a href="http://bommarinheiro.com.br/pages/" target="_blank" class="lista-itens ax-track-event" data-ax-trackname="link rodape - bom marinheiro">Bom Marinheiro</a></li>
                        <li><a href="/consorcio-lancha-veleiro-jetski">Consórcio Náutico</a></li>
                        <li><a href="/transporte-de-lancha-veleiro-jetski">Transporte Náutico</a></li>
                        <li><a href="/arrais-mestre-capitao-amador">Arrais amador, Mestre ou Capitão</a></li>
                        <li><a href="/jettdeck">Jett Deck - piso náuticoa</a></li>
                        <li><a href="/pranchamotorizada">Jetsurf Prancha Motorizada</a></li>
                        <li><a href="/contato">Contato</a></li>
                        </ul>
                      </div>
                    </div>
                    <div class="col-xl-3 col-md-3 col-sm-6">
                      <div class="bloco">
                        <h4>Anuncie no Bombarco</h4>
                        <!--<ul class="links">
                          <li><a href="#">Termos de Uso</a></li>
                          <li><a href="#">Políticas de Privacidade</a></li>
                        </ul>-->
                        <div class="anunciar">
                          <p><a href="/anunciar" class="btn btn-redondo-branco"><i class="fa fa-anchor"></i> Anunciar</a></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="faixa">
                  <div class="container">
                    <div class="row">
                      <div class="col-xl-5 col-md-4 col-sm-12">
                        <small>Meios de Pagamento</small>
                        <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/bandeiras.png'?>" alt="Bandeiras" />
                      </div>
                      <div class="col-xl-4 col-md-4 col-sm-12">
                        <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/logo.png'?>" alt="Bombarco - Líder em Negócios Náuticos" class="logo-footer" />
                      </div>
                      <div class="col-xl-3 col-md-4 col-sm-12">
                        <img data-src="holder.js?e=344/160x40" class="img-fluid pull-right">
                      </div>
                    </div>
                  </div>
                </div>

              </footer>

              <a href="#topo" class="volta-topo" title="Topo"><i class="fa fa-angle-up"></i></a>

              <div id="div-lightbox-video"></div>

</div>


</body>
        <script>
            $(document).ready(function() {
              console.log("teste");
                function obterIdVideoYoutube(url) {

                    var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
                    if(videoid != null) {
                       console.log(videoid[1]);
                       return videoid[1];
                    } else { 
                        return false;
                    }
                }

                $(".lazyYT-button").on("click", function(e) {

                    e.preventDefault();

                    if($("#div-lightbox-video").html() == "") {

                        //console.log("asdasd");

                        var video = $(this).data("video");
                        var src = "https://www.youtube.com/embed/"+obterIdVideoYoutube(video)+"?autoplay=1";

                        var html = '<div class="lightbox-videos" id="lightbox_video">';
                            html += '<div class="div-video">';
                            html += '<a id="fechar-video" href="#" class="close close-video">x</a>';
                                html += '<iframe type="text/html" width="740" height="460" src="'+src+'" frameborder="0"></iframe>';
                                
                            html += '</div>';
                        html += '</div>';

                        $("#div-lightbox-video").append(html);

                        $('#lightbox_video').lightbox_me({
                            centered: true,
                            onLoad: function() {
                                $("#lightbox_video").addClass("show");
                            },
                            onClose: function() {
                                $("#div-lightbox-video").empty();
                                $("iframe").remove();
                                $("#lightbox_video").removeClass("show");
                            }
                        });
                    }
                });


                $(".nav-link").on("click", function() {
                    $(".nav-link").each(function(index, element) {
                        $(element).parent().removeClass("active");
                    });
                    $(this).parent().addClass("active");
                });

                $(".box-parceiro").on("click", function() {
                	if($(this).hasClass("active")) {
                		$(this).removeClass("active");
                		$(this).addClass("disabled");
                	}
                	else {
                		$(this).removeClass("disabled");
                		$(this).addClass("active");
                	}
                });



				function validateEmail(email) {

					var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			        return re.test(email);
				}

				$("#btn-contato-parceiro").on("click", function(e) {

			        e.preventDefault();
			        //e.stopPropagation();
			        e.stopImmediatePropagation();

			        var $email;

			        if($("#inputEmail").val() != "") {
			        	$email = $("#inputEmail").val();
			        }
			        else {
			        	$email = $("#inputEmailParceiro").val();
			        }

			        var $telefone;

			        if($("#inputTelefone").val() != "") {
			        	$telefone = $("#inputTelefone").val();
			        }
			        else {
			        	$telefone = $("#inputTelefoneParceiro").val();
			        }

			        if(!validateEmail($email)) {
				        alert("Favor preencher corretamente o e-mail.");
				        return false;    
				    }

			    	if($telefone.length < 8) {
		            	alert("Favor preencher corretamente o número de telefone.");
		            	return false;
		        	}


			        // clicou no botao de enviar principal e selecionou que quer saber mais sobre
			        $(".box-parceiro").each(function() {

			            if($(this).hasClass("active")) {

			                var id_form = $(this).data("form");

			                // transferir valores do form de contato principal para o form das abas de partners
			                $("#"+id_form).find(".nome").val($("#inputNome").val());
			                $("#"+id_form).find("input[type='email']").val($email);
			                $("#"+id_form).find("input[type='tel']").val($telefone);

			            }

			        });

			        teste();

			    }); 

			       // clicou em enviar mensagem em detalhe de anuncio ou respondeu resp de anuncio
			    function teste() {

			        // pega o tipo da mensagem no campo hidden (E - empresa/estaleiro, X - anuncio)
			        var tipo = "E";

			        var nome = $("#inputNomeParceiro").val();
			        var nome_destinatario = $("#nome-contato").val();
			        var email_remetente = $("#inputEmailParceiro").val();
			        var telefone = $("#inputTelefoneParceiro").val();
			        var mensagem = $("#inputMensagemParceiro").val();
			        //var senha = $("#senha-contato-anunciante").val();
			        var j8BSVuvy = $(".j8BSVuvy").val();
			        var idUsuarioDonoEmbarc = $("#idUsuarioDonoEmbarc").val();

			        var flgok = true;

			        if (nome.length == 0 || email_remetente.length == 0 || mensagem.length == 0 || telefone.length == 0) {

			            flgok = false;
			            alert("Preencha todos os campos!");

			        } else {

			            if (!validateEmail(email_remetente)) {
			                alert("Email inválido!");
			                flgok = false;
			            }

			            if (flgok) {

			                //$('.preloader').css("z-index", "9999");

			                // url de resp de anuncio
			                var url = Yii.app.createUrl('contatos/mailAnunciante');

			                $.ajax({
			                    url: url,
			                    async: false,
			                    data: {
			                        nome_rem: nome,
			                        nome_destinatario: nome_destinatario,
			                        email_remetente: email_remetente,
			                        //senha: senha,
			                        telefone_rem: telefone,
			                        mensagem: mensagem,
			                        idUsuarioDonoEmbarc: idUsuarioDonoEmbarc,
			                        idEmbarcacao: $("#idEmbarcacao").val(),
			                        emailEmbarcacao: $("#emailEmbarcacao").val(),
			                        resposta: 0,
			                        partner_trans: ($("#qroTransporte").is(':checked')) ? $("#qroTransporte").val() : 0,
			                        partner_finan: ($("#qroFinanciamento").is(':checked')) ? $("#qroFinanciamento").val() : 0,
			                        partner_cons: ($("#qroConsorcio").is(':checked')) ? $("#qroConsorcio").val() : 0,
			                        partner_marina: ($("#qroMarina").is(':checked')) ? $("#qroMarina").val() : 0,
			                        j8BSVuvy: j8BSVuvy
			                    },
			                    type: 'POST',
			                    success: function (resp) {  

			                        if(resp.trim() == "1") {
			                            alert("Sucesso ao enviar a mensagem");
			                            location.reload();

			                        }
			                        else {
			   
			                            alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
			                        }


			                    },
			                    error: function (x, h, err) {

			                        alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
			                    }
			                });

			                // caso tenha escolhido consorcio, finan nios lightbox
					        $(".box-parceiro").each(function() {

					            if($(this).hasClass("active")) {

					                var id_form = $(this).data("form");

			                        // transferir valores do form de contato principal para o form das abas de partners
			                        $("#"+id_form).find(".nome").val($("#primeiroNome").val());
			                        $("#"+id_form).find("input[type='email']").val($("#inputEmail").val());
			                        $("#"+id_form).find("input[type='tel']").val($("#inputTelefone").val());


			                        $.ajax({
			                                url: $("#"+id_form).attr("action"),
			                                type: 'POST',
			                                async: false,
			                                data: $("#"+id_form).serialize(),
			                                success: function(resp) {
			                                    //var json = JSON.parse(resp);
			                                }

			                            });
			                    }

			                });


			            } // fim flg ok
			        }
			    }     

          $("#zoom_03").ezPlus({    
              zoomType: "inner",
              cursor: "crosshair",
              scrollZoom: true, 
              zoomActive: true,
              zoomLevel: 1, 
              responsive: true, 
              lensFadeIn: 500,
              lensFadeOut: 500,
              debug: true,
              zoomWindowFadeIn: 500,
              zoomWindowFadeOut: 500
          });    

			});

        </script>
        <script>

        var detalhe = new Vue({ 
            delimiters: ['${', '}'],
            el: "#app",
            data: {
                emailnews: ""
            },
            created: function() {

            },

            mounted: function() {

            },

            methods: {

                mudarImagem: function(e) {
//console.log(e);
                    let width = $(e.target).data("width");
                    let height = $(e.target).data("height");

                    if(width == null || height == null) {
                        return false;
                    }

                    if(height > width) {
                        $("#div-img").addClass("ajustar-img");
                    }
                    else {
                        $("#div-img").removeClass("ajustar-img");   
                    }
                    $("#zoom_03").data("zoom-image", $(e.target).attr("src"));
                    $("#zoom_03").attr("src", $(e.target).attr("src"));
                    $("#zoom_03").ezPlus({
                        //gallery: 'gallery_01',
                        //cursor: 'pointer',
                        //loadingIcon: false,
                        //galleryActiveClass: "active",
                        //imageCrossfade: true,
                        //easing: true,
                        //zoomWindowWidth: 300,
                        //zoomWindowHeight: 300,
                        //zoomType: "window"
                       
                        zoomType: "inner",
                        cursor: "crosshair",
                        scrollZoom: true, 
                        zoomActive: true,
                        zoomLevel: 1, 
                        responsive: true, 
                        lensFadeIn: 500,
                        lensFadeOut: 500,
                        debug: true,
                        zoomWindowFadeIn: 500,
                        zoomWindowFadeOut: 500

                    });
                                
                },
                mudarVideo: function(e) {

                    $("#zoom_03").data("zoom-image", $(e.target).attr("src"));
                    $("#zoom_03").attr("src", $(e.target).attr("src"));
                    $("#zoom_03").ezPlus({
                            gallery: 'gallery_01',
                            cursor: 'crosshair',
                            galleryActiveClass: "active",
                            imageCrossfade: true
                            //loadingIcon: "https://www.elevateweb.co.uk/spinner.gif"
                    });
                    //<a @click.stop.prevent="mudarImagem($event)" class="elevatezoom-gallery active" data-update="" data-image="media/videos/bg.jpg" data-zoom-image="media/videos/bg.jpg"><iframe width="144" height="80" src="<?php echo $modelo->video; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></a><
                },
                validarEmail: function(email) {
                    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                },
                abrirModalPergunta: function(e) {
                    
                    /*this.link_modelo = $(e.target).data("link");
                    this.nome_modelo_pergunta = $(e.target).data("nome");
                    this.email_dest_modelo_pergunta = $(e.target).data("email");
                    this.id_modelo_pergunta = $(e.target).data("idmodelo");*/

                    //var id_embarc = $(e.target).data("id_embarcacao");
                    //$("#idUsuarioDonoEmbarc").val($(e.target).data("id_usuario_dono_embarc"));
                    //$("#idEmbarcacao").val(id_embarc);
                    //$("#emailEmbarcacao").val($(e.target).data("email_embarcacao"));
                    //$("#nome-contato").val($(e.target).data("nome_destinatario"));

                    var id_embarc = $("#idEmbarcacao").val();
                    var titulo = $("#titulo-embarc").val();
                    var link_detalhe = $("#link_detalhe").val();
                    var valor = $("#valor").val();

                    $(".parceiro_embarc_id").each(function(index, el) {
                        $(el).val(id_embarc);
                    });
                    $(".parceiro_titulo").each(function(index, el) {
                        $(el).val(titulo);
                    });
                    $(".parceiro_valor").each(function(index, el) {
                        $(el).val(valor);
                    });
                    $(".parceiro_link").each(function(index, el) {
                        $(el).val(link_detalhe);
                    }); 
                    
                    $('#fazerPergunta').modal();
                },
                newsLetter: function() {


                    const $this = this;
                    var email = this.emailnews;
                    var user_agent = navigator.userAgent;


                    if(!email || !$this.validarEmail(email)) {
                        this.emailnews = "E-mail inválido";
                    }

                    // ok - ajax salvar mail
                    else {

                        $.ajax({
                            url: Yii.app.createUrl('maillings/create'),
                            data: {email: email, user_agent: user_agent},
                            type: 'post',

                            success: function(resp) {

                                // msg de sucesso
                                if(resp.trim() == '1') {
                                   $this.emailnews = "E-mail cadastrado com sucesso!";
                                }

                                else if(resp.trim() == '-3') {
                                    $this.emailnews = "E-mail já está cadastrado!";
                                }

                                else {
                                    $this.emailnews = "Erro ao enviar o email";
                                }


                            },

                            error: function(x, h, z) {
                                
                            }
                        });
                    }
                },
                selecionarParceiro: function(e) {

                    var elemento;

                    if(e.length == 1) {
                        elemento = e;
                    }
                    else {
                        elemento = e.target;
                    }

                    if($(elemento).hasClass("disabled")) {
                        $(elemento).removeClass("disabled").addClass("mostraForm");  
                        $(elemento).css("box-shadow", "0px 0px 10px 0px #102e46");  
                    }
                    else {
                        $(elemento).removeClass("mostraForm").addClass("disabled");
                        $(elemento).css("box-shadow", "");  
                    }
                    
                },
                selecionarParceiro_: function(e) {

                    this.selecionarParceiro($(e.target).parent().parent());
                }
            }
        });


       
        
    </script>
            </html>
