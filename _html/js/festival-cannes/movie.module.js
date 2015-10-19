// Single Movie
// =========================
$(document).ready(function() {

  if($('.single-movie').length) {

    // init slider
    var sliderMovieVideos = $("#slider-movie-videos").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-movie-videos .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderMovieVideos.owlCarousel();

    $('body').on('click', '#slider-movie-videos .owl-item', function(e) {
      sliderMovieVideos.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // gallery slideshow
    $('.gallery .thumbs a').on('click', function(e) {
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
    $('#nav-movie ul a').on('click', function (e) {
      e.preventDefault();

      $('#nav-movie ul a').removeClass('active');
      $(this).addClass('active');

      var $el = $(this)
        , id = $el.attr('href').substr(1);
     
      $('html, body').animate({
        scrollTop: $('*[data-section="' + id + '"]').offset().top - $('#nav-movie').height() - $('header').height()
      }, 500);
    });

    // slider competitions
    var sliderCompetition = $("#slider-competition").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-competition .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderCompetition.owlCarousel();

    $('body').on('click', '#slider-competition .owl-item', function(e) {
      sliderCompetition.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // show and play trailer
    $('.poster .picto').on('click', function(e) {
      e.preventDefault();

      $('.main-image').data('height', $('.main-image').height()).height($(window).height() - $('header').height());
      $('.main-image, .poster, .info-film, .nav').addClass('trailer');

      $('html, body').animate({
        scrollTop: 0
      }, 500);
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

      var urlPath = $that.attr('href');

      // remove timeout once on server. only for animation.

      setTimeout(function() {
        $.get(urlPath, function(data){
          $(".content-movie").html( $(data).find('.content-movie') );
          history.pushState('',"titre test", urlPath);

          if($that.hasClass('next')) {
            $('.anim').removeClass('next show');
          }
          else {
            $('.anim').addClass('next').removeClass('show');
          }
        });
      }, 2000);
    });

  }

});