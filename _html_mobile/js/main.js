var time = 7; // time in seconds
var $progressBar,
    $bar, 
    //$elem, 
    isPause, 
    tick,
    percentTime;

//Init the carousel
// $("#slider").owlCarousel({
//   slideSpeed : 500,
//   paginationSpeed : 500,
//   pagination: true,
//   nav: true,
//   dots: true,
//   singleItem : true,
//   afterInit : progressBar,
//   afterMove : moved,
//   startDragging : pauseOnDragging
// });

function progressBar() {
  // build progress bar elements
  buildProgressBar();

  //positionElements();
  // start counting
  start();

  $('#slider .owl-nav div').on('click', function() {
    clearTimeout(tick);
    $bar.css({
      width: '100%',
      transition: 'width .2s ease'
    });
    setTimeout(function() {
      $bar.css({
        float: 'right',
        width: 0
      });
    }, 200);
  });
}

function buildProgressBar() {
  $progressBar = $("<div>",{
    id:"progressBar"
  });
  $bar = $("<div>",{
    id:"bar"
  });
  $progressBar.append($bar).appendTo($("#slider"));
}

function start() {
  // reset timer
  percentTime = 0;
  isPause = false;
  // run interval every 0.01 second
  tick = setInterval(interval, 10);
}

function interval() {
  if(isPause === false) {
    percentTime += 1 / time;
    
    $bar.css({
      width: percentTime+"%"
    });
    
    // if percentTime is equal or greater than 100
    if(percentTime >= 100){
      // slide to next item 
      clearTimeout(tick);
      $bar.css({
        float: 'right',
        width: 0,
        transition: 'width .5s ease'
      });

      $("#slider").trigger("next.owl.carousel");
      percentTime = 0;
    }
  }
}

//pause while dragging 
function pauseOnDragging(){
  isPause = true;
}
//play while dragging 
function playAfterDragging(){
  isPause = false;
}

// moved callback
function moved() {
  // clear interval
  clearTimeout(tick);
  //deltaTooBig = false;
  // start again
  start();

  $('#slider .img-container').removeClass('relative');
  $bar.css({
    float: 'none',
    width: 0,
    transition: 'none'
  });
}

function setActiveVideos() {
  $('#slider-videos .owl-item').removeClass('center');
  $('#slider-videos .owl-item.active').first().addClass('center');
  if($('#slider-videos .owl-item.center').index() >= $('#slider-videos .owl-item').length - 1) {
      $('#slider-videos .owl-item').last().addClass('center');
  }
}

function setActiveChannels() {
  $('#slider-channels .owl-item').removeClass('center');
  $('#slider-channels .owl-item.active').first().addClass('center');
  if($('#slider-channels .owl-item.center').index() >= $('#slider-channels .owl-item').length - 4) {
    $('#slider-channels .owl-item').last().addClass('center');
  }
}

function setActiveMoreItems() {
  $('#slider-more .owl-item').removeClass('center');
  $('#slider-more .owl-item.active').first().addClass('center');
  if($('#slider-more .owl-item.center').index() >= $('#slider-more .owl-item').length - 4) {
    $('#slider-more .owl-item').last().addClass('center');
  }
}

function setActiveThumbnail() {
  $('.thumbnails .owl-item').removeClass('center');
  $('.thumbnails .owl-item.active').first().addClass('center');
  if($('.thumbnails .owl-item.center').index() >= $('.thumbnails .owl-item').length - 4) {
    $('.thumbnails .owl-item').last().addClass('center');
  }
}

$(document).ready(function() {
  $("#slider").owlCarousel({
    items         : 1,
    loop          : true,
    nav           : false,
    dots          : true,
    onInitialized : progressBar,
    onTranslated  : moved,
    mouseDrag     : true,
    onDrag        : pauseOnDragging,
    onDragged     : playAfterDragging,
    navSpeed      : 800,
    dotsSpeed     : 800,
    smartSpeed    : 800,
  });
 
  //uncomment this to make pause on mouseover 
  // $elem.on('mouseover',function(){
  //   isPause = true;
  // })
  // $elem.on('mouseout',function(){
  //   isPause = false;
  // })

  if($('.home').length || $('.webtv').length) {
    // Slider Videos
    // =========================
    var sliderVideos = $("#slider-videos").owlCarousel({
      nav        : false,
      dots       : false,
      smartSpeed : 1300,
      margin     : 20,
      autoWidth  : true,
      loop       : false,
      items      : 1,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-videos .owl-stage').css({ 'margin-left': m });
        setActiveVideos();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-videos .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveVideos();
      }
    });
    sliderVideos.owlCarousel();

    $('body').on('click', '#slider-videos .owl-item', function() {
      sliderVideos.trigger('to.owl.carousel', [$(this).index(), 500, true]);
    });

    // Slider Channels
    // =========================
    var sliderChannels = $("#slider-channels").owlCarousel({ 
      nav          : false,
      dots         : false,
      smartSpeed   : 500,
      fluidSpeed   : 500,
      loop         : false,
      margin       : 50,
      autoWidth    : true,
      dragEndSpeed : 600,
      items        : 2,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-channels .owl-stage').css({ 'margin-left': m });
        setActiveChannels();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-channels .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveChannels();
      }
    });
    sliderChannels.owlCarousel();

    $('body').on('click', '#slider-channels .owl-item', function() {
      sliderChannels.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });
  }
  
  if($('.home').length) {
    // Slider More
    // =========================
    var sliderMore = $("#slider-more").owlCarousel({ 
      nav          : false,
      dots         : false,
      smartSpeed   : 500,
      fluidSpeed   : 500,
      loop         : false,
      center       : true,
      margin       : 0,
      autoWidth    : true,
      dragEndSpeed : 600,
      items        : 1,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-more .owl-stage').css({ 'margin-left': m });
        setActiveMoreItems();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-more .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveMoreItems();
      }
    });
    sliderMore.owlCarousel();

    $('body').on('click', '#slider-more .owl-item', function() {
      setActiveMoreItems.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });
  }

  if($('.home').length || $('.ba').length) {
    // Slider More
    // =========================
    var sliderThumb = $(".thumbnails").owlCarousel({ 
      nav          : false,
      dots         : false,
      smartSpeed   : 500,
      fluidSpeed   : 500,
      loop         : false,
      margin       : 20,
      autoWidth    : true,
      dragEndSpeed : 600,
      items        : 3,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('.thumbnails .owl-stage').css({ 'margin-left': m });
        setActiveThumbnail();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('.thumbnails .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveThumbnail();
      }
    });
    sliderThumb.owlCarousel();
    
    $('.thumbnails .owl-item').on('click', function(e) {
      e.preventDefault();

      var cap = $(this).find('.thumb').data('caption'),
          i   = $(this).index();

      $(this).parents('.slideshow').find('.thumb').removeClass('active');
      $(this).parents('.slideshow').find('.images .img').removeClass('active');
      $(this).find('.thumb').addClass('active');
      $(this).parents('.slideshow').find('.title').html(cap);
      $(this).parents('.slideshow').find('.caption').html(cap);
      $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
    });
  }
});