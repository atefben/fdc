$(document).ready(function() {
  var cl = new CanvasLoader('siteLoader');
      cl.setColor('#ceb06e');
      cl.setDiameter(20);
      cl.setDensity(34);
      cl.setRange(0.8);
      cl.setSpeed(1);
      cl.setFPS(60);

  cl.show();
  var $loader = $('#siteLoader'),
      $main = $('#main'),
      $header = $('header');

  if(parseInt(sessionStorage.scrolltop) > 10) {
    $('#logo-wrapper, #logo img, #sticky-user, header #search, a.search').css('transition', 'none');
    $('#sticky-user').css('transition-delay', '0');
    $('p.stick').addClass('noTrans');
    $header.addClass('sticky');
    $('body').css('margin-top', '91px');

    $('html, body').animate({
      scrollTop: 10
    }, 0);
  }

  setTimeout(function() {
    $('#main, footer').removeClass('loading');
    cl.hide();

    $('#logo-wrapper, #logo img, #sticky-user, header #search, a.search').css('transition', '');
    $('p.stick').removeClass('noTrans');
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
        var v = $(window).scrollTop();
        if(v == 0 && $header.hasClass('sticky')) {
          v = 11;
        }
        sessionStorage.setItem('scrolltop',v);
        window.location = href;
      }, 1900);
    }

    return false;
  });

});