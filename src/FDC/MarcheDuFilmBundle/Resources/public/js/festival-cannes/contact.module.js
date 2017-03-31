// Contact
// =========================

$(document).ready(function() {

  if($('.contact').length) {
    // check that fields are not empty
    $('.contact input[type="text"], textarea').on('input', function() {
      var input = $(this);
      var is_name = input.val();
      if(is_name){
        input.removeClass("redRequired").addClass("valid");
        $('.errorMessage .' + input.data('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("redRequired");
        $('.errorMessage .' + input.data('name')).remove();
        $('.errorMessage').append('<div class="redMessage ' + input.data('name') + '">' + input.data('error') + '</div>');
      }

      if($('.redRequired').length) {
        $('.errorMessage').show();
      } else {
        $('.errorMessage').hide();
      }
    });

    $('#triggerSelect').on('click', function(e) {
      e.preventDefault();

      var h = '';

      $('.select option').not('.default').each(function() {
        h += '<span data-select="' + $(this).val() + '">' + $(this).html() + '</span>';
      });

      $('#filters').remove();
      $('body').append('<div id="filters" class="selectOptions"><div class="vCenter"><div class="vCenterKid"></div></div><div class="close-button"><i class="icon icon_close"></i></div></div>');
      $('#filters .vCenterKid').html(h);

      setTimeout(function() {
        $('#filters').addClass('show');
      }, 100);

      setTimeout(function() {
        $('#filters span').addClass('show');
      }, 400);
    });

    $('body').on('click', '.selectOptions span', function() {
      $('select[data-name="select"]').val($(this).data('select'));
      $('.select').removeClass('redRequired');
    });

    // check valid email address
    $('.contact input[type="email"]').on('input', function() {
      var input=$(this);
      var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
      var is_email=re.test(input.val());
      if(is_email){
        input.removeClass("redRequired").addClass("valid");
        $('.errorMessage .' + input.data('name')).remove();
      }
      else{
        input.removeClass("valid").addClass("redRequired");
        $('.errorMessage .' + input.data('name')).remove();
        $('.errorMessage').append('<div class="redMessage ' + input.data('name') + '">' + input.data('error') + '</div>');
      }

      if($('.redRequired').length) {
        $('.errorMessage').show();
      } else {
        $('.errorMessage').hide();
      }
    });

    // on submit : check if there are errorMessage in the form
    $('.contact form').on('submit', function() {
      var empty = false;

      if($('select').val() == 'default') {
        $('.select').addClass('redRequired');
      } else {
        $('.select').removeClass('redRequired');
      }

      $('.contact input[type="text"], .contact input[type="email"], .contact textarea').each(function() {
        if($(this).val() == '') empty = true;
      });

      if(empty) {
        $('.contact input[type="email"], .contact input[type="text"], textarea').trigger('input');
      }

      if($('.redRequired').length || empty) {
        return false;
      }
    });
  }
});
