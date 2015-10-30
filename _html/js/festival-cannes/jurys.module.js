// Palmares
// =========================

$(document).ready(function() {

  if($('.jurys-list').length){    
  $('.jurys-list .sub-nav-list a').on('click',function(e){
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');
        
//        $.get($(this).data('url'), function(data){
        $.get(urlPath, function(data){
            $( ".container-jurys" ).html( $(data).find('.container-jurys') );
            history.pushState('',"titre test", urlPath);
             $grid = $('#gridJurys').imagesLoaded(function() {
                $grid.isotope({
                  layoutMode: 'packery',
                  itemSelector: '.item'
                });
             });
        });
        $('.jurys-list .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });
  }
});