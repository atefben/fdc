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
    var $title = $('.more-search .sub-tab .title-cont');

    $title.on('click',function(){
     var $this = $(this).closest('.sub-tab');

      if($this.hasClass('active')){
        $this.find('.icon').removeClass('icon-minus').addClass('icon-create');
      }else{
        $this.find('.icon').addClass('icon-minus').removeClass('icon-create');
      }

      $this.toggleClass('active');
b
    });
  }
};


owInitAccordion("block-accordion")
