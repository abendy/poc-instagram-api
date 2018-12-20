'use strict';

const cleanCSS = require('gulp-clean-css');
const concat = require('gulp-concat');
const del = require('del');
const gulp = require('gulp');
const uglify = require('gulp-uglify');

const sourceFiles = [
    'node_modules/material-design-lite/dist/material.min.css',
    'node_modules/material-design-lite/dist/material.min.js'
];

const destination = 'web/assets/libs/';
const dist = 'web/dist/';

//////////////////////////////
// Begin Gulp Tasks
//////////////////////////////

function clean() {
    return del(destination);
}

function copy() {
    return gulp
        .src(sourceFiles)
        .pipe(gulp.dest(destination));
}

function scripts() {
    return gulp.src(destination + '*.js')
        .pipe(concat('main.js'))
        .pipe(uglify())
        .pipe(gulp.dest(dist));
}

function styles() {
    return gulp.src([destination + '*.css', 'web/assets/style.css'])
        .pipe(concat('main.css'))
        .pipe(cleanCSS())
        .pipe(gulp.dest(dist));
}

const build = gulp.parallel(clean, copy, scripts, styles);

exports.build = build;
exports.default = build;
exports.clean = clean;
