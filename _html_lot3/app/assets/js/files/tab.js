var owInitTab = function(id) {

  if(id == 'tab1') {

    var $tab = $('.tab1 td');

    var hash = window.location.hash;
    hash = hash.substring(5)

    if(hash != '') {

      var dataTab = hash;
      var $block = $('.block-contain-txt-register-movie[data-article='+dataTab+']');
      var $element = $('#tab1 tr[data-article='+dataTab+']');



      $tab.removeClass('active');
      $element.addClass('active');

      $('.block-contain-txt-register-movie').removeClass('active animated fadeInUp');

      $block.addClass('active animated fadeInUp');

      var hashPush = '#tab='+dataTab;
      history.pushState(null, null, hashPush);
    }




    $tab.on('click', function(e) {
      var $element = $(this);
      var dataTab = $element.data('tab');
      var $block = $('.block-contain-txt-register-movie[data-article='+dataTab+']');

      $tab.removeClass('active');
      $element.addClass('active');

      $('.block-contain-txt-register-movie').removeClass('active animated fadeInUp');

      $block.addClass('active animated fadeInUp');

      var hashPush = '#tab='+dataTab;
      history.pushState(null, null, hashPush);

    });

  }



};
