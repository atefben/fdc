// Main menu
// =========================

var displayed = false,
    graphRendered = false;

$(document).ready(function() {
    
  // overlay on main menu : show submenu and overlay
  $('.main>li, .user>li').hover(function() {
    $('#main').addClass('overlay');
    $('.main>li').not($(this)).addClass('fade');
  }, function() {
    if(!$('#selection').hasClass('open')) {
      $('#main').removeClass('overlay');
    }
    $('.main li').removeClass('fade');
  });

});