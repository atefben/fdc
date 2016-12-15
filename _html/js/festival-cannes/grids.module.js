// All Photos
// =========================
var itemReveal = Isotope.Item.prototype.reveal;
Isotope.Item.prototype.reveal = function () {
  itemReveal.apply(this, arguments);
  $(this.element).removeClass('isotope-hidden');
};

var itemHide = Isotope.Item.prototype.hide;
Isotope.Item.prototype.hide = function () {
  itemHide.apply(this, arguments);
  $(this.element).addClass('isotope-hidden');
};



function resizeGrid() {

  if ("matchMedia" in window) {
    if($('#gridAudios').length) {
      setGrid(false, $('#gridAudios'), true);
    }
    if($('#gridVideos').length) {
      setGrid(false, $('#gridVideos'), true);
    }
    if($('#gridPhotos').length) {
      setImages(false, $('#gridPhotos'), true);
    }
    if($('#gridFilmSelection').length) {
      var w = $('#gridFilmSelection .image').first().width();
      $('#gridFilmSelection .image').each(function() {
        $(this).css('height', (w / 0.75));
        var $container = $(this), imgUrl = $container.find('img').prop('src');
        if (imgUrl) {
          $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
        }
      });
    }
    if($('#gridJurys').length) {
      var w = $('#gridJurys .image').first().width();
      $('#gridJurys .image').each(function() {
        $(this).css('height', (w / 0.75));
        var $container = $(this), imgUrl = $container.find('img').prop('src');
        if (imgUrl) {
          $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
        }
      });
    }
  }
}

function setGrid(grid, dom, init){
  $("img.lazy").lazyload({
    load : function()
    {
      $(this).parent().removeClass('notloaded');
    }
  });
  var $img            = $(dom).find('.item img'),
      pourcentage     = 0.30,
      nbImgAAgrandir  = $img.length * pourcentage,
      i               = 0,
      nbRamdom        = [],
      x               = 1,
      j               = 0,
      max             = 0,
      min             = 0,
      nbImage         = $img.length;

  function buildGrid() {

    $($img).closest('div.item').removeClass('w2');

    if (window.matchMedia("(max-width: 1279px)").matches) {

      while (i < $img.length) {
        if (j < 15) {
          if (j == 0 || j == 5 || j == 11) {
            $($img[i]).closest('div.item').addClass('w2');
          }
          j++;
        }
        if (j == 14) {
          j = 0;
        }
        i++;
      }




      if($('#gridWebtv').length > 0 ){

        $.each($('.item'), function (i, e) {

          var title = $(e).find('.info .category + span');

          if (!title.hasClass('init')) {
            var text = $(e).find('.info .category + span').text();
            title.addClass('init');
            title.attr('data-title', text);
          } else {
            var text = title.attr('data-title');
          }

            title.html(text.trunc(20, true));

        });
      }

      
      $(dom).find('div.item:not(.w2)').each(function() {


        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(20,true));

        }

      });

      $(dom).find('div.item.w2').each(function() {


        if(typeof $(this).find('.info p').data('title') != 'undefined') {


          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(50,true));
        }
      });

      if($('#gridPhotos').length > 0) {



        $('#gridPhotos div.item:not(.w2)').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(20,true));
          }
        });

        $('#gridPhotos div.item.w2').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(50,true));
          }
        });

      }
    } else if (window.matchMedia("(max-width: 1599px)").matches) {



      while (i < $img.length) {
        if (j < 10) {
          if (j == 0 || j == 3) {
            $($img[i]).closest('div.item').addClass('w2');
          }
          j++;
        }
        if (j == 9) {
          j = 0;
        }
        i++;
      }

      $(dom).find('div.item:not(.w2)').each(function() {
        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(30,true));
        }
      });

      $(dom).find('div.item.w2').each(function() {
        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(60,true));
        }
      });

      if($('#gridPhotos').length > 0) {

        $('#gridPhotos div.item:not(.w2)').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(30,true));
          }
        });

        $('#gridPhotos div.item.w2').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(60,true));
          }
        });

      }


      if($('#gridWebtv').length > 0 ){


        $.each($('.item'), function (i, e) {

          var title = $(e).find('.info .category + span');

          if (!title.hasClass('init')) {
            var text = $(e).find('.info .category + span').text();
            title.addClass('init');
            title.attr('data-title', text);
          } else {
            var text = title.attr('data-title');
          }

          title.html(text.trunc(40, true));

        });
      }

    } else if (window.matchMedia("(max-width: 1919px)").matches) {



      while (i < $img.length) {
        if (j < 30) {
          if (j == 0 || j == 3 || j == 12 || j == 17 || j == 25) {
            $($img[i]).closest('div.item').addClass('w2');
          }
          j++;
        }
        if (j == 29) {
          j = 0;
        }
        i++;
      }

      $(dom).find('div.item:not(.w2)').each(function() {
        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(35,true));
        }
      });

      $(dom).find('div.item.w2').each(function() {
        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(65,true));
        }
      });

      if($('#gridPhotos').length > 0) {

        $('#gridPhotos div.item:not(.w2)').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(35,true));
          }
        });

        $('#gridPhotos div.item.w2').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(65,true));
          }
        });
      }
    } else if (window.matchMedia("(min-width: 1920px)").matches) {


      while (i < $img.length) {
        if (j < 15) {
          if (j == 0 || j == 5 || j == 14) {
            $($img[i]).closest('div.item').addClass('w2');
          }
          j++;
        }
        if (j == 14) {
          j = 0;
        }
        i++;
      }

      $(dom).find('div.item:not(.w2)').each(function() {
        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(35,true));
        }
      });

      $(dom).find('div.item.w2').each(function() {
        if(typeof $(this).find('.info p').data('title') != 'undefined') {
          $(this).find('.info p').text($(this).find('.info p').data('title').trunc(80,true));
        }
      });

      if($('#gridPhotos').length > 0) {


        $('#gridPhotos div.item:not(.w2)').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(35,true));
          }
        });

        $('#gridPhotos div.item.w2').each(function() {
          if(typeof $(this).find('.info .category').data('category') != 'undefined') {
            $(this).find('.info .category').text($(this).find('.info category').data('category').trunc(80,true));
          }
        });
      }
    }
  }

  $('.item').addClass('visible');

  if (!init) {
    if ($('#gridEvent').length) {
      $data = $(dom).find('.item');
    } else {
      $data = $(dom);
    }

    grid.append($data).isotope('appended', $data);
    grid.imagesLoaded().progress(function () {
      grid.isotope('layout');
    });
  }

  buildGrid();

}

function setImages(grid, dom, init) {
  $("img.lazy").lazyload({
    load : function()
    {
      $(this).parent().removeClass('notloaded');
    }
  });

  var $img            = $(dom).find('.item:not(.portrait) img'),
      pourcentage     = 0.50,
      nbImgAAgrandir  = $img.length * pourcentage,
      i               = 0,
      nbRamdom        = [],
      x               = 1,
      max             = 0,
      min             = 0,
      nbImage         = $img.length;

  $('.item').addClass('visible');

  while(x < nbImgAAgrandir) {
    while(nbImgAAgrandir > nbRamdom.length) {
      max = nbImage * pourcentage * x;
      min = nbImage * pourcentage * (x - 1);
      nbAlea = Math.floor(Math.random() * (max - min) + min);
      nbRamdom[i] = nbAlea;
      $($img[nbRamdom[i]]).closest('div.item').addClass('w2');
      i++;
      x++;
    }
  }

  $(dom).find('div.item:not(.w2)').each(function() {
    if(typeof $(this).find('.info p').data('title') != 'undefined') {
      $(this).find('.info p').text($(this).find('.info p').data('title').trunc(30,true));
    }
  });
  $(dom).find('div.item.w2').each(function() {
    if(typeof $(this).find('.info p').data('title') != 'undefined') {
      $(this).find('.info p').text($(this).find('.info p').data('title').trunc(60,true));
    }
  });
}

$(document).ready(function () {
  function closePopinAudio() {
    $('.popin-audio, .ov').removeClass('show');

    if(audioPopin.getState() != "paused" && audioPopin.getState() != "idle") {
      audioPopin.pause();
    }
  }

  function closePopinVideo() {
    $('.popin-video, .ov').removeClass('show');

    if(videoPopin.getState() != "paused" && videoPopin.getState() != "idle") {
      videoPopin.pause();
    }
  }

  if($('.grid').length) {
    if($('#gridPhotos').length) {
      var $container = $('#gridPhotos'),
          $grid;

      $grid = $('#gridPhotos').imagesLoaded(function() {
        setImages($grid, $('#gridPhotos'), true);
        $grid.isotope({
          itemSelector    : '.item',
          percentPosition : true,
          // sortBy          : 'original-order',
          layoutMode      : 'packery',
          packery         : {
            columnWidth : '.grid-sizer'
          }
        });

        window.setTimeout(function() {
          $grid.isotope('layout');
        }, 1000);
        var timer;
        $(window).scroll(function() {
          if(timer) {
            window.clearTimeout(timer);
          }
          timer = window.setTimeout(function() {
            $grid.isotope('layout');
          }, 100);
        });
      });

    }

    if($('#gridChannels').length) {
      var $grid = $('#gridChannels').imagesLoaded(function() {
        setGrid($grid, $('#gridChannels'), true);

        $grid.isotope({
          itemSelector: '.item',
          percentPosition: true,
          layoutMode: 'packery',
          packery: {
            columnWidth: '.grid-sizer'
          }
        });

        $grid.isotope('layout');
        window.setTimeout(function() {
          $grid.isotope('layout');
        }, 1000);
        var timer;
        $(window).scroll(function() {
          if(timer) {
            window.clearTimeout(timer);
          }
          timer = window.setTimeout(function() {
            $grid.isotope('layout');
          }, 100);
        });

      });
    }

    if($('#gridWebtv').length) {
      var $grid = $('#gridWebtv').imagesLoaded(function () {
        $grid.isotope({
          layoutMode: 'packery',
          itemSelector: '.item'
        });
      });
    }

    if($('#gridJurys').length) {
      var $grid = $('#gridJurys').imagesLoaded(function () {
        $grid.isotope({
          layoutMode: 'packery',
          itemSelector: '.item'
        });
      });
    }

    if($('#gridFilmSelection').length) {
      var $grid = $('#gridFilmSelection').imagesLoaded(function () {
        $grid.isotope({
          layoutMode: 'packery',
          itemSelector: '.item'
        });
      });
      resizeGrid();
    }

    if($('#gridAudios').length) {
      if($('#audio-player-popin').length > 0 && window.location.hash) {
        setTimeout(function() {
          var type = window.location.hash.substring(1).split('=')[0]
              aid  = window.location.hash.substring(1).split('=')[1];
          if(type === "aid" && $(".item[data-aid="+aid+"]").length) {
              $(".item[data-aid="+aid+"]").trigger('click');
          }
        },1000);
      }

      $('.ov').on('click', function (e) {
        e.preventDefault();
        closePopinAudio();
      });

      var $container = $('#gridAudios'),
          $grid,
          audioPopin;

      if($('#audio-player-popin').length > 0) {
        audioPopin = audioInit('audio-player-popin', false, 'grid');
        linkPopinInit(0, '.popin-audio .buttons .link');
        $('.popin-audio .buttons .email').on('click', function(e) {
          e.preventDefault();
          launchPopinMedia({}, audioPopin);
        });
      }

      $grid = $('#gridAudios').imagesLoaded(function() {
        setGrid($grid, $('#gridAudios'), true);
        $grid.isotope({
          itemSelector: '.item',
          percentPosition: true,
          layoutMode: 'packery',
          packery: {
            columnWidth: '.grid-sizer'
          }
        });

        $grid.isotope('layout');
        window.setTimeout(function() {
          $grid.isotope('layout');
        }, 1000);
        var timer;
        $(window).scroll(function() {
          if(timer) {
            window.clearTimeout(timer);
          }
          timer = window.setTimeout(function() {
            $grid.isotope('layout');
          }, 100);
        });

        if($('#audio-player-popin').length > 0) {
          $('body').on('click', '#gridAudios .item', function(e) {
            var $popinAudio = $('.popin-audio'),
                aid         = $(e.target).data('aid'),
                source      = $(e.target).data('sound'),
                img         = $(e.target).find('img').attr('src'),
                category    = $(e.target).find('.category').text(),
                date        = $(e.target).find('.date').text(),
                hour        = $(e.target).find('.hour').text(),
                name        = $(e.target).find('p').data('title');

            audioPopin.playlistItem($(this).index()-1);

            var newURL = window.location.href.split('#')[0] + '#aid=' + aid;
            history.replaceState('', document.title, newURL);

            // CUSTOM LINK FACEBOOK
            var shareUrl = GLOBALS.urls.audiosUrl+'#aid='+aid;
            var fbHref   = facebookLink;
            fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
            fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent(img));
            fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent(category));
            fbHref       = fbHref.replace('CUSTOM_DESC', encodeURIComponent(name));
            // CUSTOM LINK TWITTER
            var twHref   = twitterLink;
            twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent(name+" "+shareUrl));

            $('.popin-audio').find('.buttons .facebook').attr('data-href', fbHref);
            $('.popin-audio').find('.buttons .facebook').attr('href', fbHref);
            $('.popin-audio').find('.buttons .twitter').attr('href', twHref);
            $('.popin-audio').find('.buttons .link').attr('href', shareUrl);
            $('.popin-audio').find('.buttons .link').attr('data-clipboard-text', shareUrl);

            updatePopinMedia({
              'type'     : "audio",
              'category' : category,
              'date'     : date,
              'title'    : name,
              'url'      : shareUrl
            });

            $popinAudio.find('.info .category').text(category);
            $popinAudio.find('.info .date').text(date);
            $popinAudio.find('.info .hour').text(hour);
            $popinAudio.find('.info p').text(name);
            $popinAudio.find('.audio-player .image').css('backgroundImage', 'url('+img+')');
            $popinAudio.addClass('show');
            $('.ov').addClass('show');
          });
        }
      });
    }

    if($('#gridVideos').length) {
      if(window.location.hash) {
        setTimeout(function() {
          var type = window.location.hash.substring(1).split('=')[0]
              vid  = window.location.hash.substring(1).split('=')[1];
          if(type === "vid" && $(".item[data-vid="+vid+"]").length) {
              $(".item[data-vid="+vid+"]").trigger('click');
          }
        },1000);
      }

      $('.ov').on('click', function(e) {
        e.preventDefault();
        closePopinVideo();
      })

      var $container = $('#gridVideos'),
          $grid,
          videoPopin;


      videoPopin = playerInit('video-player-popin', false, 'grid');
      linkPopinInit(0, '.popin-video .popin-buttons.buttons .link');
      $('.popin-video .popin-buttons.buttons .email').on('click', function(e) {
        e.preventDefault();
        launchPopinMedia({}, videoPopin);
      });

      $grid = $('#gridVideos').imagesLoaded(function() {
        setGrid($grid, ('#gridVideos'), true);
        $grid.isotope({
          itemSelector: '.item',
          percentPosition: true,
          layoutMode: 'packery',
          packery: {
            columnWidth: '.grid-sizer'
          }
        });

        $grid.isotope('layout');
        window.setTimeout(function() {
          $grid.isotope('layout');
        }, 1000);
        var timer;
        $(window).scroll(function() {
          if(timer) {
            window.clearTimeout(timer);
          }
          timer = window.setTimeout(function() {
            $grid.isotope('layout');
          }, 100);
        });
        $('body').on('click', '#gridVideos .item', function(e) {
          var $popinVideo = $('.popin-video'),
              vid         = $(e.target).data('vid'),
              source      = $(e.target).data('file'),
              img         = $(e.target).data('img'),
              category    = $(e.target).find('.category').text(),
              date        = $(e.target).find('.date').text(),
              hour        = $(e.target).find('.hour').text(),
              name        = $(e.target).find('p').data('title');

/*          if($('body').hasClass('mobile')) {
            if(typeof source[1].file == 'string') {
              $popinVideo.find('.video-container').html('<video autoplay controls poster="'+img+'">' +
                  '<source src="'+source[0].file+'" type="video/webm"> ' +
                  '<source src="'+source[1].file+'" type="video/mp4">' +
                  ' </video>');
            } else {
              $popinVideo.find('.video-container').html('<video autoplay controls poster="'+img+'">' +
                  '<source src="'+source[0].file+'" type="video/webm">' +
                '</video>');
            }
          }*/

          videoPopin.playlistItem($(this).index()-1);
          sliderChannelsVideo.trigger('to.owl.carousel',[$(this).index()-1,1,true]);

          var newURL = window.location.href.split('#')[0] + '#vid=' + vid;
          history.replaceState('', document.title, newURL);

          // CUSTOM LINK FACEBOOK
          var shareUrl = GLOBALS.urls.videosUrl+'#vid='+vid;
          var fbHref   = facebookLink;
          fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
          fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent(img));
          fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent(category));
          fbHref       = fbHref.replace('CUSTOM_DESC', encodeURIComponent(name));
          $('#video-player-popin + .top-bar').find('.buttons .facebook').attr('href', fbHref);

          // CUSTOM LINK TWITTER
          var twHref   = twitterLink;
          twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent(name+" "+shareUrl));
          $('#video-player-popin + .top-bar').find('.buttons .twitter').attr('href', twHref);
          // CUSTOM LINK COPY
          $('#video-player-popin + .top-bar').find('.buttons .link').attr('href', shareUrl);
          $('#video-player-popin + .top-bar').find('.buttons .link').attr('data-clipboard-text', shareUrl);

          $('.popin-video').find('.popin-buttons.buttons .facebook').attr('data-href', fbHref);
          $('.popin-video').find('.popin-buttons.buttons .facebook').attr('href', fbHref);
          $('.popin-video').find('.popin-buttons.buttons .twitter').attr('href', twHref);
          $('.popin-video').find('.popin-buttons.buttons .link').attr('href', shareUrl);
          $('.popin-video').find('.popin-buttons.buttons .link').attr('data-clipboard-text', shareUrl);

          $('#video-player-popin + .top-bar').find('.info .category').text(category);
          $('#video-player-popin + .top-bar').find('.info .date').text(date);
          $('#video-player-popin + .top-bar').find('.info .hour').text(hour);
          $('#video-player-popin + .top-bar').find('.info p').text(name);

          updatePopinMedia({
            'type'     : "video",
            'category' : category,
            'date'     : date,
            'title'    : name,
            'url'      : shareUrl
          });

          $popinVideo.find('.popin-info .category').text(category);
          $popinVideo.find('.popin-info .date').text(date);
          $popinVideo.find('.popin-info .hour').text(hour);
          $popinVideo.find('.popin-info p').text(name);
          $popinVideo.addClass('video-player show loading');
          $('.ov').addClass('show');
        });
      });
    }

    if ($('#gridEvent').length) {
      var $container = $('#gridEvent'),
          $grid;

      $grid = $('#gridEvent').imagesLoaded(function () {
        setGrid($grid, $('#gridEvent'), true);
        $grid.isotope({
          itemSelector: '.item',
          percentPosition: true,
          layoutMode: 'packery',
          packery: {
            columnWidth: '.grid-sizer'
          }
        });

        $grid.isotope('layout');
        var timer;
        $(window).scroll(function() {
          if(timer) {
            window.clearTimeout(timer);
          }
          timer = window.setTimeout(function() {
            $grid.isotope('layout');
          }, 100);
        });
      });

      $('.read-more').on('click', function (e) {
        e.preventDefault();
        $(this).hide();

        $.ajax({
          type: "GET",
          dataType: "html",
          cache: false,
          url: GLOBALS.urls.eventUrl /* TODO DEV : context URL */,
          success: function (data) {
            var $data      = $(data).find('.gridelement');
            var $container = $('#gridEvent');
            var $grid;

            $grid = $container.imagesLoaded(function () {
              setGrid($grid, $data, false);
            });
          }
        });
      });
    }

    var filterValues = "";

    // filters

    if($('#gridAudios') || $('#gridVideos') || $('#gridPhotos')) {

      $('.filter .select').each(function() {
        var d = new Date();
        var n = d.getFullYear();

        $that = $(this);
        $that.find("span:not(.active):not([data-filter='all'],[data-filter='d"+n+"'])").each(function() {
          $this = $(this);


          var getVal = '.'+$this.data('filter');
          var numItems = $('.item'+getVal+':not(.isotope-hidden)').length;


          $this.removeClass('disabled');
          
          if (numItems === 0) {
            $this.addClass('disabled');
          } else {

            $this.removeClass('disabled');
          }
        });
      });
    }

    $('body').on('click', '#filters span', function () {
      var d = new Date(),
          n = d.getFullYear();


      filterValues = "";

      $('.filter .select .active').each(function () {
        if ($(this).data('filter') != 'all' && $(this).data('filter') != 'd'+n) {
          filterValues += '.' + $(this).data('filter');
        }
      });

      if($('#gridPhotos').length > 0 && $('.all-photos').length > 0) {
        for(var i=0; i<slideshows.length; i++) {
          slideshows[i].api().destroy();
        }
        $('.chocolat-wrapper').remove();
        slideshows = [];
      }

      if (filterValues.length > 0) {
        $grid.isotope({
          filter: function() {
            var obj = $(this),
                filterArray = filterValues.split('.'),
                f = "";

            for(i=1; i<filterArray.length; i++) {
              f += "(?=.*"+filterArray[i]+")";
            }
            f +=".*";

            return obj.attr('class').match(new RegExp(f));
          }
        });
      } else {
        $grid.isotope({filter: '*'});
      }

      if($('#gridAudios') || $('#gridVideos') || $('#gridPhotos')) {

        $('.filter .select').each(function() {
          var d = new Date();
          var n = d.getFullYear();
          
          $that = $(this);
          $that.find("span:not(.active):not([data-filter='all'],[data-filter='d"+n+"'])").each(function() {
            $this = $(this);

            var getVal = '.'+$this.data('filter');
            var numItems = $('.item'+getVal+':not(.isotope-hidden)').length;

            if (numItems === 0) {
              $this.addClass('disabled');
            } else {
              $this.removeClass('disabled');
            }
          });
        });
      }

      if($('#gridPhotos').length > 0 && $('.all-photos').length > 0) {
        initSlideshows();
      }

      $grid.isotope('layout');
      $("img.lazy").trigger('appear');
    });
  }


  if($('#gridFilmSelection').length > 0) {
    window.addEventListener("orientationchange", updateOrientation);
  }

  function updateOrientation() {
    $grid = $('#gridFilmSelection').imagesLoaded(function() {
      $grid.isotope({
        layoutMode: 'packery',
        itemSelector: '.item'
      });
    });
  }

});