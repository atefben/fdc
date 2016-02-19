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
    if($('#gridAudios').length) {
      setGrid(false, $('#gridVideos'), true);
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
    if (window.matchMedia("(max-width: 1599px)").matches) {
      while (i < $img.length) {
        if (j < 11) {
          if (j == 0 || j == 3) {
            $($img[i]).closest('div.item').addClass('w2');
          }
          j++;
        }
        if (j == 10) {
          j = 0;
        }
        i++;
      }
    } else if (window.matchMedia("(max-width: 1919px)").matches) {

      while (i < $img.length) {
        if (j < 31) {
          if (j == 0 || j == 3 || j == 12 || j == 17 || j == 25) {
            $($img[i]).closest('div.item').addClass('w2');
          }
          j++;
        }
        if (j == 30) {
          j = 0;
        }
        i++;
      }

    } else if (window.matchMedia("(min-width: 1920px)").matches) {
      while (i < $img.length) {
        if (j < 16) {
          if (j == 0 || j == 5 || j == 15) {
            $($img[i]).closest('div.item').addClass('w2');

          }
          j++;
        }
        if (j == 10) {
          j = 0;
        }
        i++;
      }
    }
  }
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

    if(!init) {
      grid.append($(dom)).isotope('appended', $(dom));
      grid.imagesLoaded(function () {
        setTimeout(function() {grid.isotope('layout');}, 500);
      });
    }
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
        $grid.isotope({
          itemSelector: '.item',
          percentPosition: true,
          layoutMode: 'packery',
          packery: {
            columnWidth: '.grid-sizer'
          }
        });

        if($('.all-photos').length) {
          setTimeout(function() {
            $grid.isotope({ sortBy : 'original-order' });
          }, 500);

          $grid.infinitescroll({
            navSelector: "#next:last",
            nextSelector: "#next:last",
            itemSelector: "#gridPhotos",
            debug: false,
            dataType: 'html'
          }, function (newElements, data, url) {
            setGrid($grid, newElements, false);
          });

        }
      });
    }

    if($('.all-photos').length) {
      var slideshow = $('#gridPhotos').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        imageSelector: '.item:not(.isotope-hidden) .chocolat-image'
      }).data('chocolat');

      slideshows.push(slideshow);
    }

    if($('#gridWebtv').length) {
      $grid = $('#gridWebtv').imagesLoaded(function () {

        $grid.isotope({
          layoutMode: 'packery',
          itemSelector: '.item'
        });
      });
    }

    if($('#gridJurys').length) {
      $grid = $('#gridJurys').imagesLoaded(function () {

        $grid.isotope({
          layoutMode: 'packery',
          itemSelector: '.item'
        });
      });
    }

    if($('#gridFilmSelection').length) {
      $grid = $('#gridFilmSelection').imagesLoaded(function () {

        $grid.isotope({
          layoutMode: 'packery',
          itemSelector: '.item'
        });
      });
    }

    if($('#gridAudios').length) {

      $('.ov').on('click', function (e) {
        e.preventDefault();
        closePopinAudio();
      });

      var $container = $('#gridAudios'),
        $grid;

      $grid = $('#gridAudios').imagesLoaded(function() {
        // init Isotope after all images have loaded
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

            var s = $(e.target).data('sound'),
              img = $(e.target).find('img').attr('src'),
              category = $(e.target).find('.category').text(),
              date = $(e.target).find('.date').text(),
              hour = $(e.target).find('.hour').text(),
              text = $(e.target).find('p').text(),
              $popinAudio = $('.popin-audio');

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

      // $('#gridAudios').infinitescroll({
      //   navSelector: "#next:last",
      //   nextSelector: "#next:last",
      //   itemSelector: "#gridAudios",
      //   debug: true,
      //   dataType: 'html'
      // }, function (newElements, data, url) {
      //   setGrid($grid, newElements, false);
      // });
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
              text        = $(e.target).find('p').text();

          videoPopin.playlistItem($(this).index()-1);
          sliderChannelsVideo.trigger('to.owl.carousel',[$(this).index()-1,1,true]);

          var newURL = window.location.href.split('#')[0] + '#vid=' + vid;
          history.replaceState('', document.title, newURL);

          $popinVideo.find('.popin-info .category').text(category);
          $popinVideo.find('.popin-info .date').text(date);
          $popinVideo.find('.popin-info .hour').text(hour);
          $popinVideo.find('.popin-info p').text(text);
          $popinVideo.addClass('video-player show loading');
          $('.ov').addClass('show');
        });
      });
    }

    var filterValues = "";

    // filters
    $('body').on('click', '#filters span', function () {

      filterValues = "";

      $('.filter .select .active').each(function () {
        if ($(this).data('filter') != 'all') {
          filterValues += '.' + $(this).data('filter');
        }
      });

      $container.isotope({
        filter: filterValues
      });

      // if($('.all-photos').length) {
      //   setTimeout(function() {
      //     for(var i=0; i<slideshows.length; i++) {
      //       slideshows[i].api().destroy();
      //     }

      //     slideshows = [];
      //     $('.chocolat-wrapper').remove();
      //     initSlideshows();
      //   }, 1500);
      // }
    });
  }

});
