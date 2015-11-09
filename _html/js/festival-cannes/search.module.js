function closeSearch() {
  $('#main, footer').removeClass('overlay');
  $('#searchContainer').removeClass('open');
  $('.search').removeClass('opened');
}

$(document).ready(function() {

  // Search
  // =========================

  function openSearch() {
    $('#main, footer').addClass('overlay');
    $('#searchContainer').addClass('open');
  }  

  $('.search').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('opened')) {
      closeSearch();
    } else {
      openSearch();
    }

    $('.search').toggleClass('opened');
  });

});