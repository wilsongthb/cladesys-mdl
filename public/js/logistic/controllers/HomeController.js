(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('HomeController', HomeController);

    HomeController.$inject = ['$scope', 'Locations'];
    function HomeController($scope, Locations) {
        var vm = this;
        
        $scope.Locations = Locations
        $scope.config = G.config

        activate();

        ////////////////

        function activate() { }
    }
})(G);