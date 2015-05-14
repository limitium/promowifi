class OfferNew extends Controller
  constructor: (@$rootScope, @$http)->
    @offer =
      wifiName: ''
      description: ''
      rawImage: null

    @file = null
    @fileName = ''
    @filePreview = ''

  fileChange: (event) =>
    @file = event.target.files?[0]
    @fileName = @file.name if @file

    reader = new FileReader()
    reader.onload = =>
      @filePreview = reader.result
      @offer.rawImage = @filePreview
      @$rootScope.$apply()

    reader.readAsDataURL(@file)

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