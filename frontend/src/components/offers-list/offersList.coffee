class OffersList extends Controller
  constructor: (@$router, @$http) ->
    @$http.get('/list')
    .success((data, status, headers, config) =>
      @promos = data.list;
    )
    @newPromo = {}
  add: =>
    @$http.post('/add', @$scope.newPromo)
    .success((data, status, headers, config) =>
      @newPromo.id = data
    )
    @promos.push @$scope.newPromo
    @newPromo = {}
  remove: (id)=>
    @$http.post('/remove', {id: id})
    .success((data, status, headers, config) =>
      @promos = @promos.filter (p) -> p.id != id
    )