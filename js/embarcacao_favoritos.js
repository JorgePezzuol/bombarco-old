$(document).ready(function() {


	// obter o valor do campo hidden que indica se o usuario ja favoritou ou nao
	// a embarcação
	var flgFavoritou = $("#flgFavoritou").val();

	// indica que ja favoritou
	if(flgFavoritou == '1') {
		$("#add-favoritos").addClass('desfavoritar');
		$("#add-favoritos").html('Favoritado <i class="icone-favorito-detemba"></i>');
		$("#add-favoritos").css('font-weight','bold');
		$(".icone-favorito-detemba").css('display','block');
	}

	// deseja favoritar embarcação
	$("#add-favoritos").on('click', function(e) {

		e.preventDefault();

		// ver se usuario clicou em favoritar e não está logado
		var isGuest = $("#isGuest").val();

		if(isGuest == 0) {
			// redirecionar
			location.href = Yii.app.createUrl('site/login?url_favorito='+location.href);
			return false;
		}

		// obter id da embarcacao
		var id_embarcacao = $("#idEmbarcacao").val();

		// vai desfavoritar
		if($(this).hasClass('desfavoritar')) {

			// ajax desfavoritar
			$.ajax({
				url: Yii.app.createUrl('embarcacoes/desfavoritarEmbarcacao'),
				data: {id_embarcacao: id_embarcacao},
				type: 'POST',

				success: function(resp) {
					$("#add-favoritos").html('Add Favoritos ');
					$("#add-favoritos").removeClass('desfavoritar');
					$("#add-favoritos").removeClass('add-favoritos');
					$("#add-favoritos").css('font-weight','normal');
					$(".icone-favorito-detemba").css('display','none');

				},

				error: function(xhz, z, err) {

				}
			});
		}

		// favoritar
		else {
			// ajax favoritar
			$.ajax({
				url: Yii.app.createUrl('embarcacoes/favoritarEmbarcacao'),
				data: {id_embarcacao: id_embarcacao},
				type: 'POST',

				success: function(resp) {
					$("#add-favoritos").html('Favoritado <i class="icone-favorito-detemba"></i>');
					//$("#add-favoritos").css("background", "#ff6800");
					$("#add-favoritos").addClass('desfavoritar');
					$("#add-favoritos").css('font-weight','bold');
					$(".icone-favorito-detemba").css('display','block');

				

				},

				error: function(xhz, z, err) {
				}
			});
		}

	});
	
	// ver se esta voltando de um login para favoritar a embarc
	getUrlParameter('url_favorito');

	function getUrlParameter(sParam)
	{
	    var sPageURL = window.location.search.substring(1);
	    var sURLVariables = sPageURL.split('&');
	    var flgAchouParam = false;
	    var parametro = '';
	    for (var i = 0; i < sURLVariables.length; i++) 
	    {
	        var sParameterName = sURLVariables[i].split('=');
	        if (sParameterName[0] == sParam) 
	        {
	        	$("#add-favoritos").trigger("click");
	        }
	    }
	}




// ready	
});