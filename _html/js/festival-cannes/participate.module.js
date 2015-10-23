// Participate
// =========================
$(document).ready(function() {

  if($('.participate').length) {
      //open issue
    $(".contain-section").click(function(){
        var i;
        i = $(this).find("i.fa");
        if($(this).hasClass("participate-active")){
            
            $(this).animate({maxHeight:"100px"},100,function(){
                $(this).removeClass("participate-active");
                i.removeClass("fa-minus").addClass("fa-plus");
            });
        }else{
            $(this).addClass("participate-active");
            i.removeClass("fa-plus").addClass("fa-minus");
            $(this).animate({maxHeight:"5000px"},300);
        }
    });
  }
});