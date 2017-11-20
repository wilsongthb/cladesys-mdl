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
            templateUrl: G.url + '/view/components.products-create-modal.html',
            controller: ProductsCreateController,
            controllerAs: '$ctrl',
            bindings: {
                activate: '&'
            },
        });

    ProductsCreateController.$inject = ['$scope', '$http', 'Locations', 'uiUploader', '$log'];
    function ProductsCreateController($scope, $http, Locations, uiUploader, $log) {
        var $ctrl = this;
        $scope.create = {
            verForm: function(){
                $('#product-create-modal').modal('show')
                $scope.state = true
                
                setTimeout(function() {
                    // esperar un segundo para insertar el evento para uiUploader
                    var element = document.getElementById('ProductImageInput')
                    element.addEventListener('change', function(e) {
                        var files = e.target.files;
                        uiUploader.addFiles(files);
                        $scope.files = uiUploader.getFiles();
                        $scope.$apply();
                    })
                }, 1000);
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

        $scope.image = {
            files: [],
            subir: function(){
                uiUploader.startUpload({
                    url: G.apiUrl + '/images',
                    headers: {
                        'X-CSRF-TOKEN': G['X-CSRF-TOKEN']
                    },
                    concurrency: 2,
                    onProgress: function(file) {
                        $log.info(file.name + '=' + file.humanSize);
                        $scope.$apply();
                    },
                    onCompleted: function(file, response) {
                        $log.info(file + 'response' + response);
                        $scope.create.fila.image_path = response
                    }
                });
            }
        }

        ////////////////

        $ctrl.$onInit = function() { };
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

(function() {
    'use strict';

    // Usage:
    // 
    // Creates:
    // 

    angular
        .module('logistic')
        .component('laravelDateViewer', {
            // template:'htmlTemplate',
            //templateUrl: 'templateUrl',
            template: `
                <span title="{{$ctrl.datetime}}" ng-bind="$ctrl.datetime.split(' ')[0]"></span>
            `,
            controller: LaravelDateViewerController,
            controllerAs: '$ctrl',
            bindings: {
                datetime: '='
            },
        });

    LaravelDateViewerController.$inject = ['$scope'];
    function LaravelDateViewerController($scope) {
        var $ctrl = this;
        

        ////////////////

        $ctrl.$onInit = function() { };
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
        .component('productRow', {
            // template:'htmlTemplate',
            templateUrl: `${G.url}/view/components.product-row.html`,
            controller: ProductRowController,
            controllerAs: '$ctrl',
            bindings: {
                product: '=',
            },
        });

    ProductRowController.$inject = ['$scope'];
    function ProductRowController($scope) {
        var $ctrl = this;
        ////////////////

        $ctrl.$onInit = function() { };
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
        .component('formEditHeader', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/components.form-edit-header.html',
            controller: FormEditHeaderController,
            controllerAs: '$ctrl',
            bindings: {
                reg: '=',
            },
        });

    FormEditHeaderController.$inject = ['$scope'];
    function FormEditHeaderController($scope) {
        var $ctrl = this;
        

        ////////////////

        $ctrl.$onInit = function() { };
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
        .component('loadingIcon', {
            template: `
                <i class="fa fa-spinner fa-pulse fa-fw" ng-show="$ctrl.loading"></i> Cargando
            `,
            //templateUrl: 'templateUrl',
            controller: LoadingIconController,
            controllerAs: '$ctrl',
            bindings: {
                loading: '=',
            },
        });

    LoadingIconController.$inject = ['$scope'];
    function LoadingIconController($scope) {
        var $ctrl = this;
        

        ////////////////

        $ctrl.$onInit = function() { };
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
        .component('kardexProduct', {
            // template:'htmlTemplate',
            templateUrl: G.url + '/view/components.kardex.html',
            controller: kardexProductController,
            controllerAs: '$ctrl',
            bindings: {
                product: '=',
                productId: '='
            },
        });

    kardexProductController.$inject = ['$scope', '$http', 'Locations', 'Products'];
    function kardexProductController($scope, $http, Locations, Products) {
        var $ctrl = this;
        
        $scope.rsc = {
            kardex: [],
            getKardex: function(){
                $http.get(G.apiUrl + '/kardex/' + Locations.get() + '/' + $scope.product_id)
                .then(
                    res => {
                        this.kardex = res.data
                        if(res.data.length === 0) this.msj = 'No hay movimientos registrados'
                    }
                )
            }
        }

        ////////////////

        $ctrl.$onInit = function() { 
            setTimeout(function() {
                console.log($ctrl)
                $scope.product_id = ($ctrl.productId) ? $ctrl.productId : $ctrl.product.id
                $scope.rsc.getKardex()
                $scope.Products = Products
                if(!$ctrl.product){
                    Products.getOne($scope.product_id)
                }
            }, 1000);
        };
        $ctrl.$onChanges = function(changesObj) { };
        $ctrl.$onDestroy = function() { };
    }
})(G);