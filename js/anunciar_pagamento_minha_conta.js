$(document).ready(function() { 

    $("#pagamento").addClass("active");

    // milena pediu pra ticar todos no começo...
    $(".info-label-radio").each(function() {

            $(this).trigger("click");
    });

    $("#card_number").keyup(function() {
        $('#card_number').val($(this).val().replace(/[^0-9]/g,""));
    });


    var valor_ordens = parseFloat($("#valor_ordens").val());

    
    // calcular valor total das ticagens das ordens
    $(".selecao_ordem").on("click", function(e) {

            $(".payment_container").fadeOut("fast");
            $(".linha-pagamento-5").fadeOut("fast");

            var valor = parseFloat($(this).data("valor"));

            // se ticou uma ordem, loop em todas as outras para pegar as ticadas e somar o valor
            if(!$(this).attr("checked")) {

                $(".selecao_ordem").each(function() {

                        if($(this).attr("checked")) {
                            valor += parseFloat($(this).data("valor"));    
                        }
                });
            }

            // se desticou uma ordem, loop em todas as outras para pegar as ticadas e subtrair o valor
            else {

                $(".selecao_ordem").each(function() {

                        if($(this).attr("checked")) {
                            valor -= parseFloat($(this).data("valor"));    
                        }
                });
            }
            

            if(valor == 0) {
                valor = valor_ordens;
            }
            $("#valor_total").text("R$ "+numeral(Math.abs(valor)).format('0,0.00'));

    });


    //style input radio
    $("<span class='span-radio'><i class='ico-radio'></i></span>").insertAfter("input[type='radio']");
    $('.span-radio').on('click', function (e) {
        e.preventDefault();
        $('span').removeClass('section-change');
        $(this).parent().addClass('section-change');
        $('.section-change .span-radio').removeClass('active-radio');
        $(this).addClass('active-radio');
        $(this).prev().trigger('change');
        $(this).prev().trigger('click');
    });

    //style input checkbox
    $("<span id='span-check-pagto' class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter("#concordo input[type='checkbox']");
    $('#concordo').on('click', '.span-checkbox', function (e) {

        $('#concordo input[type="checkbox"] .validate-opacity').hide();
        $(this).prev().trigger('click');
        if ($(this).hasClass('active-radio')) {
            $('#concordo input[type="checkbox"] .span-checkbox').eq(1).removeClass('active-radio');
            $(this).removeClass('active-radio');
        } else {
            $(this).addClass('active-radio');
            $('#concordo input[type="checkbox"] .span-checkbox').eq(1).addClass('active-radio');
        }
        e.preventDefault();
    });

    $(".img_cartao").on("click", function() {

        $(this).prev().trigger("click");
    });

    // clicou para cancelar a ordem de pedido
    $(".cancelar-ordem").on("click", function(e) { 
        e.preventDefault();

        // obter o ID do elemento pois este contem o ID da ordem
        var id = $(this).attr("id");

        // ajax para deletar a ordem
        $.ajax({
            url:Yii.app.createUrl('utils/cancelarOrdemDePedido'),
            type: 'post',
            data: {id_ordem: id},

            success: function(resp) {

                if(resp != "-1") {
                    //console.log(resp);
                    location.reload();
                    
                }
            },

            error: function(x, h, e) {
                //console.log(JSON.stringify(e));
                alert("Erro inesperado. Favor contatar o admin do site.");
                //location.reload();
            }
        });

    });

    // clicou para pagar. Realizar ajax para gerar uma transação com todas as ordens
    $(".link-pagamento").on("click", function(e){

        e.preventDefault();

        // pegar as ordens selecionadas e jogar no array o id
        var id_ordens = [];
        $(".selecao_ordem").each(function() {
                if($(this).attr("checked")) {
                    id_ordens.push($(this).val());
                }
        });


        $.ajax({
            url: Yii.app.createUrl('utils/gerarTransacao'),
            type: 'post',
            data: {
                id_ordens: JSON.stringify(id_ordens)
            },

            success: function(resp) {
            
                if(resp != "-1") {

                    var transacao = JSON.parse(resp.trim());

                    $("#tid").val(transacao.tid);
                    $("#reference").val(transacao.tid);
                    $("#transacao-info").text(transacao.descricao);
                    $(".form-boleto").show();
                    $('.linha-pagamento-5').show();
                    $('.payment_container').show();
                    //$(".link-pagamento").fadeOut("slow");
    
                     $('html, body').animate({
                        scrollTop: $('.form-card').offset().top
                     }, 'fast');
                }
            },

            error: function(x, h, r) {

                //alert(JSON.stringify(r));
                lightBoxmsg("Erro inesperado. Favor contatar o admin do site.");
                //console.log(JSON.stringify(r));

                
            }

        });

    });

    
    $("#card_cvv").blur(function(){
        $("#error-card-cvv").html("");
    }); 

    $("#card_name").blur(function(){
        $("#error-nome-cartao").html("");
    }); 

    $("#card_number").blur(function(){
        $("#error-numero-cartao").html("");
    });

    $("#card_validate_month").blur(function(){
        $("#error-mes").html("");
    });

    $("#card_validate_year").blur(function(){
        $("#error-ano").html("");
    });

    //addClass body
    if (window.location.href.indexOf("anuncioPagamento") > -1) { 
        $('body').addClass('anuncio-payment');
    }

    $("#termos-condicao").on("click", function() {
        $("#error-termos").html("");
    });

    //text valor total header
    var valtot = $('.div-title-pag-4 .title-pag-4').text().replace('R$', ' ');
    $('.div-text-cadastro-lh4 .text-cadastro-lh4').text(valtot);

    // lightbox termos de condição
    $('body').on("click", ".open-terms", function(e) {

        e.preventDefault();

        $('#lbox-detemba').lightbox_me({
            centered: true
        });
    });

    $(".botao-concordar-pg").on("click", function() {
        $("#span-check-pagto").trigger("click");
    });


    // Tabs options payment
    $('.option_payment').on('change', function(e){
        $(this).parent().addClass('active');

        if ($(this).val() == 1) {
            $('.option-boleto').removeClass('active');
            $('.form-card').show();
            $('.form-boleto').hide();
        } else {
            $('.option-card').removeClass('active');
            $('.form-card').hide();
            $('.form-boleto').show();
        }

    });


    $('body').on('click', '#submit-card', function(e){

        e.preventDefault();

        var card_number = $("#card_number").val();
        var card_name = $("#card_name").val();
        var card_cvv = $("#card_cvv").val();
        var ano = $("#card_validate_year").val();
        var mes = $("#card_validate_month").val();

        var flgok = true;

        $("#erro_pagto").empty();
        $("#erro_pagto").append("Ocorreram os seguintes erros:");
        $("#erro_pagto").append("<br/>");

        if(!$("#termos-condicao").is(":checked")) {
            flgok = false;
            //$("#error-termos").html("Aceite os termos de condição");
            $("#erro_pagto").append("<br/>- Aceite os termos de condição.");
        }

        if(!card_number) {
            //$("#error-numero-cartao").html("Insira o número do cartão");
            $("#erro_pagto").append("<br/>- Insira o número do cartão.");
            flgok = false;
        }

        if(!mes) {
            //$("#error-mes").html("Selecione o mês de validação do cartão");
            $("#erro_pagto").append("<br/>- Selecione o mês de validação do cartão.");
            flgok = false;
        }

        if(!ano) {
            //$("#error-ano").html("Selecione o ano de validação do cartão");
            $("#erro_pagto").append("<br/>- Selecione o ano de validação do cartão.");
            flgok = false;
        }

        if(!card_name) {
            //$("#error-nome-cartao").html("Insira o nome do cartão");
            $("#erro_pagto").append("<br/>- Insira o nome do cartão.");
            flgok = false;
        }

        if(!card_cvv) {
            //$("#error-card-cvv").html("Insira a senha de segurança do cartão");
            $("#erro_pagto").append("<br/>- Insira a senha de segurança do cartão.");
            flgok = false;
        }

        if(flgok) {
            
            // lightbox confirma pagto
            $('#lbox-confirmacao').lightbox_me({
                centered: true,
                onLoad: function() {
                },
                onClose: function() {
                }
            });
        }

        else {
            $("#erro_pagto").show();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }

    });


    $("#btn-confirmar").on("click", function() {

        $("#erro_pagto").empty();
        $("#erro_pagto").hide();

        $.ajax({
            url: Yii.app.createUrl('anuncios/PagamentoCartao'),
            type: 'POST',
            data: $("#grid-pagamentos").serialize(),

            error: function(x, h, r) {

                $("#erro_pagto").show();
                $("#erro_pagto").empty();
                $("#erro_pagto").append("Ocorreram os seguintes erros:");
                $("#erro_pagto").append("<br/>");
                $("#erro_pagto").append("<br/>- Pagamento não autorizado pelo operadora.");
                $("html, body").animate({ scrollTop: 0 }, "slow");
                $("#card_number").val("");
                $("#card_name").val("");
                $("#card_cvv").val("");
                
        
            },
            success: function(resp) {

                ga('send', 'event', 'link', 'click', 'Pagamento Cartao');

                //console.log(resp);
                var resp = JSON.parse(resp.trim());

                // msg de erro
                if(resp.error != 0) {
                    $(".close").trigger("click");
                    $("#erro_pagto").show();
                    $("#erro_pagto").empty();
                    $("#erro_pagto").append("Ocorreram os seguintes erros:");
                    $("#erro_pagto").append("<br/>");
                    $("#erro_pagto").append("<br/>- Pagamento não autorizado pelo operadora.");
                    $("html, body").animate({ scrollTop: 0 }, "slow");
                    $("#card_number").val("");
                    $("#card_name").val("");
                    $("#card_cvv").val("");
                } else {
                    $("#card_number").val("");
                    $("#card_name").val("");
                    $("#card_cvv").val("");
                    location.href = Yii.app.createUrl("site/sucesso");
                }
            },

        });
    });


    // variaveis usadas no success do ajax do boleto
    var flg = false;
    var cript_itau;

    function carregabrw() {

        window.open("","SHOPLINE","toolbar=yes,menubar=yes,resizable=yes,status=no,scrollbars=yes,width=815,height=575");
    }

    // clicou pra gerar boleto
    $("#gerar_boleto").on("click", function(e) {

            e.preventDefault();

            ga('send', 'event', 'link', 'click', 'Pagamento Boleto');


            var dados_cript;

            $.ajax({

                url: Yii.app.createUrl('anuncios/pagamentoBoleto'),
                type: 'POST',
                data: $("#grid-pagamentos").serialize(),
                asnyc: false,

                success: function(resp) {

                    var json = JSON.parse(resp);

                    if(json.error == 0) {

                        flg = true;
                        cript_itau = json.cript_itau;
                        $("#DC").attr("value", json.cript_itau);
                    }
                    else {
                        lightBoxMsg("Ocorreu um erro inesperado. Favor contate o admin do sistema");
                        
                    }
                    
                },

                complete: function(resp) {
                    

                    // lightbox confirma pagto
                    $('#lbox-confirmacao-boleto').lightbox_me({
                        centered: true,
                        onLoad: function() {
                        },
                        onClose: function() {
                        }
                    });

                    setTimeout(function(){ location.reload(); }, 10000);
                },

                error: function() {
                    flg = false;
                    lightBoxMsg("Ocorreu um erro inesperado. Favor contate o admin do sistema");
                }
            });

            


    });


    $(".verboleto").on("click", function(e) {
        e.preventDefault();
        var codigoitau = $(this).data("codigoitau");
        $("#DC").attr("value", codigoitau);
        $("#form-itau-boleto").submit();
    });


});