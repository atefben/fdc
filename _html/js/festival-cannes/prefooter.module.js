$(document).ready(function() {

  if($('.home').length) {

  // Prefooter
  // =========================

    // show image on mouseover
    $('#prefooter ul a').on('mouseover', function(e) {
      e.preventDefault();

      $('.imgSlide, #prefooter a').removeClass('active');
      var i = $(this).parent().index();

      $(this).addClass('active');
      sliderPrefooter.trigger('to.owl.carousel', [i, 900, true]);
    });

    var sliderPrefooter = $("#slider-prefooter").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 0,
      items: 1,
      touchDrag: false,
      mouseDrag: false
    });

    sliderPrefooter.owlCarousel();
  }

});