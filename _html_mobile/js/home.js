
$(document).ready(function() {
 

	$('.read-more').on('click',function(e){
		e.preventDefault();
		var url = "more-news.html";

		  $.ajax({
		    type: "GET",
		    url: url,
		    success: function(data) {
		      $('.articles-container').append(data);
		    }
		  });
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
	  
  	var slideshows = [];
  	// init slideshow chocolat
    if($('.slideshow').length) {

      var slideshow = $('.slideshow .images').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        loop: true,
      }).data('chocolat');

      slideshows.push(slideshow);
    }
    if($('.all-photos').length) {

      var slideshow = $('.list').Chocolat({
        imageSize: 'cover',
        fullScreen: false,
        loop:true,
      }).data('chocolat');

      slideshows.push(slideshow);
    }


	  // close slideshow on click
	  $('body').off('click', '.close-button');
	  $('body').on('click', '.close-button', function(e){
	    $('body').removeClass('allow-landscape');
	    document.body.removeEventListener('touchmove', listener,false);

	    setTimeout(function() {
	      $('.chocolat-wrapper').removeClass('show');
	    }, 900);
	  });

	 $('body').on('click', '.share', function(e){
	     e.preventDefault();
	      setTimeout(function() {
	        $('.buttons.square').toggleClass('show');
	      }, 200);
	     
	 });


	  var listener = function (event) {
	    event.preventDefault();
	  };

	  // zoom
	  $('body').off('click', '.chocolat-image');
	  $('body').on('click', '.chocolat-image', function() {
	    var $that = $(this);
	    $('body').addClass('allow-landscape');
	    document.body.addEventListener('touchmove', listener,false);
	    
	    $('.chocolat-top').html('<div class="close-button"><i class="icon icon_close"></i></div>');
	    $('<a href="#" class="share"><i class="icon icon_share"></i></a>').insertAfter('.chocolat-wrapper .chocolat-pagination');
	    $('<div class="buttons square"><a href="#" class="button facebook"><i class="icon icon_facebook"></i></a><a href="#" class="button twitter"><i class="icon icon_twitter"></i></a><a href="#" class="button link"><i class="icon icon_link"></i></a><a href="#" class="button email"><i class="icon icon_lettre"></i></a></div>').appendTo('.chocolat-bottom');

	    window.location.hash = $that.attr('id');

	    setTimeout(function() {
	      $('.chocolat-bottom').addClass('show');
	      $('.chocolat-wrapper').addClass('show');
	    }, 200);

	    

	    // ADD SWIPE TO NAVIGATE THROUGH PHOTOS
	    var myElement = document.getElementById('chocolat-content-1');
	    var hammertime = new Hammer(myElement);
	    hammertime.on('swipeleft', function(ev) {
	        slideshow.api().next();
	    });
	    hammertime.on('swiperight', function(ev) {
	        slideshow.api().prev();
	    });

	  });

  

	}

	// init timeline
	moveTimeline($('.timeline-container').find('.active'),$('.timeline-container').find('.active').data('date'), 'news.html');
	

	$('#timeline a').on('click', function(e) {
    	e.preventDefault();

	    if($(this).hasClass('active') || $(this).hasClass('disabled')) {
	      return false;
	    }
	    var url =  "more-news.html";
	    moveTimeline($(this), $(this).data('date'),url);
  	});

  	$('#news #calendar .prev').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date');

  		if(day == 11){
	    	return false;
	    }else{
	    	var url =  "more-news.html";
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day - 1) + "']"),day-1, url);
	    }
	    
  	});

  	$('#news #calendar .next').on('click',function(e){
  		e.preventDefault();

  		var day = $('.timeline-container').find('.active').data('date'), numDay = 0;

  		if(day == 22 || $('.timeline-container').find("[data-date='" + (day + 1) + "']").hasClass('disabled')){
	    	return false;
	    }else{
	    	var url =  "more-news.html";
	    	moveTimeline($('.timeline-container').find("[data-date='" + (day + 1) + "']"),day+1, url);
	    }
  	});
	
});