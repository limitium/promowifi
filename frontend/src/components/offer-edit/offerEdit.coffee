class OfferEdit extends Controller
  constructor: (@$rootScope, @$http, @$routeParams, @$router,@ToastService)->
    @offer =
      organizationName: ''
      wifiName: ''
      rawAvatar: null
      name: ''
      description: ''
      rawImage: null

    @image =
      file: null
      preview: null

    @avatar =
      file: null
      preview: null

    @busy = true

  imageChange: (event) =>
    @image.file = event.target.files?[0]

    reader = new FileReader()
    reader.onload = =>
      @image.preview = reader.result
      @offer.rawImage = @image.preview
      @$rootScope.$apply()

    reader.readAsDataURL(@image.file)

  avatarChange: (event) =>
    @avatar.file = event.target.files?[0]

    reader = new FileReader()
    reader.onload = =>
      @avatar.preview = reader.result
      @offer.rawAvatar = @avatar.preview
      @$rootScope.$apply()

    reader.readAsDataURL(@avatar.file)

  edit: =>
    @busy = true
    @$http.put('/api/offers/' + @$routeParams.id, @offer)
    .success((data, status, headers, config) =>
      @$router.parent.navigate('/')
      @ToastService.toast 'Offer changed'
    )
    .finally(=> @busy = false)

  delete: =>
    @busy = true
    @$http.delete('/api/offers/' + @$routeParams.id)
    .success((data, status, headers, config) =>
      @$router.parent.navigate('/')
      @ToastService.toast 'Offer deleted'
    )
    .finally(=> @busy = false)

OfferEdit::activate = ->
  @$http.get('/api/offers/' + @$routeParams.id)
  .success((offer) =>
    @offer.organizationName = offer.organization_name
    @offer.wifiName = offer.wifi_name
    @image.preview = offer.image

    @offer.name = offer.name
    @offer.description = offer.description
    @avatar.preview = offer.avatar
  )
  .finally(=> @busy = false)

OfferEdit::canDeactivate = ->
  !@busy
