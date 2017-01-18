var gulp          = require('gulp'),
    gutil         = require('gulp-util'),
    uglify        = require('gulp-uglify'),
    jshint        = require('gulp-jshint'),
    concat        = require('gulp-concat'),
    notify        = require('gulp-notify'),
    config        = require('../config').scripts,
    browserify = require('gulp-browserify'),
    options       = require('minimist')(process.argv.slice(2));

// gulp.task('browserify', function() {
// 	// Single entry point to browserify
// 	gulp.src(config.src)
// 		.pipe(browserify({
// 		  insertGlobals : true,
// 		  debug : !gulp.env.production
// 		}))
// 		.pipe(gulp.dest(config.dest))
// });

gulp.task('jshint', function(){
  return gulp.src(config.destSrc)
    .pipe(jshint('.jshintrc'))
});

gulp.task('scripts:vendors', function(){
  return gulp.src(config.vendorSrc)
    .pipe(concat('vendors.js'))
    .pipe(options.production ? uglify() : gutil.noop())
    .pipe(gulp.dest(config.dest));
});

gulp.task('scripts:app', function(){
  return gulp.src(config.src)
    .pipe(concat('app.js'))
    .pipe(options.production ? uglify() : gutil.noop())
    .pipe(gulp.dest(config.dest))
});
