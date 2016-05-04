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
};
