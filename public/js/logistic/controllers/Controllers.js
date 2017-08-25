(function() {
    'use strict';

    angular
        .module('logistic')
        .controller('Ctrl1Controller', Ctrl1Controller);

    Ctrl1Controller.$inject = ['$scope', 'myService', 'myFactory'];
    function Ctrl1Controller($scope, myService, myFactory) {
        var vm = this;
        
        $scope.resource = {
            myService,
            myFactory
        }

        activate();

        ////////////////

        function activate() { }
    }
})();

(function() {
    'use strict';

    angular
        .module('logistic')
        .controller('Ctrl2Controller', Ctrl2Controller);

    Ctrl2Controller.$inject = ['$scope', 'myService', 'myFactory'];
    function Ctrl2Controller($scope, myService, myFactory) {
        var vm = this;
        
        $scope.resource = {
            myService,
            myFactory
        }
        $scope.products_id = 14

        activate();

        ////////////////

        function activate() { }
    }
})();