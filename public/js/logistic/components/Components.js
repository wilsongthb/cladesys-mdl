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
                        $http.get(
                            G.apiUrl + '/product-options/' + Locations.get() + '/' + this.products_id,
                            this.fila
                        ).then(
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

(function() {
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
                        {{config.location.type[l.type]}} - {{l.name}} <span class="badge">{{l.po_quantity}}</span>
                    </a>
                </div>
                <!--
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NOMBRE</th>
                            <th>TIPO</th>
                            <th>PO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr 
                            ng-repeat="l in Locations.list track by l.id"  
                            ng-class="{ success: l.id == Locations.get() }" 
                            ng-click="Locations.set(l.id)"
                            ng-if="l">
                            <td ng-bind="l.id"></td>
                            <td ng-bind="l.name"></td>
                            <td ng-bind="config.location.type[l.type]"></td>
                            <td ng-bind="l.po_quantity"></td>
                        </tr>
                    </tbody>
                </table>
                -->
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
})();

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
                $scope.state = true
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
            },
        });

    ProductSelectorController.$inject = ['$scope', 'Products'];
    function ProductSelectorController($scope, Products) {
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
        };
        $ctrl.$onDestroy = function() { };
    }
})(G);

(function() {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('createProductOptions', {
            template:'htmlTemplate',
            //templateUrl: 'templateUrl',
            controller: CreateProductOptionsController,
            controllerAs: '$ctrl',
            bindings: {
                Binding: '=',
            },
        });

    CreateProductOptionsController.$inject = ['$scope'];
    function CreateProductOptionsController($scope) {
        var $ctrl = this;
        


        ////////////////

        $ctrl.$onInit = function() { };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})();