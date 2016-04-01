$(document).ready(function() {
  var sliderDirector = $(".director-carousel").owlCarousel({ 
    nav          : false,
    dots         : false,
    smartSpeed   : 500,
    fluidSpeed   : 500,
    loop         : false,
    margin       : 55,
    autoWidth    : true,
    dragEndSpeed : 600,
    items        : 1,
    center       : true
  });
  sliderDirector.owlCarousel();

  initFilmsSliders();
});