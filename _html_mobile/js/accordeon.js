$(function() {
  $('.section-title').click(function(){
    if($(this).parents('#menu').length == 0 ){
      $(this).parent().toggleClass('open');
      $(this).find('.icon_case-plus').toggleClass('icon_moins');
    }
    // $(this).parent().parent().find(".section-contain").slideToggle('slow');
  });
});