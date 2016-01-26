
$(document).ready(function() {
 

	// $('.read-more').on('click',function(e){
	// 	e.preventDefault();
	// 	var url = "more-news.html";

	// 	  $.ajax({
	// 	    type: "GET",
	// 	    url: url,
	// 	    success: function(data) {
	// 	      $('.articles-container').append(data);
	// 	    }
	// 	  });
	// });



// load more
  $('.read-more').on('click', function(e) {
    e.preventDefault();

    $('#timeline').removeClass('bottom');
    // load previous day
    if($(this).hasClass('prevDay')) {
      
      	$('.read-more').html( GLOBALS.texts.readMore.more ).removeClass('prevDay');
      	var day = $('.timeline-container').find('.active').data('date');

  		if(day == 11){
	    	return false;
	    }else{
	    	var url =  "more-news.html";
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1, url);
	    }
	    $('html, body').animate({
            scrollTop: 750
          }, 500);
    } else {
      
	    $.ajax({
	        type: "GET",
	        dataType: "html",
	        cache: false,
	        url: GLOBALS.urls.newsUrlNext , 
	        success: function(data) {
	          	$('.articles-container').append(data);
	          	$('.read-more').html(GLOBALS.texts.readMore.nextDay).addClass('prevDay');

	        }
	    });
    }
});

	function moveTimeline(element, day,url){
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
    	$('.articles-container').animate({
		    opacity: 0
		  }, 500, function() {
		    $.ajax({
		        type: "GET",
		        dataType: "html",
		        cache: false,
		        url:url,
		        success: function(data) {
		          $('.articles-container').html(data);
		          initSlideshows();
		          $('.articles-container').animate({
				    opacity: 1
				  }, 500);
		        }
		    });

		  });
    	
      	
	}
	function setActiveThumbnail() {
      $('.thumbnails .owl-item').removeClass('center');

      $('.thumbnails .owl-item.active').first().addClass('center');

      if($('.thumbnails .owl-item.center').index() >= $('.thumbnails .owl-item').length - 4) {
        $('.thumbnails .owl-item').last().addClass('center');

      }
    }
	function initSlideshows() {

	  // create slider of thumbs
	  var nbItems = $('.single-article').length != 0 ? 7 : 8;

	  var sliderThumbs = $(".thumbnails").owlCarousel({ 
	      nav: false,
	      dots: false,
	      smartSpeed: 500,
	      fluidSpeed: 500,
	      loop: false,
	      margin: 20,
	      autoWidth: true,
	      dragEndSpeed: 600,
	      items:3,
	      onInitialized: function() {
	        var m = ($(window).width() - $('.container').width()) / 2;
	        $('.thumbnails .owl-stage').css({ 'margin-left': m });
	        setActiveThumbnail();
	      },
	      onResized: function() {
	        var m = ($(window).width() - $('.container').width()) / 2;
	        $('.thumbnails .owl-stage').css({ 'margin-left': m });
	      },
	      onTranslated: function() {
	        setActiveThumbnail();
	      }
	    });

	  sliderThumbs.owlCarousel();

	  $('.thumbnails .owl-item').on('click', function(e) {
	    e.preventDefault();

	    $(this).parents('.slideshow').find('.thumb').removeClass('active');
	    $(this).parents('.slideshow').find('.images .img').removeClass('active');

	    var i = $(this).index(),
	        cap = $(this).find('.thumb').data('caption');

	    $(this).find('.thumb').addClass('active');
	    $(this).parents('.slideshow').find('.title').html(cap);
	    $(this).parents('.slideshow').find('.caption').html(cap);
	    $(this).parents('.slideshow-img').find('.images .img').eq(i).addClass('active');
	  });

	  // init slideshow
	  
  		$.initSlideshow();

  

	}

	// init timeline
	moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'), 'news.html');
	

	$('#timeline a').on('click', function(e) {
    	e.preventDefault();

	    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
	      return false;
	    }
	    var url =  GLOBALS.urls.newsUrl;
	    moveTimeline($(this), $(this).data('date'),url);
  	});

  	$('#news #calendar .prev').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date');

  		if(day == 11){
	    	return false;
	    }else{
	    	var url =  GLOBALS.urls.newsUrl ;
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1, url);
	    }
	    
  	});

  	$('#news #calendar .next').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

  		if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')){
	    	return false;
	    }else{
	    	var url =  GLOBALS.urls.newsUrl;
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1, url);
	    }
  	});
	
});