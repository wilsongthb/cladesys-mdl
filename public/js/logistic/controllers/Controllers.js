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

        $scope.html = {
            kardexModal: {
                show: function(product){
                    $('#kardex-modal').modal('show')
                    this.product = product
                    console.log(this)
                },
            }
        }

        $('#kardex-modal').on('hidden.bs.modal', function(){
            console.log('jaja')
            $scope.html.kardexModal.product = false
        })
        
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
            DeleteUnselected: function(){
                var total = $scope.det.list.length
                var totalFilas = []
                for(var i in $scope.det.list){
                    var fila = $scope.det.list[i]
                    // if(fila.check){ totalFilas++ }
                    if(fila.check){ totalFilas.push(fila.id) }
                }

                if(confirm('Esta seguro(a), vas a eliminar a ' + totalFilas.length + ' registros')){
                    $http.put(G.apiUrl + '/requeriments-delete-list', totalFilas)
                    .then(
                        res => $scope.det.get()
                    )
                }
            },
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
            claveParaOrdenar: '',
            ordenarPor (val) {
                this.claveParaOrdenar = val
            },
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
            setOrdenacion: function (key) {
                this.list = [
                    ...this.list.filter(x => {
                        if(x.suppliers[key]){
                            return x.suppliers[key].status == 1
                        }else{
                            return false;
                        }
                    }),
                    ...this.list.filter(x => {
                        if(x.suppliers[key]){
                            return x.suppliers[key].status == 0
                        }else{
                            return true;
                        }
                    }),
                ]

                // console.log(this.list)
            },
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

                        // this.list.sort(x => {
                            
                        //     for(let sup of this.suppliers){
                                
                        //     }
                        // })

                        // for(let item of res.data.requeriment_details){
                        //     // console.log(item)

                        // }

                        // /** Mejora, ordenacion */
                        // let nuevaLista = [];
                        // for(let l in this.Suppliers){
                        //     let supplier = this.Suppliers[l]
                        //     for(let k in this.list){
                        //         let fila = this.list[k]
                        //         if(fila.suppliers === undefined){
                        //             fila.suppliers = {}
                        //         }
                        //         fila.suppliers[supplier.id] = this.quotations[fila.id] ? (this.quotations[fila.id][supplier.id] ? this.quotations[fila.id][supplier.id].status : false) : false
                        //         nuevaLista.push(fila)
                        //     }
                        // }
                        // // ordenar
                        // let laNuevaLista = []
                        // for(let l in this.Suppliers){
                        //     let sup = this.Suppliers[l]
                        //     laNuevaLista = [
                        //         ...laNuevaLista,
                        //         ...nuevaLista.filter(x => {
                        //             return x.suppliers[sup.id]
                        //         })
                        //     ]
                        // }
                        // /** los que no tienen proveedor */
                        // laNuevaLista = [
                        //     ...laNuevaLista,
                        //     ...nuevaLista.filter(x => {
                        //         for(let l in this.Suppliers){
                        //             let sup = this.Suppliers[l]
                        //             if(x.suppliers[sup.id]) return false
                        //         }
                        //         return true
                        //     })
                        // ]
                        // _.uniqBy(laNuevaLista, x => {
                        //     return x.id
                        // })
                        // console.log(laNuevaLista)
                        // this.nuevaLista = laNuevaLista
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

    EzOutputsController.$inject = ['$scope', 'StockLocation', '$http', 'Locations'];
    function EzOutputsController($scope, StockLocation, $http, Locations) {
        var vm = this;
        
        // $scope.Inventory = InventoryService
        $scope.StockLocation = StockLocation

        $scope.html = {
            moneyFormatter,
            showHistory: function(item){
                $scope.html.item = item
                $('#history-modal').modal('show')
                $scope.rsc.getHistory(item.products_id)
                // $scope.rsc.reg = {}
            },
            showKardex: function(item){
                $('#kardex-modal').modal('show')
                $scope.html.item = item
                $scope.rsc.getKardex(item.products_id)
                // $scope.rsc.reg = {}
            },
            registrarUso: function(item){
                $('#uso-modal').modal('show')
                $scope.html.item = item
                $scope.rsc.reg = {
                    products_id: item.products_id
                }
            }
        }

        $scope.G = G

        $scope.rsc = {
            reg: {},
            history: [],
            kardex: [],
            getHistory: function(product_id){
                $http.get(G.apiUrl + '/history-product/' + Locations.get() + '/' + product_id)
                .then(
                    res => {
                        this.history = res.data
                    }
                )
            },
            getKardex: function(product_id){
                $http.get(G.apiUrl + '/kardex/' + Locations.get() + '/' + product_id)
                .then(
                    res => {
                        this.kardex = res.data
                    }
                )
            },
            usoFinal: function(){
                this.reg.locations_id = Locations.get()
                $http.post(G.apiUrl + '/final-use', this.reg)
                .then(
                    res => {
                        // console.log(res)
                        activate()
                        $('#uso-modal').modal('hide')
                        
                    }
                )
                this.reg = {}
            }
        }

        activate();

        ////////////////

        function activate() { 
            // $scope.Inventory.get()
            $scope.StockLocation.get(Locations.get())
        }
    }
})(G);

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('ResumeController', ResumeController);

    ResumeController.$inject = ['$http', '$scope', 'LocationsStages', 'Locations'];
    function ResumeController($http, $scope, LocationsStages, Locations) {
        var vm = this;
        $scope.html = {
            enSoles: function(dinero){
                return moneyFormatter.format('PEN', dinero)
            }
        }
        $scope.Locations = Locations
        $scope.Resume = {
            get: function(){
                $http.get(G.apiUrl + '/location-resume/' + Locations.get())
                .then(
                    res => {
                        this.data = res.data
                    }
                )
            }
        }
        

        activate();

        ////////////////

        function activate() { 
            $scope.Resume.get();
        }
    }
})(G);

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('MoveResumeController', MoveResumeController);

    MoveResumeController.$inject = ['$http', '$scope', 'LocationsStages', 'Locations'];
    function MoveResumeController($http, $scope, LocationsStages, Locations) {
        var vm = this;
        $scope.html = {
            enSoles: function(dinero){
                return moneyFormatter.format('PEN', dinero)
            }
        }
        $scope.formatear = function(dinero) {
            return moneyFormatter.format('PEN', dinero)
        }
        $scope.Locations = Locations
        $scope.Resume = {
            year: 2018,
            month: 0,
            simpleList: {},
            get: function(){
                $http.get(
                    G.apiUrl
                    + '/stock-simple/'
                    + this.year 
                    + '/' 
                    + this.month 
                    + '/' + Locations.get()
                ).then(
                    res => {
                        this.simpleList = res.data

                        console.log(this)
                    })

                $http.get(G.apiUrl + '/location-move-resume/' + Locations.get(), {
                    params: {
                        year: this.year,
                        month: this.month
                    }
                })
                .then(
                    res => {
                        // res.data
                        this.data = {
                            // 'count_products': 0
                            'sum_id_quantity': res.data.inputs.quantity,
                            'sum_od_quantity': res.data.outputs.quantity,
                            'sum_id': res.data.inputs.quantity_details,
                            'sum_od': res.data.outputs.quantity_details,
                            'sum_details': res.data.inputs.quantity_details + res.data.outputs.quantity_details,
                            'sum_id_subtotal': res.data.inputs.sub_total,
                            'sum_od_subtotal': res.data.outputs.sub_total,
                            // 'stock': res.data
                            'profit': res.data.outputs.sub_total - res.data.outputs.real_result
                        }

                        console.log(this.data)
                    }
                )
            }
        }

        activate();

        ////////////////

        function activate() { 
            $scope.Resume.month = ((new Date()).getMonth() + 1).toString()
            $scope.Resume.get()
        }
    }
})(G);

(function(G) {
    'use strict';

    angular
        .module('logistic')
        .controller('TicketsController', TicketsController);

    TicketsController.$inject = ['$scope', '$http', 'Locations'];
    function TicketsController($scope, $http, Locations) {
        var vm = this;

        $scope.helpers = {
            enSoles: function(dinero){
                return moneyFormatter.format('PEN', dinero)
            },
            deleteTicket: function(tickets_id){
                if(confirm('Eliminar el registro ' + tickets_id)){
                    $scope.rsc.delete(tickets_id, function(data){
                        activate()
                    })
                }
            }
        }
        
        $scope.G = G
        
        $scope.rsc = {
            onlyCancelled: true,
            get: function(){
                var reqOptions = this.onlyCancelled ? { params: {'only-cancelled': true} } : {}
                $http.get(G.apiUrl + '/tickets-locations/' + Locations.get(), reqOptions)
                .then(
                    res => {
                        this.list = res.data.list
                        this.total = res.data.total
                    }
                )
            },
            delete: function(tickets_id, callback){
                $http.delete(G.apiUrl + '/tickets/' + tickets_id)
                .then(
                    res => {
                        callback(res.data)
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
        .controller('HistoryResumeController', HistoryResumeController);

    HistoryResumeController.$inject = ['$http', '$scope', 'LocationsStages', 'Locations'];
    function HistoryResumeController($http, $scope, LocationsStages, Locations) {
        var vm = this;
        // $scope.html = {
        //     enSoles: function(dinero){
        //         return moneyFormatter.format('PEN', dinero)
        //     }
        // }
        // $scope.Locations = Locations
        // $scope.Resume = {
        //     get: function(){
        //         $http.get(G.apiUrl + '/location-resume/' + Locations.get())
        //         .then(
        //             res => {
        //                 this.data = res.data
        //             }
        //         )
        //     }
        // }
        
        activate();

        ////////////////

        function activate() { 
            // $scope.Resume.get();
        }
    }
})(G);