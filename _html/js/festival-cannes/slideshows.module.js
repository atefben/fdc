// Slideshow
// =========================
var slideshows = [],
    thumbnails = [];

function initSlideshows() {
  // create slider of thumbs
  var nbItems = $('.single-article').length != 0 ? 7 : 8;

  var sliderThumbs = $('.thumbnails').owlCarousel({
    nav          : false,
    dots         : false,
    smartSpeed   : 500,
    margin       : 10,
    dragEndSpeed : 900,
    items        : nbItems
  });

  if(navigator.userAgent.indexOf("Edge")    > -1 ||
     navigator.userAgent.indexOf("MSIE")    > -1 ||
     navigator.userAgent.indexOf("Trident") > -1 ) {
    $('.thumbnails .thumb, .slideshow .slideshow-img .images .img a').each(function () {
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

  // init slideshow
  if($('.slideshow').length) {
    var slideshow = $('.slideshow .images').Chocolat({
      imageSize  : 'contain',
      fullScreen : false,
      loop       : true
    }).data('chocolat');

    slideshows.push(slideshow);
  }

  if($('.all-photos').length) {
    var slideshow = $('#gridPhotos').Chocolat({
      imageSize     : 'contain',
      fullScreen    : false,
      imageSelector : '.item:not(.isotope-hidden) .chocolat-image'
    }).data('chocolat');

    slideshows.push(slideshow);
  }
}

// close slideshow on click
$('body').on('click', '.chocolat-close', function(e) {
  $('.chocolat-img').css('transition', 'all 0.9s ease').addClass('close');
  $('.chocolat-bottom').css('opacity', 0);
  $('.chocolat-close').css('opacity', 0);

  setTimeout(function() {
    $('.chocolat-wrapper').removeClass('show');
    $('body').removeClass('fixed');

    if($('.slideshow').length) {
      if(window.location.hash) {
        var type = window.location.hash.substring(1).split('=')[0] || 'pid'
            pid  = window.location.hash.substring(1).split('=')[1] || 0;

        if($('[data-'+type+'='+pid+']').length > 0) {
          $('html, body').animate({
            scrollTop : $('[data-'+type+'='+pid+']').parents('.slideshow').offset().top - 300
          }, 0);
        }
      }
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
$('body').on('mouseover', '.chocolat-img', function() {
  $('.chocolat-pagination').removeClass('active');
  $('.chocolat-wrapper .thumbnails').removeClass('open');
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
$('body').on('click', '.chocolat-pagination', function() {
  $(this).toggleClass('active');
  $('.chocolat-wrapper .thumbnails').toggleClass('open');
  $('.chocolat-content').toggleClass('thumbsOpen');
});

$('body').on('click', '.chocolat-bottom .share', function() {
  $('.chocolat-bottom .buttons').toggleClass('show');
});

// zoom
$('body').on('click', '.chocolat-image', function() {
  var $that = $(this);

  $('.chocolat-wrapper .chocolat-bottom').append('<div class="thumbnails"></div>');
  $('.chocolat-left, .chocolat-right').appendTo('.chocolat-bottom');
  $('.chocolat-left').html('<i class="icon icon_flecheGauche"></i>');
  $('.chocolat-right').html('<i class="icon icon_fleche-right"></i>');

  if($('.press-media').length || $('.downloading-press').length ){
    if($('.lock').length){
      $('<a href="#" class="share cadenas"><i class="icon icon_cadenas"></i></a>').insertBefore('.chocolat-wrapper .chocolat-left');
    }else{
      $('<a href="#" class="share download"><i class="icon icon_telecharger"></i></a>').insertBefore('.chocolat-wrapper .chocolat-left');
    }
  }else{
    $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertBefore('.chocolat-wrapper .chocolat-left');
  }
  $('<div class="buttons square img-slideshow-share"><a href="//www.facebook.com/sharer.php?u=html.festival-cannes-2016.com.ohwee.fr&t=le%20titre" rel="nofollow" class="button facebook ajax"><i class="icon icon_facebook"></i></a><a href="//twitter.com/intent/tweet?text=Enrages%20Polar%20Hybride" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');
  $('<div class="zoomCursor"><i class="icon icon_loupePlus"></i></div>').appendTo('.chocolat-wrapper');
  $('<div class="credit">' + $that.data('credit') + '</div>').insertBefore('.chocolat-wrapper .share');

  linkPopinInit(0,'.img-slideshow-share .button.link');
  updatePhotoShare($that.data('pid'), $that.data('title'));
  initPopinMail();

  setTimeout(function() {
    $('.chocolat-wrapper').addClass('show');
  }, 200);

  setTimeout(function() {
    $('.chocolat-wrapper .chocolat-img').css('transition', 'all 900ms cubic-bezier(0.165, 0.435, 0.000, 0.935)');
    // change url hash
    window.location.hash = 'pid='+$that.data('pid');
    $('body').addClass('fixed');
  }, 2500);

  $(this).parents('.slideshow').find('.thumbnails .thumb').each(function() {
    $('.chocolat-wrapper .thumbnails').append($(this).clone());
  });

  if($(this).parents('#gridPhotos').length) {
    $('#gridPhotos .item').each(function() {
      if($(this).css('display') != 'none') {
        $('.chocolat-wrapper .thumbnails').append('<div data-pid="' + $(this).find('.chocolat-image').data('pid') + '" class="thumb"><img src="' + $(this).find('img').attr('src') + '" /></div>');
      }
    });
  }

  if ($('body').hasClass('mob')) {
    $('.chocolat-bottom').addClass('show');
  }

  thumbnails = $('.chocolat-wrapper .thumbnails').owlCarousel({
    nav             : false,
    dots            : false,
    smartSpeed      : 500,
    margin          : 0,
    autoWidth       : true,
    URLhashListener : false
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

  $('.chocolat-pagination').trigger('click');

  window.location.hash = 'pid='+$(this).data('pid');

  updatePhotoShare($(this).data('pid'), $(this).attr('title'));
});

$(document).ready(function() {
  initSlideshows();

  // if url contains a hash : load pic
  if(window.location.hash) {
    if($('.chocolat-image').length) {
      var type = window.location.hash.substring(1).split('=')[0] || 'pid'
          pid  = window.location.hash.substring(1).split('=')[1] || 0;
      if($('[data-'+type+'='+pid+']').length) {
        $('[data-'+type+'='+pid+']').trigger('click');
        $('.chocolat-wrapper .thumb').removeClass('active');
        $('.chocolat-wrapper .thumb[data-pid="' +  pid + '"]').addClass('active');

        updatePhotoShare(pid, $('[data-'+type+'='+pid+']').attr('title'));
      } else {
        history.pushState("", document.title, window.location.pathname);
      }
    }
  }
});

// update hash and active photo on nav click
$('body').on('click', '.chocolat-left', function(e){
  var type = window.location.hash.substring(1).split('=')[0] || 'pid'
      pid  = window.location.hash.substring(1).split('=')[1] || 0;

  if($('[data-'+type+'='+pid+']').parent().index() - 1 > 0) {
    window.location.hash = 'pid='+$('[data-'+type+'='+pid+']').parent().prev().find('a').data('pid');

    updatePhotoShare($('[data-'+type+'='+pid+']').parent().prev().find('a').data('pid'), $('[data-'+type+'='+pid+']').parent().prev().find('a').attr('title'));

    if(typeof thumbnails != 'undefined') {
      thumbnails.trigger('to.owl.carousel', [$('[data-'+type+'='+pid+']').parent().index() - 2, 400, true]);
    }

    $('.chocolat-wrapper .thumb').removeClass('active');
    $('.chocolat-wrapper .thumb[data-pid="' + $('[data-'+type+'='+pid+']').parent().prev().find('a').data('pid') + '"]').addClass('active');
  }
});

// update hash and active photo on nav click
$('body').on('click', '.chocolat-right', function(e) {
  var type = window.location.hash.substring(1).split('=')[0] || 'pid'
      pid  = window.location.hash.substring(1).split('=')[1] || 0;

  if($('[data-'+type+'='+pid+']').parent().index() + 1 < $('[data-'+type+']').length) {
    window.location.hash = 'pid='+$('[data-'+type+'='+pid+']').parent().next().find('a').data('pid');

    if(typeof thumbnails != 'undefined') {
      thumbnails.trigger('to.owl.carousel', [$('[data-'+type+'='+pid+']').parent().index() - 1, 400, true]);
    }

    $('.chocolat-wrapper .thumb').removeClass('active');
    $('.chocolat-wrapper .thumb[data-pid="' + $('[data-'+type+'='+pid+']').parent().next().find('a').data('pid') + '"]').addClass('active');
    
    updatePhotoShare($('[data-'+type+'='+pid+']').parent().next().find('a').data('pid'), $('[data-'+type+'='+pid+']').parent().next().find('a').attr('title'));
  }
});

// cursor close
$('body').on('mouseout', '.chocolat-content', function() {
  $('.zoomCursor').addClass('hide');
  return false;
});

$('body').on('mouseenter', '.chocolat-content', function() {
  $('.zoomCursor').removeClass('hide');
  return false;
});

var timeoutCursor;


$('body').on('mousemove', '.chocolat-content', function(e) {
  if($('body').hasClass('mob')) {
    return false;
  }

  if($('.chocolat-zoomed').length) {
    $('.zoomCursor .icon').removeClass('icon_loupePlus').addClass('icon_loupeMoins');
  } else {
    $('.zoomCursor .icon').removeClass('icon_loupeMoins').addClass('icon_loupePlus');
  }

  $('.zoomCursor').css('left', e.clientX + 10).css('top', e.clientY);
  $('.chocolat-bottom').addClass('show');

  clearTimeout(timeoutCursor);
  timeoutCursor = setTimeout(function() {
    $('.chocolat-bottom').removeClass('show');
    $('.chocolat-bottom .buttons').removeClass('show');
  }, 4000);
});


function updatePhotoShare(pid, title) {
  var pid      = pid || 0,
      title    = title || "",
      t0       = title.split('<h2>'),
      t1       = t0[1].split('</h2>'),
      shareUrl = GLOBALS.urls.photosUrl+'#pid='+pid;

  $('.chocolat-bottom .img-slideshow-share .button.facebook').off('click');
  $('.chocolat-bottom .img-slideshow-share .button.twitter').off('click');

  // CUSTOM LINK FACEBOOK
  var fbHref = "//www.facebook.com/sharer.php?u=CUSTOM_URL";
  fbHref     = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
  $('.chocolat-bottom .img-slideshow-share .facebook').attr('href', fbHref);
  // CUSTOM LINK TWITTER
  var twHref = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";
  twHref     = twHref.replace('CUSTOM_TEXT', encodeURIComponent(t1[0]+" "+shareUrl));
  $('.chocolat-bottom .img-slideshow-share .twitter').attr('href', twHref);
  // CUSTOM LINK COPY
  $('.chocolat-bottom .img-slideshow-share .button.link').attr('href', encodeURIComponent(shareUrl));
  $('.chocolat-bottom .img-slideshow-share .button.link').attr('data-clipboard-text', encodeURIComponent(shareUrl));

  $('.chocolat-bottom .img-slideshow-share .button.facebook').on('click',function(){
      $('.chocolat-bottom .buttons').removeClass('show');
      window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=700,height=500');
      return false;
  });
  $('.chocolat-bottom .img-slideshow-share .button.twitter').on('click', function(){
      $('.chocolat-bottom .buttons').removeClass('show');
      window.open(this.href,'','width=700,height=500');
      return false;
  });

  var parsed = $('<div/>').append(title);
  updatePopinMedia({
      'type'     : "photo",
      'category' : parsed.find('.category').text(),
      'date'     : parsed.find('.date').text(),
      'title'    : parsed.find('h2').text()
  }, encodeURIComponent(shareUrl));
  launchPopinMedia('photo', '.img-slideshow-share .button.email', '');
}
