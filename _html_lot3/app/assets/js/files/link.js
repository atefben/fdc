var owInitLinkChangeEffect = function() {

  $('header a, footer a, .cards a, .block-push a, .block-infos a, .small-push a, .texte-01 a, .item a, .link').on('click', function(e) {

    e.preventDefault();

    var url = $(this).attr('href');

    $('.overlay').addClass('animated fadeIn visible');

    setTimeout(function(){
        window.history.pushState('','',url);
        window.location.reload();

    }, 1000);

    return false;
  });
}
