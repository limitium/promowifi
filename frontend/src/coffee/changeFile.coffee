class ChangeFile extends Directive
  constructor: ->
    return {
      require: 'ngModel'
      scope: {
        changeFile: '&'
      },
      link: (scope, el, attrs, ngModel)->
        
        handler = (e) ->
          scope.$apply ->
            scope.changeFile({ event: e})

        el[0].addEventListener('change', handler, false);
    }