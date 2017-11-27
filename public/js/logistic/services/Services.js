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

    Locations.$inject = ['$http', '$route', '$window'];
    function Locations($http, $route, $window) {
        this.exposedFn = exposedFn;
        this.get = function(){ return parseInt(localStorage.logistic_locations_id) }
        this.set = function(id){ 
            localStorage.logistic_locations_id = id // guarda cambios
            // recarga la pagina
            $window.location.reload()
            // $route.reload() 
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
                    // this.list[0] = res.data
                    this.list[res.data.id] = res.data
                    this.one = res.data
                    // console.log(this)
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

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .service('LocationsStages', LocationsStages);

    LocationsStages.$inject = ['$http', 'Locations', '$route'];
    function LocationsStages($http, Locations, $route) {
        this.exposedFn = exposedFn;
        
        this.get = function(){
            if(!localStorage.stage){
                localStorage.stage = G.config.defaultStage
            }
            this.stage = localStorage.stage
            return this.stage
        }

        this.noStage = function(){
            $http.put(G.apiUrl + '/locations-stages-session', {
                // locations_stages_id: value.id
                no_stage: true
            }).then(
                res => {
                    $route.reload()
                    this.stage = false
                }
            )
        }

        this.set = function(value){
            localStorage.stage = value
            $http.put(G.apiUrl + '/locations-stages-session', {
                locations_stages_id: value.id
            }).then(
                res => {
                    $route.reload()
                    this.stage = res.data
                }
            )
        }

        this.init = function(){
            $http.get(G.apiUrl + '/locations-stages', {
                // params: {locations_id: Locations.get()}
            })
            .then(
                res => {
                    this.list = res.data
                }
            )
            $http.put(G.apiUrl + '/locations-stages-session', {
            }).then(
                res => this.stage = res.data
            )
        }

        this.init();

        ////////////////

        function exposedFn() { }
    }
})(G);