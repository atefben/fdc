$(document).ready(function() {
  if($('#seatingchart').length) {
      $('.nav-map li:not(#more-map)').on('click',function(){
        
        if(!$(this).hasClass('active') && !$('#main.animation').length ){
          
          var $this       =  $(this),
              activeLi    =  $('.nav-map').find('li.active'),
              data        =  activeLi.data('maps'),
              imgActive   =  $('.maps').find("span.active"),
              thisData    =  $this.data('maps'),
              imgNotActiv =  $('.maps').find("#"+thisData),
              moreMap     =  $('#more-map').find("img[data-image='"+thisData+"']"),
              moreMapAc   =  $('#more-map img.visible');
          
              $('#main').addClass('animation');
          
              imgActive.animate({
                
                opacity:0
                
              },600,function(){
                
              imgActive.removeClass('active');
              imgNotActiv.addClass('active');
              moreMap.addClass('visible');
                
              activeLi.removeClass('active');
              $this.addClass('active');
              moreMapAc.removeClass('visible');
                
              imgNotActiv.animate({
                 opacity:1
              },400,function(){
                  $('#main').removeClass('animation');
              });
          });
        }
      })
    }
});