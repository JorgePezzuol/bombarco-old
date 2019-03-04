$(document).ready(function() {

	if($(".slide-deemb2")[0]){
		$(".quadro-l1-deemb7").css({"top":-290})
	}
	// using jQuery Mask Plugin v1.7.5
	// http://jsfiddle.net/d29m6enx/2/
	var maskBehavior = function (val) 	{
	 return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
	 field.mask(maskBehavior.apply({}, arguments), options);
	 }
	};

	$("#telefone-contato-anunciante, #lbox-detemba2 input[name='finan_phone'], #lbox-detemba3 input[name='finan_phone']").mask(maskBehavior, options);

	$(".img-deemb-slide").on("click", function(e) {
		e.preventDefault();
		var src = $(this).attr("src");
		$(".bg-img-slide-deemb").attr("src", src);


		// nao chama plugin de zoom no mobile
		if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		  	/**** zoom ****/
		  	$(".zoomContainer").remove();
		  	$("#img-zoom").removeData('elevateZoom');
			$('#img-zoom').data('zoom-image', src).elevateZoom({
				zoomType: "inner",
				cursor: "crosshair",
				//zoomWindowFadeIn: 500,
				//zoomWindowFadeOut: 750, 
				scrollZoom: true, 
				zoomActive: true,
				zoomLevel: 1, //default zoom level of image
				//tint:true, 
				//tintColour:'#005655', 
				responsive: true,
				//tintOpacity:0.5,
				lensFadeIn: 500,
				lensFadeOut: 500
			}); 
		 
		}
	});

	// URL de compartilhar no face
	//$("#compartilhar").attr("href", 'https://www.facebook.com/sharer/sharer.php?u='+location.href+"?fbrefresh=1154464gd56");
	$("#compartilhar").attr("href", 'https://www.facebook.com/sharer/sharer.php?u='+location.href);
	//$("#compartilhar").attr("href", "https://www.facebook.com/dialog/share?app_id=966242223397117&amp;display=popup&amp;href="+location.href);

	

	$('.btn-lbox').click(function(e) {
		e.preventDefault();

		$lbox = $(this).data('lbox');

		// se for lightbox de contato, reseta o form
		if ($lbox == "#lbox-detemba") {
			$($lbox).find(".ev-titleb").text("Envie uma mensagem para o vendedor desta embarcação");
			$($lbox).find(".form-nome-ag")
					.show()
					.filter(".senha-contato-anunciante")
					.hide()
					.find("input")
					.val("");
		};

		$($lbox).lightbox_me({centered: true,
		onLoad: function() {
					if($(window).width() < 789){
						$($lbox).css({"top":$(window).scrollTop() + 40, "marginTop":0})
					}
				}});
	});


	


	/**
	 * Contato Parceiro
	 */
	$(".botao_contato_partners").on("click", function(e){

		e.preventDefault();

		var id_form = $(this).data("form");

		$data = $("#"+id_form).serialize();

		//console.log($data);
		//console.log(id_form);
		
		//var parceiro_finan = $('input[name="finan_parceiro"]').val();

		//console.log($data);

		$.ajax({
			url: $("#"+id_form).attr("action"),
			type: 'POST',
			data: $data,
			success: function(resp) {

				if(id_form == "form_finan") {
					ga('send', 'event', 'link', 'click', 'Financiamento');

				}
				else if(id_form == "form_cons") {
					ga('send', 'event', 'link', 'click', 'Consorcio');
				}
				else {
					ga('send', 'event', 'link', 'click', 'Transporte');

				}

				var json = JSON.parse(resp);


				if (json.ok == true) {
					$('#lbox-msgok').lightbox_me({centered: true,
                                onLoad: function() {
                                    $("#lbox-msgok").addClass("show");
                                    $(".contatos_parceiros").val("");
                                },
                                onClose: function() {
                                    $("#lbox-msgok").removeClass("show");
                                }});
					$("#close-form").trigger("click");
					$(".lbox-ag .fechar-form").trigger("click");


				} else {
					alert(json.msg);
				}
			},
			error: function(x, h, z) {
				alert("Ocorreu um erro na comunicação, tente novamente mais tarde.");
			},
		});

	});


		
		
		/* ============= SM ============= */
		/**** tabs ***/	
		$('.tabs .tab-links a').on('click', function(e)  {
			var currentAttrValue = $(this).attr('href');
	 
			// Show/Hide Tabs
			$('.tabs ' + currentAttrValue).show().siblings().hide();
	 
			// Change/remove current tab to active
			$(this).parent('li').addClass('active').siblings().removeClass('active');
	 
			e.preventDefault();
		});


		// nao chama plugin de zoom no mobile
		if(!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
		  	/**** zoom ****/ 
			$('#img-zoom').data('zoom-image', $(".img-deemb-slide").attr("src")).elevateZoom({
				zoomType: "inner",
				cursor: "crosshair",
				//zoomWindowFadeIn: 500,
				//zoomWindowFadeOut: 750, 
				scrollZoom: true, 
				zoomLevel: 1, //default zoom level of image
				//tint:true, 
				//tintColour:'#005655', 
				responsive: true,
				//tintOpacity:0.5,
				lensFadeIn: 500,
				lensFadeOut: 500
			});
		 
		}
		

		
		/**** scroll *****/
		$('#mais-infos .scroll-div').on('click', function(e)  {
			$('html, body').fadeOut(100).fadeIn(150).animate({ scrollTop: $('.line-deemb3').offset().top }, 1000);
			//$('html, body').stop().animate({ opacity: 0 }, 200).animate({ opacity: 1.0 }, 200).animate({ scrollTop: $('.line-deemb3').offset().top }, 1000);
			return false;
			e.preventDefault();
		});
		
		/*** anúncio acompanhar ***/
		/*$('.box-deemb2').mousemove(function(e) {
			$('.advertise-deemb').offset({
				left: e.pageX,
				top: e.pageY + 20
			});
		}); */

		/*function moveAnuncio(){
			$('#alterada-sm .quadro-l3-deemb4').css({'top': '0px'}).animate({'top': '333px'},3000,'linear');
		}
		$('#alterada-sm .line-deemb2').mouseenter(function() { moveAnuncio(); })
			 .mouseleave(function(){ $('#alterada-sm .quadro-l3-deemb4').stop(); });*/
						 
		// $('#alterada-sm .line-deemb2').mouseenter(function() {
			// $(".quadro-l3-deemb4").css('position','relative').css('display','block').css('height','850px');
			// $(".advertise-deemb").css('position','fixed').css('top','350px').css('bottom','0').css('z-index','99999');
		// }); 			 
		
		// $('#alterada-sm .line-deemb2').mouseenter(function() {
			// $(window).scroll(function(){
				// if($('#descricao').is(':visible')) {
					// $('.tab-content').css('min-height','820px');
					// if($(window).scrollTop() > 700 && $(window).scrollTop() < 1500){
						// $('.advertise-deemb').css('position', 'fixed').css('top', 10).css('bottom', 100).css('margin-left', 0);
					// } else if($(window).scrollTop() < 700) {
						// $('.advertise-deemb').css('position', 'absolute').css('top', 0).css('margin-left', 0);
					// }  else if($(window).scrollTop() > 1300) {
						// $('.advertise-deemb').css('position', 'absolute').css('top', 700).css('margin-left', 0);
					// } 
				// } else {
					// $('.tab-content').css('min-height','auto');
					// $('.advertise-deemb').css('position', 'absolute').css('top',0).css('bottom','0').css('margin-left', 0);	
				// }
			// });
		// });
		
		// var pInicial = $('#alterada-sm .line-deemb2').offset().top; //aonde começa
		// var pFinal = $('#alterada-sm .line-deemb2').outerHeight(); //aonde termina
		
		// $('#alterada-sm .line-deemb2').mouseenter(function() {
			// $(window).scroll(function(){
			
				// if($('#descricao').is(':visible')) {
					// if($(window).scrollTop() < pInicial) { 
						// $('.advertise-deemb').css('position', 'absolute').css('top', 0).css('margin-left', 0);
					// } else if($(window).scrollTop() > pInicial && $(window).scrollTop() < pFinal ) { 
						// $('.advertise-deemb').css('position', 'fixed').css('top', 10).css('margin-left', 0);
					// } else if($(window).scrollTop() > pFinal) {
						// $('.advertise-deemb').css('position', 'absolute').css('top', (pFinal/2.7)).css('margin-left', 0); 
					// }
				// } else { 
					// $('.advertise-deemb').css('position', 'absolute').css('top', 0).css('margin-left', 0);
				// }
							
			// });
		// });		
	 
		/* ============= SM ============= */

		$(".ver_tel2").on("click", function(e) {

			e.preventDefault();
			var telefone = $(this).data("telefone");

			$(this).text(telefone);

			// ajax contabilizar "ver telefone"
	            var id_embarcacao = $("#id_embarcacao").val();
	            $.ajax({
	                url: Yii.app.createUrl('embarcacoes/contabilizarVerTelefone'),
	                data: { id_embarcacao: id_embarcacao },
	                type: 'post'
	            });
		});

		$(document).keyup(function(e) {
		    if (e.keyCode == 27) { // escape key maps to keycode `27`
		    	$("#fechar-video").trigger("click");    
		    }
		});

		$(".lazyYT-button").on("click", function(e) {

			e.preventDefault();


			if($("#div-lightbox-video").html() == "") {

				var video = $(this).data("video");
				var src = "https://www.youtube.com/embed/"+obterIdVideoYoutube(video)+"?autoplay=1";

				var html = '<div class="lightbox-videos" id="lightbox_video">';
				    html += '<div class="div-video">';
				    html += '<a id="fechar-video" href="#" class="close close-video">x</a>';
				        html += '<iframe type="text/html" width="740" height="460" src="'+src+'" frameborder="0"></iframe>';
				        
				    html += '</div>';
				html += '</div>';

				$("#div-lightbox-video").append(html);

				$('#lightbox_video').lightbox_me({
					centered: true,
					onLoad: function() {
						$('html, body').animate({scrollTop: 50}, 'slow');
							/* Para tentar corrigir o bug do video */
							setTimeout(function() {
				  				$('body').css('overflow','hidden!important');
				            	$('.lb_overlay.js_lb_overlay').css('height','100vh !important').css('width','100vw !important').css('max-height','100vh !important').css('max-width','100vw !important');
				        		$('body').css('overflow','auto !important');
				  			}, 150);
						$("#lightbox_video").addClass("show");
					},
					onClose: function() {
						$("#div-lightbox-video").empty();
						$("iframe").remove();
						$("#lightbox_video").removeClass("show");
					}
				});
			}
		});


});
