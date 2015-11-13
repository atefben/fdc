// Palmares
// =========================

$(document).ready(function() {

  if($('.palmares-list').length){
    
      $('.palmares-list .sub-nav-list a').on('click',function(e){
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');
        
//        $.get($(this).data('url'), function(data){
        $.get(urlPath, function(data){
            $( ".container-list" ).html( $(data).find('.container-list') );
          history.pushState('',"titre test", urlPath);
        });
        $('.palmares-list .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });
  }

});