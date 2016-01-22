module.exports = function(grunt) {


grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    concat: {
    		css: {
    			files:{
    				'./css-concat/home.css': [
			            './css/vendors/*.css',
			            './css/main.css', 
			            './css/include/*.css'
			            
				        ],
				    './css-concat/articles.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/articles.css'
			            
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
			            './css/webtv.css'
			            
				        ],
				  	'./css-concat/channel.css': [
			            './css/vendors/*.css',
			            './css/main.css', 
			            './css/include/*.css',
			            './css/slideshow-video.css',
			            './css/webtv.css'
			            
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
			            './css/slideshows-chocolat.css',
			            './css/vendors/chocolat.css',
			            './css/include/*.css',
			            './css/movie.css',
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
			            './css/filters.css',
			            './css/grid-isotope.css'
				        ],
				    './css-concat/selection.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/horizontal-menu.css',
			            './css/selection.css'
				        ],
				    './css-concat/videos.css': [
			            './css/main.css', 
			            './css/include/*.css',
			            './css/filters.css',
			            './css/videos.css'
				        ],
				    './css-concat/webtv.css': [
			            './css/vendors/*.css',
			            './css/main.css', 
			            './css/include/*.css',
			            './css/webtv.css'
			            
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
				        ]
    			}
		        
    		},
    		js: {
    			files:{
    				'./js-concat/home.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/main.js'
				        ],
			        './js-concat/articles.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/filters.js'
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
				            './js/include/*.js',
				            './js/webtv.js',
				            './js/slidervideos.js'
				        ],
				    './js-concat/channel.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/webtv.js',
				            './js/slidervideos.js'
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
				            './js/movie.js'
				        ],
			        './js-concat/participate.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/accordeon.js'
				        ],
			        './js-concat/photos.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/vendors/isotope.pkgd.min.js',
				            'js/vendors/packery-mode.pkgd.min.js',
				            'js/grid-isotope.js',
				            'js/filters.js'
				        ],
			        './js-concat/selection.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/jsonTest.js',
				            './js/horizontal-menu.js'
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
				            './js/videos.js'
				        ],
			        './js-concat/webtv.js':[
				            './js/vendors/jquery-1.12.0.min.js', 
				            './js/vendors/owl.carousel.min.js',
				            './js/include/*.js',
				            './js/slidervideos.js'
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
	        './movie.html': ['./templates/movie.html'],
	        './participate_access.html': ['./templates/participate_access.html'],
	        './photos.html': ['./templates/photos.html'],
	        './selectionofficielle_competition.html': ['./templates/selectionofficielle_competition.html'],
	        './selectionofficielle_uncertainregard.html': ['./templates/selectionofficielle_uncertainregard.html'],
	        './videos.html': ['./templates/videos.html'],
	        './webTV.html': ['./templates/webTV.html'],
	        './webtv_trailer_competition.html': ['./templates/webtv_trailer_competition.html'],
	        './webtv_trailer_uncertainregard.html': ['./templates/webtv_trailer_uncertainregard.html'],
	        './audios.html': ['./templates/audios.html'],
	        './contact.html': ['./templates/contact.html'],
	        './legals.html': ['./templates/legals.html'],
	        './sitemap.html': ['./templates/sitemap.html'],
	        './events.html': ['./templates/events.html'],
	        './channel.html': ['./templates/channel.html'],
	        './palmares_camerador.html': ['./templates/palmares_camerador.html'],
	        './press.html': ['./templates/press.html'],
	        './searchpage.html': ['./templates/searchpage.html']
	      
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
	        './movie.html': ['./templates/movie.html'],
	        './participate_access.html': ['./templates/participate_access.html'],
	        './photos.html': ['./templates/photos.html'],
	        './selectionofficielle_competition.html': ['./templates/selectionofficielle_competition.html'],
	        './selectionofficielle_uncertainregard.html': ['./templates/selectionofficielle_uncertainregard.html'],
	        './videos.html': ['./templates/videos.html'],
	        './webTV.html': ['./templates/webTV.html'],
	        './webtv_trailer_competition.html': ['./templates/webtv_trailer_competition.html'],
	        './webtv_trailer_uncertainregard.html': ['./templates/webtv_trailer_uncertainregard.html'],
	        './audios.html': ['./templates/audios.html'],
	        './contact.html': ['./templates/contact.html'],
	        './legals.html': ['./templates/legals.html'],
	        './sitemap.html': ['./templates/sitemap.html'],
	        './events.html': ['./templates/events.html'],
	        './channel.html': ['./templates/channel.html'],
	        './palmares_camerador.html': ['./templates/palmares_camerador.html'],
	        './press.html': ['./templates/press.html'],
	        './searchpage.html': ['./templates/searchpage.html']

	      }

	    }
	  },
	  uglify: {
	    dist: {
	      files: {
	        './js-concat/home.min.js': ['./js-concat/home.js'],
	        './js-concat/articles.min.js': ['./js-concat/articles.js'],
	        './js-concat/trailer.min.js': ['./js-concat/trailer.js'],
	        './js-concat/channels.min.js': ['./js-concat/channels.js'],
	        './js-concat/faq.min.js': ['./js-concat/faq.js'],
	        './js-concat/jury.min.js': ['./js-concat/jury.js'],
	        './js-concat/movie.min.js': ['./js-concat/movie.js'],
	        './js-concat/participate.min.js': ['./js-concat/participate.js'],
	        './js-concat/photos.min.js': ['./js-concat/photos.js'],
	        './js-concat/selection.min.js': ['./js-concat/selection.js'],
	        './js-concat/videos.min.js': ['./js-concat/videos.js'],
	        './js-concat/webTV.min.js': ['./js-concat/webTV.js'],
	        './js-concat/webtvTrailer.min.js': ['./js-concat/webtvTrailer.js'],
	        './js-concat/audios.min.js': ['./js-concat/audios.js'],
	        './js-concat/contact.min.js': ['./js-concat/contact.js'],
	        './js-concat/legals.min.js': ['./js-concat/legals.js'],
	        './js-concat/sitemap.min.js': ['./js-concat/sitemap.js'],
	        './js-concat/events.min.js': ['./js-concat/events.js'],
	        './js-concat/channel.min.js': ['./js-concat/channel.js'],
	        './js-concat/palmares.min.js': ['./js-concat/palmares.js'],
	        './js-concat/press.min.js': ['./js-concat/press.js'],
	        './js-concat/searchpage.min.js': ['./js-concat/searchpage.js']
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
	        './css-concat/trailer.min.css': ['./css-concat/trailer.css'],
	        './css-concat/channels.min.css': ['./css-concat/channels.css'],
	        './css-concat/faq.min.css': ['./css-concat/faq.css'],
	        './css-concat/jury.min.css': ['./css-concat/jury.css'],
	        './css-concat/movie.min.css': ['./css-concat/movie.css'],
	        './css-concat/participate.min.css': ['./css-concat/participate.css'],
	        './css-concat/photos.min.css': ['./css-concat/photos.css'],
	        './css-concat/selection.min.css': ['./css-concat/selection.css'],
	        './css-concat/videos.min.css': ['./css-concat/videos.css'],
	        './css-concat/webTV.min.css': ['./css-concat/webTV.css'],
	        './css-concat/webtvTrailer.min.css': ['./css-concat/webtvTrailer.css'],
	        './css-concat/audios.min.css': ['./css-concat/audios.css'],
	        './css-concat/contact.min.css': ['./css-concat/contact.css'],
	        './css-concat/legals.min.css': ['./css-concat/legals.css'],
	        './css-concat/sitemap.min.css': ['./css-concat/sitemap.css'],
	        './css-concat/events.min.css': ['./css-concat/events.css'],
	        './css-concat/channel.min.css': ['./css-concat/channel.css'],
	        './css-concat/palmares.min.css': ['./css-concat/palmares.css'],
	        './css-concat/press.min.css': ['./css-concat/press.css'],
	        './css-concat/searchpage.min.css': ['./css-concat/searchpage.css']
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