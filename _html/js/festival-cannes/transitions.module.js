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
      $main   = $('#main'),
      $header = $('header');

  if(parseInt(sessionStorage.scrolltop) > 10) {
    $('#logo-wrapper, #logo img, #sticky-user, header #search, a.search').css('transition', 'none');
    $('#sticky-user').css('transition-delay', '0');
    $('p.stick').addClass('noTrans');
    $header.addClass('sticky');
    $('body').css('margin-top', '101px');

    $('html, body').animate({
      scrollTop: 10
    }, 0);
  }

  setTimeout(function() {
    $('#main, footer, #breadcrumb, .sub-nav-list').removeClass('loading');
    cl.hide();
    $loader.removeClass('show');

    $('#logo-wrapper, #logo img, #sticky-user, header #search, a.search').css('transition', '');
    $('p.stick').removeClass('noTrans');
  }, 500);
  $('body').on('click', "a[target!='_blank']:not(.ajax, .link)", function(e) {
	  
    var href = $(this).attr('href');
    var isiPad = navigator.userAgent.match(/iPad/i) != null;

    if(!isiPad) {
      e.preventDefault();
    }

    if(href.indexOf('#') == -1 || $(this).hasClass('ajaxi')) {

      if(!isiPad) {
		  if(!$(this).hasClass('ajaxi')) {
		  	 $('#main, footer, #breadcrumb, .sub-nav-list').addClass('loading');
		  }  

        setTimeout(function() {
          cl.show();
          $loader.addClass('show');
        }, 1000);

        setTimeout(function() {
          $loader.removeClass('show');
        }, 1800);

        setTimeout(function() {
          var v = $(window).scrollTop();
          if((v == 0 && $header.hasClass('sticky')) || (v == 10 && $header.hasClass('sticky'))) {
            v = 11;
          }
          sessionStorage.setItem('scrolltop',v);
          window.location = href;
        }, 1800);
      }
    }

    if(!isiPad) {
      return false;
    }
  });

});
