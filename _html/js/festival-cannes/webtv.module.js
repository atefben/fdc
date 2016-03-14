var videoWebtv,
    videoPopin;

$(document).ready(function() {

// Webtv
// =========================

  if($('.webtv').length) {
    if($('.webtv-live').length) {
      if($('#video-webtv-live').length) {
        videoWebtv = playerInit('video-webtv-live', false, false, true);
        videoWebtv.resize('100%','100%');
      }
      // play live player on click
      $('#live .play-live').on('click', function(e) {
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

        setTimeout(function() {
          videoWebtv.resize('100%','100%');
          if(videoWebtv.getState() == "paused" || videoWebtv.getState() == "idle") {
            videoWebtv.play();
          }
          $('#live .trailer').addClass('on');
        }, 500);
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

      if($('#content-latest').length) {
        videoPopin = playerInit('video-player-popin', false, false);
        // linkPopinInit(0'.popin-video .popin-buttons.buttons .link');

        $('.ov').on('click', function (e) {
          e.preventDefault();
          $('.popin-video, .ov').removeClass('show');

          if(videoPopin.getState() != "paused" && videoPopin.getState() != "idle") {
            videoPopin.pause();
          }
        });

        $('#content-latest').on('click', '.video', function(e) {
          var $popinVideo = $('.popin-video'),
              vid         = $(e.target).closest('.video').data('vid'),
              source      = $(e.target).closest('.video').data('file'),
              img         = $(e.target).closest('.video').data('img'),
              category    = $(e.target).closest('.video').find('.category').text(),
              date        = $(e.target).closest('.video').find('.date').text(),
              hour        = $(e.target).closest('.video').find('.hour').text(),
              text        = $(e.target).closest('.video').find('p').data('title');

          if (typeof videoPopin.getConfig().file === "undefined" || videoPopin.getConfig().file === "") {
            videoPopin.remove();
            $(videoPopin).data('loaded',false);
            $('#video-player-popin').closest('.video-container').data('file',source);
            $('#video-player-popin').closest('.video-container').data('img',img);

            videoPopin = playerInit('video-player-popin', false, false);
            videoPopin.play();
          } else {
            videoPopin.load([{
              sources: source,
              image: img
            }]);
            videoPopin.play();
          }

          // CUSTOM LINK FACEBOOK
          var shareUrl = GLOBALS.urls.videosUrl+'#vid='+vid;
          var fbHref   = facebookLink;
          fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .facebook').attr('href', fbHref);
          // CUSTOM LINK TWITTER
          var twHref   = twitterLink;
          twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent(text+" "+shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .twitter').attr('href', twHref);
          // CUSTOM LINK COPY
          $('#video-player-popin + .top-bar').find('.buttons .link').attr('href', encodeURIComponent(shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .link').attr('data-clipboard-text', encodeURIComponent(shareUrl));

          $('.popin-video').find('.popin-buttons.buttons .facebook').attr('data-href', fbHref);
          $('.popin-video').find('.popin-buttons.buttons .facebook').attr('href', fbHref);
          $('.popin-video').find('.popin-buttons.buttons .twitter').attr('href', twHref);
          $('.popin-video').find('.popin-buttons.buttons .link').attr('href', encodeURIComponent(shareUrl));
          $('.popin-video').find('.popin-buttons.buttons .link').attr('data-clipboard-text', encodeURIComponent(shareUrl));

          updatePopinMedia({
            'type'     : "video",
            'category' : category,
            'date'     : date,
            'title'    : text
          }, encodeURIComponent(shareUrl));

          $popinVideo.find('.popin-info .category').text(category);
          $popinVideo.find('.popin-info .date').text(date);
          $popinVideo.find('.popin-info .hour').text(hour);
          $popinVideo.find('.popin-info p').text(text);
          $popinVideo.addClass('video-player show loading');
          $('.ov').addClass('show');
        });
      }
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
      },
    });

    $('#slider-trailer .owl-item ').on('click', function(e){
        var $this = $(this);
        $('.center').removeClass('center');
        $this.addClass('center');
    });


    sliderTrailer.owlCarousel();
    // $('body').on('click', '#slider-trailer .owl-item', function(e) {
    //   k.log('', 'click slider 3');
    //   sliderTrailer.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    // });

    if($('.webtv-ba-video').length){
      $('.nav li').click(function(){
        if($(this).hasClass('active')){

        } else {
          $('.nav').find('.active').removeClass('active');
          $(this).addClass('active');

          if($(this).hasClass('infos-film-li')){
            $('.program-film').css({display:'none'});
            $('.infos-film').css({display:'block'});
          } else {
            $('.program-film').css({display:"block"});
            $('.infos-film').css({display:"none"});
          }
        }
      });
    }

    //ajax
    $('.webtv .sub-nav-list a').on('click',function(e) {
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');
        // $.get($(this).data('url'), function(data){
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

  if($('.webtv-ba').length) {
    // Scroll
    $(window).on('scroll', function() {
      var s = $(window).scrollTop();
      var h = $("#main").height()-900;

      if(s > 270 ) {
        $('.sub-nav-list').addClass('sticky');
        $(".sub-nav-list").css({position: "fixed",top:90,zIndex:4});
      } else if (s < 270){
        $(".sub-nav-list").css({position: "relative",top:0});
      }
    });
  }

  if($('.single-channel').length) {
    if($('#content-latest').length) {
        videoPopin = playerInit('video-player-popin', false, false);
        linkPopinInit(0, '.popin-video .popin-buttons.buttons .link');
        launchPopinMedia('video', '.popin-video .popin-buttons.buttons .email', videoPopin);


        $('.ov').on('click', function (e) {
          e.preventDefault();
          $('.popin-video, .ov').removeClass('show');

          if(videoPopin.getState() != "paused" && videoPopin.getState() != "idle") {
            videoPopin.pause();
          }
        });

        $('#content-latest').on('click', '.video', function(e) {
          var $popinVideo = $('.popin-video'),
              vid         = $(e.target).closest('.video').data('vid'),
              source      = $(e.target).closest('.video').data('file'),
              img         = $(e.target).closest('.video').data('img'),
              category    = $(e.target).closest('.video').find('.category').text(),
              date        = $(e.target).closest('.video').find('.date').text(),
              hour        = $(e.target).closest('.video').find('.hour').text(),
              text        = $(e.target).closest('.video').find('p').data('title');

          if (typeof videoPopin.getConfig().file === "undefined" || videoPopin.getConfig().file === "") {
            videoPopin.remove();
            $(videoPopin).data('loaded',false);
            $('#video-player-popin').closest('.video-container').data('file',source);
            $('#video-player-popin').closest('.video-container').data('img',img);

            videoPopin = playerInit('video-player-popin', false, false);
            videoPopin.play();
          } else {
            videoPopin.load([{
              sources: source,
              image: img
            }]);
            videoPopin.play();
          }

          // CUSTOM LINK FACEBOOK
          var shareUrl = GLOBALS.urls.videosUrl+'#vid='+vid;
          var fbHref   = facebookLink;
          fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .facebook').attr('href', fbHref);
          // CUSTOM LINK TWITTER
          var twHref   = twitterLink;
          twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent(text+" "+shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .twitter').attr('href', twHref);
          // CUSTOM LINK COPY
          $('#video-player-popin + .top-bar').find('.buttons .link').attr('href', encodeURIComponent(shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .link').attr('data-clipboard-text', encodeURIComponent(shareUrl));

          $('.popin-video').find('.popin-buttons.buttons .facebook').attr('data-href', fbHref);
          $('.popin-video').find('.popin-buttons.buttons .facebook').attr('href', fbHref);
          $('.popin-video').find('.popin-buttons.buttons .twitter').attr('href', twHref);
          $('.popin-video').find('.popin-buttons.buttons .link').attr('href', encodeURIComponent(shareUrl));
          $('.popin-video').find('.popin-buttons.buttons .link').attr('data-clipboard-text', encodeURIComponent(shareUrl));

          updatePopinMedia({
            'type'     : "video",
            'category' : category,
            'date'     : date,
            'title'    : text
          }, encodeURIComponent(shareUrl));

          $popinVideo.find('.popin-info .category').text(category);
          $popinVideo.find('.popin-info .date').text(date);
          $popinVideo.find('.popin-info .hour').text(hour);
          $popinVideo.find('.popin-info p').text(text);
          $popinVideo.addClass('video-player show loading');
          $('.ov').addClass('show');
        });
      }
  }
});
