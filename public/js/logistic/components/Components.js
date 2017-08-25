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

    ProductOptionsController.$inject = ['$http', '$scope', 'Locations'];
    function ProductOptionsController($http, $scope, Locations) {
        var $ctrl = this;

        ////////////////

        $ctrl.$onInit = function() { 
            $scope.po = {
                products_id: 0,
                fila: {},
                get: function(){
                        $http.get(
                            G.apiUrl + '/product-options/' + Locations.get() + '/' + this.products_id,
                            this.fila
                        ).then(
                            res => {
                                this.fila = res.data
                            }
                        )
                },
                guardar: function(){
                    this.fila.user_id = G.user.id
                    // if(!this.fila.id){
                    //     $http.post(
                    //         G.apiUrl + '/product-options/' + Locations.get() + '/' + this.products_id,
                    //         this.fila
                    //     ).then(
                    //         res => {
                    //             this.fila = res.data
                    //         }
                    //     )
                    // }else{
                        $http.put(
                            G.apiUrl + '/product-options/' + this.fila.id,
                            this.fila
                        ).then(
                            res => {
                                this.fila = res.data
                            }
                        )
                    // }
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