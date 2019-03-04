<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta name="author" content="Shelley Macedo" />
<meta name="description" content="FINAL DE SEMANA PARA CASAIS A BORDO DE UM VELEIRO." />
<meta name="keywords" content="bombarco, no mar com bombarco, barcos, embarcações, marítimo" />
<link rel="shortcut icon" href="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/favicon.ico'?>" />
<title>No Mar com Bombarco</title>

<meta name="viewport" content="width=device-width, initial-scale=1"/>

<!-- CSS  -->
<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link href="//stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">


<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/css/bootstrap/bootstrap.min.css');?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/bombarcoshop/css/customizado.css?e='.microtime()); ?>
<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/css/style.min.css?e='.microtime());?>

<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<?php 
	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/js/bootstrap/bootstrap.js', CClientScript::POS_END); 
 	Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/js/scripts.js?e='.microtime(), CClientScript::POS_END); 
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
    Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
?>

<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

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
<body id="topo">
        <section class="preloader">
            <img src="<?php echo Yii::app()->createUrl('img/loader.gif'); ?>" alt=""/>
        </section>

<header></header>

<div id="banner" class="carousel slide" data-ride="carousel">
<div class="carousel-inner">
<div class="carousel-item active d-block w-100" style="background:url(<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/banners/banner_principal.png'?>) no-repeat 50% 50% / cover;">
<div class="row limite col-lg-8">
<div class="col-lg-5 col-sm-12">
<div class="navbar">
<a href="#" class="navbar-brand"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/logo.png'?>" alt="Bem-Vindo ao No Mar com Bombarco!" /> <h1>No Mar com Bombarco</h1></a>
</div>
<h2>Final de semana para casais a bordo de um veleiro.</h2>
<p class="branco-italico">Uma experiência única e inesquecível!</p>
</div>
<div class="col-lg-7 col-sm-12">
<iframe src="https://www.youtube.com/embed/mLOsxmxvpPs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
<a href="#" class="btn-amarelo btn-comprar">Comprar Passeio</a>
</div>
</div>
<div class="row absolute">
<div class="carousel-caption limite col-lg-8">
<div class="limite col-lg-11">
<p>Você já pensou em passar um final de semana inteiro velejando? Conhecer lugares únicos e impossíveis de chegar por terra? E, ainda por cima, com serviço de bordo, cozinheiro e marinheiro particulares? Certamente é uma experiência inesquecível!</p>
<p><b>No Mar com Bombarco </b>vai levar 12 casais, em três veleiros, durante três dias para um passeio único pelo litoral em Angra dos Reis e Paraty. Diversão, tranquilidade e conforto em meio a natureza.</p>
<p><b>Essa é a oportunidade perfeita de curtir uma aventura diferente ao sabor dos ventos.</b></p>
</div>
</div>
</div>
</div>
</div>
</div>

<section id="bloco-itens" class="areia">
<div class="container">
<h3>Nesse passeio você vai:</h3>
<div class="itens d-flex flex-wrapper justify-content-center">
<div class="item">
<span class="num">
<b>1.</b>
<img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/itens/item01.png'?>" alt="Nesse Passeio">
</span>
<p>Conhecer lugares incríveis, acessíveis somente por via marítima;</p>
</div>
<div class="item">
<span class="num">
<b>2.</b>
<img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/itens/item02.png'?>" alt="Nesse Passeio">
</span>
<p>Aprender muito sobre navegação e barco à vela;</p>
</div>
<div class="item">
<span class="num">
<b>3.</b>
<img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/itens/item03.png'?>" alt="Nesse Passeio">
</span>
<p>Fazer novas amizades - com casais que curtem aventura, assim como você;</p>
</div>
<div class="item">
<span class="num">
<b>4.</b>
<img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/itens/item04.png'?>" alt="Nesse Passeio">
</span>
<p>Curtir todos os momentos sem preocupação com a navegação ou o preparo da alimentação.</p>
</div>
<div>
<div>
<div>
</section>

<section id="bloco-azul" class="azul">
<div class="container">
<div class="row">
<div class="limite col-lg-11">
<div class="bloco-flutuante">
<p class="normal">Ao todo são 48 horas de jornada pelas águas de <b>Angra dos Reis</b> e <b>Paraty</b>. <br/>Passeio e alimentação do casal para os três dias.</p>
<p class="destaque">Doze casais em três veleiros catamarã. <b>Cada veleiro tem 4 suites.</b></p>
</div>

<div class="conteudo">
<p>Investimento: <b class="tachado">R$ 2.750,00</b> (preço por casal)</p>
<p class="destaque-areia"><span>Aproveite a pré-venda especial por tempo limitado - <b>desconto de 35%</b></span></p>
<p class="descreve"><b>R$ 1.787,50/casal</b>(desconto de R$ 962,50)<small>à vista ou em 2X no cartão de crédito *apenas para os primeiros quatro casais</small></p>
<a href="#" class="btn btn-amarelo btn-comprar">Sim! Quero viver essa <b>aventura</b>!</a>
<p class="upper"><b>Vagas Limitadas!</b></p>
<div>
</div>
</div>
<div>
</section>

<section id="bloco-imagem" class="imagem">
<div class="container">
<div class="row">
<div class="limite col-lg-11">
<h4>Ao final dessa fantástica jornada você voltará:</h4>
<div class="conteudo">
<p class="destaque-areia"><span>Com as energias renovadas;</span></p>
<p class="destaque-areia"><span>Cheio de boas histórias para contar;</span></p>
<p class="destaque-areia"><span>Com novos amigos, casais que amam mar e aventura;</span></p>
<p class="destaque-areia"><span>Ansioso para a próxima oportunidade.</span></p>

<span class="divisor"><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/icones/seta_baixo.png'?>" alt="Navegue" /></span>

<p>Investimento:  <b class="tachado">R$ 2.750,00</b> (preço por casal)</p>
<p><span>Aproveite a pré-venda especial por tempo limitado - <b>desconto de 35%</b></span></p>
<p><b>R$ 1.787,50/casal</b>(desconto de R$ 962,50) <small>à vista ou em 2X no cartão de crédito *apenas para os primeiros quatro casais </small></p>
<a href="#" class="btn btn-amarelo btn-comprar">Sim! Quero <b>velejar</b>!</a>
<p class="upper"><b>Vagas Limitadas!</b></p>
</div>
<div>
<div>
<div>
</section>


<section id="bloco-bege" class="areia bloco-agenda">
<div class="container">
<div class="row">
<div class="col col-lg-4 col-sm-12">
<p class="text-right">Você terá toda estrutura necessária para fazer um passeio inesquecível! <b>Então o que este passeio inclui?</b></p>
</div>
<div class="col col-lg-8 col-sm-12">
<ul class="itens-inclusos d-flex align-content-stretch flex-wrap">
<li><span>Barco e Combustível</span></li>
<li><span>Hostes - cozinheiro particular que prepara os alimentos e mantém a cozinha limpa e organizada</span></li>
<li><span>Café da manhã, almoço, jantar e bebidas não-alcoólicas</span></li>
<li><span>Marinheiro</span></li>
</ul>
</div>
</div>
<div class="row agenda">
<div class="col col-lg-4 col-sm-12 branco text-left">
<h5>Agenda</h5>
<p class="reduzido">Dias <b>18</b>, <b>19</b> e <b>20</b> de <b>maio</b> de <b>2018</b></p>
<span class="titulo-menor"><b>Local de embarque: </b></span>
<p>Base da Wind Charter - Marina do Engenho, em Paraty | Rod. Rio-Santos (BR101) km 576</p>
<p class="descricao"><small>Aproveite a oportunidade de velejar pela Baía Mística de Paraty, pelas águas claras de Angra dos Reis e viver essa experiência inesquecível ao lado do Bombarco e das principais empresas do mercado náutico.</small></p>
</div>
<div class="col col-lg-8 col-sm-12 azul-escuro conteudo-reduzido">
<p>Investimento:  <b class="tachado">R$ 2.750,00</b> (preço por casal)</p>
<p class="destaque-azul"><span>Aproveite a pré-venda especial por tempo limitado - <b>desconto de 35%</b></span></p>
<p class="descreve-reduzido"><b>R$ 1.787,50/casal</b>(desconto de R$ 962,50) <small>à vista ou em 2X no cartão de crédito *apenas para os primeiros quatro casais</small></p>
<a href="#" class="btn btn-amarelo btn-comprar">Quero reservar meu passeio <b>agora</b>!</a>
<p class="upper">Vagas Limitadas!</p>
</div>
</div>
</div>
</section>

<section id="bloco-barco" class="barco">
<div class="container">
<h6>Uma parceria</h6>
<div class="row">
<div class="limite col-lg-11">
<div class="bloco-flutuante-fixo">
<img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/icones/parceria.png'?>" alt="Parceria" />
</div>
<div class="row">
<div class="col col-lg-6 col-sm-12">
<div class="vazado text-left">
<p>Considerado o maior Classificado Náutico do Brasil, o Portal Bombarco  reúne as melhores oportunidades de negócio para embarcações seminovas do mercado, o mais completo catálogo de estaleiros e embarcações novas, a primeira tabela de preços de barcos do setor (Tabela Bombarco), um canal no Youtube que apresenta teste das embarcações e mais de 51 mil seguidores nas redes sociais, conteúdo selecionado, agenda e cobertura dos principais eventos náuticos, tornando o acesso à essas informações muito mais simplificado.</p>
<p>Com uma proposta arrojada e inovadora, o Bombarco é uma porta de entrada para novos marinheiros e um porto seguro para quem busca informações de valor e negócios, tanto para anunciantes quanto para compradores.</p>
</div>
</div>
<div class="col col-lg-6 col-sm-12">
<div class="vazado text-right">
<p>Com a missão de proporcionar experiências inesquecíveis para pessoas que buscam viver momentos extraordinários com aqueles que mais importam. a Wind Charter é uma empresa focada no turismo náutico e especializada na locação de embarcações, com experientes e tradicionais profissionais do mercado náutico.</p>
<p>Pensando no seu público-alvo, a Wind Charter tem diversas modalidades para charter, incluindo a locação por um dia, com ou sem tripulação (para quem não veleja ou velejadores experientes).</p>
</div>
</div>
</div>
</div>
</div>
<div>
</section>

<section id="bloco-finaliza" class="areia">
<div class="container">
<div class="div-branca conteudo">
<p>Investimento: <b class="tachado">R$ 2.750,00</b> (preço por casal)</p>
<p class="destaque-azul"><span>Aproveite a pré-venda especial por tempo limitado - <b>desconto de 35%</b></span></p>
<p class="descreve"><b>R$ 1.787,50/casal</b>(desconto de R$ 962,50) <small>à vista ou em 2X no cartão de crédito *apenas para os primeiros quatro casais</small></p>
<a href="#" class="btn btn-amarelo btn-comprar">Quero reservar meu passeio <b>agora</b>!</a>
<p class="upper"><b>Vagas Limitadas!</b></p>
</div>
</div>
</section>

<footer class="azul">
<div class="container">
<div class="bloco-flutuante-rodape">
<img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/logo.png'?>" alt="No Mar com Bombarco!" />
</div>
<p>Realização</p>
<ul class="lista-realizacao">
<li><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/icones/logo_bombarco.png'?>" alt="Bombarco" /></li>
<li><img src="<?php echo Yii::app()->baseUrl . '/themes/bombarcoshop/nomarcombombarco/images/icones/logo_wind.png'?>" alt="Wind" /></li>
</ul>
<ul class="links-rodape">
<!--<li><a href="#">Termos de Uso</a></li>
<li><a href="#">Política de Privacidade</a></li>-->
<li><a target="_blank" href="https://www.bombarco.com.br/contato">Contato</a></li>
</ul>
<p>&copy; 2018 - Todos os direitos reservados.</p>
</div>
</footer>

<a href="#topo" class="volta-topo"><i class="fa fa-angle-up"></i></a>

<!--  Scripts -->



<div class="modal fade" id="modalpagamento" role="dialog">

	 <div class="modal-dialog">

	    <div class="modal-content">

	       <div class="modal-header">

	          <button type="button" class="close" data-dismiss="modal">&times;</button>

	          <!--<h4 class="modal-title">Total: <strong id="titulo-modal">75,00</strong></h4>-->
	          <h4 class="modal-title">Pagamento</h4>

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

	                   <div class="row display-tr alert-error" style="display:none;background: none !important;">

	                      <div class="alert alert-danger">

	                         <strong>Erro!</strong> Ocorreu um erro ao realizar o pagamento.

	                      </div>

	                   </div>

	                   <div class="row display-tr alert-success" style="display:none;background: none !important;">

	                      <div class="alert alert-success" style="margin-bottom:0px;">

	                         <strong>Successo!</strong> Sucesso! um E-mail de confirmação foi enviado.

	                      </div>

	                   </div>

	                   <div class="panel-body">

	                      <?php echo "<input type='hidden' name='id_produto' value='".$produto->id."' id='id_produto'/>" ?>

	                      <?php echo "<input type='hidden' name='valor' value='".$produto->valor."' id='valor'/>" ?>

	                      <?php echo "<input type='hidden' name='valor_parcelado' value='".$produto->valor_parcelado."' id='valor_parcelado'/>" ?>

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

	                         <div class="col-md-12">

	                            <div class="form-group">

	                               <label for="cardNumber">E-MAIL</label>

	                               <input 

	                                  type="text"

	                                  class="form-control required"

	                                  name="email"

	                                  id="email"

	                                  placeholder="E-mail"

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

	                         <div class="col-xs-7 col-md-7">

	                            <div class="form-group">

	                               <label for="card_validate">Parcelas</smal></label>

	                               <div class="form-group">
	                               		<select id="option-parcelas" name="option-parcelas">
	                               			<option value="0">1x R$ 1.787,50</option>
	                               			<option value="1">2x R$ 956,325 (R$ 1.912,65)</option>
	                               		</select>
	                               </div>

	                               

	                            </div>

	                         </div>
	                    </div>

	                      <div class="row">

	                         <div class="col-xs-12">

	                            <button id="btn-confirmarpagamento" class="subscribe btn btn-success btn-lg btn-block" type="button">CONFIRMAR PAGAMENTO <b>*compra segura</b></button>

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





<script>
$(document).ready(function() {

	$(document).ajaxStart(function () {$('.preloader').show();});
    $(document).ajaxStop(function () {$('.preloader').hide();});


	var valor_bkp = $("#valor").val();

	function getCreditCardType(accountNumber) {

	  //start without knowing the credit card type
	  var result = "unknown";

	  //first check for MasterCard
	  if (/^5[1-5]/.test(accountNumber)) {
	    result = "Master";
	  }

	  //then check for Visa
	  else if (/^4/.test(accountNumber)) {
	    result = "Visa";
	  }

	  //then check for AmEx
	  else if (/^3[47]/.test(accountNumber)) {
	    result = "Amex";
	  }

	  return result;
	}

	function validateEmail(email) {
		if(email == "") return false;
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}

	function formatReal( int )
	{
	        var tmp = int+'';
	        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
	        if( tmp.length > 6 )
	                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

	        return tmp;
	}


	$("#card_number, #card_cvv").keyup(function() {
        $(this).val($(this).val().replace(/[^0-9]/g,""));
    });

    $("#card_validate").mask("99/9999");
    numeral.language('pt-br');

	$(".btn-comprar").on("click", function(e) {

		e.preventDefault();

		$("#valor").val(valor_bkp);
		$("#titulo-modal").css("color", "");

		var valor = $("#valor").val();
		//var price_format = numeral(valor).format('0,0.00');
		var price_format = formatReal(parseInt(valor));
		$("#titulo-modal").text("R$ "+price_format);
		$(".alert-error").hide();
	    $(".alert-success").hide();
        $('#modalpagamento').modal('show');
	});


	$("#btn-confirmarpagamento").on("click", function(e) {

		e.preventDefault();

		var flgok = true;
		$("#link-ebook").hide();

		$(".required").each(function() {
			if($(this).val() == "") {
				$(this).css("border-color", "red");
				flgok = false;
			}
		});

		if($("#card_validate").val().length != 7) {
			$("#card_validate").css("border-color", "red");
			flgok = false;
		}

		if(!validateEmail($("#email").val())) {
			$("#email").css("border-color", "red");
			flgok = false;
		}

		if(flgok) {

			_gaq.push(['_trackEvent', 'link', 'click', 'comprar-passeio']);

			$("#card_flag").val(getCreditCardType($("#card_number").val()));
	        $("#card_validate_month").val($("#card_validate").val().split("/")[0]);
	       	$("#card_validate_year").val($("#card_validate").val().split("/")[1]);

	       	$.ajax({
	       		url: Yii.app.createUrl("bombarcoshop/pagamentoCartaoPasseio"),
	       		data: {
	       			id_produto: $("#id_produto").val(),
	       			card_flag: $("#card_flag").val(),
	       			card_validate_month: $("#card_validate_month").val(),
	       			card_validate_year: $("#card_validate_year").val(),
	       			card_name: $("#card_name").val(),
	       			card_number: $("#card_number").val(),
	       			card_cvv: $("#card_cvv").val(),
	       			parcelado: $("#option-parcelas").val(),
	       			email: $("#email").val()
	       		},
	       		type: "POST",
	       		success: function(resp) {

	       			var retorno = JSON.parse(resp.trim());

	       			if(retorno.ok == 1) {
	       				$(".alert-error").hide();
	       				$(".alert-success").show();
	       				$(".required").each(function() {
	       					$(this).val("");
	       				});
	       			}
	       			// erro pagamento
	       			else {
	       				$(".alert-success").hide();
	       				$(".alert-error").show();
	       			}
	       			
	       		},
	       		error: function(x, h, z) {
	       			$(".alert-success").hide();
	       			$(".alert-error").show();
	       		}
	       	});
		}
	});
});
</script> 



</body>
</html>