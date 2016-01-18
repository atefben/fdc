$(document).ready(function() {


	var $main = $('#main');
	$(window).on('scroll', function() {
	    var s = $(this).scrollTop();
	  // STICKY HEADER
	    if (s > 95){
	        $main.addClass('sticky');
	    } else {
	        $main.removeClass('sticky');
	    }
	  });
	var menuopen = false;
	 $('#menu-btn').on('click', function() {
	      $('#main').addClass('st-effect st-menu-open');  
	      menuopen = true;
	  });
	 $('#main').on('click', function(e) {
            
	   if(!$(e.target).parents('.st-menu').length && !$(e.target).parents('.menu-btn').length)
	   {
	       if(menuopen){
	          $('#main').removeClass('st-effect st-menu-open');  
	          menuopen = false;
	        }                
	   }

	    
	  });


	$('.has-subsection').on('click',function(){
		
		if($(this).parent().hasClass('open')){
			$('#main-nav-list li').removeClass('open');
			$('#main-nav-list').removeClass('section-open');
			$(this).find('.more-minus').html('+');
		}else{
			if($('#main-nav-list').hasClass('section-open')){
				$('#main-nav-list li').removeClass('open');
				$('#main-nav-list .more-minus').html('+');
			}else{
				$('#main-nav-list').addClass('section-open');
				
			}
			$(this).parent().addClass('open');
			$(this).find('.more-minus').html('-');
			
		}
		

	});
	var menu = $("#top-menu").owlCarousel({
			  nav: false,
			  dots: false,
			  smartSpeed: 500,
			  margin: 0,
			  autoWidth: true,
			  loop: false,
			  items:2,
			  onInitialized: function() {
			  },
			  onResized: function() {
			    
			  }
			});
		
		menu.owlCarousel();

});