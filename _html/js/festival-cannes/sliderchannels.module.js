$(document).ready(function() {

  if($('.home').length || $('.webtv').length) {

    // Slider Channels
    // =========================

    var sliderChannels = $("#slider-channels").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      fluidSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      dragEndSpeed: 600,
      onInitialized: function() {
        $('#slider-channels .owl-stage').css({ 'margin-left': "-343px" });
      }
    });

    sliderChannels.owlCarousel();

    $('body').on('click', '#slider-channels .owl-item', function(e) {
      sliderChannels.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

  }

});