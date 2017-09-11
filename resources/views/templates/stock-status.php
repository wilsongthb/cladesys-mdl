
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">STOCK DEL {{Locations.list[Locations.get()].name}} </h3>
        <input type="text" class="form-control" ng-model="buscar">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="6">PRODUCTO</th>
                    <th colspan="2">CONFIGURACION DE STOCK</th>
                    <th></th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Total entradas</th>
                    <th>Total salidas</th>
                    <th>Stock</th>
                    <th>Minimo</th>
                    <th>Permanente</th>
                    <th>Duracion</th>
                    <th>
                        Estado
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="l in rsc.list | filter: buscar">
                    <td ng-bind="l.p_id"></td>
                    <td ng-bind="l.p_name"></td>
                    <td ng-bind="l.p_categorie"></td>
                    <td ng-bind="l.sum_id_quantity"></td>
                    <td ng-bind="l.sum_od_quantity"></td>
                    <td ng-bind="l.stock"></td>
                    <td ng-bind="l.po_minimum"></td>
                    <td ng-bind="l.po_permanent"></td>
                    <td ng-bind="l.po_duration"></td>
                    <td>
                        <span class="label label-success" ng-if="!l.comprar && !l.urgente">OK</span>
                        <span class="label label-warning" ng-if="l.comprar || l.urgente">Comprar</span>
                        <span class="label label-danger" ng-if="l.urgente">Urgente</span>
                        <span title="{{l.od_updated_at}}" class="label label-warning" ng-if="l.days">Ultima salida hace {{l.days}} dias </span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
