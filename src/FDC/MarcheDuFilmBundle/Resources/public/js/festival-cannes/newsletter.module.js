// Newsletter
// =========================

$(document).ready(function() {

  var errorMsg = '';
  $('.newsletter #email').on('focus', function() {
    if($(this).val() == GLOBALS.texts.newsletter.errorsNotValide || $(this).val() == GLOBALS.texts.newsletter.errorsMailEmpty ||
        errorMsg != '') {
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
      input.addClass("error").val(GLOBALS.texts.newsletter.errorsMailEmpty);
    } else {

      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      if(is_email){
        input.removeClass("error");
      }
      else {
        input.addClass("error").val(GLOBALS.texts.newsletter.errorsNotValide);
      }
    }

    if($('.newsletter .error').length || empty) {
      return false;
    } else {
      event.preventDefault();
      event.stopPropagation();

      $.ajax({
        type     : "POST",
        dataType : "json",
        cache    : false,
        url      : GLOBALS.urls.newsletterUrl,
        data     : $('form#newsletter').serialize(),
        success: function(data) {
          if (data.success == false) {
            input.addClass("error");
            input.val(data.object);
            errorMsg = data.object;
          }
          else {
            $('.newsletter form').addClass('hide');
            $('#confirmation span').html($('#email').val());
            $('#confirmation').addClass('show');
          }
        }
      });

      return false;
    }
  });
});