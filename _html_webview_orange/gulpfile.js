var gulp = require('gulp');
var sass = require('gulp-sass');
var config = {
	css: {
		src: 'css/webview.css',
		dest: '../src/FDC/EventBundle/Resources/public/webview_orange/css/',
	},
	js: {
		src: 'js/*',
		dest: '../src/FDC/EventBundle/Resources/public/webview_orange/js/'
	},
	img: {
        src: 'img/*/*',
        dest: '../src/FDC/EventBundle/Resources/public/webview_orange/img/'
    }
};

gulp.task('sass', function () {
  return gulp.src('./scss/**/*.scss')
    .pipe(sass().on('error', sass.logError))
    .pipe(gulp.dest('./css'));
});
 
gulp.task('watch', function () {
  gulp.watch('./scss/**/*.scss', ['sass','copy:css']);
  gulp.watch('./js/*.js', ['copy:js']);
});

gulp.task('copy:css', function () {
    return gulp.src(config.css.src, {dot: true})
        .pipe(gulp.dest(config.css.dest))
});

gulp.task('copy:js', function () {
    return gulp.src(config.js.src, {dot: true})
        .pipe(gulp.dest(config.js.dest))
});

gulp.task('copy:img', function () {
    return gulp.src(config.img.src, {dot: true})
        .pipe(gulp.dest(config.img.dest))
});

gulp.task('default', ['sass','copy:css','copy:js', 'copy:img']);