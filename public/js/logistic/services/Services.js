(function() {
    'use strict';

    angular
        .module('logistic')
        .service('myService', myService);

    myService.$inject = ['$http'];
    function myService($http) {
        this.exposedFn = exposedFn;
        this.id = 1
        
        ////////////////

        function exposedFn() { }
        }
})();

(function() {
    'use strict';

    angular
        .module('logistic')
        .factory('myFactory', myFactory);

    myFactory.$inject = ['$http'];
    function myFactory($http) {
        var service = {
            exposedFn:exposedFn,
            id: 2
        };
        
        return service;

        ////////////////
        function exposedFn() { }
    }
})();

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .service('Locations', Locations);

    Locations.$inject = ['$http'];
    function Locations($http) {
        this.exposedFn = exposedFn;
        this.get = function(){ return localStorage.logistic_locations_id }
        this.set = function(id){ localStorage.logistic_locations_id = id }
        this.init = function(){
            // id init
            if(!localStorage.logistic_locations_id){
                localStorage.logistic_locations_id = G.config.location.default_id
            }
            $http.get(G.apiUrl + '/locations')
            .then(
                res => {
                    this.list = []
                    for(let i in res.data){
                        let row = res.data[i]
                        this.list[row.id] = row
                    }
                }
            )
        }

        // init
        this.init()
        
        ////////////////

        function exposedFn() { }
        }
})(G);