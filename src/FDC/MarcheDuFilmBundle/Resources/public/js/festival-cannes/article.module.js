// Single Article
// =========================
$(document).ready(function() {

  if($('.single-article').length) {

    if($('#canvasloader').length) {
      var cl = new CanvasLoader('canvasloader');
          cl.setColor('#ceb06e');
          cl.setDiameter(20);
          cl.setDensity(34);
          cl.setRange(0.8);
          cl.setSpeed(1);
          cl.setFPS(60);
    }

    // scroll to 'share' section
    $('#share-article').on('click', function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $(".share").offset().top - $('header').height() - $('.share').height()
      }, 500);
    });


  }
});
