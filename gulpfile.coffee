gulp = require 'gulp'
coffee = require 'gulp-coffee'
concat = require 'gulp-concat'
sourcemaps = require 'gulp-sourcemaps'
ngClassify = require 'gulp-ng-classify'
watch = require 'gulp-watch'
browserSync = require('browser-sync')
reload = browserSync.reload
exec = require('child_process').exec;


buildFolder = './backend/web'

gulp.task 'server', ->
  exec 'php backend/app/console server:stop -v', (err, stdout, stderr) ->
    exec 'php backend/app/console server:start -v', (err, stdout, stderr) ->
      console.log(stdout)
      console.log(stderr)
      console.log(err)

gulp.task 'scripts', ->
  gulp.src('./frontend/**/*.coffee')
  .pipe sourcemaps.init()
  .pipe ngClassify(
    appName: 'pw'
    controller:
      format: 'upperCamelCase'
      suffix: 'Controller'
    service:
      format: 'upperCamelCase'
      suffix: 'Service'
  )
  .pipe coffee()
  .pipe concat('app.min.js')
  .pipe sourcemaps.write()
  .pipe gulp.dest(buildFolder+'/js')
  .pipe(reload({stream: true}))


gulp.task 'vendor', ->
  gulp.src([
    'node_modules/jquery/dist/jquery.js'
    'node_modules/materialize-css/bin/materialize.js'
    'node_modules/angular/angular.js'
    'node_modules/angular-new-router/dist/router.es5.js'
    'node_modules/angular-moment/node_modules/moment/moment.js'
    'node_modules/angular-moment/angular-moment.js'
  ])
  .pipe concat('vendor.min.js')
  .pipe gulp.dest(buildFolder+'/js')

  gulp.src([
    'node_modules/materialize-css/bin/materialize.css'
  ])
  .pipe concat('vendor.min.css')
  .pipe(gulp.dest(buildFolder+'/css'))

  gulp.src([
    'node_modules/materialize-css/font/**/*'
  ])
  .pipe(gulp.dest(buildFolder+'/font'))

gulp.task 'styles', ->
  gulp.src([
    'frontend/src/**/*.css'
  ])
#  .pipe(less())
  .pipe concat('app.css')
  .pipe(gulp.dest(buildFolder+'/css'))
  .pipe(reload({stream: true}))

gulp.task 'html', ->
  gulp.src('./frontend/src/**/*html')
  .pipe(gulp.dest(buildFolder+''))
  .pipe(reload({stream: true}))

gulp.task 'browser-sync', ->
  browserSync(
    proxy: 'localhost:8000'
    port: 3000
    open: true
    notify: false
  )

gulp.task 'watch', ->
  gulp.watch(['./frontend/src/**/*.coffee'], ['scripts'])
  #  gulp.watch(['./frontend/src/less/**/*.less'], ['styles'])
  gulp.watch(['./frontend/src/**/*.html'], ['html'])

gulp.task('default', ['server', 'vendor', 'scripts', 'styles', 'html', 'browser-sync', 'watch'])