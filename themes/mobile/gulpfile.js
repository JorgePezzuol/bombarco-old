// including plugins
var gulp = require('gulp')
    , less = require("gulp-less")
    , minifyCss = require("gulp-minify-css")
    , uglify = require("gulp-uglify")
    , imageop = require('gulp-image-optimization')
    , minifyHTML = require('gulp-minify-html');

// task less - compile less
gulp.task('less', function () {
    gulp.src('assets/less/style.less') // path to your file
        .pipe(less())
        .pipe(minifyCss())
        .pipe(gulp.dest('assets/css/'));
});

// task js - minify js
gulp.task('scripts', function () {
    gulp.src('assets/js/main.js') // path to your files
    .pipe(uglify())
    .pipe(gulp.dest('assets/js/gulp'));
});
// task js - minify lib
gulp.task('scriptslib', function () {
    gulp.src('assets/js/lib.js') // path to your files
    .pipe(uglify())
    .pipe(gulp.dest('assets/js/gulp'));
});


//task image - optimization
gulp.task('images', function(cb) {
    gulp.src(['assets/img/*.png']).pipe(imageop({
        optimizationLevel: 5,
        progressive: true,
        interlaced: true
    })).pipe(gulp.dest('assets/img/opt')).on('end', cb).on('error', cb);
});

//task html - minify
gulp.task('minify-html', function() {
  var opts = {
    conditionals: true,
    spare:true
  };
 
  return gulp.src('./views/layouts/dev/*.php')
    .pipe(minifyHTML(opts))
    .pipe(gulp.dest('./views/layouts/'));
});


// task watch
gulp.task('watch', function() {
    gulp.watch('assets/less/layouts/pages/_resultsearch.less', ['less']);
    gulp.watch('assets/js/main.js', ['scripts']);
});

// task default
gulp.task('default', ['less','scripts']);