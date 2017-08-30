// TEST CONTROLLERS
(function () {
    'use strict';

    angular
        .module('logistic')
        .controller('Ctrl1Controller', Ctrl1Controller);

    Ctrl1Controller.$inject = ['$scope', 'myService', 'myFactory'];

    function Ctrl1Controller($scope, myService, myFactory) {
        var vm = this;

        $scope.resource = {
            myService,
            myFactory
        }

        activate();

        ////////////////

        function activate() {}
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

    InputsEditController.$inject = ['$routeParams', '$scope', '$http', 'Suppliers', '$window'];
    function InputsEditController($routeParams, $scope, $http, Suppliers, $window) {
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
                            alert('Bloqueado -_-');
                        }
                    )
                }
            }
        }

        $scope.detalle = {
            name: 'input-details',
            fila: {},
            list: [],
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
            copyToForm: function(fila){
                this.fila = {
                    ticket_type: fila.ticket_type,
                    ticket_number: fila.ticket_number,
                    suppliers_id: fila.suppliers_id,
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
            save: function(){
                if(this.fila.id){
                    this.fila.user_id = G.user.id
                    $http.put(G.apiUrl +  '/' + this.name + '/' + this.fila.id, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                    this.fila = {}
                }else{
                    this.fila.user_id = G.user.id
                    this.fila.inputs_id = $routeParams.id
                    $http.post(G.apiUrl + '/' + this.name, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                    this.fila = {}
                }
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

    OutputsEditController.$inject = ['$routeParams', '$scope', '$http', 'Suppliers', '$window', 'Inventory'];
    function OutputsEditController($routeParams, $scope, $http, Suppliers, $window, Inventory) {
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

        $scope.detalle = {
            name: 'output-details',
            fila: {},
            list: [],
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
            copyToForm: function(fila){
                this.fila = {
                    ticket_type: fila.ticket_type,
                    ticket_number: fila.ticket_number,
                    suppliers_id: fila.suppliers_id,
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
            save: function(){
                if(this.fila.id){
                    this.fila.user_id = G.user.id
                    $http.put(G.apiUrl +  '/' + this.name + '/' + this.fila.id, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                    this.fila = {}
                }else{
                    this.fila.user_id = G.user.id
                    this.fila.outputs_id = $routeParams.id
                    $http.post(G.apiUrl + '/' + this.name, this.fila)
                    .then(
                        res => {
                            activate();
                        }
                    )
                    this.fila = {}
                }
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.detalle.get()
            $scope.resource.get()
            $scope.Inventory.get()
            $scope.Suppliers.get()
        }
    }
})(G, OutputsConfig, window.moneyFormatter);
