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
            }
        ]);
})(G);