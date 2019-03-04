$(document).ready(function(){
	
	// offset
	var page = 1;

	/*==========  Busca de Embarcacões de Estaleiros  ==========*/	
	$(".botoes-deest").on("click", "#carregar-deest", function(e) {
	
			e.preventDefault();

			$limit = $(this).data("limit");

			data = {};
			data['page'] = page;
			data['id'] = $(this).data("id");

			//console.log(data);

			$.ajax({
				url: Yii.app.createUrl('embarcacoes/LoadMoreFromBusiness'),
				data: data,
				type: 'GET',

				success: function(resp) {

					json = JSON.parse(resp.trim());
					//console.log(json);

					if (json.count > 0) {
						
						$(".box-grid-det-est .line-gray-deest").append(json.html);

						// incrementar page
						page++;

						// Se o resultado for menor que o limite, então apaga o botão de carregar mais
						if (json.count < $limit) {
							$("#carregar-deest").remove();
						}

					} else {
						$("#carregar-deest").remove();
					}

				},

				error: function(x, h, err) {
					alert('Ocorreu um erro inesperado! Tente novamente');
				}
			});

	});

});