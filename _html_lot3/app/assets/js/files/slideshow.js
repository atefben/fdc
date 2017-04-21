/**
 * Created by tatjac on 17/06/2016.
 */
var owinitSlideShow = function (slider, hash) {

    if (typeof hash != "undefined" && !$('.affiche-fdc').length) {
        var finalSlider = slider;
        if(slider.length > 1){
            //if we find the current hash in the slider, it's the good one (evol multiple sliders on one page)
            slider.each(function(){
                if($(this).find('[data-pid="'+hash+'"]').length){
                    finalSlider = $(this);
                }
            })
        }
        openSlideShow(finalSlider, hash);
    }
    //else{

        if($('.affiche-fdc').length) {
            if (typeof hash != "undefined") {
                setTimeout(function () {
                    var index = $('[data-url="'+hash+'"]').closest('.block-movie-preview').index('.block-movie-preview');


                    openSlideShow(slider, hash, true, index);
                }, 100);
            }

            $('.poster').off('click').on('click', function(e){
                slider = $('.all-contain');
                $(this).parent().addClass('active center');
                var hash = typeof $(this).data('url') !== 'undefined' ? $(this).data('url') : '';
                var index = $(this).closest('.block-movie-preview').index('.block-movie-preview');
                openSlideShow(slider,hash, true, index);
                return false;
            });

        } else if($('.article-single').length){

            $('.slideshow-img .images').on('click', function (e) {
                if(!$(e.target).is('.thumbnails') || !$(e.target).closest('.thumbnails').length){
                    e.preventDefault();

                    slider = $(this);

                    openSlideShow(slider);
                }
                return false;
            });

        }else{
            if($('.slideshow-img').length > 0 ) {
                $('.images').on('click', function (e) {
                    
                    if(!$(e.target).is('.thumbnails') || !$(e.target).closest('.thumbnails').length){
                        e.preventDefault();
                        openSlideShow(slider);
                    }
                    return false;
                });
            }

            if($('.medias').length > 0 || $('.media-library').length > 0) {
                $('.item.photo').off('click').on('click', function (e) {
                    e.preventDefault();
                    slider = $('.isotope-01');
                    $(this).addClass('photoActive');
                    openSlideShow(slider);

                    return false;
                });
            }
        }

    //}
}


var openSlideShow = function(slider, hash, affiche, fdcAfficheIndex){
    //handle undefined for other uses cases than affiches slider
    fdcAfficheIndex = typeof fdcAfficheIndex !== 'undefined' ? fdcAfficheIndex : -1;
    $('html').addClass('slideshow-open');

    if($('.medias').length > 0 || $('.media-library').length > 0) {
        slider = $('.isotope-01');
        if (slider.length == 0) {
            slider = $('section.medias');
        }
    }

    var images = [];
    var w = $(window).width();
    var centerElement = 0;
    var caption = "";
    slider.find('.item, .img, .poster').each(function (index, value) {
        if(!$(value).hasClass('video') && !$(value).hasClass('audio')){
            var activeClass = '';
            if(slider.closest('.block-diaporama').length){
                activeClass = 'center';
            }
            if($('.affiche-fdc').length){
                activeClass = 'active';
            }
            if ($(value).parent().hasClass(activeClass)) {
                centerElement = index;

                if($('.affiche-fdc').length ) {
                    var hashPush = hash;
                    var CheminComplet = document.location.href;

                    if(hashPush.indexOf('#') == -1 && CheminComplet.indexOf('#') == -1){
                        hashPush = "#" + hashPush;
                    }

                    hashPush = CheminComplet + hashPush;
                    history.pushState(null, null, hashPush);
                }
            }

            if ($('.img').length > 0 && $(value).hasClass('active')) {
                centerElement = index;
            }

            if($('.affiche-fdc').length) {
                var src = $(value).parent().data('img') || $(value).find('img').attr('src');
                var alt = $(value).find('img').attr('alt');
                var title = $(value).parent().find('.infos  .name-f').html();
                var label = $(value).parent().find('.infos .names-a').html();
                var date =  $(value).parent().data('date');
                var caption = $(value).parent().data('credit');
                var id = $(value).parent().data('pid');
                var facebookurl = $(value).parent().data('facebook');
                var twitterurl = $(value).parent().data('twitter');
                var url = $(value).parent().data('url');
                var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape';

            } else if($('.photo-module').length) {
                var src = $(value).find('img').attr('src');
                var alt = $(value).find('img').attr('alt');
                var title = $(value).find('a').attr('title');
                var label = $(value).find('a').data('label');
                var date = $(value).find('a').data('date');
                var caption = $(value).find('a').data('credit');
                var id = $(value).find('a').data('pid');
                var facebookurl = $(value).find('a').data('facebook');
                var twitterurl = $(value).find('a').data('twitter');
                var url = $(value).find('a').data('link');
                var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape';

            }else{
                var getTitle = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt strong a').data('title') : $(value).find('img').data('title');
                var dataItem = $(value).find('a');

                if(typeof getTitle === 'undefined'){
                    getTitle = $(value).find('img').attr("data-title");
                }

                if($('.medias').length > 0 || $('.media-library').length > 0) {
                    getTitle = $(value).find('.info .contain-txt').html() || $(value).find('img').data('title');
                }
                if (dataItem.hasClass('linkAllCover')) {
                    var src = dataItem.attr('href');
                } else {
                    var src = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("src") : $(value).find('img').attr("src");
                }
                var alt = ($(value).hasClass('photo')) ? $(value).find('.image-wrapper img').attr("alt") : $(value).find('img').attr("alt");
                var title = getTitle || dataItem.attr('title');;
                var label = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt a').html() : $(value).find('img').attr("data-label") || dataItem.data('label');
                var date = ($(value).hasClass('photo')) ? $(value).find('.info .contain-txt span.date').html() + ' . ' + $(value).find('.info .contain-txt span.hour').html() : $(value).find('img').attr("data-date") || dataItem.data('date');
                var caption = $(value).find('img').attr('data-credit') || dataItem.data('credit');
                var id = $(value).find('img').attr('data-id') || dataItem.data('pid');
                var facebookurl = $(value).find('img').attr('data-facebookurl') || dataItem.data('facebook');
                var twitterurl = $(value).find('img').attr('data-twitterurl') || dataItem.data('twitter');
                var url = $(value).find('img').attr('data-url') || dataItem.data('url');
                var isPortrait = $(value).hasClass('portrait') ? 'portrait' : 'landscape' || $(value).hasClass('portrait') ? 'portrait' : 'landscape';
            }
            if(hash == id && centerElement == 0){
                centerElement = $(this).index('.photo');

                if(centerElement < 0){
                    centerElement = $(this).index();
                }
            }

            function clean(str) {
                if (str) {
                    var res = str.replace(/%[2-7]./gi, function myFunction(x)
                    {
                        if (x == '%23') {
                            return ('#');
                        } else {
                            return (decodeURI(x));
                        }
                    });

                    res = encodeURI(res);
                    return (res.replace('#', '%23'));
                } else {
                    return '';
                }
            }

            var image = {
                id: id,
                url: url,
                src: src,
                alt: alt,
                title: title,
                label: label,
                date: date,
                caption: caption,
                facebookurl: clean(facebookurl),
                twitterurl: clean(twitterurl),
                isPortrait: isPortrait
            };
            images.push(image);
        }
    });

    if($('.photoActive').length > 0) {
        var pid = $('.photoActive .image-wrapper img').data('id');
        for(var o = 0; o < images.length; o++){
            if(pid == images[o].id){
                var v = o;
                centerElement = v;
            }
        }
    }

    //affiche fdc current index
    if(fdcAfficheIndex > -1){
        centerElement = fdcAfficheIndex;
    }

    if(typeof hash == "undefined") {
        hash = images[centerElement].id;
        var hashPush = '#pid='+hash;
        history.pushState(null, null, hashPush);
    }

    var goToNextPrev = function (direction) {
        w = $(window).width();

        var place = centerElement+1;

        if (direction == 0 && place <= images.length) { //go next

            if (place === images.length) {
                centerElement = 0;
                goToSLide(centerElement);
            }else{
                centerElement += 1;
                goToSLide(centerElement);
            }
        }

        if (direction == 1 && place > 0 ) { //go prev

            if (centerElement == 0 ) {
                centerElement = images.length - 1;
                goToSLide(centerElement);
            }else{
                centerElement -= 1;
                goToSLide(centerElement);
            }
        }

        thumbnailsSlide.trigger('to.owl.carousel', [centerElement, 400, true]);

        $(thumbs).removeClass('active');
        $(thumbs[centerElement]).addClass('active');

        numberDiapo = centerElement + 1;
        var title = $('.c-fullscreen-slider').find('.title-slide');
        var pagination = $('.c-fullscreen-slider').find('.chocolat-pagination');
        var label = $('.c-fullscreen-slider').find('.category');
        var date = $('.c-fullscreen-slider').find('.date');
        var caption = $('.c-fullscreen-slider').find('.credit');
        var facebook = $('.c-fullscreen-slider').find('.rs-slideshow .facebook');
        var twitter = $('.c-fullscreen-slider').find('.rs-slideshow .twitter');
        var link = $('.c-fullscreen-slider').find('.rs-slideshow .link');

        var finalTitle = '<strong><a>'+images[centerElement].title+'</a></strong>';
        if(typeof images[centerElement].title !== 'undefined'){
            if(isHTML(images[centerElement].title)){
                finalTitle = images[centerElement].title;
            }
        }

        title.html(finalTitle);
        pagination.html(numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i>');
        label.html(images[centerElement].label);
        date.html(images[centerElement].date);
        caption.html(images[centerElement].caption)

        facebook.attr('href', images[centerElement].facebookurl);
        twitter.attr('href', images[centerElement].twitter);
        link.attr('data-clipboard-text', images[centerElement].url);

        $('.fullscreen-slider img').removeClass('isZoom');
        $('.fullscreen-slider img').css('transform', 'scale(1)');
        $('.zoomCursor .icon').addClass('icon-wen-more').removeClass('icon-wen-minus');

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
            $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
            $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
            $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
            $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
            $('.popin-mail').find('form #contact_url').val(images[centerElement].url);
            $('.popin-mail').find('.chap-article').html('');

            if($('.affiche-fdc').length){
                $('.popin-mail').find('.contain-popin .theme-article').empty();
                $('.popin-mail').find('.contain-popin .date-article').empty();
            }
        }
    }

    var goToSLide = function(id) {
        w = $(window).width();
        centerElement = parseInt(id);
        translate = -(w + 0) * centerElement;
        fullscreen.addClass('animated fadeOut');

        setTimeout(function () {
            fullscreen.css('transform', 'translateX(' + translate + 'px)');
            fullscreen.removeClass('fadeOut').addClass('animated fadeIn');
        }, 700);

        hash = "#pid="+images[id].id;

        history.pushState(null, null, hash);
        numberDiapo = centerElement + 1;
        var title = $('.c-fullscreen-slider').find('.title-slide');
        var pagination = $('.c-fullscreen-slider').find('.chocolat-pagination');
        var label = $('.c-fullscreen-slider').find('.category');
        var date = $('.c-fullscreen-slider').find('.date');
        var caption = $('.c-fullscreen-slider').find('.credit');
        var facebook = $('.c-fullscreen-slider').find('.rs-slideshow .facebook');
        var twitter = $('.c-fullscreen-slider').find('.rs-slideshow .twitter');
        var link = $('.c-fullscreen-slider').find('.rs-slideshow .link');

        function isHTML(str) {
            var a = document.createElement('div');
            a.innerHTML = str;
            for (var c = a.childNodes, i = c.length; i--; ) {
                if (c[i].nodeType == 1) return true; 
            }
            return false;
        }

        var finalTitle = '<strong><a>'+images[centerElement].title+'</a></strong>';
        if(typeof images[centerElement].title !== 'undefined'){
            if(isHTML(images[centerElement].title)){
                finalTitle = images[centerElement].title;
            }
        }

        title.html(finalTitle);
        pagination.html(numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i>');
        label.html(images[centerElement].label);
        date.html(images[centerElement].date);
        caption.html(images[centerElement].caption)

        var twitterUrl = images[centerElement].twitter;
        if(typeof twitterUrl === 'undefined'){
            twitterUrl = images[centerElement].twitterurl;
        }

        facebook.attr('href', images[centerElement].facebookurl);
        twitter.attr('href',twitterUrl );
        link.attr('data-clipboard-text', images[centerElement].url);

        if($('.popin-mail').length) {
            $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date);
            $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
            $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
            $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
            $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
            $('.popin-mail').find('form #contact_url').val(images[centerElement].url);
            $('.popin-mail').find('.chap-article').html('');

            if($('.affiche-fdc').length){
                $('.popin-mail').find('.contain-popin .theme-article').empty();
                $('.popin-mail').find('.contain-popin .date-article').empty();
            }
        }

    }

    /* Initiliasion du slideshow fullscreen*/
    $('body').prepend('<div class="c-fullscreen-slider animated fadeIn"><div class="fullscreen-slider"> </div></div>');
    var fullscreen = $('body').find(".fullscreen-slider");s

    var wSlide = w * images.length + 100;
    var wSlide = wSlide + "px";

    fullscreen.css('width', wSlide);

    $( window ).resize(function() {
        var w = $(window).width();
        var wSlide = w * images.length + 100;
        var wSlide = wSlide + "px";

        fullscreen.css('width', wSlide);
    });

    setTimeout(function(){
        if (typeof hash != "undefined") {

            for (var i = 0; i < images.length; i++) {

                if (images[i].id == hash) {
                    centerElement = i;
                    fullscreen.append("<div class='"+images[i].isPortrait+" dezoom'><img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item' /></div>");
                } else {
                    fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "'/></div>");
                }
            }

        } else {
            for (var i = 0; i < images.length; i++) {

                if (i == centerElement) {
                    fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' class='center-item'  /></div>");
                } else {
                    fullscreen.append("<div class='"+images[i].isPortrait+"'><img src='" + images[i].src + "' alt='" + images[i].data + "' /></div>");
                }
            }
        }
    }, 1000);

    var translate = (w + 0) * centerElement;
    translate = -translate + "px";

    numberDiapo = centerElement + 1;

    fullscreen.css('transform', 'translateX(' + translate + ')');

    $('.c-fullscreen-slider').addClass('chocolat-wrapper');

    $('.c-fullscreen-slider').append('<div class="chocolat-top"><i class="icon icon-close chocolat-close"></i></div>');

    function isHTML(str) {
        var a = document.createElement('div');
        a.innerHTML = str;
        for (var c = a.childNodes, i = c.length; i--; ) {
            if (c[i].nodeType == 1) return true;
        }
        return false;
    }

    var finalTitle = '<strong><a>'+images[centerElement].title+'</a></strong>';
    if(typeof images !== 'undefined'){
        if(typeof images[centerElement] !== 'undefined'){

            if(typeof images[centerElement].title !== 'undefined'){
                 if(isHTML(images[centerElement].title)){
                    finalTitle = images[centerElement].title;
                }
            }
        }
    }

    $('.c-fullscreen-slider').append('<div class="c-chocolat-bottom">' +
        '<div class="chocolat-bottom">' +
        '<span class="chocolat-fullscreen"></span>' +
        '<span class="chocolat-pagination"> ' + numberDiapo + '/' + images.length + ' <i class="icon icon-media"></i></span>' +
        '<span class="chocolat-set-title"></span>' +
        '<div class="thumbnails owl-carousel owl-theme owl-loaded">' +
        '</div>' +
        '<span class="chocolat-description"><h2 class="title-slide">' + finalTitle + '</h2></span>' +
        '<div class="credit">' + images[centerElement].caption + '</div>' +
        '<a href="" class="share"><i class="icon icon-share"></i></a>' +
            '<div class="buttons square img-slideshow-share rs-slideshow">' +
            '<div class="texts-clipboard"></div>' +
            '<a href="'+images[centerElement].facebookurl+'" rel="nofollow" class="button facebook ajax">' +
            '<i class="icon icon-facebook"></i></a>' +
            '<a href="'+images[centerElement].twitterurl+'" class="button twitter">' +
            '<i class="icon icon-twitter"></i></a>' +
            '<a href="#" rel="nofollow" class="link self button" data-clipboard-text="'+images[centerElement].url+'"><i class="icon icon-link"></i></a>' +
        '<a href="#" class="button popin-mail-open"><i class="icon icon-letter"></i></a></div>' +
        '<div class="chocolat-left active"><i class="icon icon-arrow-left"></i></div>' +
        '<div class="chocolat-right active"><i class="icon icon-arrow-right"></i></div>' +
        '</div>' +
        '</div>');

    console.log(images[centerElement].url);
    $('.c-fullscreen-slider').append("<div class='zoomCursor'><i class='icon icon-wen-more'></i></div>");

    initRs();

    var thumbnails = $('.c-fullscreen-slider').find('.thumbnails');

    for (var i = 0; i < images.length; i++) {

        if(i == centerElement) {
            thumbnails.append("<div class='thumb active center'>" +
                "<img data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
                "</div>");
        }else{

        thumbnails.append("<div class='thumb'>" +
            "<img  data-id='"+i+"' src='" + images[i].src + "' alt='" + images[i].data + "'/>" +
            "</div>");
        }
    }

    if(images.length < 6){
        var carouselOpts = {
            nav: false,
            dots: false,
            smartSpeed: 500,
            mouseDrag: false,
            margin: 0,
            autoWidth: true,
            URLhashListener: false
        }
    }else{
        var carouselOpts = {
            nav: false,
            dots: false,
            smartSpeed: 500,
            margin: 0,
            autoWidth: true,
            URLhashListener: false
        }
    }

    thumbnailsSlide = $('.chocolat-wrapper .thumbnails').owlCarousel(carouselOpts);

    thumbs = thumbnails.find(".thumb");

    if(images.length > 6) {
        thumbnailsSlide.trigger('to.owl.carousel', [centerElement, 400, true]);
    }

    $(thumbs).removeClass('active');
    $(thumbs[centerElement]).addClass('active');

    $(thumbs).on('click', function () {

        if (!$('.c-fullscreen-slider .owl-stage').hasClass('owl-grab')) {

            $(thumbs).removeClass('active');
            $(this).addClass('active');

            id = $(this).find('img').attr('data-id');
            //thumbnailsSlide.trigger('to.owl.carousel', [$(this).parent().index(), 400, true]);

            goToSLide(id);

            $('.chocolat-pagination').removeClass('active');
            $('.chocolat-wrapper .thumbnails').removeClass('open');
            $('.chocolat-content').removeClass('thumbsOpen');
            $('.fullscreen-slider img').css('opacity', '1');
        }
    });



    if($('.popin-mail').length) {
        $('.popin-mail').find('.contain-popin .theme-article').text(images[centerElement].label);
        if(typeof images[centerElement].date !== 'undefined'){
            $('.popin-mail').find('.contain-popin .date-article').text(images[centerElement].date.replace('undefined',''));
        }
        
        function isHTML(str) {
            var a = document.createElement('div');
            a.innerHTML = str;
            for (var c = a.childNodes, i = c.length; i--; ) {
                if (c[i].nodeType == 1) return true; 
            }
            return false;
        }

        if(typeof images[centerElement].title !== 'undefined'){
            if(isHTML(images[centerElement].title)){
                if($(images[centerElement].title).filter('*').size()){
                    if($(images[centerElement].title).filter('strong').length){
                        images[centerElement].title = $(images[centerElement].title).filter('strong').text();
                    }else{
                        images[centerElement].title = $(images[centerElement].title).text();
                    }
                }
            }
        }
        $('.popin-mail').find('.contain-popin .title-article').text(images[centerElement].title);
        $('.popin-mail').find('form #contact_section').val(images[centerElement].label);
        $('.popin-mail').find('form #contact_detail').val(images[centerElement].date);
        $('.popin-mail').find('form #contact_title').val(images[centerElement].title);
        $('.popin-mail').find('form #contact_url').val(images[centerElement].url);
        $('.popin-mail').find('.chap-article').html('');

        if($('.affiche-fdc').length){
            $('.popin-mail').find('.contain-popin .theme-article').empty();
            $('.popin-mail').find('.contain-popin .date-article').empty();
        }

    }
    
    /*
     slider.addClass('fullscreen-slider');
     */

    $('.share').on('click', function(e){
        e.preventDefault();
        $('.rs-slideshow').toggleClass('show');
    });

    $('.chocolat-right').on('click', function () {
        goToNextPrev(0);
    });

    $('.chocolat-left').on('click', function () {
        goToNextPrev(1);
    })

    $('.chocolat-pagination').on('click', function () {
        $('.thumbnails').toggleClass('open');
        $(this).toggleClass('active');

        if ($('.thumbnails').hasClass('open')) {
            $('.fullscreen-slider img').css('transition', '.5s').css('opacity', '.5');
            thumbnailsSlide.trigger('to.owl.carousel',[centerElement]);
        } else {
            $('.fullscreen-slider img').css('opacity', '1');
        }
    })

    $('.chocolat-top').on('click', function(){

        $('.c-fullscreen-slider img').addClass('anime-zoom');

        setTimeout(function(){
            $('.c-fullscreen-slider').addClass('animated fadeOut');
            $('.c-fullscreen-slider img').remove();

            setTimeout(function(){
                $('.c-fullscreen-slider').remove();
                $('.photoActive').removeClass('photoActive');
                history.pushState(null, null, '#');
                $('html').removeClass('slideshow-open');

                if($('.affiche-fdc').length) {
                     $('.wrapper-item').removeClass('active center');
                }
            }, 1600);
        }, 1000);


    });

    // mouseover img : close thumbs
    $('.fullscreen-slider').on('mouseover', function () {
        $('.chocolat-pagination').removeClass('active');
        $('.chocolat-wrapper .thumbnails').removeClass('open');
        $('.chocolat-content').removeClass('thumbsOpen');
        $('.fullscreen-slider img').css('opacity', '1');
    });

    var slideshowImgReadyInterval = window.setInterval(function(){
        if($('.fullscreen-slider img').length){
            imgReadyFunctions();
            window.clearInterval(slideshowImgReadyInterval);
        }
    },200);
    imgReadyFunctions = function(){
        $('.fullscreen-slider img').on('mousemove', function (e){
        
            $('.zoomCursor').css('display','block');
            $('.zoomCursor').css('z-index','100000');
            $('.zoomCursor').css('left', e.clientX + 10).css('top', e.clientY);

            var img = $(this);

            if(img.hasClass('isZoom')) {

                var pos = $('.chocolat-wrapper').offset();
                var height = $('.chocolat-wrapper').height();
                var width = $('.chocolat-wrapper').width();

                var currentImage = img[0];
                var imgWidth = currentImage.width * 2;
                var imgHeight = currentImage.height * 2;

                var coord = [e.pageX - width/2 - pos.left, e.pageY - height/2 - pos.top];

                var mvtX = 0;
                if (imgWidth > width) {
                    mvtX = coord[0] / (width / 2);
                    mvtX = ((imgWidth - width + 0)/ 2) * mvtX;
                }

                var mvtY = 0;
                if (imgHeight > height) {
                    mvtY = coord[1] / (height / 2);
                    mvtY = ((imgHeight - height + 0) / 2) * mvtY;
                }

                img.css('transform','translate3d(' + (-mvtX) + 'px' +',' + (-mvtY) + 'px' + ', 0) scale(2)');
            }
        })

        $('.fullscreen-slider img').on('click', function (e) {

            $(this).toggleClass('isZoom');

            if($(this).hasClass('isZoom')) {
                $(this).css('transform', 'scale(2)');
                $('.zoomCursor .icon').removeClass('icon-wen-more').addClass('icon-wen-minus');
            }else{
                $(this).css('transform', 'scale(1)');
                $('.zoomCursor .icon').addClass('icon-wen-more').removeClass('icon-wen-minus');
            }

        });

        $('.fullscreen-slider img').on('mouseout', function (e){
            $('.zoomCursor').css('display','none');
        });
    };
    
    //block image open on title click
    $('body').on('click','.chocolat-description a',function(){
        return false;
    })

    //compute title width
    computeSlideshowTitleWidth();

    $(window).resize(function () {
        w = $(window).width();
        translate = -(w + 0) * centerElement;
        $('.fullscreen-slider').css('transform', 'translateX(' + translate + 'px)');
    });
}