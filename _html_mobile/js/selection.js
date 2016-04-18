function setActiveThumbnail() {
  $('.thumbnails .owl-item').removeClass('center');
  $('.thumbnails .owl-item.active').first().addClass('center');
  if($('.thumbnails .owl-item.center').index() >= $('.thumbnails .owl-item').length - 4) {
    $('.thumbnails .owl-item').last().addClass('center');
  }
}

$(document).ready(function() {
  $.initInvit = function() {
    if($("#player").length !== 0) {
      jwplayer('player').remove();
      
      var playerInstance = jwplayer("player");
      playerInstance.setup({
        file         : $("#player").data('video'),
        image        : $("#player").data('poster'),
        width        : "100%",
        aspectratio  : "16:9",
        displaytitle : false,
        skin         : {
          name : "five"
        }
      });
    }

    if($("#player2").length !== 0) {
      jwplayer('player2').remove();

      var playerInstance = jwplayer("player2");
      playerInstance.setup({
        file         : $("#player2").data('video'),
        image        : $("#player2").data('poster'),
        width        : "100%",
        aspectratio  : "16:9",
        displaytitle : false,
        skin         : {
          name : "five"
        }
      });
    }

    var sliderThumbPhotos = $(".photos .thumbnails").owlCarousel({ 
      nav          : false,
      dots         : false,
      smartSpeed   : 500,
      fluidSpeed   : 500,
      loop         : false,
      margin       : 25,
      autoWidth    : true,
      dragEndSpeed : 600,
      items        : 1,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('.thumbnails .owl-stage').css({ 'margin-left': m });
        setActiveThumbnail();
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('.thumbnails .owl-stage').css({ 'margin-left': m });
      },
      onTranslated: function() {
        setActiveThumbnail();
      }
    });
    sliderThumbPhotos.owlCarousel();

    $('.thumbnails .owl-item').on('click', function(e) {
      e.preventDefault();
      var i = $(this).index();

      $(this).parents('.slideshow').find('.thumb').removeClass('active');
      $(this).parents('.slideshow').find('.images .img').removeClass('active');
      $(this).find('.thumb').addClass('active');
      $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
    });

    var sliderArticles = $(".articles .articles-carousel").owlCarousel({ 
      nav          : false,
      dots         : false,
      smartSpeed   : 500,
      fluidSpeed   : 500,
      loop         : false,
      margin       : 20,
      autoWidth    : true,
      dragEndSpeed : 600,
      items        : 1,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('.articles-carousel .owl-stage').css({ 'margin-left': m });
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('.articles-carousel .owl-stage').css({ 'margin-left': m });
      }
    });
    sliderArticles.owlCarousel();

    initAudioPlayers();
  }

  $.initMenu2 = function() {
    var menu = $("#horizontal-menu2").owlCarousel({
      nav        : false,
      dots       : false,
      smartSpeed : 500,
      margin     : 60,
      autoWidth  : true,
      loop       : false,
      items      : 2,
      onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#horizontal-menu2 .owl-stage').css({ 'margin-left': m });
      },
      onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#horizontal-menu2 .owl-stage').css({ 'margin-left': m });
      }
    });
    menu.owlCarousel();

    if($('.faq-page').length == 0) {
      var toIndex = $('a.active').parents('.owl-item').index() - 1;
      menu.trigger("to.owl.carousel", [toIndex, 2, true]);  
    }

    // AJAX CALL
    $('#horizontal-menu2 a').on('click',function(e){
      e.preventDefault();

      if($(this).is(':not(.active)')) {
        $( ".content-selection2" ).removeClass('show');
        $("#banner-top").removeClass('show');
        $("#banner-bottom").removeClass('show');

        var urlPath = $(this).attr('data-url');
        $.get(urlPath, function(data) {
          $( ".content-selection2" ).html( $(data).find('.content-selection2').html() );

          setTimeout(function() {
            $( ".content-selection2" ).addClass('show');
            $("#banner-top").addClass('show');
            $("#banner-bottom").addClass('show');
          }, 300);

          if($("#banner-top").length !== 0) {
            $("#banner-top" ).html( $(data).find('#banner-top').html() );
          }
          if($("#banner-bottom").length !== 0) {
            $("#banner-bottom" ).html( $(data).find('#banner-bottom').html() );
          }

          if($('.palmares-container').length !== 0) {
            initFilmsSliders();
          }
          if($('.content-selection2').length !== 0) {
            initFilmsSliders();
          }
          if($(".invit").length !== 0) {
            $.initInvit();
          }

          history.pushState('',GLOBALS.texts.url.title, urlPath);
        });

        $('#horizontal-menu2 a').removeClass('active');
        $(this).addClass('active');
      }
    });

    // FIX HORIZONTAL MENU
    $(window).on('scroll', function() {
      if ($('#main').hasClass('cannesclassic')) {
        var s = $(this).scrollTop();

        if(s > $(".header-container").height() + $('.banner-img').height()+$('#horizontal-menu').height()) {
          $("#horizontal-menu2").css('position','fixed');
          $("#horizontal-menu2").css('top',$(".header-container").height());
          $(".selection-container").css('margin-top',$(".header-container").height()+10+'px');
          if($(".palmares-container").length !== 0) {
            $(".palmares-container").css('margin-top',$(".header-container").height());
          }
        } else {
          $("#horizontal-menu2").css('position','relative');
          $("#horizontal-menu2").css('top','inherit');  
          $(".selection-container").css('margin-top',0);
          $(".content-selection2").css('margin-top',0);
          if($(".palmares-container").length !== 0){
            $(".palmares-container").css('margin-top',0);
          }
        }
      }
    });
  }

  $(".content-selection2").addClass('show');
  $("#banner-top").addClass('show');
  $("#banner-bottom").addClass('show');

  $.initMenu2();
  $.initInvit();
});