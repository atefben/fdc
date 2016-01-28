$(document).ready(function() {

	$('.'+ $('#main').data('menu')).addClass('active-page');
	var $main = $('body');
	$(window).on('scroll', function() {
	    var s = $(this).scrollTop();
	  // STICKY HEADER
	    if (s > 90){
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
		
		var parentUl = $(this).parents('ul');

		if($(this).parent().hasClass('open')){
			
			parentUl.removeClass('section-open');
			parentUl.find('li').removeClass('open');


			// $('#main-nav-list li').removeClass('open');
			// $('#main-nav-list').removeClass('section-open');
			$(this).find('.more-minus').html('+');
		}else{

			if(parentUl.hasClass('section-open')){
				parentUl.find('li').removeClass('open');
				parentUl.find('.more-minus').html('+');
			}else{
				parentUl.addClass('section-open');
			}

			// if($('#main-nav-list').hasClass('section-open')){
			// 	$('#main-nav-list li').removeClass('open');
			// 	$('#main-nav-list .more-minus').html('+');
			// }else{
			// 	$('#main-nav-list').addClass('section-open');
				
			// }
			$(this).parent().addClass('open');
			$(this).find('.more-minus').html('-');
			
		}
	});
	$('.language li').on('click',function(e){
		if ($('.language ul').hasClass('show')) {
			$('.language li').removeClass('active-language');
			$(this).addClass('active-language');
			$('.language ul').removeClass('show');
			$('.language ul').addClass('hide');
		}else{
			$('.language ul').removeClass('hide');
			$('.language ul').addClass('show');
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