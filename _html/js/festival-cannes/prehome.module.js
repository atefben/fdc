$(document).ready(function() {
  if($('.home').length > 0 && $('#prehome-container').length > 0) {
    if (!isiPad()) {
      if(!$.cookie('prehome')) {
        $('body').addClass('fix');
        $('#prehome-container').addClass('show');
        $('#prehome-container').height($(window).height());
        $('#prehome').addClass('show');
      } else {
        $('#prehome-container').remove();

        setTimeout(function() {
          scrollTarget = 0;
          initParallaxElements();

          if(Object.size(parallaxElements) != 0) {
            update();
          }
        },200);
      }
    } else {
      if($('#prehome-container').length > 0) {
        $('#prehome-container').remove();
      }
    }

    if(!isiPad()) {
      if(!$.cookie('prehome')) {
        setTimeout(function() {
          $('html, body').animate({
            scrollTop: $("header").offset().top
          }, 800, function() {
            $('body,html').scrollTop(0);
            $('body').removeClass('fix');
            $('#prehome-container').remove();
            
            setTimeout(function() {
              scrollTarget = 0;
              initParallaxElements();

              if(Object.size(parallaxElements) != 0) {
                update();
              }
            },200);
          });
        }, 3000);
        $.cookie('prehome', '1', { expires: 7 });
      }
    }
  }

  if(getCookie('comply_cookie=comply_yes') != 1) {
    if($("#cookies-banner").length > 0) {
      $("#cookies-banner").hide();
    }
  }

  // cookie banner
  if($('.cookie-accept').length > 0) {
    $('.cookie-accept').on('click', function () {
      days = 365; //number of days to keep the cookie
      myDate = new Date();
      myDate.setTime(myDate.getTime()+(days*24*60*60*1000));
      document.cookie = "comply_cookie = comply_yes; expires = " + myDate.toGMTString(); //creates the cookie: name|value|expiry
      if($("#cookies-banner").length > 0) {
        $("#cookies-banner").slideUp("slow"); //jquery to slide it up
      }
    });
  }
});