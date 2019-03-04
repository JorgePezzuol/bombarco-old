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
  <title>Catálogo Bombarco | Dashboard</title>



  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bootstrap.min.css?e=2333'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/fancybox.css?e=23'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/fancybox-buttons.css?e545');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/tether.min.css?1212');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/reset.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bjqs.css?e=234');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/style.css?e=11111');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/responsive.css?e=3333f');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/jquery-ui.css?e=234');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=23');?>

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/tether.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/counter.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/numeral.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/fancybox.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/fancybox-buttons.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.ez-plus.js?e=2344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-ui.js?e=1111', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bjqs.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/maskedinput.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.lightbox_me.js', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/datatable.min.js?e=23', CClientScript::POS_END); ?>


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

        tr {
            background-color: rgba(0,0,0,0) !important;
        }

        .label-37 {
            width: 37% !important;
        }
        .input-60 {
            width: 60% !important;
        }
        .delete-icon {

            display: block;
            margin: 0 auto;
            background: url(http://www.bombarco.com.br/themes/bombarco/img/sprite-minha-conta.png) no-repeat;
            background-position: -226px -102px;
            width: 21px;
            height: 20px;
            vertical-align: middle;
            position: relative;
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
          <h1>Pagamentos
            <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_titulo.png'?>" alt="Titulo" />
          </h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Miolo -->
  <section id="miolo">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12">
             <ul class="nav nav-pills mb-3" id="menu-tabs" role="tablist">
            <li class="nav-item">
              <a class="nav-link" id="perfil-tab" href="<?php echo Yii::app()->createUrl("zeromilhas/perfil", array("id"=>Yii::app()->user->id)); ?>" aria-controls="tab-perfil" aria-selected="true">Perfil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="embarcacoes-tab" href="<?php echo Yii::app()->createUrl("zeromilhas/planos"); ?>" aria-controls="tab-embarcacoes" aria-selected="false">Meus Modelos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="embarcacoes-tab" href="<?php echo Yii::app()->createUrl("embarcacoes/lista?v=0&e=anuncios"); ?>" aria-controls="tab-embarcacoes" aria-selected="false"> Classificados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="dashboard-tab" href="<?php echo Yii::app()->createUrl("dashboard"); ?>" aria-controls="tab-dashboard" aria-selected="false">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="mensagens-tab" href="<?php echo Yii::app()->createUrl("zeromilhas/mensagens"); ?>" aria-controls="tab-mensagens" aria-selected="false">Mensagens</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="mensagens-tab" href="<?php echo Yii::app()->createUrl("zeromilhas/pagamento"); ?>" aria-controls="tab-mensagens" aria-selected="false">Pagamentos</a>
            </li>
          </ul>



        </div>
      </div>

              <?php
            $flgOrdensApagar = false;
            if($ordens != null) {
                foreach($ordens as $index => $ordem) {
                    if($ordem->status != Anuncio::$_status_ordem['PAGA']) {
                        $flgOrdensApagar = true;
                    }
                }
            }
        ?>

        <div class="barra-titulo filtros">
            <div class="row">
                <div class="col-lg-5 col-sm-12">
                    <h4 class="com-barra"><b id="valor_total">Total a pagar: <?php echo $somaOrdens;?></b></h4>
                </div>
                <?php if($somaOrdens != null && $flgOrdensApagar): ?>
                <div class="col-lg-7 col-sm-12">
                    <a id="btn-pagamento" class="btn btn-laranja w-40 pull-right link-pagamento bt-pay" href="#">efetuar pagamento</a>
                </div>
                <?php endif; ?>
            </div>
          
        </div>





        <form id="form-itau-boleto" action="https://shopline.itau.com.br/shopline/shopline.aspx" method="post" name="form" target="_blank">
            <input type="hidden" name="DC" id="DC">
            <!--<input type="submit" name="Shopline" value="OK" style="margin-left:210px; margin-top:40px;" class="botao-lb-form-msgok">-->
        </form>

        <?php echo CHtml::beginForm('', 'post', array("id"=>"grid-pagamentos"));?>
        <div class="col-lg-12 col-sm-12">
          <table id="tabela" class="table table-striped striped-2 tabela-mensagens w-100 ajusta-tabela">
            <thead>
              <tr>
                <th style="width: 5% !important;"></th>
                <th style="width: 15% !important;" class="text-center">Data</th>
                <th style="width: 50% !important;" class="text-center">Descrição</th>
                <th class="text-center">Valor</th>
                <th class="text-center">Status</th>
                <th class="text-center"></th>
              </tr>
            </thead>
            <tbody>
                <?php if(count($ordens) > 0): ?>
                    <?php foreach($ordens as $index => $ordem) :?>
                        <tr>
                            <td class="text-center" style="position:relative; top: 5px; border-top: 0px !important;">
                                <?php if($ordem->status == 1 && !Transacoes::segundaViaBoleto($ordem)): ?>
                                    <div class="checkbox">
                                        <input checked id="<?php echo $ordem->id; ?>" data-valor="<?php echo $ordem->valor; ?>" value="<?php echo $ordem->id; ?>" class="selecao_ordem" type="checkbox" class="form-check-input">
                                        <label class="form-check-label" for="<?php echo $ordem->id; ?>">
                                        </label>
                                    </div>
                                <?php endif ;?>
                            </td>
                            <td class="text-center">
                                <?php echo Utils::formatDateTimeToView($ordem->data_criacao); ?>
                            </td>
                            <td class="text-center">
                                <?php echo $ordem->descricao; ?>
                            </td>
                            <td class="text-center">
                                R$ <?php echo Utils::formataValorView($ordem->valor); ?>
                            </td>

                            <?php if($ordem->status != Anuncio::$_status_ordem['PAGA']): ?>

                                <?php if(Transacoes::segundaViaBoleto($ordem) == true): ?>
                                    <td class="pendente text-center">
                                        <a class="verboleto" data-codigoitau="<?php echo $ordem->transacoes->codigo_itau; ?>" href="#">Ver boleto</a>
                                    </td>
                                <?php else: ?>
                                    <td class="pendente text-center"><?php echo Ordens::getTextoStatus($ordem->status);?></td>
                                <?php endif; ?>

                            <?php else: ?>

                                <td class="pago text-center"><?php echo Ordens::getTextoStatus($ordem->status);?></td>
                            <?php endif; ?>

                            <?php if($ordem->status != Anuncio::$_status_ordem['PAGA']): ?>
                                    <?php if(Transacoes::segundaViaBoleto($ordem) == false): ?>
                                        <td>
                                            <a class="cancelar-ordem delete-icon" id="<?php echo $ordem->id; ?>" alt="excluir" a href="#"></a>
                                        </td>
                                    <?php endif; ?>
                                    
                                    
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
          </table>
        </div>

        <div class="payment_container" style="display:none;">
            <div class="row">
              
              <div class="col-lg-6 col-sm-12">
                <div class="bloco6 bg-faded">
                  <div class="row filtros">
                    <div class="col-lg-12 col-sm-12">
                      <div class="row">
                        <div class="col-lg-12 col-sm-12">
                          <h4 class="com-barra-abaixo"><b>CLIQUE PARA GERAR O BOLETO</b></h4>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      
                        <a href="#" id="gerar_boleto"><?php echo CHtml::image(Yii::app()->baseUrl.'/img/boleto.png'); ?></a>

                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6 col-sm-12">
                <div class="bloco6 bg-faded">

                  <div class="row filtros">
                    <div class="col-lg-12 col-sm-12">
                      <div class="row">
                        <div class="col-lg-12 col-sm-12">
                          <h4 class="com-barra-abaixo"><b>INSIRA OS DADOS DO SEU CARTÃO </b><br/><br>Você está em um ambiente seguro.</h4>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row metade">
                    <div class="col-lg-12 col-sm-12">


                        <br/>

                         <label class="radio-inline" style="width:20%;">
                          <input name="card_flag" id="cardVisa" value="Visa" style="width:30%;" type="radio" checked><?php echo CHtml::image(Yii::app()->baseUrl.'/img/visa.png'); ?>
                        </label>
                        <label class="radio-inline" style="width:20%;">
                          <input name="card_flag" id="cardMaster" value="Master" style="width:30%;" type="radio"><?php echo CHtml::image(Yii::app()->baseUrl.'/img/mastercard.png'); ?>
                        </label>

                        <br/>
                        <br/>
                        <br/>
                            
                        <div class="form-group">
                              <label class="label-37" for="card_number">*Número do cartão</label>
                              <input type="text" name="card_number" id="card_number" class="campo-dados input-60">
                        </div>
                        <div class="form-group">
                            <label class="label-37" for="card_validate_month">*Validade (mês)</label>
                            <span class="estiliza-select" style="padding: 1em !important;">
                            <select style="width: 53% !important;" name="card_validate_month" id="card_validate_month">
                                <option value="01">Janeiro</option>
                                <option value="02">Fevereiro</option>
                                <option value="03">Marco</option>
                                <option value="04">Abril</option>
                                <option value="05">Maio</option>
                                <option value="06">Junho</option>
                                <option value="07">Julho</option>
                                <option value="08">Agosto</option>
                                <option value="09">Setembro</option>
                                <option value="10">Outubro</option>
                                <option value="11">Novembro</option>
                                <option value="12">Dezembro</option>
                            </select>
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="label-37" for="card_validate_year">*Validade (ano)</label>
                            <span class="estiliza-select" style="padding: 1em !important;">
                            <select style="width: 53% !important;" name="card_validate_year" id="card_validate_year">
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                            </span>
                        </div>
                        <div class="form-group">
                              <label class="label-37" for="card_name">*Nome impresso no cartão</label>
                              <input type="text" name="card_name" id="card_name" class="campo-dados input-60">
                        </div>
                        <div class="form-group">
                              <label class="label-37" for="card_cvv">*Código de segurança</label>
                              <input name="card_cvv" id="card_cvv" type="text" class="campo-dados input-60">
                        </div>
                        <br/>
                        <div class="checkbox">
                            <input type="checkbox" class="form-check-input" id="termos-condicao">
                            <label style="width: 60% !important;" class="form-check-label" for="termos-condicao">
                              *Li e aceito os <a class="open-terms" href="#">termos</a> de condição
                            </label>
                        </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div id="ordem">
                    <span class="valor text-pag-os" style="font-size: 35px; color:#00918E !important;" id="transacao-info"></span>
                </div>
                <div class="btns-right" style="width: 18% !important;">
                      <a class="btn btn-verde-claro" id="submit-card" href="#">
                        <span class="pull-left">finalizar </span>
                        <i class="fa fa-check"></i>
                      </a>
                </div>
              </div>
            </div>

            <input type="hidden" id="valor_ordens" value="<?php echo $somaOrdens; ?>"/>
            <?php 

                echo CHtml::hiddenField('tid', '');
                echo CHtml::hiddenField('reference', '1');
                echo CHtml::endForm();
            ?>
        </div>

    </div><!-- container -->

  </section>


                
    <a href="#topo" class="volta-topo" title="Topo"><i class="fa fa-angle-up"></i></a>

            <div class="modal fade" id="termos" tabindex="-1" role="dialog" aria-labelledby="popupLogin" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="popupLogin"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <span class="titulo-modal">Termos de Condição</span>
                    <div id="texto" style="margin: 30px;
font-size: 12px;
overflow-y: auto;
height: 330px;text-align:justify;">
A empresa Bombarco Serviços de Informação na Internet Ltda ME, inscrita no CNPJ/MF sob o nº 10.352.973/0001-43, estabelecida em Mogi das Cruzes, na Rua Cruzeiro do Sul, 323, Vila Oliveira, Mogi das Cruzes, SP, doravante denominada Bombarco e seus domínios, a partir do presente Termo e Condições de Uso estabelece como deverá ser utilizado o conteúdo e a publicidade contida no website www.bombarco.com.br.

Este documento integra um conjunto de ações que o Bombarco estabelecejuntamente com o Política de Privacidade e Segurança de Dados e Informações, visando informar e assegurar as responsabilidades, deveres e obrigações que todo internauta, usuário e anunciante assumem ao acessar o Portal Bombarco.

Osusuários, internautas e anunciantesdeverão ler, certificar-se de haver entendido e aceitar todas as condições estabelecidas no Termo e Condições Gerais de Uso e Política de Privacidade e Segurança de Dados e Informações, antes de utilizar como internauta e/ou se cadastrar como usuário e/ouanunciante do website www.bombarco.com.br.

Ao utilizar oBombarco, o usuário, internauta e anuncianteaceitam e concordam de forma tácita as regras aqui descritas.

Definições:

Classificam-se como "internauta" todas as pessoas que de alguma forma acessam o Portal Bombarco.

Classificam-se como "usuários" todas as pessoas que se cadastram neste site e recebem uma identificação individual, intransferível e exclusiva.

Classificam-se como “anunciantes” todas as pessoas físicas e pessoas jurídicas que se cadastram neste site e recebem uma identificação individual, intransferível e exclusiva e veiculam anúncios ou publicidade no Portal do Bombarco.

1.  Capacidade para cadastrar-se:

1.1.    Oconteúdo e a publicidade contidos no Bombarco estão disponíveis e são direcionadas apenas para pessoas físicas de boa-fée que gozem de capacidade civil e pessoas jurídicas também de boa-fée idôneas, pessoas físicas incapazes como rege o Código Civil Brasileiro, ou que tenham sido inabilitadas do Bombarco (temporária ou definitivamente) e pessoas jurídicas que não tenham interesse legítimo não podem utilizar os recursos ou contratar. Qualquer pessoa, nominada usuário, internauta e anunciante, que pretenda utilizar os recursos do website Bombarco, deverá aceitar o presente Termo e Condições Gerais de Uso, bem como, as demais Políticas e Princípios que o regem.

1.2.    Também não é permitido que uma mesma pessoa física e/ou jurídica tenha mais de um cadastro. Se o Bombarco detectar, através do sistema de verificação de dados, cadastros duplicados serão inabilitados definitivamente.

1.3.    Pessoas Jurídicas somente poderão cadastrar-se através de seu representante legal.

2.  Cadastro:

2.1.    O cadastro é necessário para o uso dos recursos disponíveis nas seções descritas no item 4 deste Termo. O cadastro é pessoal e intransferível, deve ser preenchido corretamente todas informações solicitadas no formulário, tem duração por tempo indeterminado e pode ser solicitado o cancelamento pelo e-mail atendimento@bombarco.com.br a qualquer momento pelo usuário e/ou anunciante, sem qualquer ônus para quaisquer das partes. Os dados pessoais informados pelo usuário e/ou anunciante no ato do registro não são divulgados para terceiros, conforme exposto na Política de Privacidade.

2.2.    A identificação do anunciante (login) é necessária para o acesso as seções descritas no item 4deste Termo. Para a identificação, é necessário que o anunciante utilize seu e-mail e sua senha do Bombarco informados no momento do cadastro.

2.3.    O anunciante ou usuário está ciente que deverá preencher seus dados e/ou dados da empresa que representa, e apenas será confirmado o cadastro que preencher todos os campos obrigatórios. Os futurosusuários ou anunciantes deverão completá-lo com informações exatas, precisas e verdadeiras, e assumem o compromisso de atualizar os dados pessoais sempre que neles ocorrer alguma alteração, sob pena de exclusão do contato sem qualquer ônus à Bombarco.

2.4.    O Bombarco não se responsabiliza pela correção dos dados pessoais inseridos por seus usuários e/ou anunciantes. Estes os quais garantem e respondem, em qualquer caso, pela atualização, veracidade, exatidão e autenticidade dos dados cadastrados.

2.5.    O Bombarco se reserva o direito de utilizar todos os meios válidos e possíveis para identificar seus usuários e/ou anunciantes, bem como, solicitar dados adicionais e documentos que estime serem pertinentes a fim de conferir os dados pessoais informados.

2.6.    Caso o Bombarco decida checar a veracidade dos dados cadastrais de um usuário e/ou anunciante e se constate haver entre eles dados incorretos ou inverídicos, ou ainda, caso o usuário e/ou anunciante se furte ou negue o envio de documentos requeridos, o Bombarco poderá bloquear, suspender temporariamente ou cancelar definitivamente o cadastro, sem prejuízo de outras medidas que entender necessárias e oportunas.

2.7.    Havendo a aplicação de qualquer das sanções acima referidas, automaticamente serão cancelados todos os atos do usuário e/ou anunciante, não assistindo aos mesmos, por essa razão, qualquer sorte de indenização ou ressarcimento.

2.8.    O anunciante está ciente e autoriza a divulgação das fotos e vídeosenviados das embarcações, dos dados fornecidos das embarcações e dos telefones para contato que deverão ser informados no momento do cadastro da embarcação na Seção “Anunciar”.

3.  Aos internautas, usuários e anunciantes que acessam o site do Bombarco é terminantemente proibido:

3.1.    Utilizar o site do Bombarco com qualquer propósito criminoso;

3.2.    Utilizar os recursosdisponíveis neste site para fins diversos daqueles a que se destinam;

3.3.    Enviar ou transmitir quaisquer tipos de informações que induzam, incitem ou resultem em atitudes discriminatórias, ofensivas a qualquer pessoa ou produto, mensagens violentas ou delituosas que atentem contra a moral e bons costumes e que contrariam a ordem pública;

3.4.    Utilizar os dados para contato de anunciantes com outro propósito que não seja o de encaminhar proposta comercial pertinente ao anunciado;

3.5.    Enviar, transmitir ou usar qualquer tipo de informação que seja de propriedade de terceiros;

3.6.Alterar, apagar ou corromper dados e informações do website ou de terceiros;

3.7.Violar a privacidade de outros usuários e/ou anunciantes;

3.8.    Enviar ou transmitir arquivos com vírus de computador, com conteúdo destrutivo, invasivo ou que causem dano temporário ou permanente nos equipamentos do destinatário ou do Bombarco;

3.9.Utilizar endereços de computadores, de rede ou de correio eletrônico falsos;

3.10.   Violar o direito autoral de terceiros, por meio de qualquer tipo de reprodução de material, sem a prévia autorização por escrito e com reconhecimento de firmado proprietário.

3.11    Anunciar empresa ou embarcação que não seja da sua propriedade ou que não esteja autorizado a anunciar

3.12    Cada anúncio tem sua característica, podendo ser contratado diferentes tipos de turbinadas que aumentam o nível de exposição do anúncio, portanto, é proibido aproveitar o mesmo anúncio contratado para anunciar outraEmbarcação e ou Guia de Empresa em qualquer hipótese, ou inserir informações e/ ou fotos e vídeos, ou, de qualquer modo, fazer referência a outra embarcação.

3.13    Anunciar embarcação com valor irrisório


4.  Recursos oferecidos:

4.1.    O Bombarco oferece, ao usuário, internauta e anunciante, acesso ao conteúdo disponível nas seções: comprar embarcações, estaleiros, guia de empresas, comunidades, anunciar e tabela de preços.

4.2.    O Bombarco, portanto, possibilita aos usuários, anunciantes e aos internautas travarem conhecimento uns dos outros e permite que negociem entre si, sempre diretamente, sem qualquer intermediação ou intervenção na finalização dos negócios, não sendo, nesta qualidade, vendedor, fornecedor de quaisquer produtos e/ou serviços, bem como, não prestando serviços de consultoria, garantia, avaliação, guarda, entrega,transporte e devoluçãoou ainda participante em nenhum negócio entre o internauta e/ou usuário e/ou anunciante(s).
4.3.    Dessa forma, o Bombarco não assume responsabilidade por nenhuma consequência que possa advir de qualquer relação entre o internauta e/ou usuário com o (s) anunciante (s), seja ela direta ou indireta.
4.4.    Assim, o Bombarco não é responsável por qualquer expectativa de negócio, ação ou omissão do usuário, e/ou internauta e/ou anunciante baseada nas informações, anúncios, fotos, vídeos ou outros materiais veiculados no Portal Bombarco.
4.5.    A Tabela de preço é uma tabela não oficial, somente mostraa média de preços deembarcações que já foram anunciadas no Bombarco ou não, servindo apenas para consulta. Os preços efetivamente praticados variam em função da região, conservação, cor, acessórios, motor, ano ou qualquer outro fator que possa influenciar as condições de oferta e procura por umaembarcação específica.

5.  Acesso ao conteúdo:

5.1.    O cadastro no site BOMBARCO é gratuito;
5.2.    O anunciante precisará de cadastro, no momento em que tiver interesse em: Anunciar (embarcações, empresas ou serviços, estaleiros e banners), deverá escolher o plano que melhor lhe atender, onde valores diferem, dependendo do nível de exposição do anúncio no site.


6.  Uso do conteúdo disponível no BOMBARCO

6.1.    É expressamente proibida a comercialização do conteúdo oferecido pelo Bombarco de forma integral ou parcial, bem como é expressamente proibida a reprodução ou retransmissão do conteúdo por qualquer pessoa física ou jurídica, através de qualquer meio.

6.2.     O usuário, internauta e anunciante entendem que o conteúdo disponível no aludido website, dentro dos padrões de ética e bom senso, enriquece e facilita o desenvolvimento de pesquisas na área náutica, porém não substitui a orientação de profissionais. Dessa forma, o Bombarco não se responsabiliza em possível ocorrência de interpretação divergente por quaisquer das partes envolvidas, erro, fraude, inexatidão ou incoerência de dados, fotos e vídeos ou outros materiais relacionados a anúncios ou à imprecisão das informações contidas e enviadaspor anunciantes, usuários ou internautas no Portal Bombarco.

6.3.     O usuário, internauta e anuncianteentendem que o Bombarco é o meio de veiculação, não representa o anunciante e editor de informações, por esse motivo as partes acima citadas, assumem todos os riscos e se responsabilizam por quaisquer danos ou prejuízos sofridos e/ou causados pelo uso de qualquer material obtido no Bombarco, assim como se comprometem a enviar apenas informações e materiais legítimos e verídicos.

6.4.    O usuário e anunciante do Bombarco se comprometem a preencher sob sua responsabilidade, todos os dados do anúncio feito em qualquer seção do site de forma correta, verídica, e nos padrões do site Bombarco, sob pena de ser responsabilizado por qualquer dano, bem como ser retirado o anúncio sem prévio aviso e sem qualquer indenização e/ou reembolso.

6.5.    Não é permitido fazer propaganda de empresas na Seção "Anunciar Embarcações", onde o espaço é destinado tão somente para a venda da embarcação. Portanto, fotos e/ou descrição da embarcação que contenham site, e-mail não serão aceitos, sendo o anúncio excluído automaticamente.

6.5.    Não é permitido fazer propaganda de embarcaçãona Seção "Anunciar Guia de Empresa", onde o espaço é destinado tão somente para a divulgação da empresa. Portanto, fotos e/ou descrição de embarcação não serão aceitos, sendo o anúncio excluído automaticamente.

6.6 Os anúncios em Comprar Embarcações aparecem de forma randômica, exceto quando o anunciante comprar Turbinada de Prioridade de Exibição e quando a embarcação não tiver valor.

7.  Responsabilidade

7.1.    Bombarconão é proprietário dos produtos e/ou embarcações oferecidos, não os avalia, faz a guarda, tem a posse e tampouco realiza as ofertas de venda. Assim como, não intervém na entrega ou no transporte dos mesmos,cuja negociação se inicie no site ou não, esclarecendoainda, que não se responsabiliza pelos serviços oferecidos por empresas ou profissionais anunciantes no portal.

7.2.    Pelo exposto na cláusula 7.1. oBombarconão se responsabiliza pela existência, quantidade, qualidade, estado, integridade ou legitimidade dos produtos e/ou embarcações oferecidos, adquiridos ou alienados pelos usuários, internautas e anunciantes.

7.3.    Bombarco não se responsabiliza pela veracidade dos dados pessoais cadastrados por usuários e anunciantes inseridos em seus cadastros.Bombarco não outorga garantia por vícios ocultos ou aparentes nas negociações entre os anunciantescom o internauta, usuário e outros anunciantes. Cada anuncianteestá ciente e aceita ser o único responsável por negociação e fechamento de negócios, pelos produtos, embarcações e informações que anuncia, venda ou pelas ofertas/compras que realiza.

7.4.    Bombarco não será responsável pelo cumprimento das obrigações assumidas por quaisquer das partes envolvidas. O anunciante reconhece e aceita que ao realizar negociações com usuários, outros anunciantese internautas faz por sua conta e risco. Em nenhum caso Bombarco será responsável pelo lucro cessante ou por qualquer outro dano e/ou prejuízo que o usuário, internauta e anunciantepossam sofrer devido às negociações realizadas ou não realizadas através do Bombarco.

7.5.    Caso o usuário, internauta e anuncianteacesse o site de parceiros, patrocinadores, outros anunciantes e demais sites que sejam acessados através do Portal Bombarco, é possível que haja solicitação de informações financeiras e/ou pessoais. Entretanto, tais e quaisquer informações não estarão sendo enviadas para o Bombarco, e sim diretamente ao solicitante, não tendo o Bombarco, portanto, qualquer acesso, conhecimento ou responsabilidade pela utilização e manejo dessa informação.

7.6.    Bombarcorecomenda que toda transação seja realizada com toda a cautela e diligência utilizada nas práticas comerciais, assim como bom senso. O anunciante deverá medir os riscos da negociação, levando em consideração que possa estar, eventualmente, lidando com menores de idade ou pessoas de má-fé. O Bombarco não é responsável pelas transações entre os anunciantes e terceiros.

7.7.    O usuário, internauta e anunciante assumem todas as responsabilidades provenientes de relações contratuais ou extracontratuais entre pessoas físicas ou jurídicas, assumidas através do Bombarco.

7.8. Nos casos em que um ou mais usuários, anunciantesou algum internauta inicie qualquer tipo de reclamação ou ação legal contra um ou mais anunciantes, todos e cada um dos anunciantes envolvidos nas reclamações ou ações eximem de toda responsabilidade o Bombarco, bem como qualquer membro de sua equipe, sejamseus diretores, gerentes, empregados, colaboradores, representantes, procuradores e etc.

7.9.    O usuário, internauta e anunciante são responsáveis por todos os equipamentos e programas de computador para a utilização do website, assim como pelas despesas de acesso à internet (acesso discado, banda larga, etc) e também pelos danos que possam ocorrer ao seu equipamento, decorrentes da má utilização de qualquer software/hardware ou por falhas técnicas ocorridas em seu provedor de acesso à internet.

7.10.    O Bombarco não se responsabiliza, direta ou indiretamente, por quaisquer danos e/ou prejuízos causados pela utilização do site inclusive danos causados por vírus de computador ou equivalentes.

7.11.    O anunciantee o usuário se comprometem a informar dados verídicos e sempre atualizar na ocorrência de alterações, solicitados no ato do registro tanto de dados pessoais quanto de dados da empresa, embarcação, produtos, etc. No caso de informar dados incorretos, incompletos ou desatualizados, o Bombarco se reserva o direito de cancelar o registro do respectivo anunciante ou usuário, sem aviso prévio, indenização, devolução ou reembolso de valores.

7.12.    A senha para acesso ao conteúdo é de uso pessoal e intransferível, o usuário e o anunciante obrigam-se a mantê-la em sigilo, sendo responsável por quaisquer danos e/ou prejuízos que o uso indevido da senha venha a causar.Em caso de uso indevido da mesma por terceiros, o usuário e anunciante se compromete a comunicar imediatamente o Bombarco.

7.13.    Para garantir a segurança em casos em que o usuário ou anunciante acessa o website www.bombarco.com.br o usuário e o anunciante se comprometem a clicar no link "Sair", localizado na parte superior de todas as páginas do Bombarco, que desconecta o usuário e o anunciante da sua área no Portal, evitando que terceiros se utilizem indevidamente de suasenha.

8. Regras para publicação de conteúdo

8.1.    A publicação dos conteúdos tais como: entrevistas, mensagens contendo experiências, dicas e opiniões, todas enviadas ou produzidas pelo Bombarco, jornalistas, editoras, empresas de publicidade e outras, usuários ou internautassão totalmente gratuitas. Atualmente, o Bombarco aceita conteúdo para publicação em algumas seçõesdo site desde que usuário ou internauta aceite e atenda aos requisitos descritos nas regras de publicação específicas de cada conteúdo.

8.2.    O usuário, anunciante ou internauta, ao enviar material para a publicação, assume todas as responsabilidades sobre o material publicado e exime o Bombarco de quaisquer danos e/ou prejuízos decorrentes.


8.3.    O Bombarco não se responsabiliza, direta ou indiretamente, pela republicação, modificação, cópia total ou parcial, reexibição, retransmissão, publicação ou criação de conteúdo derivados a partir do conteúdo publicado por terceiros que não possuam autorização expressa dos seus respectivos autores, o responsável sempre será o indivíduo que enviou o material para publicação.

8.4.    O conteúdo enviado para o Bombarco pode ser eventualmente remetido por usuário, anunciante ou internauta que, agindo de má-fé, se intitulem autores dos mesmos, cometendo crime de falsidade ideológica previsto em lei. Devido às características da internet, o Bombarco não pode se assegurar da total veracidade das informações fornecidas pelos usuários, anunciantes ou internautas nessas situações.

8.5.    Caso o autor de algum conteúdo publicado no Bombarco suspeite que seu material tenha sido remetido indevidamente ao site ou que algum desses materiais de sua autoria foi parcial ou totalmente reproduzido em nome de terceiros no website www.bombarco.com.br, o mesmo deverá imediatamente entrar em contato com a empresa Bombarco, através do e-mailatendimento@bombarco.com.br para retiradado conteúdo no website e tomada de providências.

8.6. O usuário ou internauta entende que o conteúdo publicado por ele ficará disponível para todos os visitantes do website www.bombarco.com.br por tempo indeterminado, (exceção dos pacotes de locação de espaço virtual) sem que isso acarrete ônus para qualquer uma das partes, a qualquer tempo. Da mesma forma, o usuário, anunciante ou internauta, se assim desejar, poderá solicitar a exclusão do conteúdo de sua autoria do Bombarco, sem qualquer ônus e a qualquer tempo.

8.7. O website divulga, na seção AGENDA, diversos eventos da área náutica que ocorrem no Brasil. Todas as informações como datas, locais, programação, pessoas e recursos envolvidos nos eventos são de responsabilidade de seus organizadores e podem ser alterados sem aviso prévio. O Bombarco não assume, direta ou indiretamente, qualquer custo, reembolso, responsabilidade ou encargo proveniente da informação divulgada na seção acima citada.

8.8. O anunciante, ao publicar os seus dados pessoais e/ou dados da empresa que representa, como endereço, telefone, etc, na seção GUIA DE EMPRESAS,ANUNCIAR EMBARCAÇÃO, ESTALEIRO ou em qualquer meio de publicidade do website, está ciente que o Bombarco não se responsabiliza por quaisquer danos ou prejuízos diretos ou indiretos causados pela publicação.

8.9.     O usuário encontra, no Bombarco, um espaço para publicarem seus comentários, situações em que se encontraram, que sirvam como dica sobre determinado conteúdo. Não serão publicados conteúdos ofensivos, ilegais, seja com teor discriminatório, racista ou pornográfico. O Bombarco se reserva o direito de não publicar ou excluir tais comentários que não se adéquem a estas regras, sem qualquer prévio comunicado.

8.10.    O usuário ou internauta poderá, a qualquer tempo, pedir a exclusão de qualquer conteúdo próprio que tenha sido enviado e publicado no website, sem qualquer ônus, bastando para isso entrar em contato com o Bombarco através do e-mail: atendimento@bombarco.com.br.

9. Propriedade intelectual, direitos autorais e de marcas
9.1.    A propriedade intelectual de todo o material apresentando no Portal é de titularidade do Bombarco ou de seus anunciantes, usuários, clientes, parceiros e fornecedores, incluindo marcas, logotipos, produtos, sistemas, denominações de serviços, programas, bases de dados, imagens, arquivos ou materiais de qualquer outra espécie e que têm contratualmente autorizadas as suas veiculações neste Portal.
9.2.    É proibida, sem a prévia e devida autorização por escrito e com firma reconhecida dos responsáveis acima identificados, a reprodução de qualquer material do Portal Bombarco, entendendo-se por reprodução todas as formas possíveis de comercialização, cópia, distribuição e veiculação.
9.3.    As marcas comerciais apresentadas no Portal são de propriedade do Bombarco ou de seus anunciantes, clientes, parceiros ou fornecedores, sendo que a simples apresentação das marcas no Portal não poderá ser interpretada como sociedade, fusão ou concessão, sendo igualmente proibida a utilização ou qualquer tipo de reprodução de tais marcas comerciais.
9.4.    O uso indevido de propriedade intelectual ou de marcas comerciais apresentadas no Portal Bombarco será caracterizado como violação das leis cíveis e criminais, em especial a lei que protege os direitos autorais/marcas e patentes e sujeitará o infrator às sanções judiciais cabíveis, sem prejuízo de indenização pelos prejuízos causados a Bombarco ou terceiros.
9.5.    O nome e a marca Bombarco são marcas registradas da Bombarco Serviços de Informação na Internet Ltda. ME. O usuário, internauta e anunciante concordam em não reproduzir ou utilizar, sob qualquer título, a marca do Bombarco sem autorização prévia documentada e registrada.

9.6.    Todo conteúdo como textos e informações que o usuário ou internauta envie ou torne disponível para publicação em qualquer seção do website é de propriedade e responsabilidade de quem o produziu e o enviou.

9.7.    As matérias publicadas na seção COMUNIDADE – notícias, primeiro barco, blog e teste Bombarco são oriundas de fontes que permitiram sua reprodução desde que citadas suas respectivas fontes.

10. Política de Privacidade

10.1    A Política de Privacidade define o tratamento que o Bombarco dá às informações pessoais do usuário, internauta e anunciante que utilizam os serviços e recursos do website www.bombarco.com.br, podendo ser alterada regularmente.

11. Modificação do Termo de Uso

11.1    Bombarco poderá alterar, a qualquer tempo, este Termo e Condições Gerais de Uso, visando seu aprimoramento. O novo Termo e Condições Gerais de Uso entrará em vigor 10 (dez) dias após a publicação no site. No prazo de 5 (cinco) dias contados a partir da publicação das modificações, o usuário, internauta ou anunciante deverá comunicar-se pelo e-mail atendimento@bombarco.com.br caso não concorde com os termos alterados. Não havendo manifestação no prazo estipulado, entender-se-á que aceitaram tacitamente o novo Termo e Condições Gerais de Uso.

12. Disposições Finais

12.1 O Bombarco não mantém, administra ou possui nenhuma relação com serviços e/ou produtos encontrados nas seções COMPRAR EMBARCAÇÃO, ANUNCIAREMBARCAÇÃO, GUIA DE EMPRESA, ESTALEIRO bem como não garante a eficácia e/ou a eficiência dos produtos ou serviços, seja no Brasil ou no exterior, assim como não se responsabiliza pelos danos e/ou prejuízos decorrentes da eventual utilização daqueles serviços, produtos ou embarcação.

12.2. As opiniões expressas em NOTÍCIAS, PRIMEIRO BARCO E BLOGsão respeitadas e não necessariamente expressam o entendimento, convicção e ideia do Bombarco.

12.3. O usuário, anunciante e o internauta concordam queconteúdos (entrevistas, mensagens contendo experiências, dicas e opiniões), enviados para o aludido website,se for do interesse do Bombarco, poderá ser publicado em "banners" ou outras formas de publicidade com fins comerciais, sem que isso traga qualquer ônus para as partes.

12.4. O Bombarco enviará ao usuário e/ouanunciante mensagens resultantes da comunicação sobre o que lhe for pertinente, podendo se referir: a contratação da locação do espaço virtual no website www.bombarco.com, confirmação de cadastro, publicação de conteúdo e/ou envio de newsletter caso seja autorizado.
12.5. O anunciante está ciente que o Bombarco poderá enviar informações, a seu critério dar publicidade a conteúdos, conceder bonificação gratuita,todavia, qualquer tipo de concessão, não acarretará obrigação entre as partes, ou oneração a Bombarco, que poderá a qualquer tempo, alterar, suspenderou cancelar tais benefícios gratuitos.


Equipe BOMBARCO.

    </div>
                  </div>
                  <div class="modal-footer">
                    <a href="#" id="close-termos" class="btn btn-verde-claro w-65"><span class="pull-left">Aceito </span><i class="fa fa-check"></i></a>
                  </div>
                </div>
              </div>
            </div>


</div>


</body>

    <script>
        $(document).ready(function() {

            /*var tabela = $('#tabela').DataTable({
                pageLength: 100,
                lengthChange: false,
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese.json"
                }
            });*/


            $("#card_number").keyup(function() {
                $('#card_number').val($(this).val().replace(/[^0-9]/g,""));
            });


            var valor_ordens = parseFloat($("#valor_ordens").val());

            
            // calcular valor total das ticagens das ordens
            $(".selecao_ordem").on("click", function(e) {

                    var valor = parseFloat($(this).data("valor"));

                    // se ticou uma ordem, loop em todas as outras para pegar as ticadas e somar o valor
                    if($(this).prop("checked")) {

                        $(".selecao_ordem").each(function() {

                                if($(this).prop("checked")) {
                                    valor += parseFloat($(this).data("valor"));    
                                }
                        });
                    }

                    // se desticou uma ordem, loop em todas as outras para pegar as ticadas e subtrair o valor
                    else {
                        $(".selecao_ordem").each(function() {

                                if($(this).prop("checked")) {
                                    valor -= parseFloat($(this).data("valor"));   
                                    console.log($(this).data("valor")); 
                                }
                        });
                    }
                    


                    if(valor == 0) {
                        valor = valor_ordens;
                    }
                    $("#valor_total").text("Total a pagar: R$ "+numeral(Math.abs(valor)).format('0,0.00'));
                    $("#transacao-info").text("Total a pagar: R$ "+numeral(Math.abs(valor)).format('0,0.00'));

            });


            // clicou para cancelar a ordem de pedido
            $(".cancelar-ordem").on("click", function(e) { 
                e.preventDefault();

                var s = confirm("Deseja excluir esse item?");
                if(s) {
                    // obter o ID do elemento pois este contem o ID da ordem
                    var id = $(this).attr("id");

                    // ajax para deletar a ordem
                    $.ajax({
                        url:Yii.app.createUrl('utils/cancelarOrdemDePedido'),
                        type: 'post',
                        data: {id_ordem: id},

                        success: function(resp) {

                            if(resp.trim() != "-1") {
                                //console.log(resp);
                                location.reload();
                                
                            }
                        },

                        error: function(x, h, e) {
                            //console.log(JSON.stringify(e));
                            alert("Erro inesperado. Favor contatar o admin do site.");
                            //location.reload();
                        }
                    });
                }

                

            });

            // clicou para pagar. Realizar ajax para gerar uma transação com todas as ordens
            $(".link-pagamento").on("click", function(e){

                e.preventDefault();

                // pegar as ordens selecionadas e jogar no array o id
                var id_ordens = [];
                $(".selecao_ordem").each(function() {
                        if($(this).prop("checked")) {
                            id_ordens.push($(this).val());
                        }
                });


                $.ajax({
                    url: Yii.app.createUrl('utils/gerarTransacao'),
                    type: 'post',
                    data: {
                        id_ordens: JSON.stringify(id_ordens)
                    },

                    success: function(resp) {
                    
                        if(resp != "-1") {

                            var transacao = JSON.parse(resp.trim());

                            $("#tid").val(transacao.tid);
                            $("#reference").val(transacao.tid);
                            $("#transacao-info").text(transacao.descricao);
                            $("#valor_total").text(transacao.descricao);

                            $('.payment_container').show();
                            $(".link-pagamento").fadeOut("slow");
            
                             $('html, body').animate({
                                scrollTop: $('.payment_container').offset().top
                             }, 'fast');
                        }
                    },

                    error: function(x, h, r) {
                        alert("Erro inesperado. Favor contatar o admin do site.");
                    }

                });

            });

            $('body').on("click", "#close-termos", function(e) {
                e.preventDefault();
                $("#termos-condicao").prop("checked", true);
                $("#termos").modal('hide');                
            });

            $('body').on("click", ".open-terms", function(e) {

                e.preventDefault();
                $("#termos").modal('show');

            });


            $('body').on('click', '#submit-card', function(e){

                e.preventDefault();

                var card_number = $("#card_number").val();
                var card_name = $("#card_name").val();
                var card_cvv = $("#card_cvv").val();
                var ano = $("#card_validate_year").val();
                var mes = $("#card_validate_month").val();

                var flgok = true;
                var erros = "";


                if(!$("#termos-condicao").is(":checked")) {
                    flgok = false;
                    erros += "\nAceite os termos de condição.";
                }

                if(!card_number) {
                    erros += "\nInsira o número do cartão.";
                    flgok = false;
                }

                if(!mes) {
                    erros += "\nSelecione o mês de validação do cartão.";
                    flgok = false;
                }

                if(!ano) {
                    erros += "\nSelecione o ano de validação do cartão.";
                    flgok = false;
                }

                if(!card_name) {
                    erros += "\nInsira o nome do cartão.";
                    flgok = false;
                }

                if(!card_cvv) {
                    erros += "\nInsira a senha de segurança do cartão.";
                    flgok = false;
                }

                if(flgok) {
                    
                    var s = confirm("Deseja confirmar o pagamento?");

                    if(s) {

                        $.ajax({
                            url: Yii.app.createUrl('anuncios/PagamentoCartao'),
                            type: 'POST',
                            data: $("#grid-pagamentos").serialize(),

                            error: function(x, h, r) {

                                $("html, body").animate({ scrollTop: 0 }, "slow");
                                $("#card_number").val("");
                                $("#card_name").val("");
                                $("#card_cvv").val("");
                        
                            },
                            success: function(resp) {

                                $("#card_number").val("");
                                $("#card_name").val("");
                                $("#card_cvv").val("");

                                ga('send', 'event', 'link', 'click', 'Pagamento Cartao');

                                var resp = JSON.parse(resp.trim());

                                // msg de erro
                                if(resp.error != 0) {
                                    alert("Pagamento não autorizado pelo operadora.");
                                } else {
                                    location.href = Yii.app.createUrl("site/sucesso");
                                }
                            },

                        });
                    }
                }

                else {
                    //$("html, body").animate({ scrollTop: 0 }, "slow");
                    alert(erros);
                }

            });


            // variaveis usadas no success do ajax do boleto
            var flg = false;
            var cript_itau;

            function carregabrw() {

                window.open("","SHOPLINE","toolbar=yes,menubar=yes,resizable=yes,status=no,scrollbars=yes,width=815,height=575");
            }

            // clicou pra gerar boleto
            $("#gerar_boleto").on("click", function(e) {

                    e.preventDefault();

                    ga('send', 'event', 'link', 'click', 'Pagamento Boleto');


                    var dados_cript;

                    $.ajax({

                        url: Yii.app.createUrl('anuncios/pagamentoBoleto'),
                        type: 'POST',
                        data: $("#grid-pagamentos").serialize(),
                        asnyc: false,

                        success: function(resp) {

                            var json = JSON.parse(resp);

                            if(json.error == 0) {

                                flg = true;
                                cript_itau = json.cript_itau;
                                $("#DC").attr("value", json.cript_itau);
                            }
                            else {
                                alert("Ocorreu um erro inesperado. Favor contate o admin do sistema");
                                
                            }
                            
                        },

                        complete: function(resp) {
                            

                            var s = confirm("Prosseguir com pagamento?");

                            if(s) {
                                $("#form-itau-boleto").submit();
                            }

                            //setTimeout(function(){ location.reload(); }, 10000);
                        },

                        error: function() {
                            flg = false;
                            alert("Ocorreu um erro inesperado. Favor contate o admin do sistema");
                        }
                    });

                    


            });


            $(".verboleto").on("click", function(e) {
                e.preventDefault();
                var codigoitau = $(this).data("codigoitau");
                $("#DC").attr("value", codigoitau);
                $("#form-itau-boleto").submit();
            });


        }); // ready
            
        
    </script>
</html>
