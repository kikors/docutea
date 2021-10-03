/* jshint node: true */
'use strict';
var gulp = require('gulp'),
    concat = require('gulp-concat'),
    jade = require('gulp-jade'),
    sourcemaps = require('gulp-sourcemaps'),
    sass = require('gulp-sass'),
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS = require('gulp-clean-css'),
    uglify = require('gulp-uglify'),
    gutil = require('gulp-util'),
    include = require("gulp-include"),
    browserSync = require('browser-sync'),
    reload      = browserSync.reload;



//SASS COMPILATION
gulp.task('sass', function () {
    return gulp
        .src('scss/main.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(sourcemaps.init())
        .pipe(autoprefixer( autoprefixer({ browsers: ['> 1%', 'ie 8', 'ie 9'] })) )
        .pipe(sourcemaps.write())
        .pipe(concat('styles.css'))
        .pipe(gulp.dest('css/'))
        .pipe(reload({stream: true}));
});

//JS COMPILATION AND CONCATENATION
gulp.task('js', function () {
    return gulp.src("js/src/main.js")
        .pipe(include({
            extensions: "js",
            hardFail: true,
            includePaths: [
                __dirname + "/js/src",
            ]
        }))
        .on('error', console.log)
        .pipe(concat('scripts.js'))
        .pipe(gulp.dest("js/build"));
});

//CSS MINIFICATION
gulp.task('css-min', ['sass'], function () {
    return gulp
        .src('css/styles.css')
        .pipe(concat('styles.min.css'))
        .pipe(cleanCSS({keepSpecialComments : 0}))
        .pipe(gulp.dest('css'));
});

//JS MINIFICATION
gulp.task('js-min', ['js'], function () {
    return gulp
        .src('js/build/scripts.js')
        .pipe(concat('scripts.min.js'))
        .pipe(uglify().on('error', function(err){
            //prevent gulp from crashing when there are errors in the js
            gutil.log('An error occurred: ' + err);
            this.emit('end');
        }))
        .pipe(gulp.dest('js/build'));
});



/*******************************************************
 *
 *      LOCAL SERVER
 *
 *******************************************************/

//STATIC LOCAL SERVER + WATCHING SCSS/HTML FILES
gulp.task('default', ['css-min', 'js-min'], function() {
    browserSync.init({
        proxy: "http://imprimia.local/",
    });
    gulp.watch('../app/Resources/**/*.html.twig', reload);
    gulp.watch("scss/**/*.scss", ['scss:watch']);
    gulp.watch('js/src/**/*.js', ['js:watch']);
});

/*******************************************************
 *
 *      WATCHES
 *
 *******************************************************/
gulp.task('scss:watch', ['css-min']);
gulp.task('js:watch', ['js-min'], reload);
gulp.task('img:watch', ['images']);

