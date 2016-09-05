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


    if($('.jury').length) {

      var resize = function() {
        var w = $('.isotope-01 .contain-img').first().width();
        $('.isotope-01 .contain-img').each(function() {
          $(this).css('height', (w / 0.75));
          var $container = $(this), imgUrl = $container.find('img').prop('src');
          if (imgUrl) {
            $container.css('backgroundImage', 'url('+imgUrl+')').addClass('compat-object-fit');
            img = $container.find('img');
            img.css('display','none');
          }
        });
      }

      $( window ).resize(function() {
        resize();
      });

    }

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
      }

      if($('.filters #theme').length > 0) {

        console.log('c bien ici');

        filterTheme = $('.filters #theme .select span.active').data('filter');
        filterTheme = "."+filterTheme;
      }

      if($('.filters #format').length > 0) {
        filterFormat = $('.filters #format .select span.active').data('filter');
        filterFormat = "."+filterFormat;
      }

      var filters = filterDate+filterTheme+filterFormat;

      console.log(filters);

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

    $(dom).find('article.card:not(.double.w2)').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(20,true));
      }
    });

    $(dom).find('article.card.double.w2').each(function() {
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

    $(dom).find('article.card:not(.double.w2)').each(function() {
      if(typeof $(this).find('.info p').data('title') != 'undefined') {
        $(this).find('.info p').text($(this).find('.info p').data('title').trunc(30,true));
      }
    });
    $(dom).find('article.card.double.w2').each(function() {
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
