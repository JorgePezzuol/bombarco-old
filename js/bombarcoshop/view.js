$(document).ready(function() {

	$(document).ajaxStart(function () {$('.preloader').show();});
    $(document).ajaxStop(function () {$('.preloader').hide();});

    $("#btn-mailing").on("click", function(e) {
        e.preventDefault();

        var email = $("#email-mailing").val();
        var user_agent = navigator.userAgent;


        if(!email || !validateEmail(email)) {
            $("#email-mailing").val("E-mail inválido!");
        }

        // ok - ajax salvar mail
        else {

            $.ajax({
                url: Yii.app.createUrl('maillings/create'),
                data: {email: email, user_agent: user_agent},
                type: 'post',

                success: function(resp) {

                    // msg de sucesso
                    if(resp.trim() == '1') {
                        // lightbox msg sucesso

                        $("#email-mailing").val("E-mail cadastrado com sucesso!");
                        location.reload();
                    }

                    else if(resp.trim() == '-3') {
                        $("#email-mailing").val("E-mail já está cadastrado!");
                    }

                    else {
                        $("#email-mailing").val("Erro ao enviar o email");
                    }


                },

                error: function(x, h, z) {
                    $("#email-mailing").val("Erro ao enviar o email");
                }
            });
        }
    });

	var valor_bkp = $("#valor").val();

	function getCreditCardType(accountNumber) {

	  //start without knowing the credit card type
	  var result = "unknown";

	  //first check for MasterCard
	  if (/^5[1-5]/.test(accountNumber)) {
	    result = "Master";
	  }

	  //then check for Visa
	  else if (/^4/.test(accountNumber)) {
	    result = "Visa";
	  }

	  //then check for AmEx
	  else if (/^3[47]/.test(accountNumber)) {
	    result = "Amex";
	  }

	  return result;
	}

	function validarNomeEmail() {

		var flgok = true;

		$("#email").css("border-color", "inherit");
		$("#nome").css("border-color", "inherit");

		if(validateEmail($("#email").val()) == false) {
			$("#email").css("border-color", "red");
			flgok = false;
		}

		if($("#nome").val() == "") {
			$("#nome").css("border-color", "red");
			flgok = false;
		}

		return flgok;
	}

	$("#card_number, #card_cvv").keyup(function() {
        $(this).val($(this).val().replace(/[^0-9]/g,""));
    });

    $("#card_validate").mask("99/9999");
    numeral.language('pt-br');

	$("#btn-pagar").on("click", function(e) {

		e.preventDefault();

		if(!validarNomeEmail()) {
			return false;
		}

		$("#valor").val(valor_bkp);
		$("#titulo-modal").css("color", "");

		var cupom_aprovado = 0;

		// ajax verifica cupom
		if($("#cupom").val() != "") {

			$.ajax({

				url: Yii.app.createUrl('bombarcoshop/validarCupom'),
                data: {
                	cupom: $("#cupom").val(),
                	id_produto: $("#id_produto").val(),
                	valor: $("#valor").val()
                },
                async: false,
                type: "POST",
                success: function(resp) {
                	// retornar valor com desconto se o cupom for valido
                	resp = JSON.parse(resp);
                	cupom_aprovado = resp.cupom_aprovado;
                	$("#valor").val(resp.desconto);
                },
                error: function() {

                }
			});
		}
		
		var texto_cupom = "(sem cupom de desconto)";
		if(cupom_aprovado != 0) {
			$("#titulo-modal").css("color", "#5cb85c");
			var texto_cupom = "(com cupom de desconto)";
		}

		var valor = $("#valor").val();
		var price_format = numeral(valor).format('0,0.00');
		$("#titulo-modal").text("R$ "+price_format+" "+texto_cupom);
		$(".alert-error").hide();
	    $(".alert-success").hide();
        $('#modalpagamento').modal('show');

	});


	$("#btn-confirmarpagamento").on("click", function(e) {

		e.preventDefault();

		var flgok = true;
		$("#link-ebook").hide();

		$(".required").each(function() {
			if($(this).val() == "") {
				$(this).css("border-color", "red");
				flgok = false;
			}
		});

		if($("#card_validate").val().length != 7) {
			$("#card_validate").css("border-color", "red");
			flgok = false;
		}

		if(flgok) {

			$("#card_flag").val(getCreditCardType($("#card_number").val()));
	        $("#card_validate_month").val($("#card_validate").val().split("/")[0]);
	       	$("#card_validate_year").val($("#card_validate").val().split("/")[1]);

	       	$.ajax({
	       		url: Yii.app.createUrl("bombarcoshop/pagamentoCartao"),
	       		data: {
	       			nome: $("#nome").val(),
	       			email: $("#email").val(),
	       			id_produto: $("#id_produto").val(),
	       			card_flag: $("#card_flag").val(),
	       			card_validate_month: $("#card_validate_month").val(),
	       			card_validate_year: $("#card_validate_year").val(),
	       			card_name: $("#card_name").val(),
	       			card_number: $("#card_number").val(),
	       			card_cvv: $("#card_cvv").val(),
	       			valor: $("#valor").val()
	       		},
	       		type: "POST",
	       		success: function(resp) {

	       			var retorno = JSON.parse(resp.trim());

	       			if(retorno.ok == 1) {
	       				$(".alert-error").hide();
	       				$(".alert-success").show();
	       				$(".required").each(function() {
	       					$(this).val("");
	       				});
	       				window.open("http://www.boletimnautico.com.br/sites/bombarco/public/bombarcoshop/ebook-meu-primeiro-barco.pdf", "_blank"); 
	       			}
	       			// erro pagamento
	       			else {
	       				$(".alert-success").hide();
	       				$(".alert-error").show();
	       			}
	       			
	       		},
	       		error: function(x, h, z) {
	       			$(".alert-success").hide();
	       			$(".alert-error").show();
	       		}
	       	});
		}
	});
});