// 1. Jurys
// 2. Artist Page
// =========================

$(document).ready(function() {
  //1. Jury
  if($('.jurys-list').length) {
    if($('#gridJurys').length) {
      $('#gridJurys .image').each(function() {
        var $container = $(this),
            imgUrl     = $container.find('img').prop('src');
        if (imgUrl) {
          $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
        }
      });
    }

    $('.jurys-list .sub-nav-list a').on('click',function(e) {
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        var urlPath = $(this).attr('href');

        $.get(urlPath, function(data) {
          var matches = data.match(/<title>(.*?)<\/title>/);

          console.log($(data).find('.sub-languages').html());


          var spUrlTitle = matches[1];

          document.title = spUrlTitle;
          $( ".container-jurys" ).html( $(data).find('.container-jurys') );
          $('.bandeau-head').html( $(data).find('.bandeau-head') );
          $('.bandeau-list-footer').html( $(data).find('.bandeau-list-footer').html() );
          $('.sub-languages').html($(data).find('.sub-languages').html());


          history.pushState('', GLOBALS.texts.url.title, urlPath);
          $grid = $('#gridJurys').imagesLoaded(function() {
            $grid.isotope({
              layoutMode: 'packery',
              itemSelector: '.item'
            });

            $('#gridJurys .image').each(function() {
              var $container = $(this), imgUrl     = $container.find('img').prop('src');
              if (imgUrl) {
                $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
              }
            });

            $grid.isotope('layout');
          });



        });
        $('.jurys-list .sub-nav-list').find('a.active').removeClass('active');
        $(this).addClass('active');
      }
    });

    //Scroll
    $(window).on('scroll', function() {
      var s = $(window).scrollTop();
      var h = $("#main").height()-900;

      if(s > 470 ) {
        $('.sub-nav-list').addClass('sticky');
        $('.sub-nav-list').css({position: "fixed",top:90});
      } else if (s < 470) {
        $('.sub-nav-list').css({position: "relative",top:1});
      }
    });
  }

  //2. Artist
  if($('.artist').length) {
    $(window).on('scroll', function() {
      var s = $(window).scrollTop(),
          h = $('#main').height() - 900;

      if(s > 2780 ) {
        $('.single-article .nav.prev, .single-article .nav.next').css({'opacity':'0'});
      } else if (s < 2780) {
        $('.single-article .nav.prev, .single-article .nav.next').css({'opacity':'1'});
      }
    });
  }
});
