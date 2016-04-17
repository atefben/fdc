var appSrc  = 'app/',
    appDest = 'build';

module.exports = {
  appSrc: appSrc,
  appDest: appDest,

  styles: {
    watchSrc: appSrc + 'assets/sass/**/*.scss',
    src: appSrc + 'assets/sass/**/*.scss',
    srcFolder :'app/assets/sass',
    dest: appDest + '/css/',
    ruby: './config.rb',
    autoprefixerOpts: {
      browsers: ['last 2 versions', 'ie >= 10']
    }
  },

  scripts: {
    src: [appSrc + 'assets/js/files/*.js', appSrc + 'assets/js/app.js'],
    vendorSrc: [appSrc + 'assets/js/vendors/jquery-2.1.4.min.js', appSrc + 'assets/js/vendors/*.js'],
    dest: appDest + '/js/'
  },

  views: {
    watchSrc: [appSrc + 'templates/**/*.html', appSrc + 'include/*.html'],
    src: appSrc + 'templates/*.html',
    dest: appDest,
    opts: {
      process: true
    }
  },

  iconfont: {
    src: appSrc + 'assets/icons/*.svg',
    dest: appSrc + 'assets/fonts/',
    fontSrc: appSrc + 'assets/fonts/icons.*',
    fontDest: appDest + '/fonts/',
    opts: {
      fontName: 'icon',
      targetPath: '../sass/base/_icons.scss',
      fontPath: '../fonts/'
    }
  },

  images: {
    src: appSrc + '/assets/img/media/*.{jpg,png,gif,svg}',
    dest: appDest + '/media/images/',
    opts: {
      progressive: true,
      svgoPlugins: [{removeViewBox: false}]
    }
  },

  fonts: {
    src: appSrc + '/assets/fonts/*',
    dest: appDest + '/fonts/'
  },

  clean: {
    src: [
      appDest
    ]
  },

  browserSync: {
    server: {
      baseDir: appDest
    }
  }
};
