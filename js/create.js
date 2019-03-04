
$(document).ready(function() { 
	$("#btnAjax").on("click", function() { 
		$.ajax({
			url: 'createAjax',
			data: {nome: $("#nome").val()},
			type: "post",

			success: function(response) { 
				alert("OK");
			},
			error: function(xhr, msg) { 
				alert(msg);
			}
			
		});
	});
});