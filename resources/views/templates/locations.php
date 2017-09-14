<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4 class="text-center">AREAS</h4>
        <button class="btn btn-success" ng-click="resource.showFormCreate()">Crear Nueva Area</button>
        <table class="table table-condensed table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <th title="PRODUCTOS CONFIGURADOS">PO</th>
                    <th>Utilidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="l in Locations.list track by l.id" ng-class="{ success: l.id == Locations.get() }" ng-if="l">
                    <td ng-bind="l.id"></td>
                    <td ng-bind="l.name"></td>
                    <td ng-bind="config.location.type[l.type]"></td>
                    <td class="text-center" ng-bind="l.po_quantity"></td>
                    <td ng-bind="l.utility"></td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning" ng-click="resource.showFormModal(l)"><i class="fa fa-edit"></i> </button>
                            <button class="btn btn-danger" ng-click="resource.delete(l)"><i class="fa fa-remove"></i> </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="modal fade" id="formModalLocations">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Formulario de Areas</h4>
                    </div>
                    <form ng-submit="resource.save()">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" ng-model="resource.fila.name" required class="form-control" maxlength="191" capitalize>
                            </div>
                            <div class="form-group">
                                <label for="">Tipo</label>
                                <select class="form-control" ng-model="resource.fila.type" required>
                                    <?php foreach(config('logistic.location.type') as $clave => $tipo){ ?>
                                    <option ng-value="<?= $clave ?>"><?= $tipo ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Utilidad</label>
                                <input type="text" class="form-control" required ng-model="resource.fila.utility">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>