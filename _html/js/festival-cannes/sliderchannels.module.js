$(document).ready(function() {

  if($('.home').length || $('.webtv').length) {

    // Slider Channels
    // =========================

    function setActiveChannels() {
      $('#slider-channels .owl-item').removeClass('center');
      $('#slider-channels .owl-item.active').first().addClass('center');
      if($('#slider-channels .owl-item.center').index() >= $('#slider-channels .owl-item').length - 4) {
        $('#slider-channels .owl-item').last().addClass('center');
      }
    }

    var sliderChannels = $("#slider-channels").owlCarousel({ 
      nav: false,
      dots: false,
      smartSpeed: 500,
      fluidSpeed: 500,
      loop: false,
      margin: 50,
      autoWidth: true,
      dragEndSpeed: 600,
      responsive:{
        0:{
          items: 3
        },
        1675: {
          items: 4
        }
      },
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-channels .owl-stage').css({ 'margin-left': m });
        setActiveChannels();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-channels .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveChannels();
      }
    });

    sliderChannels.owlCarousel();

    $('body').on('click', '#slider-channels .owl-item', function(e) {
      sliderChannels.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

  }

});