$(document).ready(function() {

  if($('.artist').length) {
    $("#slide-artist").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      autoWidth: true,
      loop: false,
      items: 1,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slide-artist .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });
  }
});