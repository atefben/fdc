var initHeaderSticky = function() {

  $(window).on('scroll', function() {
    var $header = $('header');
    var lastScrollTop = 0;
    var s = $(this).scrollTop();
    scrollTarget = s;

    // STICKY HEADER
    if(s > lastScrollTop) {
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
};

var owInitNavSticky = function(number) {

  if(number == 1) {
    var $header    = $('.navigation-sticky');
  }else if(number == 2) {
    var $header    = $('.navigation-sticky-02');
  }else if(number == 3){
    var $header = $('.filters-02');
  }

  $(window).on('scroll', function() {

    var pushHeight = $('.block-push-top').height();
    var s          = $(this).scrollTop();

    if(s > pushHeight) {
      $header.addClass('sticky');
    }else{
      $header.removeClass('sticky');
    }

    if($('header').hasClass('sticky') && number == 3){
      $header.addClass('sticky');
    }
  });
};

var owArrowDisplay = function() {

  var blockPushHeight = $('.block-push-top').height()-180;
  var s               = $(this).scrollTop();
  var footer          = $('#breadcrumb').offset().top-700;
  var $btnsArrow      = $('.arrows');



  if(s > blockPushHeight && s < footer) {
    $btnsArrow.addClass('visible')
  }else{
    $btnsArrow.removeClass('visible')
  }

  $(window).on('scroll', function() {
    var s = $(this).scrollTop();

    if(s > blockPushHeight && s < footer) {
      $btnsArrow.addClass('visible')
    }else{
      $btnsArrow.removeClass('visible')
    }
  });
};

var onInitParallax = function() {

  if(!$('body').hasClass('mobile')){

    $(window).on('scroll', function() {

      if($('header.sticky').length ){
        var s = $(this).scrollTop() - 120;
        $('.block-push').css('background-position', '0px '+s+'px');
      }else{
        $('.block-push').css('background-position','0px '+'0px');
      }

    });
  }

};
