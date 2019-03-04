$(document).ready(function () {

$(".link-do-menu").on("click", function() {
    location.href = $(this).find("a").attr("href");
});

//$('[data-toggle="tooltip"]').tooltip();
var offset = $('body').offset().top;

$("body").on('scroll', function () {

if($(this).scrollTop() > 450) {
$('.volta-topo').fadeIn();
}
else {
$('.volta-topo').fadeOut();
}
});

$('.dropdown-submenu a').on("click", function(e){
$(this).next('ul').toggle();
e.stopPropagation();
e.preventDefault();
});

/*$("#zoom_03").ezPlus({
gallery: 'gallery_01',
cursor: 'pointer',
loadingIcon: false,
galleryActiveClass: "active",
imageCrossfade: true,
easing: true,
zoomWindowWidth: 500,
zoomWindowHeight: 500,
zoomType: "window"
});

/*$("#zoom_03").bind("click", function (e) {
var ez = $('#zoom_03').data('ezPlus');
ez.closeAll(); //NEW: This function force hides the lens, tint and window
$.fancyboxPlus(ez.getGalleryList());
return false;
});*/

$('.owl-carousel-thumbs').owlCarousel({
loop:false,
autoplay: true,
margin:10,
responsiveClass:true,
nav:true,
navText:['<button type="button" class="btn slider-left-btn btn-link"><i class="fa fa-angle-left fa-2x"></i></button>','<button type="button" class="btn slider-right-btn btn-link"><i class="fa fa-angle-right fa-2x"></i></button>'],
    dots:true,
video: true,
responsive:{
0:{
items:3,
nav:true,
dots:false
},
576:{
items:3,
nav:true,
dots:false
},
768:{
items:5,
nav:true,
dots:false
},
991:{
items:5,
nav:true,
dots:false
},
1440:{
items:5,
nav:true,
dots:false
}
}
});

$('.owl-carousel-semelhantes').owlCarousel({
loop:false,
autoplay: false,
margin:10,
responsiveClass:true,
nav:true,
navText:['<button type="button" class="btn slider-left-btn btn-link"><i class="fa fa-angle-left fa-2x"></i></button>','<button type="button" class="btn slider-right-btn btn-link"><i class="fa fa-angle-right fa-2x"></i></button>'],
    dots:true,
responsive:{
0:{
items:1,
nav:false,
dots:true
},
600:{
items:2,
nav:false,
dots:true
},
800:{
items:3,
nav:true,
dots:true
},
1000:{
items:4,
nav:true,
dots:true
}
}
});

$('.volta-topo, .go-top').click(function(e){
e.preventDefault();
$('html, body').animate({
scrollTop: $('#topo').offset().top
}, 800);
});

$("#inputCEP, #cep").mask("99999-999");
$("#inputCPF, #cpf").mask("999.999.999-99");
$("#inputRG, #rg").mask("99.999.999-9");
$("#inputDtNascimento, #data").mask("99/99/9999");
$("#inputTelefone, #telefone").mask("(99) 9999-9999");
/*$('#inputTelefone, #telefone').focusout(function(){
var phone, element;
element = $(this);
element.unmask();
phone = element.val().replace(/\D/g, '');
if(phone.length > 10) {
element.mask("(99) 99999-999?9");
} else {
element.mask("(99) 9999-9999?9");
}
}).trigger('focusout');*/

$('#banners').bjqs({
'responsive' : true,
'showcontrols' : true,
'animspeed' : 7000,
'automatic' : true,
'height' : 958,
'width' : 1920,
'keyboardnav'   : true,
'hoverpause' : false
});


$(".fancybox").fancybox({
prevEffect : 'none',
nextEffect : 'none',
closeBtn : false,
helpers : {
overlay : { css : { 'background' : 'rgba(23, 3, 13, 0.95)' } },
title : { type : 'inside' },
buttons : {}
}
});

$('.parallax').each(function(){
var $obj = $(this);

$(window).scroll(function() {
var yPos = -($(window).scrollTop() / $obj.data('speed'));

var bgpos = '100% '+ yPos + 'px';

$obj.css('background-position', bgpos );

});
});


/* isto é apenas demonstração e deve ser removido! */
$('#msgAlerta').hide();
$('#enviaForm').click( function(){
$('#msgAlerta').fadeIn(500);
});
/*-------------------------------------*/

var sideslider = $('[data-toggle=collapse-side]');
var sel = sideslider.attr('data-target');
var sel2 = sideslider.attr('data-target-2');
sideslider.click(function(event){
$(sel).toggleClass('in');
$(sel2).toggleClass('out');
});

$('.dropdown a').on("click", function(e){
if($(this).hasClass('rotate')) {
$(this).removeClass('rotate');
} else {
$(this).addClass('rotate');
}
$(this).next('ul').toggle();
e.stopPropagation();
e.preventDefault();
});

$('.btn-selecao').off();
$('.btn-selecao').click(function(){
$('.btn-selecao').removeClass('active').html("Selecionar");
if($(this).hasClass('active')){
$(this).removeClass('active').html("Selecionar");
} else {
$(this).addClass('active').html("Selecionado!");
}
});

$('#menu-tabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

$('.btn-laranja').click(function() {
$('#loginModal').modal();
});

$('.abre-modal').click(function() {
$('#mensagem01').modal();
});

// With JQuery

numeral.language('br', {
        delimiters: {
            thousands: '.',
            decimal: ','
        },
        abbreviations: {
            thousand: 'mil',
            million: 'mi',
            billion: 'bi',
            trillion: 'tri'
        },
        ordinal: function (number) {
            return number === 1 ? 'º' : 'º';
        },
        currency: {
            symbol: 'R$'
        }
    });

    numeral.language('br');

$(".filter").slider({});

$(".nav-filter").slider({
tooltip: "always"
});

$('.btn-preco, .btn-tamanho, .btn-marca').click(function(){ 
var menu = $(this).parent().find('.dropdown-menu');
if(menu.is(':visible')) {
$('.dropdown-menu').hide();
menu.show();
} else {
$('.dropdown-menu').hide();
}
});

    $("#porPreco").parent().find('.slider-handle').click(function () {

        $(".btn-preco").attr("data-toggle", "");

    }).mouseleave(function () {

        $(".btn-preco").attr("data-toggle", "dropdown");
    });

    $(".btn-marca").parent().find('li').mousedown(function () {

        $(".btn-marca").attr("data-toggle", "");

    }).mouseleave(function () {

        $(".btn-marca").attr("data-toggle", "dropdown");

    });

    $("#porTamanho").parent().find('.slider-handle').click(function () {

        $(".btn-tamanho").attr("data-toggle", "");

    }).mouseleave(function () {

        $(".btn-tamanho").attr("data-toggle", "dropdown");
    });

    $("#porPreco").parent().find('.slider-handle').on("mousemove touchmove mouseleave touchend", function() {
      
        var mySlider = $("#porPreco").slider();
        $("#porPrecoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0,0.00'));
        $("#porPrecoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0,0.00'));
    });
    /*$("#porPreco").parent().find('.slider-handle').mousemove(function () {

        console.log("asdasdsad");
        var mySlider = $("#porPreco").slider();
        $("#porPrecoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0,0.00'));
        $("#porPrecoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0,0.00'));

    }).mouseleave(function () {

        var mySlider = $("#porPreco").slider();
        $("#porPrecoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0,0.00'));
        $("#porPrecoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0,0.00'));

    });*/


    $("#porTamanho").parent().find('.slider-handle').on("mousemove touchmove mouseleave touchend", function() {

        var mySlider = $("#porTamanho").slider();

        $("#porTamanhoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0') +" PÉS");
        $("#porTamanhoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0') +" PÉS");

    });
    /*
    $("#porTamanho").parent().find('.slider-handle').mousemove(function () {

        var mySlider = $("#porTamanho").slider();

        $("#porTamanhoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0') +" PÉS");
        $("#porTamanhoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0') +" PÉS");


    }).mouseleave(function () {

        var mySlider = $("#porTamanho").slider();

        $("#porTamanhoInicio").text(numeral(mySlider.slider('getValue').toString().split(",")[0]).format('0') +" PÉS");
        $("#porTamanhoFim").text(numeral(mySlider.slider('getValue').toString().split(",")[1]).format('0') +" PÉS");

    });*/

    $('.compensabotaomenu, .nav-link').off();

    if($(window).width() < 991) { 
    $('.count2-resp, #exibe-menu .fa-close').hide();
    }

    $('#exibe-menu').click(function() { 
    if($('.count2-resp').is(':visible')){
    $(this).removeClass('active');
    $('.count2-resp').fadeOut(200);
    $('#exibe-menu .icone_setabaixo').show();
    $('#exibe-menu .fa-close').hide();
    } else { 
$(this).addClass('active');
    $('.count2-resp').fadeIn(500);    
    $('#exibe-menu .icone_setabaixo').hide();
    $('#exibe-menu .fa-close').show();    
    }
    }); 
    $(window).resize(function() {
    if($(window).width() < 991) { 
    $('.count2-resp, #exibe-menu .fa-close').hide();
    }
/*  if($('.count2-resp').is(':visible')){
    $(this).removeClass('active');
    $('.count2-resp').fadeOut(200);
    $('#exibe-menu .icone_setabaixo').show();
    $('#exibe-menu .fa-close').hide();
    } else { 
$(this).addClass('active');
    $('.count2-resp').fadeIn(500);    
    $('#exibe-menu .icone_setabaixo').hide();
    $('#exibe-menu .fa-close').show();    
    } */
});

    $('.mostraForm').click(function() { 
    $('.divForm').show();
    });

    /* Adicional BB */
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


        /*==========  Banner expansível  ==========*/
        var timeout;
        var advertise_img = $(".advertise-head img");

        var newImg = new Image;
        newImg.src = advertise_img.data("expanded");
        var height = advertise_img.data("height");

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


        $(".close-ad").on("click", function(e) {
            e.preventDefault();
            $(".advertise-head").hide();
        });

        $('#ex1').zoom();

});