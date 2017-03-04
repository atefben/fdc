var owInitGrid = function (id) {
    if (id == 'isotope-01') {
        var $grid = $('.isotope-01:not(.add-ajax-request):not(.noComputing)');
        $grid.imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer',
                    gutter: 0
                }
            });

            $grid.on( 'arrangeComplete', function( event, filteredItems ) {
                $('.item-inner').css({
                    'width':'100.5%',
                    'height':'100.5%'
                });

                $('.isotope-01 .item.video').on('click',function(){
                    $('.isotope-01 .item.video').removeClass('activeVideo');
                    $(this).addClass('activeVideo');
                });
            });


        });

        var $items = $('.item');
        var clickAllow = true;
        var $gridDom = $('.add-ajax-request');
        var $gridMore = $gridDom.imagesLoaded(function(){
            $gridMore.isotope({
                itemSelector: '.item',
                layoutMode: 'masonry',
                packery: {
                    columnWidth: '.grid-sizer'
                },
                getSortData: {
                    number: '[data-sort]'
                },
                // sort by color then number
                sortBy: ['number']
            });
            $gridMore.isotope();

            if($gridDom.parent().find('.ajax-request').length){
                if(!$gridDom.parent().find('.ajax-request').is(':visible')){
                    //hidden button, infinite load
                    var footerHeight = $('footer').outerHeight();
                    $(window).scroll(function(){
                        if(($(window).height() + $(document).scrollTop()) > ($(document).height() - footerHeight)){
                            if(clickAllow){
                                clickAllow = false;
                                $('.ajax-request').trigger('click');
                            }
                        }
                    });
                }
            }
        });

        var ticker = window.setInterval(function(){
            clickAllow = true;
        },1000);


        var number = 0;

        if($('.home').length){
            $('.read-more.ajax-request').off('click').on('click', function(e){
                e.preventDefault();

                var url = $(this).attr('href');

                var dateTime = $('.last-element').data('time');

                $.get( url, {date: dateTime}, function( data ) {

                    if(data == null){
                        return false;
                    }else{
                        $data = $(data);
                        
                        var moreBtn = $data.filter('.bright').attr('href');
                        console.log(moreBtn);
                        if(typeof moreBtn !== 'undefined'){
                            var articles = $data.find('article');
                            $gridMore.append(articles).isotope( 'addItems', articles );
                            $gridMore.isotope();
                        
                            $this.attr('href',moreBtn);
                        }
                    }
                });

            });
        }else{
            $('.read-more.ajax-request').off('click').on('click', function(e){
                e.preventDefault();
                var $this = $(this);
                var url = $(this).attr('href');

                $.post({
                    type: 'POST',
                    url: url,
                    data: {
                        search: $('input[name="search"]').val(),
                        photo: $('input[name="photo"]').val(),
                        video: $('input[name="video"]').val(),
                        audio: $('input[name="audio"]').val(),
                        'year-start': $('input[name="year-start"]').val(),
                        'year-end': $('input[name="year-end"]').val(),
                        pg: parseInt($('input[name="pg"]').val())+1
                    },
                    success: function(data) {
                        $data = $(data);
                        
                        var moreBtn = $data.filter('.bright').attr('href');
                        console.log(moreBtn);
                        if(typeof moreBtn !== 'undefined'){
                            var articles = $data.find('article');
                            $gridMore.append(articles);
                            $gridMore.isotope('destroy');
                            $this.attr('href',moreBtn);
                        }
                        $gridMore.imagesLoaded(function () {
                            $gridMore.isotope({
                                itemSelector: '.item',
                                layoutMode: 'packery',
                                packery: {
                                    columnWidth: '.grid-sizer',
                                    gutter: 0
                                }
                            });

                            //scroll bottom
                            /*$('html,body').animate({
                                scrollTop: $('.isotope-01').outerHeight()
                            },300);*/

                            $('.card.item').each(function(){
                                var $this = $(this);
                                var title = $this.find('.info strong a');
                                var cat = $this.find('.info .category');
                                var titleText;
                                var catText;

                                //if (!title.hasClass('init')) {
                                    titleText = $this.find('.info strong a').text();
                                    title.addClass('init');
                                    title.attr('data-title', titleText);

                                //if (!cat.hasClass('init')) {
                                    catText = cat.text();
                                    cat.addClass('init');
                                    cat.attr('data-cat', catText);

                                cat.addClass('init').attr('data-cat', cat.text());

                                title.html(titleText.trunc(30, true));
                                cat.html(catText.trunc(30, true));
                            });

                        });
                        
                        

                        $('input[name="pg"]').val(parseInt($('input[name="pg"]').val())+1);

                        owinitSlideShow($grid);
                        initVideo();
                        initAudio();

                    }
                })
            });
        }


        if ($('.jury').length) {

            var resize = function () {
                var w = $('.isotope-01 .contain-img').first().width();
                $('.isotope-01 .contain-img').each(function () {
                    $(this).css('height', (w / 0.75));
                    var $container = $(this), imgUrl = $container.find('img').prop('src');
                    if (imgUrl) {
                        $container.css('backgroundImage', 'url(' + imgUrl + ')').addClass('compat-object-fit');
                        img = $container.find('img');
                        img.css('display', 'none');
                    }
                });
            }

            resize();

            $(window).resize(function () {
                resize();
            });

        }

        if(!$('#home').length > 0) {
            
            var trunTitle = function() {
                $.each($('.card.item'), function (i, e) {
                    var title = $(e).find('.info strong a');
    
                    if (!title.hasClass('init')) {
                        var text = $(e).find('.info strong a').text();
                        title.addClass('init');
                        title.attr('data-title', text);
                    } else {
                        var text = title.attr('data-title');
                    }

                    var cat = $(e).find('.info .category');

                    if (!cat.hasClass('init')) {
                        text2 = cat.text();
                        cat.addClass('init');
                        cat.attr('data-cat', text2);
                    } else {
                        text2 = cat.attr('data-title');
                    }
    
    
                    if($('.medias').length > 0) {
    
                        if (window.matchMedia("(max-width: 1405px)").matches) {
                            title.html(text.trunc(25, true));
                        }else{
                            title.html(text.trunc(30, true));
                        }
    
                    } else {
                        title.html(text.trunc(30, true));

                        if (typeof text2 !== "undefined") {
                            cat.html(text2.trunc(30, true));
                        }
                    }
                });
            }
    
    
            trunTitle();
    
    
            $(window).resize(function () {
                trunTitle();
            });
    
            var title = $('.info strong a').text();
        }


        if($('.item.block-poster').length) {
            function selectionGridComputing(){
                var stop = false;
                var lineClassIndex = 0;
                var lineContentHeights = [];
                var previousItem;

                //get max heights
                $.each($('.item.block-poster'), function (i,e) {
                    var naturalIndex = i+1;
                    var ww = window.innerWidth;
                    var colNumber = 4;
                    if(ww > 1280){
                        colNumber = 5;
                    }

                    if(ww > 1600){
                        colNumber = 6;
                    }

                    if(ww >= 1920){
                        colNumber = 8;
                    }

                    if(i%colNumber == 0){
                        lineClassIndex += 1;
                    }

                    if(typeof lineContentHeights[lineClassIndex] !== 'undefined'){
                        if($(this).find('.contain-txts').removeAttr('style').outerHeight() > lineContentHeights[lineClassIndex]){
                            lineContentHeights[lineClassIndex] = $(this).find('.contain-txts').outerHeight();
                        }
                    }else{
                        lineContentHeights[lineClassIndex] = $(this).find('.contain-txts').outerHeight();
                    }



                    $(this).attr('rel',lineClassIndex);
                    previousItem = $(this);
                });
                
                //apply heights
                $.each($('.item.block-poster'), function (i,e) {
                    var height = lineContentHeights[$(this).attr('rel')];
                    $(this).find('.contain-txts').css('height',height);
                });
            }

            selectionGridComputing();
            $(window).on('resize',function(){
                selectionGridComputing();
            });
        }

        return $grid;
    }

    if (id == 'isotope-02') {


        var $grid = $('.isotope-02').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    gutter: 39
                }
            });
        });


        if($('.who-filter').length) {
            var active = $('.filter .select span.active').data('filter');

            $('.pages:not(.'+active+')').css('display','none');
            $('.pages.'+active).css('display','block');

        }

        return $grid;
    }

    if (id == 'isotope-03') {

        var $grid = $('.isotope-03').imagesLoaded(function () {
            $grid.isotope({
                itemSelector: '.item',
                percentPosition: true,
                sortBy: 'original-order',
                layoutMode: 'packery',
                packery: {
                    columnWidth: '.grid-sizer'
                }
            });
        });



        var trunTitle = function() {
            $.each($('.card.item'), function (i, e) {
                var title = $(e).find('.info strong a');

                if (!title.hasClass('init')) {
                    var text = $(e).find('.info strong a').text();
                    title.addClass('init');
                    title.attr('data-title', text);
                } else {
                    var text = title.attr('data-title');
                }


                if($('.medias').length > 0) {

                    if (window.matchMedia("(max-width: 1405px)").matches) {
                        title.html(text.trunc(25, true));
                    }else{
                        title.html(text.trunc(40, true));
                    }

                } else {
                    title.html(text.trunc(60, true));
                }
            });
        }


        trunTitle();


        $(window).resize(function () {
            trunTitle();
        });

        var title = $('.info strong a').text();

        return $grid;
    }

    if (id == 'filter') {

        if ($('.isotope-01').length) {

            var filterDate = '',
                filterTheme = '',
                filterFormat = '';

            if ($('.filters #date').length > 0) {
                filterDate = $('.filters #date .select span.active').data('filter');
                filterDate = "." + filterDate;
            }

            if ($('.filters #theme').length > 0) {
                filterTheme = $('.filters #theme .select span.active').data('filter');
                filterTheme = "." + filterTheme;
            }

            if ($('.filters #format').length > 0) {
                filterFormat = $('.filters #format .select span.active').data('filter');
                filterFormat = "." + filterFormat;
            }

            var filters = filterDate + filterTheme + filterFormat;
            
            var $grid = $('.isotope-01').isotope({filter: filters});
        }

        if ($('.isotope-02').length) {

            var filterStaff = $('.filters #staff .select span.active').data('filter');
            filterStaff = "." + filterStaff;


            var $grid = $('.isotope-02').isotope({filter: filterStaff});
        }
    }


};


var owsetGridBigImg = function (grid, dom, init) {

    var $img = $(dom).find('.card img'),
        pourcentage = 0.30,
        nbImgAAgrandir = $img.length * pourcentage,
        i = 0,
        nbRamdom = [],
        x = 1,
        j = 0,
        max = 0,
        min = 0,
        nbImage = $img.length;

    $($img).closest('article.card').removeClass('double w2');

    if (window.matchMedia("(max-width: 1279px)").matches) {

        while (i < $img.length) {
            if (j < 15) {
                if (j == 0 || j == 5 || j == 11) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 14) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(max-width: 1599px)").matches) {

        while (i < $img.length) {
            if (j < 10) {
                if (j == 0 || j == 3) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 9) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(max-width: 1919px)").matches) {
        while (i < $img.length) {
            if (j < 30) {
                if (j == 0 || j == 3 || j == 12 || j == 17 || j == 25) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 29) {
                j = 0;
            }
            i++;
        }


    } else if (window.matchMedia("(min-width: 1920px)").matches) {

        while (i < $img.length) {
            if (j < 15) {
                if (j == 0 || j == 5 || j == 14) {
                    $($img[i]).closest('article.card').addClass('double w2');
                }
                j++;
            }
            if (j == 14) {
                j = 0;
            }
            i++;
        }
    }
};

var owInitAleaGrid = function (grid, dom, init) {
    var $img = $(dom).find('.item:not(.portrait) img'),
        pourcentage = 0.50,
        nbImgAAgrandir = $img.length * pourcentage,
        i = 0,
        nbRamdom = [],
        x = 1,
        max = 0,
        min = 0,
        nbImage = $img.length;

    while (x < nbImgAAgrandir) {
        while (nbImgAAgrandir > nbRamdom.length) {
            max = nbImage * pourcentage * x;
            min = nbImage * pourcentage * (x - 1);
            nbAlea = Math.floor(Math.random() * (max - min) + min);
            nbRamdom[i] = nbAlea;
            $($img[nbRamdom[i]]).closest('article.item').addClass('double w2');
            i++;
            x++;
        }
    }

    $('.item').addClass('visible');

    grid.isotope({
        itemSelector: '.item',
        percentPosition: true,
        sortBy: 'original-order',
        layoutMode: 'packery',
        packery: {
            columnWidth: '.grid-sizer'
        }
    });

    grid.isotope('layout');
};
