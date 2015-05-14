class OfferNew extends Controller
  constructor: (@$http)->
    @offer =
      wifiName: ''
      description: ''

  add: =>
    @$http.post('/api/offers', @offer)
    .success((data, status, headers, config) =>
      @offer.wifiName = ''
      @offer.description = ''
    )
  remove: (id)=>
    @$http.post('/remove', {id: id})
    .success((data, status, headers, config) =>
      @promos = @promos.filter (p) -> p.id != id
    )