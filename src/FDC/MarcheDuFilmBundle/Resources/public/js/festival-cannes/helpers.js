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

// Get the size of an object
Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

window.requestAnimFrame = (function(){
  return  window.requestAnimationFrame       ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame    ||
          window.oRequestAnimationFrame      ||
          window.msRequestAnimationFrame     ||
          function(/* function */ callback, /* DOMElement */ element){
            window.setTimeout(callback, 1000 / 60);
          };
})();

// is IE Browser
function isIE() {
  return navigator.userAgent.indexOf("Edge") > -1 ||
         navigator.userAgent.indexOf("MSIE") > -1 ||
         navigator.userAgent.indexOf("Trident") > -1
}

// is FF Browser
function isFF() {
  return navigator.userAgent.toLowerCase().indexOf('firefox') > -1
}

// is iPad
function isiPad(only) {
  var only = only || false;
  if (only) {
    return navigator.userAgent.indexOf("iPad");
  } else {
    return navigator.userAgent.indexOf("iPad") > -1 ||
           navigator.userAgent.indexOf("iPhone") > -1 ||
           navigator.userAgent.indexOf("Android") > -1 ;
  }
}

// Renvoie un UID unique
function guid() {
  return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
  function s4() {
    return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
  }
}

function getCookie(name) {
  var cookieValue = document.cookie;
  var cookieArray = cookieValue.split("; ");
  return cookieArray.indexOf(name);
}

String.prototype.trunc = function( n, useWordBoundary ){
  var isTooLong = this.length > n,
      s_ = isTooLong ? this.substr(0,n-1) : this;
  s_ = (useWordBoundary && isTooLong) ? s_.substr(0,s_.lastIndexOf(' ')) : s_;
  return  isTooLong ? s_ + '...' : s_;
};


// Disable window.console
if (GLOBALS.env == "prod") {
  console.log =
  console.info =
  console.error =
  console.warn =
  console.trace = function() {}
}