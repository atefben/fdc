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
      $('#articles-wrapper').css('max-height', 'none')
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

          var div = $("<div/>");
          div.html(data);
          $('.filters').html(div.find('.filter'));
          $('#articles-wrapper').html(div.find('.articles'));

          setTimeout(function() {
            cl.hide();
            $('#articles-wrapper').removeClass('loading');
          }, 500);

          filter();

          initSlideshows();

          if($('#articles-wrapper .nextDay').length > 0) {
            $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
            
            setTimeout(function() {
              $('#shd').addClass('show');
              $(window).trigger('resize');
            }, 500);
          } else if ($('#news .articles').length == 0 || $('#news .articles:not(.nextDay) article:last').data('end')) {
            $('.read-more').hide();
          }
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
        $('#articles-wrapper').css('max-height', 'none')
      }, 800);

      // todo: remove timeout
      setTimeout(function() {
        $.ajax({
          url: GLOBALS.urls.newsUrl,
          type: "GET",
          data: {
            'timestamp': $('#news .articles:not(.nextDay) article:last').data('time'),
            'end': typeof $('#news .articles:not(.nextDay) article:last').data('end') != 'undefined' ? $('#news .articles:not(.nextDay) article:last').data('end') : 'false'
          },
          success: function(data) {
            $('#canvasloader').removeClass('show');

            setTimeout(function() {
              cl.hide();
              $('#articles-wrapper').removeClass('loading');
            }, 500);

            var div = $("<div/>");
            div.html(data);
            $('.filters').html(div.find('.filter'));
            $('#articles-wrapper').css('max-height', $('#articles-wrapper').height()).html(div.find('.articles'));

            filter();

            if($('#articles-wrapper .nextDay').length > 0) {
              $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
              $('#shd').addClass('show');
            } else if ($('#news .articles').length == 0 || $('#news .articles:not(.nextDay) article:last').data('end')) {
              $('.read-more').hide();
            }

            initSlideshows();
            $(window).trigger('resize');

          }
        });
      }, 1200);
    } else {
      $('#shdMore').removeClass('show');
      $.ajax({
        url: GLOBALS.urls.newsUrl,
        type: "GET",
        data: {
          'timestamp': $('#news .articles:not(.nextDay) article:last').data('time'),
          'end': typeof $('#news .articles:not(.nextDay) article:last').data('end') != 'undefined' ? $('#news .articles:not(.nextDay) article:last').data('end') : 'false'
        },
        success: function(data) {
          var div = $("<div/>");
          div.html(data);

          div.find('.filter .select span:not([data-filter="all"])').each(function(i,v) {
            var f = $(this).data('filter');
            
            if ($('.filter .select span[data-filter="'+f+'"]').length == 0) {
              var fid = $(this).closest('.filter').attr('id');
              $('.filters #'+fid+' .select').append($(this));
            }
          });

          $('#articles-wrapper').css('max-height', $('#articles-wrapper').height()).append(div.find('.articles'));
          $('#articles-wrapper').css('max-height', $('#articles-wrapper').prop('scrollHeight'));

          filter();

          if($('#articles-wrapper .nextDay').length > 0) {
            $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
            
            setTimeout(function() {
              $('#shd').addClass('show');
              $(window).trigger('resize');
            }, 500);

          } else if ($('#news .articles').length == 0 || $('#news .articles:not(.nextDay) article:last').data('end')) {
              $('.read-more').hide();
          }

          if($(".articles.center").length > 0) {
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