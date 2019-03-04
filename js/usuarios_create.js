

$(document).ready(function (){

	// using jQuery Mask Plugin v1.7.5
	// http://jsfiddle.net/d29m6enx/2/
	var maskBehavior = function (val) {
	 return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
	 field.mask(maskBehavior.apply({}, arguments), options);
	 }
	};

	

	$("#Usuarios_cpf").mask("999.999.999-99");
	$("#Usuarios_telefone").mask("(99) 9999-9999");
	$("#Usuarios_celular").mask(maskBehavior, options);
	$("#Usuarios_data_nascimento").mask("99/99/9999");


	getUrlParameter();
	
	function getUrlParameter()
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    var flgAchouParam = false;
	    var parametro = '';
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');


	        if(sParameterName[0] == 'tabela_bb') {

	        	// acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" name="tabela_bb"/>');
	            $("#usuarios-form").append(hidden).trigger('create');

	        }


	        if(sParameterName[0] == 'fabricante') {

	        	// acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" value="'+sParameterName[1]+'" name="fabricante_tabela_bb"/>');
	            $("#usuarios-form").append(hidden).trigger('create');

	        }


	        if(sParameterName[0] == 'modelo') {

	        	// acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" value="'+sParameterName[1]+'" name="modelo_tabela_bb"/>');
	            $("#usuarios-form").append(hidden).trigger('create');

	        }


	        if(sParameterName[0] == 'ano') {

	        	// acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" value="'+sParameterName[1]+'" name="ano_tabela_bb"/>');
	            $("#usuarios-form").append(hidden).trigger('create');

	        }
	      

	    }
	}

	
	$("#btn-form-usuario").on("click", function(e) {

		e.preventDefault();

		var flgok = true;

		$(".caixa-form-pricad").each(function() {
			if($(this).attr("id") == "Usuarios_email") {}
			$(this).css("border", "solid #00918e 1px");
		});

		$(".required").each(function() {

			if($(this).attr("id") == "Usuarios_email" && $(this).val() != "") {

				$.ajax({
					url: Yii.app.createUrl('usuarios/verificarEmail'),
					data: {
						email: $("#Usuarios_email").val() 
					},
					type: 'POST',
					async: false,

					success: function(resp) {

						if(resp.trim() == "1") {
							$("#div-email").css("border", "solid red 1px");
							lightBoxMsg("E-mail já cadastrado");
							flgok = false;
						}
					},

					error: function(x, h, z) {
					}
				});
			}

			if($(this).val() == "") {
				$(this).parent().css("border", "solid red 1px");
				flgok = false;
			}
		});

		var tipo_pessoa = $(".tipo-pessoa:checked").val();

		if(typeof tipo_pessoa == "undefined") {
			tipo_pessoa = "F";
		}

		if(tipo_pessoa == "F") {

			$(".required-pf").each(function() {

				if($(this).attr("id") == "Usuarios_cpf" && $(this).val() != "") {

					$.ajax({
						url: Yii.app.createUrl('usuarios/verificarCpfOuCnpj'),
						data: {
							tipopessoa: tipo_pessoa,
							cpfcnpj: $("#Usuarios_cpf").val() 
						},
						type: 'POST',
						async: false,

						success: function(resp) {

							if(resp.trim() == "1") {
								$("#div-cpf").css("border", "solid red 1px");
								lightBoxMsg("CPF já cadastrado");
								flgok = false;
							}
						},

						error: function(x, h, z) {
						}
					});	
				}

				if($(this).val() == "") {
					$(this).parent().css("border", "solid red 1px");
					flgok = false;
				}
			});
		}

		// juridica
		else {

			$(".required-pj").each(function() {


				if($(this).attr("id") == "Usuarios_cnpj" && $(this).val() != "") {

					$.ajax({
						url: Yii.app.createUrl('usuarios/verificarCpfOuCnpj'),
						data: {
							tipopessoa: tipo_pessoa,
							cpfcnpj: $("#Usuarios_cnpj").val() 
						},
						type: 'POST',
						async: false,

						success: function(resp) {

							if(resp.trim() == "1") {
								$("#div-cnpj").css("border", "solid red 1px");
								lightBoxMsg("CNPJ já cadastrado");
								flgok = false;
							}
						},

						error: function(x, h, z) {
						}
					});	
				}

				if($(this).val() == "") {
					$(this).parent().css("border", "solid red 1px");
					flgok = false;
				}
			});
		}

		if(flgok == true) {
			
			if(tipo_pessoa == "F") {
				ga('send', 'event', 'link', 'click', 'Cadastro PF');

			}

			else {
				ga('send', 'event', 'link', 'click', 'Cadastro PJ');

			}
			$("#usuarios-form").submit();	
		}
		
	});

	
	/*$("#btn-form-usuario").on("click", function(e) {

		e.preventDefault();

		var flgvalidacao = true;
		var tipoPessoa = '';

		$('.tipo-pessoa').each(function(i, el) {
			if($(this).attr("checked")) {
				tipoPessoa = $(this).data('tipo');
			}
		});

		if(tipoPessoa == '') {
			flgvalidacao = false;
			$("#error-pessoa").html("Selecione o tipo de cadastro");
		}

		if($("#Usuarios_senha").val() == "") {
			$("#error-senha").html("Insira uma senha");
			flgvalidacao = false;
		}

		if(!validateEmail($("#Usuarios_email").val())) {	
			$("#error-email").html("Insira um email válido");
			flgvalidacao = false;
		}

		
		if(tipoPessoa == 'fisica') {

			if($("#Usuarios_cpf").val() == "") {
				$("#error-cpf").html("Insira o CPF");
				flgvalidacao = false;
			}

			if($("#Usuarios_nome").val() == "") {
				$("#error-nome").html("Insira o nome");
				flgvalidacao = false;
			}

			if($("#Usuarios_data_nascimento").val() == "") {

			}
		}

		else {

			if($("#Usuarios_razaosocial").val() == "") {
				$("#error-razaosocial").html("Insira a razao social");
				flgvalidacao = false;
			}

			if($("#Usuarios_nomefantasia").val() == "") {
				$("#error-nomefantasia").html("Insira o nome fantasia");
				flgvalidacao = false;
			}
		}

		if(flgvalidacao) {

			$("#usuarios-form").submit();	
		}

	});*/

$("#Usuarios_cnpj").mask("99.999.999/9999-99");


	$("#Usuarios_cpf").on("change", function() {
		$("#error-cpf").html("");
		$("#error-celular").html("");
	});

	$("#Usuarios_senha").on("change", function(){
		$("#error-senha").html("");
	});

	$("#Usuarios_celular").on("change", function() {

		$("#error-celular").html("");
	});

	$("#Usuarios_telefone").on("change", function() {
		$("#error-telefone").html("");
		$("#error-celular").html("");
	});

	$("#Usuarios_email").on("blur", function() {
		
		var email = $(this).val();
		var validEmail = validateEmail(email);

		if(!validEmail) {
			$("#error-email").html("Insira um email válido");
			flgok = false;
			return false;
		}

		else {
			$("#error-email").html("");
			flgok = true;
		}

		$.ajax({

			url: Yii.app.createUrl('usuarios/verificarEmail'),
			data: {email: email},
			type: 'POST',

			success: function(resp) {

				if(resp.trim() == "1") {
					flgok = false;
					$("#error-email").html("E-mail já existe");
				}
			},

			error: function(x, h, z) {

			}
		});

	});

	$("#Usuarios_cpf, #Usuarios_cnpj").on("blur", function() {
		
		var $this = $(this);
		var cpf = $(this).val();
		var tipopessoa = "F";
		$('.tipo-pessoa').each(function(i, el) {
			if($(this).attr("checked")) {
				tipopessoa = $(this).val();
			}
		});

		$.ajax({

			url: Yii.app.createUrl('usuarios/verificarCpfOuCnpj'),
			data: {cpfcnpj: cpf, tipopessoa: tipopessoa},
			type: 'POST',

			success: function(resp) {

				if(resp.trim() == "1") {
					flgok = false;
					$this.parent().css("border-color", "red");
					alert("CPF ou CNPJ já cadastrado.")
					//$(".error-cpfcnpj").html("Já cadastrado");
					
				}
			},

			error: function(x, h, z) {

			}
		});

	});

	$("#Usuarios_nome").on("change", function() {
		$("#error-nome").html("");
	});

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

	// alterar campos dependendo do tipo de pessoa (form de criar usuario)
	$(".tipo-pessoa").on("click", function(e) {

		var val = $(this).data('tipo');

		if(val === 'juridica') {
			$("#campos-pf").fadeOut("fast");
			$("#campos-pj").fadeIn("fast");
		}
		else {
			$("#campos-pf").fadeIn("fast");
			$("#campos-pj").fadeOut("fast");
		}
	});	

});