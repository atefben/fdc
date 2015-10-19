$(document).ready(function() {

  // Prehome
  // =========================

  if($('.home').length) {

    // if cookie doesn't exist
    if(!$.cookie('prehome')) {
      // set height and display prehome
      $('#prehome-container').height($(window).height());
      $('#prehome').addClass('show');

      // scroll and remove prehome
      setTimeout(function() {
        $('html, body').animate({
          scrollTop: $("header").offset().top
        }, 800, function() {
          $('#prehome-container').remove();
          $('body,html').scrollTop(0);
        });
      }, 3000);
      $.cookie('prehome', '1', { expires: 7 });
    } else {
      // remove prehome, we don't need to see it
      $('#prehome-container').remove();
    }
  }

});