$(document).ready(function() {

  // Events on scroll
  // =========================

  $(window).on('scroll', function() {
    var s = $(window).scrollTop();

    if(($('#prehome-container').length == 0 && s > 5) || ($('#prehome-container').length && s > $(window).height() + 10)) {
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
        $('#timeline').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 57);
      } else {
        $('#timeline').removeClass('stick').css('left', 'auto');
      }
    }

    if($('.single-movie').length ) {
      if((s > ($('.videos').offset().top - $('#nav-movie').height() - 100))) {
        $('#nav-movie').addClass('sticky');
        if(s > $('div.press').offset().top + 1 - $('#nav-movie').height()) {
          $('#nav-movie').css('top', 0);
        } else {
          $('#nav-movie').css('top', '91px');
        }
      } else {
        $('#nav-movie').removeClass('sticky');
      }

      if(s > $('.competition').offset().top - ($(window).height() - $('header').height() - 200)) {
        $('.nav').addClass('hide');
      } else {
        $('.nav').removeClass('hide');
      }

      if(s > 50 && s < $('div.press').offset().top - $('div.press').height()) {
        $('.nav').addClass('black');
      } else {
        $('.nav').removeClass('black');
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