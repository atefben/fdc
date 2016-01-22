// Main menu
// =========================

var displayed = false,
    graphRendered = false;

$(document).ready(function() {
    
  // overlay on main menu : show submenu and overlay
  if(!$('body').hasClass('mob')) {
    $('.main>li, .user>li').hover(function() {
      $('#main, footer').addClass('overlay');
      $('.main>li').not($(this)).addClass('fade');
    }, function() {
      if(!$('#selection').hasClass('open') && !$('#searchContainer').hasClass('open')) {
        $('#main, footer').removeClass('overlay');
      }
      $('.main li').removeClass('fade');
    });
  }

  if($('body').hasClass('mob')) {
    $('.main>li>a, .user>li>a').on('click', function(e) {
      if($(this).parent().find('ul').length != 0) {
        $('#main, footer').addClass('overlay');
        $('.main>li').not($(this).parent()).addClass('fade');
        return false;
      }
    });
  }

});