$(document).ready(function() {

// Webtv
// =========================

  if($('.webtv').length) {
    if($('.webtv-live').length) {
     // play live player on click
     $('#live .play').on('click', function(e) {
       e.preventDefault();
       $('#live').addClass('on');
       //$('#live .img').addClass('rePosition');
       $('#live').data('height', $('#live').height()).height($(window).height() - 91);


       $('body').css('padding-top', 0);
       setTimeout(function() {
          if(!$('header').hasClass('sticky')) {
          $('#main').css('padding-top', '91px');
          }

          $('header').addClass('sticky');
        }, 800);
     });

     setTimeout(function() {
      $('#live .textLive').css('top', $('header').height() + ($('#live').height() - $('#live .textLive').height()) / 2);
      }, 500);

     if($('header').hasClass('sticky')) {
      $('.webtv #live .img').css('top', '-10%');
     }

      // create slide for trailers

      function setActiveTrailers() {
        $('#slider-trailers .owl-item').removeClass('center');
        $('#slider-trailers .owl-item.active').first().addClass('center');
        if($('#slider-trailers .owl-item.center').index() >= $('#slider-trailers .owl-item').length - 2) {
          $('#slider-trailers .owl-item').last().addClass('center');
        }
      }

      var sliderTrailers = $("#slider-trailers").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        fluidSpeed: 500,
        loop: false,
        margin: 50,
        autoWidth: true,
        dragEndSpeed: 600,
        responsive:{
          0:{
            items: 1
          },
          1675: {
            items: 2
          }
        },
        onInitialized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-trailers .owl-stage').css({ 'margin-left': m });
          setActiveTrailers();
        },
        onResized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-trailers .owl-stage').css({ 'margin-left': m });
        },
        onTranslated: function() {
          setActiveTrailers();
        }
      });

        sliderTrailers.owlCarousel();

        $('body').on('click', '#slider-trailers .owl-item', function(e) {
          sliderTrailers.trigger('to.owl.carousel', [$(this).index(), 400, true]);
        });
      }

    function setActiveTrailer() {
      $('#slider-trailer .owl-item').removeClass('center');
      $('#slider-trailer .owl-item.active').first().addClass('center');
    }

   // create slide for trailers
    var sliderTrailer = $("#slider-trailer").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        fluidSpeed: 500,
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
          $('#slider-trailer .owl-stage').css({ 'margin-left': m });
          setActiveTrailer();
        },
        onResized: function() {
          var m = ($(window).width() - $('.container').width()) / 2;
          $('#slider-trailer .owl-stage').css({ 'margin-left': m });
        },
        onTranslated: function() {
          setActiveTrailer();
        }
      });
       sliderTrailer.owlCarousel();
      $('body').on('click', '#slider-trailer .owl-item', function(e) {
        sliderTrailer.trigger('to.owl.carousel', [$(this).index(), 400, true]);
      });

if($('.webtv-ba-video').length){

      $('.nav li').click(function(){
        if($(this).hasClass('active')){

        }else{
          $('.nav').find('.active').removeClass('active');
          $(this).addClass('active');

            if($(this).hasClass('infos-film-li')){
              $('.program-film').css({display:'none'});
              $('.infos-film').css({display:'block'});

            }else{
              $('.program-film').css({display:"block"});
              $('.infos-film').css({display:"none"});

            }
        }
      });
    }

    //ajax
    $('.webtv .sub-nav-list a').on('click',function(e){
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');

//        $.get($(this).data('url'), function(data){
        $.get(urlPath, function(data){

          $( ".content-webtv" ).html( $(data).find('.content-webtv') );
          $('#live').html( $(data).find('#live') );
          history.pushState('',GLOBALS.texts.url.title, urlPath);
            $grid = $('#gridWebtv').imagesLoaded(function() {
              $grid.isotope({
                layoutMode: 'packery',
                itemSelector: '.item'
              });
            });
        });
        $('.webtv-ba .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });

    $('.item').click(function(){
      var url = $(this).find('.vCenterKid a').attr('href');
      document.location.href = url ;
    });

  }

  if($('.webtv-ba').length){

         //Scroll
      $(window).on('scroll', function() {
        var s = $(window).scrollTop();
        var h = $("#main").height()-900;

      if(s > 270 ){
        $('.sub-nav-list').addClass('sticky');
        $(".sub-nav-list").css({position: "fixed",top:90,zIndex:4});
      } else if (s < 270){
        $(".sub-nav-list").css({position: "relative",top:0});
      }
      });
     }
});
