
// INPUTS
const InputsConfig = {
    name: 'inputs',
    createUrl: G.appUrl + '/inputs/create',
    editUrl: G.appUrl + '/inputs/edit',
};
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('InputsController', InputsController);

    InputsController.$inject = ['$scope', '$http', '$window', 'Locations', '$location'];
    function InputsController($scope, $http, $window, Locations, $location) {
        var vm = this;

        $scope.config = Config
        $scope.g_config = G.config
        
        $scope.dialogs = {
            changePage: function(){
                $location.search('page', $scope.resource.page)
            }
        }

        $scope.resource = {
            data: {}, // respuesta de la base de datos
            per_page: G.config.per_page,
            page: 1,
            search: '',
            error: false,
            get: function(){
                $http.get(G.apiUrl + '/' + Config.name, {
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

        activate();

        ////////////////

        function activate() { 
            var currentPage = $location.search().page ? $location.search().page : 1
            setTimeout(() => {
                $scope.resource.page = parseInt(currentPage)
                $scope.resource.get();
            }, 300);
            // $scope.resource.page = $location.search().page ? $location.search().page : 40
            
        }
    }
})(G, InputsConfig);
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('InputsCreateController', InputsCreateController);

    InputsCreateController.$inject = ['$scope', 'Locations', '$http', '$location'];
    function InputsCreateController($scope, Locations, $http, $location) {
        var vm = this;
        
        $scope.Locations = Locations

        $scope.resource = {
            fila: {
                locations_id: Locations.get(),
                type: G.config.inputs.defaultType
            },
            error: false,
            save: function(){
                this.fila.user_id = G.user.id
                $http.post(G.apiUrl + '/' + Config.name, this.fila)
                .then(
                    res => {
                        $location.replace()
                        // console.log(Config.editUrl + '/' + res.id)
                        $location.path(Config.name + '/edit/' + res.data.id)
                    },
                    err => {
                        this.error = err
                    }
                )
                this.fila = {}
            }
        }
        
        activate();

        ////////////////

        function activate() { }
    }
})(G, InputsConfig);
(function(G, Config, moneyFormatter) {
    'use strict';

    angular
        .module('logistic')
        .controller('InputsEditController', InputsEditController);

    InputsEditController.$inject = ['$routeParams', '$scope', '$http', 'Suppliers', '$window', 'Products'];
    function InputsEditController($routeParams, $scope, $http, Suppliers, $window, Products) {
        var vm = this;
        // datos para las fechas
        $scope.dateOptions = {
            // dateDisabled: disabled,
            formatYear: 'yy',
            // maxDate: new Date(2020, 5, 22),
            // minDate: new Date(),
            startingDay: 1
        };
        $scope.dialogs = {
            showInfoModal: function() {
                $('#input-info-modal').modal('show')
            },
            showEditModal: function(){
                $('#edit-modal').modal('show')
            }
        }
        $scope.Products = Products
        $scope.Suppliers = Suppliers
        $scope.Suppliers.get()
        $scope.config = G.config
        $scope.resource = {
            fila: {},
            get: function(){
                $http.get(G.apiUrl + '/' + Config.name + '/' + $routeParams.id).then(
                    res => {
                        this.fila = res.data
                    }
                )
            },
            edit: function(){
                $http.put(G.apiUrl + '/' + Config.name + '/' + $routeParams.id, 
                    this.fila
                )
                .then(
                    res => $('#edit-modal').modal('hide')
                )
            },
            lock: function(){
                if($window.confirm('Estas Seguro(a) de bloquear el registro')){
                    this.fila.status = 2
                    this.fila.user_id = G.user.id
                    $http.put(G.apiUrl + '/' + Config.name + '/' + $routeParams.id, this.fila)
                    .then(
                        res => {
                            alert('Bloqueado');
                        }
                    )
                }
            }
        }

        $scope.detalle = {
            name: 'input-details',
            fila: {},
            list: [],
            showFormModal: function(editar = false){
                if(!editar) this.fila = {}
                $('#form-detail-modal').modal('show')
            },
            total: function(){
                let total = 0
                for(let i in this.list){
                    let fila = this.list[i]
                    total += parseFloat(fila.subtotal)
                }
                return total
            },
            edit: function(fila){
                this.fila = fila
                this.fila.expiration = new Date(this.fila.expiration)
                this.fila.fabrication = new Date(this.fila.fabrication)
                this.showFormModal(true)
            },
            delete: function(id){
                let msj = 'Eliminar el registro con id: ' 
                    + id 
                    + '\nAlerta, si hay salidas relacionadas a este registro, se eliminaran tambien'
                if($window.confirm(msj)){
                    $http.delete(G.apiUrl + '/' + this.name + '/' + id).then(
                        res => {
                            activate();
                        }
                    )
                }
            },
            copyToForm: function(fila){
                this.fila = {
                    ticket_type: fila.ticket_type,
                    ticket_number: fila.ticket_number,
                    suppliers_id: fila.suppliers_id,
                }
                this.showFormModal(true)
            },
            enSoles: function(dinero){
                return moneyFormatter.format('PEN', dinero)
            },
            get: function(){
                $http.get(G.apiUrl + '/' + this.name, {
                    params: {
                        id: $routeParams.id // inputs_id
                    }
                }).then(
                    (res) => {
                        // this.list = []

                        // load suppliers and states
                        // for()

                        this.list = res.data

                        // if(this.suppliers){
                            // this.suppliers = {}
                            // for(var i in $scope.Suppliers.list){
                            //     var fila = $scope.Suppliers.list[i]
                            //     this.suppliers[fila.id] = fila
                            // }
                        // }
                    }
                )
            },
            save: function(){
                if(this.fila.id){
                    this.fila.user_id = G.user.id
                    $http.put(G.apiUrl +  '/' + this.name + '/' + this.fila.id, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                    // this.fila = {}
                }else{
                    this.fila.user_id = G.user.id
                    this.fila.inputs_id = $routeParams.id
                    $http.post(G.apiUrl + '/' + this.name, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                    // this.fila = {}
                }
                this.fila = {}
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.detalle.get()
            $scope.resource.get()
        }
    }
})(G, InputsConfig, window.moneyFormatter);
