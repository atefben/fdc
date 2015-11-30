$(document).ready(function() {

  // Selection
  // =========================

  var sliderSelection = '',
      sliderSuggestion = '',
      tr = 0,
      selectionCookie = [];

  if($.cookie('selection')) {
    selectionCookie = JSON.parse($.cookie('selection'));

    for(var i=0; i<selectionCookie.length; i++) {
      var $art = $('#toClone').clone();

      $art.find('article').addClass(selectionCookie[i].format);
      $art.attr('id', 'article' + selectionCookie[i].id);
      $art.find('article').data('format', selectionCookie[i].format);
      $art.find('article').data('theme', selectionCookie[i].theme);
      $art.find('img').attr('src', selectionCookie[i].img);
      $art.find('.linkImage').attr('href', selectionCookie[i].link);
      $art.find('.category').text(selectionCookie[i].category);
      $art.find('.date').text(selectionCookie[i].date);
      $art.find('.hour').text(selectionCookie[i].hour);
      $art.find('h2 a').text(selectionCookie[i].title);

      $('#slider-selection').append($art);
    }
  }

  $.ajax({
    type: "GET",
    dataType: "html",
    cache: false,
    url: 'selection.html' ,
    success: function(data) {
      $('#slider-suggestion').append(data);

      sliderSuggestion = $("#slider-suggestion").owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        center: true,
        loop: false,
        margin: 0,
        dragEndSpeed: 900,
        autoWidth: true,
        onInitialized: function() {
          
       }
      });

      sliderSuggestion.owlCarousel();
    }
  });

  $('#selection .title span').text(selectionCookie.length);

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
      if($('#selection .owl-stage').css('transform') == 'none') {
        var pxT = parseInt(($('#selection .owl-stage-outer').width() / 2) - 131) + "px";
        $('#selection .owl-stage').css('transform', 'translate3d(' + pxT + ',0, 0)');
      }
      setTimeout(function() {
        tr = $('#selection .owl-stage').css('transform').substr(19, 3);
      }, 700);
    }
  });

  sliderSelection.owlCarousel();

  function openSelection(callback) {
    $('#main, footer').addClass('overlay');

    $('#selection').addClass('open');

    $('header .selection').addClass('opened');

    if(selectionCookie.length == 0) {
      $('#slider-suggestion').addClass('show');
      $('.filters-selection a').removeClass('active');
      $('a[data-selection=suggestion]').addClass('active');
    }

    callback();

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
    if($('#searchContainer').hasClass('open')) {
      closeSearch();
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
      $('#slider-suggestion').removeClass('show');
      $('#selection .owl-stage').width(272 * $('#selection .owl-item').length).css('transform', 'translate3d(' + tr + 'px, 0, 0)');
      setTimeout(function() {
        $('#selection .owl-item').removeClass('fade');
        $('#slider-selection').removeClass('fade');
      }, 1200);
      return false;
    } 

    if(f == 'suggestion') {
      setTimeout(function() {
        $('#slider-suggestion').addClass('show');
      }, 1200);

      return false;
    }
    
    $('#slider-suggestion').removeClass('show');

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

    var id = parseInt($(this).parent().attr('id').replace('article', ''));

    selectionCookie = selectionCookie.filter(function (el) {return el.id !== id; });

    $('#selection .title span').text(selectionCookie.length);

    $.cookie('selection', JSON.stringify(selectionCookie), { expires: 14 });

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
        $article.find('div.article').attr('id', 'article' + $(this).parents('article').index('#main article'));
        $article = $article.html();

    $articleEl = $(this).parents('article');

    $('#slider-suggestion').removeClass('show');
    $('.filters-selection a').removeClass('active');
    $('a[data-selection=all]').addClass('active');

    selectionCookie.unshift({
      'id': $articleEl.index('#main article'),
      'format': $articleEl.data('format'),
      'theme': $articleEl.data('theme'),
      'img': $articleEl.find('img').attr('src'),
      'link': $articleEl.find('.linkImage').attr('href'),
      'category': $articleEl.find('.category').text(),
      'date': $articleEl.find('.date').text(),
      'hour': $articleEl.find('.hour').text(),
      'title': $articleEl.find('h2 a').text(),
    });

    $.cookie('selection', JSON.stringify(selectionCookie), { expires: 14 });

    $('#selection .title span').text(selectionCookie.length);

    openSelection(function() {
      $("#main, footer").addClass('overlay');
      $('header .selection').addClass('opened');
      
      setTimeout(function() {
        sliderSelection.trigger('add.owl.carousel', [$('<div class="owl-item added scaled">' + $article + '</div>'), 0]);
        sliderSelection.trigger('refresh.owl.carousel');

        $('.added').find('.article').width(0).css({
          transition: 'none',
          paddingRight: 0
        });
        setTimeout(function() {
          $('.added').find('.article').css({
            transition: '',
            paddingRight: '',
            width: ''
          });
        }, 200);
        setTimeout(function() {
          $('.scaled').removeClass('scaled');
          $('.added').removeClass('added');
        }, 800);
      }, 400);
    });
     
  });

  $('body').on('mouseover', '.read-later', function() {
    var lPos = $(this).offset().left - 80;

    if(($(this).offset().left + 120) > $(window).width()) {
      lPos = $(this).offset().left - 120;
      $(this).addClass('rAlign');
    } else {
      $(this).removeClass('rAlign');
    }

    var tPos = $(this).offset().top - $(window).scrollTop() - 59;

    $('#addtext').css({
      top: tPos,
      left: lPos
    });

    $('#addtext').addClass('show');
  });

  $('body').on('mouseout', '.read-later', function() {
    $('#addtext').removeClass('show');
  });

});