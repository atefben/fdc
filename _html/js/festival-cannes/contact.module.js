// Contact
// =========================

$(document).ready(function() {

  if($('.contact').length) {
    // check that fields are not empty
    $('.contact input[type="text"], textarea').on('input', function() {
      var input = $(this);
      var is_name = input.val();
      if(is_name){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
      }

      if($('.invalid').length) {
        $('.errors').addClass('show');
      } else {
        $('.errors').removeClass('show');
      }
    });

    // check valid email address
    $('.contact input[type="email"]').on('input', function() {
      var input=$(this);
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      if(is_email){
        input.removeClass("invalid").addClass("valid");
        $('.errors .' + input.attr('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("invalid");
        $('.errors .' + input.attr('name')).remove();
        $('.errors ul').append('<li class="' + input.attr('name') + '">' + input.data('error') + '</li>');
      }

      if($('.invalid').length) {
        $('.errors').addClass('show');
      } else {
        $('.errors').removeClass('show');
      }
    });

    // on submit : check if there are errors in the form
    $('.contact form').on('submit', function() {
      var empty = false;

      $('.contact input[type="text"], .contact input[type="email"], .contact textarea').each(function() {
        if($(this).val() == '') empty = true;
      });

      if(empty) {
        $('.contact input[type="email"], .contact input[type="text"], textarea').trigger('input');
      }

      if($('.invalid').length || empty) {
        return false;
      }
    });
  }
  
});