$(document).ready(function() {

    

    $("#card_number").keyup(function() {
        $('#card_number').val($(this).val().replace(/[^0-9]/g,""));
    });
    //$("#card_number").mask("9999-9999-9999-9999");

    $(".footer").hide();
    $(".advertise-head").hide();
    $(".menu-head").hide();
    $("#nav-bar").hide();

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

        $.ajax({
            url: Yii.app.createUrl('utils/gerarTransacao'),
            type: 'post',
            data: {},

            success: function(resp) {

                if(resp != "-1") {

                    var transacao = JSON.parse(resp.trim());

                    $("#tid").val(transacao.tid);
                    //$("#reference").val(transacao.id);
                    $("#reference").val(transacao.tid);
                    //console.log(transacao.tid);
                    $("#transacao-info").text(transacao.descricao);                    
                    $('.linha-pagamento-5').show();
                    $('.payment_container').show();
                    $(".link-pagamento").fadeOut("slow");

                    $('.payment_container .payment-tabs .form-card').show();

                    $('html, body').animate({
                        scrollTop: $('.payment_container').offset().top - $('.line-header-cad').height() - 10
                    }, 1000);

                }
            },

            error: function(x, h, r) {

                //alert(JSON.stringify(r));
                alert("Erro inesperado. Favor contatar o admin do site.");
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
    $('body').on("click", ".open-terms", function() {
        $('#lbox-detemba').lightbox_me({
            centered: true
        });
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

        var url = null;
        var payment_method = null;
        if ($("#option_payment_card").is(":checked")) {
            url = Yii.app.createUrl('anuncios/PagamentoCartao');
            payment_method = 1;
        } else if ($("#option_payment_boleto").is(":checked")) {
            url = Yii.app.createUrl('anuncios/PagamentoBoleto');
            payment_method = 2;
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: $("#form-pay-card").serialize(),
            beforeSend: function(request) {

                _gaq.push(["_trackEvent", "anuncios", "click", "Finalizar"]);
                adwords_conversor("DxhCCJOQ7lkQkLPC4wM");

                if(!$("#termos-condicao").is(":checked")) {
                    flgok = false;
                    request.abort();
                    $("#error-termos").html("Aceite os termos de condição");
                    return false;
                }

                if (payment_method == 1) {

                    var card_number = $("#card_number").val();
                    var card_name = $("#card_name").val();
                    var card_cvv = $("#card_cvv").val();
                    var ano = $("#card_validate_year").val();
                    var mes = $("#card_validate_month").val();

                    var flgok = true;

                    if(!card_number) {
                        $("#error-numero-cartao").html("Insira o número do cartão");
                        flgok = false;
                        request.abort();
                    }

                    if(!mes) {
                        $("#error-mes").html("Selecione o mês de validação do cartão");
                        flgok = false;
                        request.abort();
                    }

                    if(!ano) {
                        $("#error-ano").html("Selecione o ano de validação do cartão");
                        flgok = false;
                        request.abort();
                    }

                    if(!card_name) {
                        $("#error-nome-cartao").html("Insira o nome do cartão");
                        flgok = false;
                        request.abort();
                    }

                    if(!card_cvv) {
                        $("#error-card-cvv").html("Insira a senha de segurança do cartão");
                        flgok = false;
                        request.abort();
                    }

                    if(flgok) {
                        if(!confirm("Prosseguir com pagamento?")) {
                            request.abort();
                        }
                    }

                }

            },
            error: function(x, h, r) {
                if (payment_method == 1) {
                    $("#error-numero-cartao").html("Pagamento não autorizado pelo operadora!");
                };                
            },

            success: function(resp) {

                //console.log(resp);
                var resp = JSON.parse(resp.trim());

                // msg de erro
                if(resp.error == 4 || resp.error == 3) {
                    $("#error-numero-cartao").html("Pagamento não autorizado pelo operadora!");
                } else if (resp.error == 1) {
                    $(".error_general").css("color","#F44").html(resp.msg);
                } else {

                    if (payment_method == 1) {
                        location.href = Yii.app.createUrl("site/sucesso");
                    } else {
                        location.href = Yii.app.createUrl("site/sucesso/?urlBoleto=" + resp.urlBoleto);
                    }
                    
                }
            },

        });

    });


});