var owInitGrid = function(id){

  if(id == 'isotope-01'){

    var $grid = $('.isotope-01').imagesLoaded(function () {
      $grid.isotope({
        layoutMode: 'packery',
        itemSelector: '.item'
      });
    });
  }
}
