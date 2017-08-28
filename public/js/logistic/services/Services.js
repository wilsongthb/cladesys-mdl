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

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .service('Products', Products);

    Products.$inject = ['$http'];
    function Products($http) {
        this.exposedFn = exposedFn;
        
        this.list = []
        this.get = function(query){
            $http.get(G.apiUrl + '/products', {params: {search: query}})
            .then(
                (res) => {
                    this.list = res.data.data
                }
            )
        }
        this.getOne = function(id){
            $http.get(G.apiUrl + '/products/' + id).then(
                res => {
                    // this
                    // this.get
                    // this.fila = res.data
                    // this.list = [res.data]
                    this.list = [] 
                    // this.list
                    this.list.push(res.data)
                }
            )
        }
        // this.get('')

        ////////////////

        function exposedFn() { }
        }
})(G);