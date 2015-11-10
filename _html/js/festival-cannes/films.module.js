$(document).ready(function() {

// Films
// =========================
  
  if($('.list-article').length){
    
    if($('.nav-list').length){
      
      $(window).on('scroll', function() {
        
        var s = $(window).scrollTop();
        var h = $("#main").height()-900;

      if(s > 470 ){
        
        $('.nav-movie').addClass('sticky');
        $(".nav-movie").css({position: "fixed",top:90});
        
      } else if (s < 470){
        
        $(".nav-movie").css({position: "relative",top:1});
        
      }
      });
    }
  }
    if($('.films-list').length){
    
      $('.films-list .sub-nav-list a').on('click',function(e){

      e.preventDefault();

     if($(this).is(':not(.active)')) {
      var urlPath = $(this).attr('href');

      //$.get($(this).data('url'), function(data){
      $.get(urlPath, function(data){
        var isNav = false ;
        
//        if($(".nav-movie").length){
//          isNav=true;
//        }
        
        $( ".container-list" ).html( $(data).find('.container-list') );
        
//        if(isNav){
//          $(".container-list").find('.nav-movie').remove();
//          console.log('ICI');
//        }
        
        history.pushState('',"titre test", urlPath);
        $grid = $('#gridFilmSelection').imagesLoaded(function() {
          $grid.isotope({
            layoutMode: 'packery',
            itemSelector: '.item'
          });
        });
      });
      $('.films-list .sub-nav-list').find('a.active').removeClass('active');
      $(this).addClass('active');
    }
    });
  }
  
  
//  if($('.selection-officielle').length) {
//    $('.selection-officielle .sub-nav-list a').on('click',function(e){
//
//      e.preventDefault();
//
//      if($(this).is(':not(.active)')) {
//        var urlPath = $(this).attr('href');  
////        $.get($(this).data('url'), function(data){
//        $.get(urlPath, function(data){
//          var isNav = false ;
//
//            if($(".nav-movie").length){
//                isNav=true;
//            }
//          
//            $( ".container-list" ).html( $(data).find('.container-list') );
//          
//            if(isNav){
//              $(".container-list").find('.nav-movie').remove();
//            }
//        
//            history.pushState('',"titre test", urlPath);
//
//        });
//        $('.selection-officielle .sub-nav-list').find('a.active').removeClass('active');
//        $(this).addClass('active');
//      }
//      
//    });
//  }
  
});