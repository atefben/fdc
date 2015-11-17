$(document).ready(function() {
  if($('#seatingchart').length) {
      $('.nav-map li').click(function(){
        if(!$(this).hasClass('active')){
          var activeLi = $('.nav-map').find('li.active');
//          console.log(activeLi);
          var data = activeLi.data('data-maps');
//          alert(data);
        }
      })
    }
});