module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    sass: {
      dist: {
        files: {
          'css/styles.css' : 'sass/styles.scss'
        }
      }
    },
    webfont: {
     icons: {
       src: 'img/svg/*.svg',
       dest: 'fonts',
       destCss: 'sass/base',
       options: {
         stylesheet: 'scss',
         relativeFontPath: '../fonts'
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
      },
      icons: {
        files: 'img/svg/*.svg',
        tasks: ['webfont']
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
            // 'js/bower_components/jquery/dist/jquery.min.js',
            // 'js/bower_components/owl.carousel/src/js/owl.carousel.js',
            // 'js/bower_components/moment/min/moment.min.js',
            // 'js/bower_components/fullcalendar/dist/fullcalendar.min.js',
            // 'js/bower_components/fullcalendar/dist/lang-all.js',
            // 'js/bower_components/chocolat/src/js/jquery.chocolat.js',
            // 'js/bower_components/Snap.svg/dist/snap.svg-min.js',
            // 'js/bower_components/jquery-cookie/jquery.cookie.js',
            // 'js/bower_components/wavesurfer.js/dist/wavesurfer.min.js',
            // 'js/bower_components/isotope/dist/isotope.pkgd.min.js',
            // 'js/bower_components/isotope-packery/packery-mode.pkgd.js',
            // 'js/bower_components/imagesloaded-packaged/imagesloaded.pkgd.min.js',
            // 'js/bower_components/infinite-scroll/jquery.infinitescroll.min.js',
            // 'js/bower_components/canvasloader/js/heartcode-canvasloader-min.js',
            // 'js/components/snap.svg.easing.js',
            // 'js/components/fullscreenjs.js',
            // 'js/components/jwplayer.js',
            // 'js/components/konsole.min.js',
            // 'js/components/jquery-ui.min.js',
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
      scripts: './scripts.inc.php',
      options: {
          root: './',
          dest: './'
      }
    },
    usemin: {
      js: {
        scripts: './scripts.dist.php'
      },
    },
    concat: {
      options: {
      separator: ';\n'
      }
    },
    uglify: {
      options: {
        banner: ['/**\n * Festival de Cannes\n',
          ' * @author: Ohwee\n',
          ' * @credits: Ohwee\n',
          ' * @date: 2015\n',
          '**/\n'].join('')
        // mangle: {
        //   except: ['jQuery', 'angular']
        // }
      }
    },
    clean: {
      tmp: {
        src: ['./.tmp']
      }
    },
    copy: {
      js: {
        files: [
           {
              src: "./js/vendor.min.js",
              dest: "../src/FDC/EventBundle/Resources/public/js/vendor.min.js"
           },
           {
              src: "./js/app.min.js",
              dest: "../src/FDC/EventBundle/Resources/public/js/app.min.js"
           }
        ]
      }
    }
  });



  grunt.registerTask('compile', ['compass:dev']);

  /**
   * Build JavaScript only
   **/
  grunt.registerTask('build:js', [
      'tags:app',
      'useminPrepare',
      'concat:generated',
      'uglify:generated',
      'usemin:js',
      'clean:tmp',
      'copy:js'
  ]);

  grunt.registerTask('copyjs', [
    'copy:js'
  ]);

  grunt.loadNpmTasks('grunt-webfont');
}