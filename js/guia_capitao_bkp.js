 $(document).ready(function() {

        var maskBehavior = function (val) {
     return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options = {onKeyPress: function(val, e, field, options) {
     field.mask(maskBehavior.apply({}, arguments), options);
     }
    };

        $("#telefone").mask(maskBehavior, options);


            $("#msg").css("color", "red");
            $('body').css('background-color','transparent');


            $("#btn-form").on('click', function(e) {
               
                e.preventDefault();
                var flg = false;
                $('input').each(function(i, el){ 
                    if($(this).attr("id") != "telefone") {
                        if($(this).val() == "") {
                            flg = true;
                            $("#msg").text("Por favor preencha os campos corretamente.");
                            return false;
                        }
                    }
                });

                if(flg == false) {

                    

                    $.ajax({
                            url: Yii.app.createUrl('guiaCapitao/create'),
                            type: 'POST',
                            data: {
                                nome: $("#nome").val(),
                                email: $("#email").val(),
                                telefone: $("#telefone").val(),
                                empresa: $("#empresa").val()
                            },
                            success: function(response) {

                                if(response == '1') {
                                    $("#msg").css("color", "#018288");
                                    $("#msg").text("Dados salvos com sucesso!");
                                    $('input').each(function() { 
                                        $(this).val("");
                                    });

                                }

                                // email já existe
                                else if(response == '-2') {
                                     $("#msg").text("E-mail já está em nossa lista!");
                                     return false;
                                }

                                else {
                                     $("#msg").text("Por favor preencha os campos corretamente.");
                                     return false;
                                }
                            },
                            error: function(xhz, error, msgError) {
                                 $("#msg").text("Ocorreu um erro inesperado, tente mais tarde.");
                                     return false;
                            }

                        });
            }
                
            });
        });