$(document).ready(function() {

  if($('.artist').length) {
    $("#slide-artist").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      autoWidth: true,
      loop: false,
      responsive:{
        0:{
          items: 4
        },
        1675: {
          items: 5
        }
      },
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slide-artist .owl-stage').css({ 'margin-left': m });
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slide-artist .owl-stage').css({ 'margin-left': m });
      }
    });
	alert('ici');
    if(navigator.userAgent.indexOf("Edge")    > -1 ||
       navigator.userAgent.indexOf("MSIE")    > -1 ||
       navigator.userAgent.indexOf("Trident") > -1 ) {
      $('#slide-artist .compat-object-fit-c').each(function () {
		  var $container = $(this), imgUrl = $container.find('img').prop('src');
        if (imgUrl) {
          $container.css('backgroundImage', 'url('+imgUrl+')');
        }
      });
    }
  }
});