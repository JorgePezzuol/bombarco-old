$(document).ready(function() {

	// id do planoUsuarios atual do usuario
	var id_plano_usuarios_atual = $("#id_plano_usuarios_atual").val();

	   // moeda br
    numeral.language('pt-br');
    

    // escolheu anuncio individual
    $("#valor-individual").on("change", function() {

    	var meses = $("#meses-individual").val();
    	var valor = $(this).val();

    	if(valor == "" || valor == "") {
    		$("#btn-anuncio-individual").attr("href", "#");
    	}

    	else {
    		$.ajax({
    			url: Yii.app.createUrl('planoUsuarios/retornarPlanoIndividual'),
    			type: 'post',
    			data: {
    				meses: meses,
    				valor: valor
    			},

    			success: function(resp) {
    				
    				var plano = JSON.parse(resp.trim());
					
					var id_plano_renovado = plano.id;

					var href = Yii.app.createUrl('planoUsuarios/renovarPlano', {id_plano_usuarios_atual: id_plano_usuarios_atual, id_plano_renovado: id_plano_renovado });
					$("#btn-anuncio-individual").attr('href', href);

					
					$("#valor-anuncio-individual").text('R$ '+numeral(plano.valor).format('0,0.00'));

    			}
    		});
    	}

    });

    $("#meses-individual").on("change", function() {

    	var meses = $(this).val();
    	var valor = $("#valor-individual").val();


    	if(meses == "" || valor == "") {
    	
    		$("#btn-anuncio-individual").attr("href", "#");
    	}

    	else {


    		$.ajax({
    			url: Yii.app.createUrl('planoUsuarios/retornarPlanoIndividual'),
    			type: 'post',
    			data: {
    				meses: meses,
    				valor: valor
    			},

    			success: function(resp) {
    				
    				var plano = JSON.parse(resp.trim());
					
					var id_plano_renovado = plano.id;

					var href = Yii.app.createUrl('planoUsuarios/renovarPlano', {id_plano_usuarios_atual: id_plano_usuarios_atual, id_plano_renovado: id_plano_renovado });
					$("#btn-anuncio-individual").attr('href', href);
    			}
    		});
    	}
    });

	// escolheu plano pacote plus
	$(".anuncios").on("change", function() {
		var qntpermitida = $(this).data('qntpermitida');
		var duracaomeses = $(this).val();

		var $this = $(this);

		if(duracaomeses != "") {
				$.ajax({
				url: Yii.app.createUrl('planoUsuarios/retornarPlanoPorDuracaoMeses'),
				data: {
					qntpermitida: qntpermitida,
					duracaomeses: duracaomeses
				},
				type: 'post',

				success: function(resp) {

					var plano = JSON.parse(resp.trim());
					
					var id_plano_renovado = plano.id;

					// atualizar valor no span
					$('.valor-span').each(function(i, el) {

						if($(el).data('qntpermitida') == qntpermitida) {

							$(el).text('R$ '+numeral(plano.valor).format('0,0.00'));
						}

					});

					// encontrar o botao parar gera o link
					$('.href-planos').each(function(i, el) {

						if($(el).data('qntpermitida') == qntpermitida) {

							var href = Yii.app.createUrl('planoUsuarios/renovarPlano', {id_plano_usuarios_atual: id_plano_usuarios_atual, id_plano_renovado: id_plano_renovado });
							$(el).attr('href', href);

						}

					});

				}
			});
		}

	

	});

	  
});