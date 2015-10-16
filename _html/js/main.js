//       SUMMARY TABLE     
// =========================
// 1. Prehome
// 2. Main menu
// 3. Slider Home
// 4. News
// 5. Social Wall
// 6. Slider Videos
// 7. Slider Channels
// 8. Slider Movies
// 9. Prefooter
// 10. Slideshow
// 11. Filters
// 12. Search
// 13. Events on scroll
// 14. Player Audio
// 15. Single Article
// 16. Selection
// 17. Single Movie
// 18. All Photos
// 19. Contact
// 20. Webtv
// 21. FAQ
// 22. Newsletter
// 23. Palmares
// =========================


// HELPERS ================ //

// parse URL in string
String.prototype.parseURL = function() {
  return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
    return url.link(url);
  });
};

// parse twitter username in String
String.prototype.parseUsername = function(twitter) {
  return this.replace(/[@]+[A-Za-z0-9-_]+/g, function(u) {
    var username = u.replace("@","")
    if(twitter == true) {
      return u.link("http://twitter.com/"+username);
    } else {
      return '<strong>' + username + '</strong>';
    }
  });
};

// parse Twitter hashtag in String
String.prototype.parseHashtag = function(twitter) {
  return this.replace(/[#]+[A-Za-z0-9-_]+/g, function(t) {
    var tag = t.replace("#","%23")
    if(twitter == true) {
      return t.link("http://search.twitter.com/search?q="+tag);
    } else {
      return '<strong>' + t + '</strong>';
    }
    
  });
};

$(document).ready(function() {

  // 1. Prehome
  // =========================

  if($('.home').length) {

    if(!$.cookie('prehome')) {
      $('#prehome-container').height($(window).height());
      $('#prehome').addClass('show');

      setTimeout(function() {
        $('html, body').animate({
          scrollTop: $("header").offset().top
        }, 800, function() {
          $('#prehome-container').remove();
          $('body,html').scrollTop(0);
        });
      }, 3000);
      $.cookie('prehome', '1', { expires: 7 });
    } else {
      $('#prehome-container').remove();
    }
  }

  // 2. Main menu
  // =========================

  // overlay on main menu : show submenu and overlay
  $('.main>li, .user>li').hover(function() {
    $('#main').addClass('overlay');
    $('.main>li').not($(this)).addClass('fade');
  }, function() {
    if(!$('#selection').hasClass('open')) {
      $('#main').removeClass('overlay');
    }
    $('.main li').removeClass('fade');
  });

  var displayed = false,
      graphRendered = false;

  if($('.home').length) {

    // 3. Slider Home
    // =========================
    var time = 7;
   
    var $progressBar,
        $bar, 
        sliderHome, 
        isPause, 
        tick,
        percentTime;

     function progressBar(){    
      // build progress bar elements
      buildProgressBar();
        
      // start counting
      start();
    }

    function buildProgressBar(){
      $progressBar = $("<div>",{
          id:"progressBar"
      });
      
      $bar = $("<div>",{
          id:"bar"
      });
      
      $progressBar.append($bar).prependTo($("#slider"));
    }

    function start() {
      // reset timer
      percentTime = 0;
      isPause = false;
      
      // run interval every 0.01 second
      tick = setInterval(interval, 10);
    };

    function interval() {
      if(isPause === false){
        percentTime += 1 / time;
        
        $bar.css({
            width: percentTime+"%"
        });
        
        // if percentTime is equal or greater than 100
        if(percentTime >= 100){
          // slide to next item 
          $("#slider").trigger("next.owl.carousel");
          percentTime = 0;
        }
      }
    }

    // pause while dragging 
    function pauseOnDragging(){
      isPause = true;
    }

    // moved callback
    function moved(){
      // clear interval
      clearTimeout(tick);
        
      // start again
      start();
    }

    $("#slider").owlCarousel({
      items: 2,
      loop: true,
      center: true,
      nav: true,
      dots: true,
      onInitialized: progressBar,
      onTranslated: moved,
      onDrag: pauseOnDragging,
      navSpeed: 500,
      dotsSpeed: 500,
      smartSpeed: 500,
      autoWidth: true
    });

    // 4. News
    // =========================

    // load more

    $('.read-more').on('click', function(e) {
      e.preventDefault();
      if($(this).hasClass('prevDay')) {
        $('#shd').removeClass('show');
        $('.read-more').html("Afficher <strong>plus d'actualités</strong>").removeClass('prevDay');
        $('#articles-wrapper').addClass('loading');
        $('html, body').animate({
          scrollTop: $("#news").offset().top - 50
        }, 1000);

        var i = $('#timeline a.active').index();
        $('#timeline a').removeClass('active');
        $('#timeline a').eq(i).next().addClass('active');

        // todo: remove timeout
        setTimeout(function() {
          $.ajax({
            type: "GET",
            dataType: "html",
            cache: false,
            url: 'news.html' ,
            success: function(data) {
              $('#articles-wrapper').html(data);
              $('#articles-wrapper').removeClass('loading');

              $('.filter .select span').removeClass('active');
              $('.filter .select span[data-filter="all"]').addClass('active');

              initSlideshows();
            }
          });
        }, 1000);
      } else {
        $.ajax({
          type: "GET",
          dataType: "html",
          cache: false,
          url: 'news_page2.html' ,
          success: function(data) {
            $('#articles-wrapper').css('max-height', $('#articles-wrapper').height()).append(data);
            $('#articles-wrapper').css('max-height', $('#articles-wrapper').prop('scrollHeight'));

            $('.read-more').html('Passer au <strong>jour précédent</strong>').addClass('prevDay');
            setTimeout(function() {
              $('#shd').addClass('show');
            }, 500);
          }
        });
      }
        
    });


    // 5. Social Wall
    // =========================


    // Change date

    $('#timeline a').on('click', function(e) {
      e.preventDefault();

      if($(this).hasClass('active') || $(this).hasClass('disabled')) {
        return false;
      }

      $('#timeline a').removeClass('active');
      $(this).addClass('active');

      $('#articles-wrapper').addClass('loading');

      // todo: remove timeout
      setTimeout(function() {
        $.ajax({
          type: "GET",
          dataType: "html",
          cache: false,
          url: 'news.html' ,
          success: function(data) {
            $('#articles-wrapper').html(data);
            $('#articles-wrapper').removeClass('loading');

            $('.filter .select span').removeClass('active');
            $('.filter .select span[data-filter="all"]').addClass('active');

            $('html, body').animate({
              scrollTop: $("#news").offset().top - 50
            }, 500);

            initSlideshows();
          }
        });
      }, 600);
      
    });

    // GRAPH SVG

    var s = Snap('#graphSVG');
  
    // selection of points for the graph
    var points = [50,60,50,45,70,50,100,120,70,80,90,70],
        heightGraph = 200;
    
    function makeGrid(){
      
      var dataLength = points.length;
      var maxValue = heightGraph;
      var minValue = 35;
      
      // Creates the vertical lines in the graph
      for (var i=0; i<dataLength; i++) {
        var x = 4 + i*80;
        var xLine = s.line(x, minValue, x, maxValue).attr({
          stroke: "#000",
          strokeWidth: 0.25,
          strokeDasharray: '1 5'
        });
      }
    }
    
    makeGrid();
    
    
    function convertToPath(points){
      var path = 'M4,' + (heightGraph - points[0]);
      
      for (var i=0; i<points.length; i++){
        var x = i*80 + 4;
        var y = -points[i]+heightGraph;
        if (i===0){
          path += 'L'+x+','+y+' ';
        }
        else if (i===points.length-1){
          path += x+','+y;
        }
        else {
          path += x+','+y+',';
        }
      }
      return path;
    }
   
    function makePath(data){
      var pathString = convertToPath(data);
      var graphHeight = $('#graph').height();
      
      function getDefaultPath(){
        var defaultPathString = 'M4,'+ (graphHeight - 30) +' H';
      
        for (var i=0; i<data.length; i++) {
          if (i!==0){ 
            defaultPathString += i*80+4+' ';
          }
        }
        
        return defaultPathString;
      }
      
      var path = s.path(getDefaultPath()).attr({
        stroke: '#c8a461',
        strokeWidth: 1,
        fill: 'transparent'
      });
    
      path.animate({ path: pathString },500);

      /* point radius */
      var radius = 2;
      
      /* iterate through points */
      setTimeout(function() {
        for (var i = 0, length = data.length; i < length; i++) {
          var xPos = i*80 + 4;
          var yPos = heightGraph - data[i];
          
          var circle = s.circle(xPos, yPos, radius);

          circle.attr({
            stroke: '#c8a461',
            strokeWidth: 2,
            fill: '#fff',
            opacity: 0,
            title: data[i]
          });

          circle.animate({opacity: 1}, 300);

          circle.mouseover(function() {
            $('#tipGraph').text($(this)[0].attr('title'));
            $('#tipGraph').css({
              top: parseInt($(this)[0].attr('cy')) - 25 + "px",
              left: $('#hashtag').width() + parseInt($(this)[0].attr('cx') - 15) + "px"
            });
            $('#tipGraph').addClass('show');
          });

          circle.mouseout(function() {
            $('#tipGraph').removeClass('show');
          });

        }

        var j = $('#graph ul li.active').index();
        $('#graph circle').eq(j).attr('r', 5).css('stroke-width', '3');
      }, 600);

      graphRendered = true;
      
    }
    

    // INSTAGRAM
    var access_token = "18360510.5b9e1e6.de870cc4d5344ffeaae178542029e98b",
        hashtag = "Cannes2016",
        posts = [];

    var url = "https://api.instagram.com/v1/tags/"+hashtag+"/media/recent/?access_token="+access_token;

    // load Instagram pictures and build array
    function loadInstagram(url, callback){

      $.ajax({
        type: "GET",
        dataType: "jsonp",
        cache: false,
        url: url ,
        success: function(data) {

          var count = 15; 
          for (var i = 0; i < count; i++) {
            if (typeof data.data[i] !== 'undefined' ) {
              posts.push({'type': 'instagram', 'img': data.data[i].images.low_resolution.url, 'date' : data.data[i].created_time, 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data.data[i].caption.text.substr(0, 140).parseURL().parseUsername().parseHashtag() + '</p></div></div></div>', 'user': data.data[i].user.username});
            }
            if( i == count - 1) {
              callback();
            }
          }
        }
      });

    }

    // TWITTER
    // load Twitter posts and pictures and build array
    function loadTweets(callback) {
      var request = {
        q: '%23Cannes2016',
        count: 15,
        api: 'search_tweets'
      };

      $.ajax({
        url: 'twitter.php',
        type: 'POST',
        datatype: 'json',
        data: request,
        success: function(data, textStatus, xhr) {
          data = JSON.parse(data);
          console.log(data);
          data = data.statuses;
          var img = '';             

          for (var i = 0; i < data.length; i++) {        
          
            img = '';
            url = 'http://twitter.com/' + data[i].user.screen_name + '/status/' + data[i].id_str;
            try {
              if (data[i].entities['media']) {
                img = data[i].entities['media'][0].media_url;
              }
            } catch (e) {  
              // no media
            }
          
            posts.push({'type': 'twitter', 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data[i].text.parseURL().parseUsername(true).parseHashtag(true) + '</p></div></div></div>', 'name': data[i].user.screen_name, 'img': img, 'url': url, 'date': data[i].created_at})    

            if(i==data.length - 1) {
              callback();
            }
          }
         
        }   
      });
    }

    function displayGrid() {
      $('.post').each(function(i) {
        var $p = $(this);
        setTimeout(function() {
          $p.find('.side').addClass('flip');
        }, i*100);
      });

      displayed = true;

      // randomly display new posts
      var p = $('.post .side-2');

      for (var i = 0; i < posts.length; ++i)
      {
        setTimeout(function() {
          var r = Math.floor(Math.random() * p.length);
          var c = p.splice(r, 1)[0];

          var random = Math.floor(Math.random() * posts.length);
          var item = posts.splice(random, 1)[0];

          $(c).prev().addClass(item.type);
          $(c).parent().find('.side').removeClass('flip');
          if(item.img) {
            $(c).prev().addClass('hasimg').css('background-image', 'url(' + item.img + ')');
          }
          $(c).prev().append(item.text);
        }, (i+1) * 5000);
      }
    }

    loadInstagram(url, function() {
      loadTweets(function() {

        // once all data is loaded, build html and display the grid
        var p = $('.post .side-2');
        for (var i = 0; i < 13; ++i)
        {
          var random = Math.floor(Math.random() * posts.length);
          var item = posts.splice(random, 1)[0];

          var r = Math.floor(Math.random() * p.length);
          var c = p.splice(r, 1)[0];

          $(c).addClass(item.type);
          $(c).find('.side').addClass('flip');
          if(item.img) {
            $(c).addClass('hasimg').css('background-image', 'url(' + item.img + ')');
          }
          $(c).append(item.text);
        }

      });
    });

  }

  if($('.home').length || $('.webtv').length) {

    // 6. Slider Videos
    // =========================

    var sliderVideos = $("#slider-videos").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      margin: 50,
      center: true,
      autoWidth: true,
      loop: false,
      items: 1,
      onInitialized: function() {
        $('#slider-videos .owl-stage').css({ 'margin-left': "-172px" });
      }
    });

    sliderVideos.owlCarousel();

    $('body').on('click', '#slider-videos .owl-item', function(e) {
      sliderVideos.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // 7. Slider Channels
    // =========================
    
    var sliderChannels = $("#slider-channels").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-channels .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderChannels.owlCarousel();

    sliderChannels.on('translated.owl.carousel', function(e) {
      $('#slider-channels .owl-item').removeClass('previous');
      $('#slider-channels .owl-item.center').prev().addClass('previous');
    });

    $('body').on('click', '#slider-channels .owl-item', function(e) {
      sliderChannels.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

  }

  if($('.home').length) {

    // 8. Slider Movies
    // =========================

    function setHeightSlider() {
     
      var newHeight = $(window).height() - 90,
          valueHeight = Math.round(($(window).width()/16)*9),
          top = newHeight - valueHeight;

      $('#featured-movies').height(newHeight);
      $('#featured-movies video').css({
        'top': top,
        'height': valueHeight
      });
    }

    function handleEndVideo() {
      $('#slider-movies video').off('ended');
      $('#slider-movies .active video').on('ended',function(){
        var sMovies = $('#slider-movies');
        sMovies.owlCarousel();

        sMovies.trigger('next.owl.carousel');
      });
    }

    function pauseVideo() {
      $('#slider-movies .active video')[0].pause();
    }

    function playNewVideo() {
      $('#slider-movies .active video')[0].play();
      handleEndVideo();
    }

    $("#slider-movies").owlCarousel({
      items: 1,
      loop: true,
      nav: false,
      dots: false,
      smartSpeed: 500,
      onTranslated: playNewVideo,
      onDrag: pauseVideo
    });

    setHeightSlider();


    // 9. Prefooter
    // =========================

    $('#prefooter a').on('mouseover', function(e) {
      e.preventDefault();

      $('.imgSlide, #prefooter a').removeClass('active');
      var i = $(this).parent().index();

      $(this).addClass('active');
      $('.imgSlide').eq(i).addClass('active');
    });


  }

  // 10. Slideshow
  // =========================

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

    var slideshow = $('.slideshow .images').Chocolat({
      imageSize: 'cover',
      fullScreen: false
    }).data('chocolat');

    $('body').on('click', '.chocolat-img', function(e){
      slideshow.api().close();
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

    $('.chocolat-wrapper .thumbnails').owlCarousel({
      autoWidth: true,
      nav: false,
      dots: false,
      smartSpeed: 500,
      margin: 0
    });
  });

  $('body').on('click', '.chocolat-wrapper .thumb', function() {
    var i = $(this).parent().index();

    $('.chocolat-wrapper .thumb').removeClass('active');
    $(this).addClass('active');

    var slideshow = $('.slideshow .images').data('chocolat');
    slideshow.api().goto(i);

  });

  initSlideshows();

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

  // 11. Filters
  // =========================

  // on click on a filter
  $('.filters .select span').on('click', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters').addClass('show').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function() {
      $('#filters span').addClass('show');
    }, 400);
  });

  // close filters
  $('body').on('click', '#filters', function() {
    $('#filters').removeClass('show');
  });

  $('body').on('click', '#filters span', function() {
    var id = $('#filters').data('id'),
        i = $(this).index();

    $('#' + id + ' .select span').removeClass('active');
    $('#' + id + ' .select span').eq(i).addClass('active');

    var filters = [];

    $('.filter').each(function() {
      var $that = $(this);
      var a = $that.find('.select span.active').data('filter');
      
      if(a == 'all') {
        return;
      }

      var obj = {'filter': $that.attr('id'), 'value': a};
      
      filters.push(obj);
    });

    var exp1 = '',
        exp2 = '';

    for(var i=0; i<filters.length; i++) {
      exp1 += '[data-' + filters[i].filter + ']';
      exp2 += '[data-' + filters[i].filter + '="' + filters[i].value + '"]';
    }

    if(filters.length != 0) {
      $('*' + exp1).hide();
      $('*' + exp2).show();

      if($('.articles').length != 0) {
        $('.articles').removeClass('left right').addClass('center');
        $('.articles article').removeClass('double');
      }
    } else {
      $('*[data-' + id + ']').show();
    }
  });


  // 12. Search
  // =========================

  $('.search').on('click', function(e) {
    e.preventDefault();


  });


  // 13. Events on scroll
  // =========================

  $(window).on('scroll', function() {
    var s = $(window).scrollTop();

    if(($('#prehome-container').length == 0 && s > 50) || ($('#prehome-container').length && s > $(window).height() + 10)) {
      $('header').addClass('sticky');
    } else {
      $('header').removeClass('sticky');
    }

    if($('#featured-movies').length) {
      if(s > $('#featured-movies').offset().top - $('#featured-movies').height() && s < $('#featured-movies').offset().top + $('#featured-movies').height()) {
        $('#featured-movies .active').find('video')[0].play();
        handleEndVideo();
      } else {
        $('#featured-movies .active').find('video')[0].pause();
      }
    }

    if($('#social-wall').length) {
      if(s > $('#social-wall').offset().top - ($(window).height()/2) && !displayed) {
        displayGrid();
      }
    }

    if($('#graph').length) {
      if(s > $('#graph').offset().top - ($(window).height()/2) && !graphRendered) {
        makePath(points);
      }
    }

    if($('#news').length) {
      if(s > $('#news').offset().top + 50 && s < ($('.read-more').offset().top - $('.read-more').height() - $('#timeline').height())) {
        $('#timeline').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 60);
      } else {
        $('#timeline').removeClass('stick').css('left', 'auto');
      }
    }

    if($('.single-movie').length ) {
      if(s > ($('.videos').offset().top - $('#nav-movie').height() - 100)) {
        $('#nav-movie').addClass('sticky');
      } else {
        $('#nav-movie').removeClass('sticky');
      }

      $('.main-image').height($('.main-image').data('height'));
      $('.main-image, .poster, .info-film, .nav').removeClass('trailer');

      var sections = $('*[data-section')
        , nav = $('#nav-movie')
        , nav_height = nav.outerHeight() + $('header').height();
       
        sections.each(function() {
          var top = $(this).offset().top - nav_height,
              bottom = top + $(this).outerHeight();
       
          if (s >= top && s <= bottom) {
            nav.find('ul a').removeClass('active');

            nav.find('a[href="#'+$(this).data('section')+'"]').addClass('active');
          }
        });

    }


  });

  // 14. Player Audio
  // =========================

  var waves = [],
      inter = null,
      duration = null;

  function initAudioPlayers() {
    $('.audio-player').each(function(i) {
      $(this).addClass('loading').find('.wave-container').attr('id', 'wave-' + i);
      var h = $(this).hasClass('bigger') ? 116 : 55;
      var wave = Object.create(WaveSurfer);

      wave.init({
        container: document.querySelector('#' + 'wave-' + i),
        waveColor: 'rgba(255, 255, 255, 0.5)',
        progressColor: '#c8a461',
        cursorWidth: 0,
        height: h
      });

      wave.load($(this).data('sound'));

      wave.on('ready', function() {
        $(wave.container).parents('.audio-player').removeClass('loading');
        if($(wave.container).parents('.audio-player').hasClass('popin-audio')) {
          $('.popin-audio .playpause').trigger('click');
        }
      });

      waves.push(wave);

      $(this).find('.playpause').on('click', function(e) {
        e.preventDefault();

        if(inter) {
          clearInterval(inter);
        }

        $audioplayer = $(e.currentTarget).parents('.audio-player');

        if(!$audioplayer.hasClass('on')) {
          $audioplayer.addClass('on');

          duration = wave.getDuration();
          var minutes = parseInt(Math.floor(duration / 60));
          var seconds = parseInt(duration - minutes * 60);

          if(seconds < 10) {
            seconds = '0' + seconds;
          }

          $audioplayer.find('.duration .total').text(minutes + ':' + seconds);
        }
        
        inter = setInterval(function() {
          var curr = wave.getCurrentTime();

          var minutes = parseInt(Math.floor(curr / 60));
          var seconds = parseInt(curr - minutes * 60);

          if(seconds < 10) {
            seconds = '0' + seconds;
          }

          $audioplayer.find('.duration .curr').text(minutes + ':' + seconds);
        }, 1000);

        
        if(!$audioplayer.hasClass('pause')) {
          for(var i = 0; i<waves.length; i++) {
            if(waves[i].isPlaying() && waves[i].container.id != wave.container.id) {
              waves[i].pause();
            }
          }
        }
        $('.audio-player').not($audioplayer).removeClass('pause');

        wave.setVolume(0.75);
        wave.playPause();

        $audioplayer.toggleClass('pause');
      });
    });
  }

  function FShandler() {
    if (document.fullscreenEnabled && document.fullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
    if (document.webkitFullscreenEnabled && document.webkitFullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
    if (document.mozFullScreenEnabled && document.mozFullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
    if (document.msFullscreenEnabled && document.msFullscreenElement == null) {
      $('.audio-player').removeClass("full");
      $('.audio-player .top, .audio-player .bottom').remove();
    }
  }

  $('body').on('click', '.volume', function(e) {
    var newVolume = (e.offsetX * 2) / 100;

    $('.audio-player .volume span').css('width', newVolume * 100 + "%");

    for(var i = 0; i < waves.length; i++) {
      waves[i].setVolume(newVolume);
    }
  });

  if($('.audio-player').length) {
    initAudioPlayers();
  }

  // show audioplayer on fullscreen
  $('body').on('click', '.audio-player .fullscreen', function(e) {
    var i = $(this).parent().index('.audio-player'),
        wave = waves[i];

    e.preventDefault();
    var audioPlayer = $(this).parents('.audio-player')[0];

    if (document.fullscreenEnabled || document.webkitFullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled) {

      if($(this).parent().hasClass('full')) {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }
      else {

        $(audioPlayer).addClass('full');

        var info = $(audioPlayer).find('.info').html();
        $(audioPlayer).append('<div class="top"><a href="#" class="channels"></a><div class="info"><div class="vCenter"><div class="vCenterKid">' + info + '</div></div></div></div>');
        $(audioPlayer).find('.top').append('<div class="buttons square"><a href="#" class="button facebook"></a><a href="#" class="button twitter"></a><a href="#" class="button link"></a><a href="#" class="button email"></a></div>')
        $(audioPlayer).append('<div class="bottom"><a href="#" class="playpause" data-action="play"></a></div>');

        if (audioPlayer.requestFullscreen) {
          audioPlayer.requestFullscreen();
        } else if (audioPlayer.webkitRequestFullscreen) {
          audioPlayer.webkitRequestFullscreen();
        } else if (audioPlayer.mozRequestFullScreen) {
          audioPlayer.mozRequestFullScreen();
        } else if (audioPlayer.msRequestFullscreen) {
          audioPlayer.msRequestFullscreen();
        }

        $('.playpause').on('click', function(e) {
          e.preventDefault();
          wave.playPause();
        });

        document.addEventListener("fullscreenchange", FShandler);
        document.addEventListener("webkitfullscreenchange", FShandler);
        document.addEventListener("mozfullscreenchange", FShandler);
        document.addEventListener("MSFullscreenChange", FShandler);
      }
    }
  });

  // 15. Single Article
  // =========================

  if($('.single-article').length) {
    $('#share-article').on('click', function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $(".share").offset().top - $('header').height() - $('.share').height()
      }, 500);
    });
  }

  // 16. Selection
  // =========================

  var sliderSelection = '';

  function openSelection(callback) {
    $('#main').addClass('overlay');

    if(sliderSelection != '') sliderSelection.trigger('destroy.owl.carousel');
    $('#slider-selection').empty();
    $('header .selection').addClass('opened');

    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url: 'selection.html' ,
      success: function(data) {
        $('#slider-selection').append(data);

        sliderSelection = $("#slider-selection").owlCarousel({
          nav: false,
          dots: false,
          smartSpeed: 500,
          center: true,
          loop: false,
          margin: 50,
          autoWidth: true,
          onInitialized: function() {
            var v = ($(window).width() - 977) / 2 + "px";
            $('#slider-selection .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
            $('#selection').addClass('open');
          }
        });

        sliderSelection.owlCarousel();
        callback();
      }
    });
    
  }

  function closeSelection() {
    $('#main').removeClass('overlay');
    $('#selection').removeClass('open');
    $('header .selection').removeClass('opened');
  }

  $('body').on('click', '#main.overlay', function(e) {
    e.preventDefault();

    if($('#selection').hasClass('open')) {
      closeSelection();
    }
  });

  $('header .selection').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('opened')) {
      closeSelection();
    } else {
      openSelection(function() {

      });
    }
    
  });

  // filters
  $('.filters-selection a').on('click', function(e) {
    e.preventDefault();

    $('.filters-selection a').removeClass('active');
    $(this).addClass('active');

    var f = $(this).data('selection');

    $('#selection .owl-item').removeClass('fade');

    if(f == 'all') {
      return false;
    } 

    if(f == 'suggestion') {
      // todo

      return false;
    }

    $('#selection article').each(function() {
      if(!$(this).hasClass(f)) {
        $(this).parents('.owl-item').addClass('fade');
      }
    });


  });

  // delete an article
  $('body').on('click', '.delete', function(e) {
    e.preventDefault();
    var $that = $(this);

    $(this).parent().addClass('deleted');
    $(this).parent().parent().css('margin-right', 0);
    var i = $(this).parent().parent().index();

    setTimeout(function() {
      sliderSelection.trigger('del.owl.carousel', i);
      sliderSelection.trigger('refresh.owl.carousel');
      var v = ($(window).width() - 977) / 2 + "px";
      $('#slider-selection .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
    }, 500);
  });

  // add an article 
  $('body').on('click', '.read-later', function(e) {
    e.preventDefault();
    var $article = $(this).parents('article').clone().removeClass('double').wrapAll("<div class='article'></div>").parent().wrapAll('<div></div>').parent();
        $article.find('.read-later').remove();
        $article.find('div.article').append('<a href="#" class="delete"></a>');
        $article = $article.html();

    openSelection(function() {
      $("#main").addClass('overlay');
      $('header .selection').addClass('opened');
      
      setTimeout(function() {
        sliderSelection.trigger('add.owl.carousel', [$('<div class="owl-item">' + $article + '</div>'), 0]);
        sliderSelection.trigger('refresh.owl.carousel');
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-selection .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }, 700);
    });
     
  });

  $('body').on('mouseover', '.read-later', function() {
    $(this).find('span').css({
      top: $(this).offset().top - $(window).scrollTop() - 59,
      left: $(this).offset().left - 80
    });
  });

  // 17. Single Movie
  // =========================

  if($('.single-movie').length) {

    // init slider
    var sliderMovieVideos = $("#slider-movie-videos").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-movie-videos .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderMovieVideos.owlCarousel();

    $('body').on('click', '#slider-movie-videos .owl-item', function(e) {
      sliderMovieVideos.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // gallery slideshow
    $('.gallery .thumbs a').on('click', function(e) {
      e.preventDefault();
      var i = $(this).index(),
          cap = $(this).data('caption');

      $('.gallery .img img').removeClass('active');
      $('.gallery .img img').eq(i).addClass('active');

      $('.gallery .thumbs a').removeClass('active');
      $(this).addClass('active');

      $('.gallery .caption').text(cap);
    });

    // anchors menu
    $('#nav-movie ul a').on('click', function (e) {
      e.preventDefault();

      $('#nav-movie ul a').removeClass('active');
      $(this).addClass('active');

      var $el = $(this)
        , id = $el.attr('href').substr(1);
     
      $('html, body').animate({
        scrollTop: $('*[data-section="' + id + '"]').offset().top - $('#nav-movie').height() - $('header').height()
      }, 500);
    });

    // slider competitions
    var sliderCompetition = $("#slider-competition").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-competition .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderCompetition.owlCarousel();

    $('body').on('click', '#slider-competition .owl-item', function(e) {
      sliderCompetition.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });

    // show and play trailer
    $('.poster .picto').on('click', function(e) {
      e.preventDefault();

      $('.main-image').data('height', $('.main-image').height()).height($(window).height() - $('header').height());
      $('.main-image, .poster, .info-film, .nav').addClass('trailer');

      $('html, body').animate({
        scrollTop: 0
      }, 500);
    });

  }

  // 18. All Photos
  // =========================

  function setImages(grid, dom, init){     
    var $img            = $(dom).find('.item:not(.portrait) img'),
        pourcentage     = 0.50,
        nbImgAAgrandir  = $img.length * pourcentage,
        i               = 0,
        nbRamdom        = [],
        x               = 1,
        max             = 0,
        min             = 0,
        nbImage         = $img.length;
    
    while(x<nbImgAAgrandir){
      while(nbImgAAgrandir>nbRamdom.length){
          max = nbImage*pourcentage*x;
          min = nbImage * pourcentage * (x-1);
          nbAlea = Math.floor(Math.random() * (max-min)+min);
          nbRamdom[i] = nbAlea;
          $($img[nbRamdom[i]]).closest('div.item').addClass('w2');    
          i++;
          x++;
      }     
    }
    
    if(!init){
      grid.append( $(dom) ).isotope( 'appended', $(dom) );
      grid.imagesLoaded().progress( function() {
          grid.isotope('layout');
      });
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

    function buildGrid(){
      $($img).closest('div.item').removeClass('w2');
      if (window.matchMedia("(max-width: 1599px)").matches) {
        while(i<$img.length){
          if(j<11){
              if(j==0 || j==3){
                  $($img[i]).closest('div.item').addClass('w2');
              }
              j++;
          }
          if(j==10){
              j=0;
          }        
          i++;
        }
      }
      else if (window.matchMedia("(max-width: 1919px)").matches){
                  
        while(i<$img.length){
          if(j<31){
              if(j==0 || j==3 || j==12 || j==17 || j==25 ){
                  $($img[i]).closest('div.item').addClass('w2');
              }
              j++;
          }
          if(j==30){
              j=0;
          }        
          i++;
        }
      
      }
      else if (window.matchMedia("(min-width: 1920px)").matches){
        while(i<$img.length){
          if(j<16){
              if(j==0 || j==5 ||  j==15){
                  $($img[i]).closest('div.item').addClass('w2');
                  
              }
              j++;
          }
          if(j==10){
              j=0;
          }        
          i++;
        }
      }
    }
    if(!init){
      grid.append( $(dom) ).isotope( 'appended', $(dom) );
      grid.imagesLoaded().progress( function() {
          grid.isotope('layout');
      });
    }
    buildGrid();
  }

  function resizeGrid() {
    var result = document.getElementById('result');
    if("matchMedia" in window) {
        setGrid(false,$('#gridAudios'),true);
    }    
  }

  function closePopinAudio() {
    $('.popin-audio, .ov').removeClass('show');

    $('.popin-audio').find('.wave-container').empty().removeAttr('id');
    $('.popin-audio .playpause').trigger('click');
  }

  if($('.grid').length) {

    if($('#gridPhotos').length) {

      var $container    = $('#gridPhotos'),
          $grid;  

      $grid = $('#gridPhotos').imagesLoaded(function() {
        
        setImages($grid, $('#gridPhotos'),true);
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
		
		 if($('#gridWebtv').length){ 
			 	$grid = $('#gridWebtv').imagesLoaded(function() {

					$grid.isotope({
						layoutMode: 'packery',
						itemSelector: '.item'
					});
				});
    }

    if($('#gridAudios').length) {

      $('.ov').on('click', function(e) {
        e.preventDefault();
        closePopinAudio();
      });

      var $container    = $('#gridAudios'),
          $grid;  

      $grid = $('#gridAudios').imagesLoaded(function() {
        // init Isotope after all images have loaded
        setGrid($grid, $('#gridAudios'),true);
        $grid.isotope({
          itemSelector: '.item',
          percentPosition: true,
          layoutMode: 'packery',
          packery: {
              columnWidth: '.grid-sizer'
          }
        });

        $grid.isotope('layout');

        if($('#gridAudios').data('type') == 'audios') {
          $('body').on('click', '#gridAudios .item', function(e) {

            var s = $(e.target).data('sound'),
                img = $(e.target).find('img').attr('src'),
                category = $(e.target).find('.category').text(),
                date = $(e.target).find('.date').text(),
                text = $(e.target).find('p').text(),
                $popinAudio = $('.popin-audio');
              
            $popinAudio.attr('data-sound', s);
            $popinAudio.find('.image').css('background-image', 'url(' + img + ')');
            $popinAudio.find('.category').text(category);
            $popinAudio.find('.date').text(date);
            $popinAudio.find('p').text(text);
            $popinAudio.addClass('audio-player show');

            initAudioPlayers();
            $('.ov').addClass('show');
          });
        }
      });

      $('#gridAudios').infinitescroll({
        navSelector: "#next:last",
        nextSelector: "#next:last",
        itemSelector: "#gridAudios",
        debug: false,
        dataType: 'html',
        path: function(index) {
          return $('#gridAudios').data('type') + index + ".html";
        }
      }, function(newElements, data, url){ 
        setGrid($grid, newElements,false);

      });
    }

    var filterValues = "";

    // filters     
    $('body').on('click', '#filters span', function() {

      filterValues = "";

      $('.filter .select .active').each(function() {
        if($(this).data('filter') != 'all') {
          filterValues += '.' + $(this).data('filter');
        }
      });
      
      $container.isotope({ filter: filterValues }); 
    });
  }


  // 19. Contact
  // =========================

  if($('.contact').length) {
    // check that fields are not empty
    $('.contact input[type="text"], textarea').on('input', function() {
      var input = $(this);
      var is_name = input.val();
      if(is_name){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
      }

      if($('.invalid').length) {
        $('.errors').addClass('show');
      } else {
        $('.errors').removeClass('show');
      }
    });

    // check valid email address
    $('.contact input[type="email"]').on('input', function() {
      var input=$(this);
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      if(is_email){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
      }

      if($('.invalid').length) {
        $('.errors').addClass('show');
      } else {
        $('.errors').removeClass('show');
      }
    });

    // on submit : check if there are errors in the form
    $('.contact form').on('submit', function() {
      var empty = false;

      $('.contact input[type="text"], .contact input[type="email"], .contact textarea').each(function() {
        if($(this).val() == '') empty = true;
      });

      if($('.invalid').length || empty) {
        return false;
      }
    });
  }
  

  // 20. Webtv
  // =========================

  if($('.webtv').length) {
    // play live player on click
    $('#live .play').on('click', function(e) {
      e.preventDefault();
      $('#live').addClass('on');
    });

    // create slide for trailers
    var sliderTrailers = $("#slider-trailers").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true,
      onInitialized: function() {
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-trailers .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }
    });

    sliderTrailers.owlCarousel();
		
		if($('.webtv-ba-video').length){

			$('.nav li').click(function(){
				if($(this).hasClass('active')){
					
				}else{
					$('.nav').find('.active').removeClass('active');
					$(this).addClass('active');
					
						if($(this).hasClass('infos-film-li')){
							$('.program-film').css({display:'none'});
							$('.infos-film').css({display:'block'});
							console.log(1);
						}else{
							$('.program-film').css({display:"block"});
							$('.infos-film').css({display:"none"});			
							console.log(2);
						}
				}
			})
		}
		
		//ajax
		$('.webtv .sub-nav-list a').on('click',function(e){
			//:not(.active)
			e.preventDefault();

			if($(this).is(':not(.active)')) {
				var urlPath = $(this).attr('href');
				
//				$.get($(this).data('url'), function(data){
				$.get(urlPath, function(data){
						$( ".content-webtv" ).html( $(data).find('.content-webtv') );
					history.pushState('',"titre test", urlPath);
					console.log(data);
				});
				$('.webtv-ba .sub-nav-list').find('a.active').removeClass('active');
				$(this).addClass('active');
			}
		});
  }
	
	    //Slider trailer

    var sliderTrailers = $("#slider-trailer").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      margin: 50,
      center: true,
      autoWidth: true,
      loop: false,
      items: 1,
      onInitialized: function() {
        $('#slider-trailer .owl-stage').css({ 'margin-left': "0px" });
      }
    });

    sliderTrailers.owlCarousel();

    $('body').on('click', '#slider-trailer .owl-item', function(e) {
      sliderTrailers.trigger('to.owl.carousel', [$(this).index(), 400, true]);
    });
	

    
  // 21. FAQ
  // =========================
  if($('.faq').length) {
			//open issue
    $(".faq-container article").click(function(){
        var i;
        i = $(this).find("i.fa");
        if($(this).hasClass("faq-article-active")){
            
						$(this).animate({maxHeight:"100px"},100,function(){
								$(this).removeClass("faq-article-active");
								i.removeClass("fa-minus").addClass("fa-plus");
						});
        }else{
            $(this).addClass("faq-article-active");
            i.removeClass("fa-plus").addClass("fa-minus");
						$(this).animate({maxHeight:"5000px"},300);
        }
    });
		//navigation
			$(".faq-menu li").click(function(){
					var $active;
					var nameActiveSection;
					var $activeSection;
					var $newActiveSection;
					var $newActiveNav;
					var nameNewActiveSection;
					//find active section and name data 
					$active = $('.faq-menu').find("li.active");
					nameActiveSection = $active.data("name");
					$activeSection = $('section[data-name='+nameActiveSection+']');
					nameNewActiveSection= $(this).data("name");
					$newActiveSection = $('section[data-name='+nameNewActiveSection+']');
					$newActiveNav = $('li[data-name='+nameNewActiveSection+']');
					
					if($(this).hasClass("active")){
							
					}else{
							//hide active section
							$activeSection.animate({
									top: "200px",
									opacity:0
							},500,function(){
									$activeSection.css({display:'none'});
									$newActiveSection.css({display:'inline-block'});
									$activeSection.removeClass("faq-active");
									$newActiveSection.addClass("faq-active");
									$active.removeClass("active");
									$newActiveNav.addClass('active');
									$newActiveSection.animate({
											top:0,
											opacity:1
									},500);
							});
					}
			});
		$(window).on('scroll', function() {
				var s = $(window).scrollTop();
				var h = $("#main").height()-900;
			  console.log(h);
			console.log(s);
				if(s < h && s > 50) {
					$(".faq-menu").css({position: "fixed", top: 250});
				} else if(s > h ){
					$(".faq-menu").css({position: "absolute",top:900});
				} else if (s<50){
					$(".faq-menu").css({position: "fixed", top: 393});
				}
		});

  }


  // 22. Newsletter
  // =========================

  $('.newsletter #email').on('focus', function() {
    if($(this).val() == "L'adresse e-mail n'est pas valide" || $(this).val() == "Veuillez saisir une adresse e-mail valide") {
      $(this).val('');
      $(this).removeClass('error');
    }
  });

  // on submit : check if there are errors in the form
  $('.newsletter form').on('submit', function() {

    var input = $('.newsletter #email');
    var empty = false;

    if($('#email').val() == '') {
      empty = true;
      input.addClass("error").val("Veuillez saisir une adresse e-mail valide");
    } else {

      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      if(is_email){
        input.removeClass("error");
      }
      else {
        input.addClass("error").val("L'adresse e-mail n'est pas valide");
      }
    }

    if($('.newsletter .error').length || empty) {
      return false;
    } else {
      // ajax call newsletter

      // show confirmation 
      $('.newsletter form').addClass('hide');
      $('#confirmation span').html($('#email').val());
      $('#confirmation').addClass('show');

      return false;
    }
  });





  $(window).on('resize', function() {
    if($('.home').length) {
      setHeightSlider();
    }
    resizeGrid();
    if($('#prehome-container').length) {
      $('#prehome-container').height($(window).height());
    }
  });
	
	
	
  // 23. Palmares
  // =========================
	if($('.palmares-list').length){
		
			$('.palmares-list .sub-nav-list a').on('click',function(e){
			//:not(.active)
			e.preventDefault();

			if($(this).is(':not(.active)')) {
				var urlPath = $(this).attr('href');
				
//				$.get($(this).data('url'), function(data){
				$.get(urlPath, function(data){
						$( ".container-list" ).html( $(data).find('.container-list') );
					history.pushState('',"titre test", urlPath);
					console.log(data);
				});
				$('.palmares-list .sub-nav-list').find('a.active').removeClass('active');
				$(this).addClass('active');
			}
		});
	}
});