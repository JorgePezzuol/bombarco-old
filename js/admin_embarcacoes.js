$(document).ready(function() {
	
	numeral.language('pt-br');
	$('input[name="Embarcacoes[valor]"]').priceFormat({
	    prefix: '',
	    centsSeparator: ',',
	    thousandsSeparator: '.',
	    clearPrefix: true
	});

});	