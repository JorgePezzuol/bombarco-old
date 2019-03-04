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
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/tether.min.css?1212');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bootstrap.min.css?e=2333'); ?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/font-awesome.min.css?e1');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/reset.css');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/bjqs.css?e=234');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/style.css?e=22223');?>
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

  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/functions_zeromilhas.js', CClientScript::POS_END); ?>


  

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
            <small>cadastrar</small>
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
      <div class="container">
        <h4>
            <b style="color:green;>"><?php echo Yii::app()->user->getFlash('msg_sucesso'); ?></b>
        </h4>
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
                    <h4 class="com-barra-abaixo"><b>Informações</b><br/>*</h4>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-6 col-sm-12">
                 <div class="form-group">
                    <label for="ano-lancamento">Marca:*</label>
                    <span style="padding: 1em 0 !important;" class="estiliza-select">
                        <?php echo CHtml::dropDownList('MotorAnuncio[motor_fabricantes_id]', '',
                            GxHtml::listDataEx(MotorFabricantes::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1))),
                            array('prompt'=>'Selecione')); ?>

                    </span>
                  </div>

                <div class="form-group">
                    <label for="link-video">Potência (HP / kW):</label>
                    <?php echo $form->textField($motor, 'potencia', array('class'=>'campo-dados')); ?>
                    <span class="unidade-medida"></span>
                </div>
                 <div class="form-group">
                    <label for="ano-lancamento">Tipo:*</label>
                    <span style="padding: 1em 0 !important;" class="estiliza-select">
                        <?php echo CHtml::dropDownList('MotorAnuncio[motor_tipos_id]', '',
                            GxHtml::listDataEx(MotorTipos::model()->findAllAttributes(null, true, 'status=:status order by titulo asc', array(':status'=>1))),
                            array('prompt'=>'Selecione')); ?>

                    </span>
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
                    <h4 class="com-barra-abaixo"><b>Especificações </b><br/>técnicas*</h4>
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

            <ul class="lista-fotos count5" id="fotos">
              <li class="li-img">
              	<a href="#">
              	<img id="img-0" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/>
              </a>
              <span>Imagem <b>Principal</b></span>
              </li>
              <li class="li-img"><a href="#"><img id="img-1" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-2" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-3" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-4" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-5" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-6" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-7" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-8" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
              <li class="li-img"><a href="#"><img id="img-9" src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/sem_imagem.png'?>" alt="Espaço para Imagem"/></a></li>
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
                    <textarea class="campo-dados" name="MotorAnuncio[descricao]" placeholder="Descrever com detalhes o seu motor aumenta a interação com o comprador e a sua marca ganha mais confiança"></textarea>
                    <!--<label><small>Restam 60 caracteres</small></label>-->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12 col-sm-12">
            <div class="btns-right">
              <a href="#" id="btn-preview" class="btn btn-padrao-branco borda-cinza text-left"><span class="pull-left">ver anúncio </span><i class="fa fa-angle-right pull-right"></i></a>
              <a class="btn btn-verde-claro" id="btn-publicar" href="#"><span class="pull-left">publicar </span><i class="fa fa-check"></i></a>

            </div>
          </div>
        </div>

	  	<input style="display:none;" multiple="multiple" id="multiple-upload" type="file" name="MotorImagens[imagem][]"/>
        <input type="hidden" id="ordem-fotos" name="ordem-fotos"/>

      <?php $this->endWidget(); ?>
    </div>
    
  </section>



</body>



    <script>

        $(document).ready(function(){

        	$("body").on("click", ".li-img", function() {
        		$("#multiple-upload").trigger("click");
        	});

      		$("#btn-publicar").on("click", function(e) {
      			e.preventDefault();

                var s = confirm("Confirmar?");

                if(s) {
                    $("#motor-anuncio-form").submit();
                }
      			
      		});

            $("#btn-preview").on("click", function(e) {

                e.preventDefault();

                let url = new URL(window.location.href);
                let searchParams = new URLSearchParams(url.search);
                let pid = searchParams.get('pid');

                console.log("asd");
                
                $("#motor-anuncio-form").attr("action", "/previewMotor?pid="+pid);
                $("#motor-anuncio-form").submit();

            });

			function handleFileSelect(evt) {

			    var files = evt.target.files; 

			    $("#fotos").empty();

			    // Loop through the FileList and render image files as thumbnails.
			    for (var i = 0, f; f = files[i]; i++) {

			        if (!f.type.match('image.*')) {
			            continue;
			        }

			        var reader = new FileReader();

			        reader.onload = (function (theFile) {

			            return function (e) {

			                var li = $("<li data-nome='' class='li-img'></li>");
			                var a = $("<a href='#'></a>");
			                var img = $("<img style='width: 85% !important;'/>");

                            $(li).attr("data-nome", theFile.name);

			                $(img).attr("src", e.target.result);
			                $(a).append(img);
			                $(li).append(a);

			                $("#fotos").append(li);
			            };
			        })(f);

			        reader.readAsDataURL(f);
			    }


			    if(files) {
			    	setTimeout(function() { 

		    			$("#fotos li").first().append("<span class='texto-img-principal' style='color:white !important;'>Imagem <b>Principal</b></span>");

		    		    $("#fotos").sortable({ 
					        tolerance: 'pointer',
					        update: function(event, ui) {
					        	$(".texto-img-principal").remove();
					        	$("#fotos li").first().append("<span class='texto-img-principal' style='color:white !important;'>Imagem <b>Principal</b></span>");

                                var posicao = ui.item.index();
                                var idsInOrder = $("#fotos").sortable('toArray', {attribute: 'data-nome'});

                                $("#ordem-fotos").val(idsInOrder.join("|"));

                                console.log(posicao);
                                console.log(idsInOrder);
					        }
					    });	 
			    	}, 200);
			    }
			    
			}

			document.getElementById('multiple-upload').addEventListener('change', handleFileSelect, false);
        });
    </script>
</html>
