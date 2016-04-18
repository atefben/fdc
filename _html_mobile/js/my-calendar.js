$(document).ready(function() {
  // init array of events
  var events = [];
  // get local storage
  var agenda = localStorage.getItem('agenda_press');
  // if local storage, get the events
  if (agenda != null) {
     events = JSON.parse(agenda);
  }

  addEventsInCalendar();

  function displayProgrammationDay(day) {
    var startDayDate = new Date("2016-05-"+day+"T08:00:00").getTime();
    var endDayDate = new Date("2016-05-"+(day+1)+"T03:00:00").getTime();
    
    $(".fc-event").each(function () {
      var startDate = new Date($(this).data('start')).getTime();
      if(startDate >= startDayDate && startDate <= endDayDate) {
        $(this).css('display','block');
      } else {
        $(this).css('display','none');
      }
    });
  }

  function addEventsInCalendar() {
    events.sort(function(a, b) {
      if (new Date(a.start) > new Date(b.start)) return 1;
      if (new Date(a.start) < new Date(b.start)) return -1;
      return 0;
    });

    $.each(events, function(index, evt){
      $('.v-container').append('<div class="fc-event" data-category="reprise" data-type="reprise" data-url="'+evt.url+'" data-id="'+evt.id+'" data-color="'+evt.eventColor+'" data-start="'+evt.start+'" data-end="'+evt.end+'" data-time="'+evt.time+'" data-duration="'+evt.duration+'"><p class="remove-evt"><i class="icon icon_close"></p></i><span class="category"><i class="icon '+evt.eventPictogram+'"></i><span class="cat-title">'+evt.type+'</span></span><div class="info"><img src="'+evt.picture+'"><div class="txt"><span>'+evt.title+'</span><strong>'+evt.author+'</strong></div></div><div class="bottom"><span class="duration">'+evt.duration/60+'H</span> <span class="dash">-</span> <span class="ven">'+evt.room+'</span><span class="competition">'+evt.selection+'</span></div></div>');
    });

    var endDate = new Date("1900-01-01T00:00:00").getTime();

    $(".fc-event").each(function () {
      // allows to display two events at same hour (or overlap) in the same column 
      // it works only if element (fc-event) are added in chronologic order
      var startDate = new Date($(this).data('start')).getTime();
      
      if(startDate < endDate) {
        $(this).addClass('half');
        if(!$(this).prev('.fc-event').hasClass('half')) {
          $(this).prev('.fc-event').addClass('half');
        }
      }

      endDate = new Date($(this).data('end')).getTime();
      // short event (less than 2 hours) 
      // based on time start and duration, calculate positions of event
      var timeStart = $(this).data('time'),
          dur = Math.floor($(this).data('duration') / 60),
          minutes = $(this).data('duration') % 60,
          base = 8;
      var mT = timeStart - base;

      if (minutes == 0) {
        minutes = '';
      }
      if (dur < 2) {
        $(this).addClass('one-hour');
        $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
      }

      //add color
      $(this).find('.category').css('background-color', $(this).data('color'));
      $(this).css('margin-top', mT*170+10);
    });
    
    // delete event from localStorage
    $('.fc-event').on('click', '.remove-evt', function (e) {
      e.preventDefault();

      var id = parseInt($(this).parent().data('id'));
      var agenda = localStorage.getItem('agenda_press');
      events = JSON.parse(agenda);

      for (var i = 0; i < events.length; i++) {
        if (events[i].id == id) {
          events.splice(i, 1);
        }
      }

      localStorage.setItem('agenda_press', JSON.stringify(events));
      $(this).parent().remove();
    });

    displayProgrammationDay($('.timeline-container .active').data('date'));
  };

  function moveTimeline(element, day) {
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
  }

  $('#timeline a').on('click', function(e) {
    e.preventDefault();

    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
      return false;
    }

    $('#timeline a').removeClass('active');
    $(this).addClass('active');

    moveTimeline($(this), $(this).data('date'));
    displayProgrammationDay($('.timeline-container .active').data('date'));
  });

  $('#timeline-calendar .prev').on('click',function(e) {
    e.preventDefault();
    var day = $('.timeline-container').find('.active').data('date');

    if(day == 11) {
      return false;
    } else {
      moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1);
      displayProgrammationDay($('.timeline-container .active').data('date'));
    }
  });

  $('#timeline-calendar .next').on('click',function(e) {
    e.preventDefault();
    var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

    if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')) {
      return false;
    } else {
      moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
      displayProgrammationDay($('.timeline-container .active').data('date'));
    }
  });

  // init timeline
  moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'));
});