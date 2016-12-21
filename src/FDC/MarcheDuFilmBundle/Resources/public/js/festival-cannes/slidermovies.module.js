function handleEndVideo() {
  $('#slider-movies video').off('ended');
  $('#slider-movies .active video').on('ended',function(){
    var sMovies = $('#slider-movies');
    sMovies.owlCarousel();

    sMovies.trigger('next.owl.carousel');
  });
  percent = 0;
}

function setHeightSlider() {
 
  var newHeight = $(window).height() - 90,
      valueHeight = Math.round(($(window).width()/16)*9),
      top = (newHeight - valueHeight) / 2;

  if(newHeight > valueHeight) {
    newHeight = valueHeight;
    top = 0;
  }

  $('#featured-movies').height(newHeight);
  $('#featured-movies .video').css({
    'top': top,
    'height': valueHeight
  });
  $('#featured-movies video').height(valueHeight);

  setTimeout(function() {
    $('#sliderWrapper').height($(window).height() - $('header').height());
  }, 100);
  $('#prefooter').css('height', $(window).height() - 90 + "px");
  $('#prefooter .imgSlide, #slider-movies .textVideo, #slider-movies .video').width($(window).width());
}

$(document).ready(function() {

  if($('.home').length) {

    var time = 7;
   
    var $progressBarMovies,
        $barMovies, 
        sliderMovies, 
        isPause, 
        clock,
        percent;

    function progressBarMovies(){
      // build progress bar elements
      if ($('#slider-movies').length) {
        buildProgressBarMovies();

        // start counting
        startMovies();
      }
    }

    function buildProgressBarMovies(){
      $progressBarMovies = $("<div>",{
        id:"progressBarMovies"
      });
      
      $barMovies = $("<div>",{
        id:"barMovies"
      });
      
      $progressBarMovies.append($barMovies).prependTo($("#slider-movies"));
    }

    function startMovies() {
      // reset timer
      percent = 0;
      isPause = false;
      time = $('#slider-movies .owl-item.active video')[0].duration;

      // run interval every 0.01 second
      clock = setInterval(intervalMovies, 10);
    };

    function intervalMovies() {
      if(isPause === false){
        percent = ($('#slider-movies .owl-item.active video')[0].currentTime / $('#slider-movies .owl-item.active video')[0].duration) * 100;
        
        $barMovies.css({
          height: percent+"%"
        });
      }
    }

    // Slider Movies
    // =========================

    function pauseVideo() {
      $('#slider-movies .active video')[0].pause();
    }

    function clearClock() {
      // clear interval
      clearTimeout(clock);
      $barMovies.css({
        height: 0
      });

      $('#slider-movies .video').css('position', 'absolute');

      $('#slider-movies .active video')[0].pause();

      var p = ($('#slider-movies .owl-item').height() / 2) - 100;

      setTimeout(function() {
        $('#slider-movies .active').prev().find('video').css({
          '-webkit-transform': 'translate3d(0px, ' + p + 'px, 0px)',
          '-moz-transform': 'translate3d(0px, ' + p + 'px, 0px)',
          '-o-transform': 'translate3d(' + p + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(0px) translateY(' + p + 'px)',
          'transform': 'translate3d(0px, ' + p + 'px, 0px)',
          'transition': 'all 0.5s ease'
        });

        $('#slider-movies .active video').css({
          '-webkit-transform': 'translate3d(0px, 0px, 0px)',
          '-moz-transform': 'translate3d(0px, 0px, 0px)',
          '-o-transform': 'translate3d(0px, 0px, 0px)',
          '-ms-transform': 'translateX(0px) translateY(0px)',
          'transform': 'translate3d(0px, 0px, 0px)',
          'transition': 'all 0.7s ease'
        });

        $('#slider-movies .active').next().find('video').css({
          '-webkit-transform': 'translate3d(0px, ' + p + 'px, 0px)',
          '-moz-transform': 'translate3d(0px, ' + p + 'px, 0px)',
          '-o-transform': 'translate3d(' + p + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(0px) translateY(' + p + 'px)',
          'transform': 'translate3d(0px, ' + p + 'px, 0px)',
          'transition': 'all 0.5s ease'
        });
      }, 50);
    }

    function playNewVideo() {
      $('#slider-movies .owl-item video').each(function() {
        $(this)[0].currentTime = 0;
      });
      $('#slider-movies .video').css('position', '');
      $('#slider-movies .active video')[0].play();
      handleEndVideo();

      // clear interval
      clearTimeout(clock);
        
      // start again
      startMovies();
    }

    if ($("#slider-movies video").length >= 2) {
      $("#slider-movies").owlCarousel({
        items: 1,
        loop: true,
        nav: false,
        dots: true,
        smartSpeed: 500,
        onTranslate: clearClock,
        onTranslated: playNewVideo,
        onDrag: pauseVideo,
        onInitialized: progressBarMovies,
        animateOut: 'slideOutUp',
        animateIn: 'slideInUp',
        mouseDrag: false
      });
    }

    setTimeout(function() {
      setHeightSlider();
    }, 50);

  }

});