$(document).ready(function() {


	console.log(JSON.parse(localStorage.getItem('mySelection')));
	console.log(JSON.parse(localStorage.getItem('mySelection')).length);
	$('.count span').html(JSON.parse(localStorage.getItem('mySelection')).length);

	for(var i = 0 ; i < JSON.parse(localStorage.getItem('mySelection')).length ; i++){
	
		var thumb = $("<div class='thumb'></div>")
		thumb.html(JSON.parse(localStorage.getItem('mySelection'))[i])
		thumb.find('.picto-my-selection').remove();
		thumb.append('<a href="#" class="delete"></a>');
		$('.my-selection-container').append(thumb);

	}


	$('.delete').on('click',function(){

		var index = $(this).parent().index();
		var items = JSON.parse(localStorage.getItem('mySelection'));
		items.splice(index,1);
		localStorage.setItem('mySelection', JSON.stringify(items));
		$(this).parent().remove();
		$('.count span').html(JSON.parse(localStorage.getItem('mySelection')).length);
	});

 	$.ajax({
	    type: "GET",
	    dataType: "html",
	    cache: false,
	    url: GLOBALS.urls.selectionUrl ,
	    success: function(data) {

	    	$('.suggestion').append(data);
	    }

	});

	var filters = $("#myselection-filters").owlCarousel({
		  nav: false,
		  dots: false,
		  smartSpeed: 500,
		  margin: 40,
		  autoWidth: true,
		  loop: false,
		  items:1,
		  onInitialized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-menu .owl-stage').css({ 'margin-left': m });
		  },
		  onResized: function() {
		    var m = ($(window).width() - $('.container').width()) / 2;
		    $('#horizontal-menu .owl-stage').css({ 'margin-left': m });
		  }
		});
		filters.owlCarousel();


	$("#myselection-filters a").on('click',function(e){

		e.preventDefault();
		$("#myselection-filters a").removeClass('active');
		$(this).addClass('active');

		var filter = $(this).data('filter')

		if($(this).data('filter') == 'suggestion'){

			$('.suggestion').css('display','block');
			$('.my-selection-container').css('display','none');
			$('.thumb').css('display','block');

		}else{

			$('.my-selection-container').css('display','block');
			$('.suggestion').css('display','none');

			if($(this).data('filter') == 'all'){
				$('.thumb').css('display','block');
			}	

			else{

				$( ".thumb" ).each(function() {

				  if ($(this).find('.icon_'+filter+'').length == 0){
				  	$(this).css('display','none');
				  }else{
				  	$(this).css('display','block');
				  }
				});
 
			}
		}
		
	});
	
});