class OfferNew extends Controller
  constructor: (@$http)->
    @newPromo = {}
    @$http.post('/api/offers/lookup', {
      wifi_name: 111
    })
  add: =>
    @$http.post('/api/offers', @newPromo)
    .success((data, status, headers, config) =>
      @newPromo.id = data
    )
    #    @promos.push @newPromo
    @newPromo = {}
  remove: (id)=>
    @$http.post('/remove', {id: id})
    .success((data, status, headers, config) =>
      @promos = @promos.filter (p) -> p.id != id
    )