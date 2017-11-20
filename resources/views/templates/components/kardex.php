<div class="panel panel-default">
    <div class="panel-body">
        <product-row ng-if="$ctrl.product" product="$ctrl.product"></product-row>
        <product-row ng-if="Products.one" product="Products.one"></product-row>
        <hr>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th colspan="2">ENTRADAS</th>
                    <th colspan="2">SALIDAS</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>FECHA</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                    <th>CANTIDAD</th>
                    <th>PRECIO</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="k in rsc.kardex">
                    <td>
                        <a ng-show="k.type === 'ENTRADA'" href="@{{G.appUrl + '/inputs/edit/' + k.h_id}}" target="blank" ng-bind="k.h_id"></a>
                        <a ng-show="k.type === 'SALIDA'" href="@{{G.appUrl + '/outputs/edit/' + k.h_id}}" target="blank" ng-bind="k.h_id"></a>
                    </td>
                    <td ng-bind="k.datetime"></td>
                    <td class="text-right" ng-bind="k.input_quantity"></td>
                    <td class="text-right" ng-bind="html.moneyFormatter.format('PEN', k.input_price)"></td>
                    <td class="text-right" ng-bind="k.output_quantity"></td>
                    <td class="text-right" ng-bind="html.moneyFormatter.format('PEN', k.output_price)"></td>
                </tr>
                <tr>
                    <td colspan="6" ng-bind="rsc.msj"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>