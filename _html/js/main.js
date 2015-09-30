//       SUMMARY TABLE     
// =========================
// 1. Main menu
// 2. Slider Home
// 3. News
// 4. Social Wall
// 5. Slider Videos
// 6. Slider Channels
// 7. Slider Movies
// 8. Prefooter
// 9. Slideshow
// 10. Filters
// =========================


// HELPERS ================ //

String.prototype.parseURL = function() {
  return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
    return url.link(url);
  });
};

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

  // 1. Main menu
  // =========================
  $('.main>li').hover(function() {
    $('#main').addClass('overlay');
    $('.main>li').not($(this)).addClass('fade');
  }, function() {
    $('#main').removeClass('overlay');
    $('.main li').removeClass('fade');
  });

  var displayed = false,
      graphRendered = false;

  if($('.home').length) {

    // 2. Slider Home
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

    // 3. News
    // =========================

    // 4. Social Wall
    // =========================

    // GRAPH SVG
    

    var s = Snap('#graphSVG');
  
    var points = [50,60,50,45,70,50,100,120,70,80,90,70],
        heightGraph = 200;
    
    function makeGrid(){
      
      var dataLength = points.length;
      var maxValue = heightGraph;
      var minValue = 35;
      
      // Creates the vertical lines in the graph
      for (var i=0; i<dataLength; i++) {
        var x = i*80;
        var xLine = s.line(x, minValue, x, maxValue).attr({
          stroke: "#000",
          strokeWidth: 0.25,
          strokeDasharray: '1 5'
        });
      }
    }
    
    makeGrid();
    
    
    function convertToPath(points){
      var path = 'M0,' + (heightGraph - points[0]);
      
      for (var i=0; i<points.length; i++){
        var x = i*80;
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
        var defaultPathString = 'M0,'+ graphHeight +' H';
      
        for (var i=0; i<data.length; i++) {
          if (i!==0){ 
            defaultPathString += i*80+' ';
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
      for (var i = 0, length = data.length; i < length; i++) {
        var xPos = i*80;
        var yPos = heightGraph - data[i];
        
        var circle = s.circle(xPos, heightGraph, radius);
        circle.animate({ cy: yPos }, 500);

        circle.attr({
          stroke: '#c8a461',
          strokeWidth: 2,
          fill: '#fff'
        })
      }

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

    // 5. Slider Videos
    // =========================

    var sliderVideos = $("#slider-videos").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      margin: 50,
      center: true,
      autoWidth: true,
      loop: false,
      items: 1
    });

    // 6. Slider Channels
    // =========================
    
    $("#slider-channels").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      loop: false,
      margin: 50,
      autoWidth: true
    });


    // 7. Slider Movies
    // =========================

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

    // 8. Prefooter
    // =========================

    $('#prefooter a').on('click', function(e) {
      e.preventDefault();

      $('.imgSlide, #prefooter a').removeClass('active');
      var i = $(this).parent().index();

      $(this).addClass('active');
      $('.imgSlide').eq(i).addClass('active');
    });


  }

  // 9. Slideshow
  // =========================

  $('.thumbnails').owlCarousel({
    autoWidth: true,
    nav: false,
    dots: false,
    smartSpeed: 500,
    margin: 10
  });

  $('.thumbnails .owl-item').on('click', function(e) {
    e.preventDefault();

    $(this).parents('.slideshow').find('.thumb').removeClass('active');
    $(this).parents('.slideshow').find('.images .img').removeClass('active');

    var i = $(this).index();

    $(this).find('.thumb').addClass('active');
    $('.slideshow-img .images .img').eq(i).addClass('active');
  });

  var slideshow = $('.slideshow .images').Chocolat({
    imageSize: 'cover',
    fullScreen: false
  }).data('chocolat');

  // $('body').on('click', '.chocolat-img', function(e){
  //   slideshow.api().close();
  // });
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

  // 10. Filters
  // =========================

  $('.filters .select span').on('click', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><span class="close-button"></span></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters').addClass('show').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function() {
      $('#filters span').addClass('show');
    }, 400);
  });

  $('body').on('click', '#filters', function() {
    $('#filters').removeClass('show');
  });

  $('body').on('click', '#filters span', function() {
    var id = $('#filters').data('id'),
        i = $(this).index();

    $('#' + id + ' .select span').removeClass('active');
    $('#' + id + ' .select span').eq(i).addClass('active');
  });










  $(window).on('scroll', function() {
    var s = $('body').scrollTop();

    if(s > 50) {
      $('header').addClass('sticky');
    } else {
      $('header').removeClass('sticky');
    }

    if(s > $('#featured-movies').offset().top - $('#featured-movies').height() && s < $('#featured-movies').offset().top + $('#featured-movies').height()) {
      $('#featured-movies .active').find('video')[0].play();
      handleEndVideo();
    } else {
      $('#featured-movies .active').find('video')[0].pause();
    }

    if(s > $('#social-wall').offset().top - ($(window).height()/2) && !displayed) {
      displayGrid();
    }

    if(s > $('#graph').offset().top - ($(window).height()/2) && !graphRendered) {
      makePath(points);
    }

    if(s > $('#news').offset().top + 50 && s < $('#social-wall').offset().top - 600) {
      $('#timeline').addClass('stick').css('left', $('.content-news').offset().left + $('.content-news').width() + 60);
    } else {
      $('#timeline').removeClass('stick').css('left', 'auto');
    }


  });

});