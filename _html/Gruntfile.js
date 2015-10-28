module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'css/styles.css' : 'sass/styles.scss'
        }
      }
    },
    // COMPASS
    compass : {
      dev : {
        options : {
          config    : 'config.rb',
          imagesDir : 'img',
          fontDir   : 'fonts',
          cssDir    : 'css',
          sassDir   : 'sass'
        }
      }
    },
    watch: {
      css: {
        files: '**/*.scss',
        tasks: ['compile']
      }
    },
    concat: {
        generated: {
            options: {
                separator: ";"
            }
        }
    },
    tags: {
      app: {
          options: {
              scriptTemplate: '<script src="{{ path }}"></script>',
              openTag: '<!-- festival-cannes tags start -->',
              closeTag: '<!-- festival-cannes tags end -->'
          },
          src: [
            'js/components/snap.svg.easing.js',
            'js/bower_components/jquery/dist/jquery.min.js',
            'js/bower_components/owl.carousel/src/js/owl.carousel.js',
            'js/bower_components/chocolat/src/js/jquery.chocolat.js',
            'js/bower_components/Snap.svg/dist/snap.svg-min.js',
            'js/bower_components/jquery-cookie/jquery.cookie.js',
            'js/bower_components/wavesurfer.js/dist/wavesurfer.min.js',
            'js/bower_components/isotope/dist/isotope.pkgd.min.js',
            'js/bower_components/isotope-packery/packery-mode.pkgd.js',
            'js/bower_components/imagesloaded-packaged/imagesloaded.pkgd.min.js',
            'js/bower_components/infinite-scroll/jquery.infinitescroll.min.js',
            'js/bower_components/canvasloader/js/heartcode-canvasloader-min.js',
            'js/components/fullscrenjs.js',
            'js/components/jwplayer.js',
            'js/festival-cannes/helpers.js',
            'js/festival-cannes/*.module.js',
            'js/festival-cannes/*.js',

            // Exclusions
            '!js/**/app-mobile.module.js'
          ],
          dest: './scripts.inc.php'
      }
    },

    useminPrepare: {
      scripts: 'inc/scripts.inc.php',
      options: {
          root: './',
          dest: './'
      }
    },

    usemin: {
      js: {
        scripts: 'inc/scripts.dist.inc.php'
      },
    }
  });

  
  grunt.loadNpmTasks('grunt-script-link-tags');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-usemin');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  
  grunt.registerTask('compile', ['compass:dev']);

  /**
   * Build JavaScript only
   **/
  grunt.registerTask('build:js', [
      'tags:app',
      'useminPrepare',
      'concat:generated',
      'usemin:js',
  ]);
}