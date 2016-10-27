$(document).ready(function() {


/*CAROUSSELS OWL*/
 
  $('#owl-top').owlCarousel({
      items:1,
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      dots: true,
      loop:true,
      autoPlay:true
    });

 
  $("owl-pub").owlCarousel({
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      dots: false,
      singleItem:true,
      loop:true
  });

  $("#owl-mid").owlCarousel({
      items:1,
      dots: false,
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      navText: ["<div class='redarrowLeft'><i class='icon icon_flecheGauche'></div>","<div class='redarrowRight'><i class='icon icon_flecheGauche reverse'></div>"]
   
  });

  
  $("#owl-second").owlCarousel({
      dots: false,
      rewindNav : true,
      navigation : true,
      slideSpeed : 600,
      paginationSpeed : 400,
      items : 3,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      navText: ["<div class='redarrowLeft'><i class='icon icon_flecheGauche'></div>","<div class='redarrowRight'><i class='icon icon_flecheGauche reverse'></div>"]
 
  });


/* BOX SERVICES */

  	var servicesBoxes = $('.services-boxes');
  	var selectedBox = $('.services-pictures div');

  	$(servicesBoxes).hover(function() {
  	      $(selectedBox).toggleClass('hide')
  	      $('#' + $(this).data('rel')).toggleClass('show');
  	});

/* MENU */

function menuMDF() {

	var blackBckg = $(".blackBckg");

	$("#edition, #subMenu").hover(function() {

		$(blackBckg).toggleClass("showblackBckg");

		});

    $('.seeSub').hover(function() {
      $('.liMargin').toggleClass('littleMargin');
      $('.subsubMenu').toggleClass('seesubsubMenu');
    });

  $('.prog, .subsubMenu').hover(function() {
      $('.rotateArrow').toggleClass('arrowRotated');
    });

  $("#edition, #subMenu").hover(function() {
        $('#subMenu').show();
        $('#subMenu').toggleClass("showMenu");
        $('.tleft, .tright').toggleClass("showT");

  });

}

menuMDF();


function hoverSearch() {

      $('#searchBar').click(function() {
            $('#navigation li').toggleClass('marginli');
            $('#searchBar').toggleClass('marginLastli');
            $('.searchBox').toggleClass("showsearchBox");
            $('.icon_recherche').toggleClass("blackIcon");
        });

      $('.searchBox').hover(function() {
            $('#navigation li').addClass('marginli');
            $('#searchBar').addClass('marginLastli');
            $('.searchBox').addClass("showsearchBox");
            $('.icon_recherche').addClass("blackIcon");
        });

    $(".liSearchBox").mouseover(function() {

            $('#navigation li').addClass('marginli');
            $('#searchBar').addClass('marginLastli');
            $('.searchBox').addClass("showsearchBox");
            $('.icon_recherche').addClass("blackIcon");

      }).mouseout(function() {

            $('#navigation li').removeClass('marginli');
            $('#searchBar').removeClass('marginLastli');
            $('.searchBox').removeClass("showsearchBox");
            $('.icon_recherche').removeClass("blackIcon");
      
    });

  }

hoverSearch();

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
    
    $(this).click(function(){
      
      $('#accordion-menu .open').siblings().removeClass('open-selected');
      $('#accordion-menu .open').removeClass('open-selected');
      $('#accordion-menu .open').closest('li').removeClass('open-selected');
      $(this).find('.openPlus').toggleClass('noDisplay');
      $(this).find('.openMinus').toggleClass('doDisplay');
      $('#accordion-menu .content').slideUp('normal');
      
      if($(this).next().is(':hidden') == true) {
        $(this).closest('li').addClass('open-selected');
        $(this).siblings().removeClass('open-selected');
        $('.openPlus').removeClass('noDisplay');
        $('.openMinus').removeClass('doDisplay');
        $(this).find('.openPlus').addClass('noDisplay');
        $(this).find('.openMinus').addClass('doDisplay');
        $(this).next().slideDown('normal');
       } 
   });

  });
  
$('#accordion-menu .content').hide();

/* EVENT SELECTOR */

function click() {
    var el = [];
    var clicked;
    
    $('.selectbtn').click(function() {

      var identification = $(this).attr('id'); 

        if($(this).hasClass('purpleBtn')) {
            $(this).removeClass('purpleBtn');
            console.log("class removed");
              var index = el.indexOf(identification);
              if (index > -1) {
                  el.splice(index, 1);
              }
              $('.' + identification).fadeOut(450); 
              console.log("removed " + identification);
              console.log(el);

              if (this.id == 'all' || el.length < 1 ) {
                $('.parent > div').fadeOut(450);

                  $('.parent').append('<div class="events message">aucun évenement sélectionné</div>');
              } 
            
          }

      else {

        $('.events').addClass('hideContent');
        $(this).addClass('purpleBtn'); 

        el.push(identification);  
           
        console.log(el);

          if (this.id == 'all') {
            $('.parent > div').fadeIn(450);
            $('.message').empty();
          } else if (el){
              $.each(el, function(i, val) { 
                /*$(this).closest('li').addClass('open-selected-conf');*/
                 $('.' + val).fadeIn(450); 
                  console.log("here is " + val);
                  if ($(identification) != val) {
                    $("." + identification).addClass('hideContent');
                  }
              });
          }

      }
    });

    $('#accordion-conf .open').each(function() {
        
        $(this).click(function(){
          
          $('#accordion-conf .open').siblings().removeClass('open-selected-conf');
          $('#accordion-conf .open').removeClass('open-selected-conf');
          $('#accordion-conf .open').closest('li').removeClass('open-selected-conf');
          $(this).find('.openPlus').toggleClass('noDisplay');
          $(this).find('.openMinus').toggleClass('doDisplay');
          $('#accordion-conf .content').slideUp('normal');
          
          if($(this).next().is(':hidden') == true) {
            $(this).closest('li').addClass('open-selected-conf');
            $(this).siblings().removeClass('open-selected-conf');
            $('.openPlus').removeClass('noDisplay');
            $('.openMinus').removeClass('doDisplay');
            $(this).find('.openPlus').addClass('noDisplay');
            $(this).find('.openMinus').addClass('doDisplay');
            $(this).next().slideDown('normal');
           } 
       });

      });
      
    $('#accordion-conf .content').hide();
}

click();

    
    $(function() {
      $('#eventSelector').change(function(){
        $('.events').hide();
        $('.' + $(this).val()).show();
      });
    });
});