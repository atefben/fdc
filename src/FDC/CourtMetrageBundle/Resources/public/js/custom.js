$(window).on('load', function () {

    if ($('.all-articles').length) {
        initNewsListWatcher();
    }
});

/**
 * handles news articles infinite scroll
 * and refreshing items on filter change
 */
function initNewsListWatcher() {
    var NewsListWatcher = {
        fetchingOffset: 500, // distance from bottom of the page at witch we get net items
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