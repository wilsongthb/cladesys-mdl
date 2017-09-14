
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h3 class="text-center">STOCK DEL {{Locations.list[Locations.get()].name}} </h3>
        <input type="text" class="form-control" ng-model="buscar">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoria</th>
                    <th>Total entradas</th>
                    <th>Total salidas</th>
                    <th>Stock</th>
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
                </tr>
            </tbody>
        </table>
    </div>
</div>
