$(document).ready(function() {

	$(".openMenu").click(function(){
	    if($(this).hasClass("open")){
	      $(this).removeClass("open fa-remove").addClass("fa-bars");
	      $(".side-nav").removeClass("open");
	    }else{
	      $(this).removeClass("fa-bars").addClass("open fa-remove");
	      $(".side-nav").addClass("open");
	    }
	    return false;
	});

	// salvar novo reg de tabela
	$("#btn-salvar").on("click", function(e) {
		e.preventDefault();

		var data = $("#form_ajax").serialize();

		$.ajax({

			url: Yii.app.createUrl("tabelaEmbarcacoes/create"),
			/*data: {
				embarcacao_macros_id: $("#embarcacao_macros_id").val(),
				embarcacao_fabricantes_id: $("#embarcacao_fabricantes_id").val(),
				embarcacao_modelos_id: $("#embarcacao_modelos_id").val(),
				ano: $("#ano").val(),
				valor: $("#valor").val(),
				pes: $("#pes").val(),
				qtdemotores: $("#qtdemotores").val(),
				potenciamotor: $("#potenciamotor").val(),
				motor_tipos_id: $("#motor_tipos_id").val(),
				motor_fabricantes_id: $("#motor_fabricantes_id").val(),
				motor_modelos_id: $("#motor_modelos_id").val()
			},*/
			data: data,
			type: "POST",
			async: false,
			success: function(resp) {
				if(resp.trim() == "1") {
					$("#erro").hide();
					$("#sucesso").show();
					$("#sucesso").text("Registro cadastrado com sucesso!");
				}
				else {
					$("#sucesso").hide();
					$("#erro").show();
					$("#erro").text("Ocorreu um erro inesperado. Favor contatar o admin do site.");
				}

				setTimeout(function() { 
					$("#erro").hide();
					$("#sucesso").hide();
				}, 3000);

			}
		});
	});


	
	$("[name='TabelaEmbarcacoes[embarcacao_fabricantes_id]']").on("change", function(e) {
		
		var select = $("<select><option>asdsdsad</option></select>");
		$(this).closest("td").next().find(".filter-container").empty().append(select); 
	});
	



});


