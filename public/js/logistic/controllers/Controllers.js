// TEST CONTROLLERS
(function () {
    'use strict';

    angular
        .module('logistic')
        .controller('Ctrl1Controller', Ctrl1Controller);

    Ctrl1Controller.$inject = ['$scope', 'myService', 'myFactory', 'Products'];

    function Ctrl1Controller($scope, myService, myFactory, Products) {
        var vm = this;

        $scope.resource = {
            myService,
            myFactory,
            Products
        }

        activate();

        ////////////////

        function activate() {
            Products.get()
            $scope.Products = Products
        }
    }
})();
(function () {
    'use strict';

    angular
        .module('logistic')
        .controller('Ctrl2Controller', Ctrl2Controller);

    Ctrl2Controller.$inject = ['$scope', 'myService', 'myFactory'];

    function Ctrl2Controller($scope, myService, myFactory) {
        var vm = this;

        $scope.resource = {
            myService,
            myFactory
        }
        $scope.products_id = 14
        $scope.input_details_id = 45

        $scope.change = function () {
            console.log('change', arguments)
        }

        activate();

        ////////////////

        function activate() {}
    }
})();


// SUPPLIERS
const suppliersConfig = {
    name: 'suppliers',
    title: 'PROVEEDORES',
    // apiUrl: 
    api: {
        url: `${G.apiUrl}/suppliers`
    },
    urlCreate: `${G.appUrl}/suppliers/create`,
    urlEdit: `${G.appUrl}/suppliers/edit`
};
(function (GLOBAL, config) {
    'use strict';

    angular
        .module('logistic')
        .controller('SuppliersController', SuppliersController);

    SuppliersController.$inject = ['$scope', '$http', '$window'];

    function SuppliersController($scope, $http, $window) {
        var vm = this;

        $scope.config = JSON.parse(JSON.stringify(config))
        $scope.registros = []
        $scope.buscar = ''
        $scope.error = false
        // valores de paginacion
        $scope.page = 1
        $scope.per_page = 0
        $scope.page_to = 0
        $scope.total = 0

        // eliminar
        $scope.delete_id = 0

        $scope.buscarEnter = function (keyCode) {
            // console.log(keyCode)
            if (keyCode === 13) {
                $scope.leer()
            }
        }
        $scope.leer = function () {
            $http.get(
                // url
                `${config.api.url}`,
                // config
                {
                    params: {
                        search: $scope.buscar,
                        page: $scope.page
                    }
                }
            ).then(
                // success
                function (response) {
                    $scope.registros = response.data.data
                    $scope.per_page = response.data.per_page
                    $scope.page_to = response.data.to
                    $scope.total = response.data.total
                },
                // error
                function (response) {
                    $scope.error = true
                }
            )
        }
        $scope.eliminar = function (id) {
            if ($window.confirm(`Eliminar al registro con ID ${id}`)) {
                $http.delete(
                    // url
                    `${config.api.url}/${id}`
                ).then(
                    // success
                    function (response) {
                        $scope.leer()
                    },
                    // error
                    function (response) {
                        $scope.error = true
                    }
                )
            }
        }


        activate();

        ////////////////

        function activate() {
            $scope.leer()
        }
    }
})(G, suppliersConfig);
(function(GLOBAL, suppliersConfig) {
    'use strict';

    angular
        .module('logistic')
        .controller('SuppliersCreateController', SuppliersCreateController);

    SuppliersCreateController.$inject = ['$scope', '$http', '$location', '$window'];
    function SuppliersCreateController($scope, $http, $location, $window) {
        var vm = this;

        $scope.error = false;
        $scope.config = JSON.parse(JSON.stringify(suppliersConfig))
        $scope.config.title = 'REGISTRAR PROVEEDOR'
        $scope.registro = {}
    
        $scope.guardar = function(){
            $scope.registro.user_id = GLOBAL.user.id
            $http.post(
                // url
                `${suppliersConfig.api.url}`, 
                // data
                $scope.registro, 
                // config
                {}
            ).then(
                // success
                function(response){
                    // $location
                    
                    $window.alert(`
                        Guardado con exito!
                    `);
                    $location.path(`/${$scope.config.name}`)
                    // $location
                    // $location.path();
                },
                // error
                function(response){
                    $scope.error = true
                }
            )
        }

        activate();

        ////////////////

        function activate() { }
    }
})(G, suppliersConfig);
(function(GLOBAL, suppliersConfig) {
    'use strict';

    angular
        .module('logistic')
        .controller('SuppliersEditController', SuppliersEditController);

    SuppliersEditController.$inject = ['$scope', '$http', '$location', '$routeParams'];
    function SuppliersEditController($scope, $http, $location, $routeParams) {
        var vm = this;

        // valores iniciales
        $scope.error = false
        $scope.config = JSON.parse(JSON.stringify(suppliersConfig))
        $scope.config.title = 'EDITAR PROVEEDOR'
        // al editar ---  nombre del recurso,  id
        $http.get(G.apiUrl + '/suppliers/' + $routeParams.id).then(
            // success
            function(response){
                $scope.registro = response.data
                // $scope.registro.user_id = GLOBAL.user.id
            },
            // error
            function(response){
                // console.log(`${GLOBAL.url}/logistic/ng/${$scope.config.name}`)
                $location.path('notfound')
                // $location.path(`${$scope.config.name}`)
            }
        )
        ///////////////////////////////////////////////////////////////7
    
        $scope.guardar = function(){
            $scope.registro.user_id = GLOBAL.user.id
            $http.put(
                // url
                `${suppliersConfig.api.url}/${$routeParams.id}`, 
                // data
                $scope.registro, 
            ).then(
                // success
                function(response){
                    $location.path(`/${$scope.config.name}`)
                },
                // error
                function(response){
                    $scope.error = true
                }
            )
        }

        activate();

        ////////////////

        function activate() { }
    }
})(G, suppliersConfig);

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

    InputsController.$inject = ['$scope', '$http', '$window', 'Locations'];
    function InputsController($scope, $http, $window, Locations) {
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
                locations_id: Locations.get()
            },
            error: false,
            save: function(){
                this.fila.user_id = G.user.id
                this.fila.type = 1 // ENTRADA
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
                    total += fila.subtotal
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

    OutputsEditController.$inject = ['$routeParams', '$scope', '$http', 'Suppliers', '$window', 'Inventory', 'Locations'];
    function OutputsEditController($routeParams, $scope, $http, Suppliers, $window, Inventory, Locations) {
        var vm = this;

        // datos para las fechas
        $scope.dateOptions = {
            // dateDisabled: disabled,
            formatYear: 'yy',
            // maxDate: new Date(2020, 5, 22),
            // minDate: new Date(),
            startingDay: 1
        };
        $scope.pop = false;
        $scope.pop1 = false;

        $scope.Suppliers = Suppliers

        $scope.Inventory = Inventory

        $scope.config = G.config
        
        $scope.rsc = {
            fila: {},
            get: function(){
                $http.get(G.apiUrl + '/' + Config.name + '/' + $routeParams.id).then(
                    res => {
                        this.fila = res.data
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
            total: function(){
                let total = 0
                for(let i in this.list){
                    let fila = this.list[i]
                    total += fila.subtotal
                }
                return total
            },
            edit: function(fila){
                this.fila = fila
                this.fila.expiration = new Date(this.fila.expiration)
                this.fila.fabrication = new Date(this.fila.fabrication)
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
            // getRealPrice: function(products_id){
            //     $http.get(G.apiUrl + '/real-price/' + Locations.get() + '/' + products_id)
            //     .then(
            //         res => {
            //             this.fila.real_price = res[0].real_price
            //         }
            //     )
            // },
            getRealPriceId: function(item){
                var input_details_id = item.id
                this.fila.stock = item.stock
                this.fila.quantity = 0
                // console.log(input_details_id)
                // return 

                $http.get(G.apiUrl + '/real-price-id/' + Locations.get() + '/' + input_details_id)
                .then(
                    res => {
                        this.fila.real_price = res.data[0].real_price
                        this.calculateUnitPrice()
                    }
                )
            },
            calculateUnitPrice: function(){
                this.fila.unit_price = this.fila.real_price + ((this.fila.utility/100) * this.fila.real_price)
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
                    // this.fila = {}
                }
                this.fila = {}
            }
        }

        activate();

        ////////////////

        function activate() {
            $scope.det.loading = false
            $scope.det.fila = {
                utility: Locations.list[Locations.get()].utility
            } 
            $scope.det.get()
            $scope.rsc.get()
            $scope.Inventory.get()
            $scope.Suppliers.get()
        }
    }
})(G, OutputsConfig, window.moneyFormatter);


// STOCK
(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('StockLocationController', StockLocationController);

    StockLocationController.$inject = ['$http', '$scope', 'Locations'];
    function StockLocationController($http, $scope, Locations) {
        var vm = this;

        $scope.Locations = Locations
        
        $scope.rsc = {
            list: [],
            get: function(){
                $http.get(G.apiUrl + '/stock/' + Locations.get()).then(
                    res => {
                        this.list = res.data
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G);
(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('StockLocationPoController', StockLocationPoController);

    StockLocationPoController.$inject = ['$http', '$scope', 'Locations'];
    function StockLocationPoController($http, $scope, Locations) {
        var vm = this;

        $scope.Locations = Locations
        
        $scope.rsc = {
            list: [],
            get: function(){
                $http.get(G.apiUrl + '/stock-po/' + Locations.get()).then(
                    res => {
                        this.list = res.data
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G);
(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('InventoryGeneralController', InventoryGeneralController);

    InventoryGeneralController.$inject = ['$http', '$scope', 'Locations'];
    function InventoryGeneralController($http, $scope, Locations) {
        var vm = this;

        $scope.Locations = Locations
        
        $scope.rsc = {
            list: [],
            get: function(){
                $http.get(G.apiUrl + '/inventory').then(
                    res => {
                        this.list = res.data
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G);
(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('InventoryController', InventoryController);

    InventoryController.$inject = ['$http', '$scope', 'Locations'];
    function InventoryController($http, $scope, Locations) {
        var vm = this;

        $scope.Locations = Locations

        $scope.G = G
        
        $scope.rsc = {
            agrupar: true,
            list: [],
            get: function(){
                if(this.agrupar){
                    $http.get(G.apiUrl + '/inventory-grouped/' + Locations.get()).then(
                        res => {
                            this.list = res.data
                        }
                    )
                }else{
                    $http.get(G.apiUrl + '/inventory/' + Locations.get() + '/1').then(
                        res => {
                            this.list = res.data
                        }
                    )
                }
                
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G);
(function(G, moment) {
    'use strict';

    angular
        .module('logistic')
        .controller('StockStatusController', StockStatusController);

    StockStatusController.$inject = ['$http', '$scope', 'Locations'];
    function StockStatusController($http, $scope, Locations) {
        var vm = this;
        
        $scope.Locations = Locations
        
        $scope.rsc = {
            list: [],
            get: function(){
                $http.get(G.apiUrl + '/stock-status/' + Locations.get()).then(
                    res => {
                        // this.list = res.data
                        for(let i in res.data){
                            let fila = res.data[i]
                            this.list[this.list.length] = status(fila)
                        }
                    }
                )
            }
        }

        function status(stts){
            stts.urgente = (stts.stock < stts.po_minimum) ? true : false;
            stts.comprar = (stts.stock < stts.po_permanent) ? true : false;
            if(stts.po_minimum === 0 && stts.po_permanent === 0){
                // console.log(stts.od_updated_at)
                let e = moment(stts.od_updated_at)
                let t = moment(new Date())
                let diff = t.diff(e, 'days')
                // console.log(diff)
                stts.days = diff
                stts.urgente = diff > stts.po_duration - 30 ? true : false; 
                stts.comprar = diff > stts.po_duration - 60 ? true : false;
                if(!stts.od_updated_at){
                    // stts.od_updated_at = 
                    stts.days = 0
                    stts.urgente = true; 
                    stts.comprar = false;
                }
            }
            return stts
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G, window.moment);


//REQUERIMENTS
const RequerimentsConfig = {
    name: 'requeriments',
    createUrl: G.appUrl + '/requeriments/create',
    editUrl: G.appUrl + '/requeriments/edit',
    quotationsUrl: G.appUrl + '/quotations/edit',
    comparisonUrl: G.appUrl + '/comparison/edit',
};
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('RequerimentsController', RequerimentsController);

    RequerimentsController.$inject = ['$scope', '$http', '$window', 'Locations'];
    function RequerimentsController($scope, $http, $window, Locations) {
        var vm = this;
        
        $scope.config = Config
        $scope.g_config = G.config

        $scope.rsc = {
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
                        // console.log(res)
                        this.data = res.data
                    },
                    res => { // error
                        this.error = res
                    }
                )
            },
            delete: function(id){
                if($window.confirm('Eliminar el registro con id:' + id)){
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
            $scope.rsc.get()
        }
    }
})(G, RequerimentsConfig);
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('RequerimentsCreateController', RequerimentsCreateController);

    RequerimentsCreateController.$inject = ['$scope', 'Locations', '$http', '$location'];
    function RequerimentsCreateController($scope, Locations, $http, $location) {
        var vm = this;
        
        $scope.Locations = Locations
        $scope.rsc = {
            fila: {
                locations_id: Locations.get()
            },
            save: function(){
                this.fila.user_id = G.user.id
                $http.post(G.apiUrl + '/' + Config.name, this.fila)
                .then(
                    res => {
                        $location.replace()
                        $location.path(Config.name + '/edit/' + res.data.id)
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { }
    }
})(G, RequerimentsConfig);
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('RequerimentsEditController', RequerimentsEditController);

    RequerimentsEditController.$inject = ['$scope', '$http', 'Locations', '$routeParams', '$window', 'Products'];
    function RequerimentsEditController($scope, $http, Locations, $routeParams, $window, Products) {
        var vm = this;

        $scope.$routeParams = $routeParams

        $scope.config = Config

        $scope.Products = Products

        $scope.dialogs = {
            toExcel: function () {
                // console.log(XLSX)
                var tbl = document.getElementById('productosRequeridos');
                var wb = XLSX.utils.table_to_book(tbl);
                // console.log(saveAs)
                // console.log(wb)
                /* bookType can be any supported output type */
                var wopts = { bookType: 'xlsx', bookSST: false, type: 'binary' };

                var wbout = XLSX.write(wb, wopts);

                function s2ab(s) {
                    var buf = new ArrayBuffer(s.length);
                    var view = new Uint8Array(buf);
                    for (var i = 0; i != s.length; ++i) view[i] = s.charCodeAt(i) & 0xFF;
                    return buf;
                }

                /* the saveAs call downloads a file on the local machine */
                saveAs(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), "ordenDeCotizacion.xlsx");
            }
        }

        $scope.det = {
            list: [],
            buttonAdd: false,
            name: 'requeriment-details',
            fila: {
                products_id: null
            },
            buscar: '',
            get: function(){
                $http.get(G.apiUrl + '/' + this.name, {
                    params: {
                        id: $routeParams.id,
                        // page: this.list.current_page,
                        // search: this.buscar
                    }
                }).then(
                    res => {
                        this.list = res.data
                    }
                )
            },
            agregarRequeridos: function(){
                this.buttonAdd = true
                $http.post(G.apiUrl + '/' + this.name + '/add-all-req', {
                    requeriments_id: $routeParams.id,
                    locations_id: Locations.get()
                }).then(
                    res => {
                        
                        activate();
                    }
                )
            },
            edit: function(d){
                this.fila = d
            },
            delete: function(d){
                if($window.confirm('Desea eliminar el registro ' + d.id)){
                    $http.delete(G.apiUrl + '/' + this.name + '/' + d.id)
                    .then(
                        res => {
                            activate();
                        }
                    )
                }
            },
            save: function(){
                this.fila.user_id = G.user.id
                if(this.fila.id){
                    $http.put(G.apiUrl + '/' + this.name + '/' + this.fila.id, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                }else{
                    this.fila.requeriments_id = $routeParams.id
                    $http.post(G.apiUrl + '/' + this.name, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                }
            }
        }

        $scope.rsc = {
            fila: {},
            save: function(){
                $http.put(G.apiUrl + '/' + Config.name, this.fila).then(
                    res => {

                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.det.get()
            $scope.det.fila = {}
            $scope.det.buttonAdd = false
        }
    }
})(G, RequerimentsConfig);

// quotations
const QuotationsConfig = {
    name: 'requeriments',
    editUrl: G.appUrl + '/quotations/edit',
    requerimentUrl: G.appUrl + '/requeriments/edit',
    comparisonUrl: G.appUrl + '/comparison/edit',
};
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('QuotationsController', QuotationsController);

    QuotationsController.$inject = ['$scope', '$http', '$window', 'Locations'];
    function QuotationsController($scope, $http, $window, Locations) {
        var vm = this;
        
        $scope.config = Config
        $scope.g_config = G.config

        $scope.rsc = {
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
                        // console.log(res)
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
            $scope.rsc.get()
        }
    }
})(G, QuotationsConfig);
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('QuotationsEditController', QuotationsEditController);

    QuotationsEditController.$inject = ['$scope', '$http', 'Suppliers', '$routeParams', '$window', '$route'];
    function QuotationsEditController($scope, $http, Suppliers, $routeParams, $window, $route) {
        var vm = this;

        $scope.$routeParams = $routeParams
        $scope.enSoles = function(dinero){
            return moneyFormatter.format('PEN', dinero)
        }
        $scope.config = Config
        $scope.Suppliers = Suppliers
        $scope.rsc = {
            temp: {},
            dialogs: {
                addSuppliers: function(){
                    $('#addSuppliers').modal('show')
                }
            }
        }
        $scope.det = {
            list: [],
            quotations: {},
            Suppliers: {},
            get: function(){
                $http.get(G.apiUrl + '/quotations', { params: { id: $routeParams.id}})
                .then(
                    res => { // success
                        this.list = res.data.requeriment_details
                        
                        for(let i in res.data.suppliers){
                            let fila = res.data.suppliers[i]
                            this.Suppliers[fila.id] = fila
                        }

                        for(let j in res.data.quotations){
                            let fila = res.data.quotations[j]
                            if(!this.quotations[fila.requeriment_details_id]){
                                this.quotations[fila.requeriment_details_id] = {}
                                this.quotations[fila.requeriment_details_id][fila.suppliers_id] = fila
                            }else
                                this.quotations[fila.requeriment_details_id][fila.suppliers_id] = fila
                        }
                    }
                )
            },
            save: function(q, d_id = -1, s_id = -1){
                q.user_id = G.user.id
                if(q.id){
                    $http.put(G.apiUrl + '/quotations/' + q.id, q)
                    .then(
                        res => {
                            q.edit = false
                        }
                    )
                }else{
                    q.requeriment_details_id = d_id
                    q.suppliers_id = s_id
                    $http.post(G.apiUrl + '/quotations', q)
                    .then(
                        res => {
                            q.edit = false
                        }
                    )
                }
                
            },
            addSupplier: function(s){
                this.Suppliers[s.id] = s
                $('#addSuppliers').modal('hide')
            },
            removeSupplier: function(s){
                if($window.confirm('Borrar Proveedor, \nborrara tambien sus Cotizaciones')){
                    $http.delete(G.apiUrl + '/quotations/remove-supplier', {
                        params: { 
                            requeriments_id: $routeParams.id,
                            suppliers_id: s.id
                        },
                    })
                    .then(
                        res => {
                            // activate();
                            // setTimeout(function(){
                            //     activate();
                            // }, 2000)
                            $route.reload()
                        }
                    )
                }
            },
            editQuotation: function(requeriments_id, suppliers_id){
                // console.log('gogo')
                if(!this.quotations[requeriments_id]){
                    this.quotations[requeriments_id] = []
                }
                if(!this.quotations[requeriments_id][suppliers_id]){
                    this.quotations[requeriments_id][suppliers_id] = {}
                }
                this.quotations[requeriments_id][suppliers_id].edit = true
                setTimeout(function() {
                    // console.log("agg", 'q_' + requeriments_id + '_' + suppliers_id)
                    document.getElementById('q_' + requeriments_id + '_' + suppliers_id).focus()
                }, 200);

            }
        }

        activate();

        ////////////////

        function activate() { 
            Suppliers.get()
            $scope.det.get()
            $scope.Suppliers.get()
        }
    }
})(G, QuotationsConfig);

// COMPARAZIONES
const ComparisonConfig = {
    name: 'requeriments', // use to api resource,
    editUrl: G.appUrl + '/comparison/edit',
    requerimentUrl: G.appUrl + '/requeriments/edit',
    quotationsUrl: G.appUrl + '/quotations/edit',
};
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('ComparisonController', ComparisonController);

    ComparisonController.$inject = ['$scope', 'Locations', '$http'];
    function ComparisonController($scope, Locations, $http) {
        var vm = this;

        $scope.config = Config
        $scope.g_config = G.config

        $scope.rsc = {
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
                        // console.log(res)
                        this.data = res.data
                    },
                    res => { // error
                        this.error = res
                    }
                )
            },
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G, ComparisonConfig);
(function(G, Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('ComparisonEditController', ComparisonEditController);

    ComparisonEditController.$inject = ['$scope', '$http', '$routeParams'];
    function ComparisonEditController($scope, $http, $routeParams) {
        var vm = this;

        $scope.enSoles = function(dinero){
            return moneyFormatter.format('PEN', dinero)
        }
        $scope.config = Config
        $scope.$routeParams = $routeParams
        $scope.det = {
            list: [],
            quotations: {},
            Suppliers: {},
            selectMoreCheap: function(){
                this.list = []
                $http.put(G.apiUrl + '/quotations/select-more-cheap', {
                    id: $routeParams.id
                })
                .then(
                    res => activate()
                )
            },
            get: function(){
                $http.get(G.apiUrl + '/quotations', { params: { id: $routeParams.id}})
                .then(
                    res => { // success
                        this.list = res.data.requeriment_details
                        
                        for(let i in res.data.suppliers){
                            let fila = res.data.suppliers[i]
                            this.Suppliers[fila.id] = fila
                        }

                        for(let j in res.data.quotations){
                            let fila = res.data.quotations[j]
                            fila.status = fila.status === 1 ? true : false
                            if(!this.quotations[fila.requeriment_details_id]){
                                this.quotations[fila.requeriment_details_id] = {}
                                this.quotations[fila.requeriment_details_id][fila.suppliers_id] = fila
                            }else
                                this.quotations[fila.requeriment_details_id][fila.suppliers_id] = fila
                        }
                    }
                )
            },
            save: function(q, d_id = -1, s_id = -1){
                q.user_id = G.user.id
                if(q.id){
                    $http.put(G.apiUrl + '/quotations/' + q.id, q)
                    .then(
                        res => {
                            q.edit = false
                        }
                    )
                }else{
                    q.requeriment_details_id = d_id
                    q.suppliers_id = s_id
                    $http.post(G.apiUrl + '/quotations', q)
                    .then(
                        res => {
                            q.edit = false
                        }
                    )
                }
                
            },
            // addSupplier: function(s){
            //     this.Suppliers[s.id] = s
            //     $('#addSuppliers').modal('hide')
            // },
            // removeSupplier: function(s){
            //     if($window.confirm('Borrar Proveedor, \nborrara tambien sus Cotizaciones')){
            //         $http.delete(G.apiUrl + '/quotations/remove-supplier', {
            //             params: { 
            //                 requeriments_id: $routeParams.id,
            //                 suppliers_id: s.id
            //             },
            //         })
            //         .then(
            //             res => {
            //                 // activate();
            //                 // setTimeout(function(){
            //                 //     activate();
            //                 // }, 2000)
            //                 $route.reload()
            //             }
            //         )
            //     }
            // }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.det.get()
        }
    }
})(G, ComparisonConfig);
// purchase¿
(function(G, ComparisonConfig) {
    'use strict';

    angular
        .module('logistic')
        .controller('PurchaseController', PurchaseController);

    PurchaseController.$inject = ['$scope', '$http', 'Locations'];
    function PurchaseController($scope, $http, Locations) {
        var vm = this;
        
        $scope.dialogs = {
            showModalSuppliers: function(requeriments_id){
                $('#modalSupplierSelect').modal('show')
                $scope.rsc.getSuppliers(requeriments_id)
                this.requeriments_id = requeriments_id
            }
        }
        $scope.ComparisonConfig = ComparisonConfig
        $scope.G = G

        $scope.rsc = {
            data: {}, // respuesta de la base de datos
            suppliers: [],
            per_page: G.config.per_page,
            page: 1,
            search: '',
            error: false,
            get: function(){
                $http.get(G.apiUrl + '/requeriments', {
                    params: {
                        search: this.search, 
                        page: this.page, 
                        per_page: this.per_page,
                        locations_id: Locations.get()
                    }
                }).then(
                    res => { // success
                        // console.log(res)
                        this.data = res.data
                    },
                    res => { // error
                        this.error = res
                    }
                )
            },
            getSuppliers: function(requeriments_id){
                $http.get(G.apiUrl + '/quotations/select-suppliers', {
                    params: {id: requeriments_id}
                }).then(
                    res => this.suppliers = res.data
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G, ComparisonConfig);

(function(Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('UsersController', UsersController);

    UsersController.$inject = ['$scope', '$http'];
    function UsersController($scope, $http) {
        var vm = this;

        $scope.permissions = Config.config.permissions
        // $scope.permissions = {}
        // for(let i in Config.config.permissions){
        //     $scope.permissions[i] = 
        // }
        
        $scope.rsc= {
            modifyPermission: function(user, permission){
                // console.log(user.permissions[permission])
                if(!user.permissions[permission].value){
                    console.log("quitar")

                    let p = user.permissions[permission]
                    let permission_id = p.id

                    $http.delete(Config.url + '/permissions/' + permission_id).then(
                        res => activate()
                    )
                }else{
                    console.log("agregar")
                    $http.post(Config.url + '/permissions', {
                        user_id: user.id,
                        permission
                    }).then(
                        res => activate()
                    )
                }
            },
            get: function(){
                $http.get(Config.url + '/users').then(
                    res => {
                        // console.log(res)
                        this.list =  {}
                        for(let i in res.data.users){
                            let fila = res.data.users[i]
                            fila.permissions = []
                            this.list[fila.id] = fila
                        }
                        for(let i in res.data.permissions){
                            let fila = res.data.permissions[i]
                            fila.value = true
                            // fila.permissions = []
                            // this.list[fila.id] = fila
                            this.list[fila.user_id].permissions[fila.permission] = fila

                        }

                        // this.list =  {}
                        // for(let i in res.data.users){
                        //     let fila = res.data.users[i]
                        //     this.list[fila.id] = fila
                        // }
                        // this.list = res.data.users
                        


                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G);

(function(Config) {
    'use strict';

    angular
        .module('logistic')
        .controller('PermissionsController', PermissionsController);

    PermissionsController.$inject = ['$scope', '$http'];
    function PermissionsController($scope, $http) {
        var vm = this;
        
        $scope.dialogs = {
            mostrarModalEditarPermisos: function(user){
                $('#modalUserPermissions').modal('show');
                
            }
        }
        $scope.rsc= {
            get: function(){
                $http.get(Config.url + '/users').then(
                    res => {
                        this.data = res.data
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.rsc.get()
        }
    }
})(G);

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('EzOutputsController', EzOutputsController);

    EzOutputsController.$inject = ['$scope'];
    function EzOutputsController($scope) {
        var vm = this;
        

        activate();

        ////////////////

        function activate() { }
    }
})(G);