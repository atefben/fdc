  // 24. Evenement 
  //=============================
  if ($('.evenement').length) {

    var $container = $('#gridEvent'),
      $grid;

    $grid = $('#gridEvent').imagesLoaded(function () {
      // init Isotope after all images have loaded
      setGrid($grid, $('#gridEvent'), true);
      $grid.isotope({
        itemSelector: '.item',
        percentPosition: true,
        layoutMode: 'packery',
        packery: {
          columnWidth: '.grid-sizer'
        }
      });

      $grid.isotope('layout');
    });
    $('.read-more').on('click', function (e) {
      e.preventDefault();
	$(this).hide();
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: GLOBALS.urls.eventUrl /* TODO DEV : context URL */,
        success: function (data) {
          var $data = $(data).find('.gridelement');
          var $container = $('#gridEvent'),
              $grid;
          $grid = $container.imagesLoaded(function () {
				setGrid($grid, $data, false);
          });
        }
      });
    });
  }