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
  <title>Bombarco | Anunciar motor</title>

  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no" />
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/tether.min.css?1212');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bootstrap.min.css?e=2333'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/reset.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bjqs.css?e=234');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/style.css?e=2');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/responsive.css?e=3333f');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/jquery-ui.css?e=234');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/datatable.css?e=23');?>

  

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-ui.js?e=1111', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/tether.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/counter.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/numeral.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.ez-plus.js?e=2344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bjqs.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/maskedinput.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap-slider.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
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
        label {
            font-size:14px;
        }
        .n-encontrou-marca, .n-encontrou-tipo {
            cursor:pointer;
            color:#0275d8;
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
            <small>atualizar</small>
            Motor
            <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_titulo.png'?>" alt="Titulo" />
          </h1>
          <p>Faça o melhor anúncio que conseguir. Anúncios mais completos podem trazer mais resultados.</p>
        </div>
      </div>
    </div>
  </section>

  <br/><br/>

  <?php if(Yii::app()->user->hasFlash('msg_sucesso')): ?>
      <div class="container msg_sucesso">
        <h4>
            <b style="color:green;>"><?php echo Yii::app()->user->getFlash('msg_sucesso'); ?></b>
        </h4>
        <br/>
        <a href="/anuncios/anuncioPagamento?minha_conta=1&e=pagamento">Página de pagamentos</a>
      </div>
  <?php endif; ?>

    <?php if(Yii::app()->user->hasFlash('msg_erro')): ?>
      <div class="container">
        <h4>
            <b style="color:red;>"><?php echo Yii::app()->user->getFlash('msg_erro'); ?></b>
        </h4>
      </div>
  <?php endif; ?>


  <!-- Miolo -->
  <section id="miolo">
    <div class="container">
        <?php 
          $form = $this->beginWidget('GxActiveForm', array(
        'id' => 'motor-anuncio-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        'htmlOptions' => array('enctype' => 'multipart/form-data')
      ));
    ?>
        <div class="row">
          <div class="col-lg-12 col-sm-12">

            <div class="row filtros barra-titulo">
              <div class="col-lg-12 col-sm-12">
                <p>Campos de preenchimento obrigatório sinalizados com " * "</p>
                <div class="row">
                  <div class="col-lg-12 col-sm-12">
                    <h4 class="com-barra-abaixo"><b>Preencha as informações abaixo</b></h4>
                  </div>
                  <div class="col-lg-8 col-sm-12"></div>
                </div>
              </div>
            </div>
          </div>
        </div>


         <div class="row bg-faded">
          <div class="col-lg-12 col-sm-12 bloco3">

            <div class="row filtros">
              <div class="col-lg-12 col-sm-12">
                <div class="row">
                  <div class="col-lg-12 col-sm-12">
                    <h4 class="com-barra-abaixo"><b>Dados do</b><br/>motor*</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-sm-12">
                 <div class="form-group">
                    <label for="ano-lancamento">Marca: *</label>
                    <span id="span-marca" style="padding: 1em 0 !important;" class="estiliza-select">
                        <?php echo $form->dropDownList($motor,'motor_fabricantes_id', GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1))), array('class'=>'required')); ?>

                    </span>

                    <br/>
                    <small class="n-encontrou-marca">Não encontrou a marca?</small>
                  </div>

                  <br/>

                <div class="form-group">
                    <label for="link-video">Potência (HP / kW): *</label>
                    <?php echo $form->textField($motor, 'potencia', array('class'=>'campo-dados required')); ?>
                    <span class="unidade-medida"></span>
                </div>

                <div class="form-group">
                    <label for="link-video">Ano:</label>
                    <?php echo $form->textField($motor, 'ano', array('class'=>'campo-dados')); ?>
                    <span class="unidade-medida"></span>
                </div>

                <div class="form-group">
                    <label for="link-video">Horas de uso:</label>
                    <?php echo $form->textField($motor, 'horas', array('class'=>'campo-dados')); ?>
                    <span class="unidade-medida"></span>
                </div>

                
              </div>

                <div class="col-lg-6 col-sm-12">
                 <div class="form-group">
                    <label for="ano-lancamento">Tipo do motor: *</label>
                    <span id="span-tipo" style="padding: 1em 0 !important;" class="estiliza-select">
                        <?php echo $form->dropDownList($motor,'motor_tipos_id', GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1))), array('class'=>'required')); ?>
                    </span>
                    <br/>
                    <small class="n-encontrou-tipo">Não encontrou o tipo?</small>

                  </div>

                  <br/>

                <div class="form-group">
                    <label for="ano-lancamento">Novo ou usado: *</label>
                    <span style="padding: 1em 0 !important;" class="estiliza-select">
                        <?php echo $form->dropDownList($motor,'estado', array('N'=>'Novo','U'=>'Usado'), array('class'=>'required')); ?>
                    </span>
                  </div>

                    <div class="form-group">
                        <label for="preco">Valor R$: *</label>
                        <?php echo $form->textField($motor, 'valor', array('class'=>'campo-dados required', 'id'=>'valor')); ?>
                        <span class="unidade-medida"></span>
                    </div>
                    
                  </div>

            </div>
          </div>
        </div>


        <div class="row bg-faded">
          <div class="col-lg-12 col-sm-12 bloco3">

            <div class="row filtros">
              <div class="col-lg-12 col-sm-12">
                <div class="row">
                  <div class="col-lg-12 col-sm-12">
                    <h4 class="com-barra-abaixo"><b>Especificações </b><br/>técnicas</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-sm-12">

                <div class="form-group">
                    <label for="link-video">Cilindrada (L):</label>
                    <?php echo $form->textField($motor, 'cilindrada', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
                    <label for="link-video">RPM de aceleração:</label>
                    <?php echo $form->textField($motor, 'rpm', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
               <label for="link-video">Sistema de combustível:</label>
               <?php echo $form->textField($motor, 'combustivel', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
               <label for="link-video">Ampére / Watt do alternador:</label>
               <?php echo $form->textField($motor, 'ampere', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
              </div>

              <div class="col-lg-6 col-sm-12">
                <div class="form-group">
               <label for="link-video">Sistema de partida:</label>
               <?php echo $form->textField($motor, 'sistema_partida', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
               <label for="link-video">Direção:</label>
               <?php echo $form->textField($motor, 'direcao', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
               <label for="link-video">Comprimento do eixo (mm):</label>
               <?php echo $form->textField($motor, 'comprimento_eixo', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
               <label for="link-video">Relação de engrenagens:</label>
               <?php echo $form->textField($motor, 'relacao_engrenagens', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
                <div class="form-group">
               <label for="link-video">Peso seco (kg):</label>
               <?php echo $form->textField($motor, 'peso_seco', array('class'=>'campo-dados')); ?>
                  <span class="unidade-medida"></span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row bg-faded">
          <div class="col-lg-12 col-sm-12">

            <div class="row filtros">
              <div class="col-lg-12 col-sm-12">
                <div class="row">
                  <div class="col-lg-4 col-sm-12">
                    <h4 class="com-barra-abaixo"><b>Insira fotos </b><br/>do seu motor</h4>
                  </div>
                  <div class="col-lg-8 col-sm-12">
                    <p class="w-80">O seu motor é o protagonista! Não inclua logos, banners, textos promocionais, bordas, nem marcas d'água. Arraste as suas fotos para organizá-las.</p>
                  </div>
                </div>
              </div>
            </div>

            <ul class="lista-fotos" style="column-count: 6;" id="fotos">

                <?php foreach(MotorAnuncio::listarImagens($motor) as $motorImg): ?>

                    <?php $imagem = Yii::app()->request->baseUrl . '/public/motores/' . $motorImg->imagem; ?>

                    <li class="li-img li-img-vazia" data-nome='<?php echo $motorImg->imagem; ?>'>
                        <a href="#">
                            <img class="img-thumbnail" src="<?php echo $imagem; ?>"/>
                        </a>
                        <?php if($motorImg->ordem == 0): ?>
                            <span class='texto-img-principal' style='color:white !important;'>Imagem <b>Principal</b></span>
                        <?php endif; ?>
                    </li>

                <?php endforeach; ?>

                <?php $espacos = 6 - count($motor->motorImagens); ?>

                <?php for($i = 0; $i < $espacos; $i++): ?>
                    <li class="li-img li-img-vazia">
                        <a href="#">
                            <img class="img-thumbnail" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="bloco6 bg-faded">
              <div class="row filtros">
                <div class="col-lg-12 col-sm-12">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      <h4 class="com-barra-abaixo"><b>Descrição</b></h4>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <div class="form-group">
                    <?php echo $form->textArea($motor, 'descricao', array('class'=>'campo-dados')); ?>

                    <!--<label><small>Restam 60 caracteres</small></label>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!--<div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="bloco6 bg-faded">
              <div class="row filtros">
                <div class="col-lg-12 col-sm-12">
                  <div class="row">
                    <div class="col-lg-12 col-sm-12">
                      <h4 class="com-barra-abaixo"><b>Turbinadas</b></h4>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <div class="form-group">

                        aqui 

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>-->


        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="btns-right">
              <a style="visibility: hidden;" href="#" id="btn-preview" class="btn btn-padrao-branco borda-cinza text-left"><span class="pull-left">ver anúncio </span><i class="fa fa-angle-right pull-right"></i></a>
              <a class="btn btn-verde-claro" id="btn-publicar" href="#"><span class="pull-left">atualizar </span><i class="fa fa-check"></i></a>

            </div>
          </div>
        </div>

      <input style="display:none;" multiple="multiple" id="multiple-upload" type="file" name="MotorImagens[imagem][]"/>

      <input type="hidden" id="ordem-fotos" name="ordem-fotos"/>
      <input type="hidden" id="id" value="<?php echo Yii::app()->request->getQuery('id'); ?>"/>


      <?php $this->endWidget(); ?>
    </div>
    
  </section>



</body>



<script>
    $(document).ready(function() {

        var id = $("#id").val();

        /*if($(".msg_sucesso").length > 0) {
            setTimeout(function() {
                location.href = "https://www.bombarco.com.br/anuncios/anuncioPagamento?minha_conta=1&e=pagamento";
            }, 200);
            
        }*/

        $("#fotos").sortable({
            tolerance: 'pointer',
            update: function(event, ui) {
                $(".texto-img-principal").remove();
                $(".li-img").first().append("<span class='texto-img-principal' style='color:white !important;'>Imagem <b>Principal</b></span>");
                
                var posicao = ui.item.index();
                var idsInOrder = $("#fotos").sortable('toArray', {
                    attribute: 'data-nome'
                });

                idsInOrder = arr_filter(idsInOrder);

                $("#ordem-fotos").val(idsInOrder.join("|"));
            }
        });

        $(".n-encontrou-marca").on("click", function(e) {
            $("#span-marca").replaceWith("<input type='text' id='motor_fabricantes_titulo' name='MotorFabricantes[titulo]' class='campo-dados required'/>");
            $("#motor_fabricantes_titulo").focus();
            $(this).remove();
        });

        $(".n-encontrou-tipo").on("click", function(e) {
            $("#span-tipo").replaceWith("<input type='text' id='motor_tipos_titulo' name='MotorTipos[titulo]' class='campo-dados required'/>");
            $("#motor_tipos_titulo").focus();
            $(this).remove();
        });

        function validar() {

            var r = true;

            $(".required").each(function() {
                if ($(this).val() == "") {
                    console.log("??");
                    $(this).css("border", "#FF0000 solid 1px");
                    r = false;
                }
            });

            if (!r) $('html, body').animate({
                scrollTop: 50
            }, 'slow');

            return r;
        }

        $(".required").on("change", function() {
            $(this).css("border", "initial");
        });

        $('#valor').mask('000.000.000.000.000,00', {
            reverse: true
        });
        $("#valor").attr('maxlength', '50');

        $("body").on("click", ".li-img", function() {

            if($(".com-imagem").length < 6) {
                $("#multiple-upload").trigger("click");    
            }
            
        });

        $("#btn-publicar").on("click", function(e) {

            e.preventDefault();

            if (validar() == true) {

                var s = confirm("Confirmar?");

                if (s) {
                    $("#motor-anuncio-form").attr("action", "/motorAnuncio/update/" + id);
                    $("#motor-anuncio-form").attr("target", "_self");
                    $("#motor-anuncio-form").submit();
                }
            }
        });

        $("#btn-preview").on("click", function(e) {

            e.preventDefault();

            let url = new URL(window.location.href);
            let searchParams = new URLSearchParams(url.search);
            let pid = searchParams.get('pid');

            if (validar() == true) {

                var s = confirm("Confirmar?");

                if (s) {

                    $("#motor-anuncio-form").attr("action", "/previewMotor?pid=" + id);
                    $("#motor-anuncio-form").attr("target", "_blank");
                    $("#motor-anuncio-form").submit();
                }
            }
        });

        function arr_filter(arr) {
            var ind = -1,arr_len = arr ? arr.length : 0,resInd = -1,res = [];

            while (++ind < arr_len) {
                var val = arr[ind];

                if (val) {
                    res[++resInd] = val;
                }
            }

            return res;
        }

        function handleFileSelect(evt) {

            var files = evt.target.files;

            var qtde_espacos = $(".li-img-vazia").length;

            $('.li-img-vazia').slice((qtde_espacos - files.length)).remove();

            //$("#fotos").empty();

            // Loop through the FileList and render image files as thumbnails.
            for (var i = 0, f; f = files[i]; i++) {

                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                reader.onload = (function(theFile) {

                    return function(e) {

                        var li = $("<li data-nome='' class='li-img com-imagem'></li>");
                        var a = $("<a href='#'></a>");
                        //var img = $("<img style='width: 75% !important; height: 75% !important; max-height: 300px !important;'/>");
                        var img = $("<img class='img-thumbnail'/>");

                        $(li).attr("data-nome", theFile.name);

                        $(img).attr("src", e.target.result);
                        $(a).prepend(img);
                        $(li).prepend(a);

                        $("#fotos").prepend(li);
                    };
                })(f);

                reader.readAsDataURL(f);
            }


            if (files) {

                setTimeout(function() {

                    $(".texto-img-principal").remove();

                    $(".com-imagem").first().append("<span class='texto-img-principal' style='color:white !important;'>Imagem <b>Principal</b></span>");

                    $("#fotos").sortable({
                        tolerance: 'pointer',
                        update: function(event, ui) {
                            $(".texto-img-principal").remove();
                            $(".com-imagem").first().append("<span class='texto-img-principal' style='color:white !important;'>Imagem <b>Principal</b></span>");

                            var posicao = ui.item.index();
                            var idsInOrder = $("#fotos").sortable('toArray', {
                                attribute: 'data-nome'
                            });

                            idsInOrder = arr_filter(idsInOrder);

                            $("#ordem-fotos").val(idsInOrder.join("|"));
                        }
                    });

                    var idsInOrder = $("#fotos").sortable('toArray', {
                        attribute: 'data-nome'
                    });
                    idsInOrder = arr_filter(idsInOrder);
                    $("#ordem-fotos").val(idsInOrder.join("|"));


                }, 200);
            }

        }

        document.getElementById('multiple-upload').addEventListener('change', handleFileSelect, false);
    });
</script>
</html>
