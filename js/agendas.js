$(document).ready(function() {

	// limite de noticias
	var limit = 5;

	// offset
	var page = 1;

	$("#carregar-ag").on("click", function(e) {
			
			e.preventDefault();

			$.ajax({
				url: Yii.app.createUrl('agendas/loadmore'),
				data: {page: page},
				type: 'GET',

				success: function(resp) {
				
					var agendas = JSON.parse(resp.trim());

					for(var i = 0; i < agendas.length; i++) {

						var div_bloco_mes = $('<div class="bloco_mes" style="display:none;"></div>');
						var span_title_mes = $('<span class="title_mes">'+agendas[i].data_inicio+'</span>');

						var div_bloco_post = $('<div class="bloco_post" style="display:none;"></div>');
						var div_conteudo_textos = $('<div class="conteudo_textos"></div>');
						var span_title_post = $('<a id="adasasd" class="title_post">'+agendas[i].titulo+'</a>');
						var span_data_post = $('<span class="data_post">'+agendas[i].data_inicio+'</span>');
						var span_local_post = $('<span class="local_post">'+agendas[i].local+'</span>');

						div_bloco_mes.append(span_title_mes);

						div_conteudo_textos.append(span_title_post);
						div_conteudo_textos.append(span_data_post);
						div_conteudo_textos.append(span_local_post);

						div_bloco_post.append(div_conteudo_textos);

						$(".bloco_noticias").append(div_bloco_mes).trigger('create');
						$(".bloco_noticias").append(div_bloco_post).trigger('create');

						$('.bloco_mes').show("slow");
						$('.bloco_post').show("slow");
					}

					page++;
				},

				error: function(x, h, err) {
					alert('Ocorreu um erro inesperado!');
					location.reload();
				}
			});

	});


	// form de cadastro de evento
	$("#btn-cadastro-agenda").on("click", function(e) {
		e.preventDefault();

		var nome = $("#nome").val();
		var email = $("#email_").val();
		var mensagem = $("#mensagem").val();
		var empresa = $("#empresa").val();

		var flgok = true;

		if(nome == '' || email == '' || mensagem == '') {
			$("#erro-contato").text("Insira os campos necessários!");
			flgok = false;
		}


		else {

			if(!validateEmail(email)) {
				$("#erro-contato").text("Email inválido!");
				flgok = false;
			}
			

			if(flgok) {
				// ajax criar contato 
				$.ajax({
					url: Yii.app.createUrl('contatos/contatoAgenda'),
					data: {
						nome: nome, 
						email: email,
						mensagem: mensagem,
						empresa: empresa
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
								$("#nome").val("");
								$("#email").val("");
								$("#telefone").val("");
								$("#mensagem").val("");
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

	/* cadastro de agenda para o admimn */
	
	/* */

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
});