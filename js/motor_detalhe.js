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
		

		$(".ver_tel2").on("click", function(e) {

			e.preventDefault();
			var tel = $(this).data("tel");

			$('.div-text-end-bloco2-l3-deemb .tel-add').text(tel);

            var id_motor = $("#id_motor").val();
            $.ajax({
                url: Yii.app.createUrl('motorAnuncio/contabilizarVerTelefone'),
                data: { id_motor: id_motor },
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

		$("#btn_contato2").on("click", function(e) {
			$('html, body').animate({scrollTop: 200}, 'slow');
			$(".campo-msg-principal, .ponta").effect( "pulsate", {times:4}, 3000 );
		});

});
