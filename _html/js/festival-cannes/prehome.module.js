$(document).ready(function() {


  if(getCookie('comply_cookie=comply_yes') == 1 || getCookie('comply_cookie=comply_yes') == 0) {
    if($("#cookies-banner").length > 0) {
      $("#cookies-banner").hide();
    }
  }else{
    if($("#cookies-banner").length > 0) {
      $("#cookies-banner").css('display','block');
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