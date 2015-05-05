class Main extends Controller
  constructor: (@$scope, @$http) ->

    @$http.get('/list')
      .success((data, status, headers, config) =>
        @promos = data.list;
      )
    @$scope.newPromo = {}
  add: =>
    @$http.post('/add',@$scope.newPromo)
      .success((data, status, headers, config) =>
        @$scope.newPromo.id=data
      )
    @promos.push @$scope.newPromo
    @$scope.newPromo = {}
  remove: (id)=>
    @$http.post('/remove',{id:id})
      .success((data, status, headers, config) =>
        @promos = @promos.filter (p) -> p.id != id
      )


class App extends App
  constructor: ->
    return []


