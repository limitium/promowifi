class Main extends Controller
  constructor: (@$router) ->
    @$router.config [
      path: '/'
      redirectTo : '/offers'
    ,
      path: '/offers'
      components:
        main:'offersList'
    ,
      path: '/offer/new'
      components:
        main: 'offerNew'
    ]


class App extends App
  constructor: ->
    return ['ngNewRouter','angularMoment']


