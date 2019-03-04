$(document).ready(function(){
	
	// offset
	var page = 1;

	$(".div-botoes-bottom").on("click", ".botao-carregar", function(e) {
			e.preventDefault();

			$limit = $(this).data("limit");

			data = {};
			data['page'] = page;
			data['categoria'] = $(this).data("categoria");
			data['localizacao'] = $(this).data("localizacao");
			data['busca'] = $(this).data("busca");
			data['ajax'] = true;

			//console.log(data);

			$.ajax({
				url: Yii.app.createUrl('empresas/EstaleirosIndex'),
				data: data,
				type: 'GET',

				success: function(resp) {

					json = JSON.parse(resp.trim());
					//console.log(json);

					if (json.count > 0) {
						
						$(".box-estaleiros:eq(1) .categories-est").append(json.html);

						// incrementar page
						page++;

						// Se o resultado for menor que o limite, então apaga o botão de carregar mais
						if (json.count < $limit) {
							$(".div-botao-carregar-esta").empty();
						}

					} else {
						$(".div-botao-carregar-esta").empty();
					}

				},

				error: function(x, h, err) {
					alert('Ocorreu um erro inesperado! Tente novamente');
				}
			});

	});

});