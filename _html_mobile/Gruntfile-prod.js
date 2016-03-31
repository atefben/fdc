module.exports = function(grunt) {

  require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
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
            openTag: '<!-- fdc-app tags start -->',
            closeTag: '<!-- fdc-app tags end -->'
        },
        src: [
          './js/*.js',
          './js/include/footer.js',
          './js/include/menu.js',
          './js/include/myselection.js',
        ],
        dest: './scripts.inc.php'
      },
      vendor: {
        options: {
            scriptTemplate: '<script src="{{ path }}"></script>',
            openTag: '<!-- fdc-vendor tags start -->',
            closeTag: '<!-- fdc-vendor tags end -->'
        },
        src: [
          './js/vendors/*.js',
        ],
        dest: './scripts.inc.php'
      },
      css: {
        options: {
            scriptTemplate: '<script src="{{ path }}"></script>',
            openTag: '<!-- fdc-app tags start -->',
            closeTag: '<!-- fdc-app tags end -->'
        },
        src: [
          './css/*.css',
          './css/include/*.css',
        ],
        dest: './head.inc.php'
      },
      base: {
        options: {
            scriptTemplate: '<script src="{{ path }}"></script>',
            openTag: '<!-- fdc-vendor tags start -->',
            closeTag: '<!-- fdc-vendor tags end -->'
        },
        src: [
          './css/vendors/*.css',
        ],
        dest: './head.inc.php'
      }
    },
    useminPrepare: {
      scripts: './scripts.inc.php',
      styles: './head.inc.php',
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
        styles: './head.dist.php'
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
          '**/\n'].join('')
      }
    },
    clean: {
      tmp: {
        src: ['./.tmp']
      }
    },
    copy: {
      app: {
        files: [
          {
            expand:true,
            cwd: './js/',
            src: ['*.js', 'include/footer.js', 'include/menu.js', 'include/myselection.js'],
            dest: '../src/FDC/EventMobileBundle/Resources/public/js/dev/'
          },
          {
            src: "./dist/js/vendor.min.js",
            dest: "../src/FDC/EventMobileBundle/Resources/public/js/vendor.min.js"
          }
        ]
      },
      js: {
        files: [
           {
              src: "./dist/js/vendor.min.js",
              dest: "../src/FDC/EventMobileBundle/Resources/public/js/vendor.min.js"
           },
           {
              src: "./dist/js/app.min.js",
              dest: "../src/FDC/EventMobileBundle/Resources/public/js/app.min.js"
           }
        ]
      },
      css: {
        files: [
          {
            src: "./dist/vendor.min.css",
            dest: "../src/FDC/EventMobileBundle/Resources/public/styles/vendor.min.css"
          },
          {
            src: "./dist/app.min.css",
            dest: "../src/FDC/EventMobileBundle/Resources/public/styles/app.min.css"
          }
        ]
      },
      fonts: {
        files: [
          {
            expand: true,
            cwd: './fonts/',
            src: ["icons.*"],
            dest: "../src/FDC/EventMobileBundle/Resources/public/fonts/",
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
  grunt.registerTask('tags:all', [
    'tags:app',
    'tags:vendor',
    'tags:css',
    'tags:base'
  ]);

  grunt.registerTask('build:js', [
    'tags:app',
    'tags:vendor',
    'useminPrepare',
    'concat:generated',
    'uglify:generated',
    'usemin:js',
    'clean:tmp'
    // 'copy:js'
  ]);

  grunt.registerTask('build:css', [
    'tags:css',
    'tags:base',
    'useminPrepare',
    'concat:generated',
    'cssmin:generated',
    'usemin:css',
    'clean:tmp',
    'copy:css'
  ]);

  grunt.registerTask('copyapp', [
    'copy:app'
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
}
