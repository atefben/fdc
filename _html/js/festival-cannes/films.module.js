// Films
// =========================
$(document).ready(function() {
  if($('.list-article').length) {
    if($('.nav-list').length) {
      $(window).on('scroll', function() {
        var s = $(window).scrollTop();
        var h = $("#main").height()-900;

        if($('.nav-movie').length) {
          if(s > 343 ) {
            $('.nav-list.sub-nav-list').removeClass('sticky');
            $(".sub-nav-list").css({position: "relative",top:1});
            $('.nav-movie').addClass('sticky');
            $(".nav-movie").css({position: "fixed",top:90});
          } else if (s < 343) {
            $(".nav-movie").css({position: "relative",top:1});
            $(".sub-nav-list").css({position: "relative",top:1});
          }
        } else {
          if(s > 299 ) {
            $('.nav-list.sub-nav-list').addClass('sticky');
            $(".nav-list.sub-nav-list").css({position: "fixed",top:90});
            $('.nav-movie').addClass('sticky');
            $(".nav-movie").css({position: "fixed",top:137});
          } else if (s < 299 ) {
            $(".nav-movie").css({position: "relative",top:1});
            $(".sub-nav-list").css({position: "relative",top:1});
          }
        }
      });
    }
  }
  
  if($('.films-list').length) {
    function ajaxEvent() {
      $('.films-list .sub-nav-list a').on('click',function(e){
        e.preventDefault();
        
        if($(this).is(':not(.active)')) {
          var urlPath = $(this).attr('href');
          
          $.get(urlPath, function(data){
            document.title = $(data).filter('title').text();
            $( ".container-list" ).html( $(data).find('.container-list') );
            $( ".bandeau-list-footer" ).html( $(data).find('.bandeau-list-footer').html() );
            $( ".bandeau-head" ).html( $(data).find('.bandeau-head') );
            history.pushState('',GLOBALS.texts.url.title, urlPath);
            $grid = $('#gridFilmSelection').imagesLoaded(function() {
              $grid.isotope({
                layoutMode: 'packery',
                itemSelector: '.item'
              });
            });
            initAudioPlayers();
            ajaxEvent();
            resizeGrid();
          });
          $('.films-list .sub-nav-list').find('a.active').removeClass('active');
          $(this).addClass('active');
        }
      });
        initSlideshows();
    }
    ajaxEvent();
  }
});
