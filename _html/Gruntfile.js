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
            'js/*.js',

            // Exclusions
            '!js/**/app-mobile.module.js'
          ],
          dest: './scripts.inc.php.tmp'
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