$(document).ready(function() {

  if($('.home').length || $('.webtv').length) {

    // Slider Videos
    // =========================

    function setActiveVideos() {
      $('#slider-videos .owl-item').removeClass('center');
      $('#slider-videos .owl-item.active').first().addClass('center');
      if($('#slider-videos .owl-item.center').index() >= $('#slider-videos .owl-item').length - 2) {
        $('#slider-videos .owl-item').last().addClass('center');
      }
    }

    var sliderVideos = $("#slider-videos").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 1300,
      margin: 50,
      autoWidth: true,
      loop: false,
      responsive:{
        0:{
          items: 1
        },
        1675: {
          items: 2
        }
      },
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-videos .owl-stage').css({ 'margin-left': m });
        setActiveVideos();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-videos .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveVideos();
      }
    });

    sliderVideos.owlCarousel();

    $('body').on('click', '#slider-videos .owl-item', function(e) {
      sliderVideos.trigger('to.owl.carousel', [$(this).index(), 500, true]);
    });
  }

});