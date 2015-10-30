$(document).ready(function() {

  $(window).on('resize', function() {
    if($('.home').length) {
      setHeightSlider();
    }
    if($('.grid').length) {
      resizeGrid();
    }
    if($('#prehome-container').length) {
      $('#prehome-container').height($(window).height());
    }
  });
});