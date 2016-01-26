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
}else if($('.webtv').length){
  $('#banner-top').on('click',function(){
      if($('.banner-video').hasClass('active')){
        $('.banner-video').removeClass('active');
        $('.banner-img').addClass('active');
      }else if($('.banner-img-text .off').hasClass('show') && $('.banner-img').hasClass('active')){
        $('.banner-img-text .before').addClass('show');
        $('.banner-img-text .off').removeClass('show');
        $('.banner-video').addClass('active');
        $('.banner-img').removeClass('active');
      }else{
        $('.banner-img-text .before').removeClass('show');
        $('.banner-img-text .off').addClass('show');
      }
  });
}