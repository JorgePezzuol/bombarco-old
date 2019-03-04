$(document).ready(function() {

  $('.carousel').carousel();

  $('body').scroll(function() {
    if ($(this).scrollTop() > 250) {
      $('.volta-topo').fadeIn(1000);
    } else {
      $('.volta-topo').fadeOut(1500);
    }
  });
 
  $('.volta-topo').click(function(){
    $('html, body').animate({
      scrollTop: $('#topo').offset().top
    }, 800);
  });

});
