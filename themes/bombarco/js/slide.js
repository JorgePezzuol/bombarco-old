/*=============================
=            Slide           =
=============================*/

$(document).ready(function() {

	/*$('.categories-emba').bxSlider({
			minSlides: 1,
			slideMargin: 0,
			maxSlides: 1,
			infiniteLoop: true,
			auto:false,
			controls:true,
			pager:false,
			//nextSelector: '.controls-emba  .next',
			//prevSelector: '.controls-emba  .prev',
		});*/
	$('.slide-deest').bxSlider({
			minSlides: 1,
			slideMargin: 0,
			maxSlides: 1,
			infiniteLoop: true,
			auto:false,
			controls:true,
			pager:false,
			//nextSelector: '.controls-emba  .next',
			//prevSelector: '.controls-emba  .prev',
		});

	$('.embarcacoes-semelhantes-slider').bxSlider({
			minSlides: 4,
			slideMargin: 15,
			maxSlides: 4,
			infiniteLoop: false,
			auto:false,
			controls:true,
			pager:false,
			hideControlOnEnd: true,
			nextSelector: '.bx-controls-direction4  .bx-next',
			prevSelector: '.bx-controls-direction4  .bx-prev',
		});
	$('.categories-detemba').bxSlider({
			minSlides: 4,
			slideMargin: 15,
			maxSlides: 4,
			infiniteLoop: false,
			auto:false,
			controls:true,
			pager:false,
			hideControlOnEnd: true,
			nextSelector: '.bx-controls-direction3  .bx-next',
			prevSelector: '.bx-controls-direction3  .bx-prev',
		});
	$('.embarcacoes-semelhantes-slider2').bxSlider({
			minSlides: 4,
			slideMargin: 15,
			maxSlides: 4,
			infiniteLoop: false,
			auto:false,
			controls:true,
			pager:false,
			hideControlOnEnd: true,
			nextSelector: '.bx-controls-direction4  .bx-next',
			prevSelector: '.bx-controls-direction4  .bx-prev',
		});
	$('.categories-guia-s').bxSlider({
			minSlides: 3,
			slideMargin: 15,
			maxSlides: 7,
			infiniteLoop: false,
			auto:false,
			controls:true,
			pager:false,
			nextSelector: '.bx-controls-direction2  .bx-next',
			prevSelector: '.bx-controls-direction2  .bx-prev',
		});
	$('.slide-deemb').bxSlider({
			minSlides: 4,
			maxSlides: 4,
			moveSlides: 1,
			infiniteLoop: false,
			auto:false,
			slideMargin: 20,
			slideWidth: 80,
			controls:true,
			pager:false,
			hideControlOnEnd: true
		});
	$('.slide-deemb2').bxSlider({
			minSlides: 4,
			maxSlides: 4,
			moveSlides: 1,
			infiniteLoop: false,
			auto:false,
			slideMargin: 20,
			slideWidth: 80,
			controls:true,
			pager:false,
			hideControlOnEnd: true
		});
	$('.slide-detfab').bxSlider({
			minSlides: 5,
			slideMargin: 20,
			//maxSlides: 5,
			infiniteLoop: false,
			auto:false,
			controls:true,
			pager:false,
			hideControlOnEnd: true,
			nextSelector: '.controls-detfab  .next',
			prevSelector: '.controls-detfab  .prev',
		});
	$('.bx-slider-empresa').bxSlider({
			infiniteLoop: false,
			auto:false,
			controls:false,
			pager:true,
			pagerCustom: '#bx-pager'
		});
    if($(window).width() > 789){
	   $('.slide-depp').bxSlider({
			minSlides: 5,
			slideMargin: 20,
			maxSlides: 5,
			infiniteLoop: true,
			auto:false,
			controls:true,
			pager:false,
			nextSelector: '.controls .next-a',
			prevSelector: '.controls .prev-a',
		});
    }

	$('#slider_embarcacoes').bxSlider({
			minSlides: 4,
			slideMargin: 10,
			maxSlides: 4,
			infiniteLoop: false,
			auto:false,
			controls:true,
			pager:false,
			slideWidth: 226,
			hideControlOnEnd: true
	});

$('#img-box-slider').bxSlider({
			auto:false,
			controls:true,
			pager:false,
			hideControlOnEnd: true
	});
});
