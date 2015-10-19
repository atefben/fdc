$(document).ready(function() {

  if($('.home').length) {

    // Slider Movies
    // =========================

    function setHeightSlider() {
     
      var newHeight = $(window).height() - 90,
          valueHeight = Math.round(($(window).width()/16)*9),
          top = newHeight - valueHeight;

      $('#featured-movies').height(newHeight);
      $('#featured-movies video').css({
        'top': top,
        'height': valueHeight
      });
    }

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
      smartSpeed: 500,
      onTranslated: playNewVideo,
      onDrag: pauseVideo
    });

    setHeightSlider();

  }

});