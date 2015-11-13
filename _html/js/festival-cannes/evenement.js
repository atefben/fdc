  // 24. Evenement 
  //=============================
  if ($('.evenement').length) {

    var $container = $('#gridEvent'),
      $grid
    var i = 1;

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
      i += 1;
      $.ajax({
        type: "GET",
        dataType: "html",
        cache: false,
        url: 'evenements' + i + '.php',
        success: function (data) {
          $(".grid-wrapper").after(data);
          var $container = $('#gridEvent'),
              $grid;
          $data = $(data).find(".grid-wrapper").prevObject;
          $data = $data.attr('id');
          $grid = $('#' + $data).imagesLoaded(function () {

            // init Isotope after all images have loaded
            setGrid($grid, $('#' + $data), false);
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

        }
      });
    });
  }