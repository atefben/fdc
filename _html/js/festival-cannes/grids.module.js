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
  var result = document.getElementById('result');
  if ("matchMedia" in window) {
    if($('#gridAudios').length) {
      setGrid(false, $('#gridAudios'), true);
    }
    if($('#gridVideos').length) {
      setGrid(false, $('#gridVideos'), true);
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

$(document).ready(function () {
  function setImages(grid, dom, init) {
    var $img            = $(dom).find('.item:not(.portrait) img'),
        pourcentage     = 0.50,
        nbImgAAgrandir  = $img.length * pourcentage,
        i               = 0,
        nbRamdom        = [],
        x               = 1,
        max             = 0,
        min             = 0,
        nbImage         = $img.length;

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

    $('.item').addClass('visible');

    grid.isotope({
      itemSelector    : '.item',
      percentPosition : true,
      sortBy          : 'original-order',
      layoutMode      : 'packery',
      packery         : {
        columnWidth : '.grid-sizer'
      }
    });

    grid.isotope('layout');
  }

  function closePopinAudio() {
    $('.popin-audio, .ov').removeClass('show');

    $('.popin-audio').find('.wave-container').empty().removeAttr('id');
    for(var i = 0; i < waves.length; i++) {
      if(waves[i].isPlaying()) {
        waves[i].stop();
      }
    }
    $('.popin-audio').removeClass('pause audio-player');
    waves = [];

    if(inter) {
      clearInterval(inter);
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

        $('#gridPhotos div.item:not(.w2)').each(function() {
          if(typeof $(this).find('.info p').data('title') != 'undefined') {
            $(this).find('.info p').text($(this).find('.info p').data('title').trunc(30,true));
          }
        });
        $('#gridPhotos div.item.w2').each(function() {
          if(typeof $(this).find('.info p').data('title') != 'undefined') {
            $(this).find('.info p').text($(this).find('.info p').data('title').trunc(60,true));
          }
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
      $('.ov').on('click', function (e) {
        e.preventDefault();
        closePopinAudio();
      });

      var $container = $('#gridAudios'),
          $grid;

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

        if ($('#gridAudios').data('type') == 'audios') {
          $('body').on('click', '#gridAudios .item', function(e) {
            var $popinAudio = $('.popin-audio'),
                s           = $(e.target).data('sound'),
                img         = $(e.target).find('img').attr('src'),
                category    = $(e.target).find('.category').text(),
                date        = $(e.target).find('.date').text(),
                hour        = $(e.target).find('.hour').text(),
                text        = $(e.target).find('p').data('title');

            $popinAudio.attr('data-sound', s);
            $popinAudio.find('.image').css('background-image', 'url(' + img + ')');
            $popinAudio.find('.category').text(category);
            $popinAudio.find('.date').text(date);
            $popinAudio.find('.hour').text(hour);
            $popinAudio.find('p').text(text);
            $popinAudio.addClass('audio-player show loading');
            waves = [];
            $('.audio-player .playpause').off('click');
            initAudioPlayers();
            $('.ov').addClass('show');
          });
        }
      });
    }

    if($('#gridVideos').length) {
      if(window.location.hash) {
        var type = window.location.hash.substring(1).split('=')[0]
            vid  = window.location.hash.substring(1).split('=')[1];
        if(type === "vid" && $(".item[data-vid="+vid+"]").length) {
          setTimeout(function() {
            $(".item[data-vid="+vid+"]").trigger('click');
          },1000);
        }
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

        $('body').on('click', '#gridVideos .item', function(e) {
          var $popinVideo = $('.popin-video'),
              vid         = $(e.target).data('vid'),
              source      = $(e.target).data('file'),
              img         = $(e.target).data('img'),
              category    = $(e.target).find('.category').text(),
              date        = $(e.target).find('.date').text(),
              hour        = $(e.target).find('.hour').text(),
              name        = $(e.target).find('p').data('title');

          videoPopin.playlistItem($(this).index()-1);
          sliderChannelsVideo.trigger('to.owl.carousel',[$(this).index()-1,1,true]);

          var newURL = window.location.href.split('#')[0] + '#vid=' + vid;
          history.replaceState('', document.title, newURL);

          // CUSTOM LINK FACEBOOK
          var shareUrl = GLOBALS.urls.videosUrl+'#vid='+vid;
          var fbHref   = facebookLink;
          fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
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

    var filterValues = "";

    // filters
    $('body').on('click', '#filters span', function () {
      var d = new Date(),
          n = d.getFullYear();

      filterValues = "";

      $('.filter .select .active').each(function () {
        if ($(this).data('filter') != 'all' && $(this).data('filter') != 'd'+n) {
          filterValues += '.' + $(this).data('filter');
        }
      });

      $container.isotope({
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
      

      if($('#gridAudios') || $('#gridVideos')) {
        $('.filter .select').each(function() {
          var d = new Date();
          var n = d.getFullYear();
          
          $that = $(this);
          $that.find("span:not(.active):not([data-filter='all'],[data-filter='d"+n+"'])").each(function() {
            $this = $(this);

            var getVal = '.'+$this.data('filter');
            var numItems = $('.item'+getVal+':not(.isotope-hidden)').length;
            
            if (numItems === 0) {
              // console.log(1,$('.item'+getVal+':not(.isotope-hidden)'));
              $this.addClass('disabled');
              // $this.hide();
            } else {
              // console.log(1,$('.item'+getVal+':not(.isotope-hidden)'));
              $this.removeClass('disabled');
              // $this.show();
            }
          });
        });
      }
    });
  }
});