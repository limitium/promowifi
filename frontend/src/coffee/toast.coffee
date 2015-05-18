class Toast extends Service
  constructor: ->
  toast: (message)->
    Materialize.toast(message, 3000, 'rounded')