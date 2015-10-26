$(document).ready(function() {
  var cl = new CanvasLoader('siteLoader');
      cl.setColor('#ceb06e');
      cl.setDiameter(20);
      cl.setDensity(34);
      cl.setRange(0.8);
      cl.setSpeed(1);
      cl.setFPS(60);

  cl.show();
  $('#siteLoader').addClass('show');

  setTimeout(function() {
    $('#siteLoader').removeClass('show');
  }, 800);

  setTimeout(function() {
    $('#main').removeClass('loading');
    cl.hide();
  }, 1100);

  $('body').on('click', "a[target!='_blank']", function(e) {
    var href = $(this).attr('href');
    e.preventDefault();

    if(href.indexOf('#') == -1) {

      $('#main').addClass('loading');

      setTimeout(function() {
        cl.show();
        $('#siteLoader').addClass('show');
      }, 1100);

      setTimeout(function() {
        window.location = href;
      }, 1600);
    }

    return false;
  });
});