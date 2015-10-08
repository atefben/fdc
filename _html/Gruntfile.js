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
    compass :
    {
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
    }
  });
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  
  grunt.registerTask('compile', ['compass:dev']);
}