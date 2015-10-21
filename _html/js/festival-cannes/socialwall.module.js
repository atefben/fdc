// selection of points for the graph
var points = [50,60,50,45,70,50,100,120,70,80,90,70],
    heightGraph = 200,
    posts = [],
    s = null;


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

  path.animate({ path: pathString }, 900, mina.easeinout);

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
  }, 900);

  graphRendered = true;
  
}

 function makeGrid(){
  
  var dataLength = points.length;
  var maxValue = heightGraph;
  var minValue = 35;

  s = Snap('#graphSVG');
  
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

$(document).ready(function() {

  if($('.home').length) {

  // Social Wall
  // =========================

  // GRAPH SVG

  makeGrid();


  // INSTAGRAM
  var access_token = "18360510.5b9e1e6.de870cc4d5344ffeaae178542029e98b",
      hashtag = "Cannes2016";

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

});