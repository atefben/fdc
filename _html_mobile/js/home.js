// parse URL in string
String.prototype.parseURL = function() {
  return this.replace(/[A-Za-z]+:\/\/[A-Za-z0-9-_]+\.[A-Za-z0-9-_:%&~\?\/.=]+/g, function(url) {
    return '<strong>' + url + '</strong>';
  });
};

// parse twitter username in String
String.prototype.parseUsername = function(twitter) {
  return this.replace(/[@]+[A-Za-z0-9-_]+/g, function(u) {
    var username = u;
    return '<strong>' + username + '</strong>';
  });
};

// parse Twitter hashtag in String
String.prototype.parseHashtag = function(twitter) {
  return this.replace(/[#]+[A-Za-z0-9-_]+/g, function(t) {
    var tag = t.replace("#","%23")
    return '<strong>' + t + '</strong>';
    
  });
};

function moveTimeline(element, day,url){
  var numDay = 0;

  if(day == 11) {
    numDay = 0;
  } else if(day == 22) {
    numDay = 9
  } else {
    numDay = day - 12;
  }

  $('#timeline .timeline-container').css('left', - numDay * 130 + 'px');
  $('#timeline a').removeClass('active');
  element.addClass('active');
  
  $('.articles-container').animate({
    opacity: 0
  }, 500, function() {
    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url:url,
      success: function(data) {
        $('.articles-container').html(data);
        initAddToSelection();
        initSlideshows();
        $('.articles-container').animate({
          opacity: 1
        }, 500);
      }
    });
  });
}

function setActiveThumbnail() {
  $('.thumbnails .owl-item').removeClass('center');
  $('.thumbnails .owl-item.active').first().addClass('center');
  if($('.thumbnails .owl-item.center').index() >= $('.thumbnails .owl-item').length - 4) {
    $('.thumbnails .owl-item').last().addClass('center');
  }
}

function initSlideshows() {
  // create slider of thumbs
  var nbItems = $('.single-article').length != 0 ? 7 : 8;
  var sliderThumbs = $(".thumbnails").owlCarousel({ 
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

  sliderThumbs.owlCarousel();

  $('.thumbnails .owl-item').on('click', function(e) {
    e.preventDefault();

    $(this).parents('.slideshow').find('.thumb').removeClass('active');
    $(this).parents('.slideshow').find('.images .img').removeClass('active');

    var cap = $(this).find('.thumb').data('caption'),
        i   = $(this).index();

    $(this).find('.thumb').addClass('active');
    $(this).parents('.slideshow').find('.title').html(cap);
    $(this).parents('.slideshow').find('.caption').html(cap);
    $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
  });

  // init slideshow
  initSlideshow();
}

  
var posts = [];

// load Instagram pictures and build array
function loadInstagram(callback) {
  if (GLOBALS.env == "html") {
    instagramDatatype = "jsonp";
    instagramRequest  = {};
  } else {
    instagramDatatype = "json";
    instagramRequest  = {
      offset : 40
    }
  }
  
  $.ajax({
    url      : GLOBALS.api.instagramUrl,
    type     : "GET",
    data     : instagramRequest,
    dataType : instagramDatatype,
    success: function(data) {
      var count = 10; 
      for (var i = 0; i < count; i++) {
        if (typeof data.data[i] !== 'undefined' ) {
          posts.push({'type': 'instagram', 'img': data.data[i].images.standard_resolution.url, 'date' : data.data[i].created_time, 'text': '<div class="vCenter text-container"><div class="vCenterKid content"><p class="text">' + data.data[i].caption.text.substr(0, 140).parseURL().parseUsername().parseHashtag() + '</p></div></div>', 'user': data.data[i].user.username});
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
  if (GLOBALS.env == "html") {
    twitterUrl     = "twitter.php";
    twitterType    = "POST";
    twitterRequest = {
      q     : "%23Cannes2016",
      count :  15,
      api   :  "search_tweets"
    };
  } else {
    twitterUrl     = GLOBALS.api.twitterUrl;
    twitterType    = "GET";
    twitterRequest = {
      offset : 40
    };
  }

  $.ajax({
    url  : twitterUrl,
    type : twitterType,
    data : twitterRequest,
    success: function(data, textStatus, xhr) {
      data = JSON.parse(data);
      data = data.statuses;
      var img = '';

      for (var i = 0; i < data.length; i++) {
        img = '',
        url = 'http://twitter.com/' + data[i].user.screen_name + '/status/' + data[i].id_str;
        try {
          if (data[i].entities['media']) {
            img = data[i].entities['media'][0].media_url;
          }
        } catch (e) {
          // no media
        }
        var textTweet = data[i].text.parseURL().parseUsername(true).parseHashtag(true);
        if (textTweet.length>180) {
          textTweet = (textTweet.substr(0, 180) + "...");
      }
        posts.push({'type': 'twitter', 'text': '<div class="vCenter text-container"><div class=" content vCenterKid"><p class="text">' + textTweet + '</p></div></div>', 'name': data[i].user.screen_name, 'img': img, 'url': url, 'date': data[i].created_at})

        if(i==data.length - 1) {
          callback();
        }
      }
    }
  });
}

function shuffle(o){  
  for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
  return o;
}

$(document).ready(function() {
  // load more
  $('.read-more').on('click', function(e) {
    e.preventDefault();

    $('#timeline').removeClass('bottom');
    // load previous day
    if($(this).hasClass('prevDay')) {
      $('.read-more').html( GLOBALS.texts.readMore.more ).removeClass('prevDay');
      var day = $('.timeline-container').find('.active').data('date');

      if(day == 11) {
        return false;
      } else {
        var url =  "more-news.html";
        moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1, url);
      }

      $('html, body').animate({
        scrollTop: 750
      }, 500);
    } else {
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: GLOBALS.urls.newsUrlNext , 
        success: function(data) {
            $('.articles-container').append(data);
            $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
            initAddToSelection();

        }
      });
    }
  });

  // init timeline
  moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'), 'news.html');

  $('#timeline a').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
      return false;
    }
    var url =  GLOBALS.urls.newsUrl;
    moveTimeline($(this), $(this).data('date'),url);
  });

  $('#news #calendar .prev').on('click',function(e) {
    e.preventDefault();

    var day = $('.timeline-container').find('.active').data('date');

    if(day == 11) {
      return false;
    } else {
      var url =  GLOBALS.urls.newsUrl ;
      moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1, url);
    }
  });

  $('#news #calendar .next').on('click',function(e) {
    e.preventDefault();

    var day    = $('.timeline-container').find('.active').data('date'), 
        numDay = 0;

    if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')) {
      return false;
    } else {
      var url =  GLOBALS.urls.newsUrl;
      moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1, url);
    }
  });
  

  loadInstagram(function() {
    loadTweets(function() {
      shuffle(posts);
      // once all data is loaded, build html and display the grid
      $('.post-container').html('');
      for (var i = 0; i < 6; ++i){
        var noPhoto = "";
        if(posts[i].img ==""){
          noPhoto = "show-text always-show";
        }
        var html = '<div class="post '+noPhoto+'"><div class="'+posts[i].type+'" ><div class="img-container" style="background-image:url('+posts[i].img+')"></div>'+posts[i].text+'<i class="icon icon_'+posts[i].type+'"></i></div></div>';
        $('.post-container').append(html);
      }
      
      $('.post').on('click',function(){
        if($(this).hasClass('always-show')) {
          return false;
        } else if($(this).hasClass('show-text')) {
          $(this).removeClass('show-text');
        } else {
          $('.post').removeClass('show-text');
          $('.always-show').addClass("show-text");
          $(this).addClass('show-text')
        }
      });
    });
  });
});