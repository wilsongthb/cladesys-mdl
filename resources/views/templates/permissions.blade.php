
@extends('templates.layouts.container')


@section('content')

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="u in rsc.data.users">
            <td ng-bind="u.id"></td>
            <td ng-bind="u.name"></td>
            <td>
                <a class="btn btn-default" ng-click="dialogs.mostrarModalEditarPermisos(u)">
                    <i class="fa fa-edit"></i> Editar permisos
                </a>
            </td>
        </tr>
    </tbody>
</table>

@stop



<!-- <a class="btn btn-primary" data-toggle="modal" href='#modalUserPermissions'>Trigger modal</a> -->
<div class="modal fade" id="modalUserPermissions">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Permisos</h4>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>
