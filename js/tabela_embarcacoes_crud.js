$(document).ready(function(){


    // selecionou jetski / lancha / veleiro
    $('#macro').on("change", function() {

        $.ajax({

            url: Yii.app.createUrl('utils/loadFabricantesEmbarcacoesTabela'),
            data: { embarcacao_macros_id: $("#macro").val() },
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

                $("#Motor_modelos").empty();
                var option = $('<option selected="selected" value="">Selecione</option>');
                $("#Motor_modelos").append(option).trigger("create");
                for (var i = 0; i < modelosMotor.length; i++) {

                    var potencia = "";
                    if(modelosMotor[i].potencia != null) {
                        potencia = " - "+modelosMotor[i].potencia;
                        if(potencia.indexOf("HP") == -1) {
                            potencia += " HP";    
                        }
                        
                    }
                    var option = $('<option value="' + modelosMotor[i].id + '">' + modelosMotor[i].titulo + potencia + '</option>');
                    $("#Motor_modelos").append(option).trigger("create");
                }
            },
            error: function (x, h, z) {
                alert("Ocorreu um erro por favor tenta mais tarde.")
            }
        });
    });

   


});
