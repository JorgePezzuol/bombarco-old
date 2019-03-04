<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv="Content-Language" content="pt-br">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
        <meta name="geo.region" content="BR-SP" />
        <meta name="geo.placename" content="Brasil" />
        <meta name="geo.position" content="-14.2392976,-53.1805017,4z" />
        <meta name="ICBM" content="-14.2392976,-53.1805017,4z" />
        <meta name="author" content="Bombarco - Líder em Negócios Náuticos">
        <!--<meta name="robots" content="index, follow" />-->
        <link rel="author" href="https://plus.google.com/b/111308419174881630384/+BombarcoBrMercado"/>
        <link rel="publisher" href="plus.google.com/b/111308419174881630384/+BombarcoBrMercado"/>
        <link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl; ?>/favicon.ico" />
        <link href="<?php echo Yii::app()->theme->baseUrl . '/css/responsive.css?e=677';?>" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->theme->baseUrl . '/css/grids-responsive-min.css';?>" rel="stylesheet" type="text/css">
        <!--<link href="<?php /*echo Yii::app()->theme->baseUrl . '/css/font-awesome.css';*/?>" rel="stylesheet" type="text/css">-->
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/font-awesome/css/font-awesome.min.css?e=2312323';?>" rel="stylesheet" type="text/css">
      
  <?php if (!YII_DEBUG): ?>
            <?php Utils::canonicalMeta(); ?>
        <?php endif ?>

        <?php

        if (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') {
            $this->setPageTitle("Classificados Náuticos | Bombarco ");
            Yii::app()->clientScript->registerMetaTag('Pesquise por classificados náuticos aqui. Bombarco, o melhor site para comprar ou anunciar sua lancha, veleiro, jet ski ou barco de pesca. Confira as ofertas!', 'description', null, array(), 'bombarco_description');
            Yii::app()->clientScript->registerMetaTag('Líder em Classificados Náuticos, lanchas a venda, veleiros a venda, jetskis a venda.', 'keywords', null, array(), 'bombarco_keywords');
        }
       
        if (!YII_DEBUG) {
            Utils::metaTags($this);
        } else {
            echo '<title>' . CHtml::encode($this->pageTitle) . '</title>';
        }

          Yii::app()->clientScript->registerCoreScript('jquery');
          Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/lib.js');
          Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/functions.js?');
          Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/main.js?634545');
          if (!Yii::app()->user->isGuest)
              Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin.js?gggggg' , CClientScript::POS_END);

          Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/slide.js', CClientScript::POS_END);
          Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/selects-forms.js', CClientScript::POS_END);

        if(strpos($_SERVER["REQUEST_URI"], "/admin") === false || strpos($_SERVER["REQUEST_URI"], "/admin/tabelaEmbarcacoes")) {

            Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/pure-min.css');

            if(isset($_GET["shelley"])) {
                Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/shelley.css?e='.microtime());
            }
            else {
                Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl . '/css/style.css?e=4444');    
            }
            


        }else{
 
        ?>
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/bootstrap.min.css';?>" rel="stylesheet" type="text/css">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/sb-admin.css?';?>" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/datepicker.css';?>" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/css/plugins/morris.css';?>" rel="stylesheet">
        <link href="<?php echo Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg-editor.min.css';?>" rel="stylesheet" type="text/css">
        <script src="<?php echo Yii::app()->baseUrl .'/themes/admin/js/jquery.js';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/bombarco/js/lib.js?';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/bombarco/js/main.js?';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/admin/js/bootstrap-datepicker.js?';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/admin/js/scripts.js?';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/js/jquery.yiiactiveform.js';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/admin/js/bootstrap.min.js';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg-editor.min.js';?>"></script>
        <script src="<?php echo Yii::app()->baseUrl . '/themes/admin/wysiwyg/wysiwyg.min.js';?>"></script>
        <?php
        }
        ?>
        <!-- Facebook Pixel Code -->
        <script>
        /*!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
        n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
        document,'script','//connect.facebook.net/en_US/fbevents.js');*/

        /*fbq('init', '1677722699150291');
        fbq('track', "PageView");*/</script>
        <!--<noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=1677722699150291&ev=PageView&noscript=1"
        /></noscript>-->
        <!-- End Facebook Pixel Code -->

        <script type="text/javascript">
      var gaq; 
      var _gaq = gaq || [];
      _gaq.push(['_setAccount', 'UA-18454099-1']);
      _gaq.push(['_setDomainName', 'bombarco.com.br']);
      _gaq.push(['_setAllowLinker', true]);
       _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script');
        ga.type = 'text/javascript';
        ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www')
                      + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
      })();

</script>
    </head>


    <body>

        <script type="text/javascript" async src="https://d335luupugsy2.cloudfront.net/js/loader-scripts/bc9d88b8-178d-4086-af62-214e6c2f7dee-loader.js"></script>
            <!-- loader ajax gif -->
        <section class="preloader" style="display:none;">
            <img src="<?php echo Yii::app()->createUrl('img/loader.gif'); ?>" alt=""/>
        </section>

      <?php if(strpos($_SERVER["REQUEST_URI"], "/admin") === false){ ?>
        <!-- lightbox de sucesso para uso geral -->
        <div class="lbox-msgenviada" id="lbox-msgok">
            <div class="texts-lbox-ag">
                <span class="form-lb-title" id="msg-lgbox">Sua mensagem foi enviada com sucesso!</span>
            </div>
            <input type="button" name="botao-revisar" class="botao-lb-form-msgok close" id="revisar-btn" value="Ok">
        </div>



        <?php if (Yii::app()->user->hasFlash('general_alert')): ?>
            <section class="general-alert">
                <?php echo Yii::app()->user->getFlash('general_alert') ?>
            </section>
        <?php endif ?>



        <?php }else{ ?>
          <div id="wrapper">
        <?php } ?>
        <?php
        if (Yii::app()->controller->id != 'guiaCapitao') {
            require_once('header.php');
        }
        ?>
        <?php if(strpos($_SERVER["REQUEST_URI"], "/admin") === false){ ?>

        <?php echo $content; ?>
        <?php }else{ ?>
          <div id="page-wrapper">
            <?php echo $content; ?>
          </div>
        <?php } ?>

        <?php
        if (Yii::app()->controller->id != 'guiaCapitao' && strpos($_SERVER["REQUEST_URI"], "/admin") === false) {
            require_once('footer.php');
        }
        ?>
<?php if(strpos($_SERVER["REQUEST_URI"], "/admin") !== false){ ?>
</div>
  <?php } ?>
  <script>
    /*$(".banner-link").each(function(){
      $.ajax({"url":"/banners/countView/" + $(this).data("id")})
    });*/
  </script>
    </body>

    <?php if (!YII_DEBUG): ?>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>
   
    <?php endif ?>

</html>
