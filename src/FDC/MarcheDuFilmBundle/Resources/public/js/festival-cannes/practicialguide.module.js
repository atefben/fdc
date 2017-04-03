$(document).ready(function() {
  if($('#praticalguide').length) {
    //click nav

    $(".contain-title-pg, .accordion").click(function(){
      var $parent = $(this).closest('section');
      if(!$parent.hasClass('active')){
          $parent.animate({maxHeight:"3000px"},100,function(){
            $parent.addClass('active');
            var  element = $parent.find('.icon_case-plus');
            element.removeClass('icon_case-plus').addClass('icon_moins');
          });
      }else{
          $parent.animate({maxHeight:"95px"},100,function(){
            var  element = $parent.find('.icon_moins');
            $parent.removeClass('active');
            element.removeClass('icon_moins').addClass('icon_case-plus');
          });
      }
    });
    }
});
