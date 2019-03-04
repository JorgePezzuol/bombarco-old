$(document).ready(function(){

	/* Form de cadastro */
	numeral.language('pt-br');
		
	/**
	 * Setando formato de moeda para inputs
	 */
	$('input[id$=_valor]').priceFormat({
	    prefix: '',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
	    clearPrefix: true
	});

	/**
	 * Validando o preco da embarcacao
	 */
	$('input[id$=_valor]').blur(function(){
		
		price = numeral().unformat($(this).val());
		max = $(this).data('maxprice');

		if (price > max) {
			price_format = numeral(max).format('0,0.00');
			$(this).val(price_format);
		};

	});

	$("#macro").on("change", function() {

			var embarcacao_macros_id = $(this).val();

			$.ajax({

				url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoes'),
				data: {embarcacao_macros_id: embarcacao_macros_id},
				type: "POST",

				success: function(resp) {

					if(resp != -1) {
						$("#fabricante").empty();
						$("#fabricante").append("<option selected='selected' value=''>Selecione</option>").trigger('create');
						var fabricantes = JSON.parse(resp.trim());

						for(var i =0; i < fabricantes.length; i++) {
							var option = $('<option value="'+fabricantes[i].id+'">'+fabricantes[i].titulo+'</option>');
							$("#fabricante").append(option).trigger("create");
						}

						// habilitar select e checkbox do fabricante
						$("#fabricante").prop("disabled", false);

					}
				
					
					
				},

				error: function(x, r, msg) {
					alert(JSON.stringify(msg));
				}
			});
	});

	$("#fabricante").on("change", function() {

		var embarcacao_fabricantes_id = $(this).val();

		$.ajax({
			url: Yii.app.createUrl('utils/loadModelosEmbarcacoes'),
			data: {embarcacao_fabricantes_id: embarcacao_fabricantes_id},
			type: 'POST',

			success: function(response) {


				$("#modelo-embarcacao").html("");

				if(response != "-1") {

					var modelos = JSON.parse(response.trim());
					
					$("#modelo-embarcacao").append('<option selected="selected" value="">Selecione</option>').trigger('create');


					for(var i =0; i < modelos.length; i++) {
						var option = $('<option value="'+modelos[i].id+'">'+modelos[i].titulo+'</option>');
						$("#modelo-embarcacao").append(option).trigger("create");
						
					}

					$("#modelo-embarcacao").prop("disabled", false);
					$("#n-encontrou-modelo-fabricante").prop("disabled", false);
				}
			}
		});
	});

	$("#Motores_motor_fabricantes_id").on("change", function () {

        var motor_fabricantes_id = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadMotorModelos'),
            type: 'post',
            data: {
                motor_fabricantes_id: motor_fabricantes_id
            },
            success: function (resp) {

                var modelosMotor = JSON.parse(resp.trim());

                $("#Motor_modelos").empty();
                var option = $('<option selected="selected" value="">Selecione</option>');
                $("#Motor_modelos").append(option).trigger("create");
                for (var i = 0; i < modelosMotor.length; i++) {

                    var potencia = "";
                    if(modelosMotor[i].potencia != null) {
                        potencia = " - "+modelosMotor[i].potencia;
                        if(potencia.indexOf("HP") == -1) {
                            potencia += " HP";    
                        }
                        
                    }
                    var option = $('<option value="' + modelosMotor[i].id + '">' + modelosMotor[i].titulo + potencia + '</option>');
                    $("#Motor_modelos").append(option).trigger("create");
                }
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro por favor tenta mais tarde.")
            }
        });
    });


	/*$('#embarcacao_macros').dropdown({gutter : 5});
	$('#embarcacao_fabricantes').dropdown({gutter : 5});
	$('#TabelaEmbarcacoes_embarcacao_modelos_id').dropdown({gutter : 5});
	$('#TabelaEmbarcacoes_status').dropdown({gutter : 5});

	$('.cd-dropdown ul').slimScroll({
        height: '180px',
        width: '100%',
        distance: '10px',
        railVisible: false,
		alwaysVisible: true
    });*/
	
	/* Fim parte do form de cadastro */

    $form = $('#tabela-embarcacoes-form');

	// Selecionando Categoria
	$form.find('.wrap-embarcacao-macros').on('click', '.slimScrollDiv li', function(){

		value = $(this).data('value');

		ajaxecute(Yii.app.createUrl('utils/DropDownFabricantes'), value, "embarcacao_fabricantes", "embarcacao_fabricantes", "#tabela-embarcacoes-form .wrap-embarcacao-fabricantes");
	});

	// Selecionando Fabricante
	$form.find('.wrap-embarcacao-fabricantes').on('click', '.slimScrollDiv li', function(){

		value = $(this).data('value');

		ajaxecute(Yii.app.createUrl('utils/DropDownModelos'), value, "TabelaEmbarcacoes[embarcacao_modelos_id]", "TabelaEmbarcacoes_embarcacao_modelos_id", "#tabela-embarcacoes-form .wrap-embarcacao-modelos");
	});

});