$(document).ready(function() {
  var cl = new CanvasLoader('siteLoader');
      cl.setColor('#ceb06e');
      cl.setDiameter(20);
      cl.setDensity(34);
      cl.setRange(0.8);
      cl.setSpeed(1);
      cl.setFPS(60);

  cl.show();
  var $loader = $('#siteLoader');

  if(parseInt(sessionStorage.scrolltop) > 10) {
    $('#logo-wrapper, #logo img').css('transition', 'none');
    $('header').addClass('sticky');
  }

  setTimeout(function() {
    $('#main, footer').removeClass('loading');
    cl.hide();
  }, 500);

  $('body').on('click', "a[target!='_blank']:not(.ajax)", function(e) {
    var href = $(this).attr('href');
    e.preventDefault();

    if(href.indexOf('#') == -1) {

      $('#main, footer').addClass('loading');

      setTimeout(function() {
        cl.show();
        $loader.addClass('show');
      }, 1100);

      setTimeout(function() {
        $loader.removeClass('show');
      }, 1800);

      setTimeout(function() {
        sessionStorage.setItem('scrolltop',$(window).scrollTop());
        window.location = href;
      }, 1900);
    }

    return false;
  });

});