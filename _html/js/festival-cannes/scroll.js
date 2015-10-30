$(document).ready(function() {

  // Events on scroll
  // =========================
  var lastScrollTop = 0,
      $header = $('header'),
      $timeline = $('#timeline'),
      $navMovie = $('#nav-movie');

  $(window).on('scroll', function() {
    var s = $(this).scrollTop();
    scrollTarget = s;

    if (s > lastScrollTop){
      if(($('#prehome-container').length == 0 && s > 139)) {
        $header.addClass('sticky');
      }
    } else {
      /*if(s < 2000 && (lastScrollTop - s) > 150) {
        $('header').removeClass('sticky');
        $('body').css('padding-top', '230px');
      }*/
      if(($('#prehome-container').length == 0 && s < 600)) {
        $header.removeClass('sticky');
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
      if(s > $('#news').offset().top + 70 && s < ($('.read-more').offset().top - $('.read-more').height() - $timeline.height() - 3)) {
        $timeline.removeClass('bottom').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 57);
      } else {
        if(s >= ($('.read-more').offset().top - $('.read-more').height() - $timeline.height() - 3)) {
          $timeline.addClass('bottom');
        } else {
          $timeline.removeClass('stick').css('left', 'auto');
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

    if($('.webtv-live').length) {
      var hght = $header.hasClass('sticky') ? 91 : 230;
      $('#live .textLive').css('top', hght + ($('#live').height() - $('#live .textLive').height()) / 2);
    }

    if($('.single-movie').length ) {
      if((s > ($('.videos').offset().top - $navMovie.height() - 100))) {
        $navMovie.addClass('sticky');
        if(s > $('div.press').offset().top + 1 - $navMovie.height()) {
          $navMovie.css('top', 0);
        } else {
          $navMovie.css('top', '91px');
        }
      } else {
        $navMovie.removeClass('sticky');
      }

      if(s > $('.competition').offset().top - ($(window).height() - $header.height() - 200)) {
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
        , nav_height = nav.outerHeight() + $header.height();
       
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




  // ---------- PARALLAX ------------

  // vars for parallax
  var scrollTarget = 0,
      scrollPos = 0,
      scrollEase = 0.1;
      scrollEaseLimit = 0.1;

  function render(el1, el2, start, division, mov){
    // process only if value is not reached
    var sc = scrollTarget - start;

    if (sc !== scrollPos && scrollTarget > start - $(window).height()){
        
      // limit easing
        
      if (Math.abs(scrollPos - sc) < scrollEaseLimit){
        scrollPos = sc;
      }
        
      // increment pos with easing
    
      scrollPos += (sc - scrollPos) * scrollEase;


      // translate Element 2 with pos / 2 (half speed)
    
      transform1 = 'translate3d(0px, ' + (scrollPos/division) + 'px, 0px)';

      el1.style.webkitTransform = transform1;
      el1.style.MozTransform = transform1;
      el1.style.msTransform = transform1;
      el1.style.OTransform = transform1;
      el1.style.transform = transform1;
        
      // translate Element 2 with pos (plain speed)
    
      transform2 = 'translate3d(0px, ' + (scrollPos/mov) + 'px, 0px)';
        
      el2.style.webkitTransform = transform2;
      el2.style.MozTransform = transform2;
      el2.style.msTransform = transform2;
      el2.style.OTransform = transform2;
      el2.style.transform = transform2;
        
    }
  }

  // init parallax elements and push them into an array
  var parallaxElements = [];
  function initParallaxElements() {

    if($('.home').length) {
      // home prefooter
      parallaxElements.push({
        'el1': '#prefooter .owl-item.center .imgSlide',
        'el2': '.textTop',
        'positionTop': $('#slider-prefooter').offset().top,
        'division': 4,
        'mov': 2
      });

      parallaxElements.push({
        'el1': '#slider .owl-item.center .img-container',
        'el2': '#slider .owl-item.center .info',
        'positionTop': $('#slider').offset().top - $header.height(),
        'division': 6,
        'mov': 4
      });

      parallaxElements.push({
        'el1': '#slider-movies .owl-item.active .video',
        'el2': '#slider-movies .owl-item.active .textVideo',
        'positionTop': $('#slider-movies').offset().top,
        'division': 6,
        'mov': 4
      });

    }

    if($('.webtv-live').length) {
      parallaxElements.push({
        'el1': '#live .img',
        'el2': '.textLive',
        'positionTop': $('#live').offset().top - $header.height(),
        'division': 6,
        'mov': 3
      });
    }
  }

  var hW = $(window).height();

  // on resize, update positionTop
  $(window).resize(function() {
    if($('.home').length) {
      // home prefooter
      parallaxElements[0].positionTop = $('#slider-prefooter').offset().top;
      parallaxElements[1].positionTop = $('#slider').offset().top - $header.height();
      parallaxElements[2].positionTop = $('#slider-movies').offset().top;

    }

    if($('.webtv-live').length) {
      parallaxElements[0].positionTop = $('#live').offset().top - $header.height();
    }

    hW = $(window).height();
  });

  setTimeout(function() {
    initParallaxElements();

    // launch RAF
    if(parallaxElements.length != 0) {
      update();
    }
    
  }, 100);


  // update 
  function update(){
    for(var i=0; i<parallaxElements.length; i++) {
      if(scrollTarget > (parallaxElements[i].positionTop - hW) && scrollTarget < parallaxElements[i].positionTop + hW) {
        $(parallaxElements[i].el2).css('position', 'fixed');
        $(parallaxElements[i].el1).css('position', 'fixed');
        render($(parallaxElements[i].el1)[0], $(parallaxElements[i].el2)[0], parallaxElements[i].positionTop, parallaxElements[i].division, parallaxElements[i].mov); 
      } else {
        $(parallaxElements[i].el2).css('position', '');
        $(parallaxElements[i].el1).css('position', '');
      }
    }
    window.requestAnimFrame(update);
  }



});