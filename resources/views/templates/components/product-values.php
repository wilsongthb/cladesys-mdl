<ui-select ng-model="$ctrl.valueId">
    <ui-select-match>
        <div ng-bind="$select.selected.value"></div>
    </ui-select-match>
    <ui-select-choices repeat="item.id as item in ($ctrl.list | filter: $select.search) track by item.id">
        <div ng-bind="item.value"></div>
    </ui-select-choices>
</ui-select>