<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="text-center">RESUMEN DE MOVIMIENTOS - @{{Locations.list[Locations.get()].name}} </h1>
        <div class="row">
            <div class="col-md-12 form-group">
                <div class="form-inline">
                    <select class="form-control" ng-model="Resume.month" ng-change="Resume.get()">
                        <option value="1">ENERO</option>
                        <option value="2">FEBRERO</option>
                        <option value="3">MARZO</option>
                        <option value="4">ABRIL</option>
                        <option value="5">MAYO</option>
                        <option value="6">JUNIO</option>
                        <option value="7">JULIO</option>
                        <option value="8">AGOSTO</option>
                        <option value="9">SETIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <legend>PRODUCTOS</legend>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_id_quantity"></div>
                        <h3 class="panel-title">Productos Ingresados</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_od_quantity"></div>
                        <h3 class="panel-title">Productos Extraidos</h3>
                    </div>
                </div>
            </div>
            {{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.count_products"></div>
                        <h3 class="panel-title">Productos</h3>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.stock"></div>
                        <h3 class="panel-title">Stock</h3>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <legend>REGISTROS DE ENTRADAS Y SALIDAS</legend>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_id"></div>
                        <h3 class="panel-title">Registros de Entrada</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_od"></div>
                        <h3 class="panel-title">Registros de Salida</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="Resume.data.sum_details"></div>
                        <h3 class="panel-title">Registros</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <legend>VALOR</legend>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="html.enSoles(Resume.data.sum_id_subtotal)"></div>
                        <h3 class="panel-title">Valor Productos Ingresados</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="html.enSoles(Resume.data.sum_od_subtotal)"></div>
                        <h3 class="panel-title">Valor Productos Extraidos + Ganancia</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <div class="huge" ng-bind="html.enSoles(Resume.data.profit)"></div>
                        <h3 class="panel-title">Ganancias</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <legend>VALORES</legend>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ENTRADAS</th>
                            <th>SALIDAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in Resume.simpleList.lista">
                            <td ng-bind="item.title"> </td>
                            <td ng-bind="formatear(item.value_p_input)"> </td>
                            <td ng-bind="formatear(item.value_p_output)"> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>