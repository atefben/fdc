$(document).ready(function() {

	// load more
  $('.read-more').on('click', function(e) {

    	e.preventDefault();
    	$(this).hide();
	      
	    $.ajax({
	        type: "GET",
	        dataType: "html",
	        cache: false,
	        url: GLOBALS.urls.loadPressRelease, 
	        success: function(data) {
	          	$('#list-articles').append(data);

	        }
	    });
	    
	});
});