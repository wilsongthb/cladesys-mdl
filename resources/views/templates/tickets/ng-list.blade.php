@extends('templates.layouts.container')

@section('content')
<input type="checkbox" ng-model="rsc.onlyCancelled" ng-change="rsc.get()"> Mostrar solo los cancelados
<table class="table table-hover table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>EMISOR</th>
            <th>REMITENTE</th>
            <th>VALOR</th>
            <th>SUBTOTAL</th>
            <th>UTILIDAD</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="t in rsc.list">
            <td ng-bind="t.id"></td>
            <td ng-bind="t.sender"></td>
            <td ng-bind="t.name"></td>
            <td class="text-right" title="@{{t.total_original}}" ng-bind="helpers.enSoles(t.total_original)"></td>
            <td class="text-right" title="@{{t.total}}" ng-bind="helpers.enSoles(t.total)"></td>
            <td class="text-right" title="@{{t.total_utility}}" ng-bind="helpers.enSoles(t.total_utility)"></td>
            <td>
                <a href="@{{G.apiUrl}}/tickets/@{{t.id}}/edit" class="label label-info"><i class="fa fa-info"></i> detalles</a>
                <span class="label label-success" ng-show="t.cancelled">Cancelado</span>
                <span ng-show="!t.cancelled" ng-click="helpers.deleteTicket(t.id)" class="label label-danger"><i class="fa fa-trash"></i> </span>
            </td>
        </tr>
        <tr>
            <th colspan="3" class="text-right">TOTAL</th>
            <td class="text-right" title="@{{rsc.total.total_original}}" ng-bind="helpers.enSoles(rsc.total.total_original)"></td>
            <td class="text-right" title="@{{rsc.total.total}}" ng-bind="helpers.enSoles(rsc.total.total)"></td>
            <td class="text-right" title="@{{rsc.total.total_utility}}" ng-bind="helpers.enSoles(rsc.total.total_utility)"></td>
        </tr>
    </tbody>
</table>
@endsection
