// Slideshow
// =========================

var slideshows = [];

function initSlideshows() {

  $('.thumbnails').owlCarousel({
    autoWidth: true,
    nav: false,
    dots: false,
    smartSpeed: 500,
    margin: 10
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

  if($('.slideshow').length) {
    var slideshow = $('.slideshow .images').Chocolat({
      imageSize: 'cover',
      fullScreen: false
    }).data('chocolat');

    slideshows.push(slideshow);
  }

  $('body').on('click', '.chocolat-img', function(e){
    for(var i=0; i<slideshows.length; i++) {
      slideshows[i].api().close();
    }
  });

}

$('body').on('mouseover', '.chocolat-img', function(e){
  $('.chocolat-wrapper .thumbnails').removeClass('open');
  $('.chocolat-pagination').removeClass('active');
});

$('body').on('mouseover', '.chocolat-image', function() {
  $(this).attr('data-title', $(this).attr('title'));
  $(this).removeAttr('title');
});

$('body').on('mouseout', '.chocolat-image', function() {
  $(this).attr('title', $(this).attr('data-title'));
});

$('body').on('click', '.chocolat-pagination', function() {7
  $(this).toggleClass('active');
  $('.chocolat-wrapper .thumbnails').toggleClass('open');
});

$('body').on('click', '.chocolat-image', function() {
  $('.chocolat-wrapper .chocolat-bottom').append('<div class="thumbnails"></div>');
  $('.chocolat-left, .chocolat-right').appendTo('.chocolat-bottom');
  $('<a href="#" class="share"></a>').insertBefore('.chocolat-wrapper .chocolat-left');

  $(this).parents('.slideshow').find('.thumbnails .thumb').each(function() {
    $('.chocolat-wrapper .thumbnails').append($(this).clone());
  });

  if($(this).parents('#gridPhotos').length) {
    $('#gridPhotos .item').each(function() {
      $('.chocolat-wrapper .thumbnails').append('<div class="thumb"><img src="' + $(this).find('img').attr('src') + '" /></div>');
    });
  }

  $('.chocolat-wrapper .thumbnails').owlCarousel({
    autoWidth: true,
    nav: false,
    dots: false,
    smartSpeed: 500,
    margin: 0
  });
});

$('body').on('click', '.chocolat-wrapper .thumb', function() {
  var j = $(this).parent().index();

  $('.chocolat-wrapper .thumb').removeClass('active');
  $(this).addClass('active');

  var slideshow = $('.slideshow .images').data('chocolat');
  for(var i=0; i<slideshows.length; i++) {
    slideshows[i].api().goto(j);
  }

});

$(document).ready(function() {
  initSlideshows();
});

$('body').on('mouseout', '.chocolat-content', function(){
  $('.chocolat-close').hide();
  return false;
});
$('body').on('mouseenter', '.chocolat-content', function(){
  $('.chocolat-close').show();
  return false;
});
$('body').on('mousemove', '.chocolat-content', function(e){
  $('.chocolat-close').css('left', e.clientX + 10).css('top', e.clientY);
});