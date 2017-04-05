// Main menu
// =========================
var displayed     = false,
    graphRendered = false;

$(document).ready(function() {
	jQuery("img.lazy").lazyload();
  // overlay on main menu : show submenu and overlay
  if(isiPad()) {
    $('body').addClass('tablet');
  }
  if(!$('body').hasClass('mob') &&  !isiPad()) {
    $('.main>li, .user>li').hover(function() {
      //$('#main, footer').addClass('overlay');
      //$('.main>li').not($(this)).addClass('fade');
    }, function() {
      if(!$('#selection').hasClass('open') && !$('#searchContainer').hasClass('open')) {
        //$('#main, footer').removeClass('overlay');
      }
      //$('.main li').removeClass('fade');
    });
  }

  $('.main>li>a, .user>li>a').on('click touchstart', function(e) {
    if($('body').hasClass('mob')) {
      if($(this).parent().find('ul').length != 0) {
        e.preventDefault();
        if(!isiPad()) {
          //$('#main, footer').addClass('overlay');
          //$('.main>li').not($(this).parent()).addClass('fade');
        }
        return false;
      }
    }
  });
});