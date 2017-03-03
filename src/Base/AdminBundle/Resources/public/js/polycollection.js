jQuery(document).ready(function($) {
    // infinite collection construct
    $('[data-form-widget=collection]').each(function () {
        new window.infinite.Collection(this, $(this).siblings('[data-prototype]'));
    });

    var config = null;
   // infinite collection sortable

    if ($('body').hasClass('role_translator') == false) {
        $('div[class$="fdc-widgets"][data-form-widget="collection"]').sortable({
            axis: 'y',
            items: '> .base-widget',
            start: function (event, ui) {
                // ckeditor
                var textareaId = ui.item.find('textarea.ckeditor').attr('id');
                if (typeof textareaId != 'undefined') {
                    var editorInstance = CKEDITOR.instances[textareaId];
                    config = editorInstance.config;
                    editorInstance.destroy();
                    CKEDITOR.remove(textareaId);
                }
            },
            stop: function (event, ui) {
                // ckeditor
                var textareaId = ui.item.find('textarea.ckeditor').attr('id');
                if (typeof textareaId != 'undefined') {
                    CKEDITOR.replace(textareaId, config);
                }
            }
        });
    }

    // refresh input position value
    $('form[action*="news"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="statement"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="info"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="pressguide"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="fdcpageprepare"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="fdcpageparticipatesection"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="pressdownloadsection"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="fdcpagelaselectioncannesclassics"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="orange"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="event"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpowhoarewe"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpoteamdepartements"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpoteamteams"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpoteam"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpofestivalhistory"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="corpopalmeor"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="filmfestival"]').submit(function() {
      var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    /** MDF **/
    $('form[action*="service"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="mdfeditionpresentation"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="accreditation"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="dispatchdeservice"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfeditionprojections"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhomepw"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfwhoarewehistory"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfwhoarewekeyfigures"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfwhoareweenvironmentalapproaches"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdflegalmentions"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfgeneralconditions"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfnewsdetails"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceprogrampw"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceprogramdc"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceprogrampn"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceprogramnext"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceprogrammixers"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceprogramgtc"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhomepn"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhomedc"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhomenext"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhomemixers"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfindustryprogramhomegtc"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceinfoandcontactpw"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceinfoandcontactpn"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceinfoandcontactdc"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceinfoandcontactn"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceinfoandcontactm"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfconferenceinfoandcontactgtc"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfpressrelease"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="presscoverage"]').submit(function() {
    var inputs = $('input[name$="[position]"]');
    inputs.each(function(idx) {
      $(this).val(idx + 1);
    });
    });
    $('form[action*="mdfpressgallery"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfpressgraphicalcharter"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfwhoareweteam"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfcontactpage"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="mdfslideraccreditationpage"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    /** CCM **/
    $('form[action*="ccmprosdetail"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });

    $('form[action*="ccmlabelsection"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmnewsarticle"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmnewsaudio"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmnewsimage"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmsfcwhoarewe"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmsfcreliveedition"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmsfcourevents"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmparticiperpagelayer"]').submit(function() {
        var inputs = $('input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="homepage"]').submit(function() {
        var inputs = $('.fdc-widgets input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
    $('form[action*="ccmlabel"]').submit(function() {
        var inputs = $('.fdc-widgets input[name$="[position]"]');
        inputs.each(function(idx) {
            $(this).val(idx + 1);
        });
    });
});
