$(document).ready(function() {

  // Events on scroll
  // =========================
  var lastScrollTop = 0;

  $(window).on('scroll', function() {
    var s = $(window).scrollTop();

    if (s > lastScrollTop){
      if(($('#prehome-container').length == 0 && s > 139)) {
        $('header').addClass('sticky');
      }
    } else {
      if(s < 2000 && (lastScrollTop - s) > 150) {
        $('header').removeClass('sticky');
        $('body').css('padding-top', '230px');
      }
      else if(($('#prehome-container').length == 0 && s < 400)) {
        $('header').removeClass('sticky');
        $('body').css('padding-top', '230px');
      }
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
      if(s > $('#news').offset().top + 70 && s < ($('.read-more').offset().top - $('.read-more').height() - $('#timeline').height())) {
        $('#timeline').removeClass('bottom').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 57);
      } else {
        if(s > ($('.read-more').offset().top - $('.read-more').height() - $('#timeline').height())) {
          $('#timeline').addClass('bottom');
        } else {
          $('#timeline').removeClass('stick').css('left', 'auto');
        }
      }
    }

    if($('.single-article').length) {
      if(s >= $('.same-day').offset().top - $('.same-day').height() / 2 - 100) {
        $('a.nav').addClass('bottom');
      } else {
        $('a.nav').removeClass('bottom');
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
        $('.nav, .prevmovie, .nextmovie').addClass('black');
      } else {
        $('.nav, .prevmovie, .nextmovie').removeClass('black');
      }

      if(s > 100 && $('.main-image').hasClass('trailer')) {
        $('.main-image').height($('.main-image').data('height')).css('padding-top', 0);
        $('.main-image, .poster, .info-film, .nav').removeClass('trailer');
      }

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

    lastScrollTop = s;

  });

});