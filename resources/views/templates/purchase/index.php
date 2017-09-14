<div ng-if="rsc.error">
    <div class="alert alert-danger">
        <button type="button" class="close" ng-click="rsc.error = false" aria-hidden="true">&times;</button>
        <strong>ERROR:</strong> Error en el servidor, error de conexión
    </div>
</div>
<div class="row">
    <div class="x_panel">
        <div class="x_content">
            <div class="row">
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <!-- <a ng-href="{{config.createUrl}}"><button class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</button></a> -->
                </div>

                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <h3 class="text-center">ORDEN DE COMPRA</h3>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="input-group">
                        <input type="text" class="form-control" ng-model="rsc.search" ng-model-options="{debounce: 1000}" ng-change="rsc.get()" placeholder="Escribe...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" ng-click="rsc.get()">Buscar</button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ALMACEN</th>
                                <th>ESTADO</th>
                                <!-- <th>TIPO</th> -->
                                <th>PRODUCTOS</th>
                                <!-- <th>VALOR</th> -->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="d in rsc.data.data" title="Fecha de creacion: {{d.created_at}} ">
                                <td ng-bind="d.id"></td>
                                <td ng-bind="d.locations_name"></td>
                                <td ng-bind="g_config.order.status[d.status]"></td>
                                <!-- <td ng-bind="g_config.outputs.type[d.type]"></td> -->
                                <td ng-bind="d.total_details"></td>
                                <td></td>
                                <td ng-bind="d.measurement"></td>
                                <td>
                                    <a href="" title="Generar orden de compra" ng-click="dialogs.showModalSuppliers(d.id)"><button type="button" class="btn btn-default"><i class="fa fa-money"></i> </button></a>
                                    <a href="" title="Ingresar como entrada" ng-click="" class="btn btn-success"><i class="fa fa-arrow-circle-down"></i> </a>
                                    <!-- <button ng-if="d.status === 1" ng-click="rsc.delete(d.id)" type="button" class="btn btn-danger"><i class="fa fa-trash"></i> </button> -->
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <p>
                        Pagina:
                        <input type="number" class="custom-input" ng-model="rsc.page" ng-model-options="{debounce: 1000}" ng-change="rsc.get()">
                    </p>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    Total: {{rsc.data.total}}
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    Paginas: {{rsc.data.last_page}}
                </div>
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <p>
                        Cantidad por pagina:
                        <input type="number" class="custom-input" ng-model="rsc.per_page" ng-model-options="{debounce: 1000}" ng-change="rsc.get()">
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>


<a class="btn btn-primary" data-toggle="modal" href='#modalSupplierSelect'>Trigger modal</a>
<div class="modal fade" id="modalSupplierSelect">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Selecciona un Proveedor</h4>
            </div>
            <div class="modal-body">

                <div class="list-group">
                    <a target="blank" ng-repeat="s in rsc.suppliers" href="{{G.appUrl + '/purchase-order'}}/{{dialogs.orders_id}}/{{s.id}} " class="list-group-item">{{s.company_name}} {{s.contact_name}} 
                        <span class="badge">{{s.count_q}} </span>
                    </a>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
