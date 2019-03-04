$(document).ready(function () {

	//$('[data-toggle="tooltip"]').tooltip();
	var offset = $('body').offset().top;

	$("body").on('scroll', function () {

			if($(this).scrollTop() > 450) {
				$('.volta-topo').fadeIn();
			}
			else {
				$('.volta-topo').fadeOut();
			}
	});

	$('.dropdown-submenu a').on("click", function(e){
		$(this).next('ul').toggle();
		e.stopPropagation();
		e.preventDefault();
	});

		$("#zoom_03").ezPlus({
				gallery: 'gallery_01',
				cursor: 'pointer',
				galleryActiveClass: "active",
				imageCrossfade: true,
				loadingIcon: "https://www.elevateweb.co.uk/spinner.gif"
		});

		$("#zoom_03").bind("click", function (e) {
				var ez = $('#zoom_03').data('ezPlus');
				ez.closeAll(); //NEW: This function force hides the lens, tint and window
				$.fancyboxPlus(ez.getGalleryList());
				return false;
		});

		$('.owl-carousel-thumbs').owlCarousel({
			loop:true,
			autoplay: true,
			margin:10,
			responsiveClass:true,
			nav:true,
			navText:['<button type="button" class="btn slider-left-btn btn-link"><i class="fa fa-angle-left fa-2x"></i></button>','<button type="button" class="btn slider-right-btn btn-link"><i class="fa fa-angle-right fa-2x"></i></button>'],
	    dots:true,
			video: true,
			responsive:{
				0:{
					items:3,
					nav:true,
					dots:false
				},
				576:{
					items:3,
					nav:true,
					dots:false
				},
				768:{
					items:5,
					nav:true,
					dots:false
				},
				991:{
					items:7,
					nav:true,
					dots:false
				},
				1440:{
					items:7,
					nav:true,
					dots:false
				}
			}
		});

		$('.owl-carousel-semelhantes').owlCarousel({
			loop:true,
			autoplay: true,
			margin:10,
			responsiveClass:true,
			nav:true,
			navText:['<button type="button" class="btn slider-left-btn btn-link"><i class="fa fa-angle-left fa-2x"></i></button>','<button type="button" class="btn slider-right-btn btn-link"><i class="fa fa-angle-right fa-2x"></i></button>'],
	    dots:true,
			responsive:{
				0:{
					items:1,
					nav:false,
					dots:true
				},
				600:{
					items:2,
					nav:false,
					dots:true
				},
				800:{
					items:3,
					nav:true,
					dots:true
				},
				1000:{
					items:4,
					nav:true,
					dots:true
				}
			}
		});

		$('.volta-topo, .go-top').click(function(e){
			e.preventDefault();
			$('html, body').animate({
				scrollTop: $('#topo').offset().top
			}, 800);
		});

		$("#inputCEP, #cep").mask("99999-999");
		$("#inputCPF, #cpf").mask("999.999.999-99");
		$("#inputRG, #rg").mask("99.999.999-9");
		$("#inputDtNascimento, #data").mask("99/99/9999");
		//$("#inputTelefone, #telefone").mask("(99) 9999-9999");
		/*$('#inputTelefone, #telefone').focusout(function(){
			var phone, element;
			element = $(this);
			element.unmask();
			phone = element.val().replace(/\D/g, '');
			if(phone.length > 10) {
				element.mask("(99) 99999-999?9");
			} else {
				element.mask("(99) 9999-9999?9");
			}
		}).trigger('focusout');*/

		$('#banners').bjqs({
			'responsive'	:	true,
			'showcontrols'	:	true,
			'animspeed'		:	7000,
			'automatic'		:	true,
			'height'		:	958,
			'width'			:	1920,
			'keyboardnav'   : 	true,
			'hoverpause'	: 	false
		});


		$(".fancybox").fancybox({
			prevEffect		: 'none',
			nextEffect		: 'none',
			closeBtn		: false,
			helpers		: {
				overlay : { css : { 'background' : 'rgba(23, 3, 13, 0.95)' } },
				title	: { type : 'inside' },
				buttons	: {}
			}
		});

		$('.parallax').each(function(){
			var $obj = $(this);

			$(window).scroll(function() {
				var yPos = -($(window).scrollTop() / $obj.data('speed'));

				var bgpos = '100% '+ yPos + 'px';

				$obj.css('background-position', bgpos );

			});
		});


		/* isto é apenas demonstração e deve ser removido! */
		$('#msgAlerta').hide();
		$('#enviaForm').click( function(){
			$('#msgAlerta').fadeIn(500);
		});
		/*-------------------------------------*/

		var sideslider = $('[data-toggle=collapse-side]');
		var sel = sideslider.attr('data-target');
		var sel2 = sideslider.attr('data-target-2');
		sideslider.click(function(event){
				$(sel).toggleClass('in');
				$(sel2).toggleClass('out');
		});

		$('.dropdown a').on("click", function(e){
			if($(this).hasClass('rotate')) {
				$(this).removeClass('rotate');
			} else {
				$(this).addClass('rotate');
			}
			$(this).next('ul').toggle();
			e.stopPropagation();
			e.preventDefault();
		});

		$('.btn-selecao').off();
		$('.btn-selecao').click(function(){
			$('.btn-selecao').removeClass('active').html("Selecionar");
			if($(this).hasClass('active')){
				$(this).removeClass('active').html("Selecionar");
			} else {
				$(this).addClass('active').html("Selecionado!");
			}
		});

		$('#menu-tabs a').click(function (e) {
		  e.preventDefault()
		  $(this).tab('show')
		})

		$('.btn-laranja').click(function() {
			$('#loginModal').modal();
		});

		$('.abre-modal').click(function() {
			$('#mensagem01').modal();
		});

		// With JQuery

		numeral.language('br', {
        delimiters: {
            thousands: '.',
            decimal: ','
        },
        abbreviations: {
            thousand: 'mil',
            million: 'mi',
            billion: 'bi',
            trillion: 'tri'
        },
        ordinal: function (number) {
            return number === 1 ? 'º' : 'º';
        },
        currency: {
            symbol: 'R$'
        }
    });

    numeral.language('br');

		$(".filter").slider({});

		$(".nav-filter").slider({
			tooltip: "always"
		});

		
		$('.btn-preco, .btn-tamanho, .btn-marca').click(function(){ 
			var menu = $(this).parent().find('.dropdown-menu');
			if(menu.is(':visible')) {
				$('.dropdown-menu').hide();
				menu.show();
			} else {
				$('.dropdown-menu').hide();
			}
		});

	    $("#porPreco").parent().find('.slider-handle').click(function () {

	        $(".btn-preco").attr("data-toggle", "");

	    }).mouseleave(function () {

	        $(".btn-preco").attr("data-toggle", "dropdown");
	    });

	    $(".btn-marca").parent().find('li').mousedown(function () {

	        $(".btn-marca").attr("data-toggle", "");

	    }).mouseleave(function () {

	        $(".btn-marca").attr("data-toggle", "dropdown");

	    });

	    $("#porTamanho").parent().find('.slider-handle').click(function () {

	        $(".btn-tamanho").attr("data-toggle", "");

	    }).mouseleave(function () {

	        $(".btn-tamanho").attr("data-toggle", "dropdown");
	    });

	    $("#porPreco").parent().find('.slider-handle').mousemove(function () {

	        var mySlider = $("#porPreco").slider();
	        $("#porPrecoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0,0.00'));
	        $("#porPrecoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0,0.00'));

	    }).mouseleave(function () {

	        var mySlider = $("#porPreco").slider();
	        $("#porPrecoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0,0.00'));
	        $("#porPrecoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0,0.00'));

	    });


	    $("#porTamanho").parent().find('.slider-handle').mousemove(function () {

	        var mySlider = $("#porTamanho").slider();

	        $("#porTamanhoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0') +" PÉS");
	        $("#porTamanhoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0') +" PÉS");


	    }).mouseleave(function () {

	        var mySlider = $("#porTamanho").slider();

	        $("#porTamanhoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0') +" PÉS");
	        $("#porTamanhoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0') +" PÉS");

	    });

	    $('.compensabotaomenu, .nav-link').off();

	    if($(window).width() < 991) { 
	    	$('.count2-resp, #exibe-menu .fa-close').hide();
	    }

	    $('#exibe-menu').click(function() { 
	    	if($('.count2-resp').is(':visible')){
	    		$(this).removeClass('active');
	    		$('.count2-resp').fadeOut(200);
	    		$('#exibe-menu .icone_setabaixo').show();
	    		$('#exibe-menu .fa-close').hide();
	    	} else { 
				$(this).addClass('active');
	    		$('.count2-resp').fadeIn(500);	    		
	    		$('#exibe-menu .icone_setabaixo').hide();
	    		$('#exibe-menu .fa-close').show();	    		
	    	}
	    }); 
	    $(window).resize(function() {
		    if($(window).width() < 991) { 
		    	$('.count2-resp, #exibe-menu .fa-close').hide();
		    }
		 /*  if($('.count2-resp').is(':visible')){
	    		$(this).removeClass('active');
	    		$('.count2-resp').fadeOut(200);
	    		$('#exibe-menu .icone_setabaixo').show();
	    		$('#exibe-menu .fa-close').hide();
	    	} else { 
				$(this).addClass('active');
	    		$('.count2-resp').fadeIn(500);	    		
	    		$('#exibe-menu .icone_setabaixo').hide();
	    		$('#exibe-menu .fa-close').show();	    		
	    	} */
		});

	    $('.mostraForm').click(function() { 
	    	$('.divForm').show();
	    });

});
