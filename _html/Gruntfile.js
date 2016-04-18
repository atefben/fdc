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
      styles: './head.html',
      options: {
          root: './',
          dest: './'
      }
    },
    usemin: {
      js: {
        scripts: './scripts.dist.php'
      },
      css: {
        styles: './head.dist.html'
      }
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
          '**/\n'].join(''),
        sourceMap: true
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
           },
           {
              src: "./js/app.min.js.map",
              dest: "../src/FDC/EventBundle/Resources/public/js/app.min.js.map"
           }
        ]
      },
      css: {
        files: [
          {
            src: "./dist/vendor.min.css",
            dest: "../src/FDC/EventBundle/Resources/public/styles/vendor.min.css"
          },
          {
            src: "./dist/app.min.css",
            dest: "../src/FDC/EventBundle/Resources/public/styles/app.min.css"
          }
        ]
      },
      fonts: {
        files: [
          {
            expand: true,
            cwd: './fonts/',
            src: ["icons.*"],
            dest: "../src/FDC/EventBundle/Resources/public/fonts/",
            filter: 'isFile'
          },
        ]
      }
    }
  });



  grunt.registerTask('compile', ['compass:dev']);

  /**
   * Build JavaScript only
   **/
  grunt.registerTask('prebuild:js', [
    'tags:app',
  ]);

  grunt.registerTask('build:js', [
    'useminPrepare',
    'concat:generated',
    'uglify:generated',
    'usemin:js',
    'clean:tmp',
    'copy:js'
  ]);

  grunt.registerTask('build:css', [
    'useminPrepare',
    'concat:generated',
    'cssmin:generated',
    'usemin:css',
    'clean:tmp',
    'copy:css'
  ]);

  grunt.registerTask('copyjs', [
    'copy:js'
  ]);

  grunt.registerTask('copycss', [
    'copy:css'
  ]);

  grunt.registerTask('copyfonts', [
    'copy:fonts'
  ]);

  grunt.loadNpmTasks('grunt-webfont');
}
