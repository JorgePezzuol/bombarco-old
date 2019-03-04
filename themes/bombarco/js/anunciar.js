/*=============================
=           Anunciar          =
=============================*/

$(document).ready(function() {


if($("#meses-plano-individual").val() == "2"){
	$("#valor-anuncio-individual.gratis").show()
	$("#valor-anuncio-individual.pago").hide()
}
$("#valor-plano-individual").change(function(){
	console.log("asd");
	if($("#meses-plano-individual").val() == "2"){
		$("#valor-anuncio-individual.gratis").show()
		$("#valor-anuncio-individual.pago").hide()
	}else{
		$("#valor-anuncio-individual.gratis").hide()
		$("#valor-anuncio-individual.pago").show()
	}
});
$("#meses-plano-individual").change(function(){
	if($(this).val() == "2"){
		$("#valor-anuncio-individual.gratis").show()
		$("#valor-anuncio-individual.pago").hide()
	}else{
		$("#valor-anuncio-individual.gratis").hide()
		$("#valor-anuncio-individual.pago").show()
	}
});
$(".box-line-3-planos-ind .div-botao-contratar-an .botao-contratar-an").click(function(){
	if($("#meses-plano-individual").val() == "2"){
		url = $(".box-line-3-planos-ind .div-botao-contratar-an .botao-contratar-an").attr("href").split("?")[1].split("&");
		for(var a in url){
			if(url[a].indexOf("meses") == 0)
				url[a] = url[a].split("=")[0] + "=2";
			if(url[a].indexOf("valor") == 0)
				url[a] = url[a].split("=")[0] + "=Grátis";
		}
		window.location = "/anuncios/anunciarEmbarcacao?" + url.join("&");
		return false;
	}
});

	$("#botao-emba-an").click(function(e) {
    		$('.div-textos-bloco').css('display','block');
    		$('.div-textos-bloco-b').css('display','none');
    		$('.div-textos-bloco-c').css('display','none');
    		$('.div-textos-bloco-d').css('display','none');
    		$('.line-anunciar-3-empser').css('display','none');
    		$('.line-anunciar-3-emb').css('display','block');
    		$('.line-anunciar-3-estban').css('display','none');

    		$('.line-anunciar-4-estban').css('display','none');

                      $("#div-anun-bloq").hide();
	           e.preventDefault();
	});

			$("#botao-empser-an").click(function(e) {
    		$('.div-textos-bloco').css('display','none');
    		$('.div-textos-bloco-b').css('display','block');
    		$('.div-textos-bloco-c').css('display','none');
    		$('.div-textos-bloco-d').css('display','none');
    		$('.line-anunciar-3-empser').css('display','block');
    		$('.line-anunciar-3-emb').css('display','none');
    		$('.line-anunciar-3-estban').css('display','none');

    		

             $("#div-anun-bloq").show();


			  e.preventDefault();
		});
			$("#botao-estaleiros-an").click(function(e) {
    		$('.div-textos-bloco').css('display','none');
    		$('.div-textos-bloco-b').css('display','none');
    		$('.div-textos-bloco-c').css('display','block');
    		$('.div-textos-bloco-d').css('display','none');
    		$('.line-anunciar-3-empser').css('display','none');
    		$('.line-anunciar-3-emb').css('display','none');
    		$('.line-anunciar-3-estban').css('display','block');

    		$('.line-anunciar-4-estban').css('display','block');

             $("#div-anun-bloq").hide();

            $("#botao-contato").addClass("empresa");
            $("#botao-contato").removeClass("banner");

            $(".errorMessage").each(function() {
                $(this).html("");
            });

			  e.preventDefault();

		});
			$("#botao-banner-an").click(function(e) {
    		$('.div-textos-bloco').css('display','none');
    		$('.div-textos-bloco-b').css('display','none');
    		$('.div-textos-bloco-c').css('display','none');
    		$('.div-textos-bloco-d').css('display','block');
    		$('.line-anunciar-3-empser').css('display','none');
    		$('.line-anunciar-3-emb').css('display','none');
    		$('.line-anunciar-3-estban').css('display','block');
    		$('.line-anunciar-4-estban').css('display','block');

             $("#div-anun-bloq").hide();

            $("#botao-contato").addClass("banner");
            $("#botao-contato").removeClass("empresa");

            $(".errorMessage").each(function() {
                $(this).html("");
            });
			  e.preventDefault();
		});

		$('.menu-botoes-an .btn-menu-anunciar').on('click',function(){
			if( $(this).hasClass('active')){

			} else{
				$('.menu-botoes-an a.active').removeClass('active');
				$(this).addClass('active');
			}
		});

});
