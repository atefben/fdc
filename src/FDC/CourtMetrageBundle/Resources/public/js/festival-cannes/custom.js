if ($('#slider-discover .item').length < 4) {


    var owl = $('#slider-discover').owlCarousel({
        items:3,
        dots: false,
    });
} else {
    var owl = $('#slider-discover').owlCarousel({
        dots: true,
        navigation : true,
        slideSpeed : 600,
        navText: ["<div class='goldarrowLeft'><i class='icon icon_flecheGauche'></div>","<div class='goldarrowLeft'><i class='icon icon_flecheGauche reverse'></div>"],
        paginationSpeed : 400,
        items : 3
    });
}

owl.on('changed.owl.carousel', function (event) {
    if (event.item.count - event.page.size == event.item.index)
        $(event.target).find('.owl-dots div:last')
            .addClass('active').siblings().removeClass('active');
});


// slider competitions
var sliderCompetition = $("#slider-competition").owlCarousel({
    nav: false,
    dots: false,
    smartSpeed: 500,
    loop: false,
    margin: 50,
    autoWidth: true,
    dragEndSpeed: 600,
    responsive:{
        0:{
            items: 4
        },
        1675: {
            items: 5
        }
    },
    onInitialized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-competition .owl-stage').css({ 'margin-left': m });
    },
    onResized: function() {
        var m = ($(window).width() - $('.container').width()) / 2;
        $('#slider-competition .owl-stage').css({ 'margin-left': m });
    }
});

sliderCompetition.owlCarousel();


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
    $('.owl-dot').click(function() {

        var clicked = $(this);

        $('.owl-dot').removeClass('active');
        $(this).addClass('active');

    });
}

  $('#slider-aboutVideos').owlCarousel({
      dots: true,
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

            var activeFilters = [];

            $('.selectbtn').each(function () {
                if ($(this).hasClass('purpleBtn')) {
                    activeFilters.push($(this).attr("id"));
                }
            });


            console.log("class removed");
              var index = el.indexOf(identification);
              if (index > -1) {
                  el.splice(index, 1);
              }
              var indexRel = el.indexOf(attr);
              if (indexRel > -1) {
                  el.splice(indexRel, 1);
              }

            $('.' + identification).each(function () {
                var $this = $(this);
                var isSafe = true;
                activeFilters.forEach(function (item) {
                    if ($this.hasClass(item)) {
                        isSafe = false;
                        return;
                    }
                });

                if (isSafe) {
                    $(this).fadeOut(200);
                }
            });

            $('#' + attr).hide();
              console.log("removed " + identification);
              console.log(el);

              if (this.id == 'all' || el.length < 1 ) {
                  $('.parent > div').fadeIn(200);
                  /*$('.parent').append('<div class="events eventMessage">aucun évenement sélectionné</div>');*/
                  /*$('.selectText').hide();*/
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
            $('.eventMessage').empty();
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

    /*$('.conferencesMenu li').click(function() {
      $('html, body').animate({
          scrollTop: $(this).offset().top
        }, 500);
    });*/

}

click();


function smoothScrolling() {

    $('#accordion-conf li').each(function() {

      var clicked = $(this);

          $(clicked).click(function(){

            if(!$(clicked).hasClass('open-selected-conf')) {
              $('#accordion-conf li').siblings().removeClass('open-selected-conf');
              $('#accordion-conf li').removeClass('open-selected-conf');
              $(clicked).toggleClass('open-selected-conf');
              $('.openPlus').removeClass('noDisplay');
              $('.openMinus').removeClass('doDisplay');
              $(clicked).find('.openPlus').toggleClass('noDisplay');
              $(clicked).find('.openMinus').toggleClass('doDisplay');
              }

              else {
                $(clicked).removeClass('open-selected-conf');
                $('.openPlus').removeClass('noDisplay');
                $('.openMinus').removeClass('doDisplay');
              }



         });

      });

}

smoothScrolling();

/*
$(".conferencesMenu li").each(function() {

  $(this).click(function() {

    $('html,body').animate({

      scrollTop:$('.conferencesMenu').offset().top +  $(this).prevAll().height()

    },'slow');





    $('html,body').animate({ scrollTop:$(this).siblings('.conferencesMenu li:first').offset().top  }, 'slow');
      return false;

    if ($('.conferencesMenu li:first-child)')) {
        $('html,body').animate({ scrollTop:$(this).prev().offset().top }, 'slow');
        return false;
    }

  });
});*/

$(".conferencesMenu li").on('click', function(event) {

  var target = $($(this).prev());

  if( target.length ) {
      event.preventDefault();
      $('html, body').animate({
          scrollTop: target.offset().top
      }, 500);
  }

});

// Quick & dirty toggle to demonstrate modal toggle behavior
//  Moved to ../custom.js.
// $('.modal-toggle').on('click', function(e) {
//   e.preventDefault();
//   $('.modal').toggleClass('is-visible');
// });


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

/*$(window).scroll(function (e) {
  if($(window).scrollTop() > 100) {
        $(".topiconsContainer").hide();
      } else {
        $(".topiconsContainer").show();
      }
});*/

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

$(".blocks").each(function () {
  $(this).hover(function () {
    $(this).toggleClass('opacity');
    $(this).find(".plusSign").toggleClass("rotationplusSign");
  });
});


$("#share-article").click(function(){
  if(document.getElementById('share')) {
    $('html, body').animate({
      scrollTop: $("#share").offset().top - 400
    }, 2000);
  }
});

/*$(window).resize(function(){

    if ( $(window).width() < 1280) {
      var title = $('.item .name').html();
      var shortText = jQuery.trim(title).substring(0, 30)
          .split(" ").slice(0, -1).join(" ") + "...";
      $('.item .name').html(title + shortText);
    }

}*/

String.prototype.shorten = function (n, useWordBoundary, end) {
    end = end || '...';
  var isTooLong = this.length > n,
      s_ = isTooLong ? this.substr(0, n - end.length) : this;
  s_ = (useWordBoundary && isTooLong) ? s_ + end : s_;
  return s_;
};

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

        // title.text(text.shorten(30, true));
        // subtitle.text(subtext.shorten(30, true));
        convertText(author, authorResult, 30, true, '...', ',');
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

        // title.text(text.shorten(35, true));
        // subtitle.text(subtext.shorten(35, true));
        convertText(author, authorResult, 35, true, '...', ',');


    });
    $.each($('.articles-content'), function (i, e) {

      var title = $(e).find('h6');

      if (!title.hasClass('init')) {
        var text = $(e).find('h6').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
      }

        title.text(text.shorten(60, true));

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
        var authorResult = $(e).find('.author').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
        var subtext = subtitle.attr('data-title');
        var authorResult = author.attr('data-title');
      }

        // title.text(text.shorten(45, true));
        // subtitle.text(subtext.shorten(45, true));
        convertText(author, authorResult, 98, true, '...', ',');

    });
    $.each($('.articles-content'), function (i, e) {

      var title = $(e).find('h6');

      if (!title.hasClass('init')) {
        var text = $(e).find('h6').text();
        title.addClass('init');
        title.attr('data-title', text);
      } else {
        var text = title.attr('data-title');
      }

        title.text(text.shorten(60, true));

    });
  }

function convertText(elements, string, length, addEnd, end, separator) {
    var shortenArray = string.shorten(length, addEnd, end).split(separator);
    var lengthShorten = shortenArray.length;

    elements.each(function (key, item) {
        var text = shortenArray[key];
        if (key != lengthShorten - 1) {
            text = text + ', ';
        }
        $(item).text(text);
    });
}

if ( $("body").hasClass( "who" ) ) {

  var fixedNav = false;
   var topTriggerNav = $('.navigation-sticky').offset().top - 210;
   $(document).scroll(function() {
     if( $(this).scrollTop() >= topTriggerNav ) {
       if( !fixedNav ) {
         fixedNav = true;
         $('.navigation-sticky').addClass("subNavigationFixed");
       }
     } else {
       if( fixedNav ) {
         fixedNav = false;
         $('.navigation-sticky').removeClass("subNavigationFixed");
       }
     }
  });

}

if ( $("#main").hasClass( "single-article" ) && $('.list-article').length > 0 ) {
  var fixed = false;
   var topTrigger = $('.list-article').offset().top +10;
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
}


