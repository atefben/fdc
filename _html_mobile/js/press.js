
$(document).ready(function() {
 

	var sliderCommuniques = $(".communiques-carousel").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 0,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
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
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 70,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:1,
	      center:true
	    });

	    sliderMediatheque.owlCarousel();



	$('.contact .sub-section .title-section').click(function(){

		$(this).parent().toggleClass('open');
		$(this).find('.icon').toggleClass('icon_fleche-top');
	});	

	var listener = function (event) {
 		event.preventDefault();
	};

	$('.button-locked').click(function(e){
		e.preventDefault();
		$('body').append('<div id="overlay"><div class="close-button"><i class="icon icon_close"></i></div></div>');
		$("#popin-press").addClass('visible');
		var scrollTop = $(document).scrollTop();
		$("#popin-press").css('top', scrollTop+$('.header-container').height()+$(window).height()/4);
		$("#overlay").css('top', scrollTop);
		$('#password').focus();
		document.body.addEventListener('touchmove', listener,false);

		$('#overlay').click(function(e){
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
		      // $.cookie('press', '1', { expires: 365 });
		      $('.press').removeClass('press-locked');
		      $('.press').addClass('press-unlocked');
		      $('.locked').remove();
		   	  document.body.removeEventListener('touchmove', listener,false);
			  $('#overlay').remove();
			  $("#popin-press").removeClass('visible');
		    } else {
		      $(this).addClass('error');
		    }

		});

	});



	// if cookie press
	if($.cookie('press')) {
	    $('.press').removeClass('press-locked');
	    $('.press').addClass('press-unlocked');
	    $('.locked').remove();
	}


	$('.locked form').on('submit', function(e) {

	    e.preventDefault();

	    var v = $(this).find('input[type="password"]').val();
	    // todo on server : security check password.

	    if(v == "test") {
	      // $.cookie('press', '1', { expires: 365 });
	      $('.press').removeClass('press-locked');
	      $('.press').addClass('press-unlocked');
	      $('.locked').remove();
	    } else {
	      $(this).addClass('error');
	    }

	});



	// // CALENDAR

	// var agenda = localStorage.getItem('agenda_press');
 //    var events = JSON.parse(agenda);

	// // create the 'my calendar' module
 //      $('#mycalendar').fullCalendar({
 //        lang: GLOBALS.locale, // TODO a verifier
 //        defaultDate: GLOBALS.defaultDate, // TODO a supprimer
 //        header: {
 //          left: 'prev',
 //          center: 'title',
 //          right: 'next'
 //        },
 //        titleFormat: 'dddd DD MMMM',
 //        defaultView: 'agendaDay',
 //        minTime: "08:00:00",
 //        maxTime: "28:00:00",
 //        allDaySlot: false,
 //        droppable: true,
 //        selectOverlap: false,
 //        events: events,
 //        eventOverlap: false,
 //        slotEventOverlap: false,
 //        eventAfterRender: function (event, element, view) {
 //          // atfer render of each event : change html with all the info
 //          if (event.duration / 60 < 2) {
 //            $(element).addClass('one-hour');
 //          }
 //          var dur = event.duration / 60 + 'H';
 //          var c = event.eventColor;
 //          $(element).empty();
 //          $(element).addClass(event.eventPictogram).addClass('ajax');
 //          $(element).attr('data-id', event.id);

 //          if (c == '#000') {
 //            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance-presse"></i>' + event.type + '<a href="#" class="del"></a></span>');
 //          } else if (c == "#9b9b9b") {
 //            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-seance"></i>' + event.type + '<a href="#" class="del"></a></span>');
 //          } else if (c == "#a68851") {
 //            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-conference"></i>' + event.type + '<a href="#" class="del"></a></span>');
 //          } else if (c == "#fff") {
 //            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_evt-personnel"></i>' + event.type + '<a href="#" class="del"></a></span>');
 //          } else {
 //            $(element).append('<span class="category" style="background-color:' + c + '"><i class="icon icon_espace-presse"></i>' + event.type + '<a href="#" class="del"></a></span>');
 //          }

 //          $(element).append('<div class="info"><img src="' + event.picture + '" /><div class="txt"><span>' + event.title + '</span><strong>' + event.author + '</strong></div></div>');
 //          $(element).append('<div class="bottom"><span class="duration">' + dur + '</span> - <span class="ven">' + event.room.toUpperCase() + '</span><span class="competition">' + event.selection + '</span></div>');
 //        },
 //        viewRender: function (view) {
 //          // limit the min date and max date of the calendar, and change the programmation calendar date
 //          var moment = $('#mycalendar').fullCalendar('getDate');

 //          $('#mycalendar .fc-left, #mycalendar .fc-right').removeClass('hide');

 //          if (moment.format('DD') > maxDate) {
 //            $('#mycalendar').fullCalendar('gotoDate', '2016-05-22');
 //          }
 //          if (moment.format('DD') < minDate) {
 //            $('#mycalendar').fullCalendar('gotoDate', '2016-05-11');
 //          }

 //          if (moment.format('DD') == maxDate) {
 //            $('#mycalendar .fc-right').addClass('hide');
 //          }
 //          if (moment.format('DD') == minDate) {
 //            $('#mycalendar .fc-left').addClass('hide');
 //          }

 //          var m = $('#mycalendar').fullCalendar('getDate');
 //          $('#dateProgram').text(m.format('DD MMMM YYYY'));
 //          $('#timeline a').each(function () {
 //            var d = $(this).data('date');
 //            if (d == m.format()) {
 //              $(this).trigger('click');
 //            }
 //          });
 //        }
 //      });

});