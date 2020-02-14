const gulp            = require('gulp'),
      panini          = require('panini'),
      imagemin        = require('gulp-imagemin'),
      uglify          = require('gulp-uglify'),
      concat          = require('gulp-concat'),
      sass            = require('gulp-sass'),
      prefix          = require('gulp-autoprefixer'),
      sourcemaps      = require('gulp-sourcemaps'),
      plumber         = require('gulp-plumber'),
      gutil           = require('gulp-util'),
      gulpSitemap         = require('gulp-sitemap'),
      del             = require('del'),
      browserSync     = require('browser-sync').create();


// Check for --production flag
const PRODUCTION = gutil.env.production;

// Javascript Paths
const jsFiles = [
  'node_modules/jquery/dist/jquery.js',
  'node_modules/jquery-ui/ui/widgets/datepicker.js',
  'node_modules/jquery-validation/dist/jquery.validate.js',
  'src/assets/js/main.js'
];

// Copy page templates into finished HTML files
function pages() {
  return gulp.src('src/views/pages/**/*.{html,hbs,handlebars}')
    .pipe(plumber())
    .pipe(panini({
      root: 'src/views/pages',
      layouts: 'src/views/layouts',
      partials: 'src/views/partials',
      data: 'src/views/data',
      helpers: 'src/views/helpers'
    }))
    .pipe(gulp.dest('dist'))
}

// Load updated HTML templates and partials into Panini
function resetPages(done) {
  return panini.refresh()
  done()
}

// Compile Scss
function styles() {
  return gulp.src('src/assets/scss/style.scss')
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(sass().on('error', sass.logError))
    .pipe(prefix({
      cascade: false
    }))
    .pipe(PRODUCTION ? sass({ outputStyle: 'compressed' }) : gutil.noop())
    .pipe(!PRODUCTION ? sourcemaps.write('.') : gutil.noop())
    .pipe(gulp.dest('dist/assets/css'))
}

// Combine JavaScript into one file
function scripts() {
    return gulp.src(jsFiles)
      .pipe(plumber())
      .pipe(sourcemaps.init())
      .pipe(concat('main.js'))
      .pipe(PRODUCTION ? uglify()
        .on('error', e => { console.log(e); })
        : gutil.noop())
      .pipe(!PRODUCTION ? sourcemaps.write('.') : gutil.noop())
      .pipe(gulp.dest('dist/assets/js'))
}

// Copy images to the 'dist' folder
function images() {
  return gulp.src('src/assets/img/**/*')
    .pipe(plumber())
    .pipe(PRODUCTION ?
      imagemin({
        optimizationLevel: 5,
        progressive: true,
        interlaced: true
      }) : gutil.noop())
    .pipe(gulp.dest('dist/assets/img'));
}

// Delete the 'dist' folder
function clean(done) {
  return del('dist')
  done()
}

// Copy files out of the assets folder
function cpDependencies() {
  return gulp.src(['src/*.*', 'src/.*'])
    .pipe(gulp.dest('dist'));
}

// Generate sitemap
function sitemap() {
  return gulp.src('dist/*.html', {
      read: false
    })
    .pipe(gulpSitemap({
      siteUrl: 'https://sanimedicaltourism.com',
      changefreq: 'monthly'
    }))
    .pipe(gulp.dest('dist'))
}

// Start a server with BrowserSync to preview the site in
function watch() {
  browserSync.init({
    notify: false,
    server: 'dist',
    port: 4567,
    reloadDelay: 500,
    reloadDebounce: 1000
  })
  gulp.watch(['src/views/**/*.{html,hbs,handlebars}']).on('change', gulp.series(pages, browserSync.reload))
  gulp.watch(['src/views/{layouts,partials,helpers,data}/**/*']).on('change', gulp.series(resetPages, browserSync.reload));
  gulp.watch(['src/assets/scss/**/*.scss']).on('change', gulp.series(styles, browserSync.reload));
  gulp.watch(['src/assets/js/**/*.js']).on('change', gulp.series(scripts, browserSync.reload));
  gulp.watch(['scr/assets/img/**/*']).on('change', gulp.series(images, browserSync.reload));
}

exports.pages = pages
exports.styles = styles
exports.scripts = scripts
exports.images = images
exports.clean = clean
exports.cpDependencies = cpDependencies
exports.sitemap = sitemap
exports.watch = gulp.series(clean, pages, styles, scripts, images, gulp.parallel(watch))
exports.default = gulp.series(clean, gulp.parallel(pages, styles, scripts, images))
