$(document).ready(function() {

	// init array of events
	 var events = [];

	// get local storage
	var agenda = localStorage.getItem('agenda_press');

	// if local storage, get the events
	if (agenda != null) {
	   events = JSON.parse(agenda);
	}

	// STOP AGENDA PICTOS FIXED BEFORE NEWSLETTER BLOCK
	$(window).on('scroll', function() {
	    var s = $(this).scrollTop();
	    if( s + document.documentElement.clientHeight > $('#main').height() + 173) {

	    	$('.agenda-access:not(.no-fixed)').css('position','absolute');
	    	$('.agenda-access:not(.no-fixed)').css('bottom','50px');
	    }
	    else{

	    	$('.agenda-access:not(.no-fixed)').css('position','fixed');
	    	$('.agenda-access:not(.no-fixed)').css('bottom','40px');
	    }
	 });

	function displayProgrammationDay(day){

		// TODO : à enlever lors de la dynamisation. C'est juste un test pour afficher 2 jours différents
		var url;
		if(day%2 == 0){
			url = GLOBALS.urls.calendarDay2;
		}else{
			url = GLOBALS.urls.calendarDay1;
		}
		//

		$.ajax({
	        type: "GET",
	        dataType: "html",
	        cache: false,
	        url: url,
	        success: function (data) {
	            $('.v-wrapper').html(data);

	            var venues = $(".v-wrapper-content").owlCarousel({
				  nav: false,
				  dots: false,
				  smartSpeed: 500,
				  margin: 0,
				  autoWidth: true,
				  loop: false,

				});
				venues.owlCarousel();

				$('.calendar .v-container').each(function () {
				
					var endDate = new Date("1900-01-01T00:00:00").getTime();
			
		
					$(this).find(".fc-event").each(function () {


						// allows to display two events at same hour (or overlap) in the same column 
						// it works only if element (fc-event) are added in chronologic order
						var startDate = new Date($(this).data('start')).getTime();
						if(startDate < endDate){
							$(this).addClass('half');
							if(!$(this).prev('.fc-event').hasClass('half')){
								$(this).prev('.fc-event').addClass('half');
							}
							
						}
						endDate = new Date($(this).data('end')).getTime();

						//
						


					    // based on time start and duration, calculate positions of event
					    var timeStart = $(this).data('time'),
					      dur = Math.floor($(this).data('duration') / 60),
					      minutes = $(this).data('duration') % 60;

					    if (minutes == 0) {
					      minutes = '';
					    }

					    // short event (less than 2 hours)
					    if (dur < 2) {
					      $(this).addClass('one-hour');
					      $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
					    }

					    var base = 8;

					    //add color
					    $(this).find('.category').css('background-color', $(this).data('color'));
					    $(this).addClass($(this).data('picto').substr(1));

					    var mT = timeStart - base;
					    $(this).css('margin-top', mT*170+10);

					    // init all the data of the event
					    var eventObject = {
					      title: $(this).find('.txt span').text(),
					      eventColor: $(this).data('color'),
					      start: $(this).data('start'),
					      end: $(this).data('end'),
					      time:$(this).data('time'),
					      type: $(this).find('.category').text(),
					      author: $(this).find('.txt strong').text(),
					      picture: $(this).find('img').attr('src'),
					      duration: $(this).data('duration'),
					      room: $(this).find('.bottom .ven').text(),
					      selection: $(this).find('.bottom .competition').text(),
					      eventPictogram: $(this).find('.category .icon').attr('class').split(' ')[1],
					      id: $(this).data('id'),
					      url: $(this).data('url')
					    };

					    // store the Event Object in the DOM element so we can get to it later
					    $(this).data('eventObject', eventObject);

					});
				});



			    $('.calendar').on('click', '.fc-event', function (e) {
			      var url = $(this).data('url');
			      openPopinEvent(url);
			    });
	        }
      	});



	}



	displayProgrammationDay($('.timeline-container .active').data('date'));



	

	function moveTimeline(element, day){
		var numDay = 0; 
	    if(day == 11){
	    	numDay = 0;
	    }else if(day == 22){
	    	numDay = 9
	    }else{
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

  	$('#timeline-calendar .prev').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date');

  		if(day == 11){
	    	return false;
	    }else{

	    	moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1);
	    	displayProgrammationDay($('.timeline-container .active').data('date'));
	    }
	    
  	});

  	$('#timeline-calendar  .next').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

  		if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')){
	    	return false;
	    }else{
	    	
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
	    	displayProgrammationDay($('.timeline-container .active').data('date'));
	    }
  	});

  	// init timeline
	moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'));



	function openPopinEvent(url) {
    $.ajax({
      type: "GET",
      dataType: "html",
      cache: false,
      url: url,
      success: function (data) {
        $('.popin-event').remove();
        // display the html
        $('.calendar').append(data);
        // $('.popin-event').css('top', $(document).scrollTop());
        $('.popin-event .fc-event').each(function () {

	
	    	$(this).find('.category').css('background-color', $(this).data('color'));
	    	$(this).addClass($(this).data('picto').substr(1));

		});


        
      $('.events-container .fc-event').each(function () {
        var id = $(this).data('id'),
          $this = $(this);

        for (var i = 0; i < events.length; i++) {
          if (id == events[i].id) {
            $this.parent().addClass('agenda');
            $this.parent().find('.button').removeClass('add').text(GLOBALS.texts.agenda.delete);
          }
        }

        // init all the data of the event
	    var eventObject = {
	      title: $(this).find('.txt span').text(),
	      eventColor: $(this).data('color'),
	      start: $(this).data('start'),
	      end: $(this).data('end'),
	      time:$(this).data('time'),
	      type: $(this).find('.category').text(),
	      author: $(this).find('.txt strong').text(),
	      picture: $(this).find('img').attr('src'),
	      duration: $(this).data('duration'),
	      room: $(this).find('.bottom .ven').text(),
	      selection: $(this).find('.bottom .competition').text(),
	      eventPictogram: $(this).find('.category .icon').attr('class').split(' ')[1],
	      id: $(this).data('id'),
	      url: $(this).data('url')
	    };

	    // store the Event Object in the DOM element so we can get to it later
	    $(this).data('eventObject', eventObject);
      });
        

        // show popin
        setTimeout(function () {
          $('.popin-event').addClass('show');
          // $('#main').addClass('event-open');
          $('body').addClass('overlay');
        }, 100);



         // close popin
        $('.calendar').on('click', '.close-button', function (e) {
          e.preventDefault();

          $('.popin-event').removeClass('show');
          $('body').removeClass('overlay');
          setTimeout(function () {
            $('.popin-event').remove();
          }, 600);
        });

        // add event
        $('.calendar').on('click', '.event .add', function (e) {
          e.preventDefault();
          var $ev = $(this).parent().find('.fc-event');

          var originalEventObject = $ev.data('eventObject');
          var copiedEventObject = $.extend({}, originalEventObject);
        
         if (events.filter(function (e) {
              return e.id == copiedEventObject.id;
            }).length > 0) {
            return false;
          }
          // get local storage
          var agenda = localStorage.getItem('agenda_press');

          if (agenda == null) {
            events.push(copiedEventObject);
            localStorage.setItem('agenda_press', JSON.stringify(events));
          } else {
            events = JSON.parse(agenda);
            events.push(copiedEventObject);
            localStorage.setItem('agenda_press', JSON.stringify(events));
          }
          
          $(this).parent().addClass('agenda');
          $(this).removeClass('add').text(GLOBALS.texts.agenda.delete);
        });

		// delete event
        $('.calendar').on('click', '.event.agenda .button', function (e) {
          e.preventDefault();

          var id = parseInt($(this).parent().find('.fc-event').data('id'));

          var agenda = localStorage.getItem('agenda_press');
          events = JSON.parse(agenda);

          for (var i = 0; i < events.length; i++) {
            if (events[i].id == id) {
              events.splice(i, 1);
            }
          }

          localStorage.setItem('agenda_press', JSON.stringify(events));

          $(this).parent().removeClass('agenda');
          $(this).text('Ajouter').addClass('add');
        });

      }
    });
  }



});