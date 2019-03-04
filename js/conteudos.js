$(document).ready(function(){

	  $(".openMenu").click(function(){
    if($(this).hasClass("open")){
      $(this).removeClass("open fa-remove").addClass("fa-bars");
      $(".side-nav").removeClass("open");
    }else{
      $(this).removeClass("fa-bars").addClass("open fa-remove");
      $(".side-nav").addClass("open");
    }
    return false;
  });

	$("#Conteudos_data").datepicker({"format":"dd/mm/yyyy"});

	/**
	 * Scroll do Raio-X
	 */
	$('.more-types').on('click', function(e){
		e.preventDefault();
		$('html,body').animate({
			scrollTop: $('#raiox-todos-videos').offset().top
		}, 2000);
	});

	
	// offset de paginas
	var page = 1;


	/**
	 * AJAX de Notícias
	 * @param  {[type]} e [description]
	 * @return {[type]}   [description]
	 */
	$(".div-btn-carregar-guia-nt").on("click", "#carregar_nt", function(e) {
			e.preventDefault();

			$limit = $(this).data("limit");

			data = {};
			data['page'] = page;
			data['categoria'] = $(this).data("categoria");
			data['busca'] = $(this).data("busca");
			data['ajax'] = true;

			//console.log(data);

			$.ajax({
				url: Yii.app.createUrl('comunidade/noticias'),
				data: data,
				type: 'GET',

				success: function(resp) {

					json = JSON.parse(resp.trim());
					//console.log(json);

					if (json.count > 0) {
						
						$("ul.categories-nt").append(json.html);

						// incrementar page
						page++;

						// Se o resultado for menor que o limite, então apaga o botão de carregar mais
						if (json.count < $limit) {
							$(".div-btn-carregar-guia-nt").empty();
						}

					} else {
						$(".div-btn-carregar-guia-nt").empty();
					}

				},

				error: function(x, h, err) {
					alert('Ocorreu um erro inesperado! Tente novamente');
				}
			});

	});

	

// ready

	/**
	 * AJAX do Primeiro Barco
	 * @param  {[type]} e [description]
	 * @return {[type]}   [description]
	 */
	$(".div-botao-carregar-pb").on("click", "#carregar_pb", function(e) {
			e.preventDefault();

			$limit = $(this).data("limit");

			data = {};
			data['page'] = page;
			data['busca'] = $(this).data("busca");
			data['ajax'] = true;

			console.log(page);

			$.ajax({
				url: Yii.app.createUrl('comunidade/primeiro-barco'),
				data: data,
				type: 'GET',

				success: function(resp) {

					json = JSON.parse(resp.trim());
					//console.log(json);

					if (json.count > 0) {
						
						$("ul.categories-pb").append(json.html);

						// incrementar page
						page++;

						// Se o resultado for menor que o limite, então apaga o botão de carregar mais
						if (json.count < $limit) {
							$(".div-botao-carregar-pb").empty();
						}

					} else {
						$(".div-botao-carregar-pb").empty();
					}

				},

				error: function(x, h, err) {
					alert('Ocorreu um erro inesperado! Tente novamente');
				}
			});

	});



	/**
	 * AJAX Teste Bom Barco
	 * @param  {[type]} e [description]
	 * @return {[type]}   [description]
	 */
	$(".div-btn-carregar-video").on("click", "#carregar-video", function(e) {
			e.preventDefault();

			$limit = $(this).data("limit");

			data = {};
			data['page'] = page;
			data['busca'] = $(this).data("busca");
			data['macro'] = $(this).data("macro");
			data['ajax'] = true;

			console.log(page);

			$.ajax({
				url: Yii.app.createUrl('comunidade/teste-bombarco'),
				data: data,
				type: 'GET',

				success: function(resp) {

					json = JSON.parse(resp.trim());
					//console.log(json);

					if (json.count > 0) {
						
						$("ul.categories-videos-lw4").append(json.html);

						/*Plugin Video*/
						$('.js-lazyYT').lazyYT(); 
						/*Fim*/

						/* Funções para a pagina de video */		
						$('#btn-video1').click(function(e) {
						    $('.lbox-videos').lightbox_me({
						        centered: true, 
						        onLoad: function() { 
						            $('.lbox-videos .lazyYT-button ').trigger('click'); 
						            }
						        });
						    e.preventDefault();
						});
						/*Fim*/	
						/* Funções para a pagina de video */		
						$('.icon-play').click(function(e) {
						    $('.lbox-videos').lightbox_me({
						        centered: true, 
						        onLoad: function() { 
						            $('.lbox-videos .lazyYT-button ').trigger('click'); 
						            }
						        });
						    e.preventDefault();
						});
						/*Fim*/	

						// incrementar page
						page++;

						// Se o resultado for menor que o limite, então apaga o botão de carregar mais
						if (json.count < $limit) {
							$(".div-btn-carregar-video").empty();
						}

					} else {
						$(".div-btn-carregar-video").empty();
					}

				},

				error: function(x, h, err) {
					alert('Ocorreu um erro inesperado! Tente novamente');
				}
			});

	});

	// 
	$(".options-category-video").on("click", ".tab", function(e) {
		e.preventDefault();
		
		var $this = $(this);

		if ($this.hasClass("todos-vid")) {
			$("#form-search input[name='macro']").val("");	
		};

		if ($this.hasClass("speedboat-vid")) {
			$("#form-search input[name='macro']").val("lancha");	
		};

		if ($this.hasClass("sailboat-vid")) {
			$("#form-search input[name='macro']").val("veleiro");	
		};

		if ($this.hasClass("jetski-vid")) {
			$("#form-search input[name='macro']").val("jetski");	
		};

		if ($this.hasClass("pesca-vid")) {
			$("#form-search input[name='macro']").val("barcos-pesca");	
		};
		
	});


	var txt_prev = $('.spotlight-banner .slide').eq(2).find(".title").text();
	var txt_next = $('.spotlight-banner .slide').eq(1).find(".title").text();

	$('.spotlight-banner .controls .prev .title-next').html(txt_prev);
	$('.spotlight-banner .controls .next .title-next').html(txt_next);

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


	/* Blog */
	$('.select-form-nt').on('click', '.slimScrollDiv li', function() {
		$("#form-search").submit();
	});
	/* Fim */

	// tiny mce
	    tinymce.init({
        selector: "textarea",
        theme: "modern",
        language: "pt_BR",
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        //width: 680,
        branding: false,
        statusbar: false,
        height: 500,
        subfolder: "",
        default_link_target:"_blank",
        plugins: [
            "advlist autolink link lists charmap preview hr pagebreak media",
            "searchreplace visualblocks visualchars nonbreaking",
            "table contextmenu directionality emoticons paste textcolor"
        ],
        image_advtab: true,
        toolbar: "fontsizeselect undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink | preview mybutton media",
        setup: function(editor) {
            editor.addButton('mybutton', {
                text: "",
                icon: 'image',
                onclick: function(e) {
                    console.log($(e.target));
                    if ($(e.target).prop("tagName") == 'BUTTON') {
                        console.log($(e.target).parent().parent().find('input').attr('id'));
                        if ($(e.target).parent().parent().find('input').attr('id') != 'tinymce-uploader') {
                            $(e.target).parent().parent().append('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
                        }
                        $('#tinymce-uploader').trigger('click');
                        $('#tinymce-uploader').change(function() {
                            var input, file, fr, img;

                            if (typeof window.FileReader !== 'function') {
                                write("The file API isn't supported on this browser yet.");
                                return;
                            }

                            input = document.getElementById('tinymce-uploader');
                            if (!input) {
                                write("Um, couldn't find the imgfile element.");
                            } else if (!input.files) {
                                write("This browser doesn't seem to support the `files` property of file inputs.");
                            } else if (!input.files[0]) {
                                write("Please select a file before clicking 'Load'");
                            } else {
                                file = input.files[0];
                                fr = new FileReader();
                                fr.onload = createImage;
                                fr.readAsDataURL(file);
                            }

                            function createImage() {
                                img = new Image();
                                img.src = fr.result;
                                editor.insertContent('<img src="' + img.src + '"/>');

                            }

                        });

                    }
                    if ($(e.target).prop("tagName") == 'DIV') {
                        if ($(e.target).parent().find('input').attr('id') != 'tinymce-uploader') {
                            console.log($(e.target).parent().find('input').attr('id'));
                            $(e.target).parent().append('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
                        }
                        $('#tinymce-uploader').trigger('click');
                        $('#tinymce-uploader').change(function() {
                            var input, file, fr, img;

                            if (typeof window.FileReader !== 'function') {
                                write("The file API isn't supported on this browser yet.");
                                return;
                            }

                            input = document.getElementById('tinymce-uploader');
                            if (!input) {
                                write("Um, couldn't find the imgfile element.");
                            } else if (!input.files) {
                                write("This browser doesn't seem to support the `files` property of file inputs.");
                            } else if (!input.files[0]) {
                                write("Please select a file before clicking 'Load'");
                            } else {
                                file = input.files[0];
                                fr = new FileReader();
                                fr.onload = createImage;
                                fr.readAsDataURL(file);
                            }

                            function createImage() {
                                img = new Image();
                                img.src = fr.result;
                                editor.insertContent('<img src="' + img.src + '"/>');

                            }

                        });

                    }
                    if ($(e.target).prop("tagName") == 'I') {
                        console.log($(e.target).parent().parent().parent().find('input').attr('id'));
                        if ($(e.target).parent().parent().parent().find('input').attr('id') != 'tinymce-uploader') {
                            $(e.target).parent().parent().parent().append('<input id="tinymce-uploader" type="file" name="pic" accept="image/*" style="display:none">');
                        }
                        $('#tinymce-uploader').trigger('click');
                        $('#tinymce-uploader').change(function() {
                            var input, file, fr, img;

                            if (typeof window.FileReader !== 'function') {
                                write("The file API isn't supported on this browser yet.");
                                return;
                            }

                            input = document.getElementById('tinymce-uploader');
                            if (!input) {
                                write("Um, couldn't find the imgfile element.");
                            } else if (!input.files) {
                                write("This browser doesn't seem to support the `files` property of file inputs.");
                            } else if (!input.files[0]) {
                                write("Please select a file before clicking 'Load'");
                            } else {
                                file = input.files[0];
                                fr = new FileReader();
                                fr.onload = createImage;
                                fr.readAsDataURL(file);
                            }

                            function createImage() {
                                img = new Image();
                                img.src = fr.result;
                                editor.insertContent('<img src="' + img.src + '"/>');

                            }

                        });

                    }

                }
            });
        }
    });
	// fim

	$("#btn-cadastrar").on("click", function(e) {
	 	// validação antes do submit
	 	e.preventDefault();
	 	var macro_conteudo = $("#macro_conteudo").val();
	 	var titulo = $("#conteudo_titulo").val();
	 	var emb_macro = $("#embarcacao_macros_conteudo").val();
	 	var data = $("#Conteudos_data").val();
	 	$("#texto-noticia").val(tinyMCE.activeEditor.getContent());

	 	var flgok = true;

	 	// se for blog e n tiver selecionad sub categoria
	 	if(macro_conteudo == 'B') {
	 		if($("#conteudo_categorias_id").val() == "") {
	 			flgok = false;
	 			$("#error-sub-categoria").html("Favor selecione a sub-categoria");
	 		}
	 	}

	 	if(macro_conteudo == "") {
	 		flgok = false;
	 		$("#error-macro").html("Favor selecione a categoria");
	 	}

	 	if(titulo == "") {
	 		flgok = false;
	 		$("#error-titulo").html("Favor insira o titulo");
	 	}

	 	if(emb_macro == "") {
	 		flgok = false;
	 		$("#error-emb-macro").html("Favor selecione a categoria da embarcação");
	 	}

	 	if(data == "") {
	 		flgok = false;
	 		$("#error-data").html("Favor selecione a data");
	 	}

	 	// erro
	 	if(!flgok) {
	 		$('html, body').animate({scrollTop:200}, 'slow');
	 	}
	 	// ok
	 	else {
	 		$("#conteudos-form").submit();
	 	}
	 });


});