<div class="container">
    <div class="row">
        <h3 class="text-center">{{config.title}} </h3>
        <form class="col-xs-12 col-sm-12 col-md-12 col-lg-12" ng-submit="guardar()">
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <legend>Información Basica (requerida)</legend>
                    <div class="form-group">
                        <label>Nombre de Contacto *</label>
                        <input class="form-control" type="text" ng-model="registro.contact_name" required maxlength="191">
                    </div>

                    <div class="form-group">
                        <label>Pais *</label>
                        <input class="form-control" type="text" ng-model="registro.country" capitalize maxlength="191" required>
                    </div>
                    <div class="form-group">
                        <label>Region *</label>
                        <input class="form-control" type="text" ng-model="registro.region" capitalize maxlength="191" required>
                    </div>
                    <div class="form-group">
                        <label>Numero de Telefono *</label>
                        <input class="form-control" type="text" ng-model="registro.phone" maxlength="191" required>
                    </div>
                    <div class="form-group">
                        <label>Banco *</label>
                        <input class="form-control" type="text" ng-model="registro.bank" capitalize maxlength="150" required>
                    </div>
                    <div class="form-group">
                        <label>Numero de cuenta bancaria *</label>
                        <input class="form-control" type="text" ng-model="registro.account_number" maxlength="191" required>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <legend>Información Complementaria</legend>
                    <div class="form-group">
                        <label>Razon Social</label>
                        <input class="form-control" type="text" ng-model="registro.company_name" capitalize maxlength="191">
                    </div>
                    <div class="form-group">
                        <label>Tipo de documento</label>
                        <select 
                            class="form-control"
                            ng-model="registro.doc_type">
                            <?php foreach(config('logistic.doc.type') as $key => $doc){ ?>
                                <option ng-value="<?= $key ?>"><?= $doc ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Numero de DNI/RUC</label>
                        <input class="form-control" type="text" ng-model="registro.identify" maxlength="18">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input class="form-control" type="text" ng-model="registro.address" maxlength="191">
                    </div>
                    <div class="form-group">
                        <label>Codigo Postal</label>
                        <input class="form-control" type="text" ng-model="registro.postal_code" maxlength="191">
                    </div>
                    <div class="form-group">
                        <label>Pagina Web</label>
                        <input class="form-control" type="text" ng-model="registro.home_page" maxlength="191">
                    </div>
                    <div class="form-group">
                        <label>Correo Electronico</label>
                        <input class="form-control" type="text" ng-model="registro.email" maxlength="191">
                    </div>
                    <div class="form-group">
                        <label>Observaciones</label>
                        <textarea class="form-control" ng-model="registro.observation" maxlength="191" rows="2"></textarea>
                    </div>
                    
                    <!-- products_stock -->
                </div>
            </div>
            <!--mensaje de error-->
            <div class="alert alert-danger" ng-show="error">
                <button type="button" class="close" ng-click="error = false" aria-hidden="true">&times;</button>
                <strong>ERROR:</strong> Ocurrio un error :'(  , contacte a su administrador 
            </div>
            <div class="form-group">
                <button class="btn btn-success">Guardar</button>
            </div>
        </form>
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="alert alert-info" title="Si, todos son requeridos XD">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Información:</strong> Los campos con * son requeridos para guardar el registro
            </div>
        </div>
    </div>
    <hr>
</div>