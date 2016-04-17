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
        percentTime,
        deltaTooBig = false;

    function positionElements() {
      var p = ($('#slider .owl-item').width() / 2) - 200;

      $('#slider .center').prevAll().each(function() {
        $(this).find('.img').css({
          '-webkit-transform': 'translate3d(' + p + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(' + p + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(' + p + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(' + p+ 'px) translateY(0px)',
          'transform': 'translate3d(' + p + 'px, 0px, 0px)'
        });
      });

      setTimeout(function() {$('#slider .center .img').css({
        '-webkit-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
        '-moz-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
        '-o-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
        '-ms-transform': 'translateX(' + 0+ 'px) translateY(0px)',
        'transform': 'translate3d(' + 0 + 'px, 0px, 0px)'
      });}, 20);

      $('#slider .center').nextAll().each(function() {
        $(this).find('.img').css({
          '-webkit-transform': 'translate3d(-' + p + 'px, 0px, 0px)',
          '-moz-transform': 'translate3d(-' + p + 'px, 0px, 0px)',
          '-o-transform': 'translate3d(-' + p + 'px, 0px, 0px)',
          '-ms-transform': 'translateX(-' + p+ 'px) translateY(0px)',
          'transform': 'translate3d(-' + p + 'px, 0px, 0px)'
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

    $('body').on('click', '.owl-nav div', function(e) {
      var current = $('#slider .owl-dot.active').index(),
          newP = 0;

      if($(this).hasClass('owl-next')) {
        newP = parseInt(current) + 1;
      } else {
        newP = parseInt(current) - 1;
      }

      if($('#slider .owl-dot').eq(newP).length == 0 || newP == -1) {
        deltaTooBig = true;
      }
    });

    $('body').on('click', '#slider .owl-dot', function(e) {
      var delta = $(this).index() - $('#slider .owl-dot.active').index();
      if(delta < -1 || delta > 1) {
        deltaTooBig = true
      }
    });

    function move() {
      var p = ($('#slider .owl-item').width() / 2) - 200;

      $('#slider .img-container').addClass('relative');

      if(deltaTooBig) {

        $('#slider .owl-item').each(function() {
          $(this).find('.img').css({
            '-webkit-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            '-moz-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            '-o-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            '-ms-transform': 'translateX(' + 0+ 'px) translateY(0px)',
            'transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            'transition': 'all 0 ease'
          });
        });

      } else {

        setTimeout(function() {
          $('#slider .center').prev().find('.img').css({
            '-webkit-transform': 'translate3d(' + p + 'px, 0px, 0px)',
            '-moz-transform': 'translate3d(' + p + 'px, 0px, 0px)',
            '-o-transform': 'translate3d(' + p + 'px, 0px, 0px)',
            '-ms-transform': 'translateX(' + p+ 'px) translateY(0px)',
            'transform': 'translate3d(' + p + 'px, 0px, 0px)',
            'transition': 'all 0.5s ease'
          });

          $('#slider .center .img').css({
            '-webkit-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            '-moz-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            '-o-transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            '-ms-transform': 'translateX(' + 0+ 'px) translateY(0px)',
            'transform': 'translate3d(' + 0 + 'px, 0px, 0px)',
            'transition': 'all 0.7s ease'
          });

          $('#slider .center').next().find('.img').css({
            '-webkit-transform': 'translate3d(-' + p + 'px, 0px, 0px)',
            '-moz-transform': 'translate3d(-' + p + 'px, 0px, 0px)',
            '-o-transform': 'translate3d(-' + p + 'px, 0px, 0px)',
            '-ms-transform': 'translateX(-' + p+ 'px) translateY(0px)',
            'transform': 'translate3d(-' + p + 'px, 0px, 0px)',
            'transition': 'all 0.5s ease'
          });
        }, 50);
      }
    }

    // moved callback
    function moved(){
      // clear interval
      clearTimeout(tick);

      deltaTooBig = false;

      // start again
      start();

      $('#slider .img-container').removeClass('relative');

      $bar.css({
        float: 'none',
        width: 0,
        transition: 'none'
      });
    }

    sliderHome = $("#slider").owlCarousel({
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

    sliderHome.owlCarousel();

    if($('.mob').length) {
      sliderHome.trigger('to.owl.carousel', [1, 100, true]);
      setTimeout(function() {
        sliderHome.trigger('to.owl.carousel', [0, 100, true]);
      }, 100);
    }


  }

});
