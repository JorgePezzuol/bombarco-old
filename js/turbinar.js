$(document).ready(function() {


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

    $('.hide').css('display', 'none');
    

    $('.img-turbinada2').on("click", function () {

        $(this).next("input[type='file']").trigger("click");

    });

    $('.span-foto-turbinada').on("click", function () {
        $(this).parent().parent().find('.img-turbinada2').trigger("click");
    });

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
    $('.line-cadastro-3 label, .line-cadastro-4 label').on('click', function (e) {
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
    });



        $('input[type=file]').on('change', function () {

                var img = $(this).parent().find("img");
                $(this).parent().find(".div-text2-blue-cadastro-l10").hide();

                // validar imagem (tamanho)
                // input file
                var $this = $(this);

                var fd = new FormData();

                fd.append("imagem", $(this)[0].files[0]);

                //console.log("Imagem: "+$(this)[0].files[0].name);

                readURL(this, img);

                /*$.ajax({
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
                });*/

            });

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


    var flgMarcouFoto = false;
        // checkboxes dos turbinados
    $(".recursos-adicionais").on('change', function () {

        // valor do turbinado escolhido
        var valor = parseFloat($(this).attr("data-valor"));

        // valor total turbinada
        var valor_total_turbinada = parseFloat($("#hidden-valor-total-turbinada").val());

        // checar se foi marcada
        if ($(this).attr("checked")) {

            // marcou fotos
            if ($(this).attr("data-attribute") == 'fotos') {
                flgMarcouFoto = true;    
                $("#div-turbo-fotos").fadeIn("slow");
                
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

                if(limite > 100) {
                    limite = 12;
                }

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

            // atualizar campo hidden com valor da turbinada
            $("#hidden-valor-total-turbinada").val(valor_total_turbinada);
            $("#valor-total-turbinada").text(numeral(valor_total_turbinada).format('0,0.00'));

        }

        else {

            // desmarcou fotos
            if ($(this).attr("data-attribute") == 'fotos') {
                
                //$(this).prev().attr("src", Yii.app.createUrl('img/addfoto.png'));
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

            // atualizar campo hidden com valor da turbinada
            $("#hidden-valor-total-turbinada").val(valor_total_turbinada);
            $("#valor-total-turbinada").text(numeral(valor_total_turbinada).format('0,0.00'));

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
        var valor = qtdeimpressoes * 9.90;

        // dar update no campo que vai guardar o valor do turbo de cpm
        $("#hidden-valor-cpm").attr("value", valor);

        $("#bold-valor-cpm").html(' (R$ ' + numeral(valor).format('0,0.00') + ')');

        $("#check-cpm").trigger("click");

        $("#check-cpm").attr("data-valor", valor);

        $("#check-cpm").trigger("click");

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
        var valor = qtdeimpressoes * 9.90;

        // dar update no campo que vai guardar o valor do turbo de cpm
        $("#hidden-valor-cpm").attr("value", valor);

        $("#bold-valor-cpm").html(' (R$ ' + numeral(valor).format('0,0.00') + ')');

        $("#check-cpm").trigger("click");

        $("#check-cpm").attr("data-valor", valor);

        $("#check-cpm").trigger("click");

    });




        $("#btn-form").on("click", function(e) {

                e.preventDefault();
                var flg = false;

                $(".recursos-adicionais").each(function() {

                        if($(this).attr("checked")) {
                             flg = true;
                        }
                });

                if(flg == true) {

                    if($(".cancelar-foto-turbo").length > 0 && flgMarcouFoto == true) {
                        $("#uploader-turbo").fineUploader("uploadStoredFiles");  
                    }

                    $("#turbinar_embarcacao").submit();
                }

                else {
                    $("#div_erro").show();
                }
                
        });


                        


        $('#uploader-turbo').fineUploader({
            template: 'qq-template-turbo', 
            request: {
                endpoint: Yii.app.createUrl("embarcacoes/uploadFotoAnuncio?turbo=1")
            },
            autoUpload: false,
            validation: {
                allowedExtensions: ['jpeg', 'jpg', 'png'],
                itemLimit: 10,
                minSizeLimit: 1000,
                sizeLimit: 1000000 // 1 Mb
            },
            callbacks: {
            },
        });



// ready
});