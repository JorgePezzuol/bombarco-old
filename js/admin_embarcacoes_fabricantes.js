$(document).ready(function() {

	$('#EmbarcacaoFabricantes_status').dropdown({gutter : 5});
	//$('#EmbarcacaoFabricantes_embarcacao_macros_id').dropdown({gutter : 5});

	// on change ajax valida nome do fabricante
	$("#EmbarcacaoFabricantes_titulo").on("change", function() {
		
		var fab = $(this).val();
		var macro = $("#macro").val();

		$.ajax({
			url: Yii.app.createUrl('embarcacaoFabricantes/validarNomeFabricante'),
			data: {nomeFabricante: fab, macro:macro},
			type: 'post',

			success: function(resp) {
				//console.log(resp);
				// existe, informar
				if(resp == '1') {
					$("#titulo").html("Fabricante já existe!");
				}
				else {
					$("#titulo").html("");	
				}
			},

			error: function(x, h, z) {
				console.log(h);
			}
		});
	});

	$(".img-pvw-admin").on("click", function() {
		$("#file-logo").trigger("click");
	});

	$('#file-logo').on('change', function() { 

		// preview da imagem
		readURL(this);
		
	});

	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {

		        $('#img-preview-logo').attr('src', e.target.result)
		        $('#img-preview-logo').css("width", "250px");
		        $('#img-preview-logo').css("heigth", "160px");
	    	};
	    reader.readAsDataURL(input.files[0]);
	    }  
	}

});