var owInitAccordion = function(id) {

  if(id == "block-accordion") {

    var $accordion = $('.block-accordion');
    var $title = $('.block-accordion .title-contain');

    $title.on('click', function() {
      $parent = $(this).parent();
      $this = $(this);
      $icon = $(this).find('.icon');

      if($parent.hasClass('active')) {

        $parent.removeClass('active');
        $icon.removeClass('icon-minus').addClass('icon-create');

      }else{
        $parent.addClass('active');
        $icon.removeClass('icon-create').addClass('icon-minus');

      }
    });
  }

  if(id = "more-search") {
    var $title = $('.more-search .sub-tab');

    $title.on('click',function(){
     var $this = $(this);

      if($this.hasClass('active')){
        $this.find('.icon').removeClass('icon-minus').addClass('icon-create');
      }else{
        $this.find('.icon').addClass('icon-minus').removeClass('icon-create');
      }

      $this.toggleClass('active');

    });
  }
};

var owInitGrid = function(id){

  if(id == 'isotope-01') {

    var $grid = $('.isotope-01').imagesLoaded(function () {
      $grid.isotope({
        itemSelector    : '.item',
        percentPosition : true,
        sortBy          : 'original-order',
        layoutMode      : 'packery',
        packery         : {
          columnWidth : '.grid-sizer'
        }
      });
    });

    return $grid;
  }

  if(id == 'isotope-02') {


    var $grid = $('.isotope-02').imagesLoaded(function () {
      $grid.isotope({
        itemSelector    : '.item',
        percentPosition : true,
        sortBy          : 'original-order',
        layoutMode      : 'packery',
        packery         : {
           gutter: 39
        }
      });
    });

    return $grid;
  }

  if(id == 'isotope-03') {

    var $grid = $('.isotope-03').imagesLoaded(function () {
      $grid.isotope({
        itemSelector    : '.item',
        percentPosition : true,
        sortBy          : 'original-order',
        layoutMode      : 'packery',
        packery         : {
          columnWidth : '.grid-sizer'
        }
      });
    });

    return $grid;
  }

};


var owsetGridBigImg  = function(grid, dom, init) {

  var $img            = $(dom).find('.card img'),
      pourcentage     = 0.30,
      nbImgAAgrandir  = $img.length * pourcentage,
      i               = 0,
      nbRamdom        = [],
      x               = 1,
      j               = 0,
      max             = 0,
      min             = 0,
      nbImage         = $img.length;

  $($img).closest('article.card').removeClass('double w2');

  if (window.matchMedia("(max-width: 1279px)").matches) {

    while (i < $img.length) {
      if (j < 15) {
        if (j == 0 || j == 5 || j == 11) {
          $($img[i]).closest('article.card').addClass('double w2');
        }
        j++;
      }
      if (j == 14) {
        j = 0;
      }
      i++;
    }

    $(dom).find('article.card:not(.double w2)').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(20,true));
      }
    });

    $(dom).find('article.card.double w2').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(50,true));
      }
    });

  } else if (window.matchMedia("(max-width: 1599px)").matches) {

    while (i < $img.length) {
      if (j < 10) {
        if (j == 0 || j == 3) {
          $($img[i]).closest('article.card').addClass('double w2');
        }
        j++;
      }
      if (j == 9) {
        j = 0;
      }
      i++;
    }

    $(dom).find('article.card:not(.double w2)').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(30,true));
      }
    });
    $(dom).find('article.card.double w2').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(60,true));
      }
    });

  } else if (window.matchMedia("(max-width: 1919px)").matches) {
    while (i < $img.length) {
      if (j < 30) {
        if (j == 0 || j == 3 || j == 12 || j == 17 || j == 25) {
          $($img[i]).closest('article.card').addClass('double w2');
        }
        j++;
      }
      if (j == 29) {
        j = 0;
      }
      i++;
    }

    $(dom).find('article.card:not(.double.w2)').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(35,true));
      }
    });

    $(dom).find('article.card.double.w2').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(65,true));
      }
    });

  } else if (window.matchMedia("(min-width: 1920px)").matches) {

    while (i < $img.length) {
      if (j < 15) {
        if (j == 0 || j == 5 || j == 14) {
          $($img[i]).closest('article.card').addClass('double w2');
        }
        j++;
      }
      if (j == 14) {
        j = 0;
      }
      i++;
    }

    $(dom).find('article.card:not(.double.w2)').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(35,true));
      }
    });

    $(dom).find('article.card.double.w2').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(80,true));
      }
    });
  }
};

var owInitAleaGrid = function(grid, dom, init) {
  var $img            = $(dom).find('.item:not(.portrait) img'),
      pourcentage     = 0.50,
      nbImgAAgrandir  = $img.length * pourcentage,
      i               = 0,
      nbRamdom        = [],
      x               = 1,
      max             = 0,
      min             = 0,
      nbImage         = $img.length;

  while(x < nbImgAAgrandir) {
    while(nbImgAAgrandir > nbRamdom.length) {
      max = nbImage * pourcentage * x;
      min = nbImage * pourcentage * (x - 1);
      nbAlea = Math.floor(Math.random() * (max - min) + min);
      nbRamdom[i] = nbAlea;
      $($img[nbRamdom[i]]).closest('article.item').addClass('double w2');
      i++;
      x++;
    }
  }

  $('.item').addClass('visible');

  grid.isotope({
    itemSelector    : '.item',
    percentPosition : true,
    sortBy          : 'original-order',
    layoutMode      : 'packery',
    packery         : {
      columnWidth : '.grid-sizer'
    }
  });

  grid.isotope('layout');
};

var owInitPopin = function(id) {


  if(id == 'popin-landing-e') {

    var $popin = $('.popin-landing-e');

    var visiblePopin = function() {
      var dateFestival = $('.compteur').data("date");

      var dateToday = new Date();
      dateFestival = new Date(dateFestival);

      var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

      var jours = Math.floor(timeLanding / (60 * 60 * 24));
      var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
      var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
      var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

      if(timeLanding < 0){
        //pas de compteur ?
      }else if(timeLanding > 0){

        var $day = $('.day').html(jours);
        var $hour = $('.hour').html(heures);
        var $minutes = $('.minutes').html(minutes);
        var $secondes = $('.secondes').html(secondes);

      }else{
        //compteur terminé ! on ferme la popin
        $popin.addClass('animated fadeOut').removeClass('visible');
      }

      actualisation = setInterval(function() {

        var dateToday = new Date();
        dateFestival = new Date(dateFestival);

        var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

        var jours = Math.floor(timeLanding / (60 * 60 * 24));
        var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
        var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
        var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));

        if(timeLanding < 0){
          //pas de compteur ?
          Cookies.set('popin-landing-e','1', { expires: 365 });

        }else if(timeLanding > 0){

          var $day = $('.day').html(jours);
          var $hour = $('.hour').html(heures);
          var $minutes = $('.minutes').html(minutes);
          var $secondes = $('.secondes').html(secondes);

        }else{
          //compteur terminé ! on ferme la popin
          $popin.addClass('animated fadeOut').removeClass('visible');
          Cookies.set('popin-landing-e','1', { expires: 365 });
        }
      }, 1000);
    };

    var fClosePopin = function() {

      $('.popin-landing-e').on('click', function(){
        $popin.addClass('animated fadeOut');
        Cookies.set('popin-landing-e','1', { expires: 365 });

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);
      });
    }

    // Verifier si les cookies existent
    if(typeof Cookies.get('popin-landing-e') === "undefined") {
      Cookies.set('popin-landing-e','0', { expires: 365 });
    }

    var closePopin = Cookies.get('popin-landing-e');

    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopin();
      fClosePopin();

    }else {

      Cookies.set('popin-landing-e','1', { expires: 365 });
    }
  }
};

var initHeaderSticky = function() {

  $(window).on('scroll', function() {
    var $header = $('header');
    var lastScrollTop = 0;
    var s = $(this).scrollTop();
    scrollTarget = s;

    // STICKY HEADER
    if(s > lastScrollTop) {
      if(($('#prehome-container').length == 0 && s > 30)) {
        $header.addClass('sticky');
        $('body').css('margin-top', '91px');
      }
    } else {
      if(($('#prehome-container').length == 0 && s < 30)) {
        $header.removeClass('sticky');
        $('body').css('margin-top', '0');
      }
    }
  });
};

var owInitNavSticky = function(number) {

  if(number == 1) {
    var $header    = $('.navigation-sticky');
  }else if(number == 2) {
    var $header    = $('.navigation-sticky-02');
  }

  $(window).on('scroll', function() {

    var pushHeight = $('.block-push-top').height();
    var s          = $(this).scrollTop();

    if(s > pushHeight) {
      $header.addClass('sticky');
    }else{
      $header.removeClass('sticky');
    }
  });
};

var owArrowDisplay = function() {

  var blockPushHeight = $('.block-push-top').height()-180;
  var s               = $(this).scrollTop();
  var footer          = $('#breadcrumb').offset().top-700;
  var $btnsArrow      = $('.arrows');



  if(s > blockPushHeight && s < footer) {
    $btnsArrow.addClass('visible')
  }else{
    $btnsArrow.removeClass('visible')
  }

  $(window).on('scroll', function() {
    var s = $(this).scrollTop();

    if(s > blockPushHeight && s < footer) {
      $btnsArrow.addClass('visible')
    }else{
      $btnsArrow.removeClass('visible')
    }
  });
};

var owInitSliderSelect = function(id) {

  if(id == "timelapse"){
    var slider = document.getElementById('timelapse');
    var snapValues = [
    	document.getElementById('slider-snap-value-lower'),
    	document.getElementById('slider-snap-value-upper')
    ];


    noUiSlider.create(slider, {
    	start: [1960, 2000],//todo script
    	connect: true,
    	range: {
    		'min': 1946,
    		'max': 2016
    	}
     });

    slider.noUiSlider.on('update', function( values, handle ) {

    	snapValues[handle].innerHTML = parseInt(values[handle]);
    });
  }

  if(id == 'tab-selection') {
    var $tab = $('.icon-s');

    $tab.on('click', function(){
      var input = $(this).find('input');

      if(input[0].checked){
        input[0].checked = false;
        $(this).removeClass('active');
      }else{
        $('.more-search').addClass('active');
        input[0].checked = true;
        $(this).addClass('active');
      }

      if(!$('.tabs-two .icon-s').hasClass('active')){
        $('.more-search').removeClass('active');
      }

    });
  }
}

/*------------------------------------------------------------------------------
    JS Document (https://developer.mozilla.org/en/JavaScript)

    project:    Festival de Cannes
    Author:     OHWEE
    created:    2016-24-03

    summary:    SLIDER HOME
----------------------------------------------------------------------------- */


var owInitSlider = function(sliderName) {
  /* SLIDER HOME
  ----------------------------------------------------------------------------- */
  if(sliderName == 'home') {

    var slide = $('.slider-carousel').owlCarousel({
      navigation          :  true,
      items               :  1,
      autoWidth           :  true,
      autoplay            :  true,
      autoplayTimeout     :  4000,
      autoplayHoverPause  :  true,
      loop                :  true,
      smartSpeed          :  700
    });

    slide.on('changed.owl.carousel', function(event) {
      setTimeout(function(){
        var $item   = $('.owl-item.active').find('.item');
        var number  = $item.data('item');
        var $active = $(".container-images .item.active");

        $active.removeClass("fadeInRight").addClass('fadeOut');

        setTimeout(function(){
          $(".container-images .item[data-item="+number+"]").removeClass('fadeOut').addClass('active fadeInRight');
          $active.removeClass('active');
        }, 500);
      }, 200);
    });
  }


  /* SLIDER 01
  ----------------------------------------------------------------------------- */
  if(sliderName == 'slider-01') {
    var slide01 = $('.slider-01').owlCarousel({
      navigation          : false,
      items               : 1,
      autoWidth           : true,
      smartSpeed          : 700,
      center              : true,
    });

    // Custom Navigation Events
    $(document).on('click', '.slider-01 .owl-item', function(){
      var number = $(this).index();

      $('.slider-01 .center').removeClass('center');
      $(this).addClass('center');
      slide01.trigger('to.owl.carousel', number);
    });
  }

  /* SLIDER 02
  ----------------------------------------------------------------------------- */
  if(sliderName == 'slider-02') {
    var slide01 = $('.slider-02').owlCarousel({
      navigation          : false,
      items               : 1,
      autoWidth           : true,
      smartSpeed          : 700,
      center              : true,
      margin              : 27.5
    });

    // Custom Navigation Events
    $(document).on('click', '.slider-02 .owl-item', function(){
      var number = $(this).index();

      $('.slider-02 .center').removeClass('center');
      $(this).addClass('center');
      slide01.trigger('to.owl.carousel', number);
    });
  }

  if(sliderName == "timelapse-01") {
    var slider = document.getElementById('timelapse-01');
    var $slide = $('.slides');
    var $slideCalc1 = $('.slides-calc1');

    var numberSlide = $('.slider-restropective').size();
    var sizeSlide = $('.slider-restropective').width();
    var finalSizeSlider = numberSlide * sizeSlide + 100;


    $slide.css('width',finalSizeSlider); // change size slider
    $slideCalc1.css('width',finalSizeSlider); // change size slider

    //init width of slide

    noUiSlider.create(slider, {
      start: [1946],//todo script
      range: {
        'min': 1946,
        'max': 2015
      }
     });

    var initDrag = 1;

     slider.noUiSlider.on('update', function( values, handle ) {

          //drag
          var w = $('body').width();
          var number = 0;

          valuesFloat = parseFloat(values[handle]);
          valuesInt = parseInt(values[handle]);
          values = Math.round(valuesFloat);
          number = values - 1946;

          if(initDrag) {
            initDrag = 0;
          }

          if(number > 0.7 && initDrag == 0){
            $('.slider-restropective[data-slide="0"]').removeClass('animated fadeIn').addClass('animated fadeOut');
          }else if(number < 0.9){
            $('.slider-restropective[data-slide="0"]').removeClass('animated fadeOut').addClass('animated fadeIn');
          }

          var val = - w * (valuesFloat - 1946); //todo script ?
          // var valCalc1 = - w * (valuesFloat - 1946) * .4; //todo script ?
          var valPos = - w * (valuesFloat - 1946) * .8; //todo script ?

          $slide.css('transform','translate('+val+'px)');
          $slideCalc1.css('transform','translate('+valPos+'px)');


          $('.slider-restropective').removeClass('big').addClass('small');
          $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
          $('.slider-restropective .texts').removeClass('zoomIn fadeIn pulse visible');

     });

     slider.noUiSlider.on('end', function(values, handle){ //end drag
       var w = $('body').width();

       valuesFloat = parseFloat(values[handle]);

       values = Math.round(valuesFloat);
       number = values - 1946;
       var val = - w * (values - 1946); //todo script ?
       $slide.css('transform','translate('+val+'px)');

       var slideElement = $('.slider-restropective[data-slide='+number+']');
       var slideElementText = $('.slider-restropective[data-slide='+number+'] .texts');

       slideElement.removeClass('small').addClass('big');

       setTimeout(function(){
         slideElementText.addClass('animated zoomIn fadeIn visible');
         setTimeout(function(){
           slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
         }, 600);
       }, 900);

       $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

     });
  }

};

var owInitTab = function(id) {

  if(id == 'tab1') {

    var $tab = $('.tab1 td');


    $tab.on('click', function(e) {
      var $element = $(this);
      var dataTab = $element.data('tab');
      var $block = $('.block-contain-txt-register-movie[data-article='+dataTab+']');

      $tab.removeClass('active');
      $element.addClass('active');

      $('.block-contain-txt-register-movie').removeClass('active animated fadeInUp');

      $block.addClass('active animated fadeInUp');
    });

  }
};

/*------------------------------------------------------------------------------
    JS Document (https://developer.mozilla.org/en/JavaScript)

    project:    Festival de Cannes
    Author:     OHWEE
    created:    2016-24-03

    summary:    CONSTANTES
                UTILITIES
                WINDOW.ONLOAD
                MENU
                VIDEOS
                PLAY
----------------------------------------------------------------------------- */

/*  =INIT
----------------------------------------------------------------------------- */

$(document).ready(function() {

 initHeaderSticky();

 //gestion des cookie a faire ici

 owInitPopin('popin-landing-e');

 // owInitSearch();

  if($('.home').length) {
    owInitSlider('home');
    owInitSlider('slider-01');
    owInitSlider('slider-02');
  }

  if($('.retrospective.poster').length) {
    owInitNavSticky(1);
  }

  if($('.retrospective-home').length) {
    owInitSlider('timelapse-01');
  }

  if($('.jury').length) {
    owInitNavSticky(2);
    owInitGrid('isotope-01');
  }

  if($('.article-single').length) {
    owInitNavSticky(1);
    owArrowDisplay();
  }

  if($('.articles-list').length) {

    var grid = owInitGrid('isotope-01');
    owsetGridBigImg(grid, $('.grid-01'), true);

    $( window ).resize(function() {
        owsetGridBigImg(grid, $('.grid-01'), false);
    });
  }

  if($('.articles-list-medias').length) {

    var grid = owInitGrid('isotope-01');

    owInitAleaGrid(grid, $('.grid-01'), true);
  }

  if($('.retrospective.palmares').length) {
    owInitNavSticky(2);
  }

  if($('.edition-69.palm-gold').length) {
    owInitNavSticky(1);
  }

  if($('.retrospective.selection').length) {
    owInitNavSticky(2);
    owInitGrid('isotope-01');
  }

  if($('.who').length) {
    owInitNavSticky(1);
  }

  if($('.who-staff').length ){
    owInitGrid('isotope-02');
  }

  if($('.who-identity-guidelines').length) {
    owInitAccordion("block-accordion");
  }

  if($('.p-register').length) {
    owInitTab('tab1');
  }

  if($('.media-library').length) {
    owInitSliderSelect('timelapse');
    owInitSliderSelect('tab-selection');

    var grid = owInitGrid('isotope-03');

    owInitAleaGrid(grid, $('.grid-01'), true);
  }

  if($('.search-page').length) {
    owInitSliderSelect('timelapse');
    owInitSliderSelect('tab-selection');
    owInitAccordion('more-search');
  }

});
