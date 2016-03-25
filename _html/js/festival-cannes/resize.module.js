$(document).ready(function() {

  $(window).on('resize', function() {
    if($('.home').length) {
      setHeightSlider();
    }
    if($('.grid').length) {
      resizeGrid();
      // setTimeout(function() {
      //   resizeGrid();
      // }, 300);
    }
    // if($('#prehome-container').length) {
    //   $('#prehome-container').height($(window).height());
    // }
    var pxT = parseInt(($('#selection .owl-stage-outer').width() / 2) - 131) + "px";
    $('#selection .owl-stage').css('transform', 'translate3d(' + pxT + ',0, 0)');
  });

  if (navigator.userAgent.match(/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i)) {
    $('body').addClass('mob');
  }

  var dragging = false;

  $("body").on("touchmove", function(){
      dragging = true;
  });

  $('body').on('touchend', 'a', function(e) {
    if($(this).hasClass('read-more')) return;
    if($(this).hasClass('ajax') && !$(this).hasClass('chocolat-image')) return;
    if($(this).hasClass('selection')) return;
    if($(this).hasClass('read-later')) return;
    if($(this).hasClass('playpause')) return;
    if (dragging) return;
    $(this).trigger('click');
  });

  $("body").on("touchstart", function(){
      dragging = false;
  });
});