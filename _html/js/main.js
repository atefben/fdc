//       SUMMARY TABLE     
// =========================
// 1. Main menu
// 2. Slider Home
// 3. News
// 4. Slider Movies
// =========================


$(document).ready(function() {

  // 1. Main menu
  // =========================
  $('.main>li').hover(function() {
    $('#main').addClass('overlay');
    $('.main>li').not($(this)).addClass('fade');
  }, function() {
    $('#main').removeClass('overlay');
    $('.main li').removeClass('fade');
  });

  $(window).on('scroll', function() {
    var s = $('body').scrollTop();

    if(s > 50) {
      $('header').addClass('sticky');
    } else {
      $('header').removeClass('sticky');
    }

    if(s > $('#featured-movies').offset().top - $('#featured-movies').height() && s < $('#featured-movies').offset().top + $('#featured-movies').height()) {
      $('#featured-movies .active').find('video')[0].play();
      handleEndVideo();
    } else {
      $('#featured-movies .active').find('video')[0].pause();
    }
  });


  if($('.home').length) {

    // 2. Slider Home
    // =========================
    var time = 7;
   
    var $progressBar,
        $bar, 
        sliderHome, 
        isPause, 
        tick,
        percentTime;

     function progressBar(){    
      // build progress bar elements
      buildProgressBar();
        
      // start counting
      start();
    }

    function buildProgressBar(){
      $progressBar = $("<div>",{
          id:"progressBar"
      });
      
      $bar = $("<div>",{
          id:"bar"
      });
      
      $progressBar.append($bar).prependTo($("#slider"));
    }

    function start() {
      // reset timer
      percentTime = 0;
      isPause = false;
      
      // run interval every 0.01 second
      tick = setInterval(interval, 10);
    };

    function interval() {
      if(isPause === false){
        percentTime += 1 / time;
        
        $bar.css({
            width: percentTime+"%"
        });
        
        // if percentTime is equal or greater than 100
        if(percentTime >= 100){
          // slide to next item 
          $("#slider").trigger("next.owl.carousel");
          percentTime = 0;
        }
      }
    }

    // pause while dragging 
    function pauseOnDragging(){
      isPause = true;
    }

    // moved callback
    function moved(){
      // clear interval
      clearTimeout(tick);
        
      // start again
      start();
    }

    $("#slider").owlCarousel({
      items: 2,
      loop: true,
      center: true,
      nav: true,
      dots: true,
      onInitialized: progressBar,
      onTranslated: moved,
      onDrag: pauseOnDragging,
      navSpeed: 500,
      dotsSpeed: 500,
      smartSpeed: 500,
      autoWidth: true
    });

    // 3. News
    // =========================

    // 4. Slider Movies
    // =========================

    function handleEndVideo() {
      $('#slider-movies video').off('ended');
      $('#slider-movies .active video').on('ended',function(){
        var sMovies = $('#slider-movies');
        sMovies.owlCarousel();

        sMovies.trigger('next.owl.carousel');
      });
    }

    function pauseVideo() {
      $('#slider-movies .active video')[0].pause();
    }

    function playNewVideo() {
      $('#slider-movies .active video')[0].play();
      handleEndVideo();
    }

    $("#slider-movies").owlCarousel({
      items: 1,
      loop: true,
      nav: false,
      dots: false,
      navSpeed: 500,
      dotsSpeed: 500,
      smartSpeed: 500,
      onTranslated: playNewVideo,
      onDrag: pauseVideo
    });

  }

});