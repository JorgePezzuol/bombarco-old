
$(document).ready(function(){

	// estilizar select estados
	$("#Empresas_estados_id").addClass('select-anuncio-pad');

	//$("#capa").css("display","none");
	//$("#logo").css("display","none");

	$("#img-preview-capa").on("click", function() {
		$("#capa").trigger("click");
	});

	$("#img-preview-logo").on("click", function() {
		$("#logo").trigger("click");
	});

	$('#capa').on('change', function() { 

		var img_preview_capa = $("#img-preview-capa");

		// preview da imagem
		readURL(this, img_preview_capa);
	});

	$('#logo').on('change', function() { 

		var img_preview_logo = $("#img-preview-logo");

		// preview da imagem
		readURL(this, img_preview_logo);
	});


	function readURL(input, img) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
		        img.attr('src', e.target.result);
		        img.css("width", "175px");
		        img.css("heigth", "175px");
	    	};
	    reader.readAsDataURL(input.files[0]);
	    }  
	}


	// validação
	$("#submit-estaleiro").on("click", function(e) {

		e.preventDefault();

		var flgok = true;

		var usuario = $("#Usuarios_email").val();
		var senha = $("#Usuarios_senha").val();
		var plano = $("#PlanoUsuarios_planos_id").val();
		var categoria = $("#Empresas_embarcacao_macros_id").val();
		var razao = $("#Empresas_razao").val();
		var email = $("#Empresas_email").val();
		var destaque = $("#Empresas_destaque").val();
		var cidade = $("#Empresas_cidades_id").val();
		var estado = $("#Empresas_estados_id").val();


		if(!cidade || cidade == "") {
			$("#Empresas_cidades_id").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!estado || estado == "") {
			$("#Empresas_estados_id").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!usuario) {
			$("#Usuarios_email").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!senha) {
			$("#Usuarios_senha").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!plano) {
			$("#PlanoUsuarios_planos_id").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!categoria) {
			$("#Empresas_embarcacao_macros_id").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!razao) {
			$("#Empresas_razao").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!email) {
			$("#Empresas_email").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}

		if(!destaque) {
			$("#Empresas_destaque").parent().find('.errorMessage').html("Preencha este campo!");
			flgok = false;
		}


		if(!flgok) {
			$('html, body').animate({scrollTop:200}, 'slow');	
		}

		else {
			$("#empresas-form").submit();
		}

		$(".required").on("change", function() {
			$(this).parent().find('.errorMessage').html("");
		});

	});

	
});