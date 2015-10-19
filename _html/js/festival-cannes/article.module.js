// Single Article
// =========================
$(document).ready(function() {

  if($('.single-article').length) {
    $('#share-article').on('click', function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $(".share").offset().top - $('header').height() - $('.share').height()
      }, 500);
    });

    $('body').on('click', '.single-article .nav', function(e) {
      e.preventDefault();

      var $that = $(this);

      if($that.hasClass('next')) {
        $('.anim').addClass('next');
      } else {
        $('.anim').removeClass('next');
      }

      $('.anim').addClass('show');

      var urlPath = $that.attr('href');

      // remove timeout once on server. only for animation.

      setTimeout(function() {
        $.get(urlPath, function(data){
          $(".content-article").html( $(data).find('.content-article') );
          history.pushState('',"titre test", urlPath);

          if($that.hasClass('next')) {
            $('.anim').removeClass('next show');
          }
          else {
            $('.anim').addClass('next').removeClass('show');
          }
        });
      }, 2000);
    });
  }
});