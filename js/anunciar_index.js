$(document).ready(function() {




if($("#meses-plano-individual").val() == "2"){
    $("#valor-anuncio-individual.gratis").show()
    $("#valor-anuncio-individual.pago").hide()
}
$("#valor-plano-individual").change(function(){
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



        $(".li-menu").each(function() {

            if($(this).hasClass("active") == true) {
                $(this).find("a").trigger("click");
            }
        });

        // links ativos menu 
        $(".li-menu").on("click", function() {

                var $this = $(this);

                $(".li-menu").each(function() {

                        $(this).removeClass("active");
                }); 

                $this.addClass("active");
        });

        // mesma coisa para planos
        var mapPlanos = [];

        // moeda br
        numeral.language('pt-br');

        // using jQuery Mask Plugin v1.7.5
        // http://jsfiddle.net/d29m6enx/2/
        var maskBehavior = function (val) {
         return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {onKeyPress: function(val, e, field, options) {
         field.mask(maskBehavior.apply({}, arguments), options);
         }
        };


        // mascara telefone
       $("#telefone").mask(maskBehavior, options);

        // ajax que traz todos os planos e planos de anuncios individuais cadastrados da tabela planos
        $.ajax({

            url: Yii.app.createUrl('anuncios/listarPlanosDeAnuncios'),
            type: 'post',
            data: {},

            success: function(resp) {

               // recebe em json
              // console.log(resp);
               var planos = JSON.parse(resp.trim());
                
                // para cada plano de anúncio, é criado um objto e este
                // setado com atributos do plano, e então inserido em um array
                for(var i = 0; i < planos.length; i++) {

                    var obj = {};
                    obj.valor = planos[i].valor;
                    obj.duracaomeses = planos[i].duracaomeses;
                    obj.valor = planos[i].valor;
                    obj.id = planos[i].id;
                    obj.qntpermitida = planos[i].qntpermitida;
                    obj.limitepreco = planos[i].limitepreco;
                    mapPlanos.push(obj);
                }
            },

            error: function(xhz, err, msg) {
              //  alert("Ocorreu um erro inesperado. Favor tente mais tarde.");
            }
        });  



        // evento de change no select de mes do anúncio individual
        $("#meses-plano-individual").on("change", function() { 


            if($(this)[0].selectedIndex == 0) {
                $("#href-anunciar-embarcacao").attr("href", "#");
            }

            else {
                var meses = $("#meses-plano-individual").val();
                var valor = $("#valor-plano-individual").val();

                // comparar o valor e mes com o mapa de anuncios para achar o ID do plano
                for(var i = 0; i < mapPlanos.length; i++) {
                    if(mapPlanos[i].limitepreco == valor && mapPlanos[i].duracaomeses == meses) {
                        $("#valor-anuncio-individual").html("R$ "+numeral(mapPlanos[i].valor).format('0,0.00'));
                        $("#href-anunciar-embarcacao").attr("href", Yii.app.createUrl("anuncios/anunciarEmbarcacao?pid="+mapPlanos[i].id+"&meses="+meses+"&valor="+mapPlanos[i].valor+"&qnt=1"+"&individual=1"));
                        break;
                    }
                }
            }
        });

        // evento de change no select de valor do anúncio individual
        $("#valor-plano-individual").on("change", function() { 

            if($(this)[0].selectedIndex == 0) {
                 $("#href-anunciar-embarcacao").attr("href", "#");
            }

            else {
                var meses = $("#meses-plano-individual").val();
                var valor = $("#valor-plano-individual").val();

                // comparar o valor e mes com o mapa de anuncios para achar o ID do plano
                for(var i = 0; i < mapPlanos.length; i++) {
                    if(mapPlanos[i].limitepreco == valor && mapPlanos[i].duracaomeses == meses) {
                        $("#valor-anuncio-individual").html("R$ "+numeral(mapPlanos[i].valor).format('0,0.00'));
                        $("#href-anunciar-embarcacao").attr("href", Yii.app.createUrl("anuncios/anunciarEmbarcacao?pid="+mapPlanos[i].id+"&meses="+meses+"&valor="+mapPlanos[i].valor+"&qnt=1"+"&individual=1"));
                        break;
                    }
                }
            }
        });

        // change no select do planos
        $('.anuncios').on('change', function() {

            if($(this).val() != 'null') {
                var meses = $(this).val();
                var qnt = $(this).data('qtdepermitida');

                for(var i = 0; i < mapPlanos.length; i++) {

                    if(mapPlanos[i].duracaomeses == meses && mapPlanos[i].qntpermitida == qnt) {

                        var valor = mapPlanos[i].valor;
                        var pid = mapPlanos[i].id;

                        //console.log(valor);
                        //console.log(pid);

                        $(this).parent().parent().parent().find('.text3-l3-an-a').text('R$ '+numeral(valor).format('0,0.00'));
                        $(this).parent().parent().parent().find('.botao-contratar-an').attr('href', Yii.app.createUrl("anuncios/anunciarEmbarcacao?pid="+pid+"&qnt="+qnt+"&valor="+valor+"&meses="+meses+"&tipo_anuncio=plano"));
                    }
                }
            }

            else {
                $(this).parent().parent().parent().find('.text3-l3-an-a').text('R$ 0,00');
                 $(this).parent().parent().parent().find('.botao-contratar-an').attr('href', '#');
            }
        });

    
    // clicou em enviar mensagem (mesmo botao de contato de empresa e banner)
    $("#botao-contato").on("click", function(e) {

        e.preventDefault();

        var flgok = true;

        $(".required").each(function() {
            if($(this).val() == "") {
                $(this).parent().find('.errorMessage').html("Favor insira este campo!");
                flgok = false;
            }
        });

        var email = $("#email").val();
        if(!validateEmail(email)) {
            $("#email").parent().find('.errorMessage').html("Insira um email válido!");
            flgok = false;
        }

        if(flgok) {
            $('.preloader').css("z-index", "9999");
            var nome = $("#nome").val();
            var telefone = $("#telefone").val();
            var nome_empresa = $("#nome_empresa").val();

            // contato para empresa
            if($(this).hasClass("empresa")) {
                
                $.ajax({
                    url: Yii.app.createUrl('empresas/contato'),
                    data: {nome: nome, telefone: telefone, email: email, nome_empresa: nome_empresa},
                    type: 'POST',

                    success: function(resp) {
                        $('#lbox-msgok').lightbox_me({
                                centered: true, 
                                onLoad: function() { 
                               
                                    }
                                });
                        $(".required").each(function() {
                            $(this).val("");
                        });
                        $(".errorMessage").each(function(){
                            $(this).html("");
                        });
                    },

                    error: function(x, h, z) {

                    }
                });
            }

            else {
                
                $.ajax({
                    url: Yii.app.createUrl('banners/contato'),
                    data: {nome: nome, telefone: telefone, email: email, nome_empresa: nome_empresa},
                    type: 'POST',

                    success: function(resp) {
                        $('#lbox-msgok').lightbox_me({
                                centered: true, 
                                onLoad: function() { 
                               
                                    }
                                });
                        $(".required").each(function() {
                            $(this).val("");
                        });
                        $(".errorMessage").each(function(){
                            $(this).html("");
                        });
                    },

                    error: function(x, h, z) {

                    }
                });
            }
        }

        
    });

    // function validar email
    function validateEmail(email) {

        if(!email)
            return false;

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test( email ) ) {
            return false;
        } else {
            return true;
        }
    }

    if($("#plano_embarcacao").val() == "1") {
        $(".li-menu").each(function() {
            $(this).removeClass("active");
        })
        $("#li-pacotes").addClass("active");
        $("#botao-empser-an").trigger("click");
    }


}); // ready

