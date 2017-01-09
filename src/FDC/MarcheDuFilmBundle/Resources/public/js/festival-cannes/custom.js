$(document).ready(function() {


/*CAROUSSELS OWL*/
 
  $('#owl-top').owlCarousel({
      items:1,
      navigation : true,
      dots: true,
      loop:true,
      autoplay:true,
      slideSpeed : 300,
      paginationSpeed : 400
    });


  $('#owl-accred').owlCarousel({
      items:1,
      navigation : true,
      dots: false,
      loop:true,
      autoplay:true,
      slideSpeed : 300,
      paginationSpeed : 400,
      navText: ["<div class='goldarrowLeft customClass3'><i class='icon icon_flecheGauche customClass3'></div>","<div class='goldarrowLeft customClass3'><i class='icon icon_flecheGauche reverse customClass3'></div>"]
    });
  
  $('#owl-projections').owlCarousel({
      items:1,
      navigation : true,
      dots: false,
      loop:true,
      autoplay:true,
      slideSpeed : 300,
      paginationSpeed : 400,
      navText: ["<div class='goldarrowLeft customClass3'><i class='icon icon_flecheGauche customClass3'></div>","<div class='goldarrowLeft customClass3'><i class='icon icon_flecheGauche reverse customClass3'></div>"]
    });

  $('#owl-mid').owlCarousel({
      items:1,
      dots: false,
      navigation : true,
      slideSpeed : 300,
      paginationSpeed : 400,
      singleItem:true,
      navText: ["<div class='redarrowLeft customClass3'><i class='icon icon_flecheGauche customClass3'></div>","<div class='redarrowRight customClass3'><i class='icon icon_flecheGauche reverse customClass3'></div>"]
   
  });

  $('.owl-pub, #owl-pub').owlCarousel({
          singleItem:true,
          dots: true
  });
  
  $('#owl-second').owlCarousel({
      dots: false,
      navigation : true,
      slideSpeed : 600,
      paginationSpeed : 400,
      items : 3,
      navText: ["<div class='redarrowLeft customClass3'><i class='icon icon_flecheGauche customClass3'></div>","<div class='redarrowRight customClass3'><i class='icon icon_flecheGauche reverse customClass3'></div>"]
 
  });

/* BOX SERVICES and RESULTS*/

    var servicesBoxes = $('.services-boxes');
    var selectedBox = $('.services-pictures div');

    $(servicesBoxes).hover(function() {
          $(selectedBox).toggleClass('hide')
          $('#' + $(this).data('rel')).toggleClass('show');
    });

    var searchResult = $('.resultClick');
    var searchBox = $('.results-content .contents');

    $(searchResult).each(function() {
      $(this).click(function(event) {
        event.stopPropagation();
          $(searchBox).addClass('hide');
          $(searchBox).removeClass('show');
          $('.' + $(this).attr("rel")).removeClass('hide');
          $('.' + $(this).attr("rel")).addClass('show');
          $(searchBox).addClass('activeContent');
          $(searchBox).removeClass('activeContent');
          $('.' + $(this).attr("rel")).removeClass('activeContent');
          $('.' + $(this).attr("rel")).addClass('activeContent');
      });
    });

    $(".seeallResults").click(function() {
          $(searchBox).removeClass('hide');
          $(searchBox).removeClass('show');
    });

    $(".resultClick").click(function() {
      $(this).find("h6").addClass("active");
      $(this).find("span").addClass("active");
      $(this).siblings().find("h6").removeClass("active");
      $(this).siblings().find("span").removeClass("active");
    });

/* MENU */

function menuMDF() {

  var blackBckg = $(".blackBckg");

    $('.seeSub').hover(function() {
      $('.liMargin').toggleClass('littleMargin');
      $('.subsubMenu').toggleClass('seesubsubMenu');
    });

  $('.prog, .subsubMenu').hover(function() {
      $('.rotateArrow').toggleClass('arrowRotated');
    });

  $("#edition, #subMenu").hover(function() {
        $('.tleft, .tright').toggleClass("showT");
        $('#subMenu').show();
        $('#subMenu').toggleClass("showMenu");
        $(blackBckg).toggleClass("showblackBckg");

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

      });

    $("#main, #logo-wrapper, .text-presentation ").click(function(e){
          $('#navigation li').removeClass('marginli');
          $('#searchBar').removeClass('marginLastli');
          $('.searchBox').removeClass("showsearchBox");
          $('.icon_recherche').removeClass("blackIcon");
      });
  }

hoverSearch();


$(window).scroll(function(){
   if ($(this).scrollTop() > 400 && $(this).scrollTop() < 2000) {
        $(".floatingButtonLeft, .floatingButtonRight").addClass("showBtn");
    }
    else {
      $(".floatingButtonLeft, .floatingButtonRight").removeClass("showBtn");
    }
});

$(window).scroll(function(){
    if ($("body").scrollTop() > $(".contact-box").offset().top) {
            $(".floatingButtonLeft, .floatingButtonRight").hide();
    }

});

$('.floatingButtonLeft').hover(function() {
    $('.showLeft').toggle();
});

$('.floatingButtonRight').hover(function() {
    $('.showRight').toggle();
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
        $('.marketnewsSelector').toggleClass("showmarketnewsSelector");
    });

    

/* CONFERENCES */

   $('.confBtn').click(function() {

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

/* MARKET NEWS*/

    $('.marketnewsBtn').click(function() {

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
            $('.selectText').hide();
            $('.selectText').addClass('hideAll');
            $('#showAll').show();
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
}

click();

    
    $(function() {
      $('#eventSelector').change(function(){
        $('.events').hide();
        $('.' + $(this).val()).show();
      });
    });
});


if (window.matchMedia("(max-width: 1279px)").matches) {

    $.each($('.item'), function (i, e) {

      var title = $(e).find('.name');
      var subtitle = $(e).find('.sub-name');
      var author = $(e).find('.author');

      if (!title.hasClass('init')) {
        var text = $(e).find('.name').text();
        var subtext = $(e).find('.sub-name').text();
        var authorResult = $(e).find('.author').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
        var subtext = subtitle.attr('data-title');
        var authorResult = author.attr('data-title');
      }

        title.html(text.trunc(70, true));
        subtitle.html(subtext.trunc(70, true));
        author.html(authorResult.trunc(70, true));

    });
  }

  else if (window.matchMedia("(max-width: 1600px)").matches) {

    $.each($('.item'), function (i, e) {

      var title = $(e).find('.name');
      var subtitle = $(e).find('.sub-name');
      var author = $(e).find('.author');

      if (!title.hasClass('init')) {
        var text = $(e).find('.name').text();
        var subtext = $(e).find('.sub-name').text();
        var authorResult = $(e).find('.author').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
        var subtext = subtitle.attr('data-title');
        var authorResult = author.attr('data-title');
      }

        title.html(text.trunc(35, true));
        subtitle.html(subtext.trunc(35, true));
        author.html(authorResult.trunc(35, true));

    });
    $.each($('.dynamic .articles-content'), function (i, e) {

      var title = $(e).find('h6');

      if (!title.hasClass('init')) {
        var text = $(e).find('h6').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
      }

        title.html(text.trunc(70, true));

    });
  }

  else if (window.matchMedia("(max-width: 2000px)").matches) {

    $.each($('.item'), function (i, e) {

      var title = $(e).find('.name');
      var subtitle = $(e).find('.sub-name');
      var author = $(e).find('.author');

      if (!title.hasClass('init')) {
        var text = $(e).find('.name').text();
        var subtext = $(e).find('.sub-name').text();
        var subtext = $(e).find('.author').text();
        var authorResult = $(e).find('.author').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
        var subtext = subtitle.attr('data-title');
        var authorResult = author.attr('data-title');
      }

        title.html(text.trunc(60, true));
        subtitle.html(subtext.trunc(60, true));
        author.html(authorResult.trunc(60, true));

    });
    $.each($('.dynamic .articles-content'), function (i, e) {

      var title = $(e).find('h6');

      if (!title.hasClass('init')) {
        var text = $(e).find('h6').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
      }

        title.html(text.trunc(70, true));

    });
  }

String.prototype.trunc = function (n, useWordBoundary) {
    var isTooLong = this.length > n,
        s_ = isTooLong ? this.substr(0, n - 1) : this;
    s_ = (useWordBoundary && isTooLong) ? s_.substr(0, s_.lastIndexOf(' ')) : s_;
    return isTooLong ? s_ + '...' : s_;
};

var fixed = false;
 var topTrigger = $('.subNavigation').offset().top - 250;
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
 });







/*if ($('.selectText').length > 1) {
    $('.selectText').addClass('virgule');
} else if ($('.selectText').is(':last-child') && $('.selectText').is(":visible"))  {

  $(this).removeClass('virgule');

}*/