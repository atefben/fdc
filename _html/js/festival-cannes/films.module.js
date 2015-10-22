$(document).ready(function() {

// Films
// =========================

  if($('.selection-officielle').length) {
    $('.selection-officielle .sub-nav-list a').on('click',function(e){
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');
        
//        $.get($(this).data('url'), function(data){
        $.get(urlPath, function(data){
            $( ".container-list" ).html( $(data).find('.container-list') );
            history.pushState('',"titre test", urlPath);
            $grid = $('#gridFilmSelection').imagesLoaded(function() {
              $grid.isotope({
                layoutMode: 'packery',
                itemSelector: '.item'
                });
            });
        });
        $('.selection-officielle .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
      
    });
  }
});