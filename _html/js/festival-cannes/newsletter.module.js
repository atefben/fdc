// Newsletter
// =========================

$(document).ready(function() {

  $('.newsletter #email').on('focus', function() {
    if($(this).val() == "L'adresse e-mail n'est pas valide" || $(this).val() == "Veuillez saisir une adresse e-mail valide") {
      $(this).val('');
      $(this).removeClass('error');
    }
  });

  // on submit : check if there are errors in the form
  $('.newsletter form').on('submit', function() {

    var input = $('.newsletter #email');
    var empty = false;

    if($('#email').val() == '') {
      empty = true;
      input.addClass("error").val("Veuillez saisir une adresse e-mail valide");
    } else {

      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      if(is_email){
        input.removeClass("error");
      }
      else {
        input.addClass("error").val("L'adresse e-mail n'est pas valide");
      }
    }

    if($('.newsletter .error').length || empty) {
      return false;
    } else {
      // ajax call newsletter

      // show confirmation 
      $('.newsletter form').addClass('hide');
      $('#confirmation span').html($('#email').val());
      $('#confirmation').addClass('show');

      return false;
    }
  });
});