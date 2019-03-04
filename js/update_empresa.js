$(document).ready(function () {


    $("#Empresas_cidades_id").addClass('info-input');

    // using jQuery Mask Plugin v1.7.5
    // http://jsfiddle.net/d29m6enx/2/
    var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
            options = {onKeyPress: function (val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };

    $("#Empresas_telefone").mask(maskBehavior, options);
    $("#Empresas_cnpj").mask('99.999.999/9999-99');

    $("#alterar-estado").on("change", function () {
        if ($(this).attr("checked")) {
            $("#div-estado-cidade").fadeIn("slow");
        }
        else {
            $("#div-estado-cidade").fadeOut("slow");
        }
    });

    /* consultar cep a partir do endereço */

    /* Executa a requisição quando o campo CEP perder o foco */
    $('#Empresas_cep').blur(function () {

        /* Configura a requisição AJAX */
        $.ajax({
            url: Yii.app.createUrl('anuncios/consultarCep'), /* URL que será chamada */
            type: 'POST', /* Tipo da requisição */

            //data: 'cep=' + $('#Empresas_cep').val(), /* dado que será enviado via POST */
            data: {cep: $("#Empresas_cep").val()},
            dataType: 'json', /* Tipo de transmissão */
            success: function (data) {

                if (data.sucesso == 1) {

                    $('#Empresas_endereco').val(data.rua);
                    $('#Empresas_bairro').val(data.bairro);
                    // $('#Usuarios_cidades_id').val(data.cidade);
                    //$('#Usuarios_estados_id').val(data.estado);

                    $('#Empresas_numero').focus();

                }

            }
        });

    });

    // ajax preencher cidades a partir do estado
    $("#Empresas_estados_id").on("change", function () {

        var estado_id = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadCities2'),
            type: 'post',
            data: {estados_id: estado_id},
            success: function (resp) {

                $("#Empresas_cidades_id").empty();
                var selectDefault = $('<option selected="selected" value="">selecione</option>');
                $("#Empresas_cidades_id").append(selectDefault).trigger("create");
                var cidades = JSON.parse(resp.trim());

                for (var i = 0; i < cidades.length; i++) {

                    var option = $('<option value="' + cidades[i].id + '">' + cidades[i].nome + '</option>');
                    $("#Empresas_cidades_id").append(option).trigger("create");
                }
            },
            error: function (x, h, z) {

            }
        });
    });

    


    $('#logo-file').on("change", function () {

        // nome do arquivo da foto
        var nome = $("#logo-file")[0].files[0].name;

        var id_empresa = $("#id_empresa").val();

        var fd = new FormData();

        fd.append("Empresas[logo]", $("#logo-file")[0].files[0]);
        fd.append('id_empresa', id_empresa);

        $.ajax({
            url: Yii.app.createUrl('empresas/updateLogoAjax'),
            type: 'POST',
            cache: false,
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {

                if (resp.trim() != "-1") {
                    $("#logo").attr("src", Yii.app.createUrl('public/empresas/' + resp.trim()));
                }
                 else {
                    alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
                }

            },
            error: function (x, h, z) {
             //   console.log(h);
            },
        });

    });

    $('#capa-file').on("change", function () {

        var id_empresa = $("#id_empresa").val();
        var nome = $("#capa-file")[0].files[0].name;

        var fd = new FormData();

        fd.append("Empresas[capa]", $("#capa-file")[0].files[0]);
        fd.append('id_empresa', id_empresa);


        $.ajax({
            url: Yii.app.createUrl('empresas/updateCapaAjax'),
            type: 'POST',
            cache: false,
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {

                if (resp.trim() != "-1") {
                    $("#capa").attr("src", Yii.app.createUrl('public/empresas/' + resp.trim()));
                }
                else {
                    alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
                }

            },
            error: function (x, h, z) {
                //console.log(h);
                //alert(JSON.stringify(z));
                alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
            }
        });

    });


    $(".remover").on("click", function (e) {
        e.preventDefault();
        
        var $this = $(this);

        var id_empresa = $("#id_empresa").val();

        // 1 - capa // 2 - logo
        var capaOuLogo = $(this).data('capalogo');

        $.ajax({
            url: Yii.app.createUrl('empresas/removerCapaOuLogo'),
            type: 'post',
            data: {
                id_empresa: id_empresa,
                capalogo: capaOuLogo
            },
            success: function (resp) {
              
                if (resp.trim() != '-1') {
                    
                    $this.parent().find('img').attr("src", Yii.app.createUrl('img/addfoto.png'));
                    $this.hide();
                }
            },
            error: function () {
                alert("Ocorreu um erro. Tente mais tarde");
            }
        });

    });


    $(".img-turbinada").on("click", function () {

        $(this).parent().parent().find('.file-turbinada').trigger("click");
    });

    $('.file-turbinada').on("change", function () {

        // verifica se a <img> anterior possui a classe 'create', se sim
        // vamos salvar a imagem no servidor, caso contrário é um update
        var img = $(this).prev().find('img');

        var createOuUpdate = $(this).prev().hasClass("create");

        var id_imagem = $(this).prev().attr("id");
        if (id_imagem == undefined) {
            id_imagem = 0;
        }
        if (createOuUpdate == true) {
            createOuUpdate = 1;
        }
        else {
            createOuUpdate = 0;
        }

        var id_empresa = $("#id_empresa").val();

        var nome = $(this)[0].files[0].name;

        var fd = new FormData();

        fd.append("img-turbinada", $(this)[0].files[0]);
        fd.append("flgCreateOuUpdate", createOuUpdate);
        fd.append("id_imagem", id_imagem);
        fd.append("id_empresa", id_empresa);


        $.ajax({
            url: Yii.app.createUrl('empresas/updateFotoTurbinada'),
            type: 'POST',
            cache: false,
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {



                if (resp.trim() != "-1") {
                    img.attr("src", Yii.app.createUrl('public/empresas/' + resp.trim()));
                }
                else {

                    alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
                

                }

            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
            }

        });
    });



    $("#logo").on("click", function () {

        $("#logo-file").trigger("click");
    });

    $("#capa").on("click", function () {

        $("#capa-file").trigger("click");
    });

    //generate iframe google maps
    function generateMaps(address, city, number) {
        $("#Empresas_maps").val('http://maps.google.com/?q= ' + address + ', ' + city + ', ' + number + '&output=embed');

    }
    $('#empresas-form').on('submit', function (e) {
        var city = $('#Empresas_cidades_id').find('option:selected').text();
        var address = $('#Empresas_endereco').val();
        var number = $('#Empresas_numero').val();
        generateMaps(address, city, number);
    });

    /* deletar foto de turbinada */
    $('.deletar-foto').on("click", function (e) {
        e.preventDefault();

        var id = $(this).attr("id");


        $.ajax({
            url: Yii.app.createUrl('empresas/deletarFotoTurbinada'),
            type: 'post',
            data: {
                id: id
            },
            success: function (resp) {

                if (resp != '-1') {

                }

                else {
                    alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
                }
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Tente novamente mais tarde");
            }
        });
    });



// ready	
});