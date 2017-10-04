(function(G) {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('productValues', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/components.product-values.html',
            controller: productValuesController,
            controllerAs: '$ctrl',
            bindings: {
                nameModel: '@',
                valueId: '=',
            },
        });

    productValuesController.$inject = ['$http'];
    function productValuesController($http) {
        var $ctrl = this;
        
        ////////////////

        $ctrl.$onInit = function() { 
            $http.get(G.apiUrl + '/' + $ctrl.nameModel)
            .then(
                function(res){
                    $ctrl.list = res.data
                }
            )
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
        .component('productValueCrud', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/product.value-crud.html',
            controller: ProductValueCrudController,
            controllerAs: '$ctrl',
            bindings: {
                nameModel: '@',
            },
        });

    ProductValueCrudController.$inject = ['$http', '$scope', '$window'];
    function ProductValueCrudController($http, $scope, $window) {
        var $ctrl = this;

        $scope.edit = function(l){
            l.state = 'edit'
            // $scope.fila = l
        }

        $scope.save = function(l){
            save(l)
        }

        $scope.disables = function(l){
            if($window.confirm('Borrar a ' + l.value))
                disables(l.id)
        }

        let read;
        let save;
        let disables;

        ////////////////

        $ctrl.$onInit = function() { 
            read = function(){
                $http.get(G.apiUrl + '/' + $ctrl.nameModel)
                .then(
                    function(res){
                        // console.log(res
                        $scope.list = res.data
                    }
                )
            }
            save = function(l){
                if(l.id){
                    $http.put(G.apiUrl + '/' + $ctrl.nameModel + '/' + l.id, l)
                    .then(
                        function(res){
                            read()
                        }
                    )
                }else{
                    $http.post(G.apiUrl + '/' + $ctrl.nameModel, l)
                    .then(
                        function(res){
                            read()
                        }
                    )
                }
            }
            disables = function(id){
                $http.delete(G.apiUrl + '/' + $ctrl.nameModel + '/' + id)
                .then(
                    function(res){
                        read()
                    }
                )
            }
            read()
        };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})(G);