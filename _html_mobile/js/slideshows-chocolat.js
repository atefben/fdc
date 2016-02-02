$(document).ready(function() {

  $.initSlideshow = function(){
    var slideshows = [];
    // init slideshow chocolat
    var slideshow;
      if($('.slideshow').length) {

        slideshow = $('.slideshow .images').Chocolat({
         imageSize: 'cover',
          fullScreen: false,
          loop: true
        }).data('chocolat');

        slideshows.push(slideshow);
      }
      if($('.all-photos').length) {

        slideshow = $('.list').Chocolat({
          imageSize: 'cover',
          fullScreen: false,
          loop:true
        }).data('chocolat');

        slideshows.push(slideshow);
      }


    // close slideshow on click
    $('body').off('click', '.close-button');
    $('body').on('click', '.close-button', function(e){
      $('body').removeClass('allow-landscape chocolat-open chocolat-cover');
      document.body.removeEventListener('touchmove', listener,false);

      $('#choco-container').removeClass('show');

      setTimeout(function() {
        $('.chocolat-wrapper').removeClass('show');

      }, 900);
    });
    $('body').off('click', '.share');
   $('body').on('click', '.share', function(e){
    console.log("show");
       e.preventDefault();
        setTimeout(function() {
          $('.buttons.square').toggleClass('show');
        }, 200);
       
   });

   $('body').off('click', '.open-thumbnails');
   $('body').on('click', '.open-thumbnails', function(e){
    console.log("show thumbnails");
        e.preventDefault();
        setTimeout(function() {
          $('div.chocolat-wrapper .thumbnails').toggleClass('show');
        }, 200);
       
   });
      
    var listener = function (event) {
      event.preventDefault();
    };




    // zoom
    $('body').off('click', '.chocolat-image');
    $('body').on('click', '.chocolat-image', function() {
      var $that = $(this);
      $('body').addClass('allow-landscape');
      $('#choco-container').addClass('show');
      document.body.addEventListener('touchmove', listener,false);
      $('.chocolat-top').html('<div class="close-button"><i class="icon icon_close"></i></div>');
      $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');

      
      $('<a href="#" class="open-thumbnails"></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
      $('<div class="buttons square"><a href="#" class="button facebook"><i class="icon icon_facebook"></i></a><a href="#" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');
      $('<div class="thumbnails"></div>').insertAfter('.chocolat-wrapper .chocolat-pagination');
    $('.slideshow').find('.thumbnails .thumb').each(function() {
        $('.chocolat-wrapper .thumbnails').append($(this).clone());
    });

    // if($('#gridPhotos').length) {
    //   $('#gridPhotos .item').each(function() {
    //     if($(this).css('display') != 'none') {
    //       $('.chocolat-wrapper .thumbnails').append('<div data-id="' + $(this).find('.chocolat-image').attr('id') + '" class="thumb"><img src="' + $(this).find('img').attr('src') + '" /></div>');
    //     }
    //   });
    // }

    if ($('body').hasClass('mob')) {
      $('.chocolat-bottom').addClass('show');
    }


    $('.chocolat-wrapper .thumbnails').owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      margin: 0,
      responsive:{
        0:{
          items:4
        },
        1280: {
          items: 6
        },
        1600:{
          items:7
        },
        1800:{
          items:8
        },
        1920: {
          items: 9
        }
      }
    });
    // on click on thumb from the list : change pic and update hash
  $('body').on('click', '.chocolat-wrapper .thumb', function() {
    var j = $(this).parent().index();

    $('.chocolat-wrapper .thumb').removeClass('active');
    $(this).addClass('active');

    //var slideshow = $('.slideshow .images').data('chocolat');
    slideshow.api().goto(j);
    // for(var i=0; i<slideshows.length; i++) {
    //   slideshows[i].api().goto(j);
    // }

    window.location.hash = $(this).data('id');
  });

      window.location.hash = $that.attr('id');

      setTimeout(function() {
        $('.chocolat-bottom').addClass('show');
        $('.chocolat-wrapper').addClass('show');
      }, 200);


      // ADD SWIPE TO NAVIGATE THROUGH PHOTOS
      var myElement = document.getElementById('chocolat-content-1');
      var hammertime = new Hammer(myElement);
      hammertime.on('swipeleft', function(ev) {
          slideshow.api().next();
      });
      hammertime.on('swiperight', function(ev) {
          slideshow.api().prev();
      });
      hammertime.on('pan', function(ev){
        console.log(ev);
      });
      
     //  $('body').on('click', '.chocolat-img', function(e){
     //    console.log("tap",slideshow.api().get('imageSize'));
     //    if(slideshow.api().get('imageSize')=='cover'){
     //        slideshow.api().set('imageSize', 'contain');
     //        slideshow.api().set('initialZoomState', null);
     //        slideshow.api().place();
     //    }else{
     //        slideshow.api().set('imageSize', 'cover');
     //        slideshow.api().set('initialZoomState', null);
     //        slideshow.api().place();
     //    }
         
     // });

    });
  }
  $.initSlideshow();

  
  


});