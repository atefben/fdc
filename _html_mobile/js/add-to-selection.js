$(document).ready(function() {

	var mySelection = JSON.parse(localStorage.getItem('mySelection')) || [];


	$.initAddToSelection = function(){


		$('.picto-my-selection').on('click', function(e){

			console.log("keznkl");

			e.stopPropagation();
			
			var newItem = $(this).parents('.item').html(); 

			mySelection.push(newItem);

			localStorage.setItem('mySelection', JSON.stringify(mySelection));


		});
	}

	$.initAddToSelection();
	
});