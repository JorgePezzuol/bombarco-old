$(document).ready(function() { 

	// indica se marcou cpm ou nao
	flgCpm = 0;

	// formatar moeda
	numeral.language('pt-br');
  	
	function readURL(input, id) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
		        $('#'+id).attr('src', e.target.result)
	    	};
	    reader.readAsDataURL(input.files[0]);
	    }  
	}

	// mascara cnpj
	$("#Empresas_cnpj").mask("99.999.999/9999-99");
	$("#Empresas_cep").mask("99999-999");


	var maskBehavior = function (val) {
	 return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
	 field.mask(maskBehavior.apply({}, arguments), options);
	 }
	};

	$("#telefone").mask(maskBehavior, options);


	// validar email
	function validateEmail(email) {

		if(!email)
			return false;

	    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	    if( !emailReg.test( email ) ) {
	        return false;
	    } else {
	        return true;
	    }
	}

	//generate iframe google maps
	function generateMaps(address, city , number){
	  $("#Empresas_maps").val('http://maps.google.com/?q= '+address+', '+city+', '+number+'&output=embed');
	 
	}
	$('#empresas-form').on('submit', function(e){
		var city = $('#Empresas_cidades_id').find('option:selected').text();
		var address = $('#Empresas_endereco').val();
		var number = $('#Empresas_numero').val();
		generateMaps(address, city, number);
	});

	$("#btn-form").on("click", function(e) {

		e.preventDefault();

		var flgok = true;

		var categoria = $("#Empresas_empresa_categorias_id").val();
		var razao = $("#Empresas_razao").val();

		if(!categoria) {
			$("#error-categoria").html("Preencha uma categoria!");
			flgok = false;
		}

		if(!razao) {
			$("#error-razao").html("Razão não pode ser vazio.");
			flgok = false;
		}

		// ver se marcou o termo de condição
		/*if(!$("#check-termos-condicao").attr("checked")) {
			flgok = false;
			$("#error-termo").html("Favor aceite os termos de condição");
		}*/
		
		if(flgok) {

			$("#empresas-form").submit();
		}
		else {
			$('html, body').animate({scrollTop:200}, 'slow');	
		}

		
	});	

	/*$("#check-termos-condicao").on("change", function(){
		if($(this).attr("checked")) {
			$("#error-termo").html("");
		}
	});*/

	$("#Empresas_email").on("change", function(){

		var email = $(this).val();

		if(!validateEmail(email)) {
			$("#error-email").html("Email inválido");
		}
		else {
			$("#error-email").html("");
		}
	});

	// mudou logo
	$("#Empresas_logo").on("change", function(){
		var id_preview_logo = $("#preview-logo").attr("id");
		$("#preview-logo").fadeIn("slow");
		readURL(this, id_preview_logo);
	});

	// mudou capa
	$("#Empresas_capa").on("change", function(){
		var id_preview_capa = $("#preview-capa").attr("id");
		$("#preview-capa").fadeIn("slow");
		readURL(this, id_preview_capa);
	});

	// preview img turbinada
	$('.img-turbinada').on("click", function() {

		// input file está logo após o <img> , vamos dar um trigger click
		$(this).parent().find('input[type="file"]').trigger("click");
	});

	// selecionou img turbinada
	$('.file-img-turbinada').on("change", function(){
		var id_img_prev = $(this).prev().attr("id");
		readURL(this, id_img_prev);
	});


	// alterar valor da turbo de CPM de acordo com o periodo
	$("#qtde-impressoes").on("change", function() {

		var qtdeimpressoes = $(this).val();

		if(isNaN(qtdeimpressoes)) {
			//$("#div-periodo-impressoes").fadeOut("slow");
			//$("#div-limite-impressoes").fadeOut("slow");
			return false;
		}

		// calcular valor do cpm (DEIXAR ESSES)
		var valor = qtdeimpressoes * 9.90;

		// dar update no campo que vai guardar o valor do turbo de cpm
		$("#hidden-valor-cpm").attr("value", valor);

		$("#bold-valor-cpm").html(' (R$ '+numeral(valor).format('0,0.00')+')');

		$("#check-cpm").trigger("click");

		$("#check-cpm").attr("data-valor", valor);

		$("#check-cpm").trigger("click");

	});

	// checkboxes dos turbinados
	$(".recursos-adicionais").on('change', function() { 

		// valor do turbinado escolhido
		var valor = parseFloat($(this).attr("data-valor"));

		// valor total turbinada
		var valor_total_turbinada = parseFloat($("#valor-total-turbinada").val());

		// valor do anúncio
		var valor_anuncio = parseFloat($("#valor-anuncio-hidden").val());

		// checar se foi marcada
		if($(this).attr("checked")) {

			// checar se o turbo de ofots o que quer dizer é que o usuario selecionou
			// as turbinadas de fotos, vamos habilitar 
			if($(this).attr("data-attribute") == 'fotos') {
				$('.file-img-turbinada').each(function(){
					$(this).prop("disabled", false);
				});
				$("#div-turbo-fotos").fadeIn("slow");
			}

			// marcou video
			if($(this).attr("data-attribute") == 'video') {
				$("#div-turbo-video").fadeIn("slow");
			}

			// marcou telefone
			if($(this).attr("data-attribute") == 'telefone') {
				$("#div-turbo-telefone").fadeIn("slow");
			}

			// marcou descricao
			if($(this).attr("data-attribute") == 'descricao') {
				$("#div-turbo-descricao").fadeIn("slow");
			}

			// marcou cpm
			if($(this).attr("data-attribute") == 'cpm') {
				$("#div-periodo-impressoes").fadeIn("slow");

				var limite = $("#duracaomeses").val();

				if(flgCpm == 0) {
				
					for(var i = 0; i < limite; i++) {

						var option;

						if(i == 0) {
							option = $('<option selected="selected" value="1">1 Mês</option>');
						}
						else {
							option = $('<option value="'+(i+1)+'">'+(i+1)+' Meses</option>');
						}
						
						$("#periodo-impressoes").append(option).trigger("create");
					}
					flgCpm = 1;
				}
			}

			// somatizar valor da turbinada
			valor_total_turbinada += valor;

			// variavel que vai conter o valor total (anuncio + turbo)
			var valor_total_anuncio = valor_anuncio + valor_total_turbinada;

			// atualizar campo hidden com valor da turbinada
			$("#valor-total-turbinada").val(valor_total_turbinada);

			$("#valor-total, .text-cadastro-lh4").text(numeral(valor_total_anuncio).format('0,0.00'));
			$("#valor-turbinada").text(numeral(valor_total_turbinada).format('0,0.00'));
		}

		else {

			// desmarcou foto
			if($(this).attr("data-attribute") == 'fotos') {
				$('.file-img-turbinada').each(function(){
					$(this).prop("disabled", true);
					$(this).val("");
					$(this).prev().attr("src", Yii.app.createUrl('img/addfoto.png'));
					$("#div-turbo-fotos").fadeOut("slow");
				});
			}

			// desmarcou video
			if($(this).attr("data-attribute") == 'video') {
				$("#div-turbo-video").fadeOut("slow");
				$("#Empresas_video").val("");
			}

			// desmarcou telefone
			if($(this).attr("data-attribute") == 'telefone') {
				$("#div-turbo-telefone").fadeOut("slow");
				$("#telefone").val("");
			}
			// desmarcou descricao
			if($(this).attr("data-attribute") == 'descricao') {
				$("#div-turbo-descricao").fadeOut("slow");
				$("#descricao").val("");
			}


			// marcou cpm
			if($(this).attr("data-attribute") == 'cpm') {
				$("#div-periodo-impressoes").fadeOut("slow");

			}

			// subtrair valor da turbinada
			valor_total_turbinada -= valor;

			// variavel que vai conter o valor total (anuncio + turbo)
			var valor_total_anuncio = valor_anuncio + valor_total_turbinada;

			// atualizar campo hidden com valor da turbinada
			$("#valor-total-turbinada").val(valor_total_turbinada);

			$("#valor-total, .text-cadastro-lh4").text(numeral(valor_total_anuncio).format('0,0.00'));
			$("#valor-turbinada").text(numeral(valor_total_turbinada).format('0,0.00'));
	
		}

	});

	//body class
	if (window.location.href.indexOf("anunciarEmpresa") > -1) { 
		$('body').addClass('anuncio-process');
	}

	//style input
	$( "<span class='span-checkbox'><i class='ico-radio'></i></span>" ).insertAfter( "input[type='checkbox']" );
	$('.empresa-form-content').on('click', '.span-checkbox', function(e){
		e.preventDefault();
		$(this).toggleClass('active-radio');
		$(this).prev().trigger('click');
	});

	//btn file logo / capa
	$('.empresa-form-content .btn-file').on('click', function(e) {
		$(this).prev().click();
		e.preventDefault();
	});

	$('.empresa-form-content .rowfile input[type="file"]').on('change', function(e) {
	
		$(this).next().text('Adicionado');
		$(this).next().css('background', '#FF6800');
	});
	// // // // // // // // // // // // // 
	

	/* Executa a requisição quando o campo CEP perder o foco */
	   $('#Empresas_cep').blur(function(){

	   	$('.preloader').show();

	           /* Configura a requisição AJAX */
	           $.ajax({
	                url :  Yii.app.createUrl('anuncios/consultarCep'), /* URL que será chamada */ 
	                type : 'POST', /* Tipo da requisição */ 

	                //data: 'cep=' + $('#Empresas_cep').val(), /* dado que será enviado via POST */
	                data: {cep: $("#Empresas_cep").val()},

	                dataType: 'json', /* Tipo de transmissão */
	                success: function(data){

	                    if(data.sucesso == 1){

	                        $('#Empresas_endereco').val(data.rua);
	                        $('#Empresas_bairro').val(data.bairro);
	                        //$('#Empresas_email').val(data.cidade);
	                        //$('#Empresas_razao').val(data.estado);
	 
	                        $('#Empresas_numero').focus();
	                    	
	                    }
	                    $('.preloader').hide();
	                }
	           });   
	   	return false;    
	   });


});
