$( function() {

  $('.section-title').click(function(){

  		// $(this).parent().parent().find(".section-contain").slideToggle('slow');
  		$(this).parent().toggleClass('open');
  		$(this).find('.icon_case-plus').toggleClass('icon_moins');
  });
  
});


