<!-- <div ng-controller="Ctrl1Controller">
    <input type="text" ng-model="resource.myService.id">
    <input type="text" ng-model="resource.myFactory.id">
    <pre>{{resource}} </pre>
</div>
 -->
<div ng-controller="Ctrl2Controller">
    <input type="text" ng-model="resource.myService.id">
    <input type="text" ng-model="resource.myFactory.id">
    <pre>{{resource}} </pre>
    <hr>
    <!-- <pre>{{ this | json }} </pre> -->
    <pre>{{products_id}} </pre>

    <product-selector products-id="products_id" ps-on-change="change()"></product-selector>
    <!-- <product-values name-model="brands" value-id="xd"></product-values> -->
</div>



<!-- <product-options></product-options> -->