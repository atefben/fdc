// Single Article
// =========================
$(document).ready(function() {

  if($('.single-article').length) {

    if($('#canvasloader').length) {
      
      var cl = new CanvasLoader('canvasloader');
          cl.setColor('#ceb06e');
          cl.setDiameter(20);
          cl.setDensity(34);
          cl.setRange(0.8);
          cl.setSpeed(1);
          cl.setFPS(60);
    }

    // scroll to 'share' section
    $('#share-article').on('click', function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $(".share").offset().top - $('header').height() - $('.share').height()
      }, 500);
    });

    // ajax article : previous or next
    $('body').on('click', '.single-article .nav', function(e) {
      e.preventDefault();

      var $that = $(this);

      if($that.hasClass('next')) {
        $('.anim').addClass('next');
      } else {
        $('.anim').removeClass('next');
      }

      $('.anim').addClass('show');
      setTimeout(function() {
        cl.show();
        $('#canvasloader').addClass('show');
      }, 800);

      var urlPath = $that.attr('href');

      // remove timeout once on server. only for animation.
      setTimeout(function() {
        $.get(urlPath, function(data){
          $(".content-article").html( $(data).find('.content-article') );
          history.pushState('',GLOBALS.texts.url.title, urlPath);

          $('#canvasloader').removeClass('show');

          setTimeout(function() {
            if($that.hasClass('next')) {
              $('.anim').removeClass('next show');
            }
            else {
              $('.anim').addClass('next').removeClass('show');
            }
            cl.hide();
            initSlideshows();
            initAudioPlayers();
          }, 800);
        });
      }, 500);
    });
  }
});