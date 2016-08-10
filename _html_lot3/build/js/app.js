var owInitAccordion = function(id) {

  if(id == "block-accordion") {

    var $accordion = $('.block-accordion');
    var $title = $('.block-accordion .title-contain');

    $title.on('click', function() {
      $parent = $(this).closest('.item');
      $this = $(this);
      $icon = $(this).find('.icon-nav-accordion');

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

var owInitAjax = function() {

  $('.ajax-section nav a').on('click', function(e){
    e.preventDefault;

    var url = $(this).attr('href');

    $.get( url, function( data ) {
      data = $(data);
      data = data.find('.contain-ajax')[0];
      $( ".ajax-section" ).html( data );

      if($('.navigation-sticky-02').length) {
        owInitNavSticky(2);
      }else if($('.navigation-sticky').length) {
        owInitNavSticky(1);
      }

      if($('.isotope-01').length) {
        owInitGrid('isotope-01');
      }

      if($('.isotope-02').length) {
        owInitGrid('isotope-02');
      }

      if($('.grid-01').length) {
        var grid = owInitGrid('isotope-01');
        owsetGridBigImg(grid, $('.grid-01'), true);

        $( window ).resize(function() {
            owsetGridBigImg(grid, $('.grid-01'), false);
        });
      }

      if($('.filters').length) {
        owInitFilter();
      }

      if($('.block-accordion').length) {
          wInitAccordion("block-accordion");
      }

      if($('.block-social-network').length) {
        initRs();

        if($('#share-article').length) {
          $('#share-article').on('click', function(e) {
            e.preventDefault();

            $('html, body').animate({
              scrollTop: $(".block-social-network").offset().top - $('header').height() - $('.block-social-network').height() - 300
            }, 500);
          });
        }
      }

      window.history.pushState('','',url);

      owInitAjax();
    });

    return false;
  });
}


var owInitReadMore = function() {
  var number = 0;
  
  $('.read-more.ajax-request').on('click', function(e){
    e.preventDefault();

    var url = $(this).attr('href');

      if(number%2 == 0){
        $.get( url, function( data ) {
          data = $(data);
           $('.add-ajax-request').append(data);
        });
      }else{
        url = $(this).data('reverse');

        $.get( url, function( data ) {
          data = $(data);
          $('.add-ajax-request').append(data);
        });
      }

      number++;


  });
}
// Filters
// =========================

var owInitFilter = function(){
  // on click on a filter
  $('body').on('click', '.filters .select span', function() {
    var h = $(this).parent().html();

    $('#filters').remove();
    $('body').append('<div id="filters"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon-close"></i></div></div>');
    $('#filters .vCenterKid').html(h);
    $('#filters .vCenterKid').find(':not(span)').remove();
    $('#filters .vCenterKid').find('span.disabled').remove();
    $('#filters').attr('data-id', $(this).parents('.filter').attr('id'));

    setTimeout(function() {
      $('#filters').addClass('show');
    }, 100);

    setTimeout(function() {
      $('#filters span').addClass('show');
    }, 400);

    $('#filters span').on('click', function() {
      var id = $('#filters').data('id'),
          f  = $(this).data('filter');

      $('#' + id + ' .select span').removeClass('active');
      $('#' + id + ' .select span[data-filter="'+f+'"]').addClass('active');

      owInitGrid('filter');
    });

  });

  // close filters
  $('body').on('click', '#filters', function() {
    $('#filters').removeClass('show');
    setTimeout(function() {
      $('#filters').remove();
    }, 700);
  });


  // filter data on page
/*  $('body').on('click', '#filters span', function() {


    var id = $('#filters').data('id'),
        f  = $(this).data('filter');

    $('#' + id + ' .select span').removeClass('active');
    $('#' + id + ' .select span[data-filter="'+f+'"]').addClass('active');

    owInitGrid('filter');
  });*/
};


var owRemoveElementListe = function() {
  $('.filters-02 li .icon-close').on('click', function(){
    $(this).parent().remove();


    if(!$('.new-filter ul li').length) {
      $('.new-filter').parent().remove();
    }

  });
}

var addNextFilters = function() {
  $('.filters-02 li.more').on('click', function(e){
    e.preventDefault();

    $(this).remove();

    var url = $(this).attr("data-url");

    $.get( url, function(data) {
      $('.c-filters').append(data);

      $('.filters-02 li.more').off('click');
      $('.filters-02 li .icon-close').off('click');

      owRemoveElementListe();
      addNextFilters();
      owInitNavSticky(3);
    });
  });
}


var owInitFilterSearch = function() {
  var block = $('.block-searh-more');

  $('.result-more').on('click', function(e){
    e.preventDefault();

    block.toggleClass('visible');
  })
}
var owFixMobile = function() {

  $('header .hasSubNav').on('click', function(){
    var element = $(this).find('ul');
    element.toggleClass('visible');
  });

    $('#logo-wrapper, section').on('click', function(){
      if($('header .hasSubNav ul').hasClass('visible')){
        var element = $('header').find('ul.visible');
        element.removeClass('visible');
      }
    });

}

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

  if(id == 'filter'){

    if($('.isotope-01').length){

      var filterDate = '',
          filterTheme = '',
          filterFormat = '';

      if($('.filters #date').length > 0) {
        filterDate = $('.filters #date .select span.active').data('filter');
        filterDate = "."+filterDate;
      }else

      if($('.filters #theme').length > 0) {
        filterTheme = $('.filters #theme .select span.active').data('filter');
        filterTheme = "."+filterTheme;
      }

      if($('.filters #format').length > 0) {
        filterFormat = $('.filters #format .select span.active').data('filter');
        filterFormat = "."+filterFormat;
      }

      var filters = filterDate+filterTheme+filterFormat;

      var $grid = $('.isotope-01').isotope({filter: filters});
    }

    if($('.isotope-02').length){

      var filterStaff = $('.filters #staff .select span.active').data('filter');
      filterStaff = "."+filterStaff;


      var $grid = $('.isotope-02').isotope({filter: filterStaff});
    }
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

var owInitLinkChangeEffect = function() {

  $('header a, footer a, .cards a, .block-push a, .block-infos a, .small-push a, .texte-01 a, .item a, .link').on('click', function(e) {

    e.preventDefault();

    var url = $(this).attr('href');

    $('.overlay').addClass('animated fadeIn visible');

    setTimeout(function(){
        window.history.pushState('','',url);
        window.location.reload();

    }, 1000);

    return false;
  });
}

var owInitPopin = function(id) {


  if(id == 'popin-landing-e') {

    console.log('popin-1');

    var $popin = $('.popin-landing-e');

    var visiblePopin = function() {
      var dateFestival = $('.compteur').data("date");
      console.log(dateFestival);
      
      var dateToday = new Date();
      dateFestival = new Date(dateFestival);

      console.log(dateFestival);
      
      var timeLanding = (dateFestival - dateToday) / 1000; //en seconde

      var jours = Math.floor(timeLanding / (60 * 60 * 24));
      var heures = Math.floor((timeLanding - (jours * 60 * 60 * 24)) / (60 * 60));
      var minutes = Math.floor((timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60))) / 60);
      var secondes = Math.floor(timeLanding - ((jours * 60 * 60 * 24 + heures * 60 * 60 + minutes * 60)));


      if(timeLanding < 0){
        //pas de compteur ?
        console.log('popin-2');

      }else if(timeLanding > 0){
        console.log('popin-3');


        var $day = $('.day').html(jours);
        var $hour = $('.hour').html(heures);
        var $minutes = $('.minutes').html(minutes);
        var $secondes = $('.secondes').html(secondes);

      }else{
        console.log('popin-4');

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
      console.log('popin-5');


      $('.popin-landing-e').on('click', function(){
        console.log('popin-6');


        $popin.addClass('animated fadeOut');
        Cookies.set('popin-landing-e','1', { expires: 365 });

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);
      });
    }

    // Verifier si les cookies existent
    if(typeof Cookies.get('popin-landing-e') === "undefined") {
      Cookies.set('popin-landing-e','0', { expires: 365 });
      console.log('popin-7');

    }

    var closePopin = Cookies.get('popin-landing-e');

    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopin();
      fClosePopin();
      console.log('popin-8');

    }else {
      console.log('popin-9');

      Cookies.set('popin-landing-e','1', { expires: 365 });
    }
  }

  if(id == 'popin-timer-banner') {

    var $popin = $('.b-timer');

    var visiblePopinB = function() {
      var dateFestival = $('.time').data("date");

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
          Cookies.set('popin-banner','1', { expires: 365 });

        }else if(timeLanding > 0){

          var $timer = $('.time').html(jours+' : '+heures+' : '+minutes+' : '+secondes);

        }else{
          //compteur terminé ! on ferme la popin
          $popin.addClass('animated fadeOut').removeClass('visible');
          Cookies.set('popin-banner','1', { expires: 365 });
        }
      }, 1000);

      setTimeout(function(){
/*
        fClosePopinB('force'); 
*/
      }, 5000);

    };

    var fClosePopinB = function(force) {

      if(force == 'force'){
        $popin.addClass('animated fadeOut');

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);

      }

      $('.c-icon').on('click', function(){
        $popin.addClass('animated fadeOut');
        Cookies.set('popin-banner','1', { expires: 365 });

        setTimeout(function(){   $popin.removeClass('visible'); }, 500);
      });
    }

    // Verifier si les cookies existent
    if(typeof Cookies.get('popin-banner') === "undefined") {
      Cookies.set('popin-banner','0', { expires: 365 });
    }

    var closePopin = Cookies.get('popin-banner');

    console.log(closePopin);

    if(closePopin == 0) {
      $popin.addClass('animated fadeIn').addClass('visible');
      visiblePopinB();
      fClosePopinB();

    }else {
      Cookies.set('popin-banner','1', { expires: 365 });
    }

  }

};

var initHeaderSticky = function () {

    $(window).on('scroll', function () {
        var $header = $('header');
        var lastScrollTop = 0;
        var s = $(this).scrollTop();
        scrollTarget = s;

        // STICKY HEADER
        if (s > lastScrollTop) {
            if (($('#prehome-container').length == 0 && s > 30)) {
                $header.addClass('sticky');
                $('body').css('margin-top', '91px');
            }
        } else {
            if (($('#prehome-container').length == 0 && s < 30)) {
                $header.removeClass('sticky');
                $('body').css('margin-top', '0');
            }
        }
    });
};

var owInitNavSticky = function (number) {

    if (number == 1) {
        var $header = $('.navigation-sticky');
    } else if (number == 2) {
        var $header = $('.navigation-sticky-02');
    } else if (number == 3) {
        var $header = $('.filters-02');
    }

    $(window).on('scroll', function () {

        var pushHeight = $('.block-push-top').height();
        var s = $(this).scrollTop();

        if (s > pushHeight) {
            $header.addClass('sticky');
        } else {
            $header.removeClass('sticky');
        }

        if ($('header').hasClass('sticky') && number == 3) {
            $header.addClass('sticky');
        }
    });
};

var owArrowDisplay = function () {

    var blockPushHeight = $('.block-push-top').height() - 180;
    var s = $(this).scrollTop();
    var footer = $('#breadcrumb').offset().top - 700;
    var $btnsArrow = $('.arrows');


    if (s > blockPushHeight && s < footer) {
        $btnsArrow.addClass('visible')
    } else {
        $btnsArrow.removeClass('visible')
    }

    $(window).on('scroll', function () {
        var s = $(this).scrollTop();

        if (s > blockPushHeight && s < footer) {
            $btnsArrow.addClass('visible')
        } else {
            $btnsArrow.removeClass('visible')
        }
    });
};

var onInitParallax = function () {

    if (!$('body').hasClass('mobile')) {

        $(window).on('scroll', function () {

            if ($('header.sticky').length) {
                var s = $(this).scrollTop() - 0;
                $('.block-push').css('background-position', '0px ' + s + 'px');
            } else {
                $('.block-push').css('background-position', '0px ' + '0px');
            }

        });
    }

};


var owInitFooterScroll = function () {
    if ($('#breadcrumb').length) {
        $('#breadcrumb .goTop').on('click', function () {
            $('html, body').animate({
                scrollTop: 0
            }, 'slow');
        });
    }
}

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

//setup twitter

window.twttr = (function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        t = window.twttr || {};
    if (d.getElementById(id)) return t;
    js = d.createElement(s);
    js.id = id;
    js.src = "https://platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js, fjs);

    t._e = [];
    t.ready = function (f) {
        t._e.push(f);
    };

    return t;
}(document, "script", "twitter-wjs"));


var initRs = function () {

    $('.print').on('click', function(e){
        e.preventDefault();
    })

    $('.block-social-network .twitter, .rs-slideshow .twitter').on('click', function () {
        window.open(this.href, '', 'width=600,height=400');
        return false;
    });


    //POPIN facebook SHARE
    $('.block-social-network .facebook, .rs-slideshow .facebook').on('click', function () {
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    });

    function initPopinMail(cls) {
        // check that fields are not empty
        $(cls + ' input[type="text"]', cls + ' textarea').on('input', function () {
            var input = $(this);
            var is_name = input.val();

            if (typeof $(this).attr('required') != undefined && $(this).attr('required') && is_name.length > 0) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();
            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + '</li>');
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        $('body').on('click', '.selectOptions span', function () {
            var i = parseInt($(this).index()) + 1;
            $('select option').eq(i).prop('selected', 'selected');
            $('.select').removeClass('invalid');
        });

        // check valid email address
        $(cls + ' input[type="email"]').on('input', function () {
            var input = $(this);
            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var is_email = re.test(input.val());
            var is_email_name = input.val();

            if (!is_email_name) {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

            } else if (is_email) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();

            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error + '</li>');
                // TODO remove string //
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        // check valid email address
        $('#contact_email').on('input', function () {
            var input = $(this);
            var re = /^([\w+-.%]+@[\w-.]+\.[A-Za-z]{2,4},?)+$/i;
            var is_email = re.test(input.val());
            var is_email_name = input.val();

            if (!is_email_name) {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

            } else if (is_email) {
                input.removeClass("invalid").addClass("valid");
                $('.errors .' + input.attr('name')).remove();

            } else {
                input.removeClass("valid").addClass("invalid");
                $('.errors .' + input.attr('name')).remove();
                $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error + '</li>');
                // TODO remove string //
            }

            if ($('.invalid').length) {
                $('.errors').addClass('show');
            } else {
                $('.errors').removeClass('show');
            }
        });

        // on submit : check if there are errors in the form
        $(cls + ' form').on('submit', function (e) {
            e.preventDefault();
            var $that = $(this);
            var empty = false;

            if ($('select').val() == 'default') {
                $('.select').addClass('invalid');
            } else {
                $('.select').removeClass('invalid');
            }

            $(cls + ' input[type="text"], ' + cls + ' input[type="email"], ' + cls + ' textarea').each(function () {
                if (typeof $(this).attr('required') != undefined && $(this).attr('required') == true && $(this).val() == '') {
                    empty = true;
                }
            });

            if (empty) {
                $(cls + ' input[type="email"], ' + cls + ' input[type="text"], ' + cls + ' textarea').trigger('input');
            }

            if ($('.invalid').length || empty) {
                return false;
            } else {
                // TODO envoie du mail //
                var u = $(cls).hasClass('media') ? GLOBALS.urls.shareEmailMediaUrl : GLOBALS.urls.shareEmailUrl;

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    cache: false,
                    url: u,
                    data: $(cls).find('form#form').serialize(),
                    success: function (data) {
                        if (data.success == false) {

                        }
                        else {
                            // TODO envoie du mail //
                            $(cls).find('#form').remove();
                            $(cls).find('.info-popin').remove();
                            $(cls).find('#msg').append('<div class="valid">' + GLOBALS.texts.popin.valid + '</div>');
                            $(cls).css('height', '31%');
                            return false;
                        }
                    }
                });
            }
        });
    }


    if ($('.popin-mail').length > 0) {
        initPopinMail('.popin-mail');

        $('.popin-mail-open').on('click touchstart', function (e) {
            e.preventDefault();

            $('.overlay-popin').addClass('visible-popin');

            $('.overlay-popin').on('click', function (e) {

                if (!$(e.target).hasClass('popin')) {
                    $(this).removeClass('visible-popin');
                }
            });
        });
    }

    //LINK POPIN//
    function linkPopinInit(link, cls) {
        var link = link || document.location.href;
        var cls = cls || '.link.self';


        new Clipboard(cls);

        $(cls).attr('data-clipboard-text', link);

        $(cls).on('click touchstart', function (e) {
            var that = $(this);
            e.preventDefault();

            if (!$('#share-box').length) {

                $('.texts-clipboard').append('<div id="share-box"><div class="bubble"><a href="#">' + GLOBALS.texts.popin.copy + '</a></div></div>');

                $('#share-box').animate({'opacity': '1'}, 400, function () {
                    $('#share-box').addClass('show');
                    setTimeout(function () {
                        $('#share-box .bubble').html('<a href="#">' + that.attr('data-clipboard-text') + '</a>');
                    }, 1000);
                });
            } else if ($('#share-box').hasClass('show')) {
                $('#share-box').removeClass('show');
                $('#share-box').remove();
            }

/*           setTimeout(function () {
                $('#share-box').animate({'opacity': 0}, 200, function () {
                    $('#share-box').removeClass('show');
                    $('#share-box').remove();
                });
            }, 3000);*/
        });

    }

    linkPopinInit();
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
      center              : true
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
  if(sliderName == 'slider-02' && !$('.s-video-playlist').length) {

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

    //Init var
    var slider = document.getElementById('timelapse-01');
    var $slide = $('.slides');
    var $slideCalc1 = $('.slides-calc1');
    var $slideCalc1Slide = $('.slides-calc1 .slide');
    var $slideCalc2 = $('.slides-calc2');

    var numberSlide = $('.slider-restropective').size();
    var sizeSlide = $('.slider-restropective').width();
    var finalSizeSlider = numberSlide * sizeSlide + 100;

    var initOpenAjax = function() { //ajax
      $('.discover').on('click', function(e){

        e.preventDefault();
        var url = $(this).data('url');

        $.get(url, function(data) {

          $('.slider-restropective').addClass('isOpen block-push block-push-top background-effet');
          $('.timelapse').css('display','none');
          $('.discover').css('display','none');
          $('.slides-calc2').css('display','none');
          $('.title-big-date').addClass('title-2').removeClass('title-big-date');
          $('.title-edition').addClass('title-4').removeClass('title-edition');

          var imgurl = $('.block-push-top.big .container img').attr('src');
          $('.block-push-top.big .container img').css('display','none');

          $('.block-push-top.big').css('background-image','url('+imgurl+')');

          var data = $(data).find('.contain-ajax');

          $('.ajax-section').html(data);
          owInitNavSticky(1);

          window.history.pushState('','',url);
         });

         return false;
      });
    }

    // init slider
    $slide.css('width',finalSizeSlider); // change size slider
    $slideCalc1.css('width',finalSizeSlider); // change size slider

    //init width of slide
    noUiSlider.create(slider, {
      start: [1945],//todo script
      range: {
        'min': 1945,
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
      number = values - 1945;

      $('.slides-calc1 .date').html(valuesInt);

      $('.big img').removeClass('open');
      $('.slider-restropective .calc3').css('display','block');
      $('.slider-restropective .calc4').css('display','block');

      if(initDrag) {
        initDrag = 0;
      }

      if(valuesInt > 1945){
        $('.slides-calc1').css('display','block');
        $('.slides-calc2.navigation').removeClass('begin');
      }else {
        $('.slides-calc1').css('display','none');
        $('.slides-calc2.navigation').addClass('begin');
      }

      if(number > 0.7 && initDrag == 0){
        $('.slider-restropective[data-slide="0"]').removeClass('animated fadeIn').addClass('animated fadeOut');
        $('.slides-calc1').removeClass('animated fadeOut').addClass('animated fadeIn');
      }else if(number < 0.9){
        $('.slider-restropective[data-slide="0"]').removeClass('animated fadeOut').addClass('animated fadeIn');
        $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');
      }

      //paralax calc 3

      var val2 = - (valuesFloat - 1945 - number) * 380; //todo script ?
      $('.slider-restropective[data-slide='+number+'] .calc3').css('transform','translate('+val2+'px)');

      //paralax cal 4

      var val3 = - (valuesFloat - 1945 - number) * 80; //todo script ?
      $('.slider-restropective[data-slide='+number+'] .calc4').css('transform','translate('+val3+'px)');

      var val = - w * (valuesFloat - 1945) * .8; //todo script ?
      var valPos = w * (valuesFloat - 1945) * .8; //todo script ?

      $slide.css('transform','translate('+val+'px)');

      $('.slider-restropective').removeClass('big').addClass('small');
      $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
      $('.slider-restropective .texts').removeClass('zoomIn fadeIn pulse visible');

     });

     slider.noUiSlider.on('end', function(values, handle){ //end drag

       var w = $('body').width();
       valuesFloat = parseFloat(values[handle]);
       values = Math.round(valuesFloat);
       number = values - 1945;
       var val = - w * (values - 1945); //todo script ?

       $slide.css('transform','translate('+val+'px)');

       $('.slider-restropective .calc3').css('display','none');
       $('.slider-restropective .calc4').css('display','none');

       var slideElement = $('.slider-restropective[data-slide='+number+']');
       var slideElementText = $('.slider-restropective[data-slide='+number+'] .texts');

       slideElement.removeClass('small').addClass('big');
       $('.big img').addClass('open');

       setTimeout(function(){

         slideElementText.addClass('animated zoomIn fadeIn visible');
         $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

         setTimeout(function(){

           slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
           $('.slides-calc1').css('display','none');
           initOpenAjax();
         }, 600);
       }, 900);

       $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

     });

     var animation = function(event) {

       var date = $('.slides-calc1 .date').html();
       date = parseInt(date);

       if(event == "next"){
         date = date +1;
         slider.noUiSlider.set([date]);
         stopAnimation();
       }

       if(event == "prev"){
         date = date -1;
         slider.noUiSlider.set([date]);
         stopAnimation();
       }

       if(event == "next-open"){
         date = date +1;
         slider.noUiSlider.set([date]);
         animationOpen();
       }

       if(event == "prev-open"){
         date = date -1;
         slider.noUiSlider.set([date]);
         animationOpen();
       }

       return false;
     }

     var stopAnimation = function() {

       var w = $('body').width();
       values = $('.slides-calc1 .date').html();
       number = values - 1945;
       var val = - w * (values - 1945); //todo script ?


       $slide.css('transform','translate('+val+'px)');

       $('.slider-restropective .calc3').css('display','none');
       $('.slider-restropective .calc4').css('display','none');

       var slideElement = $('.slider-restropective[data-slide='+number+']');
       var slideElementText = $('.slider-restropective[data-slide='+number+'] .texts');

       slideElement.removeClass('small').addClass('big');
       $('.big img').addClass('open');

       setTimeout(function(){

         slideElementText.addClass('animated zoomIn fadeIn visible');
         $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

         setTimeout(function(){

           slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
           $('.slides-calc1').css('display','none');
           initOpenAjax();

         }, 600);
       }, 900);

       $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
     }

      var animationOpen = function() {
        var w = $('body').width();
        values = $('.slides-calc1 .date').html();
        number = values - 1945;
        var val = - w * (values - 1945) - 10; //todo script ?
        var slideElement = $('.slider-restropective[data-slide='+number+']');
        var slideElementText = $('.slider-restropective[data-slide='+number+'] .texts');

        $('.slider-restropective .calc3').css('display','none');
        $('.slider-restropective .calc4').css('display','none');

        $slide.css('transform','translate('+val+'px)');
        $('.slides-calc1').css('display','none');
        slideElement.addClass('big');

        var imgurl = $('.block-push-top.big .container img').attr('src');
        $('.block-push-top.big .container img').css('display','none');
        $('.block-push-top.big').css('background-image','url('+imgurl+')');

        setTimeout(function(){

          slideElementText.addClass('animated zoomIn fadeIn visible');
          $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

          setTimeout(function(){

            slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
            $('.slides-calc1').css('display','none');
            initOpenAjax();

          }, 600);
        }, 900);
      }
     // ON CLICK

     $('.slides-calc2.next').on('click', function(){
       animation('next');
     });

     $('.slides-calc2.prev').on('click', function(){
       animation('prev');
     });


     $('.date-next').on('click', function(){
       animation('next-open');

       var $this = $(this);

       var url = $this.data('url');

       console.log(url);

       $.get(url, function(data) {
        var data = $(data).find('.contain-ajax');

         $('.ajax-section').html(data);
         owInitNavSticky(1);

         window.history.pushState('','',url);
        });

     });

     $('.date-back').on('click', function(){


       var url = $(this).data('url');


       $.get(url, function(data) {
         var data = $(data).find('.contain-ajax');

         $('.ajax-section').html(data);
         owInitNavSticky(1);

         window.history.pushState('','',url);
       });

       animation('prev-open');
     });

     if($('.restrospective-init').length) {


       var w = $('body').width();
       values = $('.slides-calc1 .date').data('date');

       slider.noUiSlider.set([values]);

       number = values - 1945;
       var val = - w * (values - 1945) - 10; //todo script

       $slide.css('transform','translate('+val+'px)');

       animationOpen();
      }
  }
};

$(window).resize(function() {

  if($('.retrospective').length) {

     var $slide = $('.slides');
     var $slideCalc1 = $('.slides-calc1');

     var w = $('body').width();
     var numberSlide = $('.slider-restropective').size();
     var sizeSlide = $('.slider-restropective').width();
     var finalSizeSlider = numberSlide * sizeSlide + 1800;

     $slide.css('width',finalSizeSlider); // change size slider
     $slideCalc1.css('width',finalSizeSlider); // change size slider

     values = $('.slides-calc1 .date').html();
     number = values - 1945;
     var val = - w * (values - 1945); //todo script ?


     $slide.css('transform','translate('+val+'px)');

  }
});

/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider, hash) {

    $('.block-diaporama .item').on('mousedown', function () {

        if ($(this).parent().hasClass('active center') && !$('.owl-stage').hasClass('owl-grab')) {
            openSlideShow(slider);
        }

    });


    if (typeof hash != "undefined") {
        setTimeout(function () {
            openSlideShow(slider, hash);
        }, 100);
    }

}


var openSlideShow = function (slider, hash) {

    $('body').addClass('slideshow-open');

    var images = [];
    var w = $(window).width();
    var centerElement = 0;
    var caption = "";


    slider.find('.item').each(function (index, value) {

        if ($(value).parent().hasClass('active center')) {
            centerElement = index;
        }

        var src = $(value).find('img').attr("src");
        var alt = $(value).find('img').attr("alt");
        var title = $(value).find('img').attr("data-title");
        var label = $(value).find('img').attr("data-label");
        var date = $(value).find('img').attr("data-date");
        caption = $(value).find('img').attr('data-credit');
        var id = $(value).find('img').attr('data-id');
        var facebookurl = $(value).find('img').attr('data-facebookurl');
        var twitterurl = $(value).find('img').attr('data-facebookurl');
        var url = $(value).find('img').attr('data-url');

        var image = {
            id: id,
            url: url,
            src: src,
            alt: alt,
            title: title,
            label: label,
            date: date,
            caption: caption,
            facebookurl: facebookurl,
            twitterurl: twitterurl
        };

        images.push(image);

    });

    if(typeof hash == "undefined") {
        hash = images[centerElement].id;
        var hashPush = '#'+hash;
        history.pushState(null, null, hashPush);
    }

    $(window).resize(function () {
        w = $(window).width();
        translate = -(w + 1) * centerElement;
        $('.fullscreen-slider').css('transform', 'translateX(' + translate + 'px)');
    });

    var goToNextPrev = function (direction) {
        w = $(window).width();

        var place = centerElement+1;

        if (direction == 0 && place <= images.length) { //go next

            if (place === images.length) {
                centerElement = 0;
                goToSLide(centerElement);
            }else{
                centerElement += 1;
                goToSLide(centerElement);
            }
        }

        if (direction == 1 && place > 0 ) { //go prev

            if (centerElement == 0 ) {
                centerElement = images.length - 1;
                goToSLide(centerElement);
            }else{
                centerElement -= 1;
                goToSLide(centerElement);
            }
        }

        numberDiapo = centerElement + 1;
        var title = $('.c-fullscreen-slider').find('.title-slide');
        var pagination = $('.c-fullscreen-slider').find('.chocolat-pagination');
        var label = $('.c-fullscreen-slider').find('.category');
        var date = $('.c-fullscreen-slider').find('.date');
        var caption = $('.c-fullscreen-slider').find('.credit');
        var facebook = $('.c-fullscreen-slider').find('.rs-slideshow .facebook');
        var twitter = $('.c-fullscreen-slider').find('.rs-slideshow .twitter');
        var link = $('.c-fullscreen-slider').find('.rs-slideshow .link');

        title.html(images[centerElement].title);
        pagination.html(numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i>');
        label.html(images[centerElement].label);
        date.html(images[centerElement].date);
        caption.html(images[centerElement].caption)

        facebook.attr('href', images[centerElement].facebookurl);
        twitter.attr('href', images[centerElement].twitter);
        link.attr('data-clipboard-text', images[centerElement].url);
    }

    var goToSLide = function(id) {
        w = $(window).width();

        centerElement = id;
        translate = -(w + 1) * centerElement;
        fullscreen.addClass('animated fadeOut');

        setTimeout(function () {
            fullscreen.css('transform', 'translateX(' + translate + 'px)');
            fullscreen.removeClass('fadeOut').addClass('animated fadeIn');
        }, 700);

        hash = "#"+images[id].id;

        history.pushState(null, null, hash);
    }

    /* Initiliasion du slideshow fullscreen*/
    $('body').prepend('<div class="c-fullscreen-slider"><div class="fullscreen-slider"> </div></div>');
    var fullscreen = $('body').find(".fullscreen-slider");

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    if (typeof hash != "undefined") {

        for (var i = 0; i < images.length; i++) {

            if (images[i].id == hash) {
                console.log(images[i].id);
                centerElement = i;
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' />");
            } else {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "'/>");
            }
        }

    } else {
        for (var i = 0; i < images.length; i++) {

            if (i == centerElement) {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' />");
            } else {
                fullscreen.append("<img src='" + images[i].src + "' alt='" + images[i].data + "'/>");
            }
        }
    }

    var translate = (w + 1) * centerElement;
    translate = -translate + "px";


    numberDiapo = centerElement + 1;

    fullscreen.css('transform', 'translateX(' + translate + ')');

    $('.c-fullscreen-slider').addClass('chocolat-wrapper');

    $('.c-fullscreen-slider').append('<div class="chocolat-top"><i class="icon icon-close chocolat-close"></i></div>');

    $('.c-fullscreen-slider').append('<div class="c-chocolat-bottom">' +
        '<div class="chocolat-bottom">' +
        '<span class="chocolat-fullscreen"></span>' +
        '<span class="chocolat-description"><span class="category">' + images[centerElement].label + '</span><span class="date">' + images[centerElement].date + '</span><h2 class="title-slide">' + images[centerElement].title + '</h2></span>' +
        '<span class="chocolat-pagination"> ' + numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i></span>' +
        '<span class="chocolat-set-title"></span>' +
        '<div class="thumbnails owl-carousel owl-theme owl-loaded">' +
        '</div>' +
        '<div class="credit">' + images[centerElement].caption + '</div>' +
        '<a href="" class="share"><i class="icon icon-share"></i></a>' +
            '<div class="buttons square img-slideshow-share rs-slideshow">' +
            '<div class="texts-clipboard"></div>' +
            '<a href="'+images[centerElement].facebookurl+'" rel="nofollow" class="button facebook ajax">' +
            '<i class="icon icon-facebook"></i></a>' +
            '<a href="'+images[centerElement].twitterurl+'" class="button twitter">' +
            '<i class="icon icon-twitter"></i></a>' +
            '<a href="#" rel="nofollow" class="link self button" data-clipboard-text="'+images[centerElement].url+'"><i class="icon icon-link"></i></a>' +
        '<a href="#" class="button popin-mail-open"><i class="icon icon-letter"></i></a></div>' +
        '<div class="chocolat-left active"><i class="icon icon-arrow-left"></i></div>' +
        '<div class="chocolat-right active"><i class="icon icon-arrow-right"></i></div>' +
        '</div>' +
        '</div>');

    initRs();

    var thumbnails = $('.c-fullscreen-slider').find('.thumbnails');

    for (var i = 0; i < images.length; i++) {

        if(i == centerElement) {
            thumbnails.append("<div class='thumb active center'>" +
                "<img data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
                "</div>");
        }else{

        thumbnails.append("<div class='thumb'>" +
            "<img  data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
            "</div>");
        }
    }


    thumbnailsSlide = $('.chocolat-wrapper .thumbnails').owlCarousel({
        nav: false,
        dots: false,
        smartSpeed: 500,
        margin: 0,
        autoWidth: true,
        URLhashListener: false
    });

    thumbs = thumbnails.find(".thumb");

    $(thumbs).on('click', function () {

        if (!$('.c-fullscreen-slider .owl-stage').hasClass('owl-grab')) {

            $(thumbs).removeClass('active');
            $(this).addClass('active');

            id = $(this).find('img').attr('data-id');

            goToSLide(id);

            $('.chocolat-pagination').removeClass('active');
            $('.chocolat-wrapper .thumbnails').removeClass('open');
            $('.chocolat-content').removeClass('thumbsOpen');
            $('.fullscreen-slider img').css('opacity', '1');
        }
    });


    /*
     slider.addClass('fullscreen-slider');
     */

    $('.share').on('click', function(e){
        e.preventDefault();
        $('.rs-slideshow').toggleClass('show');
    });

    $('.chocolat-right').on('click', function () {
        goToNextPrev(0);
    })

    $('.chocolat-left').on('click', function () {
        goToNextPrev(1);
    })

    $('.chocolat-pagination').on('click', function () {
        $('.thumbnails').toggleClass('open');
        $(this).toggleClass('active');

        if ($('.thumbnails').hasClass('open')) {
            $('.fullscreen-slider img').css('transition', '.5s').css('opacity', '.5');
        } else {
            $('.fullscreen-slider img').css('opacity', '1');
        }
    })

    $('.chocolat-close').on('click', function(){
       $('.c-fullscreen-slider').addClass('animated fadeOut');

        setTimeout(function(){
            $('.c-fullscreen-slider').remove();
        }, 1000);
    });

    // mouseover img : close thumbs
    $('.fullscreen-slider').on('mouseover', function () {
        $('.chocolat-pagination').removeClass('active');
        $('.chocolat-wrapper .thumbnails').removeClass('open');
        $('.chocolat-content').removeClass('thumbsOpen');
        $('.fullscreen-slider img').css('opacity', '1');
    });
}




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

var owInitValidateNewsletter = function() {

    var errorMsg = '';
    $('.newsletter #email').on('focus', function() {
        if($(this).val() == GLOBALS.texts.newsletter.errorsNotValide || $(this).val() == GLOBALS.texts.newsletter.errorsMailEmpty ||
            errorMsg != '') {
            $(this).val('');
            $(this).removeClass('error');
        }
    });

    // on submit : check if there are errors in the form
    $('.newsletter form').on('submit', function() {

        var input = $('.newsletter #email');
        var empty = false;

        if($('#email').val() == '') {
            empty = true;
            input.addClass("error").val(GLOBALS.texts.newsletter.errorsMailEmpty);
        } else {

            var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            var is_email=re.test(input.val());
            if(is_email){
                input.removeClass("error");
            }
            else {
                input.addClass("error").val(GLOBALS.texts.newsletter.errorsNotValide);
            }
        }

        if($('.newsletter .error').length || empty) {
            return false;
        } else {
            event.preventDefault();
            event.stopPropagation();

            $.ajax({
                type     : "POST",
                dataType : "json",
                cache    : false,
                url      : GLOBALS.urls.newsletterUrl,
                data     : $('form#newsletter').serialize(),
                success: function(data) {
                    if (data.success == false) {
                        input.addClass("error");
                        input.val(data.object);
                        errorMsg = data.object;
                    }
                    else {
                        $('.newsletter form').addClass('hide');
                        $('#confirmation span').html($('#email').val());
                        $('#confirmation').addClass('show');
                    }
                }
            });

            return false;
        }
    });
}
var timeout = 1000,
    thread,
    time,
    controlBar =
        '<div class="control-bar">\
            <div class="playstate">\
                <button class="play-btn play icon icon-play"></button>\
            </div>\
            <div class="time">\
                <p class="time-info">\
                    <span class="current-time">0:00</span> / <span class="duration-time">0:00</span>\
                </p>\
            </div>\
            <div class="progress">\
                <div class="progress-bar">\
                    <div class="buffer-bar"></div>\
                    <div class="current-bar"></div>\
                </div>\
            </div>\
            <div class="sound">\
                <button class="icon icon-sound"></button>\
                <div class="sound-bar">\
                    <div class="sound-seek"></div>\
                </div>\
            </div>\
            <div class="fs">\
                <button class="icon icon-fullscreen"></button>\
            </div>\
        </div>',
    topBar =
        '<div class="top-bar">\
            <a href="#" class="channels"><i class="icon icon-playlist"></i></a>\
            <div class="info"></div>\
            <div class="buttons square img-slideshow-share rs-slideshow">\
                <a class="facebook button" href="http://www.facebook.com/dialog/feed?app_id=1198653673492784&link=http://www.festival-cannes.com/fr/films/bacalaureat&picture=http://affif-sitepublic-media-prod.s3-website-eu-west-1.amazonaws.com/film_poster/0001/02/thumb_1458_film_poster_293x397.jpeg&name=BACALAUREAT%20-%20Festival%20de%20Cannes&caption=&description=Romeo%2C%20m%C3%A9decin%20dans%20une%20petite%20ville%20de%20Transylvanie%2C%20a%20tout%20mis%20en%20%C5%93uvre%20pour%20que%20sa%20fille%2C%20Eliza%2C%20soit%20accept%C3%A9e%20dans%20une%20universit%C3%A9%20anglaise.%20%0D%0AIl%20ne%20reste%20plus%20%C3%A0%20la%20jeune%20fille%2C%20tr%C3%A8s%20bonne%20%C3%A9l%C3%A8ve%2C%20qu%E2%80%99une%20formalit%C3%A9%20qui%20ne%20devrait%20pas%20poser%20de%20probl%C3%A8me%20%3A%20obtenir%20son%20baccalaur%C3%A9at.%20%0D%0AMais%20Eliza%20se%20fait%20agresser%20et%20le%20pr%C3%A9cieux%20s%C3%A9same%20semble%20brutalement%20hors%20de%20port%C3%A9e.%20Avec%20lui%2C%20c%E2%80%99est%20toute%20la%20vie%20de%20Romeo%20qui%20est%20remise%20en%20question%20quand%20il%20oublie%20alors%20tous%20les%20principes%20qu%E2%80%99il%20a%20inculqu%C3%A9s%20%C3%A0%20sa%20fille%2C%20entre%20%20compromis%20et%20compromissions%E2%80%A6&redirect_uri=http://www.festival-cannes.com/fr/sharing&display=popup"><i class="icon icon-facebook"></i></a>\
                <a class="twitter button" href="https://twitter.com/intent/tweet?text=BACALAUREAT%20http://www.festival-cannes.com/fr/films/bacalaureat"><i class="icon icon-twitter"></i></a>\
                <a href="#" rel="nofollow" class="link self button" data-clipboard-text="http://www.festival-cannes.com/fr/films/bacalaureat"><i class="icon icon-link"></i></a>\
                <a href="#" class="popin-mail-open button"><i class="icon icon-letter"></i></a>\
            </div>\
            <div class="texts-clipboard"></div>\
        </div>',
    slider =
        '<div class="channels-video">\
            <div class="slider-channels-video owl-carousel sliderDrag">\
            </div>\
        </div>',
    slide =
        '<div class="channel video shadow-bottom">\
            <div class="image-wrapper">\
                <img src="" alt="" width="293" height="185">\
            </div>\
            <a class="linkVid" href="#"></a>\
            <div class="info">\
                <div class="picto"><i class="icon icon-playlist"></i></div>\
                    <div class="info-container">\
                        <div class="vCenter">\
                            <div class="vCenterKid">\
                            <a href="#" class="category"></a>\
                            <span></span>\
                            <p></p>\
                        </div>\
                    </div>\
                </div>\
            </div>\
        </div>',
    facebookLink = 'http://www.facebook.com/dialog/feed?app_id=1198653673492784' +
        '&link=CUSTOM_URL' +
        '&picture=CUSTOM_IMAGE' +
        '&name=CUSTOM_NAME' +
        '&caption=' +
        '&description=CUSTOM_DESC' +
        '&redirect_uri=http://www.festival-cannes.com/fr/sharing' +
        '&display=popup',
    twitterLink  = "//twitter.com/intent/tweet?text=CUSTOM_TEXT";

function playerInit(id, cls, havePlaylist, live) {
    cls          = cls || 'video-player';
    havePlaylist = havePlaylist || false;
    live         = live || false;
    var tmp;

    if (id) {
        var videoPlayer = jwplayer(id);
        if(!$(videoPlayer).data('loaded')) {
            playerLoad($("#"+id)[0], videoPlayer, havePlaylist, live, function(vid) {
                $(vid).data('loaded', true);
                tmp = vid;
            });
        } else {
            tmp = videoPlayer
        }
        return tmp;
    } else {
        tmp = [];
        $("."+cls).each(function(i,v) {
            // console.log("",this);
            // console.log("",this.className);
            // console.log("",this.id);
            var videoPlayer  = jwplayer(this.id);
            if(!$(videoPlayer).data('loaded')) {
                playerLoad(this, videoPlayer, havePlaylist, live, function(vid) {
                    $(vid).data('loaded', true);
                    tmp[i] = vid;
                });
            } else {
                tmp[i] = videoPlayer;
            }
        });
        return tmp;
    }
};

function playerLoad(vid, playerInstance, havePlaylist, live, callback) {
    var $container    = $("#"+vid.id).closest('.video-container');

    if($container.find('.control-bar').length <= 0) {
        $container.append(controlBar);
    }
    if($container.find('.top-bar').length <= 0) {
        $(topBar).insertAfter($container.find('#'+vid.id));
    }


    var $infoBar      = $container.find('.infos-bar'),
        $stateBtn     = $container.find('.play-btn'),
        $durationTime = $container.find('.duration-time'),
        $current      = $container.find('.current-time'),
        $progressBar  = $container.find('.progress-bar'),
        $fullscreen   = $container.find('.icon-fullscreen'),
        $sound        = $container.find('.sound'),
        $topBar       = $container.find('.top-bar'),
        $playlist     = [];

    console.log($infoBar.find('.info').html());

    $topBar.find('.info').append($infoBar.find('.info').html());

    if($('.container-webtv-ba-video').length > 0) {
        var shareUrl = $('.video .video-container').attr('data-link');
    } else {
        var shareUrl = GLOBALS.urls.videosUrl+'#vid='+$container.data('vid');
    }

    // CUSTOM LINK FACEBOOK
    var fbHref = $topBar.find('.buttons .facebook').attr('href');
    fbHref = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
    $topBar.find('.buttons .facebook').attr('href', fbHref);
    // CUSTOM LINK TWITTER
    var twHref = $topBar.find('.buttons .twitter').attr('href');
    if(typeof $container.data('name') != 'undefined' && $container.data('name').length > 0) {
        twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($container.data('name')+" "+shareUrl));
    } else {
        twHref = twHref.replace('CUSTOM_TEXT', encodeURIComponent($topBar.find('.info p').text()+" "+shareUrl));
    }
    $topBar.find('.buttons .twitter').attr('href', twHref);

    // CUSTOM LINK COPY
    $topBar.find('.buttons .link').attr('href', shareUrl);
    $topBar.find('.buttons .link').attr('data-clipboard-text', shareUrl);
/*
    linkPopinInit(shareUrl, '#'+vid.id+' + .'+$topBar[0].className.replace(' ','.')+' .buttons .link');
*/

    $topBar.find('.buttons .facebook').on('click',function() {
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=700,height=500');
        return false;
    });
    $topBar.find('.buttons .twitter').on('click', function() {
        window.open(this.href,'','width=700,height=500');
        return false;
    });

    // CUSTOM LINK MAIL
    $topBar.find('.buttons .popin-mail-open').attr('href', $container.data('email'));
    $topBar.find('.buttons .popin-mail-open').on('click', function(e) {
        fullScreenApi.cancelFullScreen();
    });



    function updateVolume(x, vol) {
        var volume = $sound.find('.sound-bar'),
            percentage;
        if (vol) {
            percentage = vol;
        } else {
            var position = x - volume.offset().left;
            percentage = 100 * position / volume.width();
        }

        if (percentage > 100) {
            percentage = 100;
        } else if (percentage < 0) {
            percentage = 0;
        }

        $sound.find('.sound-seek').css('width',percentage+'%');
        playerInstance.setVolume(percentage);
    };

    playerInstance.updateMute = function(force) {
        force = force || false;
        if (force) {
            playerInstance.setMute(true);
            playerInstance.setVolume(0);
            $sound.find('.sound-seek').css('width','0%');
        } else {
            if (playerInstance.getMute()) {
                playerInstance.setMute(false);
                $sound.find('.sound-seek').css('width',playerInstance.getVolume()+'%');
            } else {
                playerInstance.setMute(true);
                $sound.find('.sound-seek').css('width','0%');
            }
        }
    }

    playerInstance.stopMute = function() {
        playerInstance.setMute(false);
        playerInstance.setVolume(100);
        $sound.find('.sound-seek').css('width','100%');
    }

    playerInstance.removeFullscreen = function() {
        $container.find('.channels-video').removeClass('active');
        $container.find('.jwplayer').removeClass('overlay-channels');
        fullScreenApi.cancelFullScreen();
        $fullscreen.removeClass('icon-reverseFullscreen').addClass('icon-fullscreen');
        playerInstance.resize('100%','100%');
        mouseMoving(false);
    }

    function externeControl() {

    }

    function mouseMoving(listen) {
        if(listen) {
            $container.on('mousemove', function(event) {
                $container.removeClass('control-hide');
                clearTimeout(thread);
                thread = setTimeout(function() {
                    $container.addClass('control-hide');
                }, timeout);
            });
        } else {
            clearTimeout(thread);
            $container.off('mousemove');
            $container.removeClass('control-hide');
        }
    }

    function updateShareLink(index, secondaryContainer) {
        index = index || 0;
        sc    = secondaryContainer || 0;

        // CUSTOM LINK FACEBOOK
        if($('.container-webtv-ba-video').length > 0) {
            var shareUrl = $('.video .video-container').attr('data-link');
        } else {
            var shareUrl = GLOBALS.urls.videosUrl+'#vid='+$playlist[index].vid;
        }

        var fbHref   = facebookLink;
        fbHref       = fbHref.replace('CUSTOM_URL', encodeURIComponent(shareUrl));
        fbHref       = fbHref.replace('CUSTOM_IMAGE', encodeURIComponent($playlist[index].image));
        fbHref       = fbHref.replace('CUSTOM_NAME', encodeURIComponent($playlist[index].category));
        fbHref       = fbHref.replace('CUSTOM_DESC', encodeURIComponent($playlist[index].name));
        $topBar.find('.buttons .facebook').attr('href', fbHref);
        
        // CUSTOM LINK TWITTER
        var twHref   = twitterLink;
        twHref       = twHref.replace('CUSTOM_TEXT', encodeURIComponent($playlist[index].name+" "+shareUrl));
        $topBar.find('.buttons .twitter').attr('href', twHref);
        
        // CUSTOM LINK COPY
        $topBar.find('.buttons .link').attr('href', shareUrl);
        $topBar.find('.buttons .link').attr('data-clipboard-text', shareUrl);

//         updatePopinMedia({
//             'type'     : "video",
//             'category' : $playlist[index].category,
//             'date'     : $playlist[index].date,
//             'title'    : $playlist[index].name,
//             'url'      : shareUrl
//         });

        if (sc) {
            $(sc).find('.buttons .facebook').attr('data-href', fbHref);
            $(sc).find('.buttons .facebook').attr('href', fbHref);
            $(sc).find('.buttons .twitter').attr('href', twHref);
            $(sc).find('.buttons .link').attr('href', shareUrl);
            $(sc).find('.buttons .link').attr('data-clipboard-text', shareUrl);
        }
    }

    function initChannel() {

        var sliderChannelsVideo = $('.slider-02').owlCarousel({
            navigation          : false,
            items               : 1,
            autoWidth           : true,
            smartSpeed          : 700,
            center              : true,
            margin              : 27.5
        });

        // Custom Navigation Events
        $(document).on('click', '.slider-02 .owl-item', function(){
            var index = $(this).index();
            $('.slider-02 .center').removeClass('center');
            $(this).addClass('center');
            sliderChannelsVideo.trigger('to.owl.carousel', index);
            changeVideo(index,playerInstance,$(this));
        });

        sliderChannelsVideo.on('translated.owl.carousel', function () {
            index = $('.slider-02 .center').index();
            changeVideo(index,playerInstance,$('.slider-02 .center'));
        })

        var changeVideo = function (index, playerInstance, exThis) {

            sliderChannelsVideo.trigger('to.owl.carousel', index);

            playerInstance.playlistItem(index);

            var infos = $.parseJSON(exThis.find('.channel.video').data('json'));
            $topBar.find('.info .category').text(infos.category);
            $topBar.find('.info .date').text(infos.date);
            $topBar.find('.info .hour').text(infos.hour);
            $topBar.find('.info p').text(infos.name);

            $container.find('.channels-video').removeClass('active');
            $container.find('.jwplayer').removeClass('overlay-channels');

            sliderChannelsVideo.trigger('to.owl.carousel',[index,1,true]);
        }
    }


    console.log(playerInstance);

    playerInstance.setup({
        // file: $container.data('file'),
        sources: $container.data('file'),
        image: $container.data('img'),
        primary: 'html5',
        aspectratio: '16:9',
        width: $(vid).parent('div').width(),
        height: $(vid).parent('div').height(),
        controls: false
    });


    if(havePlaylist) {
        var tempSlider = $(slider),
            playlist   = [];

        if(havePlaylist === "grid") {
            $.each($('#gridVideos .item'), function(i,p) {
                var tempList = {
                    "sources"  : $(p).data('file'),
                    "image"    : $(p).data('img'),
                    "date"     : $(p).data('date'),
                    "hour"     : $(p).data('hour'),
                    "category" : $(p).find('.info .category').text(),
                    "name"     : $(p).find('.info p').text()
                }
                playlist.push(tempList);
            });
        } else if (typeof $container.data('playlist') != "undefined") {
            playlist = $container.data('playlist');
        }

        $.each(playlist, function(i,p) {
            var tempSlide = $(slide);
            tempSlide.find('.image-wrapper img').attr('src',p.image);
            tempSlide.find('.info-container .category').text(p.category);
            tempSlide.data('json', JSON.stringify(p));
            tempSlider.find('.slider-channels-video').append(tempSlide);
        });
        $playlist = playlist;

        initChannel();
        playerInstance.load(playlist);

        if($('.infos-videos .buttons').length > 0) {
            linkPopinInit(0, '.infos-videos .buttons .link');
            updateShareLink(0, '.infos-videos');

            $('.infos-videos .buttons .email').on('click', function(e) {
                e.preventDefault();
                launchPopinMedia({}, playerInstance);
            });
        } else if($('.informations-video .buttons').length > 0) {
            linkPopinInit(0, '.informations-video .buttons .link');
            updateShareLink(0, '.informations-video');

            $('.informations-video .buttons .email').on('click', function(e) {
                e.preventDefault();
                launchPopinMedia({}, playerInstance);
            });
        } else {
            updateShareLink();
        }
    }else{
        $('.channels').css('display', 'none');
    }



    playerInstance.on('ready', function() {
        this.setVolume(100);
        externeControl();
    }).on('play', function() {
        $container.removeClass('state-init').removeClass('state-complete');
        $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        $container.find('.channels-video').removeClass('active');
        $container.find('.jwplayer').removeClass('overlay-channels');
        $stateBtn.removeClass('icon-play').addClass('icon-pause');

    }).on('pause', function() {
        $stateBtn.removeClass('icon-pause').addClass('icon-play');
        mouseMoving(false);
    }).on('buffer', function() {
        // console.log("");
    }).on('complete', function () {
        this.stop();
        $stateBtn.removeClass('icon-pause').addClass('icon-play');
        $container.addClass('state-complete');
        mouseMoving(false);
    }).on('firstFrame', function() {
        _duration = playerInstance.getDuration();
        duration_mins = Math.floor(_duration / 60);
        duration_secs = Math.floor(_duration - duration_mins * 60);
        $durationTime.html(duration_mins + ":" + duration_secs);
    }).on('bufferChange', function(e) {
        var currentBuffer = e.bufferPercent;
        $progressBar.find('.buffer-bar').css('width', currentBuffer+'%');
    }).on('time', function(e) {
        if (typeof _duration === "undefined" || _duration == 0) {
            duration_mins = Math.floor(e.duration / 60);
            duration_secs = Math.floor(e.duration - duration_mins * 60);
            $durationTime.html(duration_mins + ":" + duration_secs);
            _duration = e.duration;
        }

        var currentTime = e.position,
            currentMins = Math.floor(currentTime / 60),
            currentSecs = Math.floor(currentTime - currentMins * 60),
            percent = (currentTime / e.duration) * 100;

        if (currentSecs < 10) {
            currentSecs = "0" + currentSecs;
        }

        $current.html(currentMins + ":" + currentSecs);
        $progressBar.find('.current-bar').css('width', percent+'%');
    }).on('fullScreen', function() {
        this.resize('100%','100%');
    });

    $stateBtn.on('click', function() {
        playerInstance.play();
    });

    $progressBar.on('click', function(e) {
        var ratio = e.offsetX / $progressBar.outerWidth(),
            duration = playerInstance.getDuration(),
            current = duration * ratio;
        playerInstance.seek(current);
    });

    $container.find('.video-player, .infos-bar .picto').on('click', function(e) {
        $container.find('.infos-bar .info, .infos-bar .picto').addClass('hide');
        $container.removeClass('state-init');
        playerInstance.play();
        // $(this).off('click');
    });

    $sound.on('click', '.icon-sound', function() {
        playerInstance.updateMute();
    });

    if (fullScreenApi.supportsFullScreen) {
        $fullscreen[0].addEventListener('click', function() {
            if(!fullScreenApi.isFullScreen()) {
                fullScreenApi.requestFullScreen($container[0]);
                $fullscreen.removeClass('icon-fullscreen').addClass('icon-reverseFullscreen');
                playerInstance.resize('100%','100%');
                mouseMoving(true);
            } else {
                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                fullScreenApi.cancelFullScreen();
                $fullscreen.removeClass('icon-reverseFullscreen').addClass('icon-fullscreen');
                playerInstance.resize('100%','100%');
                mouseMoving(false);
            }
        }, true);

        document.addEventListener(fullScreenApi.fullScreenEventName, function(e) {
            if (!fullScreenApi.isFullScreen()) {
                $container.find('.channels-video').removeClass('active');
                $container.find('.jwplayer').removeClass('overlay-channels');
                $fullscreen.removeClass('icon-reverseFullscreen').addClass('icon-fullscreen');
            }
        }, true);
    }

    var volumeDrag = false;
    $sound.find('.sound-bar').on('mousedown', function(e) {
        volumeDrag = true;
        playerInstance.setMute(false);
        updateVolume(e.pageX);
    });

    $(document).on('mouseup', function(e) {
        if(volumeDrag) {
            volumeDrag = false;
            updateVolume(e.pageX);
        }
    }).on('mousemove', function(e) {
        if(volumeDrag) {
            updateVolume(e.pageX);
        }
    });

    callback(playerInstance);
};


$(document).ready(function() {

    //id, cls, havePlaylist, live


    if($('.video-player').length > 0) {
        videoPlayer = playerInit('video-player', 'video-player', false, false);
    }

    if($('.video-playlist').length > 0) {
        videoPlayer = playerInit('video-playlist', 'video-playlist', true, false);
    }
});

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

  if (/MSIE 10/i.test(navigator.userAgent)) {
    $('body').addClass('ie');
    console.log('ici');
  }

  if (/MSIE 9/i.test(navigator.userAgent) || /rv:11.0/i.test(navigator.userAgent)) {
    $('body').addClass('ie');
  }

  initHeaderSticky();
 // owInitLinkChangeEffect(); add ??

 //gestion des cookie a faire ici

 owInitPopin('popin-landing-e');
 owInitPopin('popin-timer-banner');

  //fix scale zoom tablette

  var scale = function() {
    if(window.matchMedia("(orientation: portrait)").matches || window.matchMedia("(max-width: 769px)").matches) {
      var w = $('body').width();
      var scale = w/1024;
      $('footer, #breadcrumb, .navigation-sticky-02, .navigation-sticky-01, .read-more, .timelapse.block-drag, .block-02, .block-scale, .slider-home').css('zoom',scale);
    }else{
      $('footer, #breadcrumb, .navigation-sticky-02, .navigation-sticky-01, .read-more, .timelapse.block-drag, .block-02, .block-scale, .slider-home').css('zoom',0);
    }
  }

  scale();

  window.addEventListener('orientationchange', scale);

 if('ontouchstart' in window) {
   if (navigator.userAgent.indexOf("iPad") > -1 ||
       navigator.userAgent.indexOf("iPhone") > -1 ||
       navigator.userAgent.indexOf("Android") > -1) {
         $('body').addClass('mobile');
   } else {
     $('body').addClass('mobile');
   }
 }else {
   $('body').addClass('not-mobile');
 }

  if ($('#breadcrumb').length > 0) {
    owInitFooterScroll();
    owInitValidateNewsletter();
  }


 //fix link header
 $('header .hasSubNav .noLink').on("click", function(e){
   e.preventDefault();
  //  return false;
 });

if($('body').hasClass('mobile')){
  owFixMobile();
}

  if($('.block-social-network ').length > 0){
    initRs();
  }

  if($('.block-diaporama').length > 0) {

    var hash = window.location.hash;
    hash = hash.substring(1,hash.length);

    verif = hash.slice(0,3);

    if(hash.length > 0 && verif == "pid") {
      var slider = $('.block-diaporama .slider-01');
      owinitSlideShow(slider, hash);
    }
  }

 // owInitSearch();

  if($('.home').length) {
    owInitSlider('home');
    owInitSlider('slider-01');
    owInitSlider('slider-02');
    owInitReadMore();
    var slider = $('.block-diaporama .slider-01');
    owinitSlideShow(slider);
  }

  if($('.retrospective.poster').length) {
    owInitNavSticky(1);
  }

  if($('.retrospective-home').length) {
    owInitSlider('timelapse-01');
    onInitParallax();
  }

  if($('.ajax-section').length) {
    owInitAjax();
  }

  if($('.block-push-top').length) {
    onInitParallax();
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

  if($('.participate-accordion').length) {
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
    owInitFilterSearch();
  }

  if($('.filters').length) {
    owInitFilter();
  }

  if($('.filters-02').length) {
    owInitNavSticky(3);
    owRemoveElementListe();
    addNextFilters();
  }

  if($('#share-article').length) {
    $('#share-article').on('click', function(e) {
      e.preventDefault();

      $('html, body').animate({
        scrollTop: $(".block-social-network").offset().top - $('header').height() - $('.block-social-network').height() - 300
      }, 500);
    });
  }

});
