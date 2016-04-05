// Prehome
// =========================

$(document).ready(function() {
  if($('.home').length) {
    if (!isiPad()) {
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
    } else {
      $('#prehome-container').remove();
    }
  }
});

$(window).load(function() {
  if(!isiPad()) {
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
  } else {
    if($('#prehome-container').length > 0) {
      $('#prehome-container').remove();
    }
  }
});