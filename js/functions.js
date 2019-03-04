
// somente youtube, ex url: https://youtu.be/vlgWUZ73rJg
function obterIdVideoYoutube(url) {

	var videoid = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
	if(videoid != null) {
	   return videoid[1];
	} else { 
	    return false;
	}
}

function populateDropDown(element, json) {

	var listItems= "<option value=''>Selecione</option>";

	for (var i = 0; i < json.length; i++){

		listItems+= "<option value='" + json[i].id + "'>" + json[i].titulo + "</option>";
	}

	$(element).html(listItems);

}

/**
 * Lightbox geral
 * @param  {[type]} texto [description]
 * @return {[type]}       [description]
 */
function lightBoxMsgSucesso(texto) {
		$("#lbox-msgok").find('span').text(texto);
		$('#lbox-msgok').lightbox_me({
			centered: true,
			onLoad: function() {
				$("#lbox-msgok").addClass("show");
			},
			onClose: function() {
				$("#lbox-msgok").removeClass("show");
				location.reload();
			}
		});
}


function lightBoxMsg(texto) {
		$("#lbox-msgok").find('span').text(texto);
		$('#lbox-msgok').lightbox_me({
			centered: true,
			onLoad: function() {
				$("#lbox-msgok").addClass("show");
			},
			onClose: function() {
				$("#lbox-msgok").removeClass("show");
			}
		});
}

/**
 * Lightbox geral com reload
 * @param  {[type]} texto [description]
 * @return {[type]}       [description]
 */
function lightBoxMsgSucessoReload(texto) {
		$("#lbox-msgok").find('span').text(texto);
		$('#lbox-msgok').lightbox_me({
	        centered: true,
					onLoad: function() {
						$("#lbox-msgok").addClass("show");
					},
	        onClose: function() {
						$("#lbox-msgok").removeClass("show");
	       		location.reload();
	        }
		});
}


/**
 * Seta um novo input select
 * @param {[type]} wrap [Elemento envolta do select]
 * @param {[type]} input [Input Select]
 * @param {[type]} data  [HTML do novo select]
 */
function newSelect(wrap, input, data) {

	$(wrap).html(data).children(input).dropdown({gutter : 5});

	$(wrap + ' .cd-dropdown ul').slimScroll({
        height: '180px',
        width: '100%',
        distance: '10px',
        railVisible: false,
		alwaysVisible: true
    });
}

/**
 * Funcão que executa o AJAX e carrega o novo dropdown
 * @param  {[type]} url        [URL que irá executar]
 * @param  {[type]} value      [Valor/ID do item selecionado, usado no WHERE]
 * @param  {[type]} input_name [o nome do novo select]
 * @param  {[type]} input_id   [o ID do novo select]
 * @param  {[type]} placeholder [description]
 * @param  {[type]} selected    [description]
 * @param  {[type]} wrap       [Class/ID do elemento que envolve o DropDown]
 * @return {[type]}            [description]
 */
function ajaxecute(url, value, input_name, input_id, wrap, placeholder, selected) {

	placeholder = typeof placeholder !== 'undefined' ? placeholder : null;
	selected = typeof selected !== 'undefined' ? selected : null;

	$.ajax({
		type: 'POST',
		url: url,
		data: { id: value, input_name: input_name, input_id: input_id, placeholder: placeholder, selected: selected },
		success: function(data, textStatus, jqXHR) {
			newSelect(wrap, "#"+input_id, data.trim());
		}
	});

}


/**
 * Funcão que carrega tamango maximo e minimo de um modelo
 * @param  {[type]} url   [description]
 * @param  {[type]} value [description]
 * @param  {[type]} input [description]
 * @return {[type]}       [description]
 */
function ajaxecuteSizeRange(url, input, macro_id, fabricante_id) {

	fabricante_id = typeof fabricante_id !== 'undefined' ? fabricante_id : null;

	$.ajax({
		type: 'POST',
		url: url,
		data: { macro_id: macro_id, fabricante_id: fabricante_id },
		success: function(data, textStatus, jqXHR) {

			//console.log(data);

			json = jQuery.parseJSON(data);
			//console.log(json);

			// Se os valores MAX e MIN não são NULL
			// então recarrega o Range
			if (json.min != null && json.max != null) {

				$(input).ionRangeSlider("update", {
	                min: convertInt(json.min),
				    max: convertInt(json.max),
				    from: convertInt(json.min),
				    to: convertInt(json.max)
	            });

			} else {// Se não zera o Range

				$(input).ionRangeSlider("update", {
	                min: 0,
				    max: 500,
				    from: 0,
				    to: 500
	            });

			}

		}
	});

}


/**
 * [ajaxecutePriceRange description]
 * @param  {[type]} url   [description]
 * @param  {[type]} value [description]
 * @param  {[type]} input [description]
 * @return {[type]}       [description]
 */
function ajaxecutePriceRange(url, value, input) {

	$.ajax({
		type: 'POST',
		url: url,
		data: { id: value },
		success: function(data, textStatus, jqXHR) {

			json = jQuery.parseJSON(data);
			//console.log(json);

			// Se existe embarcacao para aquele modelo
			// os valores MAX e MIN não serão NULL
			// então recarrega o Range
			if (json.minprice != null && json.maxprice != null) {

				$(input).ionRangeSlider("update", {
	                min: convertInt(json.minprice),
				    max: convertInt(json.maxprice),
				    from: convertInt(json.minprice),
				    to: convertInt(json.maxprice)
	            });

			} else {// Se não zera o Range

				$(input).ionRangeSlider("update", {
	                min: 0,
				    max: 50000000,
				    from: 0,
				    to: 50000000
	            });

			}

		}
	});

}


/**
 * [convertInt description]
 * @param  {[type]} value [description]
 * @return {[type]}       [description]
 */
function convertInt(value) {
	return parseInt(value.split(".")[0]);
}


function convertToSlug(text) {
    return text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}


function initRangeSlider(id, min, max, step) {

	$(id).ionRangeSlider({
        min: min,
		max: max,
        type: 'double',
        step: step,
        hideMinMax: true,
        hideFromTo:true,
        prettify: true,
        hasGrid: false
    });

}



function resetDropDownModel() {
	$('#form-search .model .slimScrollDiv').empty();
    $('#form-search .model input[name="modelo"]').val("-1");
    $('#form-search .model .cd-dropdown > span > span').text("Selecione a marca");
}


function resetPrice() {
	$("#price").ionRangeSlider("update", {
        min: 0,
	    max: 20000000,
	    from: 0,
	    to: 20000000
    });
}

function resetFeets() {
	$("#feets").ionRangeSlider("update", {
        min: 0,
	    max: 200,
	    from: 0,
	    to: 200
    });
}



    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires;
    }


    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function checkCookie() {

        var user = getCookie("username");
        
        if (user != "") {
            return true;
        } 

        return false;
    }


    function setUrlParameters(key, value) {

	      key = encodeURI(key); value = encodeURI(value);

	      var kvp = document.location.search.substr(1).split('&');

	      var i=kvp.length; var x; 

	      while(i--) 
	      {
	          x = kvp[i].split('=');

	          if (x[0]==key)
	          {
	              x[1] = value;
	              kvp[i] = x.join('=');
	              break;
	          }
	      }

	      if(i<0) {
	        kvp[kvp.length] = [key,value].join('=');
	      }
	      
	      //this will reload the page, it's likely better to store this until finished
	      document.location.search = kvp.join('&'); 
  	}


    function getUrlParameter(sParam) {
	    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
	        sURLVariables = sPageURL.split('&'),
	        sParameterName,
	        i;

	    for (i = 0; i < sURLVariables.length; i++) {
	        sParameterName = sURLVariables[i].split('=');

	        if (sParameterName[0] === sParam) {
	            return sParameterName[1] === undefined ? true : sParameterName[1];
	        }
	    }
	}


	function isMobile() {

		if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

			return true;
		 
		}

		return false;
	}


	function validateEmail(email) {
		if(email == "") return false;
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}
