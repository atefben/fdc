$(document).ready(function() {

  $(window).on('resize', function() {
    if($('.home').length) {
      setHeightSlider();
    }
    if($('.grid').length) {
      resizeGrid();
      setTimeout(function() {
        resizeGrid();
      }, 300);
    }
    if($('#prehome-container').length) {
      $('#prehome-container').height($(window).height());
    }
    var pxT = parseInt(($('#selection .owl-stage-outer').width() / 2) - 131) + "px";
    $('#selection .owl-stage').css('transform', 'translate3d(' + pxT + ',0, 0)');
  });
});