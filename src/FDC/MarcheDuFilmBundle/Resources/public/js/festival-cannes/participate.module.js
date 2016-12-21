// Participate
// =========================
$(document).ready(function() {


  if($('.participate').length) {

      //open issue
    if(!$('.content-contractor').length){
      $(".contain-section h3, .contain-section .accordion").click(function(){
          var i;
        var $this = $(this).closest('.contain-section');
          i = $this.find("i.accordion");
          if($this.hasClass("participate-active")){

              $this.animate({maxHeight:"100px"},100,function(){
                  $this.removeClass("participate-active");
                  i.removeClass("icon_moins").addClass("icon_case-plus");
              });
          }else{
              $this.addClass("participate-active");
              i.removeClass("icon_case-plus").addClass("icon_moins");
              $this.animate({maxHeight:"5000px"},300);
          }
      });
    }
  }
});
