<span title="{{$ctrl.product.name}}">
    <span class="label label-default" ng-bind="$ctrl.product.id"></span>
    <span ng-bind="$ctrl.product.name"></span>
    <br>
    <span class="label label-default" ng-bind="$ctrl.product.brand"></span>
    <span class="label label-success" ng-bind="$ctrl.product.categorie"></span>
    <span 
        class="label label-warning" 
        ng-bind="$ctrl.product.packing + ' ' + $ctrl.product.units + ' ' + $ctrl.product.measurement"></span>
    <span class="label label-primary" ng-bind="$ctrl.product.code"></span>
    
</span>