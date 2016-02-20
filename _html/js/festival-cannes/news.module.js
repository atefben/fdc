$(document).ready(function() {

  if($('.home').length) {

  // News
  // =========================

  var cl = new CanvasLoader('canvasloader');
    cl.setColor('#ceb06e');
    cl.setDiameter(20);
    cl.setDensity(34);
    cl.setRange(0.8);
    cl.setSpeed(1);
    cl.setFPS(60);

  // Change date

  $('#timeline a').on('click', function(e) {
    e.preventDefault();
    var timestamp = $(this).data('timestamp');

    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
      return false;
    }

    $('#timeline a').removeClass('active');
    $(this).addClass('active');

    $('#articles-wrapper').addClass('loading');

    $('#shd').removeClass('show');
    $('.read-more').html(GLOBALS.texts.readMore.more).removeClass('prevDay');

    $('html, body').animate({
      scrollTop: $("#news").offset().top - 50
    }, 500);

    setTimeout(function() {
      cl.show();
      $('#canvasloader').addClass('show');
    }, 800);

    // todo: remove timeout
    setTimeout(function() {
      $.ajax({
        url: GLOBALS.urls.newsUrl,
        type: "GET",
        data: { 
          'timestamp': timestamp
        },
        success: function(data) {
          $('#canvasloader').removeClass('show');
          $('#articles-wrapper').html(data);

          setTimeout(function() {
            cl.hide();
            $('#articles-wrapper').removeClass('loading');
          }, 500);
          filter();

          initSlideshows();
        }
      });
    }, 2200);
    
  });

  
  if($('#articles-wrapper .nextDay').length > 0) {
    $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
    $('#shd').addClass('show');
  }

  $('.read-more').hover(function() {
    if(!$(this).hasClass('prevDay')) {
      $('#shdMore').addClass('show');
    }
  }, function() {
    $('#shdMore').removeClass('show');
  });

  // load more
  $('.read-more').on('click', function(e) {
    e.preventDefault();

    $('#timeline').removeClass('bottom');
    // load previous day
    if($(this).hasClass('prevDay')) {
      $('#shd').removeClass('show');
      $('.read-more').html( GLOBALS.texts.readMore.more ).removeClass('prevDay');
      $('#articles-wrapper').addClass('loading');
      
      $('html, body').animate({
        scrollTop: $("#news").offset().top - 50
      }, 1000);

      var i = $('#timeline a.active').index();
      $('#timeline a').removeClass('active');
      $('#timeline a').eq(i).next().addClass('active');

      setTimeout(function() {
        cl.show();
        $('#canvasloader').addClass('show');
      }, 800);

      // todo: remove timeout
      setTimeout(function() {
        $.ajax({
          url: GLOBALS.urls.newsUrl,
          type: "GET",
          data: {
            'timestamp': $('#news article.article:last').data('time'),
            'end': typeof $('#news article.article:last').data('end') != 'undefined' ? $('#news article.article:last').data('end') : 'false'
          },
          success: function(data) {
            $('#canvasloader').removeClass('show');

            setTimeout(function() {
              cl.hide();
              $('#articles-wrapper').removeClass('loading');
            }, 500);

            $('#articles-wrapper').html(data);

            filter();

            initSlideshows();
            $(window).trigger('resize');
          }
        });
      }, 1200);
    } else {
      var _data = {
        timestamp: $('#news article.article:last').data('time')
      }

      $('#shdMore').removeClass('show');
      $.ajax({
        url: GLOBALS.urls.newsUrl,
        type: "GET",
        data: {
          'timestamp': $('#news article.article:last').data('time'),
          'end': typeof $('#news article.article:last').data('end') != 'undefined' ? $('#news article.article:last').data('end') : 'false'
        },
        success: function(data) {
          $('#articles-wrapper').css('max-height', $('#articles-wrapper').height()).append(data);
          $('#articles-wrapper').css('max-height', $('#articles-wrapper').prop('scrollHeight'));
          filter();

          if($('#articles-wrapper .nextDay').length > 0) {
            $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
            
            setTimeout(function() {
              $('#shd').addClass('show');
              $(window).trigger('resize');
            }, 500);

            $('html, body').animate({
              scrollTop: $(".articles.center").offset().top + $(".articles.center").height() - 70
            }, 500);
          }


        }
      });
    }
      
  });

  }

});