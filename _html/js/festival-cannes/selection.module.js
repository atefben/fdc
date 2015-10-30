$(document).ready(function() {

  // Selection
  // =========================

  var sliderSelection = '',
      tr = 0;

  function openSelection(callback) {
    $('#main, footer').addClass('overlay');

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
          margin: 0,
          dragEndSpeed: 900,
          autoWidth: true,
          onInitialized: function() {
            setTimeout(function() {
              $('#selection').addClass('open');
              tr = $('#selection .owl-stage').css('transform').substr(19, 3);
            }, 500);
          }
        });

        sliderSelection.owlCarousel();
        callback();
      }
    });
    
  }

  function closeSelection() {
    $('#main, footer').removeClass('overlay');
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

  var widthFilter = 0;

  // filters
  $('.filters-selection a').on('click', function(e) {
    widthFilter = 0;
    e.preventDefault();

    $('.filters-selection a').removeClass('active');
    $(this).addClass('active');

    var f = $(this).data('selection');

    $('#slider-selection').addClass('fade');
    $('#selection .owl-item').removeClass('filtered');

    if(f == 'all') {
      $('#selection .owl-stage').width(272 * $('#selection .owl-item').length).css('transform', 'translate3d(' + tr + 'px, 0, 0)');
      setTimeout(function() {
        $('#selection .owl-item').removeClass('fade');
        $('#slider-selection').removeClass('fade');
      }, 1000);
      return false;
    } 

    if(f == 'suggestion') {
      // todo

      return false;
    }

    setTimeout(function() {
      $('#selection article').each(function() {
        if(!$(this).hasClass(f)) {
          $(this).parents('.owl-item').addClass('fade filtered');
        }
      });
      $('#selection .owl-stage').width(272 * $('#selection .owl-item').not('.filtered').length).css('transform', 'translate3d(' + tr +'px, 0, 0)');
      $('#selection .owl-item').not('.filtered').removeClass('fade');
    }, 500);

    setTimeout(function() {
      $('#slider-selection').removeClass('fade');
    }, 800);
    
  });

  // delete an article
  $('body').on('click', '.delete', function(e) {
    e.preventDefault();
    var $that = $(this);

    $(this).parent().addClass('deleted');
    var i = $(this).parent().parent().index();

    setTimeout(function() {
      sliderSelection.trigger('del.owl.carousel', i);
      sliderSelection.trigger('refresh.owl.carousel');
    }, 800);
  });

  // add an article 
  $('body').on('click', '.read-later', function(e) {
    e.preventDefault();
    var $article = $(this).parents('article').clone().removeClass('double').wrapAll("<div class='article'></div>").parent().wrapAll('<div></div>').parent();
        $article.find('.read-later').remove();
        $article.find('div.article').append('<a href="#" class="delete"></a>');
        $article = $article.html();

    openSelection(function() {
      $("#main, footer").addClass('overlay');
      $('header .selection').addClass('opened');
      
      setTimeout(function() {
        sliderSelection.trigger('add.owl.carousel', [$('<div class="owl-item added scaled">' + $article + '</div>'), 0]);
        sliderSelection.trigger('refresh.owl.carousel');
        $('.scaled').removeClass('scaled');
      }, 1200);
    });
     
  });

  $('body').on('mouseover', '.read-later', function() {
    $(this).find('span').css({
      top: $(this).offset().top - $(window).scrollTop() - 59,
      left: $(this).offset().left - 80
    });
  });

});