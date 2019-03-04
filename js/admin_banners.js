$(document).ready(function() {

	// locais dos banners
	var topo = 1;
	var horizontal = 2;
	var lateral = 3;

	// constantes de erro
	var ERRO_EXCEDEU_ALTURA = -1;
	var ERRO_EXCEDEU_LARGURA = -2;
	var ERRO_EXCEDEU_PESO = -3;
	var SUCESSO = 1;

	// true - ok / false - erro de validação
	var flgOK = true;

	$(".img-banners").on("click", function () {

		$(this).parent().find('input[type="file"]').trigger("click");
	});

	$("#Banners_local").on("change", function() {

		// zerar imagem
		//$("#img-preview-imagem-topo").attr("src", Yii.app.createUrl('img/sem_logo_bb.jpg'));
		//$("#img-preview-imagem").attr("src", Yii.app.createUrl('img/sem_logo_bb.jpg'));

		// zerar mensagens de erro
		$("#error-imagem").html("");
		$("#error-imagem-topo").html("");

		// se escolher topo, abrir as duas opções
		var posicao = $(this).val();

		if(posicao != "") {

			$("#error-local").html("");

			if(posicao == topo) {

				$("#div-imagem").fadeIn("slow");
				$("#div-imagem-topo").fadeIn("slow");
			}

			else {
				$("#div-imagem-topo").fadeOut("slow");
				$("#div-imagem").fadeIn("slow");
			}
		}

		else {
			$("#div-imagem").fadeOut("slow");
			$("#div-imagem-topo").fadeOut("slow");
		}
		
	});


	$('input[type=file]').on('change', function() { 

		// preview da imagem
		var img = $(this).parent().find("img");
		readURL(this, img);

		// input file
		var $this = $(this);

		// limpar possiveis mensagens de erro
		if($(this).attr("id") == "file-imagem") {
			$("#error-imagem").html("");
		}
		else {
			$("#error-imagem-topo").html("");	
		}

		// ajax que valida a imagem do banner
		var nome = $(this)[0].files[0].name;
		var local = $("#Banners_local").val();

		// 1 indica banner fechado
		// 2 indica banner aberto
		var abertoFechado = '1';

		// se o local for o topo (1), temos que ver qual banner será validado
		// o da imagem do topo ou o da imagem
		if(local == '1') {

			// ver o id do input file para descobrir se eh o expansivo ou imagem normal
			if($(this).attr("id") == 'file-imagem-topo') {
				// imagem topo (banner aberto)
				abertoFechado = '2';
			}
		}

		var fd = new FormData();

		fd.append("imagem", $(this)[0].files[0]);
		fd.append("local", local);
		fd.append("abertoFechado", abertoFechado);

		$.ajax({
		        url: Yii.app.createUrl('banners/validarImagem'),
		        type: 'POST',
		        cache: false,
		        data: fd,
		        processData: false,
		        contentType: false,

		        success: function (resp) {
		        	
		        	var $errorMessage;

		        	if($this.attr("id") == "file-imagem") {
		        		$errorMessage = $("#error-imagem");
		        	}
		        	else {
		        		$errorMessage = $("#error-imagem-topo");
		        	}

		        	if(resp == ERRO_EXCEDEU_ALTURA) {

		        		$errorMessage.html("Ultrapassou a altura.");
		        		flgOK = false;
		        	}

		        	else if(resp == ERRO_EXCEDEU_LARGURA) {

		        		$errorMessage.html("Ultrapassou a largura.");
		        		flgOK = false;
		        	}

		        	else if(resp == ERRO_EXCEDEU_PESO) {

		        		$errorMessage.html("Arquivo muito pesado.");
		        		flgOK = false;
		        	}

		        	else if(resp == SUCESSO) {
		        		flgOK = true;
		        	}

		        },

		        error: function(x, h, z) {
		        	alert(JSON.stringify(z));
		        }
		});

		// preview imagem
	});

	function readURL(input, img) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
		       img.attr('src', e.target.result)
		        img.css("width", "175px");
		        img.css("heigth", "175px");
	    	};
	    reader.readAsDataURL(input.files[0]);
	    }  
	}

	$("#Banners_inicio").on("change", function() {
		$("#error-inicio").html("");
	});

	$("#Banners_fim").on("change", function() {
		$("#error-fim").html("");
	});

	$("#Banners_embarcacao_macros_id").on("change", function (){
		if($(this).val() != "") {
			$("#error-macro").html("");
		}
	});



	$("#Usuarios_senha").on("change", function () {
		$("#error-senha").html("");
	});

	$("#id_usuario").on("change", function () {
		$("#error-id-usuario").html("");
	});


	$("#check-novo-usuario").on("change", function() {

		console.log($(this).attr("checked"));

		if($(this).is(":checked")) {

			$("#select-usuario").fadeOut("slow");
			$("#hidden-novo-usuario").fadeIn("slow");
		}
		else {
				$("#select-usuario").fadeIn("slow");
			$("#hidden-novo-usuario").fadeOut("slow");
		}
	});



	// submit form - validar (cadastro)
	$("#btn-form-banner").on("click", function(e){

		e.preventDefault();

		var inicio = $("#Banners_inicio").val();
		var fim = $("#Banners_fim").val();
		var local = $("#Banners_local").val();
		var embarc_macro = $("#Banners_embarcacao_macros_id").val();
		var imagem = $("#file-imagem").val();
		var imagem_topo = $("#file-imagem-topo").val();
		var email = $("#Usuarios_email").val();
		var senha = $("#Usuarios_senha").val();
		var id_usuario = $("#id_usuario").val();

		
		// indica se escolheu o banner expansivo
		var flgExpansivo = false;
		if(local == '1') {
			flgExpansivo = true;
		}

		// escolheu usuario pelo autocomplete
		if(id_usuario == "" && $("#check-novo-usuario").is(':checked') == false) {
			$("#error-id-usuario").html("Escolha o usuário");
			flgOK = false;
		}

		if($("#check-novo-usuario").attr("checked")) {
			if(!email) {
				$("#error-email").html("Insira o email do usuário");
				flgOK = false;
			}

			if(!senha) {
				$("#error-senha").html("Insira a senha para o usuario");
				flgOK = false;
			}
		}


		if(!inicio) {
			$("#error-inicio").html("Insira uma data de início");
			flgOK = false;
		}

		if(!fim) {
			$("#error-fim").html("Insira uma data para o fim");
			flgOK = false;
		}

		if(!local) {
			$("#error-local").html("Selecione a posição do banner");
			flgOK = false;
		}

		if(!embarc_macro) {
			$("#error-macro").html("Insira a categoria do banner");
			flgOK = false;
		}

		if(!imagem) {
			$("#error-imagem").html("Insira a imagem do banner");
			flgOK = false;
		}

		if(flgExpansivo) {
			if(!imagem_topo) {
				$("#error-imagem-topo").html("Insira a imagem expansiva do banner");
				flgOK = false;		
			}
		}

		// validação ok, submeter o form
		if(flgOK) {
			$("#banners-form").submit();
		}

	});

	// submit form - validar (alterar)
	$("#btn-form-alterar-banner").on("click", function(e){

		e.preventDefault();

		// validação ok, submeter o form
		if(flgOK) {
			$("#banners-form").submit();
		}

	});



});