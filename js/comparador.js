$(document).ready(function() {
	
	if($("#nao-ha-barcos").val() == 1) {
		var url = Yii.app.createUrl('site/index');
		window.location = url;
	}
	
	$(".deletar-comparador").on("click", function(e){

		e.preventDefault();

		var id = $(this).data("id");

		$.ajax({
			url: Yii.app.createUrl('comparador/delete'),
			data: {
				id: id
			},
			type: 'post',

			success: function(resp) {

				if(resp == '1') {

					var url = Yii.app.createUrl('comparador/Comparar', {id: null});
					window.location = url;

					/*location.reload();
					if($("#nao-ha-barcos").val() == 1) {
						var url = Yii.app.createUrl('site/index');
						window.location = url;
					}*/
				}

				else {
					alert("Ocorreu um erro inesperado. Tente mais tarde.");	
				}
			},	

			error: function(x, h,z) {
				alert("Ocorreu um erro inesperado. Tente mais tarde.");
			}
		});
	});

	$(".btn-contato").on("click", function(e) {
		e.preventDefault();

		var idUsuarioDonoEmbarc = $(this).data("id-dono-embarc");
		var idEmbarcacao = $(this).data("id-embarc");
		var emailEmbarcacao = $(this).data("email-embarc");

		$("#infos-embarc").html("");
		$("#infos-embarc").append('<input type="hidden" id="idUsuarioDonoEmbarc" value="'+idUsuarioDonoEmbarc+'"/>');
		$("#infos-embarc").append('<input type="hidden" id="idEmbarcacao" value="'+idEmbarcacao+'"/>');
		$("#infos-embarc").append('<input type="hidden" id="emailEmbarcacao" value="'+emailEmbarcacao+'"/>');

		$('#lbox-detemba').lightbox_me({
			    centered: true,
			    onLoad: function() {

			    }
		});
	});

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


	/* contato */
	$("#btn-submit-contato").on("click", function(e) {
		
		e.preventDefault();

		var nome = $("#nome-contato-anunciante").val();
		var email_remetente = $("#email-contato-anunciante").val();
		var telefone = $("#telefone-contato-anunciante").val();
		var mensagem = $("#mensagem-contato-anunciante").val();

		var flgok = true;

		var idUsuarioDonoEmbarc = $("#idUsuarioDonoEmbarc").val();

		if(nome == '' || email_remetente == '' || mensagem == '') {
			/*$("#msg-lgbox").text("Erro ao enviar a mensagem");
			$('#lbox-msgok').lightbox_me({
						        centered: true, 
						        onLoad: function() { 
						       
						            }
						        });*/
			$("#erro-contato").text("Insira os campos necessários!");
			flgok = false;
		}


		else {

			if(!validateEmail(email_remetente)) {
				$("#erro-contato").text("Email inválido!");
				flgok = false;
			}
			

			if(flgok) {
				$('.preloader').css("z-index", "9999");

				// url de pergunta de anuncio
				var url = Yii.app.createUrl('contatos/mailAnunciante');

				$.ajax({
					url: url,
					data: {
						nome: nome, 
						email_remetente: email_remetente,
						telefone: telefone, 
						mensagem: mensagem, 
						idUsuarioDonoEmbarc: $("#idUsuarioDonoEmbarc").val(),
						idEmbarcacao: $("#idEmbarcacao").val(),
						emailEmbarcacao: $("#emailEmbarcacao").val(),
						resposta: 0,
					},
					type: 'POST',

					success: function(resp) {


						if(resp != '-1') {
					
							$(".close").trigger("click");
							/* Função para Lightbox Msg enviada com sucesso */
							$('#lbox-msgok').lightbox_me({
						        centered: true, 
						        onLoad: function() { 
						       
						            }
						        });

								// limpar campos
								/*$("#nome-contato-anunciante").val("");
								$("#email-contato-anunciante").val("");
								$("#telefone-contato-anunciante").val("");
								$("#mensagem-contato-anunciante").val("");*/
						}

						else {
							$("#erro-contato").text("Erro ao enviar a mensagem!");
						}
					},

					error: function(x, h, err) {

						$("#erro-contato").text("Erro ao enviar a mensagem!");
					}
				});
			}
		}
	});

	
	$("#drop-macros-comparador").on("change", function() {

		var link = $(this).val();

		if(link != "") {
			location.href = link;
		}
	});	
// ready
});