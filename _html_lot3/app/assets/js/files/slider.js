/*------------------------------------------------------------------------------
 JS Document (https://developer.mozilla.org/en/JavaScript)

 project:    Festival de Cannes
 Author:     OHWEE
 created:    2016-24-03

 summary:    SLIDER HOME
 ----------------------------------------------------------------------------- */

function isMacintosh() {
    return navigator.platform.indexOf('Mac') > -1
}

function isWindows() {
    return navigator.platform.indexOf('Win') > -1
}

var isMac = isMacintosh();
var isPC = !isMacintosh();

var owInitSlider = function (sliderName) {
    /* SLIDER HOME
     ----------------------------------------------------------------------------- */
    if (sliderName == 'home') {

        var slide = $('.slider-carousel').owlCarousel({
            navigation: true,
            items: 1,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplayHoverPause: true,
            loop: true,
            smartSpeed: 700,
            onInitialized: function(){
                var slides = $('.slider-home .owl-item');
                slides.each(function(){
                    var container = $(this).find('.text-trunc');
                    var desc = container.text();
                    desc = desc.replace(/(<p[^>]+?>|<p>|<\/p>)/img, "");
                    container.empty().html(desc);
                    $clamp(container.get(0), {clamp: 3});
                });
            }
        });

        slide.on('changed.owl.carousel', function (event) {
            setTimeout(function () {
                var $item = $('.owl-item.active').find('.item');
                var number = $item.data('item');
                var $active = $(".container-images .item.active");

                $active.removeClass("fadeInRight").addClass('fadeOut');

                setTimeout(function () {
                    $(".container-images .item[data-item=" + number + "]").removeClass('fadeOut').addClass('active fadeInRight');
                    $active.removeClass('active');
                }, 500);
            }, 200);
        });

        $('.slider-home').on('click', function(e){
            if($(e.target).hasClass('owl-dots') || $(e.target).closest('.owl-dots').length){
                return false;
            }else{
                var href = $('.owl-item.active .coverLink').attr('href');
                window.location.href = href;
            }

        })


    }


    /* SLIDER 01
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-01') {
        var center = $('#home').length ? false : true;
        var slide01 = $('.slider-01').owlCarousel({
            navigation: false,
            items: 1,
            autoWidth: true,
            smartSpeed: 700,
            center: center
        });

        slide01.on('initialize.owl.carousel',function(elem){
            console.log('afterInit',elem);
            if($('#home').length){
                console.log(elem);
            }
        });

        // Custom Navigation Events
        $(document).on('click', '.slider-01 .owl-item', function () {
            var number = $(this).index();

            $('.slider-01 .center').removeClass('center');
            $(this).addClass('center');
            slide01.trigger('to.owl.carousel', number);
        });
    }

    /* SLIDER 02
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-02') {
        var slide01 = $('.slider-02').owlCarousel({
            navigation: false,
            items: 3,
            autoWidth: true,
            smartSpeed: 700,
            center: true,
            margin: 27.5
        });

        // Custom Navigation Events
        $('.slider-02 .slide-video').on('click', function () {
            var number = $(this).index();
            playerInstance.playlistItem(number);
            $('.slider-02 .center').removeClass('center');
            $(this).addClass('center');
            slide01.trigger('to.owl.carousel', number);

        });
    }

    /* SLIDER 03
     ----------------------------------------------------------------------------- */
    if (sliderName == 'slider-03') {

        var slide01 = $('.slider-03').owlCarousel({
            navigation: false,
            items: 1,
            autoWidth: true,
            smartSpeed: 700,
            center: true,
            margin: 27.5
        });

        // Custom Navigation Events
        $(document).on('click', '.slider-03 .owl-item', function () {
            var number = $(this).index();

            $('.slider-02 .center').removeClass('center');
            $(this).addClass('center');
            slide01.trigger('to.owl.carousel', number);

        });
    }


    if (sliderName == "timelapse-01") {

        //Init var
        var slider = document.getElementById('timelapse-01');
        var $slide = $('.slides');
        var $slideCalc1 = $('.slides-calc1');
        var $slideCalc1Slide = $('.slides-calc1 .slide');
        var $slideCalc2 = $('.slides-calc2');

        var numberSlide = $('.slider-restropective').size();
        var sizeSlide = $('.slider-restropective').width();
        var finalSizeSlider = numberSlide * sizeSlide + 1000;

        $('.discover').on('click', function (e) {
            $('body').addClass('fs-off');
        });
        var initOpenAjax = function () { //ajax
            $('.discover').on('click', function (e) {

                e.preventDefault();
                var url = $(this).data('url');
                
                $('.slider-restropective').addClass('isOpen block-push block-push-top background-effet');
                $('.timelapse').css('display', 'none');
                $('.discover').css('display', 'none');
                $('.slides-calc2').css('display', 'none');
                $('.title-big-date').addClass('title-2').removeClass('title-big-date');
                $('.title-edition').addClass('title-4').removeClass('title-edition');

                var imgurl = $('.block-push-top.big .container img').attr('src');
                $('.block-push-top.big .container img').css('display', 'none');

                $('.block-push').css('background-position', '0px -240px');
                $('.block-push-top.big').css('background-image', 'url(' + imgurl + ')');

                $.get(url, function (data) {
                    var data = $(data).find('.contain-ajax');
                    $('.ajax-section').html(data);
                    owInitNavSticky(1);
                    window.history.pushState('', '', url);

                    setTimeout(function () {
                        if ($('.isotope-01').length) {
                            owInitGrid('isotope-01');
                        }
                    }, 1000);

                });

                return false;
            });
        }

        // init slider
        $slide.css('width', finalSizeSlider); // change size slider

        var test = '418%';
        $slideCalc1.css('width', test); // change size slider

        var maxDate = $('.timelapse .date-last').data('lastdate');

        //init width of slide
        noUiSlider.create(slider, {
            start: [1945],//todo script
            range: {
                'min': 1945,
                'max': maxDate
            }
        });

        var initDrag = 1;

        slider.noUiSlider.on('update', function (values, handle) {

            var nm = isMac ? 4 : 21;
            //drag
            var w = $(window).width() + nm;
            var number = 0;


            valuesFloat = parseFloat(values[handle]);
            valuesInt = parseInt(values[handle]);
            values = Math.round(valuesFloat);
            number = values - 1945;

            $('.slides-calc1 .date').html(values);

            $('.big img').removeClass('open');
            $('.slider-restropective .calc3').css('display', 'block');
            $('.slider-restropective .calc4').css('display', 'block');

            if (initDrag) {
                initDrag = 0;
            }

            if (values > 1945) {
                $('.slides-calc1').css('display', 'block');
                $('.slides-calc2.navigation').removeClass('begin');
            } else {
                $('.slides-calc1').css('display', 'none');
                $('.slides-calc2.navigation').addClass('begin');
            }

            if (number > 0.7 && initDrag == 0) {
                $('.slider-restropective[data-slide="0"]').removeClass('animated fadeIn').addClass('animated fadeOut');
                $('.slides-calc1').removeClass('animated fadeOut').addClass('animated fadeIn');
            } else if (number < 0.9) {
                $('.slider-restropective[data-slide="0"]').removeClass('animated fadeOut').addClass('animated fadeIn');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');
            }

            //paralax calc 3

            var val2 = -(valuesFloat - 1945 - number) * 380; //todo script ?
            $('.slider-restropective[data-slide=' + number + '] .calc3').css('transform', 'translate(' + val2 + 'px)');

            //paralax cal 4

            var val3 = -(valuesFloat - 1945 - number) * 80; //todo script ?
            $('.slider-restropective[data-slide=' + number + '] .calc4').css('transform', 'translate(' + val3 + 'px)');

            var val = -w * (values - 1945); //todo script ?

            $slide.css('transform', 'translate(' + val + 'px)');

            $('.slider-restropective').removeClass('big').addClass('small');
            $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
            $('.slider-restropective .texts').removeClass('zoomIn fadeIn pulse visible');

        });

        slider.noUiSlider.on('end', function (values, handle) { //end drag

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
            valuesFloat = parseFloat(values[handle]);
            values = Math.round(valuesFloat);
            number = values - 1945;


            var val = -w * (number); //todo script ?

            $slide.css('transform', 'translate(' + val + 'px)');

            $('.slider-restropective .calc3').css('display', 'none');
            $('.slider-restropective .calc4').css('display', 'none');

            var slideElement = $('.slider-restropective[data-slide=' + number + ']');
            var slideElementText = $('.slider-restropective[data-slide=' + number + '] .texts');

            slideElement.removeClass('small').addClass('big');
            $('.big img').addClass('open');

            setTimeout(function () {

                slideElementText.addClass('animated zoomIn fadeIn visible');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

                setTimeout(function () {

                    slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
                    $('.slides-calc1').css('display', 'none');
                    initOpenAjax();
                }, 600);
            }, 900);

            $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');

        });

        var animation = function (event) {

            var date = $('.slides-calc1 .date').html();
            date = parseInt(date);

            if (event == "next") {
                date = date + 1;
                slider.noUiSlider.set([date]);
                stopAnimation();
            }

            if (event == "prev") {
                date = date - 1;
                slider.noUiSlider.set([date]);
                stopAnimation();
            }

            if (event == "next-open") {
                date = date + 1;
                slider.noUiSlider.set([date]);
                animationOpen();
            }

            if (event == "prev-open") {
                date = date - 1;
                slider.noUiSlider.set([date]);
                animationOpen();
            }

            return false;
        }

        var stopAnimation = function () {

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945); //todo script ?


            $slide.css('transform', 'translate(' + val + 'px)');

            $('.slider-restropective .calc3').css('display', 'none');
            $('.slider-restropective .calc4').css('display', 'none');

            var slideElement = $('.slider-restropective[data-slide=' + number + ']');
            var slideElementText = $('.slider-restropective[data-slide=' + number + '] .texts');

            slideElement.removeClass('small').addClass('big');
            $('.big img').addClass('open');

            setTimeout(function () {

                slideElementText.addClass('animated zoomIn fadeIn visible');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

                setTimeout(function () {

                    slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
                    $('.slides-calc1').css('display', 'none');
                    initOpenAjax();

                }, 600);
            }, 900);

            $('.slider-restropective[data-slide="0"]').removeClass('big').removeClass('small');
        }

        var animationOpen = function () {

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945); //todo script ?
            var slideElement = $('.slider-restropective[data-slide=' + number + ']');
            var slideElementText = $('.slider-restropective[data-slide=' + number + '] .texts');

            $('.slider-restropective .calc3').css('display', 'none');
            $('.slider-restropective .calc4').css('display', 'none');

            $slide.css('transform', 'translate(' + val + 'px)');
            $('.slides-calc1').css('display', 'none');
            slideElement.addClass('big');

            var imgurl = $('.block-push-top.big .container img').attr('src');
            $('.block-push-top.big .container img').css('display', 'none');
            $('.block-push-top.big').css('background-image', 'url(' + imgurl + ')');

            setTimeout(function () {

                slideElementText.addClass('animated zoomIn fadeIn visible');
                $('.slides-calc1').removeClass('animated fadeIn').addClass('animated fadeOut');

                setTimeout(function () {

                    slideElementText.removeClass('zoomIn fadeIn').addClass('pulse');
                    $('.slides-calc1').css('display', 'none');
                    initOpenAjax();

                }, 600);
            }, 900);
        }
        // ON CLICK

        $('.slides-calc2.next').on('click', function () {
            animation('next');
        });

        $('.slides-calc2.prev').on('click', function () {
            animation('prev');
        });


        $('.date-next').on('click', function () {
            animation('next-open');

            var $this = $(this);

            var url = $this.data('url');

            $.get(url, function (data) {
                var data = $(data).find('.contain-ajax');

                $('.ajax-section').html(data);
                owInitNavSticky(1);

                window.history.pushState('', '', url);
            });

        });

        $('.date-back').on('click', function () {


            var url = $(this).data('url');


            $.get(url, function (data) {
                var data = $(data).find('.contain-ajax');

                $('.ajax-section').html(data);
                owInitNavSticky(1);

                window.history.pushState('', '', url);
            });

            animation('prev-open');
        });

        if ($('.restrospective-init').length) {

            setTimeout(function(){
                var nm = isMac ? 4 : 21;
                var w = $('body').width() + nm;
                values = $('.slides-calc1 .date').data('date');

                slider.noUiSlider.set([values]);

                number = values - 1945;
                var val = -w * (values - 1945); //todo script

                $slide.css('transform', 'translate(' + val + 'px)');

                animationOpen();

            }, 1000);

        }
    }
};


var rtime;
var timeoutVar = false;
var delta = 300;
$(window).resize(function() {
    $('.slides').removeClass('fadeIn').addClass('animated fadeOut');

    rtime = new Date();
    if (timeoutVar === false) {
        timeoutVar = true;
        setTimeout(resizeend, delta);
    }
});

function resizeend() {


    if (new Date() - rtime < delta) {
        setTimeout(resizeend, delta);
        var $slideCalc1 = $('.slides');


    } else {
        timeoutVar = false; 
        if ($('.retrospective').length) {
            
            $('.slides').removeClass('fadeOut').addClass('fadeIn');
            var $slide = $('.slides');
            var $slideCalc1 = $('.slides-calc1');

            var nm = isMac ? 4 : 21;
            var w = $('body').width() + nm;
            var numberSlide = $('.slider-restropective').size() + 1;
            var sizeSlide = $('.slider-restropective').width();
            var finalSizeSlider = numberSlide * sizeSlide;

            $slide.css('transition','0s');
            $slide.css('width', finalSizeSlider); // change size slider
            //$slideCalc1.css('width',finalSizeSlider); // change size slider*/

            values = $('.slides-calc1 .date').html();
            number = values - 1945;
            var val = -w * (values - 1945); //todo script ?


            $slide.css('transform', 'translate(' + val + 'px)');

        }
    }
}