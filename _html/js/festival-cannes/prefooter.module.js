$(document).ready(function() {

  if($('.home').length) {

  // Prefooter
  // =========================

    // show image on mouseover
    $('#prefooter a').on('mouseover', function(e) {
      e.preventDefault();

      $('.imgSlide, #prefooter a').removeClass('active');
      var i = $(this).parent().index();

      $(this).addClass('active');
      $('.imgSlide').eq(i).addClass('active');
    });
  }

});