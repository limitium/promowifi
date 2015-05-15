class OffersList extends Controller
  constructor: (@$router, @$http) ->
    @$http.get('/api/offers')
    .success((data, status, headers, config) =>
      @offers = data;
    )