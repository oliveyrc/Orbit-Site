// https://gist.github.com/jeromecoupe/0b807b0c1050647eb340360902c3203a
"use strict";

// Load plugins
const autoprefixer = require("autoprefixer");
const cssnano = require("cssnano");
const eslint = require("gulp-eslint");
const gulp = require("gulp");
const gutil = require('gulp-util');
const plumber = require("gulp-plumber");
const postcss = require("gulp-postcss");
const sass = require("gulp-sass")(require('sass'));
const bulkSass = require("gulp-sass-glob-import");
const sourcemaps = require('gulp-sourcemaps');
const browserSync = require('browser-sync').create();
const uglify = require('gulp-uglify');
const svgmin = require('gulp-svgmin');

// CSS task
function css() {
  return gulp
    .src(['./scss/**/*.scss', '!./scss/paragraphs/*.scss', '!./scss/nodes/*.scss','!./scss/blocks/*.scss','!./scss/elements/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(bulkSass())
    .pipe(sass({
      outputStyle: "compressed",
      lineNumbers: false,
      loadPath: './css/*'
    }))
    .on('error', function (error) {
      gutil.log(error);
      this.emit('end');
    })
    .pipe(gulp.dest("./css/"))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest("./css/"))
    .pipe(browserSync.stream())
    ;
}

function css_paragraphs() {
  return gulp
    .src(['./scss/paragraphs/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass({
      outputStyle: "compressed",
      lineNumbers: false,
      loadPath: './css/*',
      sourceMap: true,
      sourceComments: 'map'
    }))
    .on('error', function (error) {
      gutil.log(error);
      this.emit('end');
    })
    .pipe(gulp.dest("./css/paragraphs"))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest("./css/paragraphs"))
    .pipe(browserSync.stream())
    ;
}


function css_elements() {
  return gulp
    .src(['./scss/elements/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass({
      outputStyle: "compressed",
      lineNumbers: false,
      loadPath: './css/*',
      sourceMap: true,
      sourceComments: 'map'
    }))
    .on('error', function (error) {
      gutil.log(error);
      this.emit('end');
    })
    .pipe(gulp.dest("./css/elements"))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest("./css/elements"))
    .pipe(browserSync.stream())
    ;
}


function css_nodes() {
  return gulp
    .src(['./scss/nodes/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass({
      outputStyle: "compressed",
      lineNumbers: false,
      loadPath: './css/*',
      sourceMap: true,
      sourceComments: 'map'
    }))
    .on('error', function (error) {
      gutil.log(error);
      this.emit('end');
    })
    .pipe(gulp.dest("./css/nodes"))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest("./css/nodes"))
    .pipe(browserSync.stream())
    ;
}

function css_blocks() {
  return gulp
    .src(['./scss/blocks/*.scss'])
    .pipe(sourcemaps.init())
    .pipe(plumber())
    .pipe(bulkSass())
    .pipe(sass({
      outputStyle: "compressed",
      lineNumbers: false,
      loadPath: './css/*',
      sourceMap: true,
      sourceComments: 'map'
    }))
    .on('error', function (error) {
      gutil.log(error);
      this.emit('end');
    })
    .pipe(gulp.dest("./css/blocks"))
    .pipe(postcss([autoprefixer(), cssnano()]))
    .pipe(sourcemaps.write('./maps'))
    .pipe(gulp.dest("./css/blocks"))
    .pipe(browserSync.stream())
    ;
}

const svg_clean = () =>
  gulp.src('./svg/src/*.svg')
    .pipe(svgmin({
      multipass: true,
      // The plugins list is the full list of plugins
      // to use. The default list is ignored.
      full: true,
      plugins: [
        'removeDoctype',
        'removeComments',
        'sortAttrs',
        'preset-default',
      ],
    }))
    .pipe(gulp.dest('./svg'));


// Lint scripts
function scriptsLint() {
  return gulp
    .src(["./js/src/*", "./gulpfile.js"])
    .pipe(plumber())
    .pipe(eslint())
    .pipe(eslint.format())
    .pipe(eslint.failAfterError());
}


// Transpile, concatenate and minify scripts
function scripts() {
  return (
    gulp
      .src(["./js/src/*"])
      .pipe(plumber())
      .pipe(uglify())
      .pipe(gulp.dest("./js/"))
  );
}


// Watch files
function watchFiles() {

  // Setup a browsersync server.
  browserSync.init({
    proxy: 'http://appserver',
    socket: {
      domain: 'https://bs.<project name>.lndo.site',
      port: 80
    },
    open: false,
    logLevel: "debug",
    logConnections: true,
  });
  gulp.watch(['./scss/**/*.scss'], gulp.parallel(css, css_paragraphs, css_nodes, css_blocks, css_elements));
  gulp.watch("./js/src/*", gulp.series(scripts));
}


const js = gulp.series(scripts);
const watch = gulp.parallel(watchFiles);


// export tasks
exports.css = css;
exports.js = js;
exports.watch = watch;
exports.default = watch;
exports.svg_clean = svg_clean;
