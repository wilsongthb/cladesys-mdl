(function(G, moment) {
    'use strict';

    angular
        .module('logistic')
        .controller('StockStatusController', StockStatusController);

    StockStatusController.$inject = ['$http', '$scope', 'StockLocation', 'Locations'];
    function StockStatusController($http, $scope, StockLocation, Locations) {
        $scope.StockLocation = StockLocation

        activate();

        ////////////////

        function activate() { 
            $scope.StockLocation.getStatus(Locations.get(), 
                true, // group by products
                true // load stockStatus
            )
        }
    }
})(G, window.moment);