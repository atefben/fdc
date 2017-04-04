$(document).ready(function () {

    var dayEnd = GLOBALS.dateEnd;
    dayEnd = new Date(dayEnd);
    dayEnd = dayEnd.getDate();

    var dayStart = GLOBALS.dateStart;
    dayStart = new Date(dayStart);
    dayStart = dayStart.getDate();

    $('#news #calendar .next').off('click').on('click', function(e) {
        e.preventDefault();

        var day    = $('.timeline-container').find('.active').data('date'),
            numDay = 0;

        $('#calendar .prev').removeClass('disabled');

        if(day >= dayEnd - 1) {
            $('#calendar .next').addClass('disabled');
        }else{
            $('#calendar .next').removeClass('disabled');
        }

        if(day == dayEnd || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')) {
            return false;

        } else {
            moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
        }
    });
    $('#timeline a').off('click').on('click', function(e) {
        e.preventDefault();

        var day =  $(this).data('date');

        if($(this).hasClass('active') || $(this).hasClass('disabled')) {
            return false;
        }

        if(day <= dayStart) {
            $('#calendar .prev').addClass('disabled');
        }else{
            $('#calendar .prev').removeClass('disabled');
        }

        if(day == dayEnd) {
            $('#calendar .next').addClass('disabled');
        }else{
            $('#calendar .next').removeClass('disabled');
        }

        $('.nd').html(day);

        moveTimeline($(this), $(this).data('date'));
    });

    $('.item-video').off('click').on('click',function(e) {
        e.preventDefault();
        var $this = $(this),
            sources = [],
            sourceAttrs = ['data-webmurl', 'data-mp4url'],
            $fullscreenplayer = $('.fullscreenplayer')
        ;

        setTimeout(function() {
            $fullscreenplayer.addClass('show');
            $('body').addClass('allow-landscape');
        }, 200);

        $.each(sourceAttrs, function (idx, name) {
            $this.attr(name) ? sources.push({ file: $this.attr(name) }) : null;
        });

        if($("#player1").length !== 0) {
            playerInstance = jwplayer("player1");
            playerInstance.setup({
                image        : $this.data('poster'),
                width        : "100%",
                aspectratio  : "16:9",
                displaytitle : false,
                mediaid      : '123456',
                skin         : {
                    name : "five"
                },
                sources: sources
            });
        }

        $fullscreenplayer.find('.category').html($(this).find('.category').html());
        $fullscreenplayer.find('.title-video').html($(this).find('.titleLink').html());
        $fullscreenplayer.find('.date').html($(this).find('.titleLink').attr('data-date'));
    });

    // load more
  $('.read-more').off('click').on('click', function(e) {
    e.preventDefault();

    $('#timeline').removeClass('bottom');
    // load previous day
    if($(this).hasClass('prevDay')) {
      $('.read-more').html( GLOBALS.texts.readMore.more ).removeClass('prevDay');
      var day = $('.timeline-container').find('.active').data('date');

      if(day == 11) {
        return false;
      } else {
        moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"), day-1);
      }

      $('html, body').animate({
        scrollTop: 750
      }, 500);
    } else {
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: GLOBALS.urls.newsUrl,
        data: {
          'timestamp': $('#news .articles-container:not(.nextDay) article:last').data('time'),
          'end': typeof $('#news .articles-container:not(.nextDay) article:last').data('end') != 'undefined' ? $('#news .articles-container:not(.nextDay) article:last').data('end') : 'false'
        },
        success: function(data) {
            $('#articles-wrapper').append(data);
            console.log('asfdasdasd');
            if($('#articles-wrapper .nextDay').length > 0) {
              $('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');
              $('#articles-wrapper .nextDay').hide();
            } else if ($('#news .articles-container').length == 0 || $('#news .articles-container:not(.nextDay) article:last').data('end') || $('#timeline a.active').attr('data-date') == '11') {
              $('.read-more').addClass('hidden');
            }
            initAddToSelection();

        }
      });
    }
  });
});

function moveTimeline(element, day, ajax){
  ajax = typeof ajax !== 'undefined' ? ajax : true;
  var numDay = 0;

  if(day == 11) {
    numDay = 0;
  } else if(day == 22) {
    numDay = 9
  } else {
    numDay = day - 12;
  }

  $('#timeline .timeline-container').css('left', - numDay * 130 + 'px');
  $('#timeline a').removeClass('active');
  element.addClass('active');

  if (ajax == true) {
    $('#articles-wrapper').animate({
      opacity: 0
    }, 500, function () {
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: GLOBALS.urls.newsUrl,
        data: {
          'timestamp': element.attr('data-timestamp')
        },
        success: function (data) {
          $('#articles-wrapper').html(data);
          initAddToSelection();
          initSlideshows();
          $('#articles-wrapper').animate({
            opacity: 1
          }, 500);
        }
      });
    });
  }
};
