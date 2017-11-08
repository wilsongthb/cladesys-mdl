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

    Locations.$inject = ['$http', '$route'];
    function Locations($http, $route) {
        this.exposedFn = exposedFn;
        this.get = function(){ return parseInt(localStorage.logistic_locations_id) }
        this.set = function(id){ 
            localStorage.logistic_locations_id = id // guarda cambios
            $route.reload() // recarga la pagina
        }
        this.init = function(){
            // id init
            if(!localStorage.logistic_locations_id){
                localStorage.logistic_locations_id = G.config.location.default_id
            }
            $http.get(G.apiUrl + '/locations')
            .then(
                res => {
                    this.list = {}
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
        
        // this.list = []
        this.get = function(query){
            $http.get(G.apiUrl + '/products', {params: {search: query}})
            .then(
                (res) => {
                    this.list = []
                    this.list = res.data.data
                }
            )
        }
        this.getOne = function(id){
            $http.get(G.apiUrl + '/products/' + id).then(
                res => {
                    // this.list = {}
                    this.list = []
                    this.list[res.data.id] = res.data

                }
            )
        }
        // this.get('')

        ////////////////

        function exposedFn() { }
    }
})(G);

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .service('Suppliers', Suppliers);

    Suppliers.$inject = ['$http'];
    function Suppliers($http) {
        this.exposedFn = exposedFn;
        
        // this.list = []
        this.get = function(query){
            $http.get(G.apiUrl + '/suppliers', {params: {search: query}})
            .then(
                (res) => {
                    this.list = {}
                    for(let i in res.data.data){
                        let row = res.data.data[i]
                        this.list[row.id] = row
                    }
                }
            )
        }

        ////////////////

        function exposedFn() { }
        }
})(G);

(function() {
    'use strict';

    angular
        .module('logistic')
        .service('Inventory', Inventory);

    Inventory.$inject = ['$http', 'Locations'];
    function Inventory($http, Locations) {
        this.exposedFn = exposedFn;

        // this.list = []
        this.get= function(query){
            $http.get(G.apiUrl + '/inventory/' + Locations.get())
            .then(
                res => {
                    this.list = res.data
                    // this.list = []
                    // for(let i in res.data){
                    //     let row = res.data[i]
                    //     this.list[row.id] = row
                    // }
                }
            )
        }
        
        ////////////////

        function exposedFn() { }
        }
})();

(function() {
    'use strict';

    angular
        .module('logistic')
        .service('MoneyFormat', MoneyFormat);

    MoneyFormat.$inject = [];
    function MoneyFormat() {
        this.exposedFn = exposedFn;
        this.enSoles = function(dinero){
            return moneyFormatter.format('PEN', dinero)
        }
        
        ////////////////

        function exposedFn() { }
        }
})();

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .service('InventoryService', InventoryService);

    InventoryService.$inject = ['$http', 'Locations'];
    function InventoryService($http, Locations) {
        this.exposedFn = exposedFn;
        
        this.get = function(){
            $http.get(G.apiUrl + '/inventory-by-location/' + Locations.get())
            .then(
                res => {
                    this.list = res.data
                }
            )
        }

        ////////////////

        function exposedFn() { }
        }
})(G);