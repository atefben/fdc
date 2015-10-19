$(document).ready(function() {

  // Selection
  // =========================

  var sliderSelection = '';

  function openSelection(callback) {
    $('#main').addClass('overlay');

    if(sliderSelection != '') sliderSelection.trigger('destroy.owl.carousel');
    $('#slider-selection').empty();
    $('header .selection').addClass('opened');

    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url: 'selection.html' ,
      success: function(data) {
        $('#slider-selection').append(data);

        sliderSelection = $("#slider-selection").owlCarousel({
          nav: false,
          dots: false,
          smartSpeed: 500,
          center: true,
          loop: false,
          margin: 50,
          autoWidth: true,
          onInitialized: function() {
            var v = ($(window).width() - 977) / 2 + "px";
            $('#slider-selection .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
            $('#selection').addClass('open');
          }
        });

        sliderSelection.owlCarousel();
        callback();
      }
    });
    
  }

  function closeSelection() {
    $('#main').removeClass('overlay');
    $('#selection').removeClass('open');
    $('header .selection').removeClass('opened');
  }

  $('body').on('click', '#main.overlay', function(e) {
    e.preventDefault();

    if($('#selection').hasClass('open')) {
      closeSelection();
    }
  });

  $('header .selection').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('opened')) {
      closeSelection();
    } else {
      openSelection(function() {

      });
    }
    
  });

  // filters
  $('.filters-selection a').on('click', function(e) {
    e.preventDefault();

    $('.filters-selection a').removeClass('active');
    $(this).addClass('active');

    var f = $(this).data('selection');

    $('#selection .owl-item').removeClass('fade');

    if(f == 'all') {
      return false;
    } 

    if(f == 'suggestion') {
      // todo

      return false;
    }

    $('#selection article').each(function() {
      if(!$(this).hasClass(f)) {
        $(this).parents('.owl-item').addClass('fade');
      }
    });


  });

  // delete an article
  $('body').on('click', '.delete', function(e) {
    e.preventDefault();
    var $that = $(this);

    $(this).parent().addClass('deleted');
    $(this).parent().parent().css('margin-right', 0);
    var i = $(this).parent().parent().index();

    setTimeout(function() {
      sliderSelection.trigger('del.owl.carousel', i);
      sliderSelection.trigger('refresh.owl.carousel');
      var v = ($(window).width() - 977) / 2 + "px";
      $('#slider-selection .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
    }, 500);
  });

  // add an article 
  $('body').on('click', '.read-later', function(e) {
    e.preventDefault();
    var $article = $(this).parents('article').clone().removeClass('double').wrapAll("<div class='article'></div>").parent().wrapAll('<div></div>').parent();
        $article.find('.read-later').remove();
        $article.find('div.article').append('<a href="#" class="delete"></a>');
        $article = $article.html();

    openSelection(function() {
      $("#main").addClass('overlay');
      $('header .selection').addClass('opened');
      
      setTimeout(function() {
        sliderSelection.trigger('add.owl.carousel', [$('<div class="owl-item">' + $article + '</div>'), 0]);
        sliderSelection.trigger('refresh.owl.carousel');
        var v = ($(window).width() - 977) / 2 + "px";
        $('#slider-selection .owl-stage').css({ transform: "translate3d(" + v + ", 0, 0)" });
      }, 700);
    });
     
  });

  $('body').on('mouseover', '.read-later', function() {
    $(this).find('span').css({
      top: $(this).offset().top - $(window).scrollTop() - 59,
      left: $(this).offset().left - 80
    });
  });

});