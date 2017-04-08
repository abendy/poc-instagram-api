'use strict';

var gulp   = require('gulp'),
    phpcs  = require('gulp-phpcs'),
    phpcbf = require('gulp-phpcbf'),
    gutil  = require('gutil'),
    phpmd  = require('gulp-phpmd');

//////////////////////////////
// Begin Gulp Tasks
//////////////////////////////

gulp.task('phpcs', function () {
  return gulp.src(['web/**/*.php', '!src/vendor/**/*.*'])
    .pipe(phpcs({
      bin: 'vendor/bin/phpcs',
      standard: 'PSR2',
      warningSeverity: 0
    }))
    // Log all problems that was found 
    .pipe(phpcs.reporter('log'));
});
 
gulp.task('phpcbf', function () {
  return gulp.src(['web/**/*.php', '!src/vendor/**/*.*'])
  .pipe(phpcbf({
    bin: 'vendor/bin/phpcbf',
    standard: 'PSR2',
    warningSeverity: 0
  }))
  .on('error', gutil.log)
  .pipe(gulp.dest('web'));
});

gulp.task('phpmd', function () {
  return gulp.src(['src/**/*.php', '!src/vendor/**/*.*'])
    .pipe(phpmd({
      bin: 'vendor/bin/phpmd',
      format: 'text',
      ruleset: 'unusedcode',
    }))
    .on('error', console.error)
});
