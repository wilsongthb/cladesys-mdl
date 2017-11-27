@extends('templates.layouts.container')

@section('content')

<div class="jumbotron">
    <div class="container">
        <h1>VALOR TOTAL</h1>
        <p ng-bind="html.moneyFormatter.format('PEN', total())"></p>
    </div>
</div>

<table class="table table-condensed table-hover table-striped">
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Valor</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="i in InventoryService.list">
            <td ng-bind="i.product.name"></td>
            <td ng-bind="i.stock"></td>
            <td ng-bind="html.moneyFormatter.format('PEN', i.price)"></td>
            <td ng-bind="html.moneyFormatter.format('PEN', (i.stock * i.price))"></td>
        </tr>
    </tbody>
</table>

@endsection