var gulp = require('gulp'),
minifyCSS = require('gulp-minify-css'),
changed  = require('gulp-changed'),
autoprefixer = require('gulp-autoprefixer'),
uglify = require('gulp-uglify'),
fileinclude = require('gulp-file-include'),
prettify = require('gulp-prettify'),
removeEmptyLines = require('gulp-remove-empty-lines'),
concat = require('gulp-concat'),
sass = require('gulp-ruby-sass'),
sourcemaps = require('gulp-sourcemaps'),
filter = require('gulp-filter'),
del = require('del'),
watch = require('gulp-watch');

// Compila o Sass
gulp.task('sass', function () {
   return sass('./assets/sass/styles.scss', {
    sourcemap: true
})
   .on('error', function (err) {
    console.error('Error!', err.message);
})
   .pipe(autoprefixer({browsers: ['last 3 versions']}))
   .pipe(minifyCSS())
   .pipe(sourcemaps.write())
   .pipe(gulp.dest('./assets/stylesheets'))
   .pipe(filter('*.css'))
});

//Minifica o JS
gulp.task('js', function(){
    gulp.src(['./assets/javascripts/pages/*.js','./assets/javascripts/pages/base.js'])
    .pipe(changed('./assets/js'))
    .pipe(uglify())
    .pipe(gulp.dest('./assets/js'));

    gulp.src(['./assets/javascripts/*.js','./assets/javascripts/pages/base.js'])
    .pipe(concat('libs.js')) 
    .pipe(uglify())
    // .pipe(changed('./assets/js'))
    .pipe(gulp.dest('./assets/js'));

    
});
gulp.task('default', ['sass', 'js'], function() {
    watch('./assets/javascripts/pages/*.js', function() {
        console.log('========== Concatenando e minificando JS ==========');
        gulp.start('js');

    });
    watch('./assets/javascripts/*.js', function() {
        console.log('========== Concatenando e minificando JS ==========');
        gulp.start('js');

    });
    watch('./assets/sass/**/*', function() {
        console.log('================ Compilando Sass ================');
        gulp.start('sass');
    });
});
