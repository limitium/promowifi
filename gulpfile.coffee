gulp = require 'gulp'
coffee = require 'gulp-coffee'
concat = require 'gulp-concat'
sourcemaps = require 'gulp-sourcemaps'
ngClassify = require 'gulp-ng-classify'
watch = require 'gulp-watch'
browserSync = require('browser-sync')
reload = browserSync.reload


gulp.task 'scripts', ->
  gulp.src('./frontend/**/*.coffee')
  .pipe sourcemaps.init()
  .pipe ngClassify(
    appName: 'pw'
    controller:
      format: 'upperCamelCase'
      suffix: 'Controller'
  )
  .pipe coffee()
  .pipe concat('app.min.js')
  .pipe sourcemaps.write()
  .pipe gulp.dest('./frontend/build/js')
  .pipe(reload({stream: true}))


gulp.task 'vendor', ->
  gulp.src([
    'node_modules/jquery/dist/jquery.js'
    'node_modules/materialize-css/bin/materialize.js'
    'node_modules/angular/angular.js'
    'node_modules/angular-new-router/dist/router.es5.js'
  ])
  .pipe concat('vendor.min.js')
  .pipe gulp.dest('./frontend/build/js')

  gulp.src([
    'node_modules/materialize-css/bin/materialize.css'
  ])
  .pipe concat('vendor.min.css')
  .pipe(gulp.dest('./frontend/build/css'))

  gulp.src([
    'node_modules/materialize-css/font/**/*'
  ])
  .pipe(gulp.dest('./frontend/build/font'))

gulp.task 'styles', ->
  gulp.src([
    'frontend/src/**/*.css'
  ])
#  .pipe(less())
  .pipe concat('app.css')
  .pipe(gulp.dest('./frontend/build/css'))
  .pipe(reload({stream: true}))

gulp.task 'html', ->
  gulp.src('./frontend/src/**/*html')
  .pipe(gulp.dest('./frontend/build'))
  .pipe(reload({stream: true}))

gulp.task 'browser-sync', ->
  browserSync(
    proxy: 'localhost:8020'
    port: 3000
    open: true
    notify: false
  )

gulp.task 'watch', ->
  gulp.watch(['./frontend/src/**/*.coffee'], ['scripts'])
  #  gulp.watch(['./frontend/src/less/**/*.less'], ['styles'])
  gulp.watch(['./frontend/src/**/*.html'], ['html'])

gulp.task('default', ['vendor', 'scripts', 'styles', 'html', 'browser-sync', 'watch'])