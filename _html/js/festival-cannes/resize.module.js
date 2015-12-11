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

  var dragging = false;

  $("body").on("touchmove", function(){
      dragging = true;
  });

  $('body').on('touchend', 'a', function(e) {
    if (dragging) return;
    $(this).trigger('click');
  });

  $("body").on("touchstart", function(){
      dragging = false;
  });
});