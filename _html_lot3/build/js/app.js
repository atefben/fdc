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
          owInitAccordion("block-accordion");
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

    $('.block-social-network .twitter').on('click', function () {
        window.open(this.href, '', 'width=600,height=400');
        return false;
    });


    //POPIN facebook SHARE
    $('.block-social-network .facebook').on('click', function () {
        window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=700');
        return false;
    });

    function initPopinMail(cls) {

        console.log(cls);
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

            setTimeout(function () {
                $('#share-box').animate({'opacity': 0}, 200, function () {
                    $('#share-box').removeClass('show');
                    $('#share-box').remove();
                });
            }, 3000);
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
var owinitSlideShow = function (slider) {

    $('.block-diaporama .item').on('mousedown', function(){

        if($(this).parent().hasClass('active center') && !$('.owl-stage').hasClass('owl-grab')){
            openSlideShow(slider);
        }
        
    });

}


var openSlideShow = function(slider) {

    var images = [];
    var w = $(window).width();
    var centerElement = 0;

    slider.find('.item').each(function(index,value){

        if($(value).parent().hasClass('active center')){
            centerElement = index;
            console.log("index"+index);
        }


        src = $(value).find('img').attr("src");
        alt =  $(value).find('img').attr("alt");

        var image = {
            src : src,
            alt : alt
        };

        images.push(image);

    });


    /* Initiliasion du slideshow fullscreen*/
    slider.append('<div class="fullscreen-slider"> </div>');
    var fullscreen = slider.find(".fullscreen-slider");

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    for(var i=0; i<images.length; i++)  {

        if(i == centerElement){
            fullscreen.append("<img src='"+images[i].src+"' alt='"+images[i].data+"' class='center-item' />");
        }else{
            fullscreen.append("<img src='"+images[i].src+"' alt='"+images[i].data+"'/>");
        }
    }

    var translate = (w + 1) * centerElement;
    translate = - translate + "px";

    console.log(centerElement);
    console.log(translate);

    fullscreen.css('transform','translateX('+translate+')');

    fulscreen.append('<div class="bottom">' +
        '' +
        '</div>');
    /* les mettre dans une div en dessous qui ne sera pas un slideshow */
    /* afficher le nouveaux slide*/


/*
    slider.addClass('fullscreen-slider');
*/
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
 // owInitLinkChangeEffect(); add ??

 //gestion des cookie a faire ici

 owInitPopin('popin-landing-e');
 owInitPopin('popin-timer-banner');

  //fix scale zoom tablette
  if(window.matchMedia("(orientation: portrait)").matches || window.matchMedia("(max-width: 769px)").matches) {
    var w = $('body').width();
    var scale = w/1024;
    $('footer, #breadcrumb, .navigation-sticky-02, .navigation-sticky-01, .read-more, .timelapse.block-drag, .block-02, ._h _l  block-scale').css('zoom',scale);
  }



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
  }

});
