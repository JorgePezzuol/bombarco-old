$(document).ready(function(){
	
	//$('#EmbarcacaoModelos_embarcacao_macros_id').dropdown({gutter : 5});
	//$('#EmbarcacaoModelos_embarcacao_fabricantes_id').dropdown({gutter : 5});
	//$('#EmbarcacaoModelos_embarcacao_tipos_id').dropdown({gutter : 5});
	//$('#EmbarcacaoModelos_status').dropdown({gutter : 5});

	// on change ajax valida nome do modelo
	$("#EmbarcacaoModelos_titulo").on("change", function(e) {
		
		e.preventDefault();

		var modelo = $("#EmbarcacaoModelos_titulo").val();
		var fabricante = $("#EmbarcacaoModelos_embarcacao_fabricantes_id").val();

		$.ajax({
			url: Yii.app.createUrl('embarcacaoModelos/validarNomeModelo'),
			data: {nomeModelo: modelo, fabricante: fabricante},
			type: 'post',

			success: function(resp) {
				
				// existe, informar
				if(resp == '-1') {
					$("#titulo").html("Modelo já existe!");
				}
				else {
					$("#titulo").html("");	
				}
			},

			error: function(x, h, z) {
				console.log(h);
			}
		});
	});

	$("#EmbarcacaoModelos_embarcacao_macros_id").on("change", function() {
		$("#EmbarcacaoModelos_embarcacao_fabricantes_id").prop("disabled", true);


		$("#EmbarcacaoModelos_embarcacao_tipos_id").prop("disabled", true);
	});

	// selecionou macro
	$("#EmbarcacaoModelos_embarcacao_macros_id").on("change", function() {

		var embarcacao_macros_id = $(this).val();

		if(embarcacao_macros_id == 1) {
			$('.hide-jetski').hide();
			$("#motor-jetski").fadeIn();
		} else {
			$('.hide-jetski').fadeIn();
			$("#motor-jetski").hide();
		}

		// ajax carregar fabricantes
		$.ajax({

				url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoes'),
				data: {embarcacao_macros_id: embarcacao_macros_id},
				type: "POST",

				success: function(resp) {

					if(resp != -1) {
						$("#EmbarcacaoModelos_embarcacao_fabricantes_id").empty();
						$("#EmbarcacaoModelos_embarcacao_fabricantes_id").append("<option selected='selected' value=''>Selecione</option>").trigger('create');

						var fabricantes = JSON.parse(resp.trim());

						for(var i =0; i < fabricantes.length; i++) {
							if(fabricantes[i].id == 0) continue;
							var option = $('<option value="'+fabricantes[i].id+'">'+fabricantes[i].titulo+'</option>');
							$("#EmbarcacaoModelos_embarcacao_fabricantes_id").append(option).trigger("create");
						}

						// habilitar select e fabricante
						$("#EmbarcacaoModelos_embarcacao_fabricantes_id").prop("disabled", false);
					}

				},

				error: function(x, r, msg) {
					alert(JSON.stringify(msg));
				}
			});

		// ajax carregar tipos
		$.ajax({

				url: Yii.app.createUrl('utils/loadTiposEmbarcacao'),
				data: {embarcacao_macros_id: embarcacao_macros_id},
				type: "POST",

				success: function(resp) {

					if(resp != -1) {
						$("#EmbarcacaoModelos_embarcacao_tipos_id").empty();
						$("#EmbarcacaoModelos_embarcacao_tipos_id").append("<option selected='selected' value=''>Selecione</option>").trigger('create');

						var tipos = JSON.parse(resp.trim());

						for(var i =0; i < tipos.length; i++) {
							if(tipos[i].id == 0) continue;
							var option = $('<option value="'+tipos[i].id+'">'+tipos[i].titulo+'</option>');
							$("#EmbarcacaoModelos_embarcacao_tipos_id").append(option).trigger("create");
						}

						// habilitar select e fabricante
						$("#EmbarcacaoModelos_embarcacao_tipos_id").prop("disabled", false);
					}

				},

				error: function(x, r, msg) {
					alert(JSON.stringify(msg));
				}
			});
		
	});

	$('.cd-dropdown ul').slimScroll({
        height: '180px',
        width: '100%',
        distance: '10px',
        railVisible: false,
		alwaysVisible: true
    });

    $(".slimScrollDiv").css("overflow", "visible");

	$form = $('#embarcacao-modelos-form');

	// Selecionando Categoria
	$form.find('.embarcacao_macros_id').on('click', '.slimScrollDiv li', function(){

		value = $(this).data('value');

		ajaxecute(Yii.app.createUrl('utils/DropDownFabricantes'), value, "EmbarcacaoModelos[embarcacao_fabricantes_id]", "EmbarcacaoModelos_embarcacao_fabricantes_id", "#embarcacao-modelos-form .embarcacao_fabricantes_id");

		ajaxecute(Yii.app.createUrl('utils/DropDownTipos'), value, "EmbarcacaoModelos[embarcacao_tipos_id]", "EmbarcacaoModelos_embarcacao_tipos_id", "#embarcacao-modelos-form .embarcacao_tipos_id");

		// se for jetski, devemos esconder alguns campos
		// e acrescentar outro
		if(value == 1) {

			$(".hide-jetski").fadeOut("slow");
			$("#motor-jetski").fadeIn("slow");
		}

		else {
			$(".hide-jetski").fadeIn("slow");
			$("#motor-jetski").fadeOut("slow");
		}

	});

});