class OfferNew extends Controller
  constructor: (@$rootScope, @$http, @$router, @ToastService)->
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

    @busy = false

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

  add: =>
    @busy = true
    @$http.post('/api/offers', @offer)
    .success((data, status, headers, config) =>
      @offer.organizationName = ''
      @offer.wifiName = ''
      @avatar.file = null
      @avatar.preview = null

      @offer.name = ''
      @offer.description = ''
      @image.file = null
      @image.preview = null

      @$router.parent.navigate('/')
      @ToastService.toast 'Offer created'
    )
    .finally(=>
      @busy = false
    )

OfferNew::canDeactivate = ->
  !@busy
