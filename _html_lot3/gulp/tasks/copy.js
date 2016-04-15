var gulp      = require('gulp'),
    fonts     = require('../config').fonts;

gulp.task('copy:fonts', function(){
  return gulp.src(fonts.src, {dot: true})
    .pipe(gulp.dest(fonts.dest))
});
