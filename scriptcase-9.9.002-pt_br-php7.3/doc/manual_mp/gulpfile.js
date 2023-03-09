var gulp 		= require('gulp');
var browserSync = require('browser-sync').create();
var sass 		= require('gulp-sass');

// Static Server + watching scss/html files
gulp.task('serve', ['sass'], function() {

	browserSync.init({
		proxy: "localhost:4000"
	});

	gulp.watch("./assets/sass/**/*.scss", ['sass']);
	gulp.watch("./*.html").on('change', browserSync.reload);
	gulp.watch("./assets/sass/main.scss").on('change', browserSync.reload);
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
	return gulp.src("./assets/sass/main.scss")
		.pipe(sass().on('error', sass.logError))
		.pipe(gulp.dest("./assets/css"))
		.pipe(browserSync.stream())
});

gulp.task('default', ['serve']);