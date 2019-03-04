$(document).ready(function () {

    //input focus opacity
    $('.home-search #form-general-search .input-text').on('focus', function () {
        $('.home-search #form-general-search').css('z-index', '88890');
        $('.box-input-focus').fadeIn(300);
    });
    $('.header-search .form-global-search .input-text').on('focus', function () {
        $('.header-search .form-global-search').css('z-index', '88890');
        $('.box-input-focus').fadeIn(300);
    });


    $('.box-input-focus').click(function () {
        $(this).fadeOut(300);
        $('.home-search #form-general-search, .header-search .form-global-search').css('z-index', '');
        $('.form-global-search').animate({
            right: '-100%',
        }, 500);
        $('.ico-search-header').removeClass('clicked');
    });




    //menu mobile
    //tap
    $('.btn-menu').on('click', function (e) {
        $('.main-menu').toggle(1000);
    });
    //swipe
    /*$$('body').on('swipeRight', function(ev) {
     ev.preventDefault();	
     $('.main-menu').toggle(500);
     });
     $$('body').on('swipeLeft', function(ev) {
     ev.preventDefault();	
     $('.main-menu').toggle(500);
     });*/
    //close menu
    $('.link-sub').on('click', function (ev) {
        ev.preventDefault();
        var submenu = $(this).data('link');
        $$(this).toggleClass('active');
        $('.sub-item[data-menu="' + submenu + '"]').slideToggle(500);
    });
    //scroll sub menus
    $('.btn-close-menu').on('click', function (ev) {
        $('.main-menu').toggle(1000);
    });

    //images slider embarcacoes
    var mySwiper = new Swiper('.swiper-container', {
        // Optional parameters
        direction: 'horizontal',
        loop: false,
        // If we need pagination
        pagination: '.swiper-pagination',
        paginationClickable: true,
        // Navigation arrows
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    //tabs info embarcacoes
    $('.single-box').on('click', function (ev) {
        ev.preventDefault();
        var tabdescription = $(this).data('tabdescription');
        $$(this).toggleClass('active');
        $('.box-description[data-description="' + tabdescription + '"]').slideToggle(500);
    });

    //btn video embarcacoes
    $('.btn-video').on('click', function (ev) {
        ev.preventDefault();
        var videoid = $$(this).data('link');
        var videohtml = '<iframe width="320" height="240" src="http://www.youtube.com/embed/' + videoid + '?autoplay=1" frameborder="0"></iframe>';
        $('.box-video').append(videohtml);
        $('.box-video').fadeIn(300);
    });
    $('.btn-close-boxvideo').on('click', function (ev) {
        ev.preventDefault();
        $('.box-video').fadeOut(300);
        $('.box-video iframe').remove();
    });

    //btn contato embarcacoes
    $('.single-footer .btn-contato').on('click', function (ev) {
        ev.preventDefault();
        $('.box-contato').fadeIn(300);
    });
    $('.box-contato-embarcacoes .btn-close-boxcontato').on('click', function (ev) {
        ev.preventDefault();
        $('.box-contato').fadeOut(300);
    });

    //btn share embarcacoes
    $('.single-footer .btn-share').on('click', function (ev) {
        ev.preventDefault();
        $$(this).toggleClass('clicked');

        if ($$(this).hasClass('clicked')) {
            $('.box-share').animate({
                bottom: '72px',
            }, 500);
        } else {
            $('.box-share').animate({
                bottom: '-55px',
            }, 500);
        }
    });

    //btn slide top
    $('.btn-slide-top').on('click', function () {
        $('html, body').animate({
            scrollTop: $('body').offset().top
        }, 1000);
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

    //favoritar embarcacao
    // obter o valor do campo hidden que indica se o usuario ja favoritou ou nao
    // a embarcação
    var flgFavoritou = $("#flgFavoritou").val();

    // indica que ja favoritou
    if (flgFavoritou == '1') {
        $("#add-favoritos").addClass('favoritado');
    }

    // deseja favoritar embarcação
    $("#add-favoritos").on('click', function (e) {

        e.preventDefault();

        // ver se usuario clicou em favoritar e não está logado
        var isGuest = $("#isGuest").val();

        if (isGuest == 0) {
            // redirecionar
            location.href = Yii.app.createUrl('site/login?url_favorito=' + location.href);
            return false;
        }

        // obter id da embarcacao
        var id_embarcacao = $("#idEmbarcacao").val();

        // vai desfavoritar
        if ($(this).hasClass('favoritado')) {

            // ajax desfavoritar
            $.ajax({
                url: Yii.app.createUrl('embarcacoes/desfavoritarEmbarcacao'),
                data: {id_embarcacao: id_embarcacao},
                type: 'POST',
                success: function (resp) {
                    $("#add-favoritos").removeClass('favoritado');

                },
                error: function (xhz, z, err) {

                }
            });
        }

        // favoritar
        else {
            // ajax favoritar
            $.ajax({
                url: Yii.app.createUrl('embarcacoes/favoritarEmbarcacao'),
                data: {id_embarcacao: id_embarcacao},
                type: 'POST',
                success: function (resp) {

                    $("#add-favoritos").addClass('favoritado');

                },
                error: function (xhz, z, err) {
                }
            });
        }

    });

    // ver se esta voltando de um login para favoritar a embarc
    getUrlParameter('url_favorito');

    function getUrlParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        var flgAchouParam = false;
        var parametro = '';
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                $("#add-favoritos").trigger("click");
            }
        }
    }

    //btn show filters
    $('.results-filters .filter-btn').on('click', function (ev) {
        ev.preventDefault();
        $('.box-filters').fadeIn(300);
    });
    $('.box-filters .header-box .btn-close-box').on('click', function (ev) {
        ev.preventDefault();
        $('.box-filters').fadeOut(300);
        $('.slider-filter').slideDown();
        $('.box-filters .filter-select-tipo').slideDown();
    });


    //slider filter pes
    var slider_pes = $('#slider-peh');
    slider_pes.noUiSlider({
        start: [0, 200],
        //behaviour: 'drag',
        //connect: true,
        range: {
            'min': 0,
            'max': 200
        }
    });
    slider_pes.Link('lower').to($('#peh-value-lower'));
    slider_pes.Link('upper').to($('#peh-value-upper'));

    //slider filter price
    var slider_price = $('#slider-price');
    slider_price.noUiSlider({
        start: [0, 200000],
        //behaviour: 'drag',
        connect: true,
        range: {
            'min': 0,
            'max': 200000
        }
    });
    slider_price.Link('lower').to($('#price-value-lower'));
    slider_price.Link('upper').to($('#price-value-upper'));

    //filter checkbox price
    $('.results-filters .content-checkbox').on('click', function () {

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $('.results-filters .content-checkbox').removeClass('active');
            $(this).addClass('active');
        }
        
        // adicionar valor de ordem ao filtro de busca
        var ordem = $(this).data("ordem");
        $("#ordem").val(ordem);
        $("#btn-busca").trigger("click");

    });

    //select modelo change
    $('.box-filters .select-filter #select-modelo').on('change', function() {
        $('.slider-filter').slideUp();
        $('.box-filters .filter-select-tipo').slideUp();
    });

    

    $("#btn-busca").on("click", function (e) {

        // pes min e pes max
        var slider_peh = $("#slider-peh").val();
        var slider_peh_string = String(slider_peh);
        var slider_peh_split = slider_peh_string.split(",");
        var pes_min = slider_peh_split[0];
        var pes_max = slider_peh_split[1];
        $("#pes-min").val(pes_min);
        $("#pes-max").val(pes_max);

        // preco min e preco max
        var slider_price = $("#slider-price").val();
        var slider_price_string = String(slider_price);
        var slider_price_split = slider_price_string.split(",");
        var preco_min = slider_price_split[0];
        var preco_max = slider_price_split[1];
        $("#preco-min").val(preco_min);
        $("#preco-max").val(preco_max);

        $("#form-search").submit();

    });


    // offset
    var offsetEmbarcacoes = 1;

    //btn ver mais listagem embarcacoes
    $(".div-btn-carregar-list").on("click", "#carregar-list", function (e) {


        e.preventDefault();

        $('.preloader').fadeIn(300);

        $limit = $(this).data("limit");

        data = {};
        data['macro'] = $(this).data("macro");
        data['condicao'] = $(this).data("condicao");
        data['fabricante'] = $(this).data("fabricante");
        data['preco-min'] = $(this).data("preco-min");
        data['preco-max'] = $(this).data("preco-max");
        data['pes-min'] = $(this).data("pes-min");
        data['pes-max'] = $(this).data("pes-max");
        data['page'] = offsetEmbarcacoes;
        data['local'] = $(this).data("local");
        data['buscando'] = $(this).data("buscando");
        data['tipos'] = $(this).data("tipos");
        data['ordem'] = $(this).data("ordem");
        data['ajax'] = true;

        //console.log(data);

        $.ajax({
            url: Yii.app.createUrl('embarcacoes/busca'),
            data: data,
            type: 'GET',
            success: function (resp) {

                json = JSON.parse(resp.trim());
                //console.log(json);

                if (json.count > 0) {

                    $(".list-results").append(json.html);

                    // incrementar page
                    offsetEmbarcacoes++;

                    // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                    if (json.count < $limit) {
                        $(".div-btn-carregar-list").empty();
                    }

                } else {
                    $(".div-btn-carregar-list").empty();
                }

                $('.preloader').fadeOut(300);

            },
            error: function (x, h, err) {
                alert('Ocorreu um erro inesperado! Tente novamente');
            }
        });
    });

    //carregar mais listagem empresas
    // offset
    var offsetEmpresas = 1;
    $(".btn-carregar-empresas").on("click", function (e) {
        e.preventDefault();

        $('.preloader').fadeIn(300);

        $limit = $(this).data("limit");

        data = {};
        data['page'] = offsetEmpresas;
        data['ajax'] = true;

        var tipo = $(this).data('tipo');

        var url = Yii.app.createUrl('empresas/EstaleirosIndex');
        if (tipo == 'empresa') {
            url = Yii.app.createUrl('empresas/Empresas');
        }

        $.ajax({
            url: url,
            data: data,
            type: 'GET',
            success: function (resp) {

                json = JSON.parse(resp.trim());

                if (json.count > 0) {

                    $(".results-empresas .container").append(json.html);

                    // incrementar page
                    offsetEmpresas++;

                    // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                    if (json.count < $limit) {
                        $(".div-botao-carregar-esta").empty();
                    }

                } else {
                    $(".div-botao-carregar-esta").empty();
                }

                $('.preloader').fadeOut(300);

            },
            error: function (x, h, err) {
                alert('Ocorreu um erro inesperado! Tente novamente');
            }
        });

    });

    //carregar mais listagem empresas
    // offset
    var offsetMaisDesteAnunciante = 1;

    $("#btn-carregarmais-anunciante").on("click", function (e) {
        e.preventDefault();

        $limit = $(this).data("limit");

        $('.preloader').fadeIn(300);

        data = {};
        data['page'] = offsetMaisDesteAnunciante;
        data['usuarios_id'] = $("#idUsuarioDonoEmbarc").val();
        data['embarcacoes_id'] = $("#idEmbarcacao").val();

        $.ajax({
            url: Yii.app.createUrl('embarcacoes/maisDesseAnunciante_mobile'),
            data: data,
            type: 'GET',
            success: function (resp) {


                json = JSON.parse(resp.trim());

                if (json.count > 0) {

                    $("#div-maisdesse-anunciante").append(json.html);

                    // incrementar page
                    offsetMaisDesteAnunciante++;

                    // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                    if (json.count < $limit) {

                        $("#btn-carregarmais-anunciante").hide();
                    }

                } else {
                    $("#btn-carregarmais-anunciante").hide();
                }

                $('.preloader').fadeOut(300);

            },
            error: function (x, h, err) {
                alert('Ocorreu um erro inesperado! Tente novamente');
            }
        });

    });

    //icon search header 
    $('.ico-search-header').on('click', function (ev) {

        $$(this).toggleClass('clicked');

        if ($$(this).hasClass('clicked')) {
            $('.form-global-search').animate({
                right: '0px',
            }, 500);

            $('.box-input-focus').fadeIn(300);
            $('.header-search .form-global-search').css('z-index', '88890');


        } else {
            $('.form-global-search').animate({
                right: '-100%',
            }, 500);
        }
    });

    //select header filters
    $$('.header-filters select').on('change', function () {
        $$('.second-box .input-submit').trigger('click');
    });


    //box actions single empresa
    $('.box-actions .action-email').on('click', function (ev) {
        ev.preventDefault();
        $('.box-contato').fadeIn(300);
    });
    $('.box-contato-empresa .btn-close-boxcontato').on('click', function (ev) {
        ev.preventDefault();
        $('.box-contato').fadeOut(300);
    });

    //tabs single estaleiros
    $('.tabs-estaleiro .tab .link-tab').on('click', function (ev) {
        ev.preventDefault();
        $('.tabs-estaleiro .tab .link-tab').removeClass('active');
        $(this).addClass('active');
        var datatab = $(this).data('tab');
        $('.more-infos .tab-slide').slideUp(500);
        $('.more-infos .tab-slide[data-tab="' + datatab + '"]').slideDown(500);
    });

    //box actions single estaleiro
    $('.box-contato-estaleiro .btn-close-boxcontato').on('click', function (ev) {
        ev.preventDefault();
        $('.box-contato').fadeIn(300);
    });

    //link contato home
    $('.link-home-contato').on('click', function (ev) {
        //ev.preventDefault();
        $('.box-contato-home').fadeIn(300);
    });
    $('.box-contato-home .btn-close-boxcontato').on('click', function (ev) {
        ev.preventDefault();
        $('.box-contato-home').fadeOut(500);
    });

    //btn close box contato sucess
    $('.box-contato-sucess .btn-ok').on('click', function (ev) {
        $('.box-contato-sucess').fadeOut(300);
    });


    //box esqueceu senha
    $('#esqeceu-senha').on('click', function (e) {
        $('.box-lostpassword').fadeIn(300);
    });
    $('.box-lostpassword .btn-close-boxlostpassword, .box-lostpassword .btn-ok-closelostpassword').on('click', function (e) {
        $('.box-lostpassword').fadeOut(300);
    });
    $("#btn-enviar-email-esqeceu-senha").on("click", function (e) {

        e.preventDefault();

        var email = $("#esqeceu-senha-email").val();

        if (!email || !validateEmail(email)) {
            $('#erro-mail-lostpassword').text('E-mail inválido!');
        }

        // email ok
        else {

            $.ajax({
                url: Yii.app.createUrl('site/esqeceuSenha'),
                data: {
                    email: email
                },
                type: 'post',
                success: function (resp) {

                    // ok
                    if (resp.trim() != '-1') {
                        $('.box-lostpassword #btn-enviar-email-esqeceu-senha, .box-lostpassword #esqeceu-senha-email').hide();
                        $('.box-lostpassword .btn-ok-closelostpassword').show();
                        $('.box-lostpassword .text-msg').text('E-mail enviado com sucesso');
                    }

                    // erro
                    else {
                        $('#erro-mail-lostpassword').text('Ocorreu um erro, tente novamente');
                    }

                },
                // erro
                error: function (x, h, z) {

                }
            });
        }

    });



    // form de contato de envio de email em /institucional
    $("#btn-contato-home").on("click", function (e) {
        e.preventDefault();

        var nome = $("#nome").val();
        var email = $("#email").val();
        var telefone = $("#telefone").val();
        var mensagem = $("#mensagem").val();

        var flgok = true;

        if (nome == '' || email == '' || mensagem == '' || telefone == '') {

            $("#erro-contato-home").text("Insira os campos necessários!");
            flgok = false;
        }


        else {

            if (!validateEmail(email)) {

                flgok = false;
            }

            if (flgok) {

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

                            $("#erro-contato-home").text("E-mail enviado com sucesso!");
                            // limpar campos
                            $("#nome").val("");
                            $("#email").val("");
                            $("#telefone").val("");
                            $("#mensagem").val("");
                        }

                        else {

                            $("#erro-contato-home").text("Erro ao enviar a mensagem.");
                        }
                    },
                    error: function (x, h, err) {
                        $("#erro-contato-home").text("Erro ao enviar a mensagem.");

                    }
                });
            }
        }
    });

    // contato empresa
    $("#btn-contato-empresa").on("click", function (e) {

        var flgok = true;

        e.preventDefault();

        var tipo = $("#tipo").val();
        var nome = $("#nome-contato-anunciante").val();
        var email_remetente = $("#email-contato-anunciante").val();
        var telefone = $("#telefone-contato-anunciante").val();
        var mensagem = $("#mensagem-contato-anunciante").val();


        if (nome == '' || email_remetente == '' || mensagem == '') {
            flgok = false;
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

//form envio contato embarcacoes
    $("#btn-contato-anunciante").on("touchstart", function (e) {
        e.preventDefault();

        // pega o tipo da mensagem no campo hidden (E - empresa/estaleiro, X - anuncio)
        //var tipo = $("#tipo").val();

        var nome = $("#nome-contato-anunciante").val();
        var email_remetente = $("#email-contato-anunciante").val();
        //var telefone = $("#telefone-contato-anunciante").val();
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
                $('.preloader').fadeIn(300);

                // url de resp de anuncio
                var url = Yii.app.createUrl('contatos/mailAnunciante');

                // se for do tipo empresa ou estaleiro
                /*if(tipo == 'E') {
                 url = Yii.app.createUrl('contatos/contatoEmpresaResposta');
                 }*/

                $.ajax({
                    url: url,
                    data: {
                        nome_rem: nome,
                        email_remetente: email_remetente,
                        //telefone: telefone, 
                        mensagem: mensagem,
                        idUsuarioDonoEmbarc: idUsuarioDonoEmbarc,
                        idEmbarcacao: $("#idEmbarcacao").val(),
                        emailEmbarcacao: $("#emailEmbarcacao").val(),
                        resposta: $("#resposta").val(),
                    },
                    type: 'POST',
                    success: function (resp) {
                        
                         if (resp.trim() == '-3') {
                
                             $("#erro-contato").text("É preciso realizar o login para enviar mensagens.");
                        }

                        else if (resp.trim() == '-5') {
                          
                             $("#erro-contato").text("Não é possível enviar uma mensagem a si mesmo.");
                        }


                        else if (resp.trim() != '-1' && resp.trim() != '-5' && resp.trim() != '-3') {

                            $("#erro-contato").addClass('send-sucess');
                            $("#erro-contato").text("Mensagem enviada com sucesso!");
                            // limpar campos
                            $("#nome-contato-anunciante").val("");
                            $("#email-contato-anunciante").val("");
                            $("#mensagem-contato-anunciante").val("");
                        }

                        else {
                            $("#erro-contato").text("Erro ao enviar a mensagem!");
                        }

                        $('.preloader').fadeOut(300);
                    },
                    error: function (x, h, err) {

                        $("#erro-contato").text("Erro ao enviar a mensagem!");
                    },
                    
                    beforeSend: function() {
                        console.log(this);
                        console.log(nome);
                    }
                    
                 
                });
            }
        }
    });


// ready
});


