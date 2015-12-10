$(document).ready(function() {
  if($('.popin-mail').length){
    $('.button.email').click(function(){
      if($('.popin-mail').hasClass('visible-popin')){
        $('.popin-mail').removeClass('visible-popin');
        $("#main").removeClass('overlay-popin');
        $('footer').removeClass('overlay');
      }else{ 
        $('.popin-mail').addClass('visible-popin');
        $("#main").addClass('overlay-popin');
      }
    });
    $(window).click(function(e){
      var classObj = $(e.target);
      if(!classObj.hasClass('popin')){
        if($('.popin-mail').hasClass('visible-popin')){
          $('.popin-mail').removeClass('visible-popin');
          $("#main").removeClass('overlay-popin');
          $('footer').removeClass('overlay-popin');
        }
      }
    })
  }

   if($('.popin-mail').length) {
    // check that fields are not empty
    $('.popin-mail input[type="text"], textarea').on('input', function() {
      var input = $(this);
      var is_name = input.val();
      if(is_name){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + '</li>');
      }
      if($('.invalid').length) {
        $('.errors').addClass('show');
      } else {
        $('.errors').removeClass('show');
      }
    });

    $('body').on('click', '.selectOptions span', function() {
      var i = parseInt($(this).index()) + 1; 
      $('select option').eq(i).prop('selected', 'selected');
      $('.select').removeClass('invalid');
    });

    // check valid email address
    $('.popin-mail input[type="email"]').on('input', function() {
      var input=$(this);
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      var is_email_name=input.val();
      if(!is_email_name){
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.empty + '</li>');

      }else if(is_email){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();

      }
      else{
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="popin ' + input.attr('name') + '">' + input.data('error') + GLOBALS.texts.popin.error +'</li>');
// TODO remove string //
      }

      if($('.invalid').length) {
        $('.errors').addClass('show');
      } else {
        $('.errors').removeClass('show');
      }
    });

    // on submit : check if there are errors in the form
    $('.popin-mail form').on('submit', function() {
      var empty = false;

      if($('select').val() == 'default') {
        $('.select').addClass('invalid');
      } else {
        $('.select').removeClass('invalid');
      }

      $('.popin-mail input[type="text"], .popin-mail input[type="email"], .popin-mail textarea').each(function() {
        if($(this).val() == '') empty = true;
      });

      if(empty) {
        $('.popin-mail input[type="email"], .popin-mail input[type="text"], textarea').trigger('input');
      }

      if($('.invalid').length || empty) {
        return false;
      }
    });
  }
});