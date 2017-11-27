(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('RootController', RootController);

    RootController.$inject = ['$scope', 'Locations', 'LocationsStages'];
    function RootController($scope, Locations, LocationsStages) {
        var vm = this;

        $scope.Locations = Locations
        $scope.config = G.config
        $scope.LocationsStages = LocationsStages
        
        $scope.dialogs = {
            showSLSM: function(){
                $('#select-locations-stage').modal('show')
            }
        }

        activate();

        ////////////////

        function activate() { 
            
        }
    }
})(G);
