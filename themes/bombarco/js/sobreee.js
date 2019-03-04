/*=============================
=            Sobre          =
=============================*/

$(document).ready(function() {

  console.log("a");
 /*
                $(".btninst").off();
		$(".btninst").on("click", function(e){
			e.preventDefault();
			$(".line-inst-principal").hide();
			var id = $(this).attr("href");
			$("#"+id).fadeIn("slow");
		 alert(window.location.hash); 
               
                if (window.location.hash == '#pq-anunciar-bb') {
		   $("#pq-anunciar").show();
		   $("#institucional").hide();
		   $("#como-funciona").hide();
		   $("#planos").hide();
		   $("#bom-marinheiro").hide();
		   $("#contato").hide();
		   $('#pq-anunciar-btn').addClass('active');
		   $('#institucional-btn').removeClass('active');

		} else {

                    if (window.location.hash == '#institucional-bb') {
                       $("#institucional").show();
                       $("#pq-anunciar").hide();
                       $("#como-funciona").hide();
                       $("#planos").hide();
                       $("#bom-marinheiro").hide();
                       $("#contato").hide();

                    } else {
	

                        if (window.location.hash == '#como-anunciar-bb') {
                           $("#como-anunciar").show();
                           $("#pq-anunciar").hide();
                           $("#institucional").hide();
                           $("#planos").hide();
                           $("#bom-marinheiro").hide();
                           $("#contato").hide();
                           $('#como-anunciar-btn').addClass('active');
                           $('#institucional-btn').removeClass('active');

                        } else {

                            if (window.location.hash == '#planos-bb') {
                               $("#planos").show();
                               $("#como-funciona").hide();
                               $("#pq-anunciar").hide();
                               $("#institucional").hide();
                               $("#bom-marinheiro").hide();
                               $("#contato").hide();
                               $('#planos-btn').addClass('active');
                               $('#institucional-btn').removeClass('active');

                            } else {

                                if (window.location.hash == '#bom-marinheiro-bb') {
                                   $("#bom-marinheiro").show();
                                   $("#planos").hide();
                                   $("#como-funciona").hide();
                                   $("#pq-anunciar").hide();
                                   $("#institucional").hide();
                                   $("#contato").hide();
                                   $('#bom-marinheiro-btn').addClass('active');
                                   $('#institucional-btn').removeClass('active');

                                }

                                if (window.location.hash == '#contato-bb') {
                                   $("#contato").show();
                                   $("#bom-marinheiro").hide();
                                   $("#planos").hide();
                                   $("#como-funciona").hide();
                                   $("#pq-anunciar").hide();
                                   $("#institucional").hide();
                                   $('#contato-btn').addClass('active');
                                   $('#institucional-btn').removeClass('active');

                                }
                            }
                        }
                    }
                }
            });*/

		


		$('.line-inst-2 a.btninst').on('click',function(){
			if( $(this).hasClass('active')){

			} else{
				$('.line-inst-2 a.active').removeClass('active');
				$(this).addClass('active');
			}
		});
		if(location.hash != ''){
			if($(window).width() < 789){
				$("html, body").animate({"scrollTop":$("#div-princ-institucional").position().top - 10})
			}
		}
		$(".menu-institucional a").click(function(){
			if($(window).width() < 789){
				$("html, body").animate({"scrollTop":$("#div-princ-institucional").position().top - 10})
			}
		});

});
