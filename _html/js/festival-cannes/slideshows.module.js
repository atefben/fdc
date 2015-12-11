// Slideshow
// =========================

var slideshows = [];

function initSlideshows() {

  // create slider of thumbs
  var nbItems = $('.single-article').length != 0 ? 7 : 8;

  var sliderThumbs =$('.thumbnails').owlCarousel({
    nav: false,
    dots: false,
    smartSpeed: 500,
    margin: 10,
    dragEndSpeed: 900,
    items: nbItems
  });

  sliderThumbs.owlCarousel();

  $('body').on('click', '.slideshow .thumbnails .owl-item', function(e) {
    sliderThumbs.trigger('to.owl.carousel', [$(this).index(), 400, true]);
  });

  // on click on thumbnail, change main picture
  $('.thumbnails .owl-item').on('click', function(e) {
    e.preventDefault();

    $(this).parents('.slideshow').find('.thumb').removeClass('active');
    $(this).parents('.slideshow').find('.images .img').removeClass('active');

    var i = $(this).index(),
        cap = $(this).find('.thumb').data('caption');

    $(this).find('.thumb').addClass('active');
    $(this).parents('.slideshow').find('.caption').html(cap);
    $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
  });

  // init slideshow
  if($('.slideshow').length) {

    var slideshow = $('.slideshow .images').Chocolat({
      imageSize: 'cover',
      fullScreen: false,
      loop: true
    }).data('chocolat');

    slideshows.push(slideshow);
  }

  if($('.all-photos').length) {
    var slideshow = $('#gridPhotos').Chocolat({
      imageSize: 'cover',
      fullScreen: false,
      imageSelector: '.item:not(.isotope-hidden) .chocolat-image'
    }).data('chocolat');

    slideshows.push(slideshow);
  }
  
}

// close slideshow on click 
$('body').on('click', '.chocolat-close', function(e){

  $('.chocolat-img').css('transition', 'all 0.9s ease').addClass('close');

  $('.chocolat-bottom').css('opacity', 0);
  $('.chocolat-close').css('opacity', 0);

  setTimeout(function() {
    $('.chocolat-wrapper').removeClass('show');
    $('body').removeClass('fixed');

    if($('.slideshow').length) {
      $('html, body').animate({
        scrollTop: $(window.location.hash).parents('.slideshow').offset().top - 300
      }, 0);
    }

    setTimeout(function() {
      for(var i=0; i<slideshows.length; i++) {
        
          slideshows[i].api().close();
          slideshows[i].api().destroy();
          history.pushState("", document.title, window.location.pathname);
        
      }
    }, 1000);

    setTimeout(function() {
      slideshows = [];
      $('.chocolat-wrapper').remove();
      initSlideshows();
    }, 1400);
  }, 900);
});

// mouseover img : close thumbs
$('body').on('mouseover', '.chocolat-img', function(e){
  $('.chocolat-wrapper .thumbnails').removeClass('open');
  $('.chocolat-pagination').removeClass('active');
  $('.chocolat-content').removeClass('thumbsOpen');
});

// mouseover img : hide attribute title
$('body').on('mouseover', '.chocolat-image', function() {
  $(this).attr('data-title', $(this).attr('title'));
  $(this).removeAttr('title');
});

// mouseout img : reset attribute title
$('body').on('mouseout', '.chocolat-image', function() {
  $(this).attr('title', $(this).attr('data-title'));
});

// show thumbs
$('body').on('mouseover', '.chocolat-pagination', function() {
  $(this).addClass('active');
  $('.chocolat-wrapper .thumbnails').toggleClass('open');
  $('.chocolat-content').addClass('thumbsOpen');
});

$('body').on('click', '.chocolat-bottom .share', function() {
  $('.chocolat-bottom .buttons').toggleClass('show');
});

// zoom
$('body').on('click', '.chocolat-image', function() {
  var $that = $(this);

  $('.chocolat-wrapper .chocolat-bottom').append('<div class="thumbnails"></div>');
  $('.chocolat-left, .chocolat-right').appendTo('.chocolat-bottom');
  $('<a href="#" class="share"></a>').insertBefore('.chocolat-wrapper .chocolat-left');
  $('<div class="buttons square"><a href="#" class="button facebook"></a><a href="#" class="button twitter"></a><a href="#" class="button link"></a><a href="#" class="button email"></a></div>').appendTo('.chocolat-bottom');
  $('<div class="zoomCursor"></div>').appendTo('.chocolat-wrapper');
  $('<div class="credit">' + $that.data('credit') + '</div>').insertBefore('.chocolat-wrapper .share');

  setTimeout(function() {
    $('.chocolat-wrapper').addClass('show');
  }, 200);

  setTimeout(function() {
    $('.chocolat-wrapper .chocolat-img').css('transition', 'all 900ms cubic-bezier(0.165, 0.435, 0.000, 0.935)');
    // change url hash
    window.location.hash = $that.attr('id');
    $('body').addClass('fixed');
  }, 2500);

  $(this).parents('.slideshow').find('.thumbnails .thumb').each(function() {
    $('.chocolat-wrapper .thumbnails').append($(this).clone());
  });

  if($(this).parents('#gridPhotos').length) {
    $('#gridPhotos .item').each(function() {
      if($(this).css('display') != 'none') {
        $('.chocolat-wrapper .thumbnails').append('<div data-id="' + $(this).find('.chocolat-image').attr('id') + '" class="thumb"><img src="' + $(this).find('img').attr('src') + '" /></div>');
      }
    });
  }
  
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
        items:5
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
});

// on click on thumb from the list : change pic and update hash
$('body').on('click', '.chocolat-wrapper .thumb', function() {
  var j = $(this).parent().index();

  $('.chocolat-wrapper .thumb').removeClass('active');
  $(this).addClass('active');

  var slideshow = $('.slideshow .images').data('chocolat');
  for(var i=0; i<slideshows.length; i++) {
    slideshows[i].api().goto(j);
  }

  window.location.hash = $(this).data('id');
});

$(document).ready(function() {
  initSlideshows();

  // if url contains a hash : load pic
  if(window.location.hash) {

    if($(window.location.hash).length) {
      $(window.location.hash).trigger('click');

      $('.chocolat-wrapper .thumb').removeClass('active');
      $('.chocolat-wrapper .thumb[data-id="' + window.location.hash.substr(1) + '"]').addClass('active');
    }
  }
});

// update hash and active photo on nav click
$('body').on('click', '.chocolat-left', function(){
  var hash = window.location.hash;

  if(parseInt(hash.substr(6)) - 1 > 0) {
    window.location.hash = hash.substr(1, 5) + (parseInt(hash.substr(6)) - 1);

    $('.chocolat-wrapper .thumb').removeClass('active');
    $('.chocolat-wrapper .thumb[data-id="' + window.location.hash.substr(1) + '"]').addClass('active');
  }
});

// update hash and active photo on nav click
$('body').on('click', '.chocolat-right', function(){
  var hash = window.location.hash;

  if(parseInt(hash.substr(6)) + 1 > 0) {
    window.location.hash = hash.substr(1, 5) + (parseInt(hash.substr(6)) + 1);

    $('.chocolat-wrapper .thumb').removeClass('active');
    $('.chocolat-wrapper .thumb[data-id="' + window.location.hash.substr(1) + '"]').addClass('active');
  }
});

// cursor close
$('body').on('mouseout', '.chocolat-content', function(){
  $('.zoomCursor').addClass('hide');
  return false;
});

$('body').on('mouseenter', '.chocolat-content', function(){
  $('.zoomCursor').removeClass('hide');
  return false;
}); 

var timeoutCursor;

$('body').on('mousemove', '.chocolat-content', function(e){
  if ($('body').hasClass('mob')) return false;

  $('.zoomCursor').css('left', e.clientX + 10).css('top', e.clientY);
  $('.chocolat-bottom').addClass('show');

  clearTimeout(timeoutCursor);
  timeoutCursor = setTimeout(function() {
    $('.chocolat-bottom').removeClass('show');
    $('.chocolat-bottom .buttons').removeClass('show');
  }, 4000);
});