const ProductsConfig = {
    name: 'products',
    createUrl: G.appUrl + '/products/create',
    editUrl: G.appUrl + '/products/edit',
};
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('ProductsController', ProductsController);

    ProductsController.$inject = ['$scope', '$http', '$window', '$sce'];
    function ProductsController($scope, $http, $window, $sce) {
        var vm = this;

        $scope.toHTML = function(text){
            return $sce.trustAsHtml(text)
        }

        $scope.showModal = function(id){
            $(id).modal('show')
            $scope.CargarConfigs = true
        }

        $scope.config = Config

        $scope.resource = {
            maxSize: 5,
            data: {}, // respuesta de la base de datos
            per_page: G.config.per_page,
            page: 1,
            search: '',
            error: false,
            get: function(){
                $http.get(G.apiUrl + '/' + Config.name, {
                    params: {search: this.search, page: this.page, per_page: this.per_page}
                }).then(
                    res => { // success
                        this.data = res.data
                    },
                    res => { // error
                        this.error = res
                    }
                )
            },
            delete: function(id){
                if($window.confirm('Desactivar el registro con id:' + id)){
                    $http.delete(G.apiUrl + '/' + Config.name + '/' + id)
                    .then(
                        res => {
                            activate();
                        },
                        res => { // error
                            this.error = res
                        }
                    )
                }
            }
        }

        $scope.activate = activate
        activate();

        ////////////////

        function activate() { 
            $scope.resource.get();
        }
    }
})(G, ProductsConfig);



(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('ProductsEditController', ProductsEditController);

    ProductsEditController.$inject = ['$scope', '$http', '$routeParams', '$location'];
    function ProductsEditController($scope, $http, $routeParams, $location) {
        var vm = this;
        
        var fila_id = $routeParams.id

        $scope.edit = {
            fila_id,
            fila: {},
            init: function(){
                $http.get(G.apiUrl + '/' + Config.name + '/' + this.fila_id)
                .then(
                    res => {
                        this.fila = res.data
                    },
                    err => {
                        this.error = err
                    }
                )
            },
            put: function(){
                this.fila.user_id = G.user.id
                $http.put(G.apiUrl + '/' + Config.name + '/' + this.fila_id, this.fila)
                .then(
                    res => {
                        this.success = true
                    },
                    res => { // error
                        this.error = res
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.edit.init()
        }
    }
})(G, ProductsConfig);

(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('ProductsConfigController', ProductsConfigController);

    ProductsConfigController.$inject = ['$http', '$scope', 'Locations', '$window', 'Products'];
    function ProductsConfigController($http, $scope, Locations, $window, Products) {
        var vm = this;

        $scope.config = Config
        $scope.Products = Products
        $scope.resource = {
            data: {}, // respuesta de la base de datos
            per_page: G.config.per_page,
            page: 1,
            search: '',
            fila: {},
            error: false,
            state: 'read',
            get: function(){
                $http.get(G.apiUrl + '/' + 'product-options', {
                    params: {
                        search: this.search, 
                        page: this.page, 
                        per_page: this.per_page, 
                        locations_id: Locations.get()
                    }
                }).then(
                    res => { // success
                        this.data = res.data
                    },
                    res => { // error
                        this.error = res
                    }
                )
            },
            put: function(req){
                $http.put(G.apiUrl + '/product-options/' + req.id, req).then(
                    res => {
                        req.state = 'look'
                    }
                )
            },
            post: function(){
                this.fila.locations_id = Locations.get()
                this.fila.user_id = G.user.id
                $http.post(G.apiUrl + '/product-options', this.fila)
                .then(
                    res => {
                        this.fila = {}
                        activate();
                    }
                )
            },
            delete: function(id){
                if($window.confirm('Eliminar el registro con id:' + id)){
                    $http.delete(G.apiUrl + '/product-options/' + id)
                    .then(
                        res => {
                            activate();
                        },
                        res => { // error
                            this.error = res
                        }
                    )
                }
            }
        }

        // $scope.activate = activate;
        activate();

        ////////////////

        function activate() { 
            $scope.resource.get()
            // $scope.Products.get()
        }
    }
})(G, ProductsConfig);


