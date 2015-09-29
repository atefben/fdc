//       SUMMARY TABLE     
// =========================
// 1. Main menu
// 2. Slider Home
// 3. News
// 4. Social Wall
// 5. Slider Videos
// 6. Slider Channels
// 7. Slider Movies
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

  var displayed = false;
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

    if(s > $('#social-wall').offset().top - 400 && !displayed) {
      displayGrid();
    }
  });


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

  }

});