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

(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('productsCreateModal', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/product.create-modal.html',
            controller: ProductsCreateController,
            controllerAs: '$ctrl',
            bindings: {
                activate: '&'
            },
        });

    ProductsCreateController.$inject = ['$scope', '$http'];
    function ProductsCreateController($scope, $http) {
        var $ctrl = this;

        $scope.create = {
            verForm: function(){
                $('#product-create-modal').modal('show')
            },
            fila: {},
            error: false,
            post: function(){
                this.fila.user_id = G.user.id
                $http.post(G.apiUrl + '/products', this.fila)
                .then(
                    res => {
                        // activate();
                        $('#product-create-modal').modal('hide')
                        $ctrl.$onChanges({})
                    },
                    res => { // error
                        this.error = res
                    }
                )
            }
        }

        ////////////////

        $ctrl.$onInit = function() { 
            $scope.state = true
        };
        $ctrl.$onChanges = function(changesObj) { 
            $ctrl.activate()
        };
        $ctrl.$onDestroy = function() { };
    }
})(G);

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

    ProductsConfigController.$inject = ['$http', '$scope', 'Locations'];
    function ProductsConfigController($http, $scope, Locations) {
        var vm = this;

        $scope.config = Config
        
        $scope.resource = {
            data: {}, // respuesta de la base de datos
            per_page: G.config.per_page,
            page: 1,
            search: '',
            error: false,
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
            delete: function(id){
                if($window.confirm('Desactivar el registro con id:' + id)){
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

        activate();

        ////////////////

        function activate() { 
            $scope.resource.get()
        }
    }
})(G, ProductsConfig);

(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('productSelector', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/product.select.html',
            controller: ProductSelectorController,
            controllerAs: '$ctrl',
            bindings: {
                valueId: '=',
                valueChange: '&',
            },
        });

    ProductSelectorController.$inject = ['$scope', '$http'];
    function ProductSelectorController($scope, $http) {
        var $ctrl = this;

        ////////////////

        $ctrl.$onInit = function() { 
            $scope.state = 'view'
            $scope.ps = {
                query: '',
                get: function(){
                    $http.get(G.apiUrl + '/products', 
                        {params: {search: this.query}}
                    ).then(
                        res => {
                            this.list = res.data.data
                        }
                    )
                },
                extChange: function(){
                    if($scope.state === 'view'){
                        this.getOne()
                    }
                },
                getOne: function(){
                    $http.get(G.apiUrl + '/products/' + $ctrl.valueId).then(
                        res => {
                            this.list = []
                            this.list.push(res.data)
                        }
                    )
                }
            }
            // $scope.ps.get()
            $scope.ps.getOne()
        };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})(G);
