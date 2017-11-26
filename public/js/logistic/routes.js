(function(G) {
    'use strict';

    angular.module('logistic')
        .config([
            '$routeProvider',
            '$locationProvider',
            function Config($routeProvider, $locationProvider) {
                $locationProvider
                    // .hashPrefix('NG')
                    .html5Mode(true);

                $routeProvider
                    .when('/', {
                        redirectTo: '/home'
                    })
                    .when('/home', {
                        templateUrl: G.url + '/view/home.html',
                        controller: 'HomeController'
                    })
                    .when('/notfound', {
                        templateUrl: G.url + '/view/notfound.html'
                    })
                    .otherwise({
                        redirectTo: '/notfound'
                    })

                    
                    .when('/components', {
                        templateUrl: G.url + '/view/components.html'
                    })

                    .when('/products', {
                        templateUrl: G.url + '/view/product.index.html',
                        controller: 'ProductsController'
                    })
                    .when('/products/edit/:id', {
                        templateUrl: G.url + '/view/product.edit.html',
                        controller: 'ProductsEditController'
                    })
                    .when('/products-config', {
                        templateUrl: G.url + '/view/product.config.html',
                        controller: 'ProductsConfigController'
                    })

                    // SUPPLIERS
                    .when('/suppliers', {
                        templateUrl: `${G.url}/view/suppliers.index.html`,
                        controller: 'SuppliersController'
                    })
                    .when('/suppliers/create', {
                        templateUrl: `${G.url}/view/suppliers.create.html`,
                        controller: 'SuppliersCreateController'
                    })
                    .when('/suppliers/edit/:id', {
                        templateUrl: `${G.url}/view/suppliers.create.html`,
                        controller: 'SuppliersEditController'
                    })

                    //dist
                    .when('/inputs', {
                        templateUrl: `${G.url}/view/inputs.index.html`,
                        controller: 'InputsController'
                    })
                    .when('/inputs/create', {
                        templateUrl: `${G.url}/view/inputs.create.html`,
                        controller: 'InputsCreateController'
                    })
                    .when('/inputs/edit/:id', {
                        templateUrl: `${G.url}/view/inputs.edit.html`,
                        controller: 'InputsEditController'
                    })

                    .when('/outputs', {
                        templateUrl: `${G.url}/view/outputs.index.html`,
                        controller: 'OutputsController'
                    })
                    .when('/outputs/create', {
                        templateUrl: `${G.url}/view/outputs.create.html`,
                        controller: 'OutputsCreateController'
                    })
                    .when('/outputs/edit/:id', {
                        templateUrl: `${G.url}/view/outputs.edit.html`,
                        controller: 'OutputsEditController'
                    })

                    // REPORTES
                    .when('/stock-location', {
                        templateUrl: `${G.url}/view/stock-location.html`,
                        controller: 'StockLocationController'
                    })
                    .when('/stock-location-po', {
                        templateUrl: `${G.url}/view/stock-location-po.html`,
                        controller: 'StockLocationPoController'
                    })
                    .when('/inventory-general', {
                        templateUrl: `${G.url}/view/inventory-general.html`,
                        controller: 'InventoryGeneralController'
                    })
                    .when('/inventory', {
                        templateUrl: `${G.url}/view/inventory.html`,
                        controller: 'InventoryController'
                    })
                    .when('/stock-status', {
                        templateUrl: `${G.url}/view/stock-status.html`,
                        controller: 'StockStatusController'
                    })
                    .when('/locations', {
                        template: '<locations-crud></locations-crud>'
                    })

                    // proceso de compra
                    .when('/requeriments', {
                        templateUrl: `${G.url}/view/requeriments.index.html`,
                        controller: 'RequerimentsController'
                    })
                    .when('/requeriments/create', {
                        templateUrl: `${G.url}/view/requeriments.create.html`,
                        controller: 'RequerimentsCreateController'
                    })
                    .when('/requeriments/edit/:id', {
                        templateUrl: `${G.url}/view/requeriments.edit.html`,
                        controller: 'RequerimentsEditController'
                    })

                    //quotations
                    .when('/quotations', {
                        templateUrl: `${G.url}/view/quotations.index.html`,
                        controller: 'QuotationsController'
                    })
                    .when('/quotations/edit/:id', {
                        templateUrl: `${G.url}/view/quotations.edit.html`,
                        controller: 'QuotationsEditController'
                    })

                    // comparacion
                    .when('/comparison', {
                        templateUrl: G.url + '/view/comparison.index.html',
                        controller: 'ComparisonController'
                    })
                    .when('/comparison/edit/:id', {
                        templateUrl: G.url + '/view/comparison.edit.html',
                        controller: 'ComparisonEditController'
                    })

                    .when('/purchase', {
                        templateUrl: G.url + '/view/purchase.index.html',
                        controller: 'PurchaseController'
                    })

                    .when('/users', {
                        templateUrl: G.url + '/view/users.html',
                        controller: 'UsersController'
                    })

                    .when('/permissions', {
                        templateUrl: G.url + '/view/permissions.html',
                        controller: 'PermissionsController'
                    })

                    .when('/ez-outputs', {
                        templateUrl: G.url + '/view/outputs.ez.html',
                        controller: 'EzOutputsController'
                    })
            }
        ])
        .run(function ($rootScope, $location, $route, $timeout) {
            // $rootScope.config = {};
            // $rootScope.config.app_url = $location.url();
            // $rootScope.config.app_path = $location.path();
            $rootScope.layout = {};
            $rootScope.layout.loading = false;
        
            $rootScope.$on('$routeChangeStart', function () {
                console.log('$routeChangeStart');
                //show loading gif
                $timeout(function(){
                    $rootScope.layout.loading = true;          
                });
            });
            $rootScope.$on('$routeChangeSuccess', function () {
                console.log('$routeChangeSuccess');
                //hide loading gif
                $timeout(function(){
                    $rootScope.layout.loading = false;
                }, 200);
            });
            $rootScope.$on('$routeChangeError', function () {
        
                //hide loading gif
                alert('Error al cambiar la ruta');
                $rootScope.layout.loading = false;
        
            });
        });
})(G);