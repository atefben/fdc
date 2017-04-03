// Palmares
// =========================
$(document).ready(function() {
  if($('.palmares-list').length) {
      $('.palmares-list .sub-nav-list a').on('click',function(e) {
      //:not(.active)
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');

        $.get(urlPath, function(data) {
          var matches = data.match(/<title>(.*?)<\/title>/);
          var spUrlTitle = matches[1];

          document.title = spUrlTitle;
          $( ".container-list" ).html($(data).find('.container-list').html());
          $('.bandeau-head').html($(data).find('.bandeau-head'));
          $('.push-footer').html($(data).find('.push-footer').html());
          history.pushState('',GLOBALS.texts.url.title, urlPath);
        });
        
        $('.palmares-list .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });

    //Scroll
    $(window).on('scroll', function() {
      var s = $(window).scrollTop(),
          h = $("#main").height()-900;

      if(s > 470 ) {
        $('.sub-nav-list').addClass('sticky');
        $(".sub-nav-list").css({position: "fixed",top:90});
      } else if (s < 470) {
        $(".sub-nav-list").css({position: "relative",top:1});
      }
    });
  }
});