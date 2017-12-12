// OUTPUTS
const OutputsConfig = {
    name: 'outputs',
    createUrl: G.appUrl + '/outputs/create',
    editUrl: G.appUrl + '/outputs/edit',
};

(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('OutputsController', OutputsController);

    OutputsController.$inject = ['$scope', '$http', '$window', 'Locations'];
    function OutputsController($scope, $http, $window, Locations) {
        var vm = this;
        
        $scope.config = Config
        $scope.g_config = G.config
        
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
            $scope.resource.get();
        }
    }
})(G, OutputsConfig);
(function(G, Config, numberFormat) {
    'use strict';

    angular
        .module('logistic')
        .controller('OutputsCreateController', OutputsCreateController);

    OutputsCreateController.$inject = ['$scope', 'Locations', '$http', '$location'];
    function OutputsCreateController($scope, Locations, $http, $location) {
        var vm = this;
        
        $scope.Locations = Locations

        $scope.numberFormat = numberFormat

        $scope.resource = {
            fila: {
                // locations_id: Locations.get()
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
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.resource.fila.locations_id = Locations.get()
        }
    }
})(G, OutputsConfig, window.format);
(function(G, Config, moneyFormatter) {
    'use strict';

    angular
        .module('logistic')
        .controller('OutputsEditController', OutputsEditController);

    OutputsEditController.$inject = ['$routeParams', '$scope', '$http', 'Suppliers', '$window', 'StockLocation', 'Locations'];
    function OutputsEditController($routeParams, $scope, $http, Suppliers, $window, StockLocation, Locations) {
        var vm = this;

        // datos para las fechas
        $scope.dateOptions = {
            // dateDisabled: disabled,
            formatYear: 'yy',
            // maxDate: new Date(2020, 5, 22),
            // minDate: new Date(),
            startingDay: 1
        };
        // $scope.pop = false;
        // $scope.pop1 = false;

        // $scope.Suppliers = Suppliers
        $scope.StockLocation = StockLocation
        $scope.config = G.config
        $scope.G = G

        $scope.dialogs = {
            ticketModal: function(){
                $('#ticket-modal').modal('show')
                $scope.ticket.getTickets()
            },
            showModalInfoRsc: function(){
                $('#modal-info-rsc').modal('show')
            },
            showModalAdd: function(){
                $('#modal-add-output').modal('show')
            }
        }

        $scope.ticket = {
            generate: function(){
                if(!this.sending){
                    this.sending = true
                    $http.post(G.apiUrl + '/outputs/generate-ticket/' + $routeParams.id)
                    .then(
                        res => {
                            alert('hecho')
                            this.getTickets()
                            this.sending = false
                        }
                    )
                }
            },
            getTickets: function(){
                $http.get(G.apiUrl + '/tickets', {
                    params: {
                        table: 'outputs',
                        id: $routeParams.id
                    }
                }).then(
                    res => this.list = res.data
                )
            }
        }
        
        $scope.rsc = {
            fila: {},
            byProduct: false, // configuracion por producto
            desbloquear: function(){
                if(confirm('Desbloquear registro? \nEsto eliminara la entrada relacionada de ser esta una distribucion')){
                    $http.put(G.apiUrl + '/outputs/to-unlock/' + $routeParams.id)
                    .then(
                        res => activate()
                    )
                }
            },
            get: function(Cback = function(data){}){
                $http.get(G.apiUrl + '/' + Config.name + '/' + $routeParams.id).then(
                    res => {
                        this.fila = res.data
                        Cback(res.data)
                    }
                )
            },
            lock: function(){
                if($window.confirm('Estas Seguro(a) de bloquear el registro')){
                    this.fila.status = 2
                    this.fila.user_id = G.user.id
                    $http.put(G.apiUrl + '/' + Config.name + '/' + $routeParams.id, this.fila)
                    .then(
                        res => {
                            alert('Bloqueado -_-');
                        }
                    )
                }
            },
            send: function(){
                if($window.confirm('Estas Seguro(a) de Enviar el registro\nEste sera bloqueado de edicion')){
                    this.fila.status = 2
                    this.fila.user_id = G.user.id
                    $http.post(G.apiUrl + '/' + Config.name + '/send/' + $routeParams.id, this.fila)
                    .then(
                        res => {
                            alert('Enviado -_-');
                        }
                    )
                }
            }
        }

        $scope.det = {
            name: 'output-details',
            fila: {},
            list: [],
            loading: false,
            recalcularPrecio: true,
            reestablecerPrecios: function(){
                if(confirm('Esta seguro(a) de reestablecer precios, se van a \nrecuperar el precio de compra y adicionar la utilidad')){
                    $http.put(G.apiUrl + '/outputs/reeboot-prices', {
                        outputs_id: $routeParams.id
                    })
                    .then(
                        res => activate()
                    )
                }
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
            enSoles: function(dinero){
                return moneyFormatter.format('PEN', dinero)
            },
            get: function(){
                $http.get(G.apiUrl + '/' + this.name, {
                    params: {
                        id: $routeParams.id // inputs_id
                    }
                }).then(
                    res => {
                        // this.list = []
                        this.list = res.data
                    }
                )
            },

            getRealPriceId: function(item){
                // console.log(item)
                // var input_details_id = item.id

                this.fila.stock = item.stock
                this.fila.quantity = 0
                this.fila.real_unit_price = parseFloat(item.value)

                // // this.fila.unit_price = parseFloat(item.unit_price) + parseFloat(item.unit_price * item.utility / 100)
                this.fila.unit_price = 
                    parseFloat(item.value) + 
                    parseFloat(
                        parseFloat(item.value) * 
                        parseFloat(this.fila.utility) / 
                        100
                    )

                // this.calculateUnitPrice()                
                // console.log(item)
                // console.log(this.fila)
                // console.log(input_details_id)
                // return 

                // $http.get(G.apiUrl + '/real-price-id/' + Locations.get() + '/' + input_details_id)
                // .then(
                //     res => {
                //         // this.fila.real_price = res.data[0].real_price


                //     }
                // )
            },
            calculateUnitPrice: function(){
                // console.log('ja')
                // if(this.fila.utility && this.recalcularPrecio){
                //     if(this.fila.unit_price){
                //         this.fila.unit_price = parseFloat(this.fila.unit_price) + parseFloat((this.fila.utility/100) * this.fila.unit_price)
                //     }else{
                //         this.fila.unit_price = parseFloat(this.fila.real_price) + parseFloat(((this.fila.utility/100) * this.fila.real_price))
                //     }
                // }
                // console.log(this.fila)

                this.fila.utility = parseFloat(this.fila.utility)
                if(this.recalcularPrecio){
                    // if(this.fila.unit_price){
                    //     this.fila.unit_price = parseFloat(this.fila.real_unit_price) + parseFloat((this.fila.utility/100) * this.fila.real_unit_price)
                    // }else{
                        this.fila.unit_price = parseFloat(this.fila.real_unit_price) + parseFloat(((this.fila.utility/100) * this.fila.real_unit_price))
                    // }
                }
            },
            save: function(){
                this.loading = true
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
                    this.fila.outputs_id = $routeParams.id
                    $http.post(G.apiUrl + '/' + this.name, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                }
                this.fila = {}
            }
        }

        
        // $scope.activate = activate();

        ////////////////

        var activate = function() {
            $scope.det.loading = false
            $scope.det.fila = {
                utility: Locations.list[Locations.get()].utility
            }
            $scope.det.get()
            $scope.rsc.get(function(data){
                // callback
                $scope.StockLocation.get(data.locations_id, $scope.rsc.byProduct)
            })
            // $scope.Suppliers.get()
        }
        activate();

        $scope.activate = activate;
    }
})(G, OutputsConfig, window.moneyFormatter);
