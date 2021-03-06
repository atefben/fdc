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

// selection of points for the graph
var posts = [],
    s = null;

function convertToPath(points) {
  var maxPoint = Math.max.apply(null, points);
  var path = 'M4,' + (GLOBALS.socialWall.heightGraph - (160*points[0]) / maxPoint);
  
  for(var i=0; i<points.length; i++){
    var x = i*80 + 4;
    var y = -((160*points[i]) / maxPoint)+GLOBALS.socialWall.heightGraph;
    if(i===0) {
      path += 'L'+x+','+y+' ';
    } else if (i===points.length-1){
      path += x+','+y;
    } else {
      path += x+','+y+',';
    }
  }
  return path;
}

function makePath(data) {
  var pathString  = convertToPath(data),
      graphHeight = $('#graph').height(),
      maxPoint    = Math.max.apply(null, data);
  
  function getDefaultPath(){
    var defaultPathString = 'M4,'+ (graphHeight - 30) +' H';
  
    for(var i=0; i<data.length; i++) {
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
  
  path.animate({ path: pathString }, 2000, mina.easeInOutQuint);

  /* point radius */
  var radius = 2;
  
  /* iterate through points */
  setTimeout(function() {
    for (var i = 0, length = data.length; i < length; i++) {
      var xPos = i*80 + 4;
      var yPos = GLOBALS.socialWall.heightGraph - (160*data[i]) / maxPoint;      
      var circle = s.circle(xPos, yPos, radius);
      var circle2 = s.circle(xPos, yPos, 15);

      circle.attr({
        stroke: '#c8a461',
        strokeWidth: 2,
        fill: '#fff',
        opacity: 0
      });

      circle2.attr({
        strokeWidth: 2,
        opacity: 0,
        title: data[i]
      });

      circle.animate({opacity: 1}, 300);

      circle2.mouseover(function() {
        $('#tipGraph').text($(this)[0].attr('title'));
        $('#tipGraph').css({
          top: parseInt($(this)[0].attr('cy')) - 25 + "px",
          left: $('#hashtag').width() + parseInt($(this)[0].attr('cx') - 15) + "px"
        });
        $('#tipGraph').addClass('show');
      });

      if($('.mob').length) {
        var top =  parseInt(yPos) - 25;
        var left = $('#hashtag').width() + parseInt(xPos) - 15;
        $('#graph').append('<div id="tipGraph" class="show" style="top:' + top + 'px;left:' + left + 'px;">' + data[i] + '</div>');
      }

      circle2.mouseout(function() {
        $('#tipGraph').removeClass('show');
      });
    }

    var j = $('#graph ul li.active').index();
    $('#graph circle[stroke="#c8a461"]').eq(j).attr('r', 5).css('stroke-width', '3');
  }, 2000);

  graphRendered = true;
}

function makeGrid() {
  var dataLength = GLOBALS.socialWall.points.length;
  var maxValue = GLOBALS.socialWall.heightGraph;
  var minValue = 35;

  s = Snap('#graphSVG');

  // Creates the vertical lines in the graph
  for(var i = 0; i < dataLength; i++) {
    var x = 4 + i * 80;
    var xLine = s.line(x, minValue, x, maxValue).attr({
      stroke: "#000",
      strokeWidth: 0.25,
      strokeDasharray: '1 5'
    });
  }
}

function displayGrid() {
  $('.post').not('.big.right').each(function(i) {
    var $p = $(this);
    setTimeout(function() {
      $p.find('.side').addClass('flip');
    }, i*50);
  });

  setTimeout(function() {
    $('.big.right').find('.side').addClass('flip');
  }, 800);

  displayed = true;

  // randomly display new posts
  var p = $('.post .side-2');

  for(var i = 0; i < posts.length; ++i) {
    setTimeout(function() {
      var r = Math.floor(Math.random() * p.length);
      var c = p.splice(r, 1)[0];

      var random = Math.floor(Math.random() * posts.length);
      var item = posts.splice(random, 1)[0];

      $(c).prev().addClass(item.type).removeClass('hasimg');
      $(c).parent().find('.side-2').addClass('overlay');
      $(c).parent().find('.side').removeClass('flip');
      $(c).parent().find('.side-1').css('z-index', '5');
      
      if(item.img) {
        $(c).prev().addClass('hasimg').css('background-image', 'url(' + item.img + ')');
      }
      $(c).prev().append(item.text);
    }, (i+1) * 5000);
  }
}

$(document).ready(function() {
  if($('.home').length) {

    // Social Wall
    // =========================
    // GRAPH SVG
    if(GLOBALS.socialWall.points.length > 0 && $('#graph').length > 0) {
      makeGrid();
    }

    // INSTAGRAM
    // load Instagram pictures and build array
    function loadInstagram(callback) {
      if (GLOBALS.env == "html") {
        instagramDatatype = "json";
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

          if (GLOBALS.env == "html") {
            var count = 15; 
            for (var i = 0; i < count; i++) {
              if (typeof data.data !== 'undefined' ) {
                if (typeof data.data[i] !== 'undefined' ) {
                  posts.push({'type': 'instagram', 'img': data.data[i].images.low_resolution.url, 'date' : data.data[i].created_time, 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data.data[i].caption.text.substr(0, 140).parseURL().parseUsername().parseHashtag() + '</p></div></div></div>', 'user': data.data[i].user.username});
                }
              }
             
              if(i == count - 1) {
                callback();
              }
            }
          } else {
            var count = Math.min(data.length, 15);
            for (var i = 0; i < count; i++) {
              posts.push({'type': 'instagram', 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data[i].message.substr(0, 140).parseURL().parseUsername(true).parseHashtag(true) + '</p></div></div></div>', 'img': data[i].content});

              if(i == count - 1) {
                callback();
              }
            }
          }
        },
        error: function (xhr, ajaxOptions, thrownError) {

        }
      });
    }

    // TWITTER
    // load Twitter posts and pictures and build array
    function loadTweets(callback) {
      var twitterRequest, twitterUrl, twitterType;
      
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
          if (GLOBALS.env == "html") {
            data = JSON.parse(data)
            if (typeof data.statuses !== 'undefined') {
              data = data.statuses;
            }

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
              
              if(i == data.length - 1) {
                callback();
              }
            }
          } else {
            var img = '';

            for (var i = 0; i < data.length; i++) {
              img = '';
              try {
                if (data[i].content) {
                  img = data[i].content;
                }
              } catch (e) {
                // no media
              }
            
              posts.push({'type': 'twitter', 'text': '<div class="txt"><div class="vCenter"><div class="vCenterKid"><p>' + data[i].message.parseURL().parseUsername(true).parseHashtag(true) + '</p></div></div></div>', 'img': img})

              if(i == data.length - 1) {
                callback();
              }
            }
          }
        }
      });
    }

    loadInstagram(function() {
      loadTweets(function() {
        // once all data is loaded, build html and display the grid
        var p = $('.post:not(.empty) .side-2');
        var number = Math.min(posts.length, 12);
        for(var i = 0; i < number; ++i) {
          var random = Math.floor(Math.random() * posts.length);
          var item = posts.splice(random, 1)[0];
          var r = Math.floor(Math.random() * p.length);
          var c = p.splice(r, 1)[0];

          $(c).addClass(item.type);
          $(c).addClass('flip');
          if(item.img && item.img != '#') {
            $(c).addClass('hasimg').css('background-image', 'url(' + item.img + ')');
          }
          item.text = item.text.replace(/href="*"/g, 'href="#" onclick="return false;"');
          $(c).append(item.text);
          $(c).append('<span class="ov"></span>');
        }
      });
    });
  }
});