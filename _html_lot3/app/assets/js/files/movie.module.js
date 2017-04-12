var videoMovie;


// Single Movie
// =========================
$( window ).resize( function(){
  if($('.grid-selection .isotope-01').length) {
    var w = $('.grid-selection .isotope-01 .contain-img').first().width();
    $('.grid-selection .isotope-01 .contain-img').each(function() {
      $(this).css('height', (w / 0.75));
    });
  }
});
$(document).ready(function() {
  if($('.content-movie').length) {
    $('.content-movie .prevmovie').on('click', function (e) {
      var link = $('.content-movie .arrows .nav.prev').attr('href');
      document.location.href = link;
    });

    $('.content-movie .nextmovie').on('click', function (e) {
      var link = $('.content-movie .arrows .nav.next').attr('href');
      document.location.href = link;
    });
  }

  if($('.grid-selection .isotope-01').length) {
    var w = $('.grid-selection .isotope-01 .contain-img').first().width();
    $('.grid-selection .isotope-01 .contain-img').each(function() {
      $(this).css('height', (w / 0.75));
      var $container = $(this), imgUrl = $container.find('img').prop('src');
      if (imgUrl) {
        $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
      }
    });
  }


  //fix tatiana
  if($('.single-movie').length) {
    var h = $('.press[data-section]').height();
    $('.contacts').css('min-height',h);
  }

  // anchors menu
  $('#nav-movie ul a').on('click', function (e) {

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

    e.preventDefault();
  });

  /* thomon - tetiere height computing */
  if($('.tetiere-movie').length) {
    var tetiere = $('.tetiere-movie'),
    defaultHeight = 287, //magic number, booooh
    currentHeight = tetiere.outerHeight();
    
    if(tetiere.find('h2').outerHeight() > 35 ){ //2 lines & more
      tetiere.css({
        'height': defaultHeight,
        'position':'relative',
        'top':  (currentHeight > defaultHeight) ? 0 : - (parseInt(defaultHeight) - parseInt(currentHeight))
      });
    }else{
      tetiere.css('height',defaultHeight);
    }
  }
  /* end tetiere height computing */



  if($('.single-movie').length) {

        

    /*var cl = new CanvasLoader('canvasloader');
        cl.setColor('#ceb06e');
        cl.setDiameter(20);
        cl.setDensity(34);
        cl.setRange(0.8);
        cl.setSpeed(1);
        cl.setFPS(60);*/

    function setActiveMovieVideos() {
      $('#slider-movie-videos .owl-item').removeClass('center');
      $('#slider-movie-videos .owl-item.active').first().addClass('center');
    }

    function initSliders() {
      // slider competitions
      var sliderCompetition = new Sly( $(".competition"), {
          speed: 200,
          slidee: $('#slider-competition'),
          horizontal: 1,
          mouseDragging: 1,
          releaseSwing: 1
      } );
      
      sliderCompetition.init();
    }

    initSliders();

    // gallery slideshow
    $('.gallery .img img').each(function() {
      var w = $(this).width(),
          h = $(this).height();

      if(w/h > 0.8179 && !jQuery('#main').hasClass('single-movie')) {
        $(this).addClass('landscape');
      }
    });

    $('.gallery .thumbs a').click(function () {
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

  

    // previous and next over
    $('body').on('mouseover', '.single-movie .nav', function(e) {
      if($(this).hasClass('prev')) {
        $('.prevmovie').addClass('show');
      } else {
        $('.nextmovie').addClass('show');
      }
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

    if($('#video-movie-trailer').length > 0) {
      videoMovie = playerInit('video-movie-trailer');
      videoMovie.resize('100%','100%');
      // show and play trailer
      $('.poster .picto').on('click', function(e) {
        $('html, body').animate({
          scrollTop: 0
        }, 300, function() {
          $('.main-image, .poster, .info-film, .palmares, .nav').addClass('trailer');
          $('.main-image').data('height', $('.main-image').height()).height($(window).height() - 91).css('padding-top', '91px');
          $('#video-movie-trailer').closest('.video-container').css({
            'margin-top': '91px',
            'height' : 'calc(100% - 91px)'
          });
          setTimeout(function() {
            $('header').addClass('sticky');
            $('body').css('padding-top', 0);
          }, 800);
        });

        setTimeout(function() {
          videoMovie.play();
        }, 500);
        e.preventDefault();
      });
    }

    //movie slider
    if($("#slider-movie-videos").length){
      var sliderMovieVideos = $("#slider-movie-videos").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        loop: false,
        margin: 50,
        autoWidth: true,
        dragEndSpeed: 600,
        responsive:{
          0:{
            items: 3
          },
          1675: {
            items: 4
          }
        },
        onInitialized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-movie-videos .owl-stage').css({ 'margin-left': m });
          //setActiveMovieVideos();
        },
        onResized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-movie-videos .owl-stage').css({ 'margin-left': m });
        },
        onTranslated: function() {
          //setActiveMovieVideos();
        }
      });

      $('#slider-movie-videos .slide-video').on('mousedown', function(e) {
        var number = $(this).closest('.owl-item').index();
          setTimeout(function(){
              if (!$('#slider-movie-videos .slide-video').closest('.owl-item').parent().hasClass('owl-grab')) {
                  videoMovieBa.playlistItem(number);
                  sliderMovieVideos.trigger('to.owl.carousel', [number, 400, true]);
              }
          }, 100);
      });
    }
  }
});
