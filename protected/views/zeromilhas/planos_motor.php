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

  <!-- Miolo -->
  <section id="miolo">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 hidden-md-down">
          <table class="table table-striped w-100 table-anuncios">
            <thead>
              <tr>
                <th>
                  <h4 class="com-barra"><b>Escolha seu plano</b></h4>
                </th>
                <th>
                  <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_01.png'?>" alt="Anúncio Grátis">
                  <h3>Grátis</h3>
                  <small>Anuncie</small>
                  <small>gratuitamente</small>
                  <a href="<?php echo Yii::app()->createUrl('zeromilhas/criarPlanoMotor?pid=125'); ?>" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
                </th>
                <th>
                  <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_03.png'?>" alt="Anúncio 6 Meses">
                  <h3><sup>R$ </sup>1068</h3>
                  <small style="
    font-weight: bolder;
">6 anúncios</small>
                  <small>por 6 meses<a href="<?php echo Yii::app()->createUrl('zeromilhas/criarPlanoMotor?pid=122'); ?>" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a></small>
                  
                </th>
                <th>
                  <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_03.png'?>" alt="Anúncio 6 Meses">
                  <h3><sup>R$ </sup>1755</h3>
                  <small style="
    font-weight: bolder;
">15 anúncios</small>
                  <small>por 6 meses</small>
                  <a href="<?php echo Yii::app()->createUrl('zeromilhas/criarPlanoMotor?pid=123'); ?>" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
                </th>
              <th style="
    width: 10%;
    text-align: center;
    padding: 10px;
">
                  <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_03.png'?>" alt="Anúncio 6 Meses">
                  <h3><sup>R$ </sup>2376</h3>
                  <small style="
    font-weight: bolder;
">30 anúncios</small>
                  <small>por 6 meses</small>
                  <a href="<?php echo Yii::app()->createUrl('zeromilhas/criarPlanoMotor?pid=124'); ?>" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
                </th></tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <h5>Dados de Mercado</h5>
                  
                </td>
                <td>
                  <i class="fa fa-window-minimize cinza"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
              <td style="
    text-align: center;
    padding: 3rem 0;
    width: 10%;
">
                  <i class="fa fa-check verde fa-2x"></i>
                </td></tr>
              <tr>
                <td>
                  <h5>Indicação de motores semelhantes</h5>
                  
                </td>
                <td>
                  <i class="fa fa-window-minimize cinza"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
              <td style="
    text-align: center;
    padding: 3rem 0;
    width: 10%;
">
                  <i class="fa fa-check verde fa-2x"></i>
                </td></tr>
              <tr>
                <td>
                  <h5>Logotipo em Destaque</h5>
                  
                </td>
                <td>
                  <i class="fa fa-window-minimize cinza"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
              <td style="
    text-align: center;
    padding: 3rem 0;
    width: 10%;
">
                  <i class="fa fa-check verde fa-2x"></i>
                </td></tr>
              <tr>
                <td>
                  <h5>Receba contato direto</h5>
                  
                </td>
                <td>
                  <i class="fa fa-window-minimize cinza"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
              <td style="
    text-align: center;
    padding: 3rem 0;
    width: 10%;
">
                  <i class="fa fa-check verde fa-2x"></i>
                </td></tr>
              <tr>
                <td>
                  <h5>Dados completos do motor</h5>
                  
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
              <td style="
    text-align: center;
    padding: 3rem 0;
    width: 10%;
">
                  <i class="fa fa-check verde fa-2x"></i>
                </td></tr>
              <tr>
                <td>
                  <h5>Sistema de Avaliação</h5>
                  
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
                <td>
                  <i class="fa fa-check verde fa-2x"></i>
                </td>
              <td style="
    text-align: center;
    padding: 3rem 0;
    width: 10%;
">
                  <i class="fa fa-check verde fa-2x"></i>
                </td></tr>
            </tbody>
            <tfoot>
              <tr>
                
                
                
                
              </tr>
            </tfoot>
          </table>
        </div>

        <div class="col-md-12 col-sm-12 hidden-md-up table-anuncios">
          <div class="row no-border">
            <div class="col-md-12 col-sm-12">
              <h4 class="com-barra">Escolha uma opção e <b>ganhe visibilidade </b>entre os apaixonados por barco.</h4>
            </div>
          </div>
          <div class="w-100 table-anuncios">
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_02.png'?>" alt="Anúncio Grátis">
                <h3>Grátis</h3>
                <small>Anuncie</small>
                <small>gratuitamente</small>
                <a href="#" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
              </div>
            </div>
            <div class="row cabecalho">
              <div class="col-md-10 col-sm-10">
                <h5>DESCRIÇÃO</h5>
              </div>
              <div class="col-md-2 col-sm-2">
                <h5>INCLUSO</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Dados de Mercado</h5>
                <p>Essa ferramenta é o Analytics do Cátalogo 0 milhas. Mostrará o Ranking das marcas mais buscadas e quais modelos são mais buscados no período que você escolher.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-window-minimize cinza"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Indicação de Barcos Semelhantes</h5>
                <p>Sua embarcação será indicada para quem buscar uma com as mesmas características que a sua.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-window-minimize cinza"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Logotipo em Destaque</h5>
                <p>Seu logotipo aparecerá em destaque na Home, na Listagem das marcas e detalhes de cada embarcação.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-window-minimize cinza"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Receba contato direto</h5>
                <p>Você receberá todos os contatos dos interessados para negociar direto com ele.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-window-minimize cinza"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Dados completos da embarcação</h5>
                <p>Preencha todos os dados da sua embarcação. Dados completos chamam mais atenção do consumidor.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Sistema de Avaliação</h5>
                <p>Pessoas identificadas com conta ativa em redes sociais poderão avaliar a sua embarcação.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <h3>Grátis</h3>
                <small>Anuncie</small>
                <small>gratuitamente</small>
                <a href="#" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
              </div>
            </div>
          </div>

          <div class="w-100 table-anuncios">
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_02.png'?>" alt="Anúncio 6 Meses">
                <h3><sup>R$ </sup>85</h3>
                <small>Embarcação/mês</small>
                <small>por 6 meses</small>
                <a href="#" class="btn btn-padrao-branco borda-cinza btn-selecao active">Selecionado!</a>
              </div>
            </div>
            <div class="row cabecalho">
              <div class="col-md-10 col-sm-10">
                <h5>DESCRIÇÃO</h5>
              </div>
              <div class="col-md-2 col-sm-2">
                <h5>INCLUSO</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Dados de Mercado</h5>
                <p>Essa ferramenta é o Analytics do Cátalogo 0 milhas. Mostrará o Ranking das marcas mais buscadas e quais modelos são mais buscados no período que você escolher.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Indicação de Barcos Semelhantes</h5>
                <p>Sua embarcação será indicada para quem buscar uma com as mesmas características que a sua.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Logotipo em Destaque</h5>
                <p>Seu logotipo aparecerá em destaque na Home, na Listagem das marcas e detalhes de cada embarcação.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Receba contato direto</h5>
                <p>Você receberá todos os contatos dos interessados para negociar direto com ele.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Dados completos da embarcação</h5>
                <p>Preencha todos os dados da sua embarcação. Dados completos chamam mais atenção do consumidor.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Sistema de Avaliação</h5>
                <p>Pessoas identificadas com conta ativa em redes sociais poderão avaliar a sua embarcação.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <h3><sup>R$ </sup>85</h3>
                <small>Embarcação/mês</small>
                <small>por 6 meses</small>
                <a href="#" class="btn btn-padrao-branco borda-cinza btn-selecao active">Selecionado!</a>
              </div>
            </div>
          </div>

          <div class="w-100 table-anuncios">
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_falante_02.png'?>" alt="Anúncio 12 Meses">
                <h3><sup>R$ </sup>78</h3>
                <small>Embarcação/mês</small>
                <small>por 12 meses</small>
                <a href="#" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
              </div>
            </div>
            <div class="row cabecalho">
              <div class="col-md-10 col-sm-10">
                <h5>DESCRIÇÃO</h5>
              </div>
              <div class="col-md-2 col-sm-2">
                <h5>INCLUSO</h5>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Dados de Mercado</h5>
                <p>Essa ferramenta é o Analytics do Cátalogo 0 milhas. Mostrará o Ranking das marcas mais buscadas e quais modelos são mais buscados no período que você escolher.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Indicação de Barcos Semelhantes</h5>
                <p>Sua embarcação será indicada para quem buscar uma com as mesmas características que a sua.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Logotipo em Destaque</h5>
                <p>Seu logotipo aparecerá em destaque na Home, na Listagem das marcas e detalhes de cada embarcação.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Receba contato direto</h5>
                <p>Você receberá todos os contatos dos interessados para negociar direto com ele.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Dados completos da embarcação</h5>
                <p>Preencha todos os dados da sua embarcação. Dados completos chamam mais atenção do consumidor.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-10 col-sm-10">
                <h5>Sistema de Avaliação</h5>
                <p>Pessoas identificadas com conta ativa em redes sociais poderão avaliar a sua embarcação.</p>
              </div>
              <div class="col-md-2 col-sm-2">
                <i class="fa fa-check verde fa-2x"></i>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 text-center">
                <h3><sup>R$ </sup>78</h3>
                <small>Embarcação/mês</small>
                <small>por 12 meses</small>
                <a href="#" class="btn btn-padrao-branco borda-cinza btn-selecao">Selecionar</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    

  </div>
</section>



</body>



    <script>

        $(document).ready(function(){

      
        });
    </script>
</html>
