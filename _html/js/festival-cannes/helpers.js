// HELPERS ================ //

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

// is iPad
function isiPad() {
  return navigator.userAgent.indexOf("iPad") > -1 ||
         navigator.userAgent.indexOf("iPhone") > -1 ||
         navigator.userAgent.indexOf("Android") > -1
}

//
String.prototype.trunc = function( n, useWordBoundary ){
  var isTooLong = this.length > n,
      s_ = isTooLong ? this.substr(0,n-1) : this;
  s_ = (useWordBoundary && isTooLong) ? s_.substr(0,s_.lastIndexOf(' ')) : s_;
  return  isTooLong ? s_ + '...' : s_;
};
