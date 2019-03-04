$(document).ready(function() {

	function validateEmail(email) {

		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
	}

	$("#btn-contato-anunciante_principal").on("click", function(e) {

        e.preventDefault();
        //e.stopPropagation();
        e.stopImmediatePropagation();

        

        if(!validateEmail($("#inputEmail").val())) {
            alert("Favor preencher corretamente o e-mail.");
            return false;    
        }
        

        if($("#inputTelefone").val().length < 8) {
            alert("Favor preencher corretamente o número de telefone.");
            return false;
        }




        //$(".preloader").show();
        //$(".preloader").css("z-index", 99999);

        // clicou no botao de enviar principal e selecionou que quer saber mais sobre
        $(".checkbox_partners").each(function() {

            if($(this).is(":checked")) {

                var id_form = $(this).data("form");

                // transferir valores do form de contato principal para o form das abas de partners
                $("#"+id_form).find(".nome").val($("#primeiroNome").val());
                $("#"+id_form).find("input[type='email']").val($("#inputEmail").val());
                $("#"+id_form).find("input[type='tel']").val($("#inputTelefone").val());

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
                    email: $("#inputEmail").val(), user_agent: user_agent
                },
                async: false,
                type: 'post'
            });

        }

        teste();

    }); 

       // clicou em enviar mensagem em detalhe de anuncio ou respondeu resp de anuncio
    function teste() {

        // pega o tipo da mensagem no campo hidden (E - empresa/estaleiro, X - anuncio)
        var tipo = "E";

        var nome = $("#primeiroNome").val();
        var nome_destinatario = $("#nome-contato").val();
        var email_remetente = $("#inputEmail").val();
        var telefone = $("#inputTelefone").val();
        var mensagem = $("#inputMensagem").val();
        //var senha = $("#senha-contato-anunciante").val();
        var j8BSVuvy = $(".j8BSVuvy").val();
        var idUsuarioDonoEmbarc = $("#idUsuarioDonoEmbarc").val();

        var flgok = true;

        if (nome.length == 0 || email_remetente.length == 0 || mensagem.length == 0 || telefone.length == 0) {

            flgok = false;
            alert("Preencha todos os campos!");

        } else {

            if (!validateEmail(email_remetente)) {
                alert("Email inválido!");
                flgok = false;
            }

            if (flgok) {

                //$('.preloader').css("z-index", "9999");

                // url de resp de anuncio
                var url = Yii.app.createUrl('contatos/mailAnunciante');

                $.ajax({
                    url: url,
                    async: false,
                    data: {
                        nome_rem: nome,
                        nome_destinatario: nome_destinatario,
                        email_remetente: email_remetente,
                        //senha: senha,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        idUsuarioDonoEmbarc: idUsuarioDonoEmbarc,
                        idEmbarcacao: $("#idEmbarcacao").val(),
                        emailEmbarcacao: $("#emailEmbarcacao").val(),
                        resposta: 0,
                        partner_trans: ($("#qroTransporte").is(':checked')) ? $("#qroTransporte").val() : 0,
                        partner_finan: ($("#qroFinanciamento").is(':checked')) ? $("#qroFinanciamento").val() : 0,
                        partner_cons: ($("#qroConsorcio").is(':checked')) ? $("#qroConsorcio").val() : 0,
                        partner_marina: ($("#qroMarina").is(':checked')) ? $("#qroMarina").val() : 0,
                        j8BSVuvy: j8BSVuvy
                    },
                    type: 'POST',
                    success: function (resp) {  


                        if(resp.trim() == "1") {
                            alert("Sucesso ao enviar a mensagem");
                            $("#fechaModal").trigger("click");
                        }
                        else {
   
                            alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                        }


                    },
                    error: function (x, h, err) {

                        alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                    }
                });

                // caso tenha escolhido consorcio, finan nios lightbox
                $(".checkbox_partners").each(function() {

                	var id_form = $(this).data("form");

                    if($(this).is(":checked")) {

                        // transferir valores do form de contato principal para o form das abas de partners
                        $("#"+id_form).find(".nome").val($("#primeiroNome").val());
                        $("#"+id_form).find("input[type='email']").val($("#inputEmail").val());
                        $("#"+id_form).find("input[type='tel']").val($("#inputTelefone").val());


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
    }           
});