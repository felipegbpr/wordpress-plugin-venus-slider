var gulp = require('gulp');
var minify = require('gulp-minify');

gulp.task('min-js', function() {
    return gulp.src('/assets/js/admin/*.js')
        .pipe(minify({
            ext: { min: '.min.js' },
            ignoreFiles: ['-min.js']
        }))
        .pipe(gulp.dest('./assets/js'));
});