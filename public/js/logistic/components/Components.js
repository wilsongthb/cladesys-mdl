(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('productOptions', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/product.options.html',
            controller: ProductOptionsController,
            controllerAs: '$ctrl',
            bindings: {
                // Binding: '=',
            },
        });

    ProductOptionsController.$inject = ['$http', '$scope', 'Locations', 'Products'];
    function ProductOptionsController($http, $scope, Locations, Products) {
        var $ctrl = this;

        ////////////////

        $scope.Products = Products

        $ctrl.$onInit = function() { 
            $scope.po = {
                state: 'look',
                products_id: 0,
                fila: {},
                guardado: false,
                get: function(){
                    if(parseInt(this.products_id)){
                        $http.post(
                            G.apiUrl + '/product-options/' + Locations.get() + '/' + this.products_id).then(
                            res => {
                                this.fila = res.data
                            }
                        )
                    }
                },
                guardar: function(){
                    this.fila.user_id = G.user.id
                    $http.put(
                        G.apiUrl + '/product-options/' + this.fila.id,
                        this.fila
                    ).then(
                        res => {
                            this.fila = res.data
                            this.guardado = true
                            // setTimeout(() => {
                            //     console.log(this)
                            //     this.guardado = false
                            // }, 1000);
                        }
                    )
                }
            }
        };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})(G);

(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('locationSelect', {
            template: `
                <div class="list-group">
                    <a 
                        class="list-group-item" 
                        ng-repeat="l in Locations.list track by l.id" 
                        ng-if="l" 
                        ng-class="{ active: l.id == Locations.get() }" 
                        ng-click="Locations.set(l.id)">
                        {{l.name}} <span class="badge">{{config.location.type[l.type]}}</span>
                    </a>
                </div>
            `,
            //templateUrl: 'templateUrl',
            controller: LocationSelectController,
            controllerAs: '$ctrl',
            bindings: {
                // Binding: '=',
            },
        });

    LocationSelectController.$inject = ['$scope', 'Locations'];
    function LocationSelectController($scope, Locations) {
        var $ctrl = this;

        ////////////////

        $ctrl.$onInit = function() { 
            $scope.Locations = Locations
            $scope.config = G.config
        };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})(G);

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

    ProductsCreateController.$inject = ['$scope', '$http', 'Locations'];
    function ProductsCreateController($scope, $http, Locations) {
        var $ctrl = this;

        $scope.create = {
            verForm: function(){
                $('#product-create-modal').modal('show')
                $scope.state = true
            },
            fila: {},
            error: false,
            post: function(){
                this.fila.user_id = G.user.id
                this.fila.po_locations_id = Locations.get()
                $http.post(G.apiUrl + '/products', this.fila)
                .then(
                    res => {
                        // activate();
                        $('#product-create-modal').modal('hide')
                        this.fila = {}
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
            // $scope.state = true
        };
        $ctrl.$onChanges = function(changesObj) { 
            $ctrl.activate()
        };
        $ctrl.$onDestroy = function() { };
    }
})(G);

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
                productsId: '=',
                psOnChange: '&',
                requerido: '='
            },
        });

    ProductSelectorController.$inject = ['$scope', 'Products', '$window'];
    function ProductSelectorController($scope, Products, $window) {
        var $ctrl = this;

        ////////////////
        $scope.state = 'view'
        $scope.Products = Products
        $scope.ps = {
            query: ''
        }

        $ctrl.$onInit = function() { 
            // console.log($ctrl.productsId)   
            $scope.Products.getOne($ctrl.productsId)
        };
        $ctrl.$onChanges = function(changesObj) { 
            $window.setTimeout(function() {
                $ctrl.psOnChange()
            }, 300);
        };
        $ctrl.$onDestroy = function() { };
    }
})(G);

(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('inventorySelector', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/inventory.select.html',
            controller: ProductSelectorController,
            controllerAs: '$ctrl',
            bindings: {
                inputDetailsId: '=',
                isOnChange: '&',
                requerido: '='
            },
        });

    ProductSelectorController.$inject = ['$scope', 'Inventory', '$window'];
    function ProductSelectorController($scope, Inventory, $window) {
        var $ctrl = this;

        ////////////////
        $scope.state = 'view'
        $scope.Inventory = Inventory
        $scope.Inventory.get('')
        $scope.is = {
            query: ''
        }

        $ctrl.$onInit = function() { 
            // console.log($ctrl.productsId)   
            // $scope.Products.getOne($ctrl.productsId)
        };
        $ctrl.$onChanges = function(changesObj) { 
            $window.setTimeout(function() {
                $ctrl.isOnChange()
            }, 300);
        };
        $ctrl.$onDestroy = function() { };
    }
})(G);

(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('locationsCrud', {
            // template: ``,
            templateUrl: G.url + '/view/locations.html',
            controller: LocationSelectController,
            controllerAs: '$ctrl',
            bindings: {
                // Binding: '=',
            },
        });

    LocationSelectController.$inject = ['$scope', 'Locations', '$http', '$window'];
    function LocationSelectController($scope, Locations, $http, $window) {
        var $ctrl = this;

        $scope.resource = {
            fila: {},
            showFormCreate: function(){
                $('#formModalLocations').modal('show')
                this.fila = {}
            },
            showFormModal: function(l){
                $('#formModalLocations').modal('show')
                this.fila = l
            },
            delete: function(l){
                if($window.confirm('Desactivar la localizacion con id: ' + l.id)){
                    $http.delete(G.apiUrl + '/locations/' + l.id).then(
                        res => {
                            Locations.init()
                        }
                    )
                }
            },
            save: function(){
                this.fila.user_id = G.user.id
                if(this.fila.id){
                    $http.put(G.apiUrl + '/locations/' + this.fila.id, this.fila).then(
                        res => {
                            $('#formModalLocations').modal('hide')
                            Locations.init()
                            this.fila = {}
                        }
                    )
                }else{
                    $http.post(G.apiUrl + '/locations', this.fila).then(
                        res => {
                            $('#formModalLocations').modal('hide')
                            Locations.init()
                            this.fila = {}
                        }
                    )
                }
            }
        }

        ////////////////

        $ctrl.$onInit = function() { 
            $scope.Locations = Locations
            $scope.config = G.config
        };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})(G);