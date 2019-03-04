$(document).ready(function() {

	/* ==== FORM DE CADASTRO E UPDATE DE NOTICIAS ===== */
	// variavel que vai ser populada via ajax. com tdas as tags
	var availableTags = [];

	// mascara data
	$("#Conteudos_data").mask("99/99/9999");

	$("#imagem-noticia").on("click", function(){
		$("#file-imagem").trigger('click');
		$("#file-imagem-update").trigger('click');
	});

	$("#file-imagem").on("change", function() {
		var img = $("#imagem-noticia");
		readURL(this, img);
	});

	function readURL(input, img) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
		       img.attr('src', e.target.result)
	    	};
	    reader.readAsDataURL(input.files[0]);
	    }
	}

	// update foto noticia
	// ajax update foto
	$('#file-imagem-update').on("change", function(){

		// nome do arquivo da foto
		var nome = $("#file-imagem-update")[0].files[0].name;

		var fd = new FormData();

		fd.append("ConteudoImagens[imagem]", $("#file-imagem-update")[0].files[0]);
		fd.append("conteudo_imagem_id", $("#conteudo_imagem_id").val());
		fd.append("conteudos_id", $("#conteudos_id").val());

		var conteudo_imagem_id = $("#conteudo_imagem_id").val();
		var conteudos_id = $("#conteudos_id").val();

		$.ajax({
	        url: Yii.app.createUrl('conteudos/updateFoto?conteudo_imagem_id='+conteudo_imagem_id+"&conteudos_id="+conteudos_id),
	        type: 'POST',
	        cache: false,
	        data: fd,
	        processData: false,
	        contentType: false,
	        success: function (resp) {

	        	if(resp != "-1") {
	        		$("#imagem-noticia").attr("src", Yii.app.createUrl('public/conteudos/'+nome));
	        	}
	        },
	        error: function(x, h, z) {
	        	alert(JSON.stringify(z));
	        }
		});

	});

	$("#conteudo_titulo").on("change", function() {
		$("#error-titulo").html("");
	});

	// form da criação de notícias -- caso selecione a macro 'Teste Bombarco'
	// deve se exibir o campo de macros de embarcação (jetski, veleiero, lancha, pesca)
	$("#macro_conteudo").on("change", function() {

		$("#error-macro").html("");

		macro_conteudo = $(this).val();

		if($(this).val() == 'B') {

			$("#div-categoria-update").fadeIn("fast");

			$("#categoria-embarcacao").val("");

			// limpar div
			$("#div-conteudo-macros").html("");

			// ajax listar categorias de acordo com a macro
			$.ajax({
				url: Yii.app.createUrl('conteudos/listarCategorias'),
				data: {macro_conteudo: macro_conteudo},
				type: 'post',

				success: function(resp) {

					var categorias = JSON.parse(resp.trim());

					var selectCategorias = $('<select id="conteudo_categorias_id" name="Conteudos[conteudo_categorias_id]"></select>');
					selectCategorias.addClass('select-anuncio-pad');

					var optionSelected = $('<option value="" selected="selected">Selecione</option>');
					selectCategorias.append(optionSelected);

					for(var i = 0; i < categorias.length; i++) {

						var option = $('<option value="'+categorias[i].id+'">'+categorias[i].slug+'</option>');
						selectCategorias.append(option);
					}

					// append na div
					$("#div-conteudo-macros").append(selectCategorias).trigger('create');
					$("#categoria-noticia").fadeIn("fast");
				},

				error: function(x, h, z) {

				}
			});
		}
		else {
			$("#conteudo_categorias_id").val("");
			$("#categoria-embarcacao").fadeIn("slow");
			$("#categoria-noticia").fadeOut("fast")
			$("#div-categoria-update").fadeOut("fast");

		}
	});

	// alterar categoria
	$("#categoria-update").on("click", function() {

		$("#categoria-update").fadeOut("fast");
		$("#macro_conteudo").trigger("change");
	});

	// habilita campos seo
	$("#check-seo").on("change", function() {

		if($(this).attr("checked")) {

			$("#seo").fadeIn("fast");
		}

		else {
			$("#seo").fadeOut("fast");
		}
	});

		// ajax popular tags
	$.ajax({

		url: Yii.app.createUrl('utils/loadTags'),
		type: 'post',
		data: {},

		success: function(resp) {

			var tagsJson = JSON.parse(resp.trim());

			for(var i = 0; i < tagsJson.length; i++) {

				availableTags.push(tagsJson[i].slug);
			}
		},

		error: function(xhz, r, e) {

		}
	});


	 $(function() {

		function split( val ) {
			return val.split( /,\s*/ );
		}
		function extractLast( term ) {
			return split( term ).pop();
		}

		// keypress exibe todas as tags
		/*$( "#tags" )

		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
				event.preventDefault();
			}
		})
		.autocomplete({
		minLength: 0,
		source: function( request, response ) {

			response( $.ui.autocomplete.filter(
			availableTags, extractLast( request.term ) ) );
		},
		focus: function() {

			return false;
		},
		select: function( event, ui ) {

			var terms = split( this.value );

			terms.pop();

			terms.push( ui.item.value );

			terms.push( "" );

			this.value = terms.join( ", " );
				return false;
			}

		});*/
	});

	/* $("#btn-cadastrar").on("click", function(e) {
	 	// validação antes do submit
	 	e.preventDefault();
	 	var macro_conteudo = $("#macro_conteudo").val();
	 	var titulo = $("#conteudo_titulo").val();
	 	var emb_macro = $("#embarcacao_macros_conteudo").val();
	 	var data = $("#Conteudos_data").val();

	 	var flgok = true;

	 	// se for blog e n tiver selecionad sub categoria
	 	if(macro_conteudo == 'B') {
	 		if($("#conteudo_categorias_id").val() == "") {
	 			flgok = false;
	 			$("#error-sub-categoria").html("Favor selecione a sub-categoria");
	 		}
	 	}

	 	if(macro_conteudo == "") {
	 		flgok = false;
	 		$("#error-macro").html("Favor selecione a categoria");
	 	}

	 	if(titulo == "") {
	 		flgok = false;
	 		$("#error-titulo").html("Favor insira o titulo");
	 	}

	 	if(emb_macro == "") {
	 		flgok = false;
	 		$("#error-emb-macro").html("Favor selecione a categoria da embarcação");
	 	}

	 	if(data == "") {
	 		flgok = false;
	 		$("#error-data").html("Favor selecione a data");
	 	}

	 	// erro
	 	if(!flgok) {
	 		$('html, body').animate({scrollTop:200}, 'slow');
	 	}
	 	// ok
	 	else {
	 		$("#conteudos-form").submit();
	 	}
	 });*/

	$("#conteudo_categorias_id").on("change", function() {
		$("#error-sub-categoria").html("");
	});


	 $("#embarcacao_macros_conteudo").on("change", function() {
	 	$("#error-emb-macro").html("");
	 });

	 $("#Conteudos_data").on("change", function() {
	 	$("#error-data").html("");
	 });


	/* ==================================== */
});
