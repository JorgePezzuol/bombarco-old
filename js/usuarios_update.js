$(document).ready(function () {

    $("#link-perfil").addClass("active");

    // contador plano gratuiot
    if($("#defaultCountdown").length) {

            var dia = $("#defaultCountdown").data("dia");
            var mes = $("#defaultCountdown").data("mes");
            var ano = $("#defaultCountdown").data("ano");

            //console.log(dia+"/"+mes+"/"+ano);

            $.countdown.regionalOptions['pt-BR'] = {
                labels: ['Anos', 'Meses', 'Semanas', 'Dias', 'Horas', 'Minutos', 'Segundos'],
                labels1: ['Ano', 'Mês', 'Semana', 'Dia', 'Hora', 'Minuto', 'Segundo'],
                compactLabels: ['a', 'm', 's', 'd'],
                whichLabels: null,
                digits: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'],
                timeSeparator: ':', isRTL: false
            };

            $.countdown.setDefaults($.countdown.regionalOptions['pt-BR']);

            $('#defaultCountdown').countdown({until: new Date(ano, mes-1, dia), format: 'DHMS'});     

    }
    

    // quando clica no ok do lightbox, ele soma e da reload na pagina
    $("#ok-lightbox-sucesso").on("click", function (e) {
        e.preventDefault();
        location.reload();
    });


    $("#Usuarios_cidades_id").addClass('info-input');

    // using jQuery Mask Plugin v1.7.5
    // http://jsfiddle.net/d29m6enx/2/
    var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            options = {onKeyPress: function (val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };

    $("#Usuarios_cpf").mask("999.999.999-99");
    $("#Usuarios_telefone").mask("(99) 9999-9999");
    $("#Usuarios_cnpj").mask('99.999.999/9999-99');

    $("#celular").mask(maskBehavior, options);
    $("#Usuarios_data_nascimento").mask("99/99/9999");

    /* alterar dados pessoais - pessoa fisica */
    $("#alterar-dados-pf").on("click", function (e) {
        e.preventDefault();

        $("#campos-pf-travado").fadeOut("fast");
        $("#campos-pf-liberado").fadeIn("fast");

    });

    /* alterar dados pessoais - pessoa jurídica */
    $("#alterar-dados-pj").on("click", function (e) {
        e.preventDefault();

        $("#campos-pj-travado").fadeOut("fast");
        $("#campos-pj-liberado").fadeIn("fast");

    });

    $("#atualizar-dados-pessoais").on("click", function (e) {
        e.preventDefault();

        if($("#Usuarios_cpf").val() == "") {
            $("#Usuarios_cpf").css("border-color", "red");
            return false;
        }

        var id = $("#idUsuario").val();

        $.ajax({
            url: Yii.app.createUrl('usuarios/atualizarDadosPessoais/' + id),
            type: 'post',
            data: $("#form-atualizar-dados").serialize(),
            success: function (resp) {

                if (resp.trim() != '1') {
                    alert("Ocorreu um erro inesperado. Tente mais tarde");
                }
                else {

                    $("#campos-pf-liberado").fadeOut("fast");
                    $("#campos-pf-travado").fadeIn("fast");
                    lightBoxMsgSucesso("Dados alterados com sucesso");

                }
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Tente mais tarde");
            }
        });

    });

    // ajax preencher cidades a partir do estado
    $("#Usuarios_estados_id").on("change", function () {

        var estado_id = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadCities2'),
            type: 'post',
            data: {estados_id: estado_id},
            success: function (resp) {

                $("#Usuarios_cidades_id").empty();
                var selectDefault = $('<option selected="selected" value="">selecione</option>');
                $("#Usuarios_cidades_id").append(selectDefault).trigger("create");
                var cidades = JSON.parse(resp.trim());

                for (var i = 0; i < cidades.length; i++) {

                    var option = $('<option value="' + cidades[i].id + '">' + cidades[i].nome + '</option>');
                    $("#Usuarios_cidades_id").append(option).trigger("create");
                }
            },
            error: function (x, h, z) {

            }
        });
    });

    /* fim alterar dados pessoais */


    /* alterar senha */
    $("#alterar-senha").on("click", function (e) {
        e.preventDefault();

        $("#div-senha-antiga").fadeOut("fast");
        $("#alterar-senha").fadeOut("fast");
        $("#inputs-senha").fadeIn("fast");

    });

    $("#atualizar-senha").on("click", function (e) {

        e.preventDefault();

        var senha = $("#senha").val();
        var confirmaSenha = $("#confirmaSenha").val();
        var idUsuario = $("#idUsuario").val();

        $.ajax({
            url: Yii.app.createUrl('usuarios/alterarSenha/' + idUsuario),
            type: 'post',
            data: {
                senha: senha,
                confirmaSenha: confirmaSenha
            },
            beforeSend: function () {

                if (!senha && !confirmaSenha) {
                    alert("Favor preencha os campos para alterar a senha");
                    return false;
                }

                if (senha != confirmaSenha) {
                    alert("Senhas não batem!");
                    return false;
                }
            },
            success: function (resp) {

                if (resp.trim() == '1') {

                    lightBoxMsgSucesso("Senha alterada com sucesso");
                    $("#inputs-senha").fadeOut("fast");
                    $("#div-senha-antiga").fadeIn("fast");
                }

                else {
                    alert("Ocorreu um erro inesperado. Tente mais tarde");
                }

            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Tente mais tarde");
            }
        });
    });
    /* fim alterar senha */


    /* update logo */

    $("#logo-img").on("click", function () {
        $("#logo-file").trigger("click");
    });

    $('#logo-file').on("change", function () {

        var nome = $(this)[0].files[0].name;

        var fd = new FormData();
        fd.append("logo", $(this)[0].files[0]);

        $.ajax({
            url: Yii.app.createUrl('usuarios/alterarLogo'),
            type: 'POST',
            cache: false,
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {


                if (resp.trim() == "-1") {
                   alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
                }

                else {

                    $("#logoimagem").attr("src", Yii.app.createUrl('public/usuarios/' + resp.trim()));

                }


            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
            }
        });
    });

    $("#remover-logo").on("click", function () {


        $.ajax({
            url: Yii.app.createUrl('usuarios/alterarLogo'),
            type: 'post',
            data: {
                excluirlogo: 1
            },
            success: function (resp) {

                //location.reload();
                $("#logoimagem").attr("src", Yii.app.createUrl('public/usuarios/addfoto.png'));
                $("#remover-logo").hide();

            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
            }
        });
    });

    /* fim update logo */
    $("#select-renovar-plano").on("change", function () {

        if ($(this).val() != "") {
            var planoSelecionado = $(this).find(':selected').data('descricaoplano');

            $("#descricao-novo-plano").text(planoSelecionado);
        }

        else {
            $("#descricao-novo-plano").text("");
        }
    });

    $("#btn-renovar-plano").on("click", function (e) {
        e.preventDefault();

        if ($("#descricao-novo-plano").text() == "") {

            $("#descricao-novo-plano").text("Selecione um novo plano!");
            $("#descricao-novo-plano").css("color", "red");
        }

        else {
            var planoUsuariosId = $("#id-plano-atual").val();
            var planoRenovadoId = $("#select-renovar-plano").val();

            var href = Yii.app.createUrl('planoUsuarios/renovarPlano', {id_plano_usuarios_atual: planoUsuariosId, id_plano_renovado: planoRenovadoId});

            location.href = href;
        }

    });

    $("#renovar-plano-grats").on("click", function(e) {
        e.preventDefault();
        
    });

    /* fim renovar plano */

    /* consultar cep a partir do endereço */

    /* Executa a requisição quando o campo CEP perder o foco */
    $('#Usuarios_cep').blur(function () {

        /* Configura a requisição AJAX */
        $.ajax({
            url: Yii.app.createUrl('anuncios/consultarCep'), /* URL que será chamada */
            type: 'POST', /* Tipo da requisição */

            //data: 'cep=' + $('#Empresas_cep').val(), /* dado que será enviado via POST */
            data: {cep: $("#Usuarios_cep").val()},
            dataType: 'json', /* Tipo de transmissão */
            success: function (data) {

                if (data.sucesso == 1) {

                    $('#Usuarios_endereco').val(data.rua);
                    $('#Usuarios_bairro').val(data.bairro);
                    $('#Usuarios_numero').focus();
                }
            }
        });

    });

    // aba de renovar 
    $(".aba-renovar").on("click", function() {

        $(".aba-renovar").find("span").css("color", "#0f2e44");
        $(this).find("span").css("color", "#00918e");

        var planos = $(this).data("planos");

        if(planos == "expirados") {
            $("#planos_ativos").hide();
            $("#planos_expirados").show();
        }
        else if(planos == "ativos") {

            $("#planos_expirados").hide();
            $("#planos_ativos").show();
        }
        else {

        }
    });




});