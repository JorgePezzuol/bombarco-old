    (function($) {
	"use strict";

	var txt_prev = $('.spotlight-banner .slide').eq(2).find(".title").text();
	var txt_next = $('.spotlight-banner .slide').eq(1).find(".title").text();

	$('.spotlight-banner .controls .prev .title-next').html(txt_prev);
	$('.spotlight-banner .controls .next .title-next').html(txt_next);

	$(document).ready(function() {

		if ($('.spotlight-banner .slider .slide').size()>1) {
			$('.spotlight-banner .slider').bxSlider({
		       	minSlides: 1,
			  	maxSlides: 1,
			  	infiniteLoop: false,
			  	pager: false,
			  	auto: false,
			  	pause: 4000,
			  	mode: 'horizontal',
			  	hideControlOnEnd: true,
		  		touchEnabled: true,
		  		responsive: true,
		  		captions: true,
		  		nextSelector: '.spotlight-banner .controls .next',
  				prevSelector: '.spotlight-banner .controls .prev',
		  		onSliderLoad: function(){},
				onSlideBefore: function(currentSlideNumber, totalSlideQty, currentSlideHtmlObject){
					$('.spotlight-banner .slider .slide').removeClass('active prev-slide next-slide');
					$('.spotlight-banner .slider .slide').eq(currentSlideHtmlObject - 1).addClass('prev-slide');
					$('.spotlight-banner .slider .slide').eq(currentSlideHtmlObject - 0).addClass('active');
					$('.spotlight-banner .slider .slide').eq(currentSlideHtmlObject + 1).addClass('next-slide');

					var txt_prev = $('.spotlight-banner .slide').eq(currentSlideHtmlObject - 1).find(".title").text();
					var txt_next = $('.spotlight-banner .slide').eq(currentSlideHtmlObject + 1).find(".title").text();
					$('.spotlight-banner .controls .prev .title-next').html(txt_prev);
					$('.spotlight-banner .controls .next .title-next').html(txt_next);
				},
				onSlideAfter: function(){}
		    });
		}
		$("html").delegate('.icon-play', "click", function(e) {
            console.log("Aaaa");
			if($(window).width() < 789){
				$("body").append($("<div/>").addClass("lightbox-videos").show().append(
					$("<div/>").addClass("content-video").append(
						$("<a/>").attr({"href":"#","class":"close-video"}).text("x").click(function(){
							$(".lightbox-videos").remove();
						})
					).append(
						$("<iframe/>").attr({"src":$(this).closest("li").find("input").val(),"frameborder":"0", "allowfullscreen":"", "wmode":"Opaque"})
					)
				))
				e.preventDefault();
			}
		});
	})

})(jQuery);
