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
	$('textarea').each( function(index, element)
    {
	$(element).wysiwyg({
    "toolbar": "top-selection",
    "buttons": {
        insertimage: {
            title: 'Insert image',
            image: '\uf030', // <img src="path/to/image.png" width="16" height="16" alt="" />
            //showstatic: true,    // wanted on the toolbar
            showselection: false    // wanted on selection
        },
        insertvideo: {
            title: 'Insert video',
            image: '\uf03d', // <img src="path/to/image.png" width="16" height="16" alt="" />
            //showstatic: true,    // wanted on the toolbar
            showselection: false    // wanted on selection
        },
        insertlink: {
            title: 'Insert link',
            target: '_blank',
            image: '\uf08e' // <img src="path/to/image.png" width="16" height="16" alt="" />
        },
                // Fontsize plugin
                fontsize: {
                    title: 'Size',
                    image: '\uf034', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            // Hack: http://stackoverflow.com/questions/5868295/document-execcommand-fontsize-in-pixels/5870603#5870603
                            var list_fontsizes = [];
                            for( var i=8; i <= 11; ++i )
                                list_fontsizes.push(i+'px');
                            for( var i=12; i <= 28; i+=2 )
                                list_fontsizes.push(i+'px');
                            list_fontsizes.push('36px');
                            list_fontsizes.push('48px');
                            list_fontsizes.push('72px');
                            var $list = $('<div/>').addClass('wysiwyg-plugin-list')
                                                   .attr('unselectable','on');
                            $.each( list_fontsizes, function( index, size ) {
                                var $link = $('<a/>').attr('href','#')
                                                    .html( size )
                                                    .click(function(event) {
                                                        $(element).wysiwyg('shell').fontSize(7).closePopup();
                                                        $(element).wysiwyg('container')
                                                                .find('font[size=7]')
                                                                .removeAttr("size")
                                                                .css("font-size", size);
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           }
                    //showstatic: true,    // wanted on the toolbar
                    //showselection: true    // wanted on selection
                },
                // Header plugin
                header: {
                    title: 'Header',
                    image: '\uf1dc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    popup: function( $popup, $button ) {
                            var list_headers = {
                                    // Name : Font
                                    'Header 1' : '<h1>',
                                    'Header 2' : '<h2>',
                                    'Header 3' : '<h3>',
                                    'Header 4' : '<h4>',
                                    'Header 5' : '<h5>',
                                    'Header 6' : '<h6>',
                                    'Code'     : '<pre>'
                                };
                            var $list = $('<div/>').addClass('wysiwyg-plugin-list')
                                                   .attr('unselectable','on');
                            $.each( list_headers, function( name, format ) {
                                var $link = $('<a/>').attr('href','#')
                                                     .css( 'font-family', format )
                                                     .html( name )
                                                     .click(function(event) {
                                                        $(element).wysiwyg('shell').format(format).closePopup();
                                                        // prevent link-href-#
                                                        event.stopPropagation();
                                                        event.preventDefault();
                                                        return false;
                                                    });
                                $list.append( $link );
                            });
                            $popup.append( $list );
                           }
                    //showstatic: true,    // wanted on the toolbar
                    //showselection: false    // wanted on selection
                },
                bold: {
                    title: 'Bold (Ctrl+B)',
                    image: '\uf032', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'b'
                },
                italic: {
                    title: 'Italic (Ctrl+I)',
                    image: '\uf033', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'i'
                },
                underline: {
                    title: 'Underline (Ctrl+U)',
                    image: '\uf0cd', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 'u'
                },
                strikethrough: {
                    title: 'Strikethrough (Ctrl+S)',
                    image: '\uf0cc', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    hotkey: 's'
                },
                forecolor: {
                    title: 'Text color',
                    image: '\uf1fc' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                highlight: {
                    title: 'Background color',
                    image: '\uf043' // <img src="path/to/image.png" width="16" height="16" alt="" />
                },
                alignleft: {
                    title: 'Left',
                    image: '\uf036', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                aligncenter: {
                    title: 'Center',
                    image: '\uf037', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                alignright: {
                    title: 'Right',
                    image: '\uf038', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                alignjustify: {
                    title: 'Justify',
                    image: '\uf039', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                subscript: {
                    title: 'Subscript',
                    image: '\uf12c', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: true    // wanted on selection
                },
                superscript: {
                    title: 'Superscript',
                    image: '\uf12b', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: true    // wanted on selection
                },
                orderedList: {
                    title: 'Ordered list',
                    image: '\uf0cb', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                unorderedList: {
                    title: 'Unordered list',
                    image: '\uf0ca', // <img src="path/to/image.png" width="16" height="16" alt="" />
                    //showstatic: true,    // wanted on the toolbar
                    showselection: false    // wanted on selection
                },
                removeformat: {
                    title: 'Remove format',
                    image: '\uf12d' // <img src="path/to/image.png" width="16" height="16" alt="" />
                }
            },
            // Submit-Button
            submit: {
                title: 'Submit',
                image: '\uf00c' // <img src="path/to/image.png" width="16" height="16" alt="" />
            },
            // Other properties
            selectImage: 'Click or drop image',
            placeholderUrl: 'www.example.com',
            placeholderEmbed: '<embed/>',
            onImageUpload: function( insert_image ) {
                            // A bit tricky, because we can't easily upload a file via
                            // '$.ajax()' on a legacy browser without XMLHttpRequest2.
                            // You have to submit the form into an '<iframe/>' element.
                            // Call 'insert_image(url)' as soon as the file is online
                            // and the URL is available.
                            // Example server script (written in PHP):
                            /*
                            <?php
                            $upload = $_FILES['upload-filename'];
                            // Crucial: Forbid code files
                            $file_extension = pathinfo( $upload['name'], PATHINFO_EXTENSION );
                            if( $file_extension != 'jpeg' && $file_extension != 'jpg' && $file_extension != 'png' && $file_extension != 'gif' )
                                die("Wrong file extension.");
                            $filename = 'image-'.md5(microtime(true)).'.'.$file_extension;
                            $filepath = '/path/to/'.$filename;
                            $serverpath = 'http://domain.com/path/to/'.$filename;
                            move_uploaded_file( $upload['tmp_name'], $filepath );
                            echo $serverpath;
                            */
                            // Example client script (without upload-progressbar):
                            var iframe_name = 'legacy-uploader-' + Math.random().toString(36).substring(2);
                            $('<iframe>').attr('name',iframe_name)
                                         .load(function() {
                                            // <iframe> is ready - we will find the URL in the iframe-body
                                            var iframe = this;
                                            var iframedoc = iframe.contentDocument ? iframe.contentDocument :
                                                           (iframe.contentWindow ? iframe.contentWindow.document : iframe.document);
                                            var iframebody = iframedoc.getElementsByTagName('body')[0];
                                            var image_url = iframebody.innerHTML;
                                            insert_image( image_url );
                                            $(iframe).remove();
                                         })
                                         .appendTo(document.body);
                            var $input = $(this);
                            $input.attr('name','upload-filename')
                                  .parents('form')
                                  .attr('action','/script.php') // accessing cross domain <iframes> could be difficult
                                  .attr('method','POST')
                                  .attr('enctype','multipart/form-data')
                                  .attr('target',iframe_name)
                                  .submit();
                        },
            forceImageUpload: false,    // upload images even if File-API is present
            videoFromUrl: function( url ) {
                // Contributions are welcome :-)

                // youtube - http://stackoverflow.com/questions/3392993/php-regex-to-get-youtube-video-id
                var youtube_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?(?:youtu\.be|youtube\.com)\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/)([^\?&\"'>]+)/ );
                if( youtube_match && youtube_match[1].length == 11 )
                    return '<iframe src="//www.youtube.com/embed/' + youtube_match[1] + '" width="640" height="360" frameborder="0" allowfullscreen></iframe>';

                // vimeo - http://embedresponsively.com/
                var vimeo_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?vimeo\.com\/([0-9]+)$/ );
                if( vimeo_match )
                    return '<iframe src="//player.vimeo.com/video/' + vimeo_match[1] + '" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                // dailymotion - http://embedresponsively.com/
                var dailymotion_match = url.match( /^(?:http(?:s)?:\/\/)?(?:[a-z0-9.]+\.)?dailymotion\.com\/video\/([0-9a-z]+)$/ );
                if( dailymotion_match )
                    return '<iframe src="//www.dailymotion.com/embed/video/' + dailymotion_match[1] + '" width="640" height="360" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                // undefined -> create '<video/>' tag
            }
  	}); // fim wysig

});

});