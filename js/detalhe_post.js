$(document).ready(function() {

	
	// URL de compartilhar no face
	$("#compartilhar-fb").attr("href", 'https://www.facebook.com/sharer/sharer.php?u='+location.href);

	// URL de compartilhar no twitter
	$("#compartilhar-twitter").attr("href", 'http://twitter.com/home?status='+location.href);
	/* Fim compartilhar */
});