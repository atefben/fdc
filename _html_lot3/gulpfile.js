// Require plugins
var gulp        = require('gulp'),
  requireDir    = require('require-dir'),
  runSequence   = require('run-sequence');

// Load tasks
requireDir('./gulp/tasks');

// Default task
gulp.task('default', function(){
  runSequence('iconfont', 'copy:fonts', 'server');
});


gulp.task('dump', function(){
  runSequence('copy:sfcss', 'copy:sfjs');
});
