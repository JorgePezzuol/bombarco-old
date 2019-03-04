$(document).ready(function () {
    

    // form de contato. Como ja existe a func de contato usando o lightbox, só iremos transferir os valores e dar um
    // trigger no botao do lightbox
    $("#btn-contato-anunciante_principal").on("click", function(e) {

        e.preventDefault();
        //e.stopPropagation();
        e.stopImmediatePropagation();


        if(validateEmail($("#email_principal").val() == false)) {
            lightBoxMsg("Favor preencher corretamente o e-mail.");
            return false;    
        }
        

        if($("#celular_principal").val().length < 8) {
            lightBoxMsg("Favor preencher corretamente o número de telefone.");
            return false;
        }


        $("#nome-contato-anunciante").val($("#nome_principal").val());
        $("#email-contato-anunciante").val($("#email_principal").val());
        $("#telefone-contato-anunciante").val($("#celular_principal").val());
        $("#mensagem-contato-anunciante").val($("#mensagem_principal").val());

        $(".preloader").show();
        $(".preloader").css("z-index", 99999);

        // clicou no botao de enviar principal e selecionou que quer saber mais sobre
        $(".checkbox_partners").each(function() {

            if($(this).is(":checked")) {

                var id_form = $(this).data("form");

                // transferir valores do form de contato principal para o form das abas de partners
                $("#"+id_form).find(".nome").val($("#nome_principal").val());
                $("#"+id_form).find("input[type='email']").val($("#email_principal").val());
                $("#"+id_form).find("input[type='tel']").val($("#celular_principal").val());

                /*$.ajax({
                        url: $("#"+id_form).attr("action"),
                        type: 'POST',
                        async: false,
                        data: $("#"+id_form).serialize(),
                        success: function(resp) {
                            //var json = JSON.parse(resp);

                        }

                    });*/
            }

        });



        // ver se deseja receber conteudo adicional
        if($("#quero_receber").is(":checked")) {

            var user_agent = navigator.userAgent;

            // ajax cadastrar usuario para receber email marketing
            $.ajax({
                url: Yii.app.createUrl('maillings/create'),
                data: {
                    email: $("#email_principal").val(), user_agent: user_agent
                },
                async: false,
                type: 'post'
            });

        }

        if($("#partner_trans_principal").is(":checked")) {

            $("#partner_trans").prop("checked", true);
        }

        else {
            $("#partner_trans").prop("checked", false);
        } 

        if($("#partner_finan_principal").is(":checked")) {

            $("#partner_finan").prop("checked", true);
        }

        else {
            $("#partner_finan").prop("checked", false);
        }   

        if($("#partner_cons_principal").is(":checked")) {
            $("#partner_cons").prop("checked", true);
        }

        else {
            $("#partner_cons").prop("checked", false);  
        }

        if($("#partner_marina_principal").is(":checked")) {
            $("#partner_marina").prop("checked", true);
        }

        else {
            $("#partner_marina").prop("checked", false);  
        }

        $(".preloader").hide();
        $("#btn-contato-anunciante").trigger("click");

    }); 

    $("#btn-contato-detemba").on("click", function(e) {
        e.preventDefault();
        $("#btn_contato2").trigger("click");
    })


    $("#btn_contato2").on("click", function() {


        $('#lbox-detemba').lightbox_me({
            centered: true
        });
    });

    // clicou em enviar mensagem em detalhe de anuncio ou respondeu resp de anuncio
    $("#btn-contato-anunciante").on("click", function (e) {

        e.preventDefault();

        ga('send', 'event', 'link', 'click', 'Enviar Mensagem');

        // pega o tipo da mensagem no campo hidden (E - empresa/estaleiro, X - anuncio)
        var tipo = $("#tipo").val();

        var nome = $("#nome-contato-anunciante").val();
        var nome_destinatario = $("#nome-contato").val();
        var email_remetente = $("#email-contato-anunciante").val();
        var telefone = $("#telefone-contato-anunciante").val();
        var mensagem = $("#mensagem-contato-anunciante").val();
        var senha = $("#senha-contato-anunciante").val();
        var j8BSVuvy = $(".j8BSVuvy").val();
        var idUsuarioDonoEmbarc = $("#idUsuarioDonoEmbarc").val();

        var flgok = true;

        if (nome.length == 0 || email_remetente.length == 0 || mensagem.length == 0 || telefone.length == 0) {

            flgok = false;
            lightBoxMsg("Preencha todos os campos!");

        } else {

            if (!validateEmail(email_remetente)) {
                lightBoxMsg("Email inválido!");
                flgok = false;
            }

            if (flgok) {

                $('.preloader').css("z-index", "9999");

                // url de resp de anuncio
                var url = Yii.app.createUrl('contatos/mailAnunciante');

                // se for do tipo empresa ou estaleiro
                if (tipo == 'G') {
                    url = Yii.app.createUrl('contatos/contatoEmpresaResposta');
                }

                $.ajax({
                    url: url,
                    async: false,
                    data: {
                        nome_rem: nome,
                        nome_destinatario: nome_destinatario,
                        email_remetente: email_remetente,
                        senha: senha,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        idUsuarioDonoEmbarc: idUsuarioDonoEmbarc,
                        idEmbarcacao: $("#idEmbarcacao").val(),
                        emailEmbarcacao: $("#emailEmbarcacao").val(),
                        resposta: $("#resposta").val(),
                        partner_trans: ($("#partner_trans").is(':checked')) ? $("#partner_trans").val() : 0,
                        partner_finan: ($("#partner_finan").is(':checked')) ? $("#partner_finan").val() : 0,
                        partner_cons: ($("#partner_cons").is(':checked')) ? $("#partner_cons").val() : 0,
                        partner_marina: ($("#partner_marina").is(':checked')) ? $("#partner_marina").val() : 0,
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
                            lightBoxMsg("Não é possível enviar uma mensagem a si mesmo");
                            return false;
                        }

                        if (resp.trim() == '-7') {
                            lightBoxMsg("Senha inválida");
                            return false;
                        }

                        if (resp.trim() == '2') {
                            lightBoxMsgSucessoReload("Mensagem enviada com sucesso!");
                            $('#close-form-contato').trigger("click");
                            return false;
                        }

                        if (resp.trim() != '-1') {

                            if ($("#resposta").val() == 0) {

                                lightBoxMsgSucesso("Mensagem enviada com sucesso!");
                                $('#close-form-contato').trigger("click");

                            } else {

                                var nome = $("#nome-contato-anunciante").val();
                                var data = $("#data").val();

                                var mensagem = $("#mensagem-contato-anunciante").val();

                                var div = $('<div class="mensagem-individual-resposta"><span class="resposta-autor"><b>' + nome + '</b> ' + data + '</span><p>' + mensagem + '</p></div>');
                                $("#div-mensagens").prepend(div).trigger("create");

                                $("#mensagem-contato-anunciante").val("");
                            }

                        } else {
                            lightBoxMsg("Ocorreu um erro inesperado. Tente novamente mais tarde");
                        }
                    },
                    error: function (x, h, err) {
                        
                        lightBoxMsg("Ocorreu um erro inesperado. Tente novamente mais tarde");
                    }
                });

                // caso tenha escolhido consorcio, finan nios lightbox
                $(".checkbox_partners_lgbox").each(function() {

                    if($(this).is(":checked")) {

                        var id_form = $(this).data("form");

                        if(id_form == "form_finan") {
                            ga('send', 'event', 'link', 'click', 'Financiamento');

                        }
                        else if(id_form == "form_cons") {
                            ga('send', 'event', 'link', 'click', 'Consorcio');
                        }
                        else {
                            ga('send', 'event', 'link', 'click', 'Transporte');

                        }

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


            } // fim flg ok
        }
    });

    // clicou em enviar mensagem em detalhe de empresa ou respondeu resp de empresa
    $("#btn-contato-empresa").on("click", function (e) {
        var flgok = true;

        e.preventDefault();

        // pega o tipo da mensagem no campo hidden (E - empresa/estaleiro, X - anuncio)
        var tipo = $("#tipo").val();

        var nome = $("#nome-contato-anunciante").val();
        var email_remetente = $("#email-contato-anunciante").val();
        var telefone = $("#telefone-contato-anunciante").val();
        var mensagem = $("#mensagem-contato-anunciante").val();
        var j8BSVuvy = $(".j8BSVuvy").val();

        var userProperties = {
            nome: nome,
            email: email_remetente,
            telefone: telefone
        }

        if (nome.length == 0 || email_remetente.length == 0 || mensagem.length == 0 || telefone.length == 0) {
            flgok = false;
            lightBoxMsg("Preencha todos os campos");
        }
        else {

            flgok = validateEmail(email_remetente);

            if (flgok) {
                $('.preloader').css("z-index", "9999");

                $.ajax({
                    url: Yii.app.createUrl('contatos/contatoEmpresaResposta'),
                    data: {
                        nome_rem: nome,
                        email_remetente: email_remetente,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        empresas_id: $("#empresas_id").val(),
                        usuarios_id_dest: $("#usuarios_id_dest").val(),
                        resposta: $("#resposta").val(),
                        j8BSVuvy: j8BSVuvy,
                    },
                    type: 'POST',
                    success: function (resp) {


                        if (resp.trim() != '-1') {
                            var nome = $("#nome-contato-anunciante").val();
                            var data = $("#data").val();

                            var mensagem = $("#mensagem-contato-anunciante").val();
                            var div = $('<div class="mensagem-individual-resposta"><span class="resposta-autor"><b>' + nome + '</b> ' + data + '</span><p>' + mensagem + '</p></div>');
                            $("#div-mensagens").prepend(div).trigger("create");


                        }

                        else {
                            lightBoxMsg("Ocorreu um erro inesperado. Tente novamente mais tarde");
                        }
                    },
                    error: function (x, h, err) {

                        lightBoxMsg("Ocorreu um erro inesperado. Tente novamente mais tarde");
                    }
                });
            }

        }
    });




    $("#btn-contato-institucional2").on("click", function (e) {
        e.preventDefault();

        var nome = $("#nome2").val();
        var email = $("#email2").val();
        var telefone = $("#telefone2").val();
        var mensagem = $("#mensagem2").val();
        var mLmA8MdP = $(".mLmA8MdP").val();
        var flgok = true;

        if (nome.length == 0 || email.length == 0 || mensagem.length == 0 || telefone.length == 0) {

            $("#erro-contato").text("Insira os campos necessários!");
            flgok = false;

        } else {

            if (!validateEmail(email)) {
                $("#erro-contato").text("Email inválido!");
                flgok = false;
            }

            if (flgok) {
                $('.preloader').css("z-index", "9999");
                // ajax criar contato
                $.ajax({
                    url: Yii.app.createUrl('contatos/contatoBombarco'),
                    data: {
                        nome_rem: nome,
                        email_rem: email,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        mLmA8MdP: mLmA8MdP,
                    },
                    type: 'POST',
                    success: function (resp) {

                        if (resp.trim() != '-1') {

                            $(".close").trigger("click");

                            /* Função para Lightbox Msg enviada com sucesso */
                            $('#lbox-msgok').lightbox_me({centered: true,
                                onLoad: function() {
                                    $("#lbox-msgok").addClass("show");
                                },
                                onClose: function() {
                                    $("#lbox-msgok").removeClass("show");
                                }
                            });

                            // limpar campos
                            $("#nome2").val("");
                            $("#email2").val("");
                            $("#telefone2").val("");
                            $("#mensagem2").val("");
                        }

                        else {
                            $("#erro-contato").text("Erro ao enviar a mensagem!");
                        }
                    },
                    error: function (x, h, err) {

                        $("#erro-contato").text("Erro ao enviar a mensagem!");
                    }
                });
            }
        }

    });


    // form de contato de envio de email em /institucional
    $("#btn-contato").on("click", function (e) {
        e.preventDefault();

        var nome = $("#nome").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var mensagem = $("#mensagem").val();
        var mLmA8MdP = $(".mLmA8MdP").val();

        var userProperties = {
            nome: nome,
            email: email,
            telefone: telefone
        }


        var flgok = true;

        if (nome.length == 0 || email.length == 0 || mensagem.length == 0 || telefone.length == 0) {
            $("#erro-contato").text("Insira os campos necessários!");
            flgok = false;
        } else {

            if (!validateEmail(email)) {
                $("#erro-contato").text("Email inválido!");
                flgok = false;
            }

            if (flgok) {
                $('.preloader').css("z-index", "9999");
                // ajax criar contato
                $.ajax({
                    url: Yii.app.createUrl('contatos/contatoBombarco'),
                    data: {
                        nome_rem: nome,
                        email_rem: email,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        mLmA8MdP: mLmA8MdP
                    },
                    type: 'POST',
                    success: function (resp) {


                        if (resp.trim() != '-1') {

                            $(".close").trigger("click");
                            /* Função para Lightbox Msg enviada com sucesso */
                            $('#lbox-msgok').lightbox_me({
                                centered: true,
                                onLoad: function() {
                                    $("#lbox-msgok").addClass("show");
                                },
                                onClose: function() {
                                    $("#lbox-msgok").removeClass("show");
                                    location.reload();
                                }
                            });

                            // limpar campos
                            $("#nome").val("");
                            $("#email").val("");
                            $("#telefone").val("");
                            $("#mensagem").val("");

                        }

                        else {
                            $("#erro-contato").text("Erro ao enviar a mensagem!");
                        }
                    },
                    error: function (x, h, err) {

                        $("#erro-contato").text("Erro ao enviar a mensagem!");
                    }
                });
            }
        }
    });




    /**
     * Valida Email
     * @param  {[type]} email [description]
     * @return {[type]}       [description]
     */
    function validateEmail(email) {

        if(email != "") {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {

                return true;
            }    
        }

        return false;       
    }


});
