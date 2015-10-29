$(document).ready(function() {

// Films
// =========================
  
  if($('.list-article').length){
    
    if($('.nav-list').length){
      
      $(window).on('scroll', function() {
        
        var s = $(window).scrollTop();
        var h = $("#main").height()-900;
        console.log(s);
      if(s > 250 ){
        
        $('.nav-movie').addClass('sticky');
        $(".nav-movie").css({position: "fixed",top:90});
        
      } else if (s < 250){
        
        $(".nav-movie").css({position: "relative",top:1});
        
      }
      });
    }
  }

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