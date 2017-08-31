(function() {
    'use strict';

    angular.module('logistic', [
        'ngRoute',
        'ui.select',
        'ui.bootstrap'
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

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('RootController', RootController);

    RootController.$inject = ['$scope', 'Locations'];
    function RootController($scope, Locations) {
        var vm = this;

        $scope.Locations = Locations
        $scope.config = G.config

        activate();

        ////////////////

        function activate() { }
    }
})(G);