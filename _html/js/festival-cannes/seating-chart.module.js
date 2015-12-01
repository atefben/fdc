$(document).ready(function() {
  if($('#seatingchart').length) {
      $('.nav-map li:not(#more-map)').on('click',function(){
        
        if(!$(this).hasClass('active') && !$('#main.animation').length ){
          
          var $this       =  $(this),
              activeLi    =  $('.nav-map').find('li.active'),
              data        =  activeLi.data('maps'),
              imgActive   =  $('.maps').find("span.active"),
              thisData    =  $this.data('maps'),
              imgNotActiv =  $('.maps').find("#"+thisData);
          
              $('#main').addClass('animation');
          
              imgActive.animate({
    //            translateY:"100",
                opacity:0
              },1000,function(){
            
              imgActive.removeClass('active');
                
              imgNotActiv.addClass('active');
            
              activeLi.removeClass('active');
              $this.addClass('active');
            
              imgNotActiv.animate({
//                translateY:0,
                  opacity:1
                },1000,function(){
                
                  $('#main').removeClass('animation');
                
              });
          });
        }
      })
    }
});