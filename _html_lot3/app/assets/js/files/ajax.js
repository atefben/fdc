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

    console.log(checked);
    console.log(keyword);
    console.log(date);

    //TODO back data

    $.ajax({
      url: url,
      type : 'GET',
    }).done(function(data) {

      console.log(data);
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