$(document).ready(function() {

  if($('.home').length || $('.webtv').length) {

    // Slider Videos
    // =========================

    var sliderVideos = $("#slider-videos").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 1300,
      margin: 50,
      center: true,
      autoWidth: true,
      loop: false,
      items: 1,
      onInitialized: function() {
        $('#slider-videos .owl-stage').css({ 'margin-left': "-172px" });
      }
    });

    sliderVideos.owlCarousel();

    $('body').on('click', '#slider-videos .owl-item', function(e) {
      sliderVideos.trigger('to.owl.carousel', [$(this).index(), 500, true]);
    });
  }

});