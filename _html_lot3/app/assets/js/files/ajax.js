var owInitAjax = function() {

  $('.ajax-section nav li:not(.active) a').on('click', function(e){
    e.preventDefault;

    var url = $(this).attr('href');

    $.get( url, function( data ) {
      $data = $(data);
      contain = $data.find('.contain-ajax')[0];

      test = $data.filter('#breadcrumb').children()[0];


      $( ".ajax-section" ).html(contain);

      $( "#breadcrumb" ).html(test);

      owInitFooterScroll(); 
      
      if($('.navigation-sticky-02').length) {
        owInitNavSticky(2);
      }else if($('.navigation-sticky').length) {
        owInitNavSticky(1);
      }

      if($('.isotope-01').length) {
        owInitGrid('isotope-01');
      }

      if($('.medias').length > 0) {

        var hash = window.location.hash;
        hash = hash.substring(1, hash.length);

        verif = hash.slice(0, 3);
        number = hash.slice(4);

        if (hash.length > 0 && verif == "pid") {
          var slider = $('.grid-01');
          owinitSlideShow(slider,hash);
        }else{
          var slider = $('.grid-01');
          owinitSlideShow(slider);
        }

        if (hash.length > 0 && verif == "vid") {
          initVideo(number);
        }else{
          initVideo();
        }

        if (hash.length > 0 && verif == "aid") {
          initAudio(number);
        }else{
          initAudio();
        }


      }
      
      if($('.isotope-02').length) {
        owInitGrid('isotope-02');
      }

      if($('.grid-01').length) {
        var grid = owInitGrid('isotope-01');
        console.log('two');
        owsetGridBigImg(grid, $('.grid-01'), true);

        $( window ).resize(function() {
            owsetGridBigImg(grid, $('.grid-01'), false);
        });
      }

      if($('#google-map').length) {
        google.maps.event.addDomListener(window, 'load', initMap);
      }

      if($('.filters').length) {
        owInitFilter();
      }

      if($('.block-accordion').length) {
          owInitAccordion("block-accordion");
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
/*

var ajaxMedialib = function() {
  $('.block-search .button-submit').on('click', function(e) {
    e.preventDefault();

    //on récupère les informations

    var url = $('.block-search form').attr('action');
    var keyword = $('.block-search input[name="search"]').val();
    var checked = [];
    var date = [];

    date[1] = $('.block-search #slider-snap-value-lower').html();
    date[2] = $('.block-search #slider-snap-value-upper').html();

    $.each($('.choice'), function(i,v) {
      if($(v).is(":checked")) {
        checked.push($(v).attr('name'));
      }
    })


    //TODO back data

    $.ajax({
      url: url,
      type : 'GET',
    }).done(function(data) {

      grid = $(data);
      $('.grid-01').html(grid);

      //on mets à jour la nouvelle grille

        var grid = $('.isotope-03').isotope({
          itemSelector    : '.item',
          percentPosition : true,
          sortBy          : 'original-order',
          layoutMode      : 'packery',
          packery         : {
            columnWidth : '.grid-sizer'
          }
        });


      owInitAleaGrid(grid, $('.grid-01'), true);
      

    });


  })
}*/


var owInitReadMore = function() {

}