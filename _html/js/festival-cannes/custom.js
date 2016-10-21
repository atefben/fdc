$(document).ready(function() {
 
  $("#owl-top").owlCarousel({
 
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      dots: true,
      singleItem:true,
      loop:true,
      autoplay:true,
      autoplayTimeout:1000,
      autoplayHoverPause:true
 
  });

  $("#owl-mid").owlCarousel({
 
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      navigationText: ["<div class='redarrowLeft'><i class='icon icon_flecheGauche'></div>","<div class='redarrowRight'><i class='icon icon_flecheGauche reverse'></div>"]
   
  });

  
  $("#owl-second").owlCarousel({
 
      navigation : true,
      slideSpeed : 600,
      paginationSpeed : 400,
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      navigationText: ["<div class='redarrowLeft'><i class='icon icon_flecheGauche'></div>","<div class='redarrowRight'><i class='icon icon_flecheGauche reverse'></div>"]
 
  });


/* BOX SERVICES */

  	var servicesBoxes = $('.services-boxes');
  	var selectedBox = $('.services-pictures div');

	$(servicesBoxes).hover(function() {
	      $(selectedBox).toggleClass('hide')
	      $('#' + $(this).data('rel')).toggleClass('show');
	});

/* MENU */

	var blackBckg = $(".blackBckg");

	$("#navigation").hover(function() {

		$(blackBckg).toggle();

		});

	$('.seeSub').hover(function() {

  		$('.liMargin').toggleClass('littleMargin');
      $('.subMenu').toggle();
      $('.reverse').toggleClass('spanRotation');
		});

  $("#edition, #subMenu, .seeSub").hover(function() {
        $('#subMenu').toggle();
  });


/* TABS */

    $(".tab_content").hide();
    $(".tab_content:first").show();
    $("ul.tabs li").click(function() {
    
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();    
    
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");

    $(".tab_drawer_heading").removeClass("d_active");
    $(".tab_drawer_heading[rel^='"+activeTab+"']").addClass("d_active");
    
    });
  $(".tab_drawer_heading").click(function() {
      
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
    
    $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
    
    $("ul.tabs li").removeClass("active");
    $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });

  $('ul.tabs li').last().addClass("tab_last");

/* ACCORDION */

$('#accordion-menu .open').each(function() {
    
    $(this).click(function(event){
      event.stopPropagation();
      
      $('#accordion-menu .open').siblings().removeClass('open-selected');
      $('#accordion-menu .open').removeClass('open-selected');
      $('#accordion-menu .open').closest('li').removeClass('open-selected');
      $(this).find('.openPlus').toggleClass('noDisplay');
      $(this).find('.openMinus').toggleClass('doDisplay');
      $(this).siblings().find('.openPlus').removeClass('noDisplay');
      $(this).siblings().find('.openMinus').removeClass('doDisplay');
      $('#accordion-menu .content').slideUp('normal');
      
      if($(this).next().is(':hidden') == true) {
        $(this).closest('li').addClass('open-selected');
        $(this).siblings().removeClass('open-selected');
        $(this).next().slideDown('normal');
       } 
      
   });

  });
  
$('#accordion-conf .content').hide();

$('#accordion-conf .open').each(function() {
    
    $(this).click(function(event){
      event.stopPropagation();
      
      $('#accordion-conf .open').siblings().removeClass('open-selected-conf');
      $('#accordion-conf .open').removeClass('open-selected-conf');
      $('#accordion-conf .open').closest('li').removeClass('open-selected-conf');
      $(this).find('.openPlus').toggleClass('noDisplay');
      $(this).find('.openMinus').toggleClass('doDisplay');
      $(this).siblings().find('.openPlus').removeClass('noDisplay');
      $(this).siblings().find('.openMinus').removeClass('doDisplay');
      $('#accordion-conf .content').slideUp('normal');
      
      if($(this).next().is(':hidden') == true) {
        $(this).closest('li').addClass('open-selected-conf');
        $(this).siblings().removeClass('open-selected-conf');
        $(this).next().slideDown('normal');
       } 
      
   });

  });
  
$('#accordion-conf .content').hide();

/* EVENT SELECTOR */
    var el = [];
    
    $('.selectbtn').each(function() {

      $(this).click(function() {

        var clicked = true;

        $('.events').addClass('hideContent');
        $(this).toggleClass('purpleBtn');

        var identification = $(this).attr('id');  

        el.push($(this).attr('id'));  
           
        console.log(el);

          if (this.id == 'all') {
            $('#parent > div').fadeIn(450);
          } else if (el){
              $.each(el, function(i, val) { 
                 $('.' + val).fadeIn(450); 
                  console.log("here is " + val);
                  if ($(identification) != val) {
                    $("." + identification).addClass('hideContent');
                  }
              });
          } else {
            $(this).click(function() {
              $(this).removeClass('purpleBtn');
                    var index = $.inArray(val, list);
                         if (index >= 0) {
                            list.splice(index, 1);
                            $('.' + val).fadeOut(450); 
                         }          
            });

            clicked = false; 
          }
      });
    });
    
    $(function() {
      $('#eventSelector').change(function(){
        $('.events').hide();
        $('.' + $(this).val()).show();
      });
    });
});