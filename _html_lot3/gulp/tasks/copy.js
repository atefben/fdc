var gulp = require('gulp'),
    fonts = require('../config').fonts,
    sfDirectory = require('../config').sfDirectory;

gulp.task('copy:fonts', function () {
    return gulp.src(fonts.src, {dot: true})
        .pipe(gulp.dest(fonts.dest))
});

gulp.task('copy:sfcss', ['styles'], function () {
    return gulp.src(sfDirectory.srcCss, {dot: true})
        .pipe(gulp.dest(sfDirectory.destCss))
});

gulp.task('copy:sfjs', ['scripts:vendors','scripts:app'] , function () {
    return gulp.src(sfDirectory.srcJs, {dot: true})
        .pipe(gulp.dest(sfDirectory.destJs))
});