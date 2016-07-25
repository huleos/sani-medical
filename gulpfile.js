'use strict';

const gulp            = require('gulp'),
			sequence        = require('run-sequence'),
			panini          = require('panini'),
			imagemin        = require('gulp-imagemin'),
			uglify          = require('gulp-uglify'),
			concat          = require('gulp-concat'),
			sass            = require('gulp-sass'),
			prefix          = require('gulp-autoprefixer'),
			sourcemaps      = require('gulp-sourcemaps'),
			plumber         = require('gulp-plumber'),
			gutil           = require('gulp-util'),
			del             = require('del'),
			browserSync     = require('browser-sync').create();


// Check for --production flag
const PRODUCTION = gutil.env.production;

// Javascript Paths
const jsFiles = [
	'src/assets/js/main.js'
];

// Copy page templates into finished HTML files
gulp.task('pages', () => {
  return gulp.src('src/views/pages/**/*.{html,hbs,handlebars}')
    .pipe(plumber())
    .pipe(panini({
      root: 'src/views/pages',
      layouts: 'src/views/layouts',
      partials: 'src/views/partials',
      data: 'src/views/data',
      helpers: 'src/views/helpers'
    }))
    .pipe(gulp.dest('dist'));
}
);

// Load updated HTML templates and partials into Panini
gulp.task('resetPages', (done) => {
  panini.refresh();
  done();
});

// Compile Scss
gulp.task('styles', () => {
	return gulp.src('src/assets/scss/huleos.scss')
		.pipe(plumber())
		.pipe(sourcemaps.init())
		.pipe(sass().on('error', sass.logError))
		.pipe(prefix({
			browsers: [
				'last 4 versions',
				'ie >= 9'
			],
			cascade: false
		}))
		.pipe(PRODUCTION ? sass({outputStyle: 'compressed'}) : gutil.noop())
		.pipe(!PRODUCTION ? sourcemaps.write('.') : gutil.noop())
		.pipe(gulp.dest('dist/assets/css'));
});

// Combine JavaScript into one file
gulp.task('scripts', () => {
		return gulp.src(jsFiles)
		.pipe(plumber())
		.pipe(sourcemaps.init())
	  .pipe(concat('main.js'))
	  .pipe(PRODUCTION ? uglify()
	  	.on('error', e => { console.log(e); })
	  	: gutil.noop())
		.pipe(!PRODUCTION ? sourcemaps.write('.') : gutil.noop())
	  .pipe(gulp.dest('dist/assets/js'));
});

// Copy images to the 'dist' folder
gulp.task('images', () => {
	return gulp.src('src/assets/img/**/*')
		.pipe(plumber())
	  .pipe(PRODUCTION ?
			imagemin({
				optimizationLevel: 5,
				progressive: true,
				interlaced: true
			}) : gutil.noop())
	  .pipe(gulp.dest('dist/assets/img'));
});

// Delete the 'dist' folder
gulp.task('clean', () => {
  return del('dist');
});

// Copy files out of the assets folder
gulp.task('cp-dependencies', function(){
	gulp.src('src/*.*')
	.pipe(gulp.dest('dist'));
});

// Start a server with BrowserSync to preview the site in
gulp.task('server', (done) => {
  browserSync.init({
    server: 'dist',
      reloadDelay: 500
  });
  done();
});

// Build the "dist" folder by running all of the below tasks
gulp.task('build', (done) => {
	sequence('clean', ['pages', 'styles', 'scripts', 'images'], 'cp-dependencies', done);
});

// Build the site, run the server, and watch for file changes
// Watch for changes to static assets, pages, Scss, and JavaScript
gulp.task('default', ['build', 'server'], () => {
	gulp.watch(['src/views/**/*.{html,hbs,handlebars}'], ['pages']).on('change', browserSync.reload);
	gulp.watch(['src/views/{layouts,partials,helpers,data}/**/*'], ['resetPages']).on('change', browserSync.reload);
	gulp.watch(['src/assets/scss/**/*.scss'], ['styles']).on('change', browserSync.reload);
	gulp.watch(['src/assets/js/**/*.js'], ['scripts']).on('change', browserSync.reload);
	gulp.watch(['scr/assets/img/**/*'], ['images']).on('change', browserSync.reload);
});