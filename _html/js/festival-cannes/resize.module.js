$(document).ready(function() {

  $(window).on('resize', function() {
    if($('.home').length) {
      setHeightSlider();
    }
    resizeGrid();
    if($('#prehome-container').length) {
      $('#prehome-container').height($(window).height());
    }
  });
});