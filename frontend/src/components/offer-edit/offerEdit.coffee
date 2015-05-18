class OfferEdit extends Controller
  constructor: (@$rootScope, @$http, @$routeParams)->
    @offer =
      wifiName: ''
      description: ''
      rawImage: null

    @img =
      file: null
      preview: null

    @busy = true
    console.log 1
    @$http.get('/api/offers/' + @$routeParams.id)
    .success((offer) =>
      @offer.wifiName = offer.wifi_name
      @offer.description = offer.description
      @img.preview = '/cdn/' + offer._image.hash + '.png'
    )
    .finally(=> @busy = false)


  fileChange: (event) =>
    @img.file = event.target.files?[0]

    reader = new FileReader()
    reader.onload = =>
      @img.preview = reader.result
      @offer.rawImage = @img.preview
      @$rootScope.$apply()

    reader.readAsDataURL(@img.file)

  edit: =>
    @busy = true
    @$http.put('/api/offers', @offer)
    .success((data, status, headers, config) =>
      @offer.wifiName = ''
      @offer.description = ''
      @img.file = null
      @img.preview = null
    )
    .finally(=> @busy = false)