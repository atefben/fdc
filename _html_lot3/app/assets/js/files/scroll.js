var initHeaderSticky = function() {

  $(window).on('scroll', function() {
    var $header = $('header');
    var lastScrollTop = 0;
    var s = $(this).scrollTop();
    scrollTarget = s;

    // STICKY HEADER
    if (s > lastScrollTop){
      if(($('#prehome-container').length == 0 && s > 30)) {
        $header.addClass('sticky');
        $('body').css('margin-top', '91px');
      }
    } else {
      if(($('#prehome-container').length == 0 && s < 30)) {
        $header.removeClass('sticky');
        $('body').css('margin-top', '0');
      }
    }
  });
}
