<template id="users-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h1 class="text-center">USUARIOS</h1>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="u in data">
                        <td :title="u.created_at">{{u.id}} </td>
                        <td>{{u.name}} </td>
                        <td>{{u.email}} </td>
                        <td>
                            <div class="btn-group">
                                <router-link :to="'/user-locations/' + u.id" class="btn btn-primary"><i class="fa fa-book"></i> Areas</router-link>
                                <router-link :to="'/user-modules/' + u.id" class="btn btn-default"><i class="fa fa-book"></i> Modulos</router-link>
                                <a class="btn btn-warning" v-on:click="editar(u)"><i class="fa fa-edit"></i></a>
                                <a class="btn btn-danger" v-on:click="eliminar(u)"><i class="fa fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- <a class="btn btn-primary" data-toggle="modal" href='#user-edit-modal'>Trigger modal</a> -->
        <div class="modal fade" id="user-edit-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">USUARIO</h4>
                    </div>
                    <form v-on:submit.prevent="guardar()">
                        <div class="modal-body">
                            
                                <div class="form-group">
                                    <label for="">Nombre de Usuario</label>
                                    <input type="text" class="form-control" v-model="reg.name" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" class="form-control" v-model="reg.email" required>
                                </div>
                                <div class="form-group">
                                    
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</template>
<script>
const Users = {
    template: '#users-template',
    data () {
        return {
            reg: {},
            data: {},
            page: 1
        }
    },
    methods: {
        leer () {
            this.$http.get(AppConfig.apiUrl + '/users')
            .then(
                res => {
                    this.data = res.body
                }
            )
        },
        editar (u) {
            this.reg = u
            $('#user-edit-modal').modal('show')
            
        },
        guardar () {
            this.$http.put(AppConfig.apiUrl + '/users/' + this.reg.id, this.reg)
            .then(
                res => {
                    $('#user-edit-modal').modal('hide')
                    this.reg = {}
                }
            )
        },
        eliminar (u) {
            if(confirm('Intentar eliminar la usuario ' + u.name)){
                this.$http.delete(AppConfig.apiUrl + '/users/' + u.id)
                .then(
                    res => {
                        this.leer()
                    },
                    err => {
                        alert('No se puede eliminar, existen otros registros relacionados a este usuario y no se puede eliminar')
                    }
                )
            }
        }
    },
    created () {
        this.leer()
    }
}
</script>