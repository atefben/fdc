// Single Movie
// =========================
$(document).ready(function() {

  if($('.single-movie').length) {

    var cl = new CanvasLoader('canvasloader');
        cl.setColor('#ceb06e');
        cl.setDiameter(20);
        cl.setDensity(34);
        cl.setRange(0.8);
        cl.setSpeed(1);
        cl.setFPS(60);

    function initSliders() {
      // init slider
      var sliderMovieVideos = $("#slider-movie-videos").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        center: true,
        loop: false,
        margin: 50,
        autoWidth: true,
        dragEndSpeed: 600,
        onInitialized: function() {
          $('#slider-movie-videos .owl-stage').css({ 'margin-left': "-343px" });
        }
      });

      sliderMovieVideos.owlCarousel();

      // slider competitions
      var sliderCompetition = $("#slider-competition").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        center: true,
        loop: false,
        margin: 50,
        autoWidth: true,
        dragEndSpeed: 600,
        onInitialized: function() {
          $('#slider-competition .owl-stage').css({ 'margin-left': "-385px" });
        }
      });

      sliderCompetition.owlCarousel();
    }
    
    initSliders();

    // go to item
    $('body').on('click', '#slider-movie-videos .owl-item', function(e) {
      sliderMovieVideos.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // gallery slideshow
    $('body').on('click', '.gallery .thumbs a', function(e) {
      e.preventDefault();
      var i = $(this).index(),
          cap = $(this).data('caption');

      $('.gallery .img img').removeClass('active');
      $('.gallery .img img').eq(i).addClass('active');

      $('.gallery .thumbs a').removeClass('active');
      $(this).addClass('active');

      $('.gallery .caption').text(cap);
    });

    // anchors menu
    $('body').on('click', '#nav-movie ul a', function (e) {
      e.preventDefault();

      $('#nav-movie ul a').removeClass('active');
      $(this).addClass('active');

      var $el = $(this)
        , id = $el.attr('href').substr(1);
     
      var posT = $('*[data-section="' + id + '"]').offset().top - $('#nav-movie').height() - $('header').height();

      if(!$('#nav-movie').hasClass('sticky')) {
        posT -= 32;
      }

      $('html, body').animate({
        scrollTop: posT
      }, 500);
    });

    $('body').on('click', '#slider-competition .owl-item', function(e) {
      sliderCompetition.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // show and play trailer
    $('body').on('click', '.poster .picto', function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: 0
      }, 300, function() {
        $('.main-image, .poster, .info-film, .nav').addClass('trailer');
        $('.main-image').data('height', $('.main-image').height()).height($(window).height() - 91).css('padding-top', '91px');
        setTimeout(function() {
          $('header').addClass('sticky');
          $('body').css('padding-top', 0);
        }, 800);
        
      });
    });

    // previous and next over
    $('body').on('mouseover', '.single-movie .nav', function(e) {
      if($(this).hasClass('prev')) {
        $('.prevmovie').addClass('show');
      } else {
        $('.nextmovie').addClass('show');
      }
    });

    $('body').on('click', '.single-movie .prevmovie', function(e) {
      $('.single-movie .nav.prev').trigger('click');
    });

    $('body').on('click', '.single-movie .nextmovie', function(e) {
      $('.single-movie .nav.next').trigger('click');
    });

    // previous and next over
    $('body').on('mouseover', '.single-movie .prevmovie', function(e) {
      $('.single-movie .nav.prev').addClass('over');
    });
    $('body').on('mouseover', '.single-movie .nextmovie', function(e) {
      $('.single-movie .nav.next').addClass('over');
    });

    $('body').on('mouseover', '.main-image, .container, .videos, div.press, .competition', function(e) {
      $('.prevmovie, .nextmovie').removeClass('show');
      $('.single-movie .nav').removeClass('over');
    });

    // previous and next
    $('body').on('click', '.single-movie .nav', function(e) {
      e.preventDefault();

      var $that = $(this);

      if($that.hasClass('next')) {
        $('.anim').addClass('next');
      } else {
        $('.anim').removeClass('next');
      }

      $('.anim').addClass('show');
      setTimeout(function() {
        cl.show();
        $('#canvasloader').addClass('show');
      }, 800);

      var urlPath = $that.attr('href');

      // remove timeout once on server. only for animation.

      setTimeout(function() {
        $('html, body').animate({
          scrollTop: 0
        }, 0);
        $.get(urlPath, function(data){
          $(".content-movie").html( $(data).find('.content-movie') );
          history.pushState('',GLOBALS.texts.url.title, urlPath);

          $('#canvasloader').removeClass('show');

          setTimeout(function() {
            if($that.hasClass('next')) {
              $('.anim').removeClass('next show');
            }
            else {
              $('.anim').addClass('next').removeClass('show');
            }
            cl.hide();
            initSliders();
            initSlideshows();
            initAudioPlayers();
          }, 800);
        });
      }, 2000);
    });

  }

});