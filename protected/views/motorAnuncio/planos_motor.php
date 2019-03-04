<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="author" content="Bombarco - Líder em Negócios Náuticos" />
  <meta name="keywords" content="bombarco, zeromilhas, nautico, lider, marinha" />
          <meta name="geo.region" content="BR-SP" />
        <meta name="geo.placename" content="Brasil" />
        <meta name="geo.position" content="-14.2392976,-53.1805017,4z" />
        <meta name="ICBM" content="-14.2392976,-53.1805017,4z" />
        <meta name="robots" content="follow,index" />
  <link rel="shortcut icon" href="/favicon.ico?e=23" />
  <title>Catálogo Bombarco | Planos para motores</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bootstrap.min.css?e=2333'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/tether.min.css?1212');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/reset.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bjqs.css?e=234');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/style.css?e=22223');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/responsive.css?e=3333f');?>

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/tether.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/counter.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/numeral.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.ez-plus.js?e=2344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bjqs.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/maskedinput.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap-slider.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.lightbox_me.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END); ?>


  

<!-- Permite que o IE interprete as tags do HTML 5 -->
<!--[if lt IE 9]>
<script src="media/http://html5shim.googlecode.com/svn/trunk/html5.js?e=344"></script>
<link rel="stylesheet" type="text/css" href="http://domain.tld/path/ie-specific.css" />
<![endif]-->

<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,600,800,900" rel="stylesheet">

    <?php
        $this->renderPartial('analytics');
    ?>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        .tr-msgs {
            background-color: rgba(0,0,0,0) !important;
        }

    </style>

</head> <!-- FIM HEAD -->

<body id="topo" class="side-collapse-container">

    <div id="app">

   <?php
        $this->renderPartial('_menu');
    ?>

      <section id="titulo-subpagina">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
          <h1>
            ANUNCIAR
            <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_titulo.png'?>" alt="Titulo" />
          </h1>
          <p>Mostre sua marca e obtenha dados de mercado na melhor plataforma náutica.</p>
        </div>
      </div>
    </div>
  </section>

  <br/><br/>

  <?php if(Yii::app()->user->hasFlash('msg')): ?>
      <div class="container">
        <h4>
            <b style="color: red;"><?php echo Yii::app()->user->getFlash('msg'); ?></b>
        </h4>
      </div>
  <?php endif; ?>

  


</body>



    <script>

        $(document).ready(function(){

          setTimeout(function() {
            location.href = Yii.app.createUrl("anunciar?e=motor");
          }, 1500);
      
        });
    </script>
</html>
