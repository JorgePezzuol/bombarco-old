/*=============================
=            Busca            =
=============================*/

$(document).ready(function() {

    /*Plugin Mais Filtros - Busca*/
    $(".botao-mais-filtros").on("click", function(e) {
      if($(window).width() < 789){
        $(".linha-mais-opcoes").css({"marginTop":-130})
        $(".div-btn-mais-filtros-list").css({"top": "663px", "position": "relative", "zIndex": "100", "background": "#fff", "padding": "20px 0"});
        $('.linha-mais-opcoes').show();
      }else{
        $('.linha-mais-opcoes').slideDown();
      }
      $('.botao-mais-filtros').hide();
      $('.botao-mais-filtros2').css("display","inline-block");
      $('.line-white-2-listagem').css('border-bottom-color','#ffffff');
    });
    $(".botao-mais-filtros2").on("click", function(e) {
      $('.botao-mais-filtros').show();
      $('.botao-mais-filtros2').hide();
      if($(window).width() < 789){
        $('.linha-mais-opcoes').hide();
        $(".div-btn-mais-filtros-list").css({"position": "static", "padding": "0"});
        $(".linha-mais-opcoes").css({"marginTop":0})
      }else{
        $('.linha-mais-opcoes').slideUp();
      }
      $('.line-white-2-listagem').css('border-bottom-color','#cbcbcb');
    });
    /*Fim*/

    var $form = $('#form-search');

    //$('#brand').dropdown({gutter : 5});
    //$('#model').dropdown({gutter : 5});
    //$('#condition').dropdown({gutter : 5});
    //$('#select-listagem5').dropdown({gutter : 5});

    $("#price").ionRangeSlider({

        min: 0,
        max: 2000000,
        from: $(this).data('min'),
        to: $(this).data('max'),
        type: 'double',
        step: 5000,
        hideMinMax: true,
        hideFromTo:true,
        prettify: true,
        hasGrid: false,
        onChange: function(obj) {

            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber);
            var maximo = JSON.stringify(obj.toNumber);

           /* if(minimo == 0) {
                minimo = 1;
            }*/


            $(".slide-price .under span span, .slide-price .under input").html(minimo).priceFormat({
                clearPrefix: true,
                thousandsSeparator: '.',
                centsLimit: 3
            });
            $(".slide-price .under input").val(minimo).priceFormat({
                clearPrefix: true,
                thousandsSeparator: '.',
                centsLimit: 3
            });

            $(".slide-price .above span span, .slide-price .above input").html(maximo).priceFormat({
                clearPrefix: true,
                thousandsSeparator: '.',
                centsLimit: 3
            });
            $(".slide-price .above input").val(maximo).priceFormat({
                clearPrefix: true,
                thousandsSeparator: '.',
                centsLimit: 3
            });

            if (maximo >= 2000000) {
                $(".slide-price .above .prefix").text('+ de');
            } else {
                $(".slide-price .above .prefix").text('até');
            }
        },
        onLoad: function(obj) {
            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber);
            var maximo = JSON.stringify(obj.toNumber);


            $(".slide-price .under span span, .slide-price .under input").html(minimo).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                centsLimit: 3
            });

            $(".slide-price .under input").val(minimo).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                centsLimit: 3
            });

            $(".slide-price .above span span, .slide-price .above input").html(maximo).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                centsLimit: 3
            });
            $(".slide-price .above input").val(maximo).priceFormat({
                prefix: '',
                thousandsSeparator: '.',
                centsLimit: 3
            });
        }
    });


    $("#feets").ionRangeSlider({
        min: 0,
        max: 200,
        type: 'double',
        step: 5,
        hideMinMax: true,
        hideFromTo:true,
        prettify: true,
        hasGrid: false,
        onChange: function(obj) {
            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber),
                maximo = JSON.stringify(obj.toNumber);

           /* if(minimo == 0) {
                minimo = 1;
            }*/

            $(".slide-feet .under span span").html(minimo);
            $(".slide-feet .under input").val(minimo);

            $(".slide-feet .above span span").html(maximo);
            $(".slide-feet .above input").val(maximo);

            /*if (maximo >= 200) {
                $(".slide-feet .above .prefix").text('+ de');
            } else {
                $(".slide-feet .above .prefix").text('até');
            }*/
        },
        onLoad: function(obj) {

            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber),
                maximo = JSON.stringify(obj.toNumber);

            $(".slide-feet .under span span").html(minimo);
            $(".slide-feet .under input").val(minimo);

            $(".slide-feet .above span span").html(maximo);
            $(".slide-feet .above input").val(maximo);
        }
    });


    /*$('.brand .cd-dropdown ul, .model .cd-dropdown ul, .condition .cd-dropdown ul').slimScroll({
        height: '180px',
        width: '100%',
        distance: '10px',
        railVisible: false,
        alwaysVisible: true
    });*/

    // Iniciando modelos travados
    $form.find('.select-modelos.locked').fadeTo(500, 0.3);

    /**
     * AJAX que carrega Modelos a partir de Fabricantes
     * @return {[type]} [description]
     */
    $form.on('change', 'select#brand', function() {

        $(".preloader").remove();

        $("#texto_busca").val("");

        value = $(this).val();

        if (value > 0) {

            $(".preloader").remove();

            $.ajax({
                type: 'POST',
                url: Yii.app.createUrl('utils/DropDownModelos'),
                data: { id: value, input_name: 'modelo', input_id: 'model', placeholder: 'Modelo', selected: ''},
                success: function(data, textStatus, jqXHR) {
                    $form.find('#model').html($(data).html());
                }
            });

            $("body").append('<section class="preloader" style="display: none;"><img src="'+Yii.app.createUrl("img/loader.gif")+'" alt=""></section>');

            //ajaxecute(Yii.app.createUrl('utils/DropDownModelos'), value, "modelo", "model", "#form-search span.select-modelos", "Modelo");
            //ajaxecuteSizeRange(Yii.app.createUrl('utils/LoadSizeRanges'), "#feets", $macro_active, value);

            // mostrando pés
            $form.find('.slide-feet').show();
            $('.categories-listagem-linha-mf').show();

            $("#feets").ionRangeSlider("update", {
                      min: 0,
                max: 200,
                from: 0,
                to: 200
                   });

            $form.find('.select-modelos').fadeTo(500, 1);

        } else {
            $form.find('.select-modelos').fadeTo(500, 0.3);
            resetForm();
        }

    });


    /**
     * AJAX que carrega Preco e Pés a partir do Modelo
     * @return {[type]} [description]
     */
    $form.on('change', 'select#model', function() {

        $('.categories-listagem-linha-mf').css('opacity','0.2');
        $('.validate-opacity-tipo').show();

        // Atualizando Ranges
        /*$.ajax({
            type: 'POST',
            url: Yii.app.createUrl('utils/LoadRanges'),
            data: { id: $(this).val() },
            success: function(data, textStatus, jqXHR) {

                // escondendo pés
                $form.find('.slide-feet').css('opacity','0.2');
                $('.validate-opacity-range2').show();

                json = jQuery.parseJSON(data);

                // Se existe embarcacao para aquele modelo
                // os valores MAX e MIN não serão NULL
                // então recarrega o Range
                if (json.minprice != null && json.maxprice != null) {

                    max = 2000000;
                    if (convertInt(json.maxprice) > max)
                        max = convertInt(json.maxprice);

                    $("#price").ionRangeSlider("update", {
                        //min: convertInt(json.minprice),
                        //max: convertInt(json.maxprice),
                        max: max,
                        from: convertInt(json.minprice),
                        to: convertInt(json.maxprice)
                    });
                    $(".slide-price .above .prefix").text('até');

                } else {// Se não zera o Range

                    $("#price").ionRangeSlider("update", {
                        min: 0,
                        max: 2000000,
                        from: 0,
                        to: 2000000
                    });
                }
            }
        });*/

    });


    // offset
    var page = 1;

    $(".div-btn-carregar-list").on("click", "#carregar-list", function(e) {

            e.preventDefault();

            $limit = $(this).data("limit");

            data = {};
            data['macro'] = $(this).data("macro");
            data['condicao'] = $(this).data("condicao");
            data['fabricante'] = $(this).data("fabricante");
            data['modelo'] = $(this).data("modelo");
            data['preco-min'] = $(this).data("preco-min");
            data['preco-max'] = $(this).data("preco-max");
            data['pes-min'] = $(this).data("pes-min");
            data['pes-max'] = $(this).data("pes-max");
            data['page'] = page;
            data['local'] = $(this).data("local");
            data['buscando'] = $(this).data("buscando");
            data['tipos'] = $(this).data("tipos");
            data['ordem'] = $(this).data("ordem");
            data['ajax'] = true;

            $.ajax({
                url: Yii.app.createUrl('embarcacoes/busca'),
                data: data,
                type: 'GET',

                success: function(resp) {

                    json = JSON.parse(resp.trim());

                    if (json.count > 0) {

                        $(".categories-tabela").append(json.html);

                        $(".balao_contato").on("click", function(e) {

                                e.stopImmediatePropagation();

                                var embarc_id = $(this).data("embarcid");
                                var email = $(this).data("email");

                                $("#idEmbarcacao").val(embarc_id);
                                $("#emailEmbarcacao").val(email);

                                // ajax pegar infos do dono da embarc
                                $.ajax({

                                    url: Yii.app.createUrl("embarcacoes/consultarDonoEmbarc"),
                                    data: {
                                        embarcacacao_id: embarc_id
                                    },
                                    type:"post",
                                    async: false,

                                    success: function(resp_json) {

                                        var usuario = JSON.parse(resp_json);

                                        $("#nome_destinatario").val(usuario.nome);
                                        $("#idUsuarioDonoEmbarc").val(usuario.id);



                                    }
                                });

                                $('#lbox-detemba').lightbox_me({
                                        centered: true
                                });

                        });


                        // incrementar page
                        page++;

                        // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                        if (json.count < $limit) {
                            $(".div-btn-carregar-list").empty();
                        }

                    } else {
                        $(".div-btn-carregar-list").empty();
                    }

                },

                error: function(x, h, err) {
                    alert('Ocorreu um erro inesperado! Tente novamente');
                }
            });

    });


    $(".checkbox-lis-emb .checkcad1").on('click', function(){
        $form.find("input[name='ordem']").val($(this).val());
        $form.submit();
    });




/**
 * Zera os valores do Form
 * @return {[type]} [description]
 */
function resetForm() {

    $("#price").ionRangeSlider("update", {
        min: 0,
        max: 2000000,
        from: 0,
        to: 2000000
    });

    $("#feets").ionRangeSlider("update", {
        min: 0,
        max: 200,
        from: 0,
        to: 200
    });

    $('#form-search .slide-feet').fadeTo(500,1);
    $('#form-search .select-modelos').fadeTo(500, 0.3);
    $('#form-search #model').html('<option value="-1" selected>Selecione</option>');
    //$('#form-search .model input[name="modelo"]').val("-1");
    //$('#form-search .model .cd-dropdown > span > span').text("Selecione a marca");

}

/*-----  End of Busca  ------*/


$(".balao_contato").on("click", function(e) {

        e.stopImmediatePropagation();

        var embarc_id = $(this).data("embarcid");
        var email = $(this).data("email");
        var titulo = $(this).data("titulo");
        var valor = $(this).data("valor");
        var link = location.origin + $(this).data("link");

        $("#idEmbarcacao").val(embarc_id);
        $("#emailEmbarcacao").val(email);

        $(".hidden_partner_id").val(embarc_id);
        $(".hidden_partner_titulo").val(titulo);
        $(".hidden_partner_link").val(link);
        $(".hidden_partner_valor").val(valor);


        // ajax pegar infos do dono da embarc
        $.ajax({

            url: Yii.app.createUrl("embarcacoes/consultarDonoEmbarc"),
            data: {
                embarcacacao_id: embarc_id
            },
            type:"post",
            async: false,

            success: function(resp_json) {

                var usuario = JSON.parse(resp_json);

                $("#nome_destinatario").val(usuario.nome);
                $("#idUsuarioDonoEmbarc").val(usuario.id);



            }
        });

        $('#lbox-detemba').lightbox_me({
                centered: true
        });

});



    /**
     * Valida Email
     * @param  {[type]} email [description]
     * @return {[type]}       [description]
     */
    function validateEmail(email) {

        if (!email || email.length == 0)
            return false;

        var emailReg = /\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/;

        if (!emailReg.test(email))
            return true;

        return false;
    }


// botao contato
$("#btn-contato-anunciante").on("click", function(e) {

        e.stopImmediatePropagation();

        var nome = $("#nome-contato-anunciante").val();
        var email_remetente = $("#email-contato-anunciante").val();
        var telefone = $("#telefone-contato-anunciante").val();
        var mensagem = $("#mensagem-contato-anunciante").val();
        var senha = $("#senha-contato-anunciante").val();
        var j8BSVuvy = $(".j8BSVuvy").val();
        

        var flgok = true;



        if (nome.length == 0 || email_remetente.length == 0 || mensagem.length == 0 || telefone.length == 0) {

            $("#erro-contato").text("Preencha todos os campos!");
            flgok = false;


        } else {

            if (!validateEmail(email_remetente)) {
                $("#erro-contato").text("Email inválido!");
                flgok = false;

            }

            if (flgok) {

                $('.preloader').css("z-index", "9999");

                $.ajax({
                    url: Yii.app.createUrl('contatos/mailAnunciante'),
                    data: {
                        nome_rem: nome,
                        nome_destinatario: $("#nome_destinatario").val(),
                        email_remetente: email_remetente,
                        senha: senha,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        idUsuarioDonoEmbarc: $("#idUsuarioDonoEmbarc").val(),
                        idEmbarcacao: $("#idEmbarcacao").val(),
                        emailEmbarcacao: $("#emailEmbarcacao").val(),
                        resposta: 0,
                        partner_finan: ($("#partner_finan").is(':checked')) ? $("#partner_finan").val() : 0,
                        partner_cons: ($("#partner_cons").is(':checked')) ? $("#partner_cons").val() : 0,
                        partner_trans: ($("#partner_trans").is(':checked')) ? $("#partner_trans").val() : 0,
                        //seg: ($("#partner_seg").is(':checked')) ? $("#partner_seg").val() : 0,
                        j8BSVuvy: j8BSVuvy
                    },
                    type: 'POST',
                    success: function (resp) {

                        if (resp.trim() == '-3') {
                            $("#lbox-detemba .ev-titleb").text("Detectamos seu cadastro, digite sua senha");
                            $("#lbox-detemba .email-contato-anunciante").hide();
                            $("#lbox-detemba .nome-contato-anunciante").hide();
                            $("#lbox-detemba .telefone-contato-anunciante").hide();
                            $("#lbox-detemba .mensagem-contato-anunciante").hide();
                            $("#lbox-detemba .senha-contato-anunciante").show();
                            return false;
                        }

                        if (resp.trim() == '-5') {
                            alert("Não é possível enviar uma mensagem a si mesmo");
                            return false;
                        }

                        if (resp.trim() == '-7') {
                            alert("Senha inválida");
                            return false;
                        }

                        if (resp.trim() == '2') {
                            lightBoxMsgSucessoReload("Mensagem enviada com sucesso!");
                            $('#close-form-contato').trigger("click");
                            return false;
                        }

                        if (resp.trim() != '-1') {

                                lightBoxMsgSucesso("Mensagem enviada com sucesso!");
                                $('#close-form-contato').trigger("click");

                        } else {
                            alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                        }
                    },
                    error: function (x, h, err) {
                        alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                    }
                });

                                // escolhue consorsorciom finan, etc
                $(".checkbox_partners_lgbox").each(function() {

                    if($(this).is(":checked")) {

                        var id_form = $(this).data("form");

                        // transferir valores do form de contato principal para o form das abas de partners
                        $("#"+id_form).find(".nome").val($("#nome-contato-anunciante").val());
                        $("#"+id_form).find("input[type='email']").val($("#email-contato-anunciante").val());
                        $("#"+id_form).find("input[type='tel']").val($("#telefone-contato-anunciante").val());

                        $.ajax({
                                url: $("#"+id_form).attr("action"),
                                type: 'POST',
                                async: false,
                                data: $("#"+id_form).serialize(),
                                success: function(resp) {
                                    //var json = JSON.parse(resp);
                                }

                            });
                    }

                });
            }
        }
});

        // n tem resultado
        if($("#semresultado").val() == 1) {
            $("#resultados").css("min-height", "auto");
            $("#wrap-container").css("border-bottom", "none");
        }

        // se n tiver embarcacao patriocinadas (as q ficam na div de fundo cinza)
        // e se n for mobile...
        if($("#semdestaque").val() == 1 && isMobile() == false) {
            $("#resultados").css("margin-left", "300px");
        }

}); 




