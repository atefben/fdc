// Slideshow
// =========================
var slideshows = [],
    thumbnails = [];

function initSlideshows() {
  console.log('initSlideshows');
  $('.slideshow-img .images .img:first-child').addClass('active');
  var idPhoto = $('.slideshow-img .images .img:first-child a').attr('id');

  $('.thumbnails div[data-id='+idPhoto+']').addClass('active');


  // create slider of thumbs
  var nbItems = $('.single-article').length != 0 ? 7 : 8;

  var sliderThumbs = $('.thumbnails').owlCarousel({
    nav          : false,
    dots         : false,
    smartSpeed   : 500,
    autoWidth    : true,
    margin       : 10,
    dragEndSpeed : 900,
    items        : 5
  });

  if(navigator.userAgent.indexOf("Edge")    > -1 ||
     navigator.userAgent.indexOf("MSIE")    > -1 ||
     navigator.userAgent.indexOf("Trident") > -1 ) {
    $('.thumbnails .thumb').each(function () {
      var $container = $(this),
          imgUrl     = $container.find('img').prop('src');

      if (imgUrl) {
        $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
      }
    });
  }

  $('body').on('click', '.slideshow .thumbnails .owl-item', function(e) {
    sliderThumbs.trigger('to.owl.carousel', [$(this).index(), 400, true]);
  });

  // on click on thumbnail, change main picture
  $('.thumbnails .owl-item').on('click', function(e) {
    e.preventDefault();

    var i   = $(this).index(),
        cap = $(this).find('.thumb').data('caption');

    $(this).parents('.slideshow').find('.thumb').removeClass('active');
    $(this).parents('.slideshow').find('.images .img').removeClass('active');
    $(this).parents('.slideshow').find('.caption').html(cap);
    $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
    $(this).find('.thumb').addClass('active');
  });
  
}


// on click on thumb from the list : change pic and update hash
$('body').on('click', '.chocolat-wrapper .thumb', function() {
  var j = $(this).parent().index();

  $('.chocolat-wrapper .thumb').removeClass('active');
  $(this).addClass('active');

  if($('body').hasClass('chocolat-zoomed')) {
    $('.chocolat-content img.chocolat-img').trigger('click');
  }

  var slideshow = $('.slideshow .images').data('chocolat');
  for(var i=0; i<slideshows.length; i++) {
    slideshows[i].api().goto(j);
  }

  $('.chocolat-pagination').trigger('click');
  window.location.hash = 'pid='+$('#'+$(this).data('id')).data('pid');
});

$(document).ready(function() {
  initSlideshows();
  $("li > a").click(function() {
    initSlideshows();
  });
});

var timeoutCursor;