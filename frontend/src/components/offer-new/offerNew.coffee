class OfferNew extends Controller
  constructor: (@$rootScope, @$http, @$router)->
    @offer =
      wifiName: ''
      description: ''
      rawImage: null

    @img =
      file: null
      preview: null

    @busy = false

  fileChange: (event) =>
    @img.file = event.target.files?[0]

    reader = new FileReader()
    reader.onload = =>
      @img.preview = reader.result
      @offer.rawImage = @img.preview
      @$rootScope.$apply()

    reader.readAsDataURL(@img.file)

  add: =>
    @busy = true
    @$http.post('/api/offers', @offer)
    .success((data, status, headers, config) =>
      @offer.wifiName = ''
      @offer.description = ''
      @img.file = null
      @img.preview = null
      #      @todo: redirect?
      @$router.parent.navigate('/')
    )
    .finally(=>
      @busy = false
    )

OfferNew::canDeactivate = ->
  !@busy
