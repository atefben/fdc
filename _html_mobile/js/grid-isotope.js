$(document).ready(function() {
  if($('.grid').length > 0) {
    $('.grid').isotope({
      layoutMode: 'packery',
      itemSelector: '.grid-item'
    });
  }
});