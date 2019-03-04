$(document).ready(function() { 


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

        $.ajax({
            url: Yii.app.createUrl('anuncios/PagamentoCartao'),
            type: 'POST',
            data: $("#grid-pagamentos").serialize(),
            beforeSend: function(request) {

                _gaq.push(["_trackEvent", "anuncios", "click", "Finalizar"]);
                adwords_conversor("DxhCCJOQ7lkQkLPC4wM");

                if(!$("#termos-condicao").is(":checked")) {
                    flgok = false;
                    request.abort();
                    $("#error-termos").html("Aceite os termos de condição");
                    return false;
                }

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

                

            },
            error: function(x, h, r) {

                $("#error-numero-cartao").html("Pagamento não autorizado pelo operadora!");
        
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
                        location.href = Yii.app.createUrl("site/sucesso");
                }
            },

        });

    });


    // clicou pra gerar boleto
    $("#gerar_boleto").on("click", function(e) {

            e.preventDefault();

            if($(this).data("urlboleto") == "") {

                $.ajax({

                    url: Yii.app.createUrl('teste/pagamentoBoleto'),
                    type: 'POST',
                    data: $("#grid-pagamentos").serialize(),
                    asnyc: false,

                    success: function(resp) {

                        //console.log(resp);
                        var json = JSON.parse(resp);

                        if(json.error == 0) {
                            $("#gerar_boleto").data("urlboleto", json.urlBoleto);
                            window.open(json.urlBoleto, "_blank");    
                        }
                        else {
                            alert("Ocorreu um erro inesperado. Favor contate o admin do sistema");
                        }
                        

                    },

                    error: function() {
                        alert("Ocorreu um erro inesperado. Favor contate o admin do sistema");
                    }
                });

            }

            else {
                window.open($(this).data("urlboleto"), "_blank");
            }



    });


});