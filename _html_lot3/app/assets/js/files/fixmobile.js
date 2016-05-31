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
