$(document).ready(function() {

	


	$.initAddToSelection = function(){


		$('.picto-my-selection').on('click', function(e){

			var mySelection = JSON.parse(localStorage.getItem('mySelection')) || [];

			e.stopPropagation();
			
			var newItem = $(this).parents('.item').html(); 


			mySelection.push(newItem);



			localStorage.setItem('mySelection', JSON.stringify(mySelection));


			$.openSelection();


		});
	}

	$.initAddToSelection();
	
});