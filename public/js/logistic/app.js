(function() {
    'use strict';

    angular.module('logistic', [
        'ngRoute',
        'ui.select',
        'ui.bootstrap',
        'ui.uploader'
    ]);
})();

(function() {
    'use strict';
    // directiva para poner un model en mayusculas
    angular
        .module('logistic')
        .directive('capitalize', function() {
            return {
                require: 'ngModel',
                link: function(scope, element, attrs, modelCtrl) {
                    var capitalize = function(inputValue) {
                        if (inputValue == undefined) inputValue = '';
                        var capitalized = inputValue.toUpperCase();
                        if (capitalized !== inputValue) {
                            modelCtrl.$setViewValue(capitalized);
                            modelCtrl.$render();
                        }
                        return capitalized;
                    }
                    modelCtrl.$parsers.push(capitalize);
                    capitalize(scope[attrs.ngModel]); // capitalize initial value
                }
            }
        });

})();
