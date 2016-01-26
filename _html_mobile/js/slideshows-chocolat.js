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
    $('body').removeClass('allow-landscape chocolat-open chocolat-cover');
    document.body.removeEventListener('touchmove', listener,false);


    setTimeout(function() {
      $('.chocolat-wrapper').removeClass('show');

    }, 900);
  });

 $('body').on('click', '.share', function(e){
     e.preventDefault();
      setTimeout(function() {
        $('.buttons.square').toggleClass('show');
      }, 200);
     
 });


  var listener = function (event) {
    // event.preventDefault();
  };

  // zoom
  $('body').on('click', '.chocolat-image', function() {
    var $that = $(this);
    $('body').addClass('allow-landscape');
    document.body.addEventListener('touchmove', listener,false);
    $('.chocolat-top').html('<div class="close-button"><i class="icon icon_close"></i></div>');
    $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
    $('<div class="buttons square"><a href="#" class="button facebook"><i class="icon icon_facebook"></i></a><a href="#" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');


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

  });

  
  


});