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
          console.log(data);
        });
        $('.palmares-list .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });
  }
    if($('.films-list').length){
    
      $('.films-list .sub-nav-list a').on('click',function(e){
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');
        
//        $.get($(this).data('url'), function(data){
        $.get(urlPath, function(data){
            $( ".container-list" ).html( $(data).find('.container-list') );
          history.pushState('',"titre test", urlPath);
          console.log(data);
        });
        $('.films-list .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });
  }
});