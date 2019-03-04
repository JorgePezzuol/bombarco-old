/*=============================
=            Busca            =
=============================*/

$(document).ready(function() {
	var $form = $('#form-search');
	var $tab = $('.main-filter .options-category .tab');
	var $macro_active = 2;
	var $macros = {};
	$macros[0] = 2; // Lanchas
	$macros[1] = 3; // Veleiros
	$macros[2] = 1; // Jetskis
	$macros[3] = 4; // Pesca

	//$('#brand').dropdown({gutter : 5});
	//$('#model').dropdown({gutter : 5});
	//$('#condition').dropdown({gutter : 5});

	$("#price").ionRangeSlider({
        min: 0,
		max: 2000000,
        type: 'double',
        step: 5000,
        hideMinMax: true,
        hideFromTo:true,
        prettify: true,
        hasGrid: false,
        onChange: function(obj) {
            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber);
            var maximo = JSON.stringify(obj.toNumber);

            $(".slide-price .under span span, .slide-price .under input").html(minimo).priceFormat({
	        	clearPrefix: true,
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});
			$(".slide-price .under input").val(minimo).priceFormat({
	        	clearPrefix: true,
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});

            $(".slide-price .above span span, .slide-price .above input").html(maximo).priceFormat({
	        	clearPrefix: true,
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});
			$(".slide-price .above input").val(maximo).priceFormat({
	        	clearPrefix: true,
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});

			if (maximo >= 2000000) {
				$(".slide-price .above .prefix").text('mais de');
			} else {
				$(".slide-price .above .prefix").text('até');
			}

        },
        onLoad: function(obj) {
            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber);
            var maximo = JSON.stringify(obj.toNumber);

            $(".slide-price .under span span, .slide-price .under input").html(minimo).priceFormat({
	        	prefix: '',
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});

            $(".slide-price .under input").val(minimo).priceFormat({
	        	prefix: '',
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});

            $(".slide-price .above span span, .slide-price .above input").html(maximo).priceFormat({
	        	prefix: '',
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});
			$(".slide-price .above input").val(maximo).priceFormat({
	        	prefix: '',
	        	thousandsSeparator: '.',
			    centsLimit: 3
			});
        }
    });



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

            /*if(minimo == 0) {
            minimo = 1;
            }*/

            //	console.log(minimo);
            //	console.log(maximo);

            $(".slide-feet .under span span").html(minimo);
            $(".slide-feet .under input").val(minimo);

            $(".slide-feet .above span span").html(maximo);
            $(".slide-feet .above input").val(maximo);

            /*if (maximo >= 200) {
            $(".slide-feet .above .prefix").text('mais de');
            } else {
            $(".slide-feet .above .prefix").text('até');
            }*/
        },
        onLoad: function(obj) {
            delete obj.input;
            delete obj.slider;
            var minimo = JSON.stringify(obj.fromNumber),
            maximo = JSON.stringify(obj.toNumber);

            $(".slide-feet .under span span").html(minimo);
            $(".slide-feet .under input").val(minimo);

            $(".slide-feet .above span span").html(maximo);
            $(".slide-feet .above input").val(maximo);
        }
    });

    $(".form-filter .reset-ranges").on("click", function(){
        var minimo = $(this).data('under'),
        maximo = $(this).data('above'),
        pes    = $(this).data('feet');
        $("#price").ionRangeSlider("update", {
            min: 0,
            max: 2000000,
            from: 0,
            to: 2000000,
            type: 'double'
        });
        $("#feets").ionRangeSlider("update", {
            min: 0,
            max: 200,
            from: 0,
            to: 200,
            type: 'double'
        });
        $('.slide-feet').removeClass('disable');
    });



    $(".form-filter .set-ranges").on("click", function(){
        var minimo = $(this).data('under'),
        maximo = $(this).data('above'),
        pes    = $(this).data('feet');
        $("#price").ionRangeSlider("update", {
            min: minimo,
            max: maximo,
            from: minimo,
            to: maximo
        });
        $("#feets").ionRangeSlider("update", {
            min: pes,
            max: pes,
            from: pes,
            to: pes
        });
        $('.slide-feet').addClass('disable');
    });


	/*$('.brand .cd-dropdown ul, .model .cd-dropdown ul, .condition .cd-dropdown ul').slimScroll({
        height: '180px',
        width: '100%',
        distance: '10px',
        railVisible: false,
		alwaysVisible: true
    });*/

	// Iniciando Modelos travado
    //$form.find('.model .cd-dropdown span').off();

	// Iniciando a partir dos valores default
	if ($('.main-filter .options-category .tab.active').hasClass('jetski')) {
		$form.find('.slide-feet').fadeTo(500,0.3);
	} else {
		$form.find('.slide-feet').fadeTo(500,1);
	}


	// Ao trocar de Macro
	$('.main-filter .options-category .tab').on('click',function(e){
		e.preventDefault();

		if(!$(this).hasClass('active')){

			$('.main-filter .options-category li.active').removeClass('active');
			$(this).addClass('active');
			$('#form-search #macro').val($macros[$(this).index()]);

			$macro_active = $macros[$(this).index()];

			if ($(this).hasClass('jetski')) {
				//$form.find('.slide-feet').fadeTo(500,0.5);
				//$('.validate-opacity-range').show();
				$('.validate-opacity-range').fadeTo(500,0.8);
			} else {
				$form.find('.slide-feet').show();
				$('.validate-opacity-range').hide();
				$form.find('.slide-feet').fadeTo(500,1);
			}

		}

		// reseta o form
		resetForm();

		// Atualizando os Fabricantes
		//ajaxecute(Yii.app.createUrl('utils/DropDownFabricantes'), $macros[$(this).index()], "", "", "#form-search .brand", "");
                        $.ajax({
                            type: 'POST',
                            url: Yii.app.createUrl('utils/DropDownFabricantes'),
                            data: { id: $macros[$(this).index()], input_name: 'marca', input_id: 'brand', placeholder: 'Marca', selected: ''},
                            success: function(data, textStatus, jqXHR) {
                                $('#form-search #brand').html($(data.trim()).html());
                            }
                        });

	});


	/**
	 * AJAX que carrega Modelos a partir de Fabricantes
	 * @return {[type]} [description]
	 */
	$form.on('change', '#brand', function() {

		value = $(this).val();
		//console.log(value);

		if (value > 0) {

                            $.ajax({
                                type: 'POST',
                                url: Yii.app.createUrl('utils/DropDownModelos'),
                                data: { id: value, input_name: 'modelo', input_id: 'model', placeholder: 'Modelo', selected: ''},
                                success: function(data, textStatus, jqXHR) {
                                    $('#form-search #model').html($(data).html());
                                    $form.find('.slide-feet').fadeTo(500, 1);
                                    $form.find('.model').fadeTo(500, 1);
                                    $('.validate-opacity-range').hide();
                                }
                            });

			//ajaxecute(Yii.app.createUrl('utils/DropDownModelos'), value, "modelo", "model", "#form-search .model", "Modelo");
			//ajaxecuteSizeRange(Yii.app.createUrl('utils/LoadSizeRanges'), "#feets", $macro_active, value);

			// mostra pés
			/*$form.find('.slide-feet').fadeTo(500, 1);
			$form.find('.model').fadeTo(500, 1);
			$('.validate-opacity-range').hide();*/

		} else {
			resetForm();
			$form.find('#model').fadeTo(500, 0.3);
		}

	});

	/**
	 * AJAX que carrega Preco e Pés a partir do Modelo
	 * @return {[type]} [description]
	 */
	/*$form.find('.model').on('click', '.slimScrollDiv li', function() {
		val = $(this).data('value');
		if (val != 0) {
			//ajaxecutePriceRange(Yii.app.createUrl('utils/LoadRanges'), val, "#price");
			// esconde pés
			$form.find('.slide-feet').fadeTo(500,0.3);
			$('.validate-opacity-range').show();
		}
	});*/



	$("#form-general-search").on("submit", function(e){
		e.preventDefault();

		var val = $(this).children("input[name=busca]").val()
		if(val != "" && val != undefined && val != " ") {
			window.location.href = Yii.app.createUrl('busca/'+val);
		}

	});

});


/**
 * Zera os valores do Form
 * @return {[type]} [description]
 */
function resetForm() {

    $("#price").ionRangeSlider("update", {
        min: 0,
        max: 2000000,
        from: 0,
        to: 2000000
    });

    $("#feets").ionRangeSlider("update", {
        min: 0,
        max: 200,
        from: 0,
        to: 200
    });

    $('#form-search .slide-feet').fadeTo(500,1);
    $('#form-search .model').fadeTo(500, 0.3);
    $('#form-search #model').html('<option value="-1" selected>Selecione o modelo</option>');    
    //$('#form-search .model input[name="modelo"]').val("-1");
    //$('#form-search .model .cd-dropdown > span > span').text("Selecione a marca");

}

/*-----  End of Busca  ------*/