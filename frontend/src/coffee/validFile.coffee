class ValidFile extends Directive
  constructor: ->
    return {
      require: 'ngModel'
      link: (scope, el, attrs, ngModel)->
        el.bind 'change', ->
          scope.$apply ->
            ngModel.$setViewValue(el.val());
            ngModel.$render();
    }