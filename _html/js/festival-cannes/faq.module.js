// FAQ
// =========================
$(document).ready(function() {

  if($('.faq').length) {
      //open issue
    $(".faq-container article").click(function(){
        var i;
        i = $(this).find("i.fa");
        if($(this).hasClass("faq-article-active")){
            
            $(this).animate({maxHeight:"100px"},100,function(){
                $(this).removeClass("faq-article-active");
                i.removeClass("fa-minus").addClass("fa-plus");
            });
        }else{
            $(this).addClass("faq-article-active");
            i.removeClass("fa-plus").addClass("fa-minus");
            $(this).animate({maxHeight:"5000px"},300);
        }
    });
    //navigation
      $(".faq-menu li").click(function(){
          var $active;
          var nameActiveSection;
          var $activeSection;
          var $newActiveSection;
          var $newActiveNav;
          var nameNewActiveSection;
          //find active section and name data 
          $active = $('.faq-menu').find("li.active");
          nameActiveSection = $active.data("name");
          $activeSection = $('section[data-name='+nameActiveSection+']');
          nameNewActiveSection= $(this).data("name");
          $newActiveSection = $('section[data-name='+nameNewActiveSection+']');
          $newActiveNav = $('li[data-name='+nameNewActiveSection+']');
          
          if(!$(this).hasClass("active")){
              //hide active section
              $activeSection.animate({
                  top: "200px",
                  opacity:0
              },500,function(){
                  $activeSection.css({display:'none'});
                  $newActiveSection.css({display:'inline-block'});
                  $activeSection.removeClass("faq-active");
                  $newActiveSection.addClass("faq-active");
                  $active.removeClass("active");
                  $newActiveNav.addClass('active');
                  $newActiveSection.animate({
                      top:0,
                      opacity:1
                  },500);
              });
          }
      });
    $(window).on('scroll', function() {
        var s = $(window).scrollTop();
        var h = $("#main").height()-900;
        if(s < h && s > 50) {
          $(".faq-menu").css({position: "fixed", top: 250});
        } else if(s > h ){
          $(".faq-menu").css({position: "absolute",top:900});
        } else if (s<50){
          $(".faq-menu").css({position: "fixed", top: 393});
        }
    });

  }
});