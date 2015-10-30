$(document).ready(function() {

  // vars for parallax
  var scrollTarget = 0,
      scrollPos = 0,
      scrollEase = 0.1;
      scrollEaseLimit = 0.1;

  // Events on scroll
  // =========================
  var lastScrollTop = 0;

  $(window).on('scroll', function() {
    var s = $(this).scrollTop();
    scrollTarget = s;

    if (s > lastScrollTop){
      if(($('#prehome-container').length == 0 && s > 139)) {
        $('header').addClass('sticky');
      }
    } else {
      /*if(s < 2000 && (lastScrollTop - s) > 150) {
        $('header').removeClass('sticky');
        $('body').css('padding-top', '230px');
      }*/
      if(($('#prehome-container').length == 0 && s < 500)) {
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
      if(s > $('#news').offset().top + 70 && s < ($('.read-more').offset().top - $('.read-more').height() - $('#timeline').height() - 3)) {
        $('#timeline').removeClass('bottom').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 57);
      } else {
        if(s >= ($('.read-more').offset().top - $('.read-more').height() - $('#timeline').height() - 3)) {
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




  // ---------- PARALLAX ------------

  var el1 = $('#slider .center .img')[0],
      el2 = $('#slider .center .info')[0];

  // launch RAF
  //update();


  function render(){
    
    // process only if value is not reached
    
    if (scrollTarget !== scrollPos){
        
      // limit easing
        
      if (Math.abs(scrollPos - scrollTarget) < scrollEaseLimit){
        scrollPos = scrollTarget;
      }
        
      // increment pos with easing
    
      scrollPos += (scrollTarget - scrollPos) * scrollEase;

        
       // translate Element 2 with pos / 2 (half speed)
    
      transform1 = 'translate3d(0px, ' + (scrollPos/2) + 'px, 0px)';
   
      el1.style.webkitTransform = transform1;
      el1.style.MozTransform = transform1;
      el1.style.msTransform = transform1;
      el1.style.OTransform = transform1;
      el1.style.transform = transform1;
        
      // translate Element 2 with pos (plain speed)
    
      transform2 = 'translate3d(0px, ' + scrollPos + 'px, 0px)';
        
      el2.style.webkitTransform = transform2;
      el2.style.MozTransform = transform2;
      el2.style.msTransform = transform2;
      el2.style.OTransform = transform2;
      el2.style.transform = transform2;
        
    }
  }

  // function update(){
  //   render();
  //   window.requestAnimFrame(update);
  // }

});