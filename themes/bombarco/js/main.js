$(document).ready(function() {

    var d = new Date();
    var n = d.getHours();

    console.log(n);

    if(n >= 8 && n <= 19) {


        /* plugin whats app */
        (function () {
            var options = {
                whatsapp: "+5511989698912", // WhatsApp number
                call_to_action: "Entrar em contato", // Call to action
                position: "right", // Position may be 'right' or 'left'
            };
            var proto = document.location.protocol, host = "whatshelp.io", url = proto + "//static." + host;
            var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
            s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
            var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
        })();

        /* */

    }



  $("li.li-dropdown > a").click(function(){
    $(this).next().slideToggle();
    $(this).parent().toggleClass("active")
    return false;
  });
  $(".menuMobile a.fa").click(function(){
    if($(this).hasClass("active")){
      $("#content, footer, .line-det-est-3, .line-white-3-listagem, .line-footer-white, .line-det-est-4, .line-det-est-5").show();
      $(".header .menu-head").css({"position":"fixed"});
      $(this).removeClass("active fa-remove").addClass("fa-bars");
    }else{
      $("#content, footer, .line-det-est-3, .line-white-3-listagem, .line-footer-white, .line-det-est-4, .line-det-est-5").hide();
      $(".header .menu-head").css({"position":"static"});
      $(this).addClass("active fa-remove").removeClass("fa-bars");
    }
    $(this).next().slideToggle();
    return false;
  });
  $(".bloco-title").click(function(){
    if($(this).next().hasClass("show")){
      $(this).next().removeClass("show");
    }else{
      $(this).next().addClass("show");
    }
    return false;
  })
  if($(".btn-carregar-mais")[0] && $(window).width() > 789){
    $(".btn-carregar-mais").parent().css("opacity","0");
    loading = false;
    li = $("." + $(".btn-carregar-mais").attr("rel") + " li").size();
    interval = null;
  }
  $(document).scroll(function(){
    if($(".btn-carregar-mais")[0]){
      if(($(document).scrollTop() + $(window).height() / 2) >= $(".btn-carregar-mais").parent().position().top && !loading){
        loading = true;
        $(".btn-carregar-mais").click();
        interval = setInterval(function(){
          if(li < $("." + $(".btn-carregar-mais").attr("rel") + " li").size()){
            loading = false;
            clearInterval(interval);
          }
        }, 500);
      }
    }
  })
    /*==========  Avoid XSS  ==========
    var inputs = document.getElementsByTagName("input");
    var count = inputs.length;
    for (var i=0; i < count; i++) {
        inputs[i].addEventListener("input", function(e) {
            this.value = this.value.replace(/[`~!#%^&*()|+\-=÷¿?;:'"<>\{\}\[\]\\\/]/gi, '');
        });
    }*/


    /**
     * General Alert
     */
    $("body").on("click", ".general-alert", function(){
        $(this).slideUp('slow');
    });
    $(".general-alert").delay(3000).slideUp('slow');

    // Botão Minha conta - login

    // $(".account").on({
    //      mouseenter: function() {

    //          $('.sub-account').slideDown();

    //      },
    //      mouseleave: function() {

    //          $('.sub-account').slideUp();

    //      }
    //  },

    // });

    /*$('.account ')
        .mouseover(function(){
            $('.sub-account').show();
        })
        .mouseout(function(){
            setTimeout(function(){
                    $('.sub-account').delay(2000).hide();
                }, 5000);

        });*/

        //teste

        $(function(){
            if ($('.box-checkbox-list').click() || $('.select-listagem1').click()){
                // alert('oi');
                // if ($('.checkbox1-l1 input').is(':checked') || $('.select-listagem1 input').attr('value') != -1) {
                //  $('#btn-buscar-mais-filtro').css({
                //      'background':'#ff6800',
                //    'border-color': '#ff6800'
                //      });
                // } else{
                //  $('#btn-buscar-mais-filtro').css({
                //      'background':'#0f2e44 ',
                //    'border-color': '#0f2e44 '
                //      });
                // };
            }
        });

            // $('.box-checkbox-list').on('click', function(){

            //  if ( $('.checkbox1-l1 input').is(':checked') ) {
            //      $('#btn-buscar-mais-filtro').css({
            //          'background':'#ff6800',
            //        'border-color': '#ff6800'
            //          });
            //  } else{
            //      $('#btn-buscar-mais-filtro').css({
            //          'background':'#0f2e44 ',
            //        'border-color': '#0f2e44 '
            //          });
            //  }

            // });

            // $('.select-listagem1').on('click', function(){
            //  if ($('.select-listagem1 input').attr('value') != -1){
            //      $('#btn-buscar-mais-filtro').css({
            //          'background':'#ff6800',
            //        'border-color': '#ff6800'
            //          });
            //  } else{
            //      $('#btn-buscar-mais-filtro').css({
            //          'background':'#0f2e44 ',
            //        'border-color': '#0f2e44 '
            //          });
            //  }

            // });


    // Função que altera os checkboxs do Minha conta

    $('.info-label-checkbox').on('click',function(){
        $(this).children().toggleClass('checked');
    $(this).prev().trigger('change');
    $(this).prev().trigger('click');
    })

    // Função que altera os radios da tela de login

    $('.info-label-radio').on('click',function(){
        $(this).children().toggleClass('checked');
        $(this).siblings().children().removeClass('checked');
    $(this).prev().trigger('change');
    $(this).prev().trigger('click');
    })


    // Colore as linhas das mensagens;

    $('.mensagens-row:odd').css('background','#f1f1f1');

    // Colores as linhas de pagamento

    $('.row-grid-pagamentos:even').children('.cell-grid-pagamentos-sm').css('background','#f1f1f1');
    $('.row-grid-pagamentos:even').children('.cell-grid-pagamentos-lg').css('background','#f1f1f1');


    $('.account').on("click", function() {
        $(this).toggleClass('acc-open');
    });

    $(".li-minha-conta").on("click", function(){
        var $a = $(this).find('a');
        location.href = $a.attr("href");
    });



    
    // contabiliza view do banner
    $(".banner-link").each(function() {

        // ajax contabilizar clique
        var banner_id = $(this).children('img').data('banner_id');
        var href = $(this).attr('href');

        var flg = false;

        $.ajax({
            url: Yii.app.createUrl('banners/contabilizarView'),
            type: 'post',
            async: false,
            data: { banner_id: banner_id },
            success: function(resp) {
                flg = true;
            },
        });
    });




    // contabilizar cliques no banner
    $(".banner-link img").on("click", function(e){
        e.preventDefault();

        // ajax contabilizar clique
        var banner_id = $(this).data('banner_id');
        var href = $(this).parent().attr('href');

        var flg = false;

        $.ajax({
            url: Yii.app.createUrl('banners/contabilizarClique'),
            type: 'post',
            async: false,
            data: { banner_id: banner_id },
            success: function(resp) {
                flg = true;
            },
        });

        if(flg == true) {
            window.open(href, '_blank');
        }

    });


    // GA

    // banner float
    $('.banner-float').on('click', function(){
                $(this).animate({'top':'0','left':'0','width':'100%','height':'100%'}, 600).addClass('full-screen-float');
                $(this).find('.action-float').remove();
                $(this).find('.close-float').fadeIn('slow');

                $('#ajax_video').html("<iframe width='100%' height='100%' src='http://www.youtube.com/embed/1HV73D-aCDE' frameborder='0' allowfullscreen></iframe>");
            });
            $('.close-float').on('click', function(){
                $('.banner-float').remove();
            });

            // demorar 2 segundos pra aparecer o banner
            setTimeout( "$('.banner-float').fadeIn('fast');",2000 );

    //$('.banner-float-video').lazyYT();


    //slider videos home
    function autoPlayVideo(src, width, height){
        "use strict";
        $(".activevideo .video-theater").append('<iframe width="'+width+'" height="'+height+'" src="'+src.trim()+'" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
    }
    function autoPlayVideolist(src, width, height){
        "use strict";
        $(".lightbox-videos .content-video").append('<iframe width="'+width+'" height="'+height+'" src="'+src+'" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
    }
    function autoPlayView(src, width, height) {
        var str = src.trim();
        var str = str.replace(/(?:https:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g, '<iframe width="'+width+'" height="'+height+'" src="http://www.youtube.com/embed/$1?autoplay=1" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
        $(".quadro-l1-deemb5 .box-video").append(str);
    }


    /* auto play guia */
    function autoPlayViewGuia(src, width, height) {
        var str = src.trim();
        var str = str.replace(/(?:https:\/\/)?(?:www\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=)?(.+)/g, '<iframe width="'+width+'" height="'+height+'" src="http://www.youtube.com/embed/$1?autoplay=1" frameborder="0" allowfullscreen wmode="Opaque"></iframe>');
        $(".box-video").append(str);
        $("#imagem-principal").fadeOut("fast");
    }
    //www.youtube-nocookie.com/embed/Iys58dFKQHM?autoplay=1&enablejsapi=1&version=3&hd=1&playerapiid=ytplayer&autohide=1&showinfo=0
    $('a.icon-play').click(function(){

        $('.video-theater iframe').remove();
        $('.slider .slide').removeClass('activevideo');
        $(this).parent().parent().addClass('activevideo');
        var urlvideo = $('.activevideo .video-url').val();
        //alert(urlvideo);
        autoPlayVideo(urlvideo,'450','283');
            $('.activevideo .video-theater').show();
    });
    $('.video-theater .close-video').click(function(e){
        $('.video-theater iframe').remove();
        $('.video-theater').fadeOut();
        $('.slider .slide').removeClass('activevideo');
        e.preventDefault();
    });
    $('.spotlight-banner .controls a, .line-videos-3 .controls a').on('click', function(e){
        $('.slider .activevideo .video-theater iframe').remove();
    });
    //videos teste bombarco
    $('body').on('click', '.lazyYT-button', function(e){
        $('.lightbox-videos .content-video iframe').remove();
        $('.category-videos–lw4').removeClass('activevideo');
        $(this).closest('.category-videos–lw4').addClass('activevideo');
        var urlvideo = $('.category-videos–lw4.activevideo .video-url').val();
        autoPlayVideolist(urlvideo,'800','400');
        $('.lightbox-videos').show();
        e.preventDefault();
    });
    $('.lightbox-videos .close-video').click(function(e) {
        $('.content-video iframe').remove();
        $('.lightbox-videos').fadeOut();
        $('.category-videos–lw4').removeClass('activevideo');
        e.preventDefault();
    });

    //video view embarcações
    $('.quadro-l1-deemb7 .lazyYT-button').click(function(e) {
        var videourl = $(this).data("video");
        $('.box-video iframe').remove();
        $('.box-video').fadeIn();
        autoPlayView(videourl, '610', '410' );
    });
    $('.img-thumbnail-emb').click(function(e){
        $('.box-video').fadeOut();
    });
    // fim

    /* video guia de empresas */
    $('.video-guia .lazyYT-button').click(function(e) {

        var videourl = $(this).data("video");
        $('.box-video iframe').remove();
        $('.box-video').fadeIn();
        autoPlayViewGuia(videourl, '610', '410' );
    });

    /* fim */

        /* mailing rodapé */
        $(".form-newsletter form").submit(function(e) {
            e.preventDefault();
            var email = $("#email", this).val();
            var user_agent = navigator.userAgent;


            if(!email || !validateEmail(email)) {
                $("#email", this).val("E-mail inválido!");
            }

            // ok - ajax salvar mail
            else {

                $.ajax({
                    url: Yii.app.createUrl('maillings/create'),
                    data: {email: email, user_agent: user_agent},
                    type: 'post',

                    success: function(resp) {

                        ga('send', 'event', 'link', 'click', 'Cadastro E-mail');

                        // msg de sucesso
                        if(resp.trim() == '1') {
                            // lightbox msg sucesso
                            $('#lbox-mailling').lightbox_me({
                                        centered: true,
                                        onLoad: function() {
                                            $('html, body').animate({scrollTop: 50}, 'slow');
                                            $('#lbox-mailling').addClass("show");
                                        },
                                        onClose: function() {
                                            $('#lbox-mailling').removeClass("show");
                                            location.reload();
                                        }
                                        });
                            $("#email").val("");
                        }

                        else if(resp == '-3') {
                            $("#email").val("E-mail já está cadastrado!");
                        }

                        else {
                            $("#email").val("Erro ao enviar o email");
                        }


                    },

                    error: function(x, h, z) {
                        $("#email").val("Erro ao enviar o email");
                    }
                });
            }
        });

        /* funcition validar email */
        function validateEmail(email) {

            if(!email)
                return false;

                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if( !emailReg.test( email ) ) {
                        return false;
                } else {
                        return true;
                }
        }
        /* fim */

        /*Função para botoes do footer*/
        $('#btn-footer-politica').click(function(e) {
            $('#texto_politica').load(Yii.app.createUrl('politica.html'), function() {
                
            });
          $('#lbox-footer-politica').lightbox_me({
            centered: true,
            onLoad: function() {
              if($(window).width() < 789){
                $('#lbox-footer-politica').addClass("show").css({"top":$(window).scrollTop() + 40, "marginTop":0})
                $(".botao-concordar-footer, .lb_overlay").click(function(){
                  $('#lbox-footer-politica').removeClass("show");
                })
              }
            }
          });
          e.preventDefault();
        });

        $('#btn-footer-termos').click(function(e) {
            $('#texto_termos').load(Yii.app.createUrl('termos.html'), function() {
                
            });

          $('#lbox-footer-termos').lightbox_me({
            centered: true,
            onLoad: function() {
              if($(window).width() < 789){
                $('#lbox-footer-termos').addClass("show").css({"top":$(window).scrollTop() + 40, "marginTop":0})
                $(".botao-concordar-footer").click(function(){
                  $('#lbox-footer-termos').removeClass("show");
                })
              }
            }
          });
          e.preventDefault();
        });
        /*Fim*/

        /*Função Admin Cadastro de banners */
        // if ( $( ".quadro-l3-a-detfab" ).length == 0 ) {
        // $('.quadro-l3-b-detfab').css('margin-right','160px');
        // };

        // if ( $( ".quadro-l3-b-detfab" ).length == 0 ) {
        // $('.quadro-l3-a-detfab').css('margin-left','304px');
        // };
        /*Fim*/

        /*Função para botões - Subir telas*/
        $('#btn-subir-bb').click(function(){
            $('html, body').animate({scrollTop:0}, 'slow');
             return false;
         });
        /*Fim*/

        $('.btn-file2').on('click', function(e) {
        $(this).prev().click();
        e.preventDefault();
        });

        $('.box-admin-form6 input[type="file"]').on('change', function(e) {

            $(this).next().text('Adicionado');
            $(this).next().css('background', '#FF6800');
        });


        /*Funções para telas do Admin */
        $('#alterar-estado').click(function(){
            $('#Embarcacoes_estados_id').addClass('select-admin-pad');
            $('#Embarcacoes_cidades_id').addClass('select-admin-pad');
        });

        $('#alterar-motor').click(function(){
            $('#Embarcacoes_motor_marca').addClass('select-admin-pad');
            $('#Embarcacoes_motor_modelo').addClass('select-admin-pad');
            $('#Embarcacoes_motor_tipo').addClass('select-admin-pad');
            $('#Embarcacoes_motor_potencia').addClass('select-admin-pad');
            $('#qnt-motores').addClass('select-admin-pad');
        });

        /*Fim*/

        $('#alterar-estado-cidade').click(function(){
            $('#Embarcacoes_estados_id').addClass('select-admin-pad2');
            $('#Embarcacoes_cidades_id').addClass('select-admin-pad2');
        });




        /*Conteudo Paginas Anunciar*/
        $(".btn-menu-anunciar").on("click", function(e){
            e.preventDefault();
            $(".line-3-an").hide();
            var id = $(this).attr("href");
            $("#"+id).fadeIn("slow");
        });
        /*Fim*/



        /*Função Pagina Pagamento*/
        $("#botao-pag-2").click(function(e) {
                $('.linha-pagamento-4').css('display','block');
                $('.linha-pagamento-5').css('display','block');
            e.preventDefault();
         });
        /*Fim*/

        /*Plugin Video*/
        $('.js-lazyYT').lazyYT();
        /*Fim*/

        // Função para LightBox
        $('#botao-cadastre-ag').click(function(e) {
                $('#lbox-ag').lightbox_me({
                        centered: true,
                        onLoad: function() {

                                }
                        });
                e.preventDefault();
        });
        /*Fim*/

        //link ver telefone
        $('.link-view-tel').on('click', function(e){

            ga('send', 'event', 'link', 'click', 'Visualizar Telefone');

            var tel = $(this).data('tel');

            $('.div-text-end-bloco2-l3-deemb .tel-add').text(tel);

            // ajax contabilizar "ver telefone"
            var id_embarcacao = $("#id_embarcacao").val();
            $.ajax({
                url: Yii.app.createUrl('embarcacoes/contabilizarVerTelefone'),
                data: { id_embarcacao: id_embarcacao },
                type: 'post'
            });

            e.preventDefault();
        });
        /*Fim*/



        /*Função Video Home*/
        /*$('.stop-video-too').on('click', function() {
             //$('#video-slide-home-1').stopVideo();
            $('#video-slide-home-1')[0].contentWindow.postMessage('{"event":"command","func":"' +'stopVideo' + '","args":""}', '*');
        });

        $('#icon-video-home-1').on('click', function() {
             //$('#video-slide-home-1').playVideo();
            $('#video-slide-home-1')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
        });*/
        /*
        $('.stop-video-too').on('click', function() {
             //$('#video-slide-home-1').stopVideo();
        $('#video-slide-home-2')[0].contentWindow.postMessage('{"event":"command","func":"' +'stopVideo' + '","args":""}', '*');
        });

        $('#icon-video-home-2').on('click', function() {
             //$('#video-slide-home-1').playVideo();
        $('#video-slide-home-2')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
        });

        $('.stop-video-too').on('click', function() {
             //$('#video-slide-home-1').stopVideo();
        $('#video-slide-home-3')[0].contentWindow.postMessage('{"event":"command","func":"' +'stopVideo' + '","args":""}', '*');
        });

        $('#icon-video-home-3').on('click', function() {
             //$('#video-slide-home-1').playVideo();
        $('#video-slide-home-3')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
        });
        */

        /*Videos Teste Bombarco Modelo Estatico*/
        /*$('.stop-video-too2').on('click', function() {
             //$('#video-slide-home-1').stopVideo();
        $('#video-slide-teste-1')[0].contentWindow.postMessage('{"event":"command","func":"' +'stopVideo' + '","args":""}', '*');
        });

        $('#iconplay-teste1').on('click', function() {
             //$('#video-slide-home-1').playVideo();
        $('#video-slide-teste-1')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
        });

        $('.stop-video-too2').on('click', function() {
             //$('#video-slide-home-1').stopVideo();
        $('#video-slide-teste-2')[0].contentWindow.postMessage('{"event":"command","func":"' +'stopVideo' + '","args":""}', '*');
        });

        $('#iconplay-teste2').on('click', function() {
             //$('#video-slide-home-1').playVideo();
        $('#video-slide-teste-2')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
        });

        $('.stop-video-too2').on('click', function() {
             //$('#video-slide-home-1').stopVideo();
        $('#video-slide-teste-3')[0].contentWindow.postMessage('{"event":"command","func":"' +'stopVideo' + '","args":""}', '*');
        });

        $('#iconplay-teste3').on('click', function() {
             //$('#video-slide-home-1').playVideo();
        $('#video-slide-teste-3')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
        });


        $('#iconplay-teste1').click(function() {
                $('.video-theater').fadeIn();

        });
        $('#iconplay-teste2').click(function() {
                $('.video-theater').fadeIn();

        });
        $('#iconplay-teste3').click(function() {
                $('.video-theater').fadeIn();

        });*/
        /*Fim*/
        $('.container-controls').click(function() {
            //alert('Video Pausado - Retorno da imagem')
                $('.video-theater').fadeOut();
                //$(iframe).fadeOut();

        });

        $('.controls').click(function() {
            //alert('Video Pausado - Retorno da imagem')
                $('.video-theater').fadeOut();
             // $(iframe).fadeOut();

        });


        /*$('#icon-video-home-1').click(function() {
                $('.video-theater').fadeIn();

        });
        $('#icon-video-home-2').click(function() {
                $('.video-theater').fadeIn();

        });
        $('#icon-video-home-3').click(function() {
                $('.video-theater').fadeIn();

        });*/


        /*$('#btn-video1').click(function() {
                $('.video-theater').fadeIn();
                $('#video-slide-teste-1')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
            $('#video1-teste').addClass('active');
        });

        $('#btn-video2').click(function() {
                $('.video-theater').fadeIn();
                $('#video-slide-teste-2')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
            $('#video2-teste').addClass('active');
        });

        $('#btn-video3').click(function() {
                $('.video-theater').fadeIn();
                $('#video-slide-teste-3')[0].contentWindow.postMessage('{"event":"command","func":"' +'playVideo' + '","args":""}', '*');
            $('#video3-teste').addClass('active');
        });
        */

        /*Fim*/



        /* Funções para a pagina de video */
        /*$('#btn-video1').click(function(e) {
                $('.lbox-videos').lightbox_me({
                        centered: true,
                        onLoad: function() {
                                $('.lbox-videos .lazyYT-button ').trigger('click');
                                }
                        });
                e.preventDefault();
        });
        */

        $("#close-bb-video").click(function(e) {
            $('#teste').remove();
            $('.lb_overlay').remove();
                e.preventDefault();
         });

        $(".lb_overlay").click(function(e) {
            $('#teste').remove();
            $('.lb_overlay').remove();
                e.preventDefault();
         });
        /*Fim*/
        /* Funções para a pagina de video */
        /*
        $('.icon-play').click(function(e) {
                $('.lbox-videos').lightbox_me({
                        centered: true,
                        onLoad: function() {
                                $('.lbox-videos .lazyYT-button ').trigger('click');
                                }
                        });
                e.preventDefault();
        });
        */
        /*Fim*/



        /*Função Pagamento*/
        $("#botao-pag-2").click(function(e) {
                $('.linha-pagamento-4').css('display','block');
                $('.linha-pagamento-5').css('display','block');
            e.preventDefault();
         });
        /*Fim*/



        /*Função para as Paginas com Menus na parte superior / Lancha / Veleiros / Jet Ski*/
        $('.options-category-esta li.tab').on('click',function(){
            if( $(this).hasClass('active')){

            } else{
                $('.options-category-esta li.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        $('.options-category-video li.tab').on('click',function(){
            if( $(this).hasClass('active')){

            } else{
                $('.options-category-video li.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        $('.options-category-homar li.tab').on('click',function(){
            if( $(this).hasClass('active')){

            } else{
                $('.options-category-homar li.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        $('.options-category-tabela li.tab').on('click',function(){
            if( $(this).hasClass('active')){

            } else{
                $('.options-category-tabela li.active').removeClass('active');
                $(this).addClass('active');
            }
        });
        /*Fim*/


        $("#btn-cadastrar-form-ag").click(function(e) {
                $('#lbox-msgok').lightbox_me({
                        centered: true,
                        onLoad: function() {

                                }
                        });
                e.preventDefault();
        });

        /*Fim*/


        /* Função para as paginas Sobre */


        $('#btn-planos-veja-a').click(function(e) {
            e.preventDefault();
            $('#lbox-grande-planos-c').lightbox_me({centered: true});
        });

        $('#btn-planos-veja-b').click(function(e) {
            e.preventDefault();
            $('#lbox-grande-planos-a').lightbox_me({centered: true});
        });

        $('#btn-planos-veja-c').click(function(e) {
            e.preventDefault();
            $('#lbox-grande-planos-b').lightbox_me({centered: true});
        });

        $('#btn-contato-planos').click(function(e) {
                $('#lbox-contato-planos').lightbox_me({
                        centered: true,
                        onLoad: function() {
                              if($(window).width() < 789){
                                $('#lbox-contato-planos').css({"top":$(window).scrollTop() + 40, "marginTop":0})
                              }
                                }
                        });
                e.preventDefault();
        });

        $('#btn-contato-planos2').click(function(e) {
                $('#lbox-contato-planos').lightbox_me({
                        centered: true,
                        onLoad: function() {
                              if($(window).width() < 789){
                                $('#lbox-contato-planos').css({"top":$(window).scrollTop() + 40, "marginTop":0})
                              }
                                }
                        });
                e.preventDefault();
        });


        $(window).bind('scroll', function(){
                    var height = 387;

                    if ($(this).scrollTop() > height) {
                            $('#faixa-planos-fixed').addClass('fixed-lpf')
                    } else {
                            $('#faixa-planos-fixed').removeClass('fixed-lpf')
                    }
            });

            /*---*/

        $(window).bind('scroll', function(){
                    var height = 380;
                    var height2 = 990;


                    if ($(this).scrollTop() > height) {
                             $('#btn-planos-a').addClass('texto-verde-fixed')
                    } else {
                             $('#btn-planos-a').removeClass('texto-verde-fixed')
                    }

                    if ($(this).scrollTop() > height2) {
                             $('#btn-planos-a').removeClass('texto-verde-fixed')
                    }
            });
            $(window).bind('scroll', function(){
                    var height = 990;
                    var height2 = 1525;

                    if ($(this).scrollTop() > height) {
                             $('#btn-planos-b').addClass('texto-verde-fixed')
                    } else {
                             $('#btn-planos-b').removeClass('texto-verde-fixed')
                    }

                    if ($(this).scrollTop() > height2) {
                             $('#btn-planos-b').removeClass('texto-verde-fixed')
                    }
            });
            $(window).bind('scroll', function(){
                    var height = 1525;
                    var height2 = 1880;

                    if ($(this).scrollTop() > height) {
                             $('#btn-planos-c').addClass('texto-verde-fixed')
                    } else {
                             $('#btn-planos-c').removeClass('texto-verde-fixed')
                    }

                    if ($(this).scrollTop() > height2) {
                             $('#btn-planos-c').removeClass('texto-verde-fixed')
                    }
            });
            $(window).bind('scroll', function(){
                    var height = 1880;

                    if ($(this).scrollTop() > height) {
                             $('#btn-planos-d').addClass('texto-verde-fixed')
                    } else {
                             $('#btn-planos-d').removeClass('texto-verde-fixed')
                    }
            });

            /*---*/

        $('#btn-planos-a').click(function(){
             $('html, body').animate({scrollTop:385}, 'slow');
                 return false;
         });

        $('#btn-planos-b').click(function(){
             $('html, body').animate({scrollTop:995}, 'slow');
                 return false;
         });

        $('#btn-planos-c').click(function(){
             $('html, body').animate({scrollTop:1530}, 'slow');
                 return false;
         });

        $('#btn-planos-d').click(function(){
             $('html, body').animate({scrollTop:1885}, 'slow');
                 return false;
         });
        /*Fim*/


            /* Função para fechar Dropdowns*/
        $('span.close-dd').on('mouseleave', function(e) {
            $('.cd-dropdown').removeClass('cd-active');
             e.preventDefault();
        });

        /*Fim*/

        function requestFullScreen() {

            var el = document.body;

            // Supports most browsers and their versions.
            var requestMethod = el.requestFullScreen || el.webkitRequestFullScreen
            || el.mozRequestFullScreen || el.msRequestFullScreen;

            if (requestMethod) {

                // Native full screen.
                requestMethod.call(el);

            } else if (typeof window.ActiveXObject !== "undefined") {

                // Older IE.
                var wscript = new ActiveXObject("WScript.Shell");

                if (wscript !== null) {
                    wscript.SendKeys("{F11}");
                }
            }
        }


            /*Função para Pagina Pagamento*/
        $("#botao-pag-2").click(function(e) {
                $('.linha-pagamento-4').css('display','block');
                $('.linha-pagamento-5').css('display','block');
            e.preventDefault();
         });


        /*Fim*/

        /*Função para Pagina Cadastro*/
        $("#botao-cad-finalizar").click(function(e) {
                    $('.line-cadastro-16').css('display','inline-block');
                 e.preventDefault();
        });


        /*Fim*/


        /*==========  Banner expansível  ==========*/
        var timeout;
        var advertise_img = $(".advertise-head img");

        var newImg = new Image;
        newImg.src = advertise_img.data("expanded");
        var height = advertise_img.data("height");

        //if(!isMobile()) {
            var $close = $('<a href="#" class="close-ad"><i class="icon"></i></a>');
            $close.on("click", function(e) {
                e.preventDefault();
                $('.advertise-head').slideUp();
            });

            $(".advertise-head").on({
                mouseenter: function() {

                    if (newImg.complete) {

                        timeout = setTimeout(function() {

                            advertise_img.attr('src', newImg.src).stop(true).animate({height:460}, {duration:200, easing:"easeOutQuad"});
                            //advertise_img.attr('src', newImg.src).stop(true).animate({height:height}, {duration:200, easing:"easeOutQuad"});

                        }, 300);

                    };

                },
                mouseleave: function() {

                    clearTimeout(timeout);
                    advertise_img.stop(true).animate({height:70}, {duration:50, easing:"easeOutQuad"}).attr("src", advertise_img.data("original") );

                }
            }, ".advertise-head-link").find(".advertise-head-link").append($close);
        //}

 
});


