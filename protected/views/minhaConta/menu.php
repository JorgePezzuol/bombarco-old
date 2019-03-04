
<div class="container">
    <span class="logo-minha-conta">Minha Conta</span>
    <a data-link="perfil" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('usuarios/update', array('id' => Yii::app()->user->id)); ?>" id="link-perfil">Perfil</a>
    <a data-link="favoritos" class="botao-minha-conta btninst" href="<?php echo Yii::app()->createUrl('embarcacoes/favoritos'); ?>">Favoritos</a>

    <a data-link="" id="me-avse" class="botao-minha-conta btninst aba-minha-conta" href="#"><span>!</span>Me avise</a>

    <?php if (Usuarios::temPlanoClassificado()): ?>
        <a id="minha-conta-classificados" data-link="anuncios" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('embarcacoes/lista?v=0'); ?>">Minhas Embarcações</a>
    <?php endif; ?>

    <?php //if (Usuarios::possuiClassificadosVendidos()): ?>
        <!--<a id="minha-conta-classificados" data-link="vendidos" class="botao-minha-conta btninst aba-minha-conta" href="<?php //echo Yii::app()->createUrl('embarcacoes/lista?v=1'); ?>">Vendidos</a>-->
    <?php //endif; ?>

    <?php if (MotorAnuncio::model()->exists("usuarios_id = :usuarios_id", array(":usuarios_id" => Yii::app()->user->id))): ?>
        <a id="minha-conta-classificados" data-link="motores" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('motorAnuncio/meusMotores'); ?>">Motores</a>
    <?php endif; ?>

    <?php $empresa = Usuarios::getEmpresa(); ?>
    <?php if ($empresa != null): ?>
        <?php
        //$link_update_empresa = Yii::app()->createUrl('empresas/update', array('id'=>Usuarios::getEmpresa()->id));
        ?>
        <?php if ($empresa->macros_id == 3 && $empresa->destaque == 1): ?>

            <?php $link_update_empresa = Empresas::mountUrl($empresa, Macros::$macro_by_slug['estaleiro']); ?>
            <!--<a data-link="empresa" class="botao-minha-conta btninst aba-minha-conta" href="<?php //echo $link_update_empresa; ?>">Estaleiro</a>-->
            <a data-link="empresa" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('dashboard'); ?>">Dashboard</a>
        <?php else: ?>
            <?php //$link_update_empresa = Empresas::mountUrl($empresa, Macros::$macro_by_slug['empresa']); ?>
            <!--<a data-link="empresa" class="botao-minha-conta btninst aba-minha-conta" href="<?php //echo $link_update_empresa; ?>">Guia de Empresas</a>-->
        <?php endif; ?>
    <?php endif; ?>



    <?php if (Usuarios::getPlanoCorrenteEstaleiro() != null): ?>
        <a data-link="anuncios-estaleiro" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('embarcacoes/listaEstaleiro'); ?>">Modelos</a>
    <?php endif; ?>

    <?php
    //$countMensagens = Contatos::model()->count('usuarios_id_dest=:usuarios_id and status = 0', array(':usuarios_id' => Yii::app()->user->id));
    $countMensagens = Contatos::model()->count('email_dest=:email_dest and status = 0', array(':email_dest' => Usuarios::getUsuarioLogado()->email));
    ?>

    <?php if ($countMensagens > 0): ?>
        <a id="mensagem-link" data-link="mensagens" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('contatos/mensagens'); ?>">
            <span><?php echo $countMensagens; ?></span>Mensagens
        </a>
    <?php else: ?>
        <a id="mensagem-link" data-link="mensagens" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('contatos/mensagens'); ?>">
            Mensagens
        </a>
    <?php endif; ?>


    <?php if (Usuarios::getOrdens() != null): ?>
        <a id="pagamento" data-link="pagamento" class="botao-minha-conta btninst aba-minha-conta" href="<?php echo Yii::app()->createUrl('anuncios/anuncioPagamento', array('minha_conta' => 1)); ?>">Pagamentos</a>
    <?php endif; ?>

    
</div>


<div class="lbox-ag" id="lbox-detemba" style="left: 50%; width: 535px !important; margin-left: -266px; z-index: 1002; position: absolute; top: 50%; margin-top: -235px; display: none;">
        <div class="texts-lbox-ag">
            <input type="button" id="close-form-contato" class="fechar-form close" value="X">
            <div>
                <span class="ev-titleb" style="width:520px !important;">Selecione um modelo e te enviaremos uma notificação assim que um novo anúncio entrar no site<br></span>
                <span id="erro-contato" style="color:red;"></span>
            </div>
        </div>

        <div id="erro-contato-anunciante" class="div-sucess-lbox"></div>


        		<div class="quadro-box-cadastro-5a">

					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Categoria:</span>
					</div>
					<div class="select-form-cadastrar3" id="input-fabricante">
						<select id="select-categoria-avisr" class="required" name="Embarcacoes[embarc_fab]">
							<option value="" selected>Selecione</option>
							<option value="2">Lancha</option>
							<option value="4">Pesca</option>
							<option value="3">Veleiro</option>
							<option value="1">Jet Ski</option>
						</select>
					</div>
					<div class="errorMessage" id="error-fabricante"></div>
				</div>

				<div class="quadro-box-cadastro-5a">

					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Fabricante:</span>
					</div>
					<div class="select-form-cadastrar3" id="input-fabricante">
						<select id="select-fab-avisr" class="required" name="Embarcacoes[embarc_fab]"><option>Selecione</option></select>
					</div>
					<div class="errorMessage" id="error-fabricante"></div>
				</div>

				<div class="quadro-box-cadastro-5a">

					<div class="div-cadastro-green">
						<span class="text-cadastro-green">Modelo:</span>
					</div>
					<div class="select-form-cadastrar3" id="input-fabricante">
						<select id="select-modelo-avisr" class="required" name="Embarcacoes[embarc_fab]"><option>Selecione</option></select>
					</div>
					<div class="errorMessage" id="error-fabricante"></div>
				</div>

        <br/><br/>
        <input type="button" name="botao-cadastrar-form" class="botao-cadastrar-form" id="btn-avisar" value="ENVIAR">
    </div>


<!-- script para carregar a classe active nos links do menu do minha conta -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

<script>
    $(document).ready(function () {

    	/*if (localStorage.getItem("carulina") === null) {
 			localStorage.setItem("carulina");
 			
		}*/

		$("#select-categoria-avisr").on("change", function() {	

			if($(this).val() != "") {

				var macros_id = $(this).val();

				$.ajax({
	                url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoes'),
	                data: {embarcacao_macros_id: macros_id},
	                type: "POST",
	                success: function (resp) {

	                    $("#select-fab-avisr").empty();
	                    $("#select-fab-avisr").append("<option selected='selected' value=''>Selecione</option>").trigger('create');

	                    if (resp != -1) {

	                        var fabricantes = JSON.parse(resp.trim());

	                        for (var i = 0; i < fabricantes.length; i++) {
	                            var option = $('<option value="' + fabricantes[i].id + '">' + fabricantes[i].titulo + '</option>');
	                            $("#select-fab-avisr").append(option).trigger("create");
	                        }

	                    }

	                },
	                error: function (x, r, msg) {
	                    alert(JSON.stringify(msg));
	                }
	            });
			}
		});

		$("#select-fab-avisr").on("change", function() {


			if($(this).val() != "") {

				var embarcacao_fabricantes_id = $(this).val();

				$.ajax({
		            url: Yii.app.createUrl('utils/loadModelosEmbarcacoes'),
		            data: {embarcacao_fabricantes_id: embarcacao_fabricantes_id},
		            type: 'POST',
		            success: function (response) {


		                $("#select-modelo-avisr").html("");

		                if (response != "-1") {

		                    var modelos = JSON.parse(response.trim());

		                    $("#select-modelo-avisr").append('<option selected="selected" value="">Selecione</option>').trigger('create');


		                    for (var i = 0; i < modelos.length; i++) {
		                        var option = $('<option value="' + modelos[i].id + '">' + modelos[i].titulo + '</option>');
		                        $("#select-modelo-avisr").append(option).trigger("create");

		                    }

		                }
		            }
		        });
			}
		});


		$("#btn-avisar").on("click", function() {

			$(".required").each(function() {

				if($(this).val() == "") {
					return false;
				}
			});

			$.ajax({

				url: Yii.app.createUrl('embarcacoes/avisarModelo'),
	            data: {
	            	embarcacao_fabricantes_id: $("#select-fab-avisr").val(),
	            	embarcacao_modelos_id: $("#select-modelo-avisr").val(),
	            	embarcacao_macros_id: $("#select-categoria-avisr").val()
	            },
	            type: 'POST',
	            success: function (response) {

	                if (response.trim() == "1") {

	                	alert("Enviaremos um e-mail assim que um novo modelo do tipo selecionado for anunciado.")

	                }
	                else {
	                	alert("Erro inesperado");
	                }
	            }
			});
		});

		$("#me-avse").effect( "pulsate", {times:8}, 10000 );

		$("#me-avse").on("click", function() {


			$('#lbox-detemba').lightbox_me({
                centered: true
        	});
		});
    	
        var link = getUrlParameter("e");

        $(".botao-minha-conta").each(function() {

            if($(this).data("link") == link) {

                $(this).addClass("active");
                return;
            }
        });

        // faz aparecer que a aba esta ticada de acordo com oparam na url
        $('.botao-minha-conta').on("click", function (e) {

            e.preventDefault();

            var data_link = $(this).data("link");

            if(data_link == 'empresa') {
                location.href = Yii.app.createUrl("dashboard");
                return false;
            }

            var href = $(this).attr("href");

            var href_param = href+"?e="+data_link;

            if (href.match(/\?./)) {
                href_param = href+"&e="+data_link;                
            }

            location.href = href_param;
        });



    });
</script>
