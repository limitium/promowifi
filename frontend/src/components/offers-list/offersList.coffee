class OffersList extends Controller
  constructor: (@$router, @$http) ->
    @$http.get('/list')
    .success((data, status, headers, config) =>
      @promos = data.list;
    )