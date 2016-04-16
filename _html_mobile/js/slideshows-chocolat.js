$(document).ready(function() {
  $.removeSlideshow = function() {
    if($('.chocolat-wrapper').length) {
      var slideshow;

      // close slideshow on click
      $('body').off('click', '.close-button');
      $('body').off('click', '.share');
      $('body').off('click', '.open-thumbnails');
      $('body').off('click', '.chocolat-image');
      $('body').off('click', '.chocolat-wrapper .thumb');

      var myElement = document.getElementById('chocolat-content-1');
      var hammertime = new Hammer(myElement);
      
      hammertime.off('swipeleft');
      hammertime.off('swiperight');
      hammertime.off('press');
      hammertime.off('panend');
      hammertime.off('panmove');

      if($('.slideshow').length) {
        slideshow = $('.slideshow .images').Chocolat({
          imageSize: 'cover',
          fullScreen: false,
          loop: true
        }).data('chocolat').api().destroy();
      }

      if($('.all-photos').length) {
        slideshow = $('.list').Chocolat({
          imageSize: 'cover',
          fullScreen: false,
          loop:true
        }).data('chocolat').api().destroy();
      }

      if($('.press_medias').length) {
        slideshow = $('.active .list').Chocolat({
          imageSize: 'cover',
          fullScreen: false,
          loop:true
        }).data('chocolat').api().destroy();
      }

      $('.chocolat-wrapper').remove();
    }
  };

  $.initSlideshow = function() {
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

    if($('.press_medias').length) {
      slideshow = $('.active .list').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        loop:true
      }).data('chocolat');
      slideshows.push(slideshow);
    }

    if($('.press-downloads').length) {
      slideshow = $('.photos_container .list').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        loop:true
      }).data('chocolat');
      slideshows.push(slideshow);
    }

    // close slideshow on click
    $('body').off('click', '.close-button');
    $('body').on('click', '.close-button', function(e) {
      document.body.removeEventListener('touchmove', listener,false);

      $('body').removeClass('allow-landscape chocolat-open chocolat-cover');
      $('#choco-container').removeClass('show');

      setTimeout(function() {
        $('.chocolat-wrapper').removeClass('show');
      }, 900);
    });
    
    $('body').off('click', '.share');
    $('body').on('click', '.share', function(e) {
      e.preventDefault();
      $('div.chocolat-wrapper .thumbnails').removeClass('show');
      setTimeout(function() {
        $('.buttons.square').toggleClass('show');
      }, 200);
    });

    $('body').off('click', '.open-thumbnails');
    $('body').on('click', '.open-thumbnails', function(e) {
      e.preventDefault();
      $('.buttons.square').removeClass('show');
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
      document.body.addEventListener('touchmove', listener,false);
      
      var $that = $(this);
      $('body').addClass('allow-landscape');
      $('#choco-container').addClass('show');

      //if first click add elements
      if(!$(".chocolat-top .close-button").length) {
        $('.chocolat-top').html('<div class="close-button"><i class="icon icon_close"></i></div>');
        if ($('.press_medias').length || $('.press-downloads').length) {
           $('<a href="'+$(this).attr('href')+'" class="download"><i class="icon icon_telecharger"></i></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
        } else {
           $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
           $('<div class="buttons square"><a href="#" class="button facebook"><i class="icon icon_facebook"></i></a><a href="#" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');
        }

        $('<a href="#" class="open-thumbnails"></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
        $('<div class="thumbnails"></div>').insertAfter('.chocolat-wrapper .chocolat-pagination');

        if($('.all-photos').length) {
          $('.list').find('.grid-item').each(function() {
            $('.chocolat-wrapper .thumbnails').append('<div class="thumb"><img src="'+ $(this).find('.chocolat-image').attr('href')+'" /></div>');
          });
        } else if ($('.press_medias').length) {
          $('.active .list').find('.item').each(function() {
            $('.chocolat-wrapper .thumbnails').append('<div class="thumb"><img src="'+ $(this).find('.chocolat-image').attr('href')+'" /></div>');
          });
        } else if ($('.press_downloads').length) {
          $('.photos_container .list').find('.item').each(function() {
            $('.chocolat-wrapper .thumbnails').append('<div class="thumb"><img src="'+ $(this).find('.chocolat-image').attr('href')+'" /></div>');
          });
        } else {
          $('.slideshow').find('.thumbnails .thumb').each(function() {
            $('.chocolat-wrapper .thumbnails').append($(this).clone());
          });
        }
      }

      if ($('body').hasClass('mob')) {
        $('.chocolat-bottom').addClass('show');
      }

      var thumbCarousel = $('.chocolat-wrapper .thumbnails').owlCarousel({
        nav        : false,
        dots       : false,
        smartSpeed : 500,
        margin     : 0,
        items      : 4
      });
      thumbCarousel.owlCarousel();

      // on click on thumb from the list : change pic and update hash
      $('body').on('click', '.chocolat-wrapper .thumb', function(e) {
        e.preventDefault();

        var j = $(this).parent().index();

        $('.chocolat-wrapper .thumb').removeClass('active');
        $(this).addClass('active');

        slideshow.api().goto(j);
        if ($('.press_medias').length) {
          setTimeout(function(){
            $('.download').attr('href', $('.chocolat-img').attr('src'));
          },1000);
        }

        history.pushState(null,null, '#'+$(this).data('id'));
        //window.location.hash = $(this).data('id');
      });

      window.location.hash = $that.attr('id');

      setTimeout(function() {
        $('.chocolat-bottom').addClass('show');
        $('.chocolat-wrapper').addClass('show');
        $('.chocolat-wrapper .thumb').removeClass('active');
        $('.chocolat-wrapper .owl-item').eq(slideshow.api().current()).find('.thumb').addClass('active');
        thumbCarousel.owlCarousel().trigger('to.owl.carousel',[slideshow.api().current(),400,true]);
      }, 200);

      // ADD SWIPE TO NAVIGATE THROUGH PHOTOS
      var myElement  = $('.chocolat-wrapper')[0];
      var hammertime = new Hammer(myElement);

      hammertime.on('swipeleft', function(ev) {
        var bottomHeight = $(".chocolat-bottom").height();
        if($('.chocolat-wrapper .thumbnails').hasClass('show')) {
          bottomHeight+= $('.chocolat-wrapper .thumbnails').height();
        }

        if(ev.center.y< $(window).height()-bottomHeight) {
          slideshow.api().next();
          if ($('.press_medias').length) {
            setTimeout(function() {
              $('.download').attr('href', $('.chocolat-img').attr('src'));
            },1000);
          }

          var j = $('.chocolat-wrapper .thumb.active').parent().index();
          $('.chocolat-wrapper .thumb').removeClass('active');
          
          if (j+1<$('.chocolat-wrapper .owl-item').length) {
            $('.chocolat-wrapper .owl-item').eq(j+1).find('.thumb').addClass('active');
            thumbCarousel.owlCarousel().trigger('next.owl.carousel');
          } else {
            $('.chocolat-wrapper .owl-item').eq(0).find('.thumb').addClass('active');
            thumbCarousel.owlCarousel().trigger('to.owl.carousel', [0,400, true]);
          }
        }
      });

      hammertime.on('swiperight', function(ev) {
        var bottomHeight = $(".chocolat-bottom").height();
        if($('.chocolat-wrapper .thumbnails').hasClass('show')) {
          bottomHeight+= $('.chocolat-wrapper .thumbnails').height();
        }

        if(ev.center.y< $(window).height()-bottomHeight) {
          slideshow.api().prev();
          if ($('.press_medias').length) {
            setTimeout(function() {
              $('.download').attr('href', $('.chocolat-img').attr('src'));
            },1000);
          }

          var j = $('.chocolat-wrapper .thumb.active').parent().index();
          $('.chocolat-wrapper .thumb').removeClass('active');
          
          if (j-1>=0) {
            $('.chocolat-wrapper .owl-item').eq(j-1).find('.thumb').addClass('active');
            thumbCarousel.owlCarousel().trigger('prev.owl.carousel');
          } else {
            $('.chocolat-wrapper .owl-item').eq($('.chocolat-wrapper .owl-item').length-1).find('.thumb').addClass('active');
            thumbCarousel.owlCarousel().trigger('to.owl.carousel', [$('.chocolat-wrapper .owl-item').length-1,400,true]);
          }
        }
      });

      var x0        = 0,
          y0        = 0,
          newPan    = false,
          x_start   = $('.chocolat-content').position().left, y_start = $('.chocolat-content').position().top,
          width_img = $('.chocolat-content').width(), height_img = $('.chocolat-content').height();
      
      //console.log(width_img,height_img);
      hammertime.get('press').set({
        time: 50
      });

      hammertime.on('press', function(ev) {
        newPan     = true;
        x0         = ev.center.x;
        y0         = ev.center.y;
        x_start    = $('.chocolat-content').position().left;
        y_start    = $('.chocolat-content').position().top;
        width_img  = $('.chocolat-content').width();
        height_img = $('.chocolat-content').height();
        // console.log("press");
      });

      hammertime.on('panmove', function(ev) {
        if (newPan) {
          var x = x_start + ev.center.x - x0;
          var y = y_start + ev.center.y - y0;
          
          if (x > 0) {
            x = 0;
          } else if(x < $(window).width()-width_img) {
            x = $(window).width()-width_img;
          }

          if (y > 0) {
            y = 0;
          } else if(y < $(window).height()-height_img) {
            y = $(window).height()-height_img;
          }

          $('.chocolat-content').css({ top: y, left: x });
        }
      });

      hammertime.on('panend', function(ev) {
        newPan = false;
        //.offset({ top: 10, left: 30 });
        slideshow.api().place();
      });
    });
  }
  $.initSlideshow();
});