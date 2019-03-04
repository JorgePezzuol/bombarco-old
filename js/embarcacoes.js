$(document).ready(function () {

    if(isMobile()) {

        alert("Atualmente só é possível anunciar utilizando a versão desktop do site. Desculpe o transtorno.");
        location.href = "https://www.bombarco.com.br/";
        return false;
    }

    $("#outro-anuncio").remove();

    // variavel global que vai guardar o valor da macro
    // 1 - jetski
    // 2 - lancha
    // 3 - veleiro
    // 4 - pesca
    var macro = 0;

    // indica se cpm foi marcado ou nao
    var flgCpm = 0;

    // flag que valida se as fotos possuem tamanhos validos
    var flgValidacaoFotos = true;

    // indica se é o form de estaleiro ou nao (0 não é, 1 é)
    var flgEstaleiro = $("#flgEstaleiro").val();

    $(".menu-head").hide();

    //style input radio
    $("<span class='span-radio'><i class='ico-radio'></i></span>").insertAfter("input[type='radio']");
    $('.span-radio').on('click', function (e) {
        e.preventDefault();
        $('span').removeClass('section-change');
        $(this).parent().addClass('section-change');
        $('.section-change .span-radio').removeClass('active-radio');
        $(this).addClass('active-radio');
        $(this).prev().trigger('change');
        $(this).prev().trigger('click');
    });
    /*$('.line-cadastro-3 label, .line-cadastro-4 label').on('click', function (e) {
        e.preventDefault();
        var namefor = $(this).attr("for");
        $('span').removeClass('section-change');
        $(this).parent().addClass('section-change');
        $('.section-change .span-radio').removeClass('active-radio');
        $('input[type="radio"][id="' + namefor + '"]').trigger('change');
        $('input[type="radio"][id="' + namefor + '"]').trigger('click');
        $(this).prev().addClass('active-radio');
    });*/

    $('.compactRadioGroup label, .quadro-box-cadastro-4b label').on('click', function (e) {
        e.preventDefault();
        var namefor = $(this).attr("for");
        $('span').removeClass('section-change');
        $(this).parent().addClass('section-change');
        $('.section-change .span-radio').removeClass('active-radio');
        $('input[type="radio"][id="' + namefor + '"]').trigger('change');
        $('input[type="radio"][id="' + namefor + '"]').trigger('click');
        $(this).prev().addClass('active-radio');
    });

    

    //style input checkbox
    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".quadro-box-cadastro-5b input");
    $('.quadro-box-cadastro-5b').on('click', '.span-checkbox', function (e) {
        $('.group-none, #div-motor').show();

        $('.box-cadastro-5 .validate-opacity').hide();
        $(this).prev().trigger('click');
        if ($(this).hasClass('active-radio')) {
            //$(this).prev().trigger('change');
            //$(this).prev().trigger('click');
            $('.quadro-box-cadastro-5b .span-checkbox').eq(1).removeClass('active-radio');
            $(this).removeClass('active-radio');
        } else {
            $(this).addClass('active-radio');
            $('.quadro-box-cadastro-5b .span-checkbox').eq(1).addClass('active-radio');
            //$(this).prev().trigger('change');
            //$(this).prev().trigger('click');
            //$('.section-change2 input').trigger('click');
        }
        e.preventDefault();
    });

    $('.quadro-box-cadastro-5b label').on('click', function (e) {
        $('.group-none, #div-motor').show();
        $('.box-cadastro-5 .validate-opacity').hide();
        if ($(this).prev().hasClass('active-radio')) {
            $(this).prev().prev().trigger('click');
            $(this).prev().removeClass('active-radio');
            $('.quadro-box-cadastro-5b .span-checkbox').eq(1).removeClass('active-radio');
        } else {
            $(this).prev().addClass('active-radio');
            $(this).prev().prev().trigger('click');
            $('.quadro-box-cadastro-5b .span-checkbox').eq(1).addClass('active-radio');
        }
        e.preventDefault();
    });

    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".box-cadastro-6 input[type='checkbox']");
    $('.box-cadastro-6 .span-checkbox').on('click', function (e) {
        $('.box-cadastro-6').removeClass('change-input');
        if ($(this).hasClass('active-radio')) {
            $(this).prev().trigger('click');
            $(this).removeClass('active-radio');
        } else {
            $(this).addClass('active-radio');
            $(this).prev().trigger('click');
        }
        e.preventDefault();
    });

    $('.box-cadastro-6 label').on('click', function (e) {
        if ($(this).prev().hasClass('active-radio')) {
            $(this).prev().prev().trigger('click');
            $(this).prev().removeClass('active-radio');
        } else {
            $(this).prev().addClass('active-radio');
            $(this).prev().prev().trigger('click');
        }
        e.preventDefault();
    });

    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".div-check-valor input[type='checkbox']");
    $('.div-check-valor .span-checkbox').on('click', function (e) {
        $('.div-check-valor').removeClass('change-input');
        if ($(this).hasClass('active-radio')) {
            $("#check-valor").val(0);
            $(this).prev().trigger('click');
            $(this).removeClass('active-radio');            
        } else {

            $("#check-valor").val(1);
            $(this).addClass('active-radio');
            $(this).prev().trigger('click');
           
        }
        e.preventDefault();
    });

    $('#div-check-valor label').on('click', function (e) {
        if ($(this).prev().hasClass('active-radio')) {
            $("#check-valor").val(0);
            $(this).prev().removeClass('active-radio');
        } else {
            $(this).prev().addClass('active-radio');
            $("#check-valor").val(1);
        }
        e.preventDefault();
    });


    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".quadro-box-cadastro-7b input");
    $('.quadro-box-cadastro-7b .span-checkbox').on('click', function (e) {
        $('.quadro-box-cadastro-7b').removeClass('change-input');
        if ($(this).hasClass('active-radio')) {
            $(this).prev().trigger('click');
            $(this).removeClass('active-radio');
        } else {
            $(this).addClass('active-radio');
            $(this).prev().trigger('click');
        }
        e.preventDefault();
    });

    $('.quadro-box-cadastro-7b label').on('click', function (e) {
        if ($(this).prev().hasClass('active-radio')) {
            $(this).prev().prev().trigger('click');
            $(this).prev().removeClass('active-radio');
        } else {
            $(this).prev().addClass('active-radio');
            $(this).prev().prev().trigger('click');
        }
        e.preventDefault();
    });

    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter("#div-acessorios input");
    $('#div-acessorios .span-checkbox').on('click', function (e) {
        if ($(this).hasClass('active-radio')) {
            $(this).prev().attr('checked', false);
            $(this).removeClass('active-radio');
            $(this).prev().trigger('change');

        } else {
            $(this).addClass('active-radio');
            $(this).prev().attr('checked', true);
            $(this).prev().trigger('change');

        }
        e.preventDefault();
    });

    $('#div-acessorios label').on('click', function (e) {
        if ($(this).prev().hasClass('active-radio')) {
            $(this).prev().prev().attr('checked', false);
            $(this).prev().removeClass('active-radio');
        } else {
            $(this).prev().addClass('active-radio');
            $(this).prev().prev().attr('checked', true);
        }
        e.preventDefault();
    });

    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".box-cadastro-12 input[type='checkbox']");
    $('.box-cadastro-12 .span-checkbox').on('click', function (e) {
        if ($(this).hasClass('active-radio')) {
            $(this).prev().attr('checked', false);
            $(this).removeClass('active-radio');
            $(this).prev().trigger('change');
        } else {
            $(this).addClass('active-radio');
            $(this).prev().attr('checked', true);
            $(this).prev().trigger('change');
        }
        e.preventDefault();
    });

    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".box-cadastro-13 input[type='checkbox']");
    $('.box-cadastro-13 .span-checkbox').on('click', function (e) {
        if ($(this).hasClass('active-radio')) {
            $(this).prev().attr('checked', false);
            $(this).removeClass('active-radio');
            $(this).prev().trigger('change');
        } else {
            $(this).addClass('active-radio');
            $(this).prev().attr('checked', true);
            $(this).prev().trigger('change');
        }
        e.preventDefault();
    });

    $("<span class='span-checkbox'><i class='ico-radio'></i></span>").insertAfter(".box-cadastro-14 input[type='checkbox']");
    $('.box-cadastro-14 .span-checkbox').on('click', function (e) {
        if ($(this).hasClass('active-radio')) {
            $(this).prev().attr('checked', false);
            $(this).removeClass('active-radio');
            $(this).prev().trigger('change');
        } else {
            $(this).addClass('active-radio');
            $(this).prev().attr('checked', true);
            $(this).prev().trigger('change');
        }
        e.preventDefault();
    })


    //validacoes opacidade
    $('#Embarcacoes_estados_id').on('change', function (e) {
        $('.quadro-box-cadastro-2 .validate-opacity').hide();
    });

    $('.quadro-box-cadastro-3b input').on('change', function (e) {
        $('.quadro-box-cadastro-5a .validate-opacity').eq(0).hide();
    });

    $('#fabricante-embarcacao').on('change', function (e) {
        $('.quadro-5b .validate-opacity').hide();
    });

    $('#check-nao-tem-motor').on('change', function (e) {
        $('.box-cadastro-7 .validate-opacity').slideToggle();
    });

    //addClass body
    if ($("#flgEstaleiro").val() == 1) {
        $('body').addClass('anuncio-process2');
        $('.menu-head').show();
        $('.line-cadastro-15').hide();
    };

    if (window.location.href.indexOf("anunciarEmbarcacao") > -1) {
        $('body').addClass('anuncio-process');
    }

    //btn duvida
    $('.section-duvida-form .btn-duvida-form').on('mouseover', function (e) {
        $(this).next().fadeIn('slow');
    });
    $('.section-duvida-form .btn-duvida-form').on('mouseout', function (e) {
        $(this).next().fadeOut('slow');
    });

    $('.section-duvida-form2 .btn-duvida-form2').on('mouseover', function (e) {
        $(this).next().fadeIn('slow');
    });
    $('.section-duvida-form2 .btn-duvida-form2').on('mouseout', function (e) {
        $(this).next().fadeOut('slow');
    });

    
        /*$('.section-duvida-form .btn-duvida-form').*("mouseover");

        setTimeout(function() { 
            $('.section-duvida-form .btn-duvida-form').trigger("mouseout");
        }, 5000);*/


    

    $('.hide').css('display', 'none');

    var backupValorTotal = $("#valor-total").text();

    numeral.language('pt-br');

    /**
     * Setando formato de moeda para inputs
     */
    $('input[id$=_valor]').priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.',
        clearPrefix: true
    });

    $('#calado, #pedireito, #boca').priceFormat({
        prefix: '',
        centsSeparator: '.',
        thousandsSeparator: '',
        clearPrefix: true
    });

    /**
     * Validando o preco da embarcacao
     */
    $('input[id$=_valor]').blur(function () {

        price = numeral().unformat($(this).val());
        max = $(this).data('maxprice');

        if (max == '') {
            return false;
        }

        if (max != 0 && price > max && max != 0.00) {
            price_format = numeral(max).format('0,0.00');
            $(this).val(price_format);
            alert('O limite de preco é: R$ ' + price_format);
        }
        ;
    });


    $('.img-turbinada2').on("click", function () {

        $(this).next("input[type='file']").trigger("click");

    });

    $('.div-img').on("click", function () {
        this.childNodes[2].click();
    });


    $('.span-foto-turbinada').on("click", function () {
        $(this).parent().parent().find('.img-turbinada2').trigger("click");
    });


    /*$('input[type=file]').on('change', function () {

        var img = $(this).parent().find("img");
        $(this).parent().find(".div-text2-blue-cadastro-l10").hide();

        // validar imagem (tamanho)
        // input file
        var $this = $(this);

        var fd = new FormData();

        fd.append("imagem", $(this)[0].files[0]);

        //console.log("Imagem: "+$(this)[0].files[0].name);

        readURL(this, img);

        $.ajax({
            url: Yii.app.createUrl('embarcacoes/validarImagem'),
            type: 'POST',
            cache: false,
            data: fd,
            processData: false,
            contentType: false,
            success: function (resp) {

                //console.log(resp);
                // imagem passou do peso
                if (resp.trim() == '-1') {
                    $this.val("");
                    $this.parent().find('.error-foto').fadeIn("fast");
                    flgValidacaoFotos = false;
                }
                else {
                    flgValidacaoFotos = true;
                    $this.parent().find('.error-foto').fadeOut("fast");

                }

            },
            error: function (x, h, z) {
                alert(JSON.stringify(z));
            }
        });

    });*/

        // fotos
        // estaleiro max = 16
        // anuncio max = 6
        var itemLimit = 6;
        if($("#flgEstaleiro").val() == 1) {
            itemLimit = 16;
        }

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
                    embarcacoes_id: $("#id_anuncio").val()
                }
            },
            thumbnails: {},
            autoUpload: false,
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                itemLimit: itemLimit,
                minSizeLimit: 1000, 
                sizeLimit: 1000000 // 1 Mb

            },
            callbacks: {
                /*onSubmit: function(id, name) {
                    $("#div-fotos-estaleiro").css("height", "610px");
                }*/
            },
            noFilesError: ""
        });

        // array pra fazer as ordens das imagens turbinadas, tendo em vista q as imagens normais "acabam" na ordem
        // 5, a primeira imagem turbo começa na ordem 6


        $('#uploader-turbo').fineUploader({
            template: 'qq-template-turbo', 
            request: {
                endpoint: Yii.app.createUrl("embarcacoes/uploadFotoAnuncio?turbo=1"),
                params: {
                    // gambs p pegar a ordem
                    // aqui sera salvo a ordem das imagens (mandaremos assim: nomeimagem.png|1,nomeimagem2|2,nomeimagem3|3)
                    string_ordens: function() {

                        var array_ordens_turbo = [];

                        // pegar o ultimo numero da ordem das fotos normais (-1 pq começa no 0)
                        var j = $(".upload-file").length;
                        for(var i = 0; i < 10; i++) {
                            array_ordens_turbo[i] = j;
                            j++;
                        }
                        
                        var ordem = "";

                        $(".upload-file-turbo").each(function(index) {
                            ordem += $(this).attr("title")+"|"+array_ordens_turbo[index];
                            if($(".upload-file-turbo").length != (index+1)) {
                                ordem += ",";
                            }
                        });
                        return ordem;
                    },
                    embarcacoes_id: $("#id_anuncio").val()
                }
            },
            thumbnails: {},
            autoUpload: false,
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                itemLimit: 10,
                minSizeLimit: 1000,
                sizeLimit: 1000000 // 1 Mb
            },
        });

        // drag and drop
        $("ul.qq-upload-list-selector").sortable({ 
            tolerance: 'pointer'
        });
        $('#reorder-helper').slideDown('slow');
        $('.image_link').attr("href","javascript:void(0);");
        $('.image_link').css("cursor","move");


        function readURL(input, img) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    img.attr('src', e.target.result)
                    img.css({
                        'width': '80%',
                        'height': '80%',
                        'left': '10px',
                        'top': '8px'
                    });
                };
                reader.readAsDataURL(input.files[0]);
            }
        }


    // já havia preenchido cidade e estado mas resolveu mudar..
    $("#cache-cidades-id").on("click", function () {

        // habilitar drop de estados
        $("#div-estados-hidden").fadeIn("fast");
        $("#div-cache-estados").fadeOut("fast");
        $("#div-cache-estados").remove();

        // habilitare drop de cidades
        $("#div-cidades-hidden").fadeIn("fast");
        $("#div-cache-cidades").fadeOut("fast");
        $("#div-cache-cidades").remove();

        $("#embarc_cid").attr("id", "Embarcacoes_cidades_id");
    });

    // já havia preenchido estado mas resolveu mudar..
    $("#cache-estados-id").on("click", function () {

        // habilitar drop de estados
        $("#div-estados-hidden").fadeIn("fast");
        $("#div-cache-estados").fadeOut("fast");
        $("#div-cache-estados").remove();

        // habilitare drop de cidades
        $("#div-cidades-hidden").fadeIn("fast");
        $("#div-cache-cidades").fadeOut("fast");
        $("#div-cache-cidades").remove();

        $("#embarc_cid").attr("id", "Embarcacoes_cidades_id");
    });

    // popular select de fabricantes a partir da macro da embarcacao
    $(".Embarcacao-macros-id").on("change", function () {

        $("#error-macro").empty();

        if ($("#n-encontrou-fabricante").attr('checked') || $("#n-encontrou-modelo-fabricante").attr('checked')) {
            location.reload();
        }
        else {
            $("#hidden-depende-fabricante").css("display", "none");
            $(".hidden-depende-modelo").css("display", "none");
            $(".hidden-depende-modelo-jetski").css("display", "none");

            var macros_id = $(this).val();

            // variavel global que guarda o valor da macro (jetski, lancha, veleiro, pesca)
            macro = macros_id;

            // habilitar alguns campos, visto q sleecionou a macro
            $("#n-encontrou-modelo-fabricante").prop("disabled", false);
            $("#n-encontrou-fabricante").prop("disabled", false);

            if (macros_id == "") {
                $("#hidden-depende-macro").css("display", "none");
                $("#hidden-depende-fabricante").css("display", "none");
                $(".hidden-depende-modelo").css("display", "none");
                $(".hidden-depende-modelo-jetski").css("display", "none");
                $("#hidden-depende-macro2").css("display", "none");
                $("#modelo-embarcacao").val("");

                return false;
            }

            // jetski
            if (macros_id == 1) {
                $("#acessorios-lancha").css("display", "none");
                $("#acessorios-veleiro").css("display", "none");
                $("#acessorios-pesca").css("display", "none");
                $("#acessorios-jetski").show("slow");
                $("#div-motor").fadeOut("slow");
                // dizer que nao tem motor
                $("#check-nao-tem-motor").attr("checked");
            }

            // lancha
            else if (macros_id == 2) {
                $("#acessorios-jetski").css("display", "none");
                $("#acessorios-veleiro").css("display", "none");
                $("#acessorios-pesca").css("display", "none");
                $("#acessorios-lancha").show("slow");
                $("#div-motor").fadeOut("slow");
            }            

            // veleiro
            else if (macros_id == 3) {
                $("#acessorios-jetski").css("display", "none");
                $("#acessorios-lancha").css("display", "none");
                $("#acessorios-pesca").css("display", "none");
                $("#acessorios-veleiro").show("slow");
                $("#div-motor").fadeOut("slow");
                //$('.line-cadastro-7').css('display','none');
            }

            // pesca
            else if (macros_id == 4) {
                $("#acessorios-jetski").css("display", "none");
                $("#acessorios-veleiro").css("display", "none");
                $("#acessorios-lancha").css("display", "none");
                $("#acessorios-pesca").show("slow");
                $("#div-motor").fadeOut("slow");
            }


            $.ajax({
                url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoes'),
                data: {embarcacao_macros_id: macros_id},
                type: "POST",
                success: function (resp) {

                    $("#fabricante-embarcacao").empty();
                    $("#fabricante-embarcacao").append("<option selected='selected' value=''>Selecione</option>").trigger('create');

                    if (resp != -1) {

                        var fabricantes = JSON.parse(resp.trim());

                        for (var i = 0; i < fabricantes.length; i++) {
                            var option = $('<option value="' + fabricantes[i].id + '">' + fabricantes[i].titulo + '</option>');
                            $("#fabricante-embarcacao").append(option).trigger("create");
                        }

                        // habilitar select e checkbox do fabricante
                        $("#fabricante-embarcacao").prop("disabled", false);
                        $("#n-encontrou-fabricante").prop("disabled", false);
                    }

                },
                error: function (x, r, msg) {
                    alert(JSON.stringify(msg));
                }
            });
        }

    });
    // Daqui pra baixo todas as funções se aplicam a pagina de cadastro de estaleiro 
    if ($("#flgEstaleiro").val() == 1) {
        $('.box-cadastro-2').css('height', 'auto');
        $('.line-cadastro-2').css('height', 'auto');
        $('.line-cadastro-10').css('height', '450px');
        $('.box-cadastro-10').css('height', '445px');
        $('.quadro-box-cadastro-7b').css('margin-left', '27px');
        $('.quadro-box-cadastro-7a').css('margin-left', '27px');
        $('.quadro-box-cadastro-15a').hide();
        $('.quadro-box-cadastro-15b').hide();
        $('.quadro-box-cadastro-15c').css('float', 'right');
        //$('.line-cadastro-15').hide();
        //$('#btn-form').show();
    }

    //Fim das Funções do form de estaleiro//

    // popular modelos do fabricante
    $("#fabricante-embarcacao").on("change", function () {

        $("#error-fabricante").empty();
        


        var embarcacao_fabricantes_id = $(this).val();

        if (embarcacao_fabricantes_id == "") {
            $("#hidden-depende-fabricante").css("display", "none");
            $(".hidden-depende-modelo").css("display", "none");
            $(".hidden-depende-modelo-jetski").css("display", "none");
            $("#modelo-embarcacao").val("");
            return false;
        }

        $.ajax({
            url: Yii.app.createUrl('utils/loadModelosEmbarcacoes'),
            data: {embarcacao_fabricantes_id: embarcacao_fabricantes_id},
            type: 'POST',
            success: function (response) {


                $("#modelo-embarcacao").html("");

                if (response != "-1") {

                    var modelos = JSON.parse(response.trim());

                    $("#modelo-embarcacao").append('<option selected="selected" value="">Selecione</option>').trigger('create');


                    for (var i = 0; i < modelos.length; i++) {
                        var option = $('<option value="' + modelos[i].id + '">' + modelos[i].titulo + '</option>');
                        $("#modelo-embarcacao").append(option).trigger("create");

                    }

                    $("#modelo-embarcacao").prop("disabled", false);
                    $("#n-encontrou-modelo-fabricante").prop("disabled", false);


                }



            }
        });

    });

    var flgMarcouFoto = false;

    // checkboxes dos turbinados
    $(".recursos-adicionais").on('change', function () {

        // valor do turbinado escolhido
        var valor = parseFloat($(this).attr("data-valor"));

        // valor total turbinada
        var valor_total_turbinada = parseFloat($("#valor-total-turbinada").val());

        // valor do anúncio
        var valor_anuncio = parseFloat($("#valor-anuncio-hidden").val());

        // checar se foi marcada
        if ($(this).attr("checked")) {

            // marcou fotos
            if ($(this).attr("data-attribute") == 'fotos') {
                $("#div-turbo-fotos").fadeIn("slow");
                flgMarcouFoto = true;
            }

            // marcou video
            if ($(this).attr("data-attribute") == 'video') {
                $("#Embarcacoes_video").prop("disabled", false);
                $("#div-video").fadeIn("slow");
            }

            // marcou titulo
            if ($(this).attr("data-attribute") == 'titulo') {
                $("#embarcacoes-titulo").prop("disabled", false);
                $("#div-titulo").fadeIn("slow");
            }

            // marcou destaque na busca
            if ($(this).attr("data-attribute") == 'destaque_busca') {
                $("#periodo-destaque").prop("disabled", false);
                $("#qtde-impressoes").prop("disabled", false);
            }

            // marcou cpm
            if ($(this).attr("data-attribute") == 'cpm') {

                //$("#div-periodo-impressoes").fadeIn("fast");
                $("#div-limite-impressoes").fadeIn("fast");

                // calcular a quantidade de meses do cpm de acordo com o anuncio
                var limite = $("#duracaomeses").val();

                if (flgCpm == 0) {
                    for (var i = 0; i < limite; i++) {

                        var option;

                        if (i == 0) {
                            option = $('<option selected="selected" value="1">1 Mês</option>');
                        }
                        else {
                            option = $('<option value="' + (i + 1) + '">' + (i + 1) + ' Meses</option>');
                        }

                        $("#periodo-impressoes").append(option).trigger("create");
                    }
                    flgCpm = 1;
                }

            }

            // somatizar valor da turbinada
            valor_total_turbinada += valor;

            // variavel que vai conter o valor total (anuncio + turbo)
            var valor_total_anuncio = valor_anuncio + valor_total_turbinada;

            // atualizar campo hidden com valor da turbinada
            $("#valor-total-turbinada").val(valor_total_turbinada);

            $("#valor-total, .text-cadastro-lh4").text(numeral(valor_total_anuncio).format('0,0.00'));
            $("#valor-turbinada").text(numeral(valor_total_turbinada).format('0,0.00'));

        }

        else {

            // desmarcou fotos
            if ($(this).attr("data-attribute") == 'fotos') {
                $("#div-turbo-fotos").fadeOut("slow");
            }

            // desmarcou video
            if ($(this).attr("data-attribute") == 'video') {
                $("#Embarcacoes_video").prop("disabled", true);
                $("#Embarcacoes_video").val("");
                $("#div-video").fadeOut("slow");
            }

            // desmarcou titulo
            if ($(this).attr("data-attribute") == 'titulo') {
                $("#embarcacoes-titulo").val("");
                $("#div-titulo").fadeOut("slow");
            }

            // desmarcou cpm
            if ($(this).attr("data-attribute") == 'cpm') {

                //$("#div-periodo-impressoes").fadeOut("fast");
                $("#div-limite-impressoes").fadeOut("fast");
            }


            // subtrair valor da turbinada
            valor_total_turbinada -= valor;

            // variavel que vai conter o valor total (anuncio + turbo)
            var valor_total_anuncio = valor_anuncio + valor_total_turbinada;

            // atualizar campo hidden com valor da turbinada
            $("#valor-total-turbinada").val(valor_total_turbinada);

            $("#valor-total, .text-cadastro-lh4").text(numeral(valor_total_anuncio).format('0,0.00'));
            $("#valor-turbinada").text(numeral(valor_total_turbinada).format('0,0.00'));

        }

    });

    // alterar valor da turbo de CPM de acordo com o periodo
    $("#qtde-impressoes").on("change", function () {

        var qtdeimpressoes = $(this).val();

        if (isNaN(qtdeimpressoes)) {
            //$("#div-periodo-impressoes").fadeOut("slow");
            $("#div-limite-impressoes").fadeOut("slow");
            return false;
        }

        // calcular valor do cpm (DEIXAR ESSES)
        var valor = (qtdeimpressoes / 1000) * 9.90;
        //var valor = 99.00;

        // dar update no campo que vai guardar o valor do turbo de cpm
        $("#hidden-valor-cpm").attr("value", valor);

        $("#bold-valor-cpm").html(' (R$ ' + numeral(valor).format('0,0.00') + ')');

        $("#check-cpm").trigger("click");

        $("#check-cpm").attr("data-valor", valor);

        $("#check-cpm").trigger("click");

    });

    $("#modelo-embarcacao").on("change", function () {

        $('.group-none').show();

        $("#error-modelo").empty();
        $(".line-cadastro-15").fadeIn("fast");
        $(".combustivel").remove();

        // ao selecionar o modelo, devemos buscar o tipo, tamanho e num de passageiros (dia e noite)
        // da embarcação, passando o ID do modelo da embarcação
        var id_modelo_embarc = $(this).val();

        if (id_modelo_embarc == "") {
            $(".hidden-depende-modelo").css("display", "none");
            $("#modelo-embarcacao").val("");
            return false;
        }

        $("#Embarcacoes_tipo").prop("disabled", true);
        $("#Embarcacoes_tamanho").prop("disabled", true);
        $("#Embarcacoes_dia").prop("disabled", true);
        $("#Embarcacoes_noite").prop("disabled", true);


        // listar todos os tipos de embarcs cadastrados para que ele possa associar ao modelo
        // que nao existe

        $.ajax({
            url: Yii.app.createUrl('utils/loadTipoTamanhoNumPassageiros'),
            type: 'POST',
            data: {id_modelo_embarc: id_modelo_embarc},
            success: function (resp) {

                var modelo_embarc = JSON.parse(resp.trim());

                if (resp != "-1") {
                    // ver se é do tipo jetski
                    if (macro == 1) {

                        var motor_de_fabrica = modelo_embarc.motor_de_fabrica;
                        if (motor_de_fabrica == "" || motor_de_fabrica == 0.00 || motor_de_fabrica == 0) {
                            $("#Embarcacoes_motor_de_fabrica").attr("value", "Não definido");
                        }
                        else {
                            $("#Embarcacoes_motor_de_fabrica").attr("value", motor_de_fabrica);
                        }
                        // limpar div do tipo
                        $("#tipo-jetski").html("");

                        $("#tipo-jetski").append(modelo_embarc.tipo);
                        $('#tipo-jetski').addClass('text-cadastro-green-ajax');
                        $(".hidden-depende-modelo-jetski").show("slow");

                    }

                    // não é do tipo jetski
                    else {


                        // habilitar motor
                        $("#div-motor").fadeIn("slow");

                        // campos anuncio normal
                        var tamanho = modelo_embarc.tamanho;
                        var tipo = modelo_embarc.tipo;
                        var dia = modelo_embarc.dia;
                        var noite = modelo_embarc.noite;

                        $("#Embarcacoes_tipo").attr("value", tipo);
                        $("#Embarcacoes_tamanho").attr("value", tamanho);
                        $("#Embarcacoes_dia").attr("value", dia);
                        $("#Embarcacoes_noite").attr("value", noite);

                        // campos para estaleiro
                        var boca = modelo_embarc.boca;
                        var calado = modelo_embarc.calado;
                        var pedireito = modelo_embarc.pedireito;
                        var tanqueagua = modelo_embarc.tanqueagua;
                        var tanquecombustivel = modelo_embarc.tanquecombustivel;
                        var ncamarotes = modelo_embarc.ncamarotes;
                        var pesocasco = modelo_embarc.pesocasco;
                        var nbanheiros = modelo_embarc.nbanheiros;

                        // estaleiro
                        $("#boca").attr("value", boca);
                        $("#calado").attr("value", calado);
                        $("#tanqueagua").attr("value", tanqueagua);
                        $("#pedireito").attr("value", pedireito);
                        $("#ncamarotes").attr("value", ncamarotes);
                        $("#nbanheiros").attr("value", nbanheiros);
                        $("#tanquecombustivel").attr("value", tanquecombustivel);
                        $("#pesocasco").attr("value", pesocasco);
                        $("#pesocasco").prop("disabled", true);

                        $(".hidden-depende-modelo").show("slow");
                        $('.line-cadastro-15').show();

                    }

                }

            },
            error: function (x, h, err) {
                alert(JSON.stringify(err))
            }
        });
    });


    // não encontrou fabricante
    $("#n-encontrou-fabricante").on("change", function () {

        $("#div-n-encontrou-fabricante").fadeOut("fast");

        $(".line-cadastro-15").fadeIn("fast");

        // selecionou
        if ($(this).attr("checked")) {

            $("#n-encontrou-modelo-fabricante").prop('checked', true);
            $("#n-encontrou-modelo-fabricante").trigger('change');
            $("#input-fabricante").removeClass('select-form-cadastrar3');
            $("#input-fabricante").addClass('campo-form-cadastro2');
            $("#Embarcacoes_motor_de_fabrica").prop("disabled", false);

            $("#div-editar-dados").fadeOut("fast");
            $("#div-editar-dados-jetski").fadeOut("fast");

            $("#fabricante-embarcacao").replaceWith(function () {
                return '<input class="font-form" type="text" id="fabricante-embarcacao" name="EmbarcacaoFabricantes[titulo]"/>';
            });

            $("#n-achou-fabricante").show("slow");
            $("#hidden-depende-fabricante").show("slow");
        }

        // deselecionou
        else {
            location.reload();
        }
    });


    // ao selecionar que não foi encontrado o modelo de fabricante
    // devemos abrir um campo de texto para o usuário entrar com o modelo ou fabricante
    $("#n-encontrou-modelo-fabricante").on("change", function () {

        $(".line-cadastro-15").fadeIn("fast");

        $("#div-n-encontrou-modelo-fabricante").fadeOut("fast");

        if ($(this).attr("checked")) {

            $("#input-modelo").removeClass('select-form-cadastrar3');
            $("#input-modelo").addClass('campo-form-cadastro2');

            $("#div-editar-dados").fadeOut("fast");
            $("#div-editar-dados-jetski").fadeOut("fast");

            $("#modelo-embarcacao").replaceWith(function () {
                return '<input class="font-form" type="text" id="modelo-embarcacao" name="Embarcacoes[modelo-nao-tinha]"/>';
            });


            // listar todos os tipos de embarcs cadastrados para que ele possa associar ao modelo
            // que nao existe

            $.ajax({
                url: Yii.app.createUrl('utils/loadTiposEmbarcacao'),
                data: {embarcacao_macros_id: macro},
                type: 'POST',
                success: function (resp) {

                    if (resp != "-1") {

                        var tipos = JSON.parse(resp.trim());

                        var select = $('<select name="Embarcacoes[tipo]" id="embarcacoes_tipo"></select>');
                        var optionSelected = $('<option value="null" selected="selected">Selecione</option>');
                        select.append(optionSelected);

                        for (var i = 0; i < tipos.length; i++) {
                            var option = $('<option value="' + tipos[i].id + '">' + tipos[i].titulo + '</option>');
                            select.append(option);
                        }


                        // jetski
                        if (macro == 1) {
                            $("#tipo-jetski").html("");
                            $("#tipo-jetski").append('<span class="text-cadastro-green3">Tipo:</span>');
                            $("#tipo-jetski").append(select).trigger('create');
                        }

                        // n jetski
                        else {

                            // dar um empty n div do campo de tipo e substituir por um <select> com
                            // todos os tipos cadsatrados

                            $("#div-embarcacoes-tipo").empty();
                            $("#div-embarcacoes-tipo").removeClass('campo-form-cadastro2');
                            $("#div-embarcacoes-tipo").addClass('select-form-cadastrar8');
                            $("#div-embarcacoes-tipo").append(select).trigger('create');
                        }


                    }

                },
                error: function (x, xhz, err) {
                    //alert(JSON.stringify(err)); 
                    alert("Ocorreu um erro inesperado");
                }
            });




            // mostrar a div com as infos que estava com display none 
            // ver se é jetski
            if (macro == 1) {

                $(".hidden-depende-modelo-jetski").show("slow");
                $("#Embarcacoes_motor_de_fabrica").prop("disabled", false);
                $('.line-cadastro-7').fadeOut("fast");

            }
            else {
                $(".hidden-depende-modelo").show("slow");


                // anuncio normal
                $("#Embarcacoes_tipo").prop("disabled", false);
                $("#Embarcacoes_tamanho").prop("disabled", false);
                $("#Embarcacoes_dia").prop("disabled", false);
                $("#Embarcacoes_noite").prop("disabled", false);



                // estaleiro
                if (flgEstaleiro == 1) {
                    $("#boca").prop("disabled", false);
                    $("#calado").prop("disabled", false);
                    $("#tanqueagua").prop("disabled", false);
                    $("#pedireito").prop("disabled", false);
                    $("#ncamarotes").prop("disabled", false);
                    $("#nbanheiros").prop("disabled", false);
                    $("#tanquecombustivel").prop("disabled", false);
                }
            }

        }

        else {
            location.reload();
        }
    });



    $(".modelo-motor").on("change", function () {

        var id_modelo_motor = $(this).val();

        // base url


        if (id_modelo_motor != "") {

            $.ajax({
                url: Yii.app.createUrl('utils/loadPotenciaTipoMotor'),
                type: 'POST',
                data: {id_modelo_motor: id_modelo_motor},
                success: function (resp) {

                    if (resp != "-1") {

                        // recebe tipo e potencia do modelo de motor em questao
                        var potenciaTipo = JSON.parse(resp.trim());

                        // colocar o valor da potencia
                        $("#Embarcacoes_motor_potencia").val(potenciaTipo.potencia);

                        // colocar o valor do tipo do motor
                        $("#Embarcacoes_motor_tipo").val(potenciaTipo.tipo);
                    }

                },
                error: function (xhz, e, errorMessage) {
                    alert(JSON.stringify(errorMessage));
                }
            });
        }

        else {
            // aqui o campo de modelo de motor não possui valor, portanto vamos "limpar" os campos de potencia e tipo
            $("#Embarcacoes_motor_marca").val("");
            $("#Embarcacoes_motor_potencia").empty();
            //$("#Embarcacoes_motor_potencia").append('<option selected="selected">Selecione</option>').trigger('create');
            $("#Embarcacoes_motor_tipo").empty();
            $("#Embarcacoes_motor_tipo").append('<option selected="selected">Selecione</option>').trigger('create');
        }
    });

    $("#Embarcacoes_motor_marca").on("change", function () {

        var motor_fabricantes_id = $(this).val();

        $.ajax({
            url: Yii.app.createUrl('utils/loadMotorModelos'),
            type: 'post',
            data: {
                motor_fabricantes_id: motor_fabricantes_id
            },
            success: function (resp) {

                var modelosMotor = JSON.parse(resp.trim());

                $("#Embarcacoes_motor_modelo").empty();
                var option = $('<option selected="selected" value="">Selecione</option>');
                $("#Embarcacoes_motor_modelo").append(option).trigger("create");
                for (var i = 0; i < modelosMotor.length; i++) {

                    var potencia = "";
                    if(modelosMotor[i].potencia != null) {
                        potencia = " - "+modelosMotor[i].potencia;
                        if(potencia.indexOf("HP") == -1) {
                            potencia += " HP";    
                        }
                        
                    }
                    var option = $('<option value="' + modelosMotor[i].id + '">' + modelosMotor[i].titulo + potencia + '</option>');
                    $("#Embarcacoes_motor_modelo").append(option).trigger("create");
                }
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro por favor tenta mais tarde.")
            }
        });
    });

    $("#Embarcacoes_motor_marca").on("change", function () {

        // alteração 07/10/2014 17:35
        if ($(this).val() == "") {
            $("#Embarcacoes_motor_modelo").empty();
        }
        //

        $("#Embarcacoes_motor_potencia").empty();
        //$("#Embarcacoes_motor_potencia").append('<option selected="selected">Selecione</option>').trigger('create');
        $("#Embarcacoes_motor_tipo").empty();
        $("#Embarcacoes_motor_tipo").append('<option selected="selected">Selecione</option>').trigger('create');

    });


    $("#check-nao-tem-motor").on("change", function () {

        $("#error-motor").empty();

        var check = $(this).attr("checked");

        // marcou que nao tem motor
        if (check) {
            // desativar campos de motor
            $("#qnt-motores").prop("disabled", true);

            $(".motor_fabricante").val('');
            $(".motor_fabricante").prop("disabled", true);

            $(".modelo-motor").val('');
            $('.modelo-motor').prop('disabled', true);

            $('.motor_tipo').val('');
            $('.motor-potencia').val('');
            $('.motor-horas').val('');
            $('.motor-horas').prop('disabled', true);

            $("#hidden-nao-tem-motor").attr("value", 0);
            $("#qnt-motores").val("");

        }

        else {
            // habilitar

            $("#hidden-nao-tem-motor").attr("value", 1);

            $(".motor_fabricante").prop("disabled", false);
            $('.modelo-motor').prop('disabled', false);

            $('.motor-horas').prop('disabled', false);

            $("#qnt-motores").prop('disabled', false);
        }
    });


    // não achou marca do motor
    $("#n-encontrou-marca-motor").on("change", function () {

        $("#div-check-n-achou-marca-motor").fadeOut("fast");
        $("#div-check-n-achou-modelo-motor").fadeOut("fast");

        $("#div-potencia-motor").css("border", "0px none");

        if ($(this).attr("checked")) {


            $("#Embarcacoes_motor_marca").replaceWith(function () {
                return '<input type="text" name="MotorFabricantes[titulo]" id="motor-fabricante-titulo"/>';
            });

            $("#Embarcacoes_motor_modelo").replaceWith(function () {
                return '<input type="text" name="MotorModelos[titulo]" id="motor-modelo-titulo"/>';
            });

            $("#Embarcacoes_motor_potencia").replaceWith(function () {
                return '<input type="text" name="MotorModelos[potencia]" id="motor-modelo-potencia"/>';
            });

            // ajax carregar tipos de motor

            $.ajax({
                url: Yii.app.createUrl('utils/loadTiposMotor'),
                data: {},
                type: 'POST',
                success: function (resp) {

                    var tiposMotor = JSON.parse(resp.trim());

                    var selectTiposMotor = $('<select name="MotorModelos[motor_tipos_id]" id="motor-modelos-tipo-id"></select>');

                    for (var i = 0; i < tiposMotor.length; i++) {

                        var option = $('<option value="' + tiposMotor[i].id + '">' + tiposMotor[i].titulo + '</option>');
                        selectTiposMotor.append(option);
                    }

                    // transformar input text do tipo do motor em um select contendo os tipos
                    $("#Embarcacoes_motor_tipo").replaceWith(function () {
                        return selectTiposMotor;
                    });



                },
                error: function () {

                    alert("Ocorreu um erro inesperado");
                }
            });

            $("#Embarcacoes_motor_tipo").prop("disabled", false);
            $("#Embarcacoes_motor_horas").prop("disabled", false);
            $("#Embarcacoes_motor_potencia").prop("disabled", false);
            $("#Embarcacoes_motor_potencia").val("");

        }

        else {
            // por enquanto
            location.reload();
        }

    });

    // não achou modelo do motor
    $("#n-encontrou-modelo-motor").on("change", function () {

        $("#div-potencia-motor").css("border", "0px none");

        $("#div-check-n-achou-modelo-motor").fadeOut("fast");

        // não achou o modelo do motor
        if ($(this).attr("checked")) {


            $("#Embarcacoes_motor_modelo").replaceWith(function () {
                return '<input type="text" name="MotorModelos[titulo]" id="motor-modelo-titulo"/>';
            });

            // ajax carregar tipos de motor

            $.ajax({
                url: Yii.app.createUrl('utils/loadTiposMotor'),
                data: {},
                type: 'POST',
                success: function (resp) {

                    var tiposMotor = JSON.parse(resp.trim());

                    var selectTiposMotor = $('<select name="MotorModelos[motor_tipos_id]" id="motor-modelos-tipo-id"></select>');

                    for (var i = 0; i < tiposMotor.length; i++) {

                        var option = $('<option value="' + tiposMotor[i].id + '">' + tiposMotor[i].titulo + '</option>');
                        selectTiposMotor.append(option);
                    }

                    // transformar input text do tipo do motor em um select contendo os tipos
                    $("#Embarcacoes_motor_tipo").replaceWith(function () {
                        return selectTiposMotor;
                    });



                },
                error: function () {

                    alert("Ocorreu um erro inesperado");
                }
            });

            $("#Embarcacoes_motor_horas").prop("disabled", false);
            $("#Embarcacoes_motor_potencia").prop("disabled", false);
            $("#Embarcacoes_motor_potencia").val("");

        }

        else {

            // por enquanto
            location.reload();
        }
    });

    $("#Embarcacoes_motor_potencia").keyup(function () {
        $('#Embarcacoes_motor_potencia').val($(this).val().replace(/[^0-9\.]/g, ''));
    });


    $("#motor-modelo-potencia").keyup(function () {
        $("#motor-modelo-potencia").val($(this).val().replace(/[^0-9\.]/g, ''));
    });

    // marcou que quer editar os dados do modelo da embarcação
    $("#check-editar-dados, #check-editar-dados-jetski").on("change", function () {



        $("#div-editar-dados").fadeOut("fast");
        $("#div-editar-dados-jetski").fadeOut("fast");

        // habilitar campos do modelo da embarcação para que o usuario
        // possa editar
        if ($(this).attr("checked")) {

            // listar todos os tipos de embarcs cadastrados para que ele possa associar ao modelo
            // que nao existe
            $.ajax({
                url: Yii.app.createUrl('utils/loadTiposEmbarcacao'),
                data: {embarcacao_macros_id: macro},
                type: 'POST',
                success: function (resp) {

                    if (resp != "-1") {

                        var tipos = JSON.parse(resp.trim());

                        var select = $('<select name="EmbarcacaoModelosEditavel[embarcacao_tipos_id]" id="embarcacoes_tipo"></select>');

                        var optionSelected = $('<option value="" selected="selected">Selecione</option>');
                        select.append(optionSelected);

                        for (var i = 0; i < tipos.length; i++) {
                            var option = $('<option value="' + tipos[i].id + '">' + tipos[i].titulo + '</option>');
                            select.append(option);
                        }

                        // dar um empty n div do campo de tipo e substituir por um <select> com
                        // todos os tipos cadsatrados

                        if (macro != 1) {


                            $("#div-embarcacoes-tipo").empty();
                            $("#div-embarcacoes-tipo").removeClass('campo-form-cadastro2');
                            $("#div-embarcacoes-tipo").addClass('select-form-cadastrar8');
                            $("#div-embarcacoes-tipo").append(select).trigger('create');
                        }
                        else {

                            $("#tipo-jetski").empty();
                            $("#tipo-jetski").append('<span class="text-cadastro-green3 text-cadastro-green3b">Tipo:</span>');
                            $("#tipo-jetski").append(select).trigger('create');
                        }


                    }


                },
                error: function (x, xhz, err) {
                    alert(JSON.stringify(err));
                }
            });

            // verificar macro
            if (macro != 1) {

                // alterar nomes
                $("#Embarcacoes_tamanho").attr("name", "EmbarcacaoModelosEditavel[tamanho]");
                $("#Embarcacoes_dia").attr("name", "EmbarcacaoModelosEditavel[passageiros]");
                $("#Embarcacoes_noite").attr("name", "EmbarcacaoModelosEditavel[acomodacoes]");

                $("#calado").attr("name", "EmbarcacaoModelosEditavel[calado]");
                $("#boca").attr("name", "EmbarcacaoModelosEditavel[boca]");
                $("#pedireito").attr("name", "EmbarcacaoModelosEditavel[pedireito]");
                $("#tanqueagua").attr("name", "EmbarcacaoModelosEditavel[tanqueagua]");
                $("#ncamarotes").attr("name", "EmbarcacaoModelosEditavel[ncamarotes]");
                $("#tanquecombustivel").attr("name", "EmbarcacaoModelosEditavel[tanquecombustivel]");
                $("#nbanheiros").attr("name", "EmbarcacaoModelosEditavel[nbanheiros]");
                $("#pesocasco").attr("name", "EmbarcacaoModelosEditavel[pesocasco]");

                // desabilitar
                $("#Embarcacoes_tamanho").prop("disabled", false);
                $("#Embarcacoes_dia").prop("disabled", false);
                $("#Embarcacoes_noite").prop("disabled", false);

                // campos estaleiro
                if (flgEstaleiro == 1) {
                    $("#calado").prop("disabled", false);
                    $("#tanqueagua").prop("disabled", false);
                    $("#pedireito").prop("disabled", false);
                    $("#boca").prop("disabled", false);
                    $("#tanqueagua").prop("disabled", false);
                    $("#ncamarotes").prop("disabled", false);
                    $("#tanquecombustivel").prop("disabled", false);
                    $("#nbanheiros").prop("disabled", false);
                    $("#pesocasco").prop("disabled", false);
                }

            } // if macro
            else {

                // jetski
                $("#Embarcacoes_motor_de_fabrica").prop("disabled", false);
                $("#Embarcacoes_motor_de_fabrica").attr("name", "EmbarcacaoModelosEditavel[motor_de_fabrica]");

            }


        }

        // travar campos
        else {

            if (macro != 1) {
                $("#Embarcacoes_dia").prop("disabled", true);
                $("#Embarcacoes_noite").prop("disabled", true);
                $("#Embarcacoes_tamanho").prop("disabled", true);
                $("#embarcacoes_tipo").prop("disabled", true);
            }

            else {

                $("#Embarcacoes_motor_de_fabrica").prop("disabled", true);
            }

        }
    });




// ================= VALIDAÇÃO AO DAR SUBMIT NO FORM ==============================

    // ajax validação do form
    $('.botao-cadastro-2').on("click", function (e) {
        e.preventDefault();

        var $this = $(this);

        if ($(this).data('outro-anuncio') == 1) {
            var hidden = $('<input type="hidden" name="outro-anuncio" id="outro-anuncio"/>');
            $("#div-campos-hidden").append(hidden).trigger("create");
        }

        $('.errorMessage').each(function () {
            $(this).empty();
        });

        var email = $("#Embarcacoes_email").val();
        var uf = $("#Embarcacoes_estados_id").val();
        var cidade = $("#Embarcacoes_cidades_id").val();
        var fabricante = $("#fabricante-embarcacao").val();
        var modelo = $("#modelo-embarcacao").val();
        var ano = $("#Embarcacoes_ano").val();
        var check_valor = $("#check-valor").val();
        var valor = $("#Embarcacoes_valor").val();

        var flgMarcouMacro = false;
        var flgMarcouEstado = false;

        var flgValidacaoOK = true;

        $('.Embarcacao-macros-id').each(function () {
            if ($(this).attr("checked")) {
                flgMarcouMacro = true;
            }
        });

        $('.estado').each(function () {
            if ($(this).attr("checked")) {
                flgMarcouEstado = true;
            }
        });

        // ver se marcou o termo de condição
        /*if(!$("#check-termos-condicao").attr("checked")) {
         flgValidacaoOK = false;
         $("#error-termo").html("Favor aceite os termos de condição");
         }*/

         // div do topo que possui msg de erro
         $("#erro_topo").html("");

         if( (valor == "" || valor == "0,00") && (check_valor == "0") ) {
            adicionarMsgErroTopo("Preencha o valor do anúncio (Anúncios sem valor tem menos prioridade na busca)");
            flgValidacaoOK = false;
         }

        // Se não selecionou marca ou modelos do motor, e não vai cadastrar um motor novo
        if (!$("#check-nao-tem-motor").attr("checked") && macro != 1 && ($("#Embarcacoes_motor_marca").val() == "" || $("#Embarcacoes_motor_modelo").val() == "")) {
            $("#error-motor").html("Por favor indique se há motor ou não");
            adicionarMsgErroTopo("Indique se há motor ou não");
            flgValidacaoOK = false;
        }

        if ($("#n-encontrou-fabricante").attr("checked")) {

            var nome_fabricante = $("#fabricante-embarcacao").val();

            if (!nome_fabricante) {
                $("#error-fabricante").html("Favor preencha o nome do fabricante");
                adicionarMsgErroTopo("Preencha o nome do fabricante");
                flgValidacaoOK = false;
            }

            // validar se nome já existe
            else {
                // ajax validar se nome do fab ja existe...
                /*$.ajax({
                 url: Yii.app.createUrl('embarcacaoFabricantes/validarNomeFabricante'),
                 data: { nomeFabricante: nome_fabricante },
                 type: 'post',
                 
                 success: function(resp) {
                 // fab ja existe, retornar erro
                 if(resp == '1') {
                 flgValidacaoOK = false;
                 $("#error-fabricante").html("Fabricante já existe!");
                 }
                 }, 
                 
                 error: function(x, h, z) {
                 alert(JSON.stringify(z));
                 }
                 });*/
            }

            $("#fabricante-embarcacao").on("change", function () {
                $("#error-fabricante").empty();
            });

        }

        // marcou para editar dados, logo o tipo da embarcacao deve ser obrigatorio
        if ($("#check-editar-dados").attr("checked")) {

            if ($("#embarcacoes_tipo").val() == "") {
                $("#error-tipo").html("Selecione o tipo");
                adicionarMsgErroTopo("Selecione o tipo");
                flgValidacaoOK = false;
            }

            $("#embarcacoes_tipo").on("change", function () {
                $("#error-tipo").empty();
            });
        }

        // marcou que não achou o modelo do fabricante da embarc
        if ($("#n-encontrou-modelo-fabricante").attr("checked") && macro != 1) {

            var modelo_embarcacao = $("#modelo-embarcacao").val();
            var tamanho = $("#Embarcacoes_tamanho").val();
            var embarcacoes_tipo = $("#embarcacoes_tipo").val();
            var pass_dia = $("#Embarcacoes_dia").val();
            var pass_noite = $("#Embarcacoes_noite").val();
            var fabricante = $("#fabricante-embarcacao").val();

            if (!modelo_embarcacao) {
                $("#error-modelo").html("Favor inserir modelo da embarcação");
                adicionarMsgErroTopo("Insira o modelo da embarcação");
                flgValidacaoOK = false;
            }

            else {
                // ajax validar se nome do modelo ja existe...
                /*$.ajax({
                 url: Yii.app.createUrl('embarcacaoModelos/validarNomeModelo'),
                 data: { nomeModelo: modelo_embarcacao, fabricante: fabricante },
                 type: 'post',
                 
                 success: function(resp) {
                 
                 // modelo ja existe, retornar erro
                 if(resp == '1') {
                 flgValidacaoOK = false;
                 $("#error-modelo").html("Modelo já existe!");
                 }
                 }, 
                 
                 error: function(x, h, z) {
                 alert("Ocorreu um erro inesperado. Tente novamente mais tarde!");
                 }
                 });*/
            }

            if (embarcacoes_tipo == "null" || !embarcacoes_tipo) {
                $("#error-tipo").html("Favor inserir tipo da embarcação");
                adicionarMsgErroTopo("Insira o tipo");
                flgValidacaoOK = false;
            }

            // retirar msgs de erro ao passo que o usuario vai inserindo os dados
            $("#embarcacoes_tipo").on("change", function () {
                $("#error-tipo").empty();
            });

            $("#modelo-embarcacao").on("change", function () {
                $("#error-modelo").empty();
            });
        }

        // marcou que nao achou o modelo do motor da embarc
        if ($("#n-encontrou-modelo-motor").attr("checked")) {

            var modelo_motor = $("#motor-modelo-titulo").val();
            var tipo_motor = $("#motor-modelos-tipo-id").val();
            var motor_marca = $("#Embarcacoes_motor_marca").val();


            if (modelo_motor == "") {
                $("#error-motor-modelo").html("Selecione o modelo do motor");
                adicionarMsgErroTopo("Selecione o modelo do motor");
                flgValidacaoOK = false;
            }

            if (tipo_motor == "") {
                $("#error-motor-tipo").html("Selecione o tipo do motor");
                adicionarMsgErroTopo("Selecione o tipo do motor");
                flgValidacaoOK = false;
            }

            if (motor_marca == "") {
                $("#error-motor-marca").html("Selecione a marca do motor");
                adicionarMsgErroTopo("Selecione a marca do motor");
                flgValidacaoOK = false;
            }
        }

        if ($("#n-encontrou-marca-motor").attr("checked") && !$("#check-nao-tem-motor").attr("checked")) {

            var motor_marca = $("#motor-fabricante-titulo").val();
            var motor_modelo = $("#motor-modelo-titulo").val();

            if (!motor_marca) {
                $("#error-motor-marca").html("Insira a marca do motor");
                adicionarMsgErroTopo("Selecione a marca do motor");
                flgValidacaoOK = false;
            }

            if (!motor_modelo) {
                $("#error-motor-modelo").html("Insira o modelo do motor");
                adicionarMsgErroTopo("Selecione o tipo do motor");
                flgValidacaoOK = false;
            }
        }

        if (email == "" && flgEstaleiro == 0) {
            $("#error-email").html("Insira um email válido");
            adicionarMsgErroTopo("Insira um e-mail válido");
            flgValidacaoOK = false;

        }

        if (!uf && flgEstaleiro == 0) {

            $("#error-uf").html("Favor preencher o Estado");
            adicionarMsgErroTopo("Selecione o estado");
            flgValidacaoOK = false;

        }

        if ((cidade == 'empty' || cidade == "") && flgEstaleiro == 0) {

            $("#error-cidade").html("Favor preencher a cidade");
            adicionarMsgErroTopo("Selecione a cidade");
            flgValidacaoOK = false;


        }

        if (flgMarcouMacro == false) {
            $("#error-macro").html("Favor selecione uma categoria");
            adicionarMsgErroTopo("Selecione a categoria");
            flgValidacaoOK = false;


        }

        if (flgMarcouEstado == false && flgEstaleiro == 0) {
            $("#error-estado").html("Favor selecionar o estado da embarcação");
            adicionarMsgErroTopo("Selecione o estado da embarcação");
            flgValidacaoOK = false;

        }

        if (!ano && flgEstaleiro == 0) {
            $("#error-ano").html('Selecione o ano');
            adicionarMsgErroTopo("Selecione o ano");
            flgValidacaoOK = false;

        }

        if (!fabricante) {
            $("#error-fabricante").html("Favor selecione o fabricante");
            adicionarMsgErroTopo("Selecione o fabricante");
            flgValidacaoOK = false;


        }

        if (!modelo) {              
            $("#error-modelo").html("Favor selecione o modelo");
            adicionarMsgErroTopo("Selecione o modelo");
            flgValidacaoOK = false;
        }

        // testar se a flag que indica que as validações foram ok está true
        if (flgValidacaoOK && flgValidacaoFotos) {

            if ($(this).attr("id") != "btn-outro-anuncio") {

                if (flgEstaleiro == 0) {

                    $('#lbox-revise').lightbox_me({
                        centered: true,
                        onLoad: function() {
                            $('html, body').animate({scrollTop: 50}, 'slow');
                        },
                        onClose: function() {
                        }
                    });
                    
                }

                // eh estaleiro
                else {
                    // está ok, vamos dar submit no form
                    $('.preloader').show();
                    
                    if($(".cancelar-foto-normal").length > 0) {
                        $("#uploader").fineUploader("uploadStoredFiles");    
                    }

                    $("#embarcacoes-form").submit();
                }

            }

            // proximo anuncio
            else {
                $('.preloader').show();

                if($(".cancelar-foto-normal").length > 0) {
                    $("#uploader").fineUploader("uploadStoredFiles");    
                }

                if($(".cancelar-foto-turbo").length > 0 && flgMarcouFoto == true) {
                    $("#uploader-turbo").fineUploader("uploadStoredFiles");  
                }

                $("#embarcacoes-form").submit();
            }


        }

        // erro na validação, printar mensagens
        else {
            $('html, body').animate({scrollTop: 200}, 'slow');
        }
    });


    $("#revisar-btn").on("click", function() {
        $('html, body').animate({scrollTop: 200}, 'slow');
    });

    $("#finalizar-btn").on("click", function() {


        // está ok, vamos dar submit no form
        $('.preloader').show();

        if($(".cancelar-foto-normal").length > 0) {
            $("#uploader").fineUploader("uploadStoredFiles");    
        }

        if($(".cancelar-foto-turbo").length > 0 && flgMarcouFoto == true) {
            $("#uploader-turbo").fineUploader("uploadStoredFiles");  
        }

        if(getUrlParameter("individual") == 1) {

            ga('send', 'event', 'link', 'click', 'Cadastro Anuncio Gratis');

        }

        else {
            ga('send', 'event', 'link', 'click', 'Cadastro Anuncio Pago');

        }

        $("#embarcacoes-form").submit();
    });

    // retirar msgs de erro ao selecionar os campos
    $("#Embarcacoes_estados_id").on("change", function () {
        $("#error-uf").empty();
    });

    /*$("#check-termos-condicao").on("change", function(){
     if($(this).attr("checked")) {
     $("#error-termo").html("");
     }
     });*/


    $("#Embarcacoes_cidades_id").on("change", function () {
        $("#error-cidade").empty();
    });

    $('.estado').on("change", function () {
        $("#error-estado").empty();
    });

    $("#Embarcacoes_ano").on("change", function () {
        $("#error-ano").empty();
    });

    $("#Embarcacoes_email").on("change", function () {
        $("#error-email").empty();
    });

    $("#Embarcacoes_motor_marca").on("change", function () {
        $("#error-motor").empty();
        $("#error-motor-marca").empty();
    });

    $("#motor-modelo-titulo").on("change", function () {
        $("#error-motor-modelo").empty();
    });


    // function que valida email
    function checkEmail(email) {
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email)) {
            return false;
        }
        return true;
    }

    function adicionarMsgErroTopo(erro) {

        var msg_erro_corrente = $("#erro_topo").html();

        if(msg_erro_corrente != "") {
            $("#erro_topo").html(msg_erro_corrente+"; "+erro);
        }

        else {
            $("#erro_topo").html(erro);
        }

    }

// ============================================================================================

// ready
});