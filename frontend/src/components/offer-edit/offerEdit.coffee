class OfferEdit extends Controller
  constructor: (@$rootScope, @$http, @$routeParams, @$router)->
    @offer =
      wifiName: ''
      description: ''
      rawImage: null

    @img =
      file: null
      preview: null

    @busy = true

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
    @$http.put('/api/offers/' + @$routeParams.id, @offer)
    .success((data, status, headers, config) =>
      #      @todo: redirect?
      @$router.parent.navigate('/')
    )
    .finally(=> @busy = false)

  delete: =>
    @busy = true
    @$http.delete('/api/offers/' + @$routeParams.id)
    .success((data, status, headers, config) =>
      #      @todo: redirect?
      @$router.parent.navigate('/')
    )
    .finally(=> @busy = false)

OfferEdit::activate = ->
  @$http.get('/api/offers/' + @$routeParams.id)
  .success((offer) =>
    @offer.wifiName = offer.wifi_name
    @offer.description = offer.description
    @img.preview = '/cdn/' + offer._image.hash + '.png'
  )
  .finally(=> @busy = false)

OfferEdit::canDeactivate = ->
  !@busy
