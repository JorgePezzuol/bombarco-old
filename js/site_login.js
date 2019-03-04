
$(document).ready(function() {

	// pega o parametro da url indicando que vai fazer o login e voltar ao detalhe do anuncio
	// favoritando o mesmo
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
	        if(sParameterName[0] == 'url_favorito') {
	       
	        	var hidden_favorito = $('<input type="hidden" name="url_favorito" id="url_favorito"/>');
	            hidden_favorito.val(sParameterName[1]);
	            $("#form-login").append(hidden_favorito).trigger('create');
	        }

	        if(sParameterName[0] == 'tabela_bb') {

	        	// acrescentar um parametro no botao de cadastro de usuario
	            var href = $("#btn-cadastrar-idt").attr("href");
	            href += '?tabela_bb=back';
	            $("#btn-cadastrar-idt").attr("href", href);

	            // acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" name="tabela_bb"/>');
	            $("#form-login").append(hidden).trigger('create');
	        }

	        if(sParameterName[0] == 'fabricante') {

	        	var href = $("#btn-cadastrar-idt").attr("href");
	            href += '&fabricante='+sParameterName[1];
	            $("#btn-cadastrar-idt").attr("href", href);

	            // acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" value="'+sParameterName[1]+'" name="fabricante_tabela_bb"/>');
	            $("#form-login").append(hidden).trigger('create');
	        }

	         if(sParameterName[0] == 'modelo') {

	        	var href = $("#btn-cadastrar-idt").attr("href");
	            href += '&modelo='+sParameterName[1];
	            $("#btn-cadastrar-idt").attr("href", href);

	            // acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" value="'+sParameterName[1]+'" name="modelo_tabela_bb"/>');
	            $("#form-login").append(hidden).trigger('create');
	        }

	         if(sParameterName[0] == 'ano') {

	        	var href = $("#btn-cadastrar-idt").attr("href");
	            href += '&ano='+sParameterName[1];
	            $("#btn-cadastrar-idt").attr("href", href);

	            // acrescentar um campo no post para falar q é pra voltar pra
	        	// tabela bb apos se cadastrar
	        	var hidden = $('<input type="hidden" value="'+sParameterName[1]+'" name="ano_tabela_bb"/>');
	            $("#form-login").append(hidden).trigger('create');
	        }
	      

	    }
	}



	// esqeceu sua senha
	$("#esqeceu-senha").on("click", function(e) {

		e.preventDefault();

		$('#lbox-msgok2').lightbox_me({
	        centered: true,
                                onLoad: function() {
                                    $('#lbox-msgok2').addClass("show");
                                },
                                onClose: function() {
                                    $('#lbox-msgok2').removeClass("show");
                                }
        });
	});

	$("#btn-enviar-email-esqeceu-senha").on("click", function(e) {

		// ajax enviar senha para email do usuario em questao
		$(".preloader").css("z-index", "9999");
		e.preventDefault();

		if($(this).hasClass("enviar")) {
			var email = $("#esqeceu-senha-email").val();

			if(!email || !validateEmail(email)) {

				//$("#msg-lgbox").html("E-mail inválido");
				$("#msg-lgbox2").text("E-mail inválido");
			}
			else {
				$.ajax({
					url: Yii.app.createUrl('site/esqeceuSenha'),
					data: {email: email},
					type: 'post',

					success: function(resp) {
				
						if(resp != '-1') {
							$("#msg-lgbox2").text("Um e-mail foi enviado para "+email);

							$("#esqeceu-senha-email").val("");
							$("#esqeceu-senha-email").hide();

							// remover classe enviar que indica que ja foi enviado o email
							$("#btn-enviar-email-esqeceu-senha").removeClass("enviar");
						}

						else {
							$("#msg-lgbox2").text("E-mail inválido");
						}
						
					},

					error: function(x, h, z) {

						$("#msg-lgbox2").text("Ocorreu um erro ao enviar o email de recuperação de senha");
						$("#esqeceu-senha-email").val("");
						$("#esqeceu-senha-email").hide();

						// remover classe enviar que indica que ja foi enviado o email
						$("#btn-enviar-email-esqeceu-senha").removeClass("enviar");
					}
				});
				
			}
		}

		// email já foi enviado, adicionar classe que fecha ao clicar no botão
		// 'Ok' e dar um trigger click
		else {

			$(this).addClass("close");
			$(this).trigger("click");
		}


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


	// cookies
	if(getCookie("username") != "") {

	}

	else {

	}



});