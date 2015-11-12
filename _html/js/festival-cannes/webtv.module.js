$(document).ready(function() {

// Webtv
// =========================

  if($('.webtv').length) {
    
  
    if($('.webtv-live').length) {
     // play live player on click
     $('#live .play').on('click', function(e) {
       e.preventDefault();
       $('#live').addClass('on');
       //$('#live .img').addClass('rePosition');
       $('#live').data('height', $('#live').height()).height($(window).height() - 91);
       $('#main').css('padding-top', '91px');
       $('body').css('padding-top', 0);
       setTimeout(function() {
          $('header').addClass('sticky');
        }, 800);
     });

     setTimeout(function() {
      $('#live .textLive').css('top', $('header').height() + ($('#live').height() - $('#live .textLive').height()) / 2);
      }, 500);

     if($('header').hasClass('sticky')) {
      $('.webtv #live .img').css('top', '-10%');
     }
    }

   // create slide for trailers
   var sliderTrailers = $("#slider-trailers").owlCarousel({
     nav: false,
     dots: false,
     smartSpeed: 500,
     center: true,
     loop: false,
     margin: 50,
     autoWidth: true,
     onInitialized: function() {
       $('#slider-trailers .owl-stage').css({ 'margin-left': "-172px" });
     }
   });

   sliderTrailers.owlCarousel();
//    
  $("#slider-trailer").owlCarousel({
      nav: false,
      dots: false,
      smartSpeed: 500,
      center: true,
      autoWidth: true,
      loop: false,
      items: 1,
//      onInitialized: function() {
//        var v = ($(window).width() - 977) / 2 + "px";
//        $('#slide-artist .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
//      }
    });
    
    
if($('.webtv-ba-video').length){

      $('.nav li').click(function(){
        if($(this).hasClass('active')){
          
        }else{
          $('.nav').find('.active').removeClass('active');
          $(this).addClass('active');
          
            if($(this).hasClass('infos-film-li')){
              $('.program-film').css({display:'none'});
              $('.infos-film').css({display:'block'});
              console.log(1);
            }else{
              $('.program-film').css({display:"block"});
              $('.infos-film').css({display:"none"});     
              console.log(2);
            }
        }
      })
    }
    
    //ajax
    $('.webtv .sub-nav-list a').on('click',function(e){
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');
        
//        $.get($(this).data('url'), function(data){
        $.get(urlPath, function(data){
            $( ".content-webtv" ).html( $(data).find('.content-webtv') );
          history.pushState('',"titre test", urlPath);
            $grid = $('#gridWebtv').imagesLoaded(function() {
              $grid.isotope({
                layoutMode: 'packery',
                itemSelector: '.item'
              });
            });
        });
        $('.webtv-ba .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });
    
    $('.item').click(function(){
      var url = $(this).find('.vCenterKid a').attr('href');
      document.location.href = url ;
    });
    
  }
  
//      //Slider trailer
//
//    var sliderTrailers = $("#slider-trailer").owlCarousel({
//      nav: false,
//      dots: false,
//      smartSpeed: 500,
//      margin: 50,
//      center: true,
//      autoWidth: true,
//      loop: false,
//      items: 1,
//      onInitialized: function() {
//        $('#slider-trailer .owl-stage').css({ 'margin-left': "0px" });
//      }
//    });
//
//    sliderTrailers.owlCarousel();
//
//    $('body').on('click', '#slider-trailer .owl-item', function(e) {
//      sliderTrailers.trigger('to.owl.carousel', [$(this).index(), 400, true]);
//    });
  //infinite scroll
//  if($('.webtv-ba-video').length){
//    $('.webtv-ba-video').infinitescroll({
//      navSelector: "#next:last",
//      nextSelector: "#next:last",
//      itemSelector: ".listtrailer",
//      debug: false,
//      dataType: 'html',
//      path: function(index) {
//      return $('.listtrailer').data('type') + webtv_trailer_competition + ".php";
//    }
//    }, function(newElements, data, url){ 
//      setGrid($grid, newElements,false);
//    });
//  }
  

});