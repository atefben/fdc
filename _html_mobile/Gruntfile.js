module.exports = function(grunt) {


grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    concat: {
    		css: {
    			files:{
    				'./css-concat/home.css': [
			            './css/vendors/*.css',
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/main.css', 
			            './css/include/*.css',
			            './css/fullscreenplayer.css'
			            
				        ],
				    './css-concat/articles.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/articles.css'
			            
				        ],
				    './css-concat/communiques.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/articles.css',
			            './css/press.css'
			            
				        ],
				    './css-concat/events.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/articles.css'
			            
				        ],
				    './css-concat/trailer.css': [
			            './css/vendors/*.css',
			            './css/main.css', 
			            './css/include/*.css',
			            './css/slideshow-video.css',
			            './css/webtv.css',
			            './css/fullscreenplayer.css'
			            
				        ],
				  	'./css-concat/channel.css': [
			            './css/vendors/*.css',
			            './css/main.css', 
			            './css/include/*.css',
			            './css/slideshow-video.css',
			            './css/webtv.css',
			            './css/fullscreenplayer.css'
			            
				        ],
				    './css-concat/channels.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/grid-isotope.css'
			            
				        ],
				    './css-concat/faq.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/horizontal-menu.css',
			            './css/accordeon.css'
				        ],
				    './css-concat/jury.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/horizontal-menu.css',
			            './css/selection.css',
			            './css/jurys.css'
				        ],
				    './css-concat/movie.css': [
			            './css/main.css',
			            './css/movie.css',
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/include/*.css',
			            './css/audioplayer.css',
			            './css/fullscreenplayer.css',
			            './css/slideshow-video.css'
			        ],
			        './css-concat/article.css': [
			            './css/main.css',
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/include/*.css',
			            './css/article.css',
			            './css/audioplayer.css',
			            './css/fullscreenplayer.css',
			            './css/slideshow-video.css'
			        ],
				    './css-concat/artist.css': [
			            './css/main.css',
			            './css/include/*.css',
			            './css/article.css',
			            './css/slideshow-video.css',
			            './css/artist.css'
			            
				    ],			     
			     	'./css-concat/event.css': [
			            './css/main.css',
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/include/*.css',
			            './css/article.css',
			            './css/audioplayer.css',
			            './css/fullscreenplayer.css',
			            './css/slideshow-video.css'
			        ],
			        './css-concat/participate.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/participate.css',
			            './css/accordeon.css'
				        ],
				    './css-concat/photos.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/filters.css',
			            './css/grid-isotope.css'
				        ],
				    './css-concat/selection.css': [
				    	'./css/main.css',
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/include/*.css',
			            './css/audioplayer.css',
			            './css/fullscreenplayer.css',
			            './css/slideshow-video.css',
			            './css/horizontal-menu.css',
			            './css/selection.css'
				        ],
				    './css-concat/videos.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/videos.css',
			            './css/fullscreenplayer.css'
				        ],
				    './css-concat/webtv.css': [
			            './css/vendors/*.css',
			            './css/main.css', 
			            './css/include/*.css',
			            './css/webtv.css',
			            './css/fullscreenplayer.css'
				        ],
    				'./css-concat/webtvTrailer.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/grid-isotope.css',
			            './css/horizontal-menu.css'
				        ],
			        './css-concat/audios.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/videos.css'
				        ],
			        './css-concat/contact.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/contact.css'
				        ],
			        './css-concat/legals.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/legals.css'
				        ],
				    './css-concat/credits.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/legals.css'
				        ],
				    './css-concat/privacy_policy.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/legals.css'
				        ],
			        './css-concat/sitemap.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/sitemap.css'
				        ],
				    './css-concat/palmares.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/horizontal-menu.css',
			            './css/palmares.css',
			            './css/slideshow-video.css'
				        ],
				    './css-concat/press.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/slideshow-video.css',
			            './css/vendors/fullcalendar.min.css',
			            './css/press.css'			            
				        ],
				    './css-concat/searchpage.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/horizontal-menu.css',
			            './css/searchpage.css',
			            './css/filters.css'           
				        ],
				    './css-concat/myselection.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/myselection.css'
	         
				        ]
    			}
		        
    		},
    		js: {
    			files:{
    				'./js-concat/home.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/jquery.chocolat.js',
				            './js/vendors/hammer.min.js',
				            './js/vendors/jwplayer.js',
				            './js/slideshows-chocolat.js',  
				            './js/include/*.js',
				            './js/main.js',
				            './js/fullscreenplayer.js',
				            './js/jsonTest.js',
				            './js/home.js',
				            './js/add-to-selection.js'
				        ],
			        './js-concat/articles.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/filters.js',
				            './js/add-to-selection.js'
				        ],
				    './js-concat/communiques.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/filters.js',
				            './js/add-to-selection.js',
				            './js/horizontal-filters.js'
				        ],
				    './js-concat/events.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/filters.js'
				        ],
				    './js-concat/trailer.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/jwplayer.js',
				            './js/include/*.js',
				            './js/webtv.js',
				            './js/slidervideos.js',
				            './js/trailer.js'
				        ],
				    './js-concat/channel.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/jwplayer.js',
				            './js/include/*.js',
				            './js/webtv.js',
				            './js/slidervideos.js',
				            './js/channel.js',
				            './js/fullscreenplayer.js'
				        ],
			        './js-concat/channels.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/isotope.pkgd.min.js',
				            './js/vendors/packery-mode.pkgd.min.js',
				            './js/include/*.js',
				            './js/grid-isotope.js'
				        ],
			        './js-concat/faq.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/horizontal-menu.js',
				            './js/accordeon.js'
				        ],
			        './js-concat/jury.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/jsonTest.js',
				            './js/horizontal-menu.js'
				        ],
			        './js-concat/movie.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/wavesurfer.min.js',
				            './js/vendors/jquery.chocolat.js',
				            './js/vendors/hammer.min.js',
				            './js/slideshows-chocolat.js',
				            './js/include/*.js',
				            './js/slidervideos.js',
				            './js/audioplayer.js',
				            './js/vendors/jwplayer.js',
				            './js/movie.js',
				            './js/add-to-selection.js'
				        ],
				    './js-concat/article.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/wavesurfer.min.js',
				            './js/vendors/jquery.chocolat.js',
				            './js/vendors/hammer.min.js',
				            './js/slideshows-chocolat.js',
				            './js/include/*.js',
				            './js/slidervideos.js',
				            './js/audioplayer.js',
				            './js/vendors/jwplayer.js',
				            './js/article.js',
				            './js/add-to-selection.js'
				        ],
				    './js-concat/artist.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/palmares.js',
				            './js/artist.js'
				        ],				        
				    './js-concat/event.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/wavesurfer.min.js',
				            './js/vendors/jquery.chocolat.js',
				            './js/vendors/hammer.min.js',
				            './js/slideshows-chocolat.js',
				            './js/include/*.js',
				            './js/slidervideos.js',
				            './js/audioplayer.js',
				            './js/vendors/jwplayer.js',
				            './js/article.js'
				        ],
			        './js-concat/participate.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/accordeon.js',
				            './js/jsonTest.js',
				            './js/googlemap.js'
				        ],
			        './js-concat/photos.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/vendors/jquery.chocolat.js',
				            './js/vendors/hammer.min.js',
				            './js/slideshows-chocolat.js',
				            './js/vendors/isotope.pkgd.min.js',
				            'js/vendors/packery-mode.pkgd.min.js',
				            'js/grid-isotope.js',
				            'js/filters.js'
				        ],
			        './js-concat/selection.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/wavesurfer.min.js',
				            './js/vendors/jquery.chocolat.js',
				            './js/vendors/hammer.min.js',
				            './js/slideshows-chocolat.js',
				            './js/slidervideos.js',
				            './js/audioplayer.js',
				            './js/vendors/jwplayer.js',
				            './js/include/*.js',
				            './js/jsonTest.js',
				            './js/horizontal-menu.js',
				            './js/palmares.js',
				            './js/article.js',
				            './js/selection.js'
				        ],
				    './js-concat/palmares.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/jsonTest.js',
				            './js/horizontal-menu.js',
				            './js/palmares.js',
				        ],
			        './js-concat/videos.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/jwplayer.js',
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/filters.js',
				            './js/fullscreenplayer.js'
				        ],
			        './js-concat/webtv.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/jwplayer.js',
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/slidervideos.js',
				            './js/webtv.js',
				            './js/fullscreenplayer.js'
				        ],
				    './js-concat/webtvTrailer.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/vendors/isotope.pkgd.min.js',
				            './js/vendors/packery-mode.pkgd.min.js',
				            './js/grid-isotope.js',
				            './js/jsonTest.js',
				            './js/horizontal-menu.js'
				        ],
				    './js-concat/audios.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/filters.js'
				        ],
				        './js-concat/contact.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/contact.js'
				        ],
				    './js-concat/legals.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js'
				        ],
				    './js-concat/credits.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js'
				        ],
				    './js-concat/privacy_policy.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js'
				        ],
				    './js-concat/sitemap.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js'
				        ],

				    './js-concat/press.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/vendors/jquery.cookie.js',
				            './js/vendors/jquery-ui.custom.min.js',
				            './js/jsonTest.js',
				   			'./js/vendors/moment.min.js',
				            './js/vendors/fullcalendar.min.js',
				            './js/include/*.js',
				            './js/press.js'
				        ],
				    './js-concat/searchpage.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/menu.js',
				            './js/jsonTest.js',
				            './js/searchpage.js',
				            './js/filters.js'
				        ],
				    './js-concat/myselection.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/menu.js',
				            './js/searchpage.js',
				            './js/jsonTest.js',
				            './js/myselection.js'
				        ],

    			}
		        
    		}
        
    },
    processhtml: {
	    options: {
	      
	    },
	    dist: {
	      files: {
	        './home.html': ['./templates/home.html'],
	        './articles.html': ['./templates/articles.html'],
	        './ba.html': ['./templates/ba.html'],
	        './channels.html': ['./templates/channels.html'],
	        './faq.html': ['./templates/faq.html'],
	        './jury_courtsmetrages.html': ['./templates/jury_courtsmetrages.html'],
	        './jury_longsmetrages.html': ['./templates/jury_longsmetrages.html'],
	        './jury_uncertainregard.html': ['./templates/jury_uncertainregard.html'],
	        './jury_camerador.html': ['./templates/jury_camerador.html'],
	        './movie.html': ['./templates/movie.html'],
	        './article.html': ['./templates/article.html'],
	        './event.html': ['./templates/event.html'],
	        './article-photos.html': ['./templates/article-photos.html'],
	        './article-video.html': ['./templates/article-video.html'],
	        './article-press.html': ['./templates/article-press.html'],
	        './participate_access.html': ['./templates/participate_access.html'],
	        './participate_instructions.html': ['./templates/participate_instructions.html'],
	        './participate_sejour.html': ['./templates/participate_sejour.html'],
	        './participate_partners.html': ['./templates/participate_partners.html'],
	        './participate_provider.html': ['./templates/participate_provider.html'],
	        './photos.html': ['./templates/photos.html'],
	        './selectionofficielle_competition.html': ['./templates/selectionofficielle_competition.html'],
	        './selectionofficielle_cannesclassic_hommage.html': ['./templates/selectionofficielle_cannesclassic_hommage.html'],
	        './selectionofficielle_cannesclassic_invit.html': ['./templates/selectionofficielle_cannesclassic_invit.html'],
	        './selectionofficielle_uncertainregard.html': ['./templates/selectionofficielle_uncertainregard.html'],
	        './videos.html': ['./templates/videos.html'],
	        './webTV.html': ['./templates/webTV.html'],
	        './webtv_trailer_competition.html': ['./templates/webtv_trailer_competition.html'],
	        './webtv_trailer_uncertainregard.html': ['./templates/webtv_trailer_uncertainregard.html'],
	      	'./webtv_trailer_cinemadelaplage.html': ['./templates/webtv_trailer_cinemadelaplage.html'],
	        './webtv_trailer_cannesclassics.html': ['./templates/webtv_trailer_cannesclassics.html'],
	        './webtv_trailer_courtmetrage.html': ['./templates/webtv_trailer_courtmetrage.html'],
	        './webtv_trailer_cinefondation.html': ['./templates/webtv_trailer_cinefondation.html'],
	        './webtv_trailer_seancesspeciales.html': ['./templates/webtv_trailer_seancesspeciales.html'],
	        './webtv_trailer_horscompetition.html': ['./templates/webtv_trailer_horscompetition.html'],
	        './audios.html': ['./templates/audios.html'],
	        './contact.html': ['./templates/contact.html'],
	        './legals.html': ['./templates/legals.html'],
	        './privacy_policy.html': ['./templates/privacy_policy.html'],
	        './credits.html': ['./templates/credits.html'],
	        './sitemap.html': ['./templates/sitemap.html'],
	        './events.html': ['./templates/events.html'],
	        './channel.html': ['./templates/channel.html'],
	        './palmares_competition.html': ['./templates/palmares_competition.html'],
	        './palmares_camerador.html': ['./templates/palmares_camerador.html'],
	        './palmares_uncertainregard.html': ['./templates/palmares_uncertainregard.html'],
	        './palmares_cinefondation.html': ['./templates/palmares_cinefondation.html'],
	        './palmares_all.html': ['./templates/palmares_all.html'],
	        './press.html': ['./templates/press.html'],
	        './searchpage.html': ['./templates/searchpage.html'],
	        './artist.html': ['./templates/artist.html'],
	        './myselection.html': ['./templates/myselection.html'],
	        './press_communiques.html': ['./templates/press_communiques.html']
	      
	      }
	    },
	    prod:{
	    	files: {
	        './home.html': ['./templates/home.html'],
	        './articles.html': ['./templates/articles.html'],
	        './ba.html': ['./templates/ba.html'],
	        './channels.html': ['./templates/channels.html'],
	        './faq.html': ['./templates/faq.html'],
	        './jury_courtsmetrages.html': ['./templates/jury_courtsmetrages.html'],
	        './jury_longsmetrages.html': ['./templates/jury_longsmetrages.html'],
	        './jury_uncertainregard.html': ['./templates/jury_uncertainregard.html'],
	        './jury_camerador.html': ['./templates/jury_camerador.html'],
	        './movie.html': ['./templates/movie.html'],
	        './article.html': ['./templates/article.html'],
	        './event.html': ['./templates/event.html'],
	        './article-photos.html': ['./templates/article-photos.html'],
	        './article-video.html': ['./templates/article-video.html'],
	        './article-press.html': ['./templates/article-press.html'],
	        './participate_access.html': ['./templates/participate_access.html'],
	        './participate_instructions.html': ['./templates/participate_instructions.html'],
	        './participate_sejour.html': ['./templates/participate_sejour.html'],
	        './participate_partners.html': ['./templates/participate_partners.html'],
	        './participate_provider.html': ['./templates/participate_provider.html'],
	        './photos.html': ['./templates/photos.html'],
	        './selectionofficielle_competition.html': ['./templates/selectionofficielle_competition.html'],
	        './selectionofficielle_cannesclassic_hommage.html': ['./templates/selectionofficielle_cannesclassic_hommage.html'],
	        './selectionofficielle_cannesclassic_invit.html': ['./templates/selectionofficielle_cannesclassic_invit.html'],
	        './selectionofficielle_uncertainregard.html': ['./templates/selectionofficielle_uncertainregard.html'],
	        './videos.html': ['./templates/videos.html'],
	        './webTV.html': ['./templates/webTV.html'],
	        './webtv_trailer_competition.html': ['./templates/webtv_trailer_competition.html'],
	        './webtv_trailer_uncertainregard.html': ['./templates/webtv_trailer_uncertainregard.html'],
	      	'./webtv_trailer_cinemadelaplage.html': ['./templates/webtv_trailer_cinemadelaplage.html'],
	        './webtv_trailer_cannesclassics.html': ['./templates/webtv_trailer_cannesclassics.html'],
	        './webtv_trailer_courtmetrage.html': ['./templates/webtv_trailer_courtmetrage.html'],
	        './webtv_trailer_cinefondation.html': ['./templates/webtv_trailer_cinefondation.html'],
	        './webtv_trailer_seancesspeciales.html': ['./templates/webtv_trailer_seancesspeciales.html'],
	        './webtv_trailer_horscompetition.html': ['./templates/webtv_trailer_horscompetition.html'],
	        './audios.html': ['./templates/audios.html'],
	        './contact.html': ['./templates/contact.html'],
	        './credits.html': ['./templates/credits.html'],
	        './legals.html': ['./templates/legals.html'],
	        './privacy_policy.html': ['./templates/privacy_policy.html'],
	        './sitemap.html': ['./templates/sitemap.html'],
	        './events.html': ['./templates/events.html'],
	        './channel.html': ['./templates/channel.html'],
	        './palmares_competition.html': ['./templates/palmares_competition.html'],
	        './palmares_camerador.html': ['./templates/palmares_camerador.html'],
	        './palmares_uncertainregard.html': ['./templates/palmares_uncertainregard.html'],
	        './palmares_cinefondation.html': ['./templates/palmares_cinefondation.html'],
	        './palmares_all.html': ['./templates/palmares_all.html'],
	        './press.html': ['./templates/press.html'],
	        './searchpage.html': ['./templates/searchpage.html'],
	        './artist.html': ['./templates/artist.html'],
	        './myselection.html': ['./templates/myselection.html'],
	        './press_communiques.html': ['./templates/press_communiques.html']

	      }

	    }
	  },
	  uglify: {
	    dist: {
	      files: {
	        './js-concat/home.min.js': ['./js-concat/home.js'],
	        './js-concat/articles.min.js': ['./js-concat/articles.js'],
	        './js-concat/communiques.min.js': ['./js-concat/communiques.js'],
	        './js-concat/trailer.min.js': ['./js-concat/trailer.js'],
	        './js-concat/channels.min.js': ['./js-concat/channels.js'],
	        './js-concat/faq.min.js': ['./js-concat/faq.js'],
	        './js-concat/jury.min.js': ['./js-concat/jury.js'],
	        './js-concat/movie.min.js': ['./js-concat/movie.js'],
	        './js-concat/article.min.js': ['./js-concat/article.js'],
	        './js-concat/event.min.js': ['./js-concat/event.js'],
	        './js-concat/participate.min.js': ['./js-concat/participate.js'],
	        './js-concat/photos.min.js': ['./js-concat/photos.js'],
	        './js-concat/selection.min.js': ['./js-concat/selection.js'],
	        './js-concat/videos.min.js': ['./js-concat/videos.js'],
	        './js-concat/webTV.min.js': ['./js-concat/webTV.js'],
	        './js-concat/webtvTrailer.min.js': ['./js-concat/webtvTrailer.js'],
	        './js-concat/audios.min.js': ['./js-concat/audios.js'],
	        './js-concat/contact.min.js': ['./js-concat/contact.js'],
	        './js-concat/legals.min.js': ['./js-concat/legals.js'],
	        './js-concat/credits.min.js': ['./js-concat/credits.js'],
	        './js-concat/privacy_policy.min.js': ['./js-concat/privacy_policy.js'],
	        './js-concat/sitemap.min.js': ['./js-concat/sitemap.js'],
	        './js-concat/events.min.js': ['./js-concat/events.js'],
	        './js-concat/channel.min.js': ['./js-concat/channel.js'],
	        './js-concat/palmares.min.js': ['./js-concat/palmares.js'],
	        './js-concat/press.min.js': ['./js-concat/press.js'],
	        './js-concat/searchpage.min.js': ['./js-concat/searchpage.js'],
	        './js-concat/artist.min.js': ['./js-concat/artist.js'],
	        './js-concat/myselection.min.js': ['./js-concat/myselection.js']
	      }
	    }
	  },
    
	cssmin: {
	  options: {
	    shorthandCompacting: false,
	    roundingPrecision: -1
	  },
	  target: {
	    files: {
	        './css-concat/home.min.css': ['./css-concat/home.css'],
	        './css-concat/articles.min.css': ['./css-concat/articles.css'],
	        './css-concat/communiques.min.css': ['./css-concat/communiques.css'],
	        './css-concat/trailer.min.css': ['./css-concat/trailer.css'],
	        './css-concat/channels.min.css': ['./css-concat/channels.css'],
	        './css-concat/faq.min.css': ['./css-concat/faq.css'],
	        './css-concat/jury.min.css': ['./css-concat/jury.css'],
	        './css-concat/movie.min.css': ['./css-concat/movie.css'],
	        './css-concat/article.min.css': ['./css-concat/article.css'],
	        './css-concat/event.min.css': ['./css-concat/event.css'],
	        './css-concat/participate.min.css': ['./css-concat/participate.css'],
	        './css-concat/photos.min.css': ['./css-concat/photos.css'],
	        './css-concat/selection.min.css': ['./css-concat/selection.css'],
	        './css-concat/videos.min.css': ['./css-concat/videos.css'],
	        './css-concat/webTV.min.css': ['./css-concat/webTV.css'],
	        './css-concat/webtvTrailer.min.css': ['./css-concat/webtvTrailer.css'],
	        './css-concat/audios.min.css': ['./css-concat/audios.css'],
	        './css-concat/contact.min.css': ['./css-concat/contact.css'],
	        './css-concat/legals.min.css': ['./css-concat/legals.css'],
	        './css-concat/credits.min.css': ['./css-concat/credits.css'],
	        './css-concat/privacy_policy.min.css': ['./css-concat/privacy_policy.css'],
	        './css-concat/sitemap.min.css': ['./css-concat/sitemap.css'],
	        './css-concat/events.min.css': ['./css-concat/events.css'],
	        './css-concat/channel.min.css': ['./css-concat/channel.css'],
	        './css-concat/palmares.min.css': ['./css-concat/palmares.css'],
	        './css-concat/press.min.css': ['./css-concat/press.css'],
	        './css-concat/searchpage.min.css': ['./css-concat/searchpage.css'],
	        './css-concat/artist.min.css': ['./css-concat/artist.css'],
	        './css-concat/myselection.min.css': ['./css-concat/myselection.css']
	    }
	  }
	},
	watch: {
	    css: {
	        files: ['css/*.css', 'css/vendors/*.css', 'css/include/*.css'],
	        tasks: ['concat:css'],
	        options: {
	            spawn: false
	        }
	    },
	    js: {
	        files: [ 'js/*.js','js/vendors/*.js','js/include/*.js'],
	        tasks: ['concat:js'],
	        options: {
	            spawn: false
	        }
	    },
	    html: {
	        files: ['templates/*.html', 'include/*.html'],
	        tasks: ["processhtml:dist"],
	        options: {
	            spawn: false
	        }
	    }
	}

});

grunt.loadNpmTasks('grunt-contrib-concat');
grunt.loadNpmTasks('grunt-contrib-uglify');
grunt.loadNpmTasks('grunt-contrib-cssmin');
grunt.loadNpmTasks('grunt-processhtml');
grunt.loadNpmTasks('grunt-contrib-watch');

grunt.registerTask('default', ['concat', "processhtml:dist"]);
grunt.registerTask('prod', ['concat', 'uglify', "cssmin","processhtml:prod"]);

};