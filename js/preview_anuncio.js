$(document).ready(function() { 

	$("#link-preview-anuncio").on("click", function(e) {
		e.preventDefault();

		// 
		$("#preview-anuncio").css("height", "2000px");

		// obter a imagem principal para jgoar no preview do anuncio
		var srcImgPrincipal = $("#fotos").find("img:first").attr("src");

		// criar uma tag img que vai ter a imagem da imagem principal
		var imgPrincipalPreview = $('<img/>');	
		imgPrincipalPreview.attr("src", srcImgPrincipal);
		imgPrincipalPreview.css("width", "inherit");
		imgPrincipalPreview.css("height", "inherit");
		$("#foto-principal").append(imgPrincipalPreview).trigger("create");

		// array que vai conter o src de 5 imagens para mostrarmos no preview
		var arrayFotosEmbarc = [];
		
		// loop para buscar 5 imagens da embarcação
		$("#fotos img").each(function(index, el) { 
			
			if(index < 5)
				// adiciona no array
				arrayFotosEmbarc.push(el.src);
		});

		// mostrar as fotos coletadas
		$.each(arrayFotosEmbarc, function(index, srcImgCorrente){
			var img = $('<img/>');
			img.attr("src", srcImgCorrente);
			img.css("float", "left");
			img.css("width", "50px");
			img.css("height", "50px");
			$("#fotos-preview").append(img).trigger("create");
		});

		// obter informações da embarcação
		var valor = $("#Embarcacoes_valor").val();
		var novoUsado;

		// estado
		if($("#Embarcacoes_estado_0").is(':checked')) {
			novoUsado = 'Novo';
		} else {
			novoUsado = 'Usado';
		}

		var estado = $("#Embarcacoes_estados_id option:selected").text();
		var cidade = $("#Embarcacoes_cidades_id option:selected").text();
		
		var tipo = $("#Embarcacoes_tipo").val();
		var ano = $("#Embarcacoes_ano").val();
		var tamanho = $("#Embarcacoes_tamanho").val();

		var dia = $("#Embarcacoes_dia").val();
		var noite = $("#Embarcacoes_noite").val();

		// motor
		var qtdeMotores = $("#qnt-motores").val();
		var marcaMotor = $("#Embarcacoes_motor_marca").val();
		var modeloMotor = $("#Embarcacoes_motor_modelo").val();
		var tipoMotor = $("#Embarcacoes_motor_tipo").val();
		var potenciaMotor = $("#Embarcacoes_motor_potencia").val();
		var horasMotor = $("#Embarcacoes_potencia_motor").val();

		var descricao = $("#Embarcacoes_descricao").val();

		var ul = $('<ul></ul>');
		ul.append('<li>Preço R$: '+valor+'</li>');
		ul.append('<li>Tipo: '+tipo+'</li>');
		ul.append('<li>Estado: '+novoUsado+'</li>');
		ul.append('<li>Ano Fabricação: '+ano+'</li>');
		ul.append('<li>Tamanho: '+tamanho+ 'pé(s)</li>');

		if(qtdeMotores == 0) {
			ul.append('<li>Motorização: Não há motor.</li>');
		} else {
			ul.append('<li>Qtde motores: '+qtdeMotores+' Marca: '+marcaMotor+ ' Modelo: '+modeloMotor+' Tipo: '+tipoMotor+' Potência: '+potenciaMotor+ ' Horas de Uso: '+horasMotor+'</li>');
		}

		ul.append('<li>Tripulação Dia: '+dia+' Noite: '+noite+'</li>');
		ul.append('<li>Local: '+cidade+' - ' +estado+'</li>');

		ul.css("list-style-type", "none");

		$("#info-embarcacao-preview").append(ul).trigger("create");

		//
		$("html,body").animate({ scrollTop: $(document).height() - 2100 }, "slow");

	});
});
