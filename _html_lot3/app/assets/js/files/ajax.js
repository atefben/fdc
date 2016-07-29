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