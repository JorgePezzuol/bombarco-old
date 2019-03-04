$(document).ready(function () {
    
    /**
     * Valida Email
     * @param  {[type]} email [description]
     * @return {[type]}       [description]
     */
    function validateEmail(email) {

        if(email != "") {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {

                return true;
            }    
        }

        return false;       
    }


    $("#btn-contato-anunciante_principal").on("click", function(e) {

        if($("#email_principal").val() == $("#email_dest").val()) {
            lightBoxMsg("Não é possível enviar uma mensagem a si mesmo");
            return false;
        }

        if(validateEmail($("#email_principal").val() == false)) {
            lightBoxMsg("Favor preencher corretamente o e-mail.");
            return false;    
        }
        
        if($("#celular_principal").val().length < 8) {
            lightBoxMsg("Favor preencher corretamente o número de telefone.");
            return false;
        }

        $.ajax({
            url: Yii.app.createUrl("contatosMotor/enviarMsg"),
            data: $("#form-contato").serialize(),
            type: "POST",
            success: function(resp) {

                if(resp.trim() == "1") {
                    lightBoxMsgSucessoReload("Mensagem enviada com sucesso!");
                    $('#close-form-contato').trigger("click");
                }
                else {
                    lightBoxMsgSucessoReload("Ocorreu uma falha ao enviar a mensagem");
                    $('#close-form-contato').trigger("click");
                }
            },
            error: function(x, h, z) {
                lightBoxMsgSucessoReload("Erro inesperado! Contate o admin do site");
                $('#close-form-contato').trigger("click");
            }
        });


    });





});
