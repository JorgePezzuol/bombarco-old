$(document).ready(function () {

    var cidade = $("#cidade").val();
    var endereco = $("#endereco").val();
    var numero = $("#numero").val();

    var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
        options = {onKeyPress: function (val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
    };

    $("#telefone-contato-anunciante").mask(maskBehavior, options);


    // setando iframe do google mpas
    $("#iframe-maps").attr("src", "http://maps.google.com/?q=" + endereco + "," + numero + "," + cidade + "&output=embed");

    // mudar thumb para imagem grande
    $(".img-detfab-slide").on("click", function () {

        var src = $(this).attr("src");

        $(".img-detfab-slide-g").attr("src", src);
    });

    // ver telefone
    $('.vertelefone').on("click", function(e) {
        e.preventDefault();

        var usuarios_id = $("#usuarios_id_empresa").val();

        $.ajax({
           url: Yii.app.createUrl('empresas/verTelefone'),
           data: {
               usuarios_id: usuarios_id
           },
           type: 'post',

           success: function(resp) {
              console.log(resp);
           }
        });
    });


    // Função para LightBox Detalhe da Embarcação
    $('#btn-contato-detemba').click(function(e) {
        e.preventDefault();

        $lbox = $('#lbox-detemba');

        $lbox.find(".ev-titleb").text("Envie uma mensagem");
        $lbox.find(".form-nome-ag")
                .show()
                .filter(".senha-contato-anunciante")
                .hide()
                .find("input")
                .val("");

        $lbox.lightbox_me({centered: true,
        onLoad: function() {
          if($(window).width() < 789){
            $('#lbox-detemba').css({"top":$(window).scrollTop() + 40, "marginTop":0})
          }
        }});
    });



    // contabilizar ver telefone
    $('#btn-seguro-detemba').click(function (e) {
        e.preventDefault();

        $.ajax({
            url: Yii.app.createUrl('empresas/vertelefone'),
            type: 'post',
            data: {
                usuarios_id: $("#usuarios_id").val(),
            }
        });

        $('#lbox-detemba2').lightbox_me({centered: true,
        onLoad: function() {
          if($(window).width() < 789){
            $('#lbox-detemba2').addClass("show")
            $(".fechar-form-d, .lb_overlay").click(function(){
              $('#lbox-detemba2').removeClass("show");
            })
          }
        }});
    });

    // entrar em contato
    $("#btn-contato-empresa").on("click", function (e) {
        e.preventDefault();

        var nome = $("#nome-contato-anunciante").val();
        var email_remetente = $("#email-contato-anunciante").val();
        var telefone = $("#telefone-contato-anunciante").val();
        var mensagem = $("#mensagem-contato-anunciante").val();
        var flgEstaleiro = $("#flgEstaleiro").val();
        var senha = $("#senha-contato-anunciante").val();

        var userProperties = {
            nome: nome,
            email: email_remetente,
            telefone: telefone
        }

        var flgok = true;

        if (nome.length == 0 || email_remetente.length == 0 || mensagem.length == 0 || telefone.length == 0) {

            $("#erro-contato").text("Insira os campos necessários!");
            flgok = false;

        } else { // ok

            // validar emails
            if (!validateEmail(email_remetente)) {
                flgok = false;
            }

            // validacao ok, fazer ajax
            if (flgok) {
                $('.preloader').css("z-index", "9999");
                $.ajax({
                    url: Yii.app.createUrl('contatos/contatoEmpresa'),
                    type: 'post',
                    data: {
                        nome_rem: nome,
                        email_rem: email_remetente,
                        senha: senha,
                        telefone_rem: telefone,
                        mensagem: mensagem,
                        email_empresa: $("#email_empresa").val(),
                        nomefantasia: $("#nomefantasia").val(),
                        usuarios_id_dest: $("#usuarios_id").val(),
                        flgEstaleiro: flgEstaleiro
                    },
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

                        if(resp.trim() == '-5') {
                            alert("Não é possível enviar uma mensagem a si mesmo");
                            return false;
                        }

                        if (resp.trim() == '-7') {
                            alert("Senha inválida");
                            return false;
                        }

                        if (resp.trim() == '2') {
                            $("#lbox-msgok").find('span').text("Mensagem enviada com sucesso!");
                            $('#lbox-msgok').lightbox_me({
                                centered: true,
                                onLoad: function() {
                                    $("#lbox-msgok").addClass("show");
                                },
                                onClose: function() {
                                    $("#lbox-msgok").removeClass("show");
                                }
                            });
                            $("#close-form").trigger("click");


                            return false;
                        }

                        //console.log(resp);
                        if (resp.trim() != '-1') {
                            $("#lbox-msgok").find('span').text("Mensagem enviada com sucesso!");
                            $('#lbox-msgok').lightbox_me({
                                centered: true,
                                onLoad: function() {
                                    $("#lbox-msgok").addClass("show");
                                },
                                onClose: function() {
                                    $("#lbox-msgok").removeClass("show");
                                }
                            });
                            $("#close-form").trigger("click");

                        } else {
                            $("#erro-contato").text("Ocorreu um erro inesperado ao enviar o email. Tente mais tarde.");
                        }
                    },
                    error: function (x, h, z) {
                        $("#erro-contato").text("Ocorreu um erro inesperado ao enviar o email. Tente mais tarde.");
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


    // $(".line-det-est-1, .line-detfab-1").on({
    // 	mouseenter: function() {

    // 		$this = $(this);

    // 		timeout = setTimeout(function() {

    // 			$this.stop(true).animate({height:300}, {duration:300, easing:"easeOutQuad"});

    // 		}, 500);

    // 	},

    // 	mouseleave: function() {

    // 		$this = $(this);

    // 		clearTimeout(timeout);
    // 		$this.stop(true).animate({height:150}, {duration:300, easing:"easeOutQuad"});

    // 	}
    // });



    function sleep(milliseconds) {
        var start = new Date().getTime();
        for (var i = 0; i < 1e7; i++) {
            if ((new Date().getTime() - start) > milliseconds) {
                break;
            }
        }
    }


    /* imagens do slider e video */
    $(".imagem-turbinada").on("click", function (e) {
        e.preventDefault();
        $("#imagem-principal").fadeIn("fast");
        var src = $(this).attr("src");
        $("#imagem-principal").attr("src", src);
    });

});
