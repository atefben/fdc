if($('.ba').length){

  $('.nav li').click(function(){
    if($(this).hasClass('active')){

    }else{
      $('.nav').find('.active').removeClass('active');
      $(this).addClass('active');

        if($(this).hasClass('infos-film-li')){
          $('.program-film').css({display:'none'});
          $('.infos-film').css({display:'block'});

        }else{
          $('.program-film').css({display:"block"});
          $('.infos-film').css({display:"none"});

        }
    }
  });
}