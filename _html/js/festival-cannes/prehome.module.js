// Prehome
// =========================

$(document).ready(function() {
  if($('.home').length) {
    if(!$.cookie('prehome')) {
      $('body').addClass('fix');
      $('#prehome-container').addClass('show');
      $('#prehome-container').height($(window).height());
      $('#prehome').addClass('show');
    } else {
      $('#prehome-container').remove();

      setTimeout(function() {
        scrollTarget = 0;
        initParallaxElements();

        if(parallaxElements.length != 0) {
          update();
        }
      },200);
    }
  }
});

$(window).load(function() {
  if(!$.cookie('prehome')) {
    setTimeout(function() {
      $('html, body').animate({
        scrollTop: $("header").offset().top
      }, 800, function() {
        $('body,html').scrollTop(0);
        $('body').removeClass('fix');
        $('#prehome-container').remove();
        
        setTimeout(function() {
          scrollTarget = 0;
          initParallaxElements();

          if(parallaxElements.length != 0) {
            update();
          }
        },200);
      });
    }, 3000);
    $.cookie('prehome', '1', { expires: 7 });
  }
});