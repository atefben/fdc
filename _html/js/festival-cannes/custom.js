
  $('#slider-discover').owlCarousel({
      dots: true,
      navigation : true,
      slideSpeed : 600,
      navText: ["<div class='goldarrowLeft'><i class='icon icon_flecheGauche'></div>","<div class='goldarrowLeft'><i class='icon icon_flecheGauche reverse'></div>"],
      paginationSpeed : 400,
      items : 3
  });


  $('#slider-competition').owlCarousel({
      dots: false,
      navigation : false,
      slideSpeed : 600,
      paginationSpeed : 400,
      margin: 22,
      items : 6
 
  });


  $('#slider-movies').owlCarousel({
    loop: true,
    autoplay: true,
    items: 1,
    nav: true,
    video:true,
    autoplayHoverPause: true,
    animateOut: 'slideOutUp',
    animateIn: 'slideInUp'
 
  });


  var fixOwl = function(){
        var $stage = $('.owl-stage'),
            stageW = $stage.width(),
            $el = $('.owl-item'),
            elW = 0;
        $el.each(function() {
            elW += $(this).width()+ +($(this).css("margin-right").slice(0, -2))
        });
        if ( elW > stageW ) {
            $stage.width( elW );
        };
    }

  $('#slider-aboutVideos').owlCarousel({
      dots: true,
      autoWidth:true,
      video:true,
      videoHeight: 450,
      videoWidth: 725, 
      navigation : false,
      slideSpeed : 600,
      paginationSpeed : 400,
      items : 1,
      onInitialized: fixOwl,
      onRefreshed: fixOwl
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


/* SELECTOR DROPDOWN FROM DROPWDOWNS */

    $(".dropdown").click(function() {

        $('.dropArrow').toggleClass('dropArrowOpen');
    });

    $(".select input").click(function() {

        $('.selectArrow').addClass('selectArrowReversed');
    });

    $(".select option").click(function() {

        $('.selectArrow').removeClass('selectArrowReversed');
    });

    $('.selection').change(function () {
                $(this).find('option:selected').addClass('active');
                $(this).find('option:checked').addClass('active');
    });
    
    $(".formContainer input, .formContainer textarea").click(function() {

        $(this).removeClass('redRequired');
    });

    $(".selection option").click(function() {

        $(this).addClass('active');
        $(this).find('option:selected').addClass('active');
    });
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

$('.accordion-infos .open').each(function() {
    
    $(this).click(function(){
      
      $('.accordion-infos .open').siblings().removeClass('open-selected');
      $('.accordion-infos .open').removeClass('open-selected');
      $('.accordion-infos .open').closest('li').removeClass('open-selected');
      $(this).find('.openPlus').toggleClass('noDisplay');
      $(this).find('.openMinus').toggleClass('doDisplay');
      $('.accordion-infos .content').slideUp('normal');
      
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
  
$('.accordion-infos .content').hide();

/* EVENT SELECTOR */

function click() {
    var el = [];
    var clicked;
    var selectbtn = $('.selectbtn');
    
    $('.dropdown span').click(function() {
        $('#eventSelector').toggleClass("showeventSelector");
    });
    

    $('.selectbtn').click(function() {
      var identification = $(this).attr('id');
      var attr = $(this).attr("rel");

        if($(this).hasClass('purpleBtn')) {
            $(this).removeClass('purpleBtn');


            console.log("class removed");
              var index = el.indexOf(identification);
              if (index > -1) {
                  el.splice(index, 1);
              }
              var indexRel = el.indexOf(attr);
              if (indexRel > -1) {
                  el.splice(indexRel, 1);
              }

              $('.' + identification).fadeOut(200); 
              $('#' + attr).hide(); 
              console.log("removed " + identification);
              console.log(el);

              if (this.id == 'all' || el.length < 1 ) {
                  $('.parent > div').fadeOut(200);
                  $('.parent').append('<div class="events message">aucun évenement sélectionné</div>');
                  $('.selectText').hide();
              } else if (this.id == 'all') {
                  $('.selectText').hide();
              }
            
          }

      else {

        $('.events, .selectText').addClass('hideContent');
        $(this).addClass('purpleBtn');
        $('.parent > div').hide();
        el.push(identification);
        el.push(attr);
           
        console.log(el);

          if (this.id == 'all') {
            $('.parent > div').fadeIn(200);
            $('.selectText').show();
            $('.selectText').removeClass('hideContent');
            $('.message').empty();
            $(this).addClass('purpleBtn');
            $(this).siblings().removeClass('purpleBtn');
            $('.events').removeClass('hideContent');
            el = [];
            console.log(el);
          } else if (el){
              $('.selectText').hide();
              $.each(el, function(i, val) {  
                 $('.' + val).show();
                 $('.' + val).removeClass('hideContent');
                 $('#all').removeClass('purpleBtn');
                 $('#' + val).show();
                  console.log("here is " + val);
                  console.log("here is " + attr);
                  if ($(identification) != val) {
                    $("." + identification).addClass('hideContent');
                  }
              });
             $('#' + attr).show();
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
    $('#accordion-conf .firstContent').show();
}

click();


// Quick & dirty toggle to demonstrate modal toggle behavior
$('.modal-toggle').on('click', function(e) {
  e.preventDefault();
  $('.modal').toggleClass('is-visible');
});


// CATALOGUE

var len = $(".blocks");
  if($(len).length === 3) {
    $(".blocks").addClass("thirdBlocks");
  } else if ($(len).length === 4){
    $(".blocks").addClass("quarterBlocks");
  } else if ($(len).length === 5) {
    $(".blocks").addClass("fifthBlocks");
  }

$('.showCourts').on('click', function(e) {
  e.preventDefault();
  $('.shortFilm').show();
  $('.coursMetrages').hide();
});

$('.showShorts').on('click', function(e) {
  e.preventDefault();
  $('.shortFilm').hide();
  $('.coursMetrages').show();
});
  
function simpleParallax() {
    //This variable is storing the distance scrolled
    var scrolled = $(window).scrollTop() + 1;

    //Every element with the class "scroll" will have parallax background 
    //Change the "0.3" for adjusting scroll speed.
    $('').css('background-position', '0' + -(scrolled * 0.3) + 'px');
}
//Everytime we scroll, it will fire the function
$(window).scroll(function (e) {
    simpleParallax();
});


$( "#slider-movies > .owl-controls" ).wrap( "<div class='container'></div>" );

$(window).scroll(function (e) {
  if($(window).scrollTop() > 100) {
        $(".topiconsContainer").hide();
      } else {
        $(".topiconsContainer").show();
      }
});

$(".topiconsContainer .first").hover(function () {
    $(this).toggleClass("goldBdrs");
    $(".topiconsContainer .second").toggleClass("noBdrs");
});

$(".topiconsContainer .second").hover(function () {
    $(this).toggleClass("middlegoldBdrs");
});

$(".topiconsContainer .third").hover(function () {
    $(this).toggleClass("lastgoldBorders");
});


$("#share-article").click(function(){
   $('html, body').animate({
        scrollTop: $("#share").offset().top - 400
    }, 2000);
});
/*
var fixed = false;
 var topTrigger = $('.subNavigation').offset().top;
 $(document).scroll(function() {
   if( $(this).scrollTop() >= topTrigger ) {
     if( !fixed ) {
       fixed = true;
       $('.subNavigation').addClass("subNavigationFixed");
     }
   } else {
     if( fixed ) {
       fixed = false;
       $('.subNavigation').removeClass("subNavigationFixed");
     }
   }
 });*/

/* PROS DU COURT : ADD BORDERS 

$(".selectbtn").click(function(){
  $(".box:visible").each(function() {
    if ($(this).index(1)){
        $(this).addClass('redBorder');
    } else if ($(this).index(2)){
        $(this).addClass('greyBorder');
    } 
  });
});*/