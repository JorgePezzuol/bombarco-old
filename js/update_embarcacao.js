$(document).ready(function () {

    $('.bt-remover-img').mouseover(function () {
        $(this).css("cursor", "pointer");
    });


    $("#Motores_horas").keyup(function () {
        $('#Motores_horas').val($(this).val().replace(/[^0-9]/g, ""));
    });


    // habilitar acessorios dependendo da macro
    var macro_embarcacao = $("#macro-embarc-hidden").val();


    // ID da embarcação
    var url = window.location.href;
    var embarcacoes_id = url.split('/').pop('-1');



    /**
     * AJAX que carregam os fabricantes
     * a partir da macro
     */
    $('#Embarcacoes_embarcacao_macros_id').on('change', function(){

        $this = $(this);
        $fabricantes = $('#Embarcacoes_embarcacao_fabricantes_id');
        $modelos = $('#Embarcacoes_embarcacao_modelos_id');

        var macro_id = $this.val();

        $.ajax({
            url: Yii.app.createUrl('EmbarcacaoFabricantes/AJAXfromMacro'),
            type: 'POST',
            data: {macro_id:macro_id},
            dataType: 'json',
            success: function(res){
                $fabricantes.empty();
                $modelos.empty();

                if (res.length > 0) {
                    $fabricantes.append(new Option('Selecione um Fabricante', ''));
                } else {
                    $fabricantes.append(new Option('Sem Fabricante', ''));
                }

                for (var i=0; i < res.length; i++) {
                    fabricante = res[i];
                    $fabricantes.append(new Option(fabricante.titulo, fabricante.id));
                };
            },
            error: function(res){
                console.log(res);
            }
        });

    });



    /**
     * AJAX que carregam os modelos
     * a partir do fabricante
     */
    $('#Embarcacoes_embarcacao_fabricantes_id').on('change', function(){

        $this = $(this);
        $modelos = $('#Embarcacoes_embarcacao_modelos_id');

        var fabricante_id = $this.val();

        $.ajax({
            url: Yii.app.createUrl('EmbarcacaoModelos/AJAXfromFabricante'),
            type: 'POST',
            data: {fabricante_id:fabricante_id},
            dataType: 'json',
            success: function(res){
                console.log(res);
                $modelos.empty();

                // Se existirem modelos deste fabricante
                if (res.length > 0) {
                    $modelos.append(new Option('Selecione um Modelo', ''));
                } else {
                    $modelos.append(new Option('Sem Modelos', ''));
                }

                // Loop para popular select
                for (var i=0; i < res.length; i++) {
                    modelo = res[i];
                    $modelos.append(new Option(modelo.titulo, modelo.id));
                };
            },
            error: function(res){
                console.log(res);
            }
        });

    });

    /**
     * Retorna o modelo
     */
    $('#Embarcacoes_embarcacao_modelos_id').on('change', function(){

        $this = $(this);

        var modelo_id = $this.val();

        $.ajax({
            url: Yii.app.createUrl('EmbarcacaoModelos/AJAXModelo'),
            type: 'POST',
            data: {modelo_id:modelo_id},
            dataType: 'json',
            success: function(res){
                
                document.querySelector('.info-tipo b').innerHTML = res.tipo_titulo;

                // Se for JetSki
                if (res.embarcacao_macros_id == 1) {
                    document.querySelector('.info-motor b').innerHTML = res.motor_de_fabrica;
                } else {
                    document.querySelector('.info-tamanho b').innerHTML = res.tamanho.split('.')[0] + ' pés';
                    document.querySelector('.info-passageiros b').innerHTML = 'Dia: ' + res.passageiros + ' / Noite: ' + res.acomodacoes;
                }

            },
            error: function(res){
                console.log(res);
            }
        });

    });



    $("#Motores_motor_fabricantes_id").on("change", function () {

        var motor_fabricantes_id = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadMotorModelos'),
            type: 'post',
            data: {
                motor_fabricantes_id: motor_fabricantes_id
            },
            success: function (resp) {

                var modelosMotor = JSON.parse(resp.trim());

                $("#Motores_motor_modelos_id").empty();
                var option = $('<option selected="selected" value="">Selecione</option>');
                $("#Motores_motor_modelos_id").append(option).trigger("create");
                for (var i = 0; i < modelosMotor.length; i++) {

                    var option = $('<option value="' + modelosMotor[i].id + '">' + modelosMotor[i].titulo + '</option>');
                    $("#Motores_motor_modelos_id").append(option).trigger("create");
                }

                $("#Motores_motor_modelos_id").prop("disabled", false);
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro por favor tenta mais tarde.")
            }
        });
    });

    // mascara valor
    $('#valor').mask('000.000.000.000.000,00', {reverse: true});


    $("#Motores_motor_modelos_id").on("change", function () {

        var id_modelo_motor = $(this).val();

        if (id_modelo_motor != "") {

            $.ajax({
                url: Yii.app.createUrl('utils/loadPotenciaTipoMotor'),
                type: 'POST',
                data: {id_modelo_motor: id_modelo_motor},
                success: function (resp) {

                    if (resp != "-1") {

                        // recebe tipo e potencia do modelo de motor em questao
                        var potenciaTipo = JSON.parse(resp.trim());

                        var potencia = "Não informada";
                        var tipo = "Não informado";

                        if (potenciaTipo.potencia != "") {
                            potencia = potenciaTipo.potencia;
                        }

                        if (potenciaTipo.tipo != "") {
                            tipo = potenciaTipo.tipo;
                        }

                        // colocar a potencia no <select> de potencia
                        $("#Motores_motor_potencia").empty();
                        $("#Motores_motor_potencia").append('<option selected="selected" value="' + potencia + '">' + potencia + '</option>').trigger('create');

                        // colocar o valor do tipo no <select>
                        $("#Motores_motor_tipos_id").empty();

                        $("#Motores_motor_tipos_id").append('<option selected="selected" value="' + tipo + '">' + tipo + '</option>').trigger('create');
                    }

                },
                error: function (xhz, e, errorMessage) {
                    alert(JSON.stringify(errorMessage));
                }
            });

        } else {
            // aqui o campo de modelo de motor não possui valor, portanto vamos "limpar" os campos de potencia e tipo
            $("#Embarcacoes_motor_marca").val("");
            $("#Embarcacoes_motor_potencia").empty();
            $("#Embarcacoes_motor_potencia").append('<option selected="selected">Selecione</option>').trigger('create');
            $("#Embarcacoes_motor_tipo").empty();
            $("#Embarcacoes_motor_tipo").append('<option selected="selected">Selecione</option>').trigger('create');
        }
    });

    $("#Embarcacoes_motor_marca").on("change", function () {


        // alteração 07/10/2014 17:35
        if ($(this).val() == "") {
            $("#Embarcacoes_motor_modelo").empty();
        }
        //

        $("#Embarcacoes_motor_potencia").empty();
        $("#Embarcacoes_motor_potencia").append('<option selected="selected">Selecione</option>').trigger('create');
        $("#Embarcacoes_motor_tipo").empty();
        $("#Embarcacoes_motor_tipo").append('<option selected="selected">Selecione</option>').trigger('create');

    });


    // imagens embarc
    $(".img-upload-embarc").on("click", function () {

        if($(this).data("id") == 0) {

            $(".gallery").hide();

            $('#uploader').fineUploader({
                template: 'qq-template', 
                request: {
                    endpoint: Yii.app.createUrl("embarcacoes/uploadFotoAnuncio?turbo=0"),
                    params: {
                        // gambs p pegar a ordem
                        // aqui sera salvo a ordem das imagens (mandaremos assim: nomeimagem.png|1,nomeimagem2|2,nomeimagem3|3)
                        string_ordens: function() {
                            var ordem = "";
                            $(".upload-file").each(function(index) {
                                ordem += $(this).attr("title")+"|"+index;
                                if($(".upload-file").length != (index+1)) {
                                    ordem += ",";
                                }
                            });     
                            return ordem;
                        },
                        embarcacoes_id: $("#primary_key").val()
                    }
                },
                thumbnails: {},
                autoUpload: false,
                validation: {
                    allowedExtensions: ['jpeg', 'jpg', 'png'],
                    itemLimit: calcularQtdeFotosRestantes(),
                    minSizeLimit: 1000, 
                    sizeLimit: 1000000 // 1 Mb

                },
                noFilesError: ""
            });

            // drag and drop
            $("ul.qq-upload-list-selector").sortable({ 
                tolerance: 'pointer'
            });
            $('#reorder-helper').slideDown('slow');
            $('.image_link').attr("href","javascript:void(0);");
            $('.image_link').css("cursor","move");

            $("input[name='qqfile']").trigger("click");
        }

        else {
            $(this).next(':input').trigger('click');
        }

    });


    $(".bt-remover-img").on("click", function (e) {
        var $this = $(this);
        e.preventDefault();

        // pegar o ID do elemento img
        var id = $(this).attr("id");

        // voltar imagem default
        $("#image-" + id).attr("src", Yii.app.createUrl('img/addfoto.png'));

        // pegar o ID da imagem salva no banco
        var data_id = $("#image-" + id).data("id");

        // ajax deletar registro da foto
        $.ajax({
            url: Yii.app.createUrl('embarcacoes/deletarFoto'),
            data: {id: data_id},
            type: "post",
            success: function (resp) {

                if (resp == '-1') {
                    alert("Ocorreu um erro inesperado. Contate o admin do site.");
                }
                else {
                    // esconder botao de exluicr

                    $this.hide();
                }
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro inesperado. Contate o admin do site.");
            }
        });


    });


    // file img embarc
    $('.file-upload-embarc').on("change", function () {

        var $this = $(this);

        // pega a tag <img> que está logo atras
        var img = $this.prev();

        var id_img_turbinada = $this.prev().data("id");

        // indica se é turbinada ou não
        var flgTurbinada = 0;

        // verificar se é img turbinada
        if ($this.prev().hasClass('img-turbinada')) {
            flgTurbinada = 1;
        }

        if (id_img_turbinada == undefined) {
            id_img_turbinada = 0;
        }

        var nome = $this[0].files[0].name;

        var fd = new FormData();
        fd.append("img-turbinada", $this[0].files[0]);
        fd.append("id-img-turbinada", id_img_turbinada);
        fd.append('flgTurbinada', flgTurbinada);
        fd.append('embarcacoes_id', embarcacoes_id);

        $.ajax({
            url: Yii.app.createUrl('embarcacoes/updateFoto'),
            type: 'POST',
            cache: false,
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {

                if (resp.trim() != "-1") {
                    // append na img com o novo src
                    img.attr("src", Yii.app.createUrl('public/embarcacoes/' + resp.trim()));
                    //location.reload();
                }

                else {
                    alert("Foto não permitida ou ultrapassou o limite! Formatos aceitos: JPEG / PNG . Tamanho Máximo 1 MB - Prefira Imagens na horizontal.");
                }


            },
            error: function (x, h, z) {

                alert("Ocorreu um erro inesperado. Contate o admin do site");
            }
        });
    });

    // alterou ano
    $("#alterar-ano").on("change", function () {
        if ($(this).attr("checked")) {
            $("#div-alterar-ano").fadeIn("slow");
        }
        else {
            $("#div-alterar-ano").fadeOut("slow");
        }
    });

    // alterou valor
    $("#alterar-valor").on("change", function () {
        if ($(this).attr("checked")) {
            $("#div-alterar-valor").fadeIn("slow");
        }
        else {
            $("#div-alterar-valor").fadeOut("slow");
        }
    });


    $('.file-upload-img-turbinada').on("change", function () {

        // obter tag <img> que terá a imagem selecionada
        var prevImg = $(this).prev();
        readURL(this, prevImg);
    });


    function readURL(input, img) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                img.attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // ajax preencher cidades a partir do estado
    $("#Embarcacoes_estados_id").on("change", function () {

        var estado_id = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadCities2'),
            type: 'post',
            data: {estados_id: estado_id},
            success: function (resp) {

                $("#Embarcacoes_cidades_id").empty();
                var selectDefault = $('<option selected="selected" value="">selecione</option>');
                $("#Embarcacoes_cidades_id").append(selectDefault).trigger("create");
                var cidades = JSON.parse(resp.trim());

                for (var i = 0; i < cidades.length; i++) {

                    var option = $('<option value="' + cidades[i].id + '">' + cidades[i].nome + '</option>');
                    $("#Embarcacoes_cidades_id").append(option).trigger("create");
                }
            },
            error: function (x, h, z) {

            }
        });
    });


    // array usado para guardar valores no update
    var backupvalores = [];


    // alterar acessorios
    $("#alterar-acessorios").on("click", function (e) {


        if ($(this).hasClass("alterar")) {

            // jetski
            if (macro_embarcacao == 1) {
                $("#acessorios-lancha").fadeOut("fast");
                $("#acessorios-veleiro").fadeOut("fast");
                $("#acessorios-pesca").fadeOut("fast");
                $("#acessorios-jetski").fadeIn("fast");
            }

            // lancha
            else if (macro_embarcacao == 2) {
                $("#acessorios-lancha").fadeIn("fast");
                $("#acessorios-veleiro").fadeOut("fast");
                $("#acessorios-jetski").fadeOut("fast");
                $("#acessorios-pesca").fadeOut("fast");
            }

            // lancha
            else if (macro_embarcacao == 4) {
                $("#acessorios-lancha").fadeOut("fast");
                $("#acessorios-veleiro").fadeOut("fast");
                $("#acessorios-jetski").fadeOut("fast");
                $("#acessorios-pesca").fadeIn("fast");
            }

            // veleiro
            else {
                $("#acessorios-lancha").fadeIn("fast");
                $("#acessorios-veleiro").fadeIn("fast");
                $("#acessorios-jetski").fadeOut("fast");
                $("#acessorios-pesca").fadeOut("fast");
            }

            $('.check-acessorio').each(function (e) {
                $(this).prop('disabled', false);
            });

            // criar campo que indica que houve alteracao de fabricante/modelo
            $("#embarcacoes-form").append('<input type="hidden" id="hidden-alterar-acessorios" name="alterar-acessorios"/>').trigger("create");

            $(this).removeClass("alterar");
        }
        else {
            $('.check-acessorio').each(function (e) {
                $(this).prop('disabled', true);
            });

            $("#acessorios-lancha").fadeOut("fast");
            $("#acessorios-veleiro").fadeOut("fast");
            $("#acessorios-jetski").fadeOut("fast");
            $("#acessorios-pesca").fadeOut("fast");

            $(this).addClass("alterar");
            $("#hidden-alterar-acessorios").remove();
        }
    });


    // submit
    $("#btn-alterar").on("click", function (e) {
        e.preventDefault();

        // se escolheu que tem 0 motores mas selecionou marca ou modelo, temos q validar
        if ($("#qnt-motores").val() == 0 && ($("#Motores_motor_fabricantes_id").val() != "" || $("#Motores_motor_modelos_id").val() != "")) {

            alert("Erro ao alterar o motor da embarcação!");
            return false;

        } 
        else if ($("#qnt-motores").val() != 0 && ($("#Motores_motor_fabricantes_id").val() == "" || $("#Motores_motor_modelos_id").val() == "")) {

            alert("Erro ao alterar o motor da embarcação!");
            return false;

        } 
        else if ($("#Embarcacoes_embarcacao_fabricantes_id").length > 0 && ($("#Embarcacoes_embarcacao_fabricantes_id").val() == '' || $("#Embarcacoes_embarcacao_fabricantes_id").val() == null)) {

            alert("Selecione um Fabricante!");
            return false;

        } else if ($("#Embarcacoes_embarcacao_modelos_id").length > 0 && ($("#Embarcacoes_embarcacao_modelos_id").val() == '' || $("#Embarcacoes_embarcacao_modelos_id").val() == null)) {

            alert("Selecione um Modelo!");
            return false;

        } else {

            if($(".cancelar-foto-normal").length > 0) {
                $("#uploader").fineUploader("uploadStoredFiles");    
            }
            else {

                // ajax reordenar imagens
                var ids_ordem = [];
                $(".img-upload-embarc").each(function(index) {

                    var ele = $(this);
                    var img_id = ele.data("id");
                    var ordem = index;

                    if(img_id != 0) {

                        ids_ordem.push(img_id+"|"+index);
                    }
                });
                setTimeout(function(){ }, 2000);
                $.ajax({
                    url: Yii.app.createUrl("embarcacoes/alterarOrdemImg"),
                    data: {
                       ids_ordem: JSON.stringify(ids_ordem),
                    },
                    async: false,
                    type: "post",
                    success: function(resp) {
                        console.log(resp);
                    },
                    error: function() {
                    }
                });
            }

            $('#embarcacoes-form').submit();            
        }
    });

    // quando clica no ok do lightbox da o submit
    $("#revisar-btn").on("click", function (e) {
        e.preventDefault();
        $("#embarcacoes-form").submit();
    });

    $("#Motores_motor_modelos_id").trigger("change");

    // ordena as fotos
    $("ul.reorder-photos-list").sortable({ 
        tolerance: 'pointer',
        update: function(event, ui) {

            var posicao = ui.placeholder.index();

            var idsInOrder = $("ul.reorder-photos-list").sortable("toArray");

            var span_img_principal = $(".aviso-img-principal").clone();
            $(".aviso-img-principal").remove();
            $("#"+idsInOrder[0]).find(".upload-img-box").prepend(span_img_principal);

            var img_ordens = [];
            
            for(var i = 0; i < idsInOrder.length; i++) {

                var id = $("#"+idsInOrder[i]).find(".img-upload-embarc").data("id");

                if(id != 0) {
                    var ordem = i;

                    var img = {
                        id: id,
                        ordem: i
                    };

                    img_ordens.push(img);
                }

            }
            setTimeout(function(){ }, 2000);
            $.ajax({
                url: Yii.app.createUrl("embarcacoes/alterarOrdemImg2"), 
                data: {
                    img_ordens: JSON.stringify(img_ordens)
                },
                type: "POST",
                success: function(resp) {
                    console.log(resp);
                }
            });

        }
    });
    $('#reorder-helper').slideDown('slow');
    $('.image_link').attr("href","javascript:void(0);");
    $('.image_link').css("cursor","move");

    function calcularQtdeFotosRestantes() {

        // calcular quantas fotos poderao ser subidas com base nas que ja existem
        var total = $(".li-imagem").length;
        var imgs = $(".bt-remover-img").length;
        var qtdeimgs = total - imgs;

        return qtdeimgs;
    }

    if(calcularQtdeFotosRestantes() == 0) {
        $("#multiple-upload").hide();
    }

    $("#multiple-upload").on("click", function(e) {
        e.preventDefault();

        $(".gallery").hide();

        $('#uploader').fineUploader({
            template: 'qq-template', 
            request: {
                endpoint: Yii.app.createUrl("embarcacoes/uploadFotoAnuncio?turbo=0"),
                params: {
                    // gambs p pegar a ordem
                    // aqui sera salvo a ordem das imagens (mandaremos assim: nomeimagem.png|1,nomeimagem2|2,nomeimagem3|3)
                    string_ordens: function() {
                        
                        var ordem = "";
                        $(".upload-file").each(function(index) {
                            ordem += $(this).attr("title")+"|"+index;
                            if($(".upload-file").length != (index+1)) {
                                ordem += ",";
                            }
                        });     
                        return ordem;
                    },
                    embarcacoes_id: $("#primary_key").val()
                }
            },
            thumbnails: {},
            autoUpload: false,
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                itemLimit: calcularQtdeFotosRestantes(),
                minSizeLimit: 1000, 
                sizeLimit: 1000000 // 1 Mb

            },
            noFilesError: ""
        });

        // drag and drop
        $("ul.qq-upload-list-selector").sortable({ 
            tolerance: 'pointer'
        });
        $('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");

        $("input[name='qqfile']").trigger("click");

    });


// ready
});