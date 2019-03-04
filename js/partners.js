$(document).ready(function(){

    /**
     * Setando formato de moeda para inputs
     */
    $("#form_partner input[name='price']").priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.',
        clearPrefix: true
    });

    // using jQuery Mask Plugin v1.7.5
    // http://jsfiddle.net/d29m6enx/2/
    var maskBehavior = function (val) {
     return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options = {onKeyPress: function(val, e, field, options) {
     field.mask(maskBehavior.apply({}, arguments), options);
     }
    };
    $("#form_partner input[name='phone']").mask(maskBehavior, options);
	
    $("#feets").ionRangeSlider({
        min: 0,
		max: 200,
        type: 'double',
        step: 5,
        hideMinMax: true,
        hideFromTo:true,
        prettify: true,
        hasGrid: false,
        onChange: function(obj) {
        	delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber),
            	maximo = JSON.stringify(obj.toNumber);


            $(".slide-feet .under span span").html(minimo);
            $(".slide-feet .under input").val(minimo);

            $(".slide-feet .above span span").html(maximo);
            $(".slide-feet .above input").val(maximo);
        },
        onLoad: function(obj) {
            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber),
            	maximo = JSON.stringify(obj.toNumber);
     
            $(".slide-feet .under .b > span").html(minimo);
            $(".slide-feet .under input").val(minimo);

            $(".slide-feet .above .b > span").html(maximo);
            $(".slide-feet .above input").val(maximo);
        }
    });


    $.validator.messages.required = 'Campo obrigatório';
    $("#form_partner").validate();
	$("#form_partner").on("submit", function(e){
		e.preventDefault();

		$(".form-error").hide();

        if ($("#form_partner").valid()) {

            $.post($("#form_partner").attr("action"), $("#form_partner").serialize(), function(resp){

                if (resp.ok == true) {

                    $('#lbox-msgok').lightbox_me({centered: true,
                                onLoad: function() {
                                    $("#lbox-msgok").addClass("show");
                                },
                                onClose: function() {
                                    $("#lbox-msgok").removeClass("show");
                                }});
                    $("#form_partner")[0].reset();
                } else {
                    $(".form-error").show().text(resp.msg);
                }

            }, 'json');

        };		

	});

});