$(document).ready(function(){


	$(document).ajaxStart(function () {$('.preloader').show();});
    $(document).ajaxStop(function () {$('.preloader').hide();});


	$(window).scroll(function(){
		if ($(window).scrollTop() <= 50) {
			$("#mainMbMenu").removeClass("fixed");
		} else {
			if (!$("#mainMbMenu").hasClass("fixed")) {
				$("#mainMbMenu").addClass("fixed");
			}
		}
	});

	$(".input-status").dropdown({gutter : 5});
	$('.drop-down-status .cd-dropdown ul').slimScroll({
        height: '85px',
        width: '100%',
        distance: '10px',
        railVisible: false,
		alwaysVisible: true
    });


	/**
	 * AJAX que realiza troca de Status
	 * usado em Empresas, Estaleiros e Anúncios
	 */
	$(".btn-change-status").on("click", function(e) {

		e.preventDefault();    	

    	if (!confirm('Tem certeza que deseja realizar esta operação?')) {
    		return false;
    	} else {

    		$this = $(this);
	    	$yiiGrid = $this.closest('.grid-view');

    		$.post(
	    		$this.attr('href'),
	    		{status:$this.data('status')},
	    		function(resp) {
	    			//console.log(resp);
	                if(resp != null) {
	                    alert(resp.msg);                                            
	                    if(resp.error == 0) {
	                        $.fn.yiiGridView.update($yiiGrid.attr('id'));
	                    }                                           
	                } else {
	                    alert('Falha ao realizar a operação. Tente mais tarde.');
	                }
	    		},
	    		'json'
	    	);
    		
    	}
	});

});