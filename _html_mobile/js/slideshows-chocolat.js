$(document).ready(function() {


  var slideshows = [];
  // init slideshow chocolat
    if($('.slideshow').length) {

      var slideshow = $('.slideshow .images').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        loop: true,
      }).data('chocolat');

      slideshows.push(slideshow);
    }
    if($('.all-photos').length) {

      var slideshow = $('.list').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        loop:true,
      }).data('chocolat');

      slideshows.push(slideshow);
    }


  // close slideshow on click
  $('body').on('click', '.close-button', function(e){
    $('body').removeClass('allow-landscape');
    document.body.removeEventListener('touchmove', listener,false);
    // $('.chocolat-img').css('transition', 'all 0.9s ease').addClass('close');

    // $('.chocolat-bottom').css('opacity', 0);
    // $('.chocolat-close').css('opacity', 0);

    setTimeout(function() {
      $('.chocolat-wrapper').removeClass('show');

      // $('body').removeClass('fixed');

      // if($('.slideshow').length) {
      //   $('html, body').animate({
      //     scrollTop: $(window.location.hash).parents('.slideshow').offset().top - 300
      //   }, 0);
      // }

      // setTimeout(function() {
      //   for(var i=0; i<slideshows.length; i++) {

      //       slideshows[i].api().close();
      //       slideshows[i].api().destroy();
      //       history.pushState("", document.title, window.location.pathname);

      //   }
      // }, 1000);

      // setTimeout(function() {
      //   slideshows = [];
      //   $('.chocolat-wrapper').remove();
      //   initSlideshows();
      // }, 1400);
    }, 900);
  });

 $('body').on('click', '.share', function(e){
     e.preventDefault();
      setTimeout(function() {
        $('.buttons.square').toggleClass('show');
      }, 200);
     
 });


  var listener = function (event) {
    event.preventDefault();
  };

  // zoom
  $('body').on('click', '.chocolat-image', function() {
    var $that = $(this);
    $('body').addClass('allow-landscape');
    document.body.addEventListener('touchmove', listener,false);
    // $('.chocolat-left, .chocolat-right').appendTo('.chocolat-bottom');
    // $('.chocolat-left').html('<i class="icon icon_flecheGauche"></i>');
    // $('.chocolat-right').html('<i class="icon icon_fleche-right"></i>');
    $('.chocolat-top').html('<div class="close-button"><i class="icon icon_close"></i></div>');
    $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
    $('<div class="buttons square"><a href="#" class="button facebook"><i class="icon icon_facebook"></i></a><a href="#" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');
    // $('<div class="credit">' + $that.data('credit') + '</div>').insertAfter('.chocolat-description');

    window.location.hash = $that.attr('id');

    setTimeout(function() {
      $('.chocolat-bottom').addClass('show');
      $('.chocolat-wrapper').addClass('show');
    }, 200);

    // setTimeout(function() {
    //   // $('.chocolat-wrapper .chocolat-img').css('transition', 'all 900ms cubic-bezier(0.165, 0.435, 0.000, 0.935)');
    //   // change url hash
    //   window.location.hash = $that.attr('id');


    // }, 2500);

    // ADD SWIPE TO NAVIGATE THROUGH PHOTOS
    var myElement = document.getElementById('chocolat-content-1');
    var hammertime = new Hammer(myElement);
    hammertime.on('swipeleft', function(ev) {
        slideshow.api().next();
    });
    hammertime.on('swiperight', function(ev) {
        slideshow.api().prev();
    });

  });

  
  


});