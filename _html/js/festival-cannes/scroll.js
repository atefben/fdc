$(document).ready(function() {

  // Events on scroll
  // =========================

  $(window).on('scroll', function() {
    var s = $(window).scrollTop();

    if(($('#prehome-container').length == 0 && s > 50) || ($('#prehome-container').length && s > $(window).height() + 10)) {
      $('header').addClass('sticky');
    } else {
      $('header').removeClass('sticky');
    }

    if($('#featured-movies').length) {
      if(s > $('#featured-movies').offset().top - $('#featured-movies').height() && s < $('#featured-movies').offset().top + $('#featured-movies').height()) {
        $('#featured-movies .active').find('video')[0].play();
        handleEndVideo();
      } else {
        $('#featured-movies .active').find('video')[0].pause();
      }
    }

    if($('#social-wall').length) {
      if(s > $('#social-wall').offset().top - ($(window).height()/2) && !displayed) {
        displayGrid();
      }
    }

    if($('#graph').length) {
      if(s > $('#graph').offset().top - ($(window).height()/2) && !graphRendered) {
        makePath(points);
      }
    }

    if($('#news').length) {
      if(s > $('#news').offset().top + 50 && s < ($('.read-more').offset().top - $('.read-more').height() - $('#timeline').height())) {
        $('#timeline').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 60);
      } else {
        $('#timeline').removeClass('stick').css('left', 'auto');
      }
    }

    if($('.single-movie').length ) {
      if(s > ($('.videos').offset().top - $('#nav-movie').height() - 100)) {
        $('#nav-movie').addClass('sticky');
      } else {
        $('#nav-movie').removeClass('sticky');
      }

      $('.main-image').height($('.main-image').data('height'));
      $('.main-image, .poster, .info-film, .nav').removeClass('trailer');

      var sections = $('*[data-section')
        , nav = $('#nav-movie')
        , nav_height = nav.outerHeight() + $('header').height();
       
        sections.each(function() {
          var top = $(this).offset().top - nav_height,
              bottom = top + $(this).outerHeight();
       
          if (s >= top && s <= bottom) {
            nav.find('ul a').removeClass('active');

            nav.find('a[href="#'+$(this).data('section')+'"]').addClass('active');
          }
        });

    }


  });

});