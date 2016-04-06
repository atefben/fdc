// Main menu
// =========================

var displayed = false,
    graphRendered = false;

$(document).ready(function() {

  $('body').addClass('mob');

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

  $('.main>li>a, .user>li>a').on('click', function(e) {
    console.log($(this).parent().find('ul').length);
    if($('body').hasClass('mob')) {
      if($(this).parent().find('ul').length != 0) {
        e.preventDefault();
        $('#main, footer').addClass('overlay');
        $('.main>li').not($(this).parent()).addClass('fade');
        return false;
      }
    }
  });

});