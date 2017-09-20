<div style="
max-height: 640px;
overflow: auto;
">
    <input type="text" ng-model="buscar" class="form-control" placeholder="Buscar...">
    <table class="table table-condensed table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Valor</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>
                    <input type="text" placeholder="Nuevo valor" ng-model="fila.value" capitalize class="form-control">
                </td>
                <td>
                    <button title="Crear nuevo valor" class="btn btn-success" ng-click="save(fila)"><i class="fa fa-plus"></i> </button>
                </td>
            </tr>
            <tr ng-repeat="l in list | filter: buscar" ng-switch on="l.state">
                <td ng-bind="l.id"></td>
                <td ng-switch-default>{{l.value}}</td>
                <td ng-switch-default>
                    <div class="btn-group">
                        <button class="btn btn-default" type="button" ng-click="edit(l)"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" type="button" ng-click="disables(l)"><i class="fa fa-trash"></i> </button>
                    </div>
                </td>
                <td ng-switch-when="edit">
                    <input type="text" ng-model="l.value" capitalize class="form-control">
                </td>
                <td ng-switch-when="edit">
                    <button class="btn btn-success" ng-click="save(l)"><i class="fa fa-save"></i> </button>
                </td>
            </tr>
        </tbody>
    </table>
</div>