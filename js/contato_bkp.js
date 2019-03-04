$(document).ready(function () {

    // clicou em enviar mensagem em detalhe de anuncio ou respondeu resp de anuncio
    $("#btn-contato-anunciante").on("click", function (e) {

        e.preventDefault();

        // pega o tipo da mensagem no campo hidden (E - empresa/estaleiro, X - anuncio)
        var tipo = $("#tipo").val();

        var nome = $("#nome-contato-anunciante").val();
        var email_remetente = $("#email-contato-anunciante").val();
        var telefone = $("#telefone-contato-anunciante").val();
        var mensagem = $("#mensagem-contato-anunciante").val();

        var flgok = true;


        var idUsuarioDonoEmbarc = $("#idUsuarioDonoEmbarc").val();

        if (nome == '' || email_remetente == '' || mensagem == '') {
            /*$("#msg-lgbox").text("Erro ao enviar a mensagem");
             $('#lbox-msgok').lightbox_me({
             centered: true, 
             onLoad: function() { 
             
             }
             });*/
            $("#erro-contato").text("Insira os campos necessários!");
            flgok = false;
        }


        else {

            if (!validateEmail(email_remetente)) {
                $("#erro-contato").text("Email inválido!");
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
                    data: {
                        nome_rem: nome,
                        email_remetente: email_remetente,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        idUsuarioDonoEmbarc: idUsuarioDonoEmbarc,
                        idEmbarcacao: $("#idEmbarcacao").val(),
                        emailEmbarcacao: $("#emailEmbarcacao").val(),
                        resposta: $("#resposta").val(),
                    },
                    type: 'POST',
                    success: function (resp) {

                        if (resp.trim() == '-3') {
                            alert("É preciso realizar o login para enviar mensagens.");
                            return false;
                        }

                        if (resp.trim() == '-5') {
                            alert("Não é possível enviar uma mensagem a si mesmo");
                            return false;
                        }

                        if (resp.trim() != '-1') {

                            if ($("#resposta").val() == 0) {
                                lightBoxMsgSucesso("Mensagen eviada com sucesso!");
                                $('#close-form-contato').trigger("click");
                            }

                            else {
                                var nome = $("#nome-contato-anunciante").val();
                                var data = $("#data").val();

                                var mensagem = $("#mensagem-contato-anunciante").val();
                                var div = $('<div class="mensagem-individual-resposta"><span class="resposta-autor"><b>' + nome + '</b> ' + data + '</span><p>' + mensagem + '</p></div>');
                                $("#div-mensagens").prepend(div).trigger("create");
                            }

                        }

                        else {
                            alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                        }
                    },
                    beforeSend: function() {
                        console.log(this);
                        console.log(nome);
                    },
                    error: function (x, h, err) {

                        alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                    }
                });
            }
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



        if (nome == '' || email_remetente == '' || mensagem == '') {
            flgok = false;

            alert("Nome, email ou mensagem não podem ser vazios!");
        }


        else {

            if (!validateEmail(email_remetente)) {
                flgok = false;
            }


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
                            alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                        }
                    },
                    error: function (x, h, err) {

                        alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
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

        var flgok = true;

        if (nome == '' || email == '' || mensagem == '') {

            $("#erro-contato").text("Insira os campos necessários!");
            flgok = false;
        }


        else {

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
                        mensagem: mensagem
                    },
                    type: 'POST',
                    success: function (resp) {

                        if (resp.trim() != '-1') {

                            $(".close").trigger("click");
                            /* Função para Lightbox Msg enviada com sucesso */
                            $('#lbox-msgok').lightbox_me({
                                centered: true,
                                onLoad: function () {

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

        var flgok = true;

        if (nome == '' || email == '' || mensagem == '' || telefone == '') {

            $("#erro-contato").text("Insira os campos necessários!");
            flgok = false;
        }


        else {

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
                        mensagem: mensagem
                    },
                    type: 'POST',
                    success: function (resp) {

                       
                        if (resp.trim() != '-1') {

                            $(".close").trigger("click");
                            /* Função para Lightbox Msg enviada com sucesso */
                            $('#lbox-msgok').lightbox_me({
                                centered: true,
                                onLoad: function () {

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





    function validateEmail(email) {

        if (!email)
            return false;

        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if (!emailReg.test(email)) {
            return false;
        } else {
            return true;
        }
    }

});