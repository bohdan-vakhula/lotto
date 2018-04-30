var gulp = require('gulp');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var plumber = require('gulp-plumber');

gulp.task('js:build', function () {
    return gulp.src('../../themes/lotto_theme/js/lotto/*.js')
        .pipe(plumber())
        .pipe(concat('application.build.js'))
        .pipe(uglify())
        .pipe(gulp.dest('../../themes/lotto_theme/js/build'))
});

gulp.task('js:build2', function () {
    return gulp.src(['./modules/cart/index.js','./modules/cart/cartjs/**/*.js'])
        .pipe(plumber())
        .pipe(concat('cart.build.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./modules/cart/build/'))
});

gulp.task('js:lint', function() {
    return gulp.src('../../themes/lotto_theme/js/lotto/lotteryclub.js')
        .pipe(jshint('.jshintrc'))
        .pipe(jshint.reporter('jshint-stylish'));
});

// watch task
gulp.task('js:watch', ['js:build'], function () {
    gulp.watch('../../themes/lotto_theme/js/lotto/*.js', ['js:build']);
    gulp.watch(['./modules/cart/app.js','./modules/cart/cartjs/**/*.js'], ['js:build2']);
    gulp.watch(['../../themes/lotto_theme/js/lotto/lotteryclub.js'], ['js:lint']);
});

gulp.task('js', ['js:watch','js:build', 'js:build2', 'js:lint']);
