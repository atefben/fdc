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
      top = newHeight - valueHeight;

  $('#featured-movies').height(newHeight);
  $('#featured-movies video').css({
    'top': top,
    'height': valueHeight
  });

  $('#sliderWrapper').height($(window).height() - 230);
  $('#prefooter').height($(window).height() - 90);
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
      buildProgressBarMovies();
        
      // start counting
      startMovies();
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
    }

    function playNewVideo() {
      $('#slider-movies .active video')[0].play();
      handleEndVideo();

      // clear interval
      clearTimeout(clock);
        
      // start again
      startMovies();
    }

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

    setHeightSlider();

  }

});