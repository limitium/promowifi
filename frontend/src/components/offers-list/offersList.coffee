class OffersList extends Controller
  constructor: (@$router, @$http) ->
    @busy = true

OffersList::activate = ->
  @$http.get('/api/offers')
  .success((data, status, headers, config) =>
    @offers = data;
  )
  .finally(=> @busy = false)