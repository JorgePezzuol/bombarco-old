$(document).ready(function() {

	$('#MotorModelos_embarcacao_macros_id').dropdown({gutter : 5});
	$('#MotorModelos_motor_fabricantes_id').dropdown({gutter : 5});
	$('#MotorModelos_motor_tipos_id').dropdown({gutter : 5});
	$('#MotorModelos_status').dropdown({gutter : 5});

	  $('.slimScrollDiv').css("overflow", 'visible !important');

	  	$("#MotorModelos_potencia").keyup(function() {
		$('#MotorModelos_potencia').val($(this).val().replace(/[^0-9\.]/g,''));
	});
	
});