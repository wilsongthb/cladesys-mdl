(function(G) {
    'use strict';

    angular.module('logistic')
        .config([
            '$routeProvider',
            '$locationProvider',
            function Config($routeProvider, $locationProvider) {
                $locationProvider
                    // .hashPrefix('');
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

                    //KARDEX
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
            }
        ]);
})(G);