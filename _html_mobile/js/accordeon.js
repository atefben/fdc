$( function() {

  $('.section-title').click(function(){
  		if($(this).parents('#menu').length){
  			return false;
  		}
  		// $(this).parent().parent().find(".section-contain").slideToggle('slow');
  		$(this).parent().toggleClass('open');
  		$(this).find('.icon_case-plus').toggleClass('icon_moins');
  });
  
});


