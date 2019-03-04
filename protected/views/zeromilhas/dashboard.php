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
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/style.css?e=88655');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/responsive.css?e=3333f');?>
  <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/css/zeromilhas/jquery-ui.css?e=234');?>

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
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/owl.carousel.min.js?e=1344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bjqs.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/maskedinput.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/bootstrap-slider.min.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/modernizr.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/scripts.js?e=123', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/vue-2.5.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/axios-0.17.js?e=344', CClientScript::POS_END); ?>
  <?php Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery.lightbox_me.js', CClientScript::POS_END); ?>


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
          <h1>Dashboard
            <img src="<?php echo Yii::app()->baseUrl . '/img_zeromilhas/icones/ico_titulo.png'?>" alt="Titulo" />
          </h1>
          <p>Você nos melhores resultados.</p>
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
              <a class="nav-link" id="embarcacoes-tab" href="<?php echo Yii::app()->createUrl('embarcacoes/listaEstaleiro'); ?>" aria-controls="tab-embarcacoes" aria-selected="false">Meus Modelos</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="embarcacoes-tab" href="<?php echo Yii::app()->createUrl("embarcacoes/lista?v=0&e=anuncios"); ?>" aria-controls="tab-embarcacoes" aria-selected="false"> Classificados</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="dashboard-tab" href="<?php echo Yii::app()->createUrl("dashboard"); ?>" aria-controls="tab-dashboard" aria-selected="false">Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="mensagens-tab" href="<?php echo Yii::app()->createUrl("zeromilhas/mensagens"); ?>" aria-controls="tab-mensagens" aria-selected="false">Mensagens</a>
            </li>
              <li class="nav-item">
              <a class="nav-link" id="mensagens-tab" href="<?php echo Yii::app()->createUrl("zeromilhas/pagamento"); ?>" aria-controls="tab-mensagens" aria-selected="false">Pagamentos</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
        
            <div class="tab-pane fade show active" id="tab-dashboard" role="tabpanel" aria-labelledby="pills-contact-tab">
              <div class="row filtros">
                <div class="col-xl-5 col-lg-12 col-sm-12">
                  <div class="row">
                    <div class="col-xl-5 col-lg-12 col-sm-12">
                      <h4 class="com-barra"><b>Escolha um </b>período:</h4>
                    </div>
                    <div class="col-xl-7 col-lg-12 col-sm-12">
                      <!--<span class="estiliza-select">-->
                        <select @change="mudarPeriodo($event.target.value)" id="num-dias" class="w-80">
                          <!--<option value="" selected>Selecione</option>-->
                          <option value="15">Últimos 15 dias</option>
                          <option value="20">Últimos 20 dias</option>
                          <option selected value="30">Últimos 30 dias</option>
                          <option value="45">Últimos 45 dias</option>
                        </select>
                      <!--</span>-->
                    </div>
                  </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-sm-12">
                  <div class="row">
                    <div class="col-xl-5 col-lg-12 col-sm-12">
                      <h5>ou</h5>
                      <h4><b>procure por </b><br/>período específico:</h4>
                    </div>
                    <div class="col-xl-7 col-lg-12 col-sm-12">
                      <div class="row">
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12">
                          <!--<span class="estiliza-select">
                            <select id="data-inicio" class="w-100">
                              <option value="" selected>15/08</option>
                              <option value="1">15/07</option>
                              <option value="2">15/06</option>
                              <option value="3">15/05</option>
                            </select>
                          </span>-->
                          <div class="form-group">
                            <input type="text" style="line-height:4.00 !important;" class="form-control" id="de" placeholder="data de">
                          </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2 ajusta-meio">
                          <h5>à</h5>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-5">
                          <div class="form-group">
                            <input type="text" style="line-height:4.00 !important;" class="form-control" id="ate" placeholder="data até">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php if(count($rank_marcas) > 0): ?>
              <div class="row bg-faded">
                <div class="col-lg-3 cols-sm-12">
                  <h4 class="com-barra">Ranking <br/>das 10 Marcas mais buscadas<br/><br/><b>no catalogo zero milhas:</b></h4>
                </div>
                <div class="col-lg-9 col-sm-12">
                  <ul class="lista-5 rank-marcas">
                    <?php foreach($rank_marcas as $m): ?>
                        <li>
                          <span class="colocacao primeira"><i class="fa fa-star"></i></span>
                          <a href="/catalogo/<?php echo $m->empresa->slug;?>" style="display:flex; align-items: center; min-height:120px;"><img style="width:120px; height: auto; display:table; margin:auto;" src="<?php echo Zeromilhas::devolverLogoEmpresa($m->empresa); ?>" class="img-fluid"></a>
                          <p style="font-size: 15px !important;"><?php echo $m->empresa->razao; ?></p>
                        </li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              </div>
            <?php endif; ?>

              <?php if(count($rank_modelos) > 0): ?>
              <div class="row bg-faded" style="padding-bottom:2em;padding-right: 2em;">
                <div class="col-lg-3 cols-sm-12">
                  <h4 class="com-barra">Ranking <br/>dos modelos mais buscados<br/><br/><b>no catalogo zero milhas:</b></h4>
                </div>
                <div class="col-lg-9 col-sm-12 lista-modelos">
                  
                    <?php foreach($rank_modelos as $m): ?>
                        <?php $max_buscas = $rank_modelos[0]->total; ?>
                        <?php $width = $m->total . "%"; ?>
                        <div class="row row-rank-modelos">
                            <div class="col-lg-3">
                              <?php $desc = Embarcacoes::getAlt($m->embarcacao); ?>
                              <a style="color: #102e46 !important;" href="<?php echo Zeromilhas::gerarLinkDetalhe($m->embarcacao->id);?>" target="_blank"><h5 style="font-size: .95rem !important;"><?php echo $desc; ?></h5></a>
                            </div>
                            <div class="col-lg-9">
                              <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated porcentagem" role="progressbar" aria-valuenow="<?php echo $m->total;?>" aria-valuemin="0" aria-valuemax="<?php echo $max_buscas; ?>" style="width: <?php echo $width;?>"></div>
                                <span><b><?php echo $m->total; ?></b><br/>buscas</span>
                              </div>
                            </div>
                        </div>
                        <hr/>
                    <?php endforeach; ?>
                  
                </div>
              </div>
              <?php endif; ?>

              <?php if(count($meus_modelos) > 0): ?>
              <div class="row bg-faded meus-modelos">
                <div class="col-lg-3 cols-sm-12">
                  <h4 class="com-barra"><b>Meus <br/></b>modelos:</h4>
                </div>
                <div class="col-lg-9 col-sm-12">
                  <table id="tabela" class="table table-striped striped-2 w-100 tabela-dashboard">
                    <thead>
                      <tr>
                        <th>Modelo</th>
                        <th>Cliques</th>
                        <th>Enviar Mensagem</th>
                      </tr>
                    </thead>
                    <tbody class="tbody-meus-modelos">
                        <?php foreach($meus_modelos as $m): ?>
                            <tr class="tr-meus-modelos">
                                <td><a style="color: #102e46 !important;" href="<?php echo Zeromilhas::gerarLinkDetalhe($m->id);?>" target="_blank"><?php echo Embarcacoes::getAlt($m);?></a></td>
                                <td><?php echo ZeromilhasViewsModelos::totalizarClicks($m->id, $_GET);?></td>
                                <td><?php echo ZeromilhasViewsModelos::totalizarMensagens($m->id, $_GET);?></td>
                            </tr>
                        <?php endforeach;?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            <?php endif; ?>

            
            </div>
            <a id="btn-relatorio" style="margin-bottom:25px;" href="#" class="btn btn-laranja small pull-right"><span class="pull-left">Relatório </span><i class="fa fa-download"></i></a>
            <!--<div class="tab-pane fade" id="tab-mensagens" role="tabpanel" aria-labelledby="pills-mensagem-tab">..ggggddd.</div>-->
          </div>


        </div>
      </div>


    </div>

  </section>

                
              <a href="#topo" class="volta-topo" title="Topo"><i class="fa fa-angle-up"></i></a>


</div>


</body>
        <script>

        $.fn.sortElements = (function(){
 
            var sort = [].sort;
         
            return function(comparator, getSortable) {
         
                getSortable = getSortable || function(){return this;};
         
                var placements = this.map(function(){
         
                    var sortElement = getSortable.call(this),
                        parentNode = sortElement.parentNode,
         
                        // Since the element itself will change position, we have
                        // to have some way of storing its original position in
                        // the DOM. The easiest way is to have a 'flag' node:
                        nextSibling = parentNode.insertBefore(
                            document.createTextNode(''),
                            sortElement.nextSibling
                        );
         
                    return function() {
         
                        if (parentNode === this) {
                            throw new Error(
                                "You can't sort elements if any one is a descendant of another."
                            );
                        }
         
                        // Insert before flag:
                        parentNode.insertBefore(this, nextSibling);
                        // Remove flag:
                        parentNode.removeChild(nextSibling);
         
                    };
         
                });
         
                return sort.call(this, comparator).each(function(i){
                    placements[i].call(getSortable.call(this));
                });
         
            };
         
        })();

        $(document).ready(function() {

            $("#btn-relatorio").on("click", function(e) {
                e.preventDefault();

                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                let de = params.get("de");
                let ate = params.get("ate");
                let periodo = params.get("periodo");

                window.open('http://www.bombarco.com.br/relatorios/dashboardMarcas?de='+de+'&ate='+ate+'&periodo='+periodo, '_blank');
                window.open('http://www.bombarco.com.br/relatorios/dashboardModelos?de='+de+'&ate='+ate+'&periodo='+periodo, '_blank');

                if($(".meus-modelos").length > 0) {
                    window.open('http://www.bombarco.com.br/relatorios/dashboardMeusModelos?de='+de+'&ate='+ate+'&periodo='+periodo, '_blank');   
                }
                

            });

            $("#de, #ate").on("keypress", function(e) {
                if(e.which == 13) {
                    $(this).trigger("change");
                }
            });

            $("#de").on("change", function() {

                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                params.delete("de");
                params.delete("ate");
                params.delete("periodo");
                
                var split = $(this).val().split("/");

                var mes = split[1];
                var dia = split[0];
                var ano = split[2];

                params.append("de", ano+"-"+mes+"-"+dia);

                if($("#ate").val() != "") {
                    split = $("#ate").val().split("/");
                    mes = split[1];
                    dia = split[0];
                    ano = split[2];
                    
                    params.append("ate", ano+"-"+mes+"-"+dia);                        

                    window.location.href = window.location.pathname + "?" + params.toString();  
                }
            });

            $("#ate").on("change", function() {

                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                params.delete("de");
                params.delete("ate");
                params.delete("periodo");
                
                var split = $(this).val().split("/");


                var mes = split[1];
                var dia = split[0];
                var ano = split[2];

                params.append("ate", ano+"-"+mes+"-"+dia);

                if($("#de").val() != "") {
                    split = $("#de").val().split("/");
                    mes = split[1];
                    dia = split[0];
                    ano = split[2];
                    
                    params.append("de", ano+"-"+mes+"-"+dia);                        

                    window.location.href = window.location.pathname + "?" + params.toString();  
                }
            }); 
        });
            
        var detalhe = new Vue({ 
            delimiters: ['${', '}'],
            el: "#app",
            data: {
                emailnews: ""
            },
            created: function() {

            },

            mounted: function() {

                let url = new URL(window.location.href);
                let params = new URLSearchParams(url.search);

                if(params.has("de")) {

                    var split = params.get("de").split("-");

                    var mes = split[1];
                    var dia = split[2];
                    var ano = split[0];
                    var data_de = dia+"/"+mes+"/"+ano;
                    $("#de").val(data_de);

                    split = params.get("ate").split("-");
                    mes = split[1];
                    dia = split[2];
                    ano = split[0];
                    data_ate = dia+"/"+mes+"/"+ano;
                    $("#ate").val(data_ate);
                }

                if(params.has("periodo")) {
                    $("#num-dias").val(params.get("periodo"));
                }

                $("#de").mask("99/99/9999");
                $("#ate").mask("99/99/9999");

                $(".rank-marcas li:nth-child(2)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(2)").find("span").addClass("segunda");
                $(".rank-marcas li:nth-child(3)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(3)").find("span").addClass("terceira");
                $(".rank-marcas li:nth-child(4)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(4)").find("span").empty().append("<b>4º</b>");
                $(".rank-marcas li:nth-child(5)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(5)").find("span").empty().append("<b>5º</b>");
                $(".rank-marcas li:nth-child(6)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(6)").find("span").empty().append("<b>6º</b>");
                $(".rank-marcas li:nth-child(7)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(7)").find("span").empty().append("<b>7º</b>");
                $(".rank-marcas li:nth-child(8)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(8)").find("span").empty().append("<b>8º</b>");
                $(".rank-marcas li:nth-child(9)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(9)").find("span").empty().append("<b>9º</b>");
                $(".rank-marcas li:nth-child(9)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(9)").find("span").empty().append("<b>9º</b>");
                $(".rank-marcas li:nth-child(10)").find("span").removeClass("primeira");
                $(".rank-marcas li:nth-child(10)").find("span").empty().append("<b>10º</b>");

                //$(".porcentagem:eq(1)").css("width", "95%");
                //$(".porcentagem:eq(2)").css("width", "90%");
                //$(".porcentagem:eq(3)").css("width", "85%");
                //$(".porcentagem:eq(4)").css("width", "80%");

                /*var width = 90;
                $(".porcentagem").each(function(index) {
                    $(this).css("width", width.toString()+"%");
                    width -= 3;
                    console.log(width);
                });


                // deixa igual as porcentagens empatadas
                $(".row-rank-modelos:gt(0)").each(function() {
                    var qtde_buscas = $(this).find(".porcentagem").next().find("b").text();
                    var anterior = $(this).prev().prev().find(".porcentagem").next().find("b").text();
                    var width_anterior = $(this).prev().prev().find(".porcentagem").css("width");
                    if(qtde_buscas == anterior) {
                        $(this).find(".porcentagem").css("width", width_anterior);
                    }
                });*/

                // bubble sort na tbody do meus modelos (td:eq(1) eh click, td:eq(2) eh msg)
                /*$('.tr-meus-modelos').sortElements(function(a, b){
                    return parseInt($(b).find("td:eq(1)").text()) > parseInt($(a).find("td:eq(1)").text()) ? 1 : -1;
                });*/
            },
            methods: {
                mudarPeriodo: function (periodo) {

                    if($("#num-dias").val() == "") return false;

                    if($("#num-dias").val() == "999") {
                        location.href = "http://www.bombarco.com.br/dashboard";
                        return false;
                    }
                    
                    let url = new URL(window.location.href);
                    let params = new URLSearchParams(url.search);

                    params.delete("de");
                    params.delete("ate");
                    params.delete("periodo");

                    params.append("periodo", $("#num-dias").val());
                    window.location.href = window.location.pathname + "?" + params.toString();  


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
                }
            }
        });
       
        
    </script>
            </html>
