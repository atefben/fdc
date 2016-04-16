$(document).ready(function() {
  var sliderCommuniques = $(".communiques-carousel").owlCarousel({ 
    nav          : false,
    dots         : false,
    smartSpeed   : 500,
    fluidSpeed   : 500,
    loop         : false,
    margin       : 0,
    autoWidth    : true,
    dragEndSpeed : 600,
    items        : 1,
    onInitialized: function() {
      var m = ($(window).width() - $('.container').width()) / 2;
      $('.communiques-carousel .owl-stage').css({ 'margin-left': m });
    },
    onResized: function() {
      var m = ($(window).width() - $('.container').width()) / 2;
      $('.communiques-carousel .owl-stage').css({ 'margin-left': m });
    }
  });
  sliderCommuniques.owlCarousel();

  var sliderMediatheque = $(".film-slider").owlCarousel({ 
    nav          : false,
    dots         : false,
    smartSpeed   : 500,
    fluidSpeed   : 500,
    loop         : false,
    margin       : 70,
    autoWidth    : true,
    dragEndSpeed : 600,
    items        : 1,
    center       : true
  });
  sliderMediatheque.owlCarousel();

  $('.contact .sub-section .title-section').click(function() {
    $(this).parent().toggleClass('open');
    $(this).find('.icon').toggleClass('icon_fleche-top');
  });  

  var listener = function (event) {
     event.preventDefault();
  };

  $('.button-locked').click(function(e) {
    e.preventDefault();
    var scrollTop = $(document).scrollTop();

    $('body').append('<div id="overlay"><div class="close-button"><i class="icon icon_close"></i></div></div>');
    $("#popin-press").addClass('visible');
    $("#popin-press").css('top', scrollTop+$('.header-container').height()+$(window).height()/4);
    $("#overlay").css('top', scrollTop);
    $('#password').focus();
    
    document.body.addEventListener('touchmove', listener,false);

    $('#overlay').click(function(e) {
      document.body.removeEventListener('touchmove', listener,false);
      $(this).remove();
      $("#popin-press").removeClass('visible');
    });

    $('#popin-press #password').on('blur', function(e) {
      window.scrollTo(0,scrollTop);
    });

    $('#popin-press form').on('submit', function(e) {
      $('#popin-press #password').blur();
      e.preventDefault();

      var v = $(this).find('input[type="password"]').val();
      // todo on server : security check password.

      if(v == "test") {
        localStorage.setItem('press-pwd', v);
        document.body.removeEventListener('touchmove', listener,false);
        // $.cookie('press', '1', { expires: 365 });
        $('.press').removeClass('press-locked');
        $('.press').addClass('press-unlocked');
        $('.locked').remove();
        $('#overlay').remove();
        $("#popin-press").removeClass('visible');
      } else {
        $(this).addClass('error');
      }
    });
  });

  // if password is in localstorage
  if(localStorage.getItem('press-pwd')) {
    $('.press').removeClass('press-locked');
    $('.press').addClass('press-unlocked');
    $('.locked').remove();
  }

  $('.locked form').on('submit', function(e) {
    e.preventDefault();

    var v = $(this).find('input[type="password"]').val();
    // todo on server : security check password.

    if(v == "test") {
      localStorage.setItem('press-pwd', v);
      $('.press').removeClass('press-locked');
      $('.press').addClass('press-unlocked');
      $('.locked').addClass('valid');
      $('.locked').html('<p class="press_confirmation">les contenus qui vous sont réservés sont à présents accessibles.</p>');
    } else {
      $(this).addClass('error');
    }
  });
});