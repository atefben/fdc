$(document).ready(function() {

  if($('.home').length || $('.webtv').length) {

    // Slider Channels
    // =========================

    var sliderChannels = $("#slider-channels").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-channels .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderChannels.owlCarousel();

    sliderChannels.on('translated.owl.carousel', function(e) {
      $('#slider-channels .owl-item').removeClass('previous');
      $('#slider-channels .owl-item.center').prev().addClass('previous');
    });

    $('body').on('click', '#slider-channels .owl-item', function(e) {
      sliderChannels.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

  }

});