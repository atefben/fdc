$(document).ready(function() {
  if($('#seatingchart').length) {
      $('.nav-map li').click(function(){
        if(!$(this).hasClass('active')){
          
          var $this       =  $(this),
              activeLi    =  $('.nav-map').find('li.active'),
              data        =  activeLi.data('maps'),
              imgActive   =  $('.maps').find("span.active"),
              thisData    =  $this.data('maps'),
              imgNotActiv =  $('.maps').find("#"+thisData);
          
          imgActive.animate({
            translateY:"100",
            opacity:0
          },500,function(){
            
              imgNotActiv.addClass('active');
              imgActive.removeClass('active');
            
              activeLi.removeClass('active');
              $this.addClass('active');
            
              imgNotActiv.animate({
                  translateY:0,
                  opacity:1
                },500,function(){
                
              });
          });
        }
      })
    }
});