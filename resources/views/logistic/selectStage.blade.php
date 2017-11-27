<div class="modal fade" id="select-locations-stage">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">SELECCIONAR ETAPA</h4>
            </div>
            <div class="modal-body">
                <div class="list-group">
                    <a href="" class="list-group-item" ng-class="{ active: LocationsStages.stage === 'nostage' }" ng-click="LocationsStages.noStage()"> SIN ETAPA</a>
                    <a ng-repeat="l in LocationsStages.list" href="" class="list-group-item" ng-class="{ active: LocationsStages.stage.id === l.id }" ng-bind="l.name" ng-click="LocationsStages.set(l)"></a>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Guardar Cambios</button> -->
            </div>
        </div>
    </div>
</div>