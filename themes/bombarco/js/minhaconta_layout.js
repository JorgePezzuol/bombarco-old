$(document).ready(function() {

		$(".aba-minha-conta").on("click", function(e) {
			e.preventDefault();
			var link = $(this).attr("href");
			atualizarAba(link);

			if( $(this).hasClass('active')){

			} else{
				$('.line-inst-2 a.active').removeClass('active');
				$(this).addClass('active');
			}
		});

		function atualizarAba(link) {
			
			// esconder as demais abas e habilitar a div
			// do link em questão
			$("#"+link).fadeIn("fast");
			$('.aba-minha-conta').each(function(){

				var href = $(this).attr("href");

				if(href != link) {
					$("#"+href).fadeOut("fast");
				}
			});

		}

});