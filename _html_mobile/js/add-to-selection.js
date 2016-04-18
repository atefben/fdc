function initAddToSelection() {
  $('.picto-my-selection').on('click', function(e) {
    e.stopPropagation();
    
    var mySelection = JSON.parse(localStorage.getItem('mySelection')) || [];
    var newItem = $(this).parents('.item').html(); 
    
    mySelection.push(newItem);
    localStorage.setItem('mySelection', JSON.stringify(mySelection));

    openSelection();
  });
}

$(document).ready(function() {
  initAddToSelection();  
});