$(document).ready(function() {

  if($('.home').length) {

    // Slider Home
    // =========================
    var time = 7;
   
    var $progressBar,
        $bar, 
        sliderHome, 
        isPause, 
        tick,
        percentTime;

    function positionElements() {
      $('#slider .center').prevAll().each(function() {
        $(this).find('img').css({
          '-webkit-transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(' + 400+ 'px) translateY(0px)',
          'transform': 'translate3d(' + 400 + 'px, 0px, 0px)'
        });
      });

      setTimeout(function() {$('#slider .center img').css({
        '-webkit-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
        '-moz-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
        '-o-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
        '-ms-transform': 'translateX(' + 0+ 'px) translateY(0px)',
        'transform': 'translate3d(' + 0 + 'px, 0px, 0px)'
      });}, 20);

      $('#slider .center').nextAll().each(function() {
        $(this).find('img').css({
          '-webkit-transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(-' + 400+ 'px) translateY(0px)',
          'transform': 'translate3d(-' + 400 + 'px, 0px, 0px)'
        });
      });
    }

    function progressBar(){    
      // build progress bar elements
      buildProgressBar();

      positionElements();
        
      // start counting
      start();

      $('#slider .owl-nav div').on('click', function() {
        clearTimeout(tick);

        $bar.css({
          width: '100%',
          transition: 'width .2s ease'
        });

        setTimeout(function() {
          $bar.css({
            float: 'right',
            width: 0
          });
        }, 200);
      });
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

          clearTimeout(tick);
          $bar.css({
            float: 'right',
            width: 0,
            transition: 'width .5s ease'
          });

          $("#slider").trigger("next.owl.carousel");

          percentTime = 0;
        }
      }
    }

    // pause while dragging 
    function pauseOnDragging(){
      isPause = true;
    }

    function move() {

      setTimeout(function() {
      $('#slider .center').prevAll().each(function() {
        $(this).find('img').css({
          '-webkit-transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(' + 400+ 'px) translateY(0px)',
          'transform': 'translate3d(' + 400 + 'px, 0px, 0px)',
          'transition': 'all 0.5s ease'
        });
      });

        $('#slider .center img').css({
          '-webkit-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(' + 0+ 'px) translateY(0px)',
          'transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
          'transition': 'all 0.7s ease'
        });

      $('#slider .center').nextAll().each(function() {
        $(this).find('img').css({
          '-webkit-transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(-' + 400+ 'px) translateY(0px)',
          'transform': 'translate3d(-' + 400 + 'px, 0px, 0px)',
          'transition': 'all 0.5s ease'
        });
      });
      }, 50);
    }

    // moved callback
    function moved(){
      // clear interval
      clearTimeout(tick);
        
      // start again
      start();

      $bar.css({
        float: 'none',
        width: 0,
        transition: 'none'
      });
    }

    $("#slider").owlCarousel({
      items: 2,
      loop: true,
      center: true,
      nav: true,
      dots: true,
      onTranslate: move,
      onInitialized: progressBar,
      onTranslated: moved,
      mouseDrag: false,
      onDrag: pauseOnDragging,
      navSpeed: 800,
      dotsSpeed: 800,
      smartSpeed: 800,
      autoWidth: true
    });


  }

});