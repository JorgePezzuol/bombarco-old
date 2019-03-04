$(document).ready(function(){

    if(location.href.indexOf("#") != -1) {
        location.href = "http://www.bombarco.com.br/tabela";
        return false;
    }

    

    var url = window.location.href;
    var parametros = url.split('tabela').pop().trim();

    if(url.indexOf("comunidade/tabela-bombarco") == -1) {

        if(parametros != "") {

            var params_split = parametros.split('/');
            /*if(params_split[2] != "") {
                params_split[2] = params_split[2].replace(params_split[1]+"-", "");
            }*/
            // [1] -> marca
            // [2] -> modelo
            // [3] -> ano

            //$("#fabricante").val(params_split[1]).trigger("change");
            //$("#modelo-embarcacao").val(params_split[2]).trigger("change");
            //$("#ano").val(params_split[3]).trigger("change");

            $.ajax({
                url: Yii.app.createUrl('tabelaEmbarcacoes/busca'),
                data: {
                    marca: params_split[1],
                    modelo: params_split[2],
                    ano: params_split[3]
                },
                type: 'GET',

                success: function(resp) {

                    json = JSON.parse(resp.trim());

                    var limit = $('#carregar-list').data('limit');

                    if(json.qnt_results == 0) {
                        $("#titulo-resultados").text("Nenhum resultado encontrado");
                    }
                    else {
                        $("#titulo-resultados").text("Resultados da Tabela");
                    }

                    // seta html da div que contém o resultado da busca da tabela bombarco
                    $('.line-tabela-2').css('display','inline').find(".section-result-ajax").html(json.embarcacoes);

                    // seta html da div que contém o resultado da busca de anuncios
                    if(json.anuncios == "") {
                        $("#titulo-resultados-anuncios").css("display", "none");
                        $("#ver-mais").css("display", "none");
                        $("#anuncios-tabela").hide();
                    } else {
                        $("#anuncios-tabela").show();
                        $("#titulo-resultados-anuncios").fadeIn("fast");
                        if (json.qnt_anuncios > limit)
                            $("#ver-mais").fadeIn("fast");
                    }
                    $('.line-tabela-2').css('display','inline').find(".section-result-ajax-anuncios").html(json.anuncios);



                //  var p = $('<p>A Tabela de Preço Bombarco é uma tabela não oficial, somente mostra a média de preços de embarcações que já foram anunciadas no Bombarco, servindo apenas para consulta. Os preços efetivamente praticados são decididos pelos seus proprietários e variam em função de diversos situações como: região, conservação, cor, acessórios, motor, ano, etc. </p>');
                    // seta html da div que contém o resultado da busca da tabela bombarco
                //  $('#resultado-tabela').append(p).trigger('create');
                    $('html, body').animate({ scrollTop: $(".box-tabela-principal").offset().top }, 'slow');

                },
                error: function(x, h, err) {
                    alert('Ocorreu um erro inesperado! Tente novamente');
                }
            });
        }
    }

    $("#form-search").on("submit", function(e) {
        e.preventDefault();

        var fabricante = $("#fabricante").val();
        //var modelo = fabricante+"-"+$("#modelo-embarcacao").val();
        var modelo = $("#modelo-embarcacao").val();
        var ano = $("#ano").val();

        // se ñ escolher fabricante, não busca
        if($("#fabricante").val() == "")
            return false;

        // se não estiver logado, devemos capturar o lead
        // 1 - não está logado // 0 - está logado
        var isGuest = $("#isGuest").val();

        // não está logado
        if(isGuest == 1) {

            // se ñ estiver logado, vamos redirecionar para página de login]
            // passando as informações já selecionadas
            var url = '';
            if(fabricante != undefined && fabricante != "") {
                url += '&fabricante='+fabricante;
            }
            if(modelo != undefined && modelo != "") {
                url += "&modelo="+modelo;
            }
            if(ano != 0 && ano != undefined && ano != "") {
                url += "&ano="+ano;
            }

            location.href = Yii.app.createUrl('site/login?tabela_bb=login'+url);
            return false;
        }

        var url = "/"+fabricante;
        if($("#modelo-embarcacao").val() != "") {
            url += "/"+modelo;
        }
        if(ano != "") {
            url += "/"+ano;
        }

        location.href = Yii.app.createUrl("tabela") + url;
    });

    


    /* mascara telefone */
    var maskBehavior = function (val) {
     return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options = {onKeyPress: function(val, e, field, options) {
     field.mask(maskBehavior.apply({}, arguments), options);
     }
    };
    $("#telefone").mask(maskBehavior, options);


    // selecionou jetski / lancha / veleiro
    $('.tab').on("click", function() {

        // 1 - jetski // 2 - lancha / 3 - veleiro / 4 - Pesca
        var embarcacao_macros_id = $(this).data("macro");

        // campo hidden que tem a macro
        $("#macro").val(embarcacao_macros_id);

        // ajax carregar fabricantes
        $.ajax({

                url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoesTabela'),
                data: {embarcacao_macros_id: embarcacao_macros_id},
                type: "POST",

                success: function(resp) {

                    if(resp != -1) {

                        $("#fabricante").empty();
                        $("#fabricante").append("<option selected='selected' value=''>Marca</option>").trigger('create');

                        $("#ano").empty();
                        $("#ano").append("<option selected='selected' value=''>Ano</option>").trigger('create');

                        $("#modelo-embarcacao").empty();
                        $("#modelo-embarcacao").append("<option selected='selected' value=''>Modelo</option>").trigger('create');

                        var fabricantes = JSON.parse(resp.trim());
                        //var fabricantes = JSON.parse(resp);

                        for(var i =0; i < fabricantes.length; i++) {
                            
                            var option = $('<option value="'+fabricantes[i].slug+'">'+fabricantes[i].titulo+'</option>');
                            $("#fabricante").append(option).trigger("create");
                        }

                        // habilitar select e checkbox do fabricante
                        $("#fabricante").prop("disabled", false);
                    }
                },

                error: function(x, r, msg) {
                    alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                }
            });
    });

    $("#fabricante").on("change", function() {

        var embarcacao_fabricantes_slug = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadModelosEmbarcacoesTabelaSlug'),
            data: {embarcacao_fabricantes_slug: embarcacao_fabricantes_slug},
            type: 'POST',

            success: function(response) {

                $("#modelo-embarcacao").html("");

                //console.log(response);

                if(response != "-1") {

                    //var modelos = JSON.parse(response.trim());
                    var modelos = JSON.parse(response.trim());

                    $("#modelo-embarcacao").append('<option selected="selected" value="">Modelo</option>').trigger('create');

                    if(modelos.length > 0) {

                        for(var i =0; i < modelos.length; i++) {
                            var option = $('<option value="'+modelos[i].slug+'">'+modelos[i].titulo+'</option>');
                            $("#modelo-embarcacao").append(option).trigger("create");
                        }
                    }

                    else {

                        var option = $('<option value="0">Não Informado</option>');
                        $("#modelo-embarcacao").append(option).trigger("create");
                    }

                }
            },

            error: function(x, h, z) {
                alert("Ocorreu um erro inesperado. Favor contate o admin do site.");
            }

        });
    });

    $("#modelo-embarcacao").on("change", function() {

        // fazer ajax para obter os anos a partir do fabricante e modelo
        $.ajax({
            url: Yii.app.createUrl('tabelaEmbarcacoes/obterAno'),
            data: {
                embarcacao_modelos_slug: $("#modelo-embarcacao").val(),
                embarcacao_fabricantes_slug: $("#fabricante").val()
            },
            type: 'post',

            success: function(resp) {

                var anos = JSON.parse(resp.trim());

                if(anos.length > 0) {

                    $("#ano").html("");
                    var option = $('<option value="">Ano</option>');
                    $("#ano").append(option).trigger("create");

                    for(var i = 0; i < anos.length; i++) {
                        option = $('<option value="'+anos[i]+'">'+anos[i]+'</option>');
                        $("#ano").append(option).trigger("create");
                    }
                }


            },

            error: function(x, h, z) {
                alert("Ocorreu um erro inesperado. Favor contate o admin do site.");
            }
        });
    });

    /**
     * AJAX que carrega Modelos a partir de Fabricantes
     * @return {[type]} [description]
     */
    $('#form-search .select-tabela1').on('click', '.slimScrollDiv li', function() {
        value = $(this).data('value');
        ajaxecute(Yii.app.createUrl('utils/DropDownModelos'), value, "modelo", "select-tabela2", "#form-search .select-tabela2", "Modelo");
    });


    /**
     * AJAX que carrega os anos a partir do modelo
     * @return {[type]} [description]
     */
    $('#form-search .select-tabela2').on('click', '.slimScrollDiv li', function() {

        value = $(this).data('value');
        ajaxecute(Yii.app.createUrl('TabelaEmbarcacoes/LoadYearByModel'), value, "ano", "select-tabela3", "#form-search .select-tabela3", "Ano");
    });


    /*Função para a Pagina Tabela*/
    /*$("#btn-buscar-tab").click(function(e) {
        $('.line-tabela-2').css('display','inline');
              e.preventDefault();
        });
    $('#btn-buscar-tab').click(function(){
        $('html, body').animate({scrollTop:791}, 'slow');
             return false;
     });*/
    /*Fim*/

    /* Pega o email do cliente e faz uma requisição ajax para criar o usuário e enviar email */
    $("#btn-lead").on("click", function(e) {
        e.preventDefault();

        var email = $("#email-lead").val();

        // validar email
        if(validateEmail(email)) {
            $('.preloader').css("z-index", "100000");
            $('.preloader').css("position", "relative");
            $('#lbox-msgok').css("z-index", "100000");
            $('#lbox-msgok').css("position", "relative");
            // ajax
            $.ajax({
                url: Yii.app.createUrl('contatos/contatoTabelaBombarcoBusca'),
                data: {
                    email: email
                },
                type: 'post',

                success: function(resp) {

                    // ok
                    if(resp != '-1') {

                        // indicar que há alguem logado
                        $("#isGuest").val(0);

                        // fechar lightbox
                        $('#lbox-lead').trigger('close');

                        // submeter form de busca
                        $("#form-search").submit();
                    }

                    // erro ajax
                    else {
                        alert("Ocorreu um erro inesperado. Tente mais tarde!");
                    }


                },

                error:function(x, h, z) {
                    alert("Ocorreu um erro inesperado. Tente mais tarde!");
                }
            });
        }
    });


    

// offset
    var page = 1;

    $(".div-btn-carregar-list").on("click", "#carregar-list", function(e) {

            e.preventDefault();

            $limit = $(this).data("limit");

            var macro = $("#macro").val();
            var fabricante = $("#fabricante").val();
            var modelo = $("#modelo-embarcacao").val();

            data = {};
            data['macro'] = macro;
            data['fabricante'] = fabricante;
            data['modelo'] = modelo;
            data['page'] = page;
            data['ajax'] = true;

            //console.log(data);

            $.ajax({
                url: Yii.app.createUrl('tabelaEmbarcacoes/carregarMaisAnunciosTabela'),
                data: data,
                type: 'GET',

                success: function(resp) {

                    json = JSON.parse(resp.trim());
                    //console.log(json.html);

                    if (json.count > 0) {

                        //$(".categories-tabela").append(json.html);
                        $(".section-result-ajax-anuncios").append(json.html);

                        // incrementar page
                        page++;

                        // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                        if (json.count < $limit)
                            $(".div-btn-carregar-list").empty();

                    } else {
                        $(".div-btn-carregar-list").empty();
                    }

                },

                error: function(x, h, err) {
                    alert('Ocorreu um erro inesperado! Tente novamente');
                }
            });
    });


    // lightbox n encontrou barco tabela
    $('#btn-naoenc-tabela').click(function(e) {
        e.preventDefault();
        $('#lbox-tab').lightbox_me({
            centered: true,
            onLoad: function() {
                  if($(window).width() < 789){
                    $('#lbox-tab').css({"top":$(window).scrollTop() + 40, "marginTop":0})
                  }
                }
            });
        e.preventDefault();
    });

    // enviou pedido de embarcação n encontrada na tabela
    $("#form_tabela").on("submit", function(e) {
        e.preventDefault();

        // dados do post
        var nome = $("#nome").val();
        var email = $("#email-tab").val();
        var telefone = $("#telefone").val();
        var descricao = $("#descricao").val();

        if (nome == null || nome.length == 0) {
            alert('Preencha o Nome');
            return;
        };

        if (telefone == null || telefone.length == 0) {
            alert('Preencha o Telefone');
            return;
        };

        if (email == null || email.length == 0) {
            alert('Preencha o E-mail');
            return;
        };

        if (descricao == null || descricao.length == 0) {
            alert('Preencha a Descrição');
            return;
        };

        // ajax enviar emails
        $('.preloader').css("z-index", "99999");
        $.ajax({
            url: Yii.app.createUrl('contatos/contatoTabelaBombarcoNaoEncontrou'),
            data: {
                nome: nome,
                email: email,
                telefone: telefone,
                descricao: descricao
            },
            type: 'post',

            success: function(resp) {

                if(resp != '-1') {

                    // lightbox msg enviada ok
                    $("#lbox-msgok").lightbox_me({
                        centered: true,
                    });

                    $('.fechar-form').trigger('click');

                } else {
                    alert("Ocorreu um erro ao enviar o contato. Tente novamente mais tarde.");
                }
            },

            error: function( x, h, z) {
                alert("Ocorreu um erro inesperado. Tente mais tarde");
            }
        });
    });


    

    /*$.ajax({
        url: Yii.app.createUrl('comunidade/tabela-bombarco'),
        data: data,
        type: 'GET',

        success: function(resp) {

            json = JSON.parse(resp);
            //console.log(json);

            if (json.count > 0) {

                $("ul.categories-nt").append(json.html);

                // incrementar page
                page++;

                // Se o resultado for menor que o limite, então apaga o botão de carregar mais
                if (json.count < $limit) {
                    $(".div-btn-carregar-guia-nt").empty();
                }

            } else {
                $(".div-btn-carregar-guia-nt").empty();
            }

        },

        error: function(x, h, err) {
            alert('Ocorreu um erro inesperado! Tente novamente');
        }
    });*/

});
