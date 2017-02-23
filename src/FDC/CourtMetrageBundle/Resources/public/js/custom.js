$(document).ready(function () {
    /** Bind here all the functions **/
    initProPage();
    shortFilmCornerStickyHeader();
    initNewsListWatcher();
});

function shortFilmCornerStickyHeader() {
    var $sfcStickyNav = $('.short-film-corner .navigation-sticky');
    if ($sfcStickyNav.length > 0) {
        var fixedNav = false;
        var topTriggerNav = $sfcStickyNav.offset().top - 210;
        $(document).scroll(function() {
            if ($(this).scrollTop() >= topTriggerNav) {
                if (!fixedNav) {
                    fixedNav = true;
                    $sfcStickyNav.addClass("subNavigationFixed");
                }
            } else {
                if( fixedNav ) {
                    fixedNav = false;
                    $sfcStickyNav.removeClass("subNavigationFixed");
                }
            }
        });
    }
}

function initProPage() {
    $('.modal-toggle').unbind().on('click', function(e) {
        e.preventDefault();

        if ($('.modal').hasClass('is-visible')) {
            $('.modal').toggleClass('is-visible');
        } else {
            getProInfo(this);
        }
    });
}

function getProInfo(pro) {

    $.ajax({
        url: Routing.generate('fdc_ccm_pros_du_court_modal', {id: $(pro).data('pro-id')}),
        type: 'POST',
        cache: false,
        data: {
            id: $(pro).data('pro-id')
        },
        success: function (data, textStatus, xhr) {
            if (typeof data == 'object') {
                console.log('Error ' + xhr.status + ': ' + data.message);
            } else {
                $('.modal-content').empty();
                $('.modal-content').append(data);
            }
        },
        error: function (response) {
        }
    }).done(function () {
        setTimeout(function () {
            $('.modal').toggleClass('is-visible');
        }, 200);
    });
}

/**
 * handles news articles infinite scroll
 * and refreshing items on filter change
 */
function initNewsListWatcher() {
    if ($('.all-articles').length) {
        var NewsListWatcher = {
            fetchingOffset: 500, // distance from bottom of the page at witch we get next items
            batchSize: 15,
            $window: $(window),
            $grid: $('#gridAudios'),
            $feedEnd: $('#next'),
            itemsIdentifier: '.item',
            init: function ()
            {
                this.listenToScroll();
                this.listenToFilterChange();
                this.checkPosition();
            },
            listenToScroll: function ()
            {
                this.$window.on('scroll', $.proxy(function(){
                    this.checkPosition();
                }, this ));
            },
            listenToFilterChange: function ()
            {
                /**
                 * when articles are filtered we must re-fetch articles if the newly
                 * applied filter resulted in a small number of results
                 */
                $(document).delegate('#filters span[data-filter]', 'click', $.proxy(function() {
                    this.checkPosition();
                }, this));
            },
            checkPosition: function ()
            {
                /**
                 * check if we are close enough to the page bottom to show next articles
                 */
                if (this.$feedEnd.offset().top < (this.$window.height() + this.$window.scrollTop() + this.fetchingOffset)) {
                    this.fetchNextItems();
                }
            },
            /**
             * remove the <hidden> class from the next batch of articles
             * Note: this can be changed to an ajax call later on
             */
            fetchNextItems: function ()
            {
                var nextBatch = $(this.itemsIdentifier + '.hidden').slice(0, this.batchSize);
                if (nextBatch.length) {
                    nextBatch.removeClass('hidden');
                    if (this.$grid.data('isotope')) {
                        /**
                         * we reset the grid layout and fit the newly added articles
                         */
                        this.$grid.isotope('layout');
                    }
                    /**
                     * we check again if we are close to the bottom of the page and need to fetch results again
                     * this could happen when the articles are filtered by year or theme and the previous
                     * <fetch> didn't bring enough articles of that type to fill the page
                     */
                    this.checkPosition();
                }
            }
        };

        NewsListWatcher.init();
    }
}
    
