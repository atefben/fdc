$(document).ready(function() {

	$('.calendar .fc-event').each(function () {

	    // based on time start and duration, calculate positions of event
	    var timeStart = $(this).data('time'),
	      dur = Math.floor($(this).data('duration') / 60),
	      minutes = $(this).data('duration') % 60;

	    if (minutes == 0) {
	      minutes = '';
	    }

	    if (dur < 2) {
	      $(this).addClass('one-hour');
	      $(this).find('.txt span').prepend(dur + 'H' + minutes + ' - ');
	    }

	    var base = 8;
	    $(this).find('.category').css('background-color', $(this).data('color'));
	    $(this).addClass($(this).data('picto').substr(1));

	    var mT = timeStart - base;
	    $(this).css('margin-top', mT*170+10);

	});


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
	    var url =  GLOBALS.urls.newsUrl;
	    moveTimeline($(this), $(this).data('date'));
  	});

  	$('#timeline-calendar .prev').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date');

  		if(day == 11){
	    	return false;
	    }else{
	    	var url =  GLOBALS.urls.newsUrl ;
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1);
	    }
	    
  	});

  	$('#timeline-calendar  .next').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

  		if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')){
	    	return false;
	    }else{
	    	var url =  GLOBALS.urls.newsUrl;
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1);
	    }
  	});

  	// init timeline
	moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'));

	var venues = $(".venues .v-wrapper").owlCarousel({
	  nav: false,
	  dots: false,
	  smartSpeed: 500,
	  margin: 0,
	  autoWidth: true,
	  loop: false,

	});
	venues.owlCarousel();



});