'use strict';

var gulp  = require('gulp'),
    phpcs = require('gulp-phpcs');

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
