'use strict';

var gulp    = require('gulp'),
    phpcs   = require('gulp-phpcs'),
    phpcbf  = require('gulp-phpcbf'),
    gutil   = require('gutil'),
    phplint = require('phplint').lint;

//////////////////////////////
// Begin Gulp Tasks
//////////////////////////////

gulp.task('phpcs', function () {
  return gulp.src(['web/**/*.php'])
    .pipe(phpcs({
      bin: 'vendor/bin/phpcs',
      standard: 'PSR2',
      warningSeverity: 0
    }))
    // Log all problems that was found 
    .pipe(phpcs.reporter('log'));
});
 
gulp.task('phpcbf', function () {
  return gulp.src(['web/**/*.php'])
  .pipe(phpcbf({
    bin: 'vendor/bin/phpcbf',
    standard: 'PSR2',
    warningSeverity: 0
  }))
  .on('error', gutil.log)
  .pipe(gulp.dest('web'));
});

gulp.task('phplint', function (cb) {
  phplint(['web/**/*.php'], {limit: 10}, function (err, stdout, stderr) {
    if (err) {
      cb(err)
      process.exit(1)
    }
    cb()
  })
});
