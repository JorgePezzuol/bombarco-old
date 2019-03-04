$(document).ready(function(){
	
	$('#EmbarcacaoTipos_embarcacao_macros_id').dropdown({gutter : 5});
	$('#EmbarcacaoTipos_status').dropdown({gutter : 5});

	$('.cd-dropdown ul').slimScroll({
        height: '180px',
        width: '100%',
        distance: '10px',
        railVisible: false,
		alwaysVisible: true
    });

    $('.slimScrollDiv').css("overflow", 'visible');

});