<?php
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-mask.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.validate.min.js', CClientScript::POS_END);
Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/partners.js', CClientScript::POS_END);
?>

<style>
#form_partner {

    /*background-image: url("https://www.bombarco.com.br/img/unifisa/fundo.png");
    background-size: cover;
    height: 100%;*/
}
</style>
<section class="content partner">
		<div class="line-gray-pb-top">
			<div class="container">
				<div>
					<span class="title-pb-1"><?php echo $title; ?></span>
					<span class="title-pb-2">Home > Parceiros > <?php echo $title; ?></span>
				</div>
			</div>
		</div>

		<div class="container partner-content-wrap">

			<div class="pure-g">

				<div class="pure-u-5-8">

					<div class="partner-content">

						<div class="pure-g">

							<!--<img src="https://www.bombarco.com.br/img/unifisa/banner.png" style="width: 95%;">-->
							<!--<div class="pure-u-4-5">
								<div style="margin-left:0px !important;" class="subtitle"><?php echo $subtitle; ?></div>
							</div>-->
						</div>

						<p style="margin: -25px 0 !important; text-align:justify;"><?php echo $text; ?></p>
					</div>

				</div>

				<div class="pure-u-3-8">

					<form id="form_partner" name="form_partner" action="<?php echo Yii::app()->createUrl('contatos/partner'); ?>" method="POST" class="partner-form-wrap">
						<br/>
						<div class="subtitle"><?php echo $texto_form ?></div>

						<div class="form-error">Erro de contato</div>

						<div class="select-type">
							<select name="type" id="partner_input" class="partner-input">
								<!--<option value="">Tipo</option>-->
								<option value="Lancha">Lancha</option>
								<option value="Veleiro">Veleiro</option>
								<option value="Jetski">Jetski</option>
								<option value="Pesca">Barcos de Pesca</option>
							</select>
						</div>

						<input name="pes-min" type="hidden" value="0"/>

						<!--<span class="slide-feet">
							<div class="validate-opacity-range"></div>
							<span class="title">Tamanho</span>

							<input data-prettify="false" type="text" id="feets" />

							<span class="under">de
								<span class="b">
									<span></span> pés
									<input name="pes-min" type="hidden" />
								</span>
							</span>
							<span class="above"><span class="prefix">até</span>
								<span class="b">
									<span></span> pés
									<input name="pes-max" type="hidden" />
								</span>
							</span>
						</span>-->

						<?php if($type != 'T'):?>
							<input type="text" name="price" placeholder="<?php echo $placeholder_preco ?>*" class="partner-input" required />
						<?php endif; ?>
						<input type="text" name="name" placeholder="Nome*" class="partner-input" required />
						<input type="email" name="email" placeholder="Email*" class="partner-input" required />
						<input type="tel" name="phone" id="phone" placeholder="Telefone*" class="partner-input" required />

						<?php if($type == 'T'):?>
							<input type="text" name="local_partida" placeholder="Local de partida*" class="partner-input" required />
							<input type="text" name="local_destino" placeholder="Local de destino*" class="partner-input" required />
							<div class="select-type">
								<select name="fabricante" id="fabricante-embarcacao" class="partner-input">
									<option value="" selected="selected">Nome do fabricante</option>
								</select>
							</div>
							<div class="select-type">
								<select name="modelo" id="modelo-embarcacao" class="partner-input">
									<option value="" selected="selected">Nome do modelo</option>
								</select>
							</div>

						<?php endif; ?>
						<br/><br/><br/><br/>
						<?php if($type == 'F'):?>
							<input type="submit" value="<?php echo $texto_botao ?>" class="partner-submit" onclick="ga('send', 'event', 'link', 'click', 'Financiamento');" />
						<?php elseif($type == 'C'): ?>
							<input type="submit" value="<?php echo $texto_botao ?>" class="partner-submit" onclick="ga('send', 'event', 'link', 'click', 'Consorcio');" />
						<?php else: ?>
							<input type="submit" value="<?php echo $texto_botao ?>" class="partner-submit" onclick="ga('send', 'event', 'link', 'click', 'Transporte');" />
						<?php endif; ?>

						<small>* Campos obrigatórios</small>

						<input type="hidden" name="type_partner" value="<?php echo $type; ?>" />
						<input type="hidden" name="partner" value="<?php echo $partner; ?>" />
						<input type="text" name="PuUK8SmP" value="" style="display:none !important;" />

					</form>

				</div>

			</div>

		</div>

</section>
<script>
	$(document).ready(function() {


		setTimeout(function(){ $("#partner_input").trigger("change"); }, 200);
		

		$("#partner_input").on("change", function() {
			var val = $(this).val();
			var macros_id = "";
			if(val == "Lancha") { macros_id = 2; }
			else if(val == "Veleiro") { macros_id = 3; }
			else if(val == "Jetski") { macros_id = 1; }
			else { macros_id = 4; }

			$.ajax({
                url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoes'),
                data: {embarcacao_macros_id: macros_id},
                type: "POST",
                success: function (resp) {

                    $("#fabricante-embarcacao").empty();
                    $("#fabricante-embarcacao").append("<option selected='selected' value=''>Selecione</option>").trigger('create');

                    if (resp != -1) {

                        var fabricantes = JSON.parse(resp.trim());

                        for (var i = 0; i < fabricantes.length; i++) {
                            var option = $('<option value="' + fabricantes[i].id + '">' + fabricantes[i].titulo + '</option>');
                            $("#fabricante-embarcacao").append(option).trigger("create");
                        }
                    }

                },
                error: function (x, r, msg) {
                    alert(JSON.stringify(msg));
                }
            });
		});

		$("#fabricante-embarcacao").on("change", function () {

	        var embarcacao_fabricantes_id = $(this).val();

	        $.ajax({
	            url: Yii.app.createUrl('utils/loadModelosEmbarcacoes'),
	            data: {embarcacao_fabricantes_id: embarcacao_fabricantes_id},
	            type: 'POST',
	            success: function (response) {


	                $("#modelo-embarcacao").html("");

	                if (response != "-1") {

	                    var modelos = JSON.parse(response.trim());

	                    $("#modelo-embarcacao").append('<option selected="selected" value="">Selecione</option>').trigger('create');


	                    for (var i = 0; i < modelos.length; i++) {
	                        var option = $('<option value="' + modelos[i].id + '">' + modelos[i].titulo + '</option>');
	                        $("#modelo-embarcacao").append(option).trigger("create");

	                    }

	                }
	            }
	        });

	    });
	});
</script>
