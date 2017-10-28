<template id="user-modules-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a class="btn btn-success" v-on:click="showCrear()">Crear</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Modulo</th>
                        <th>Tipo</th>
                        <th>Leer</th>
                        <th>Crear</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="um in modulos" >
                        <td>{{um.id}} </td>
                        <td>{{um.module}} </td>
                        <td>{{um.type}} </td>
                        <td>{{um.get}} </td>
                        <td>{{um.post}} </td>
                        <td>{{um.put}} </td>
                        <td>{{um.delete}} </td>
                        <th>
                            <div class="btn-group">
                                <a class="btn btn-warning" v-on:click="editar(um)"><i class="fa fa-edit"></i> </a>
                                <a class="btn btn-danger" v-on:click="eliminar(um.id)"><i class="fa fa-trash"></i> </a>
                            </div>
                        </th>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- <a class="btn btn-primary" data-toggle="modal" href='#edit-module-modal'>Trigger modal</a> -->
        <div class="modal fade" id="edit-module-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Modulo de usuario</h4>
                    </div>
                    <form v-on:submit.prevent="guardar()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Modulo</label>
                                <input type="text" class="form-control" v-model="reg.module" required>
                            </div>
                            <div class="form-group">
                                <label for="">Tipo</label>
                                <input type="text" class="form-control" v-model="reg.type">
                            </div>
                            <div class="form-group">
                                <label for="">PERMISOS</label>
                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <input type="checkbox" v-model="reg.get"> Leer
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <input type="checkbox" v-model="reg.post"> Crear
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <input type="checkbox" v-model="reg.put"> Editar
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <input type="checkbox" v-model="reg.delete"> Eliminar
                                    </div>
                                </div>
                            </div>
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
const UserModules = {
    template: '#user-modules-template',
    data () {
        return {
            user: {},
            modulos: {},
            reg: {},
        }
    },
    props: {
        id: {
            type: String,
            required: true
        }
    },
    methods: {
        leer () {
            this.$http.get(AppConfig.apiUrl + '/users')
            .then(
                res => {
                    this.user = res.body
                }
            )
            this.$http.get(AppConfig.apiUrl + '/user-modules/', {
                params: {
                    user_id: this.id
                }
            })
            .then(
                res => {
                    this.modulos = res.body
                }
            )
        },
        editar (um) {
            this.reg = um
            $('#edit-module-modal').modal('show')
        },
        showCrear () {
            this.reg = {}
            $('#edit-module-modal').modal('show')
        },
        eliminar (id) {
            if(confirm('Eliminar le modulo con id ' + id)){
                this.$http.delete(AppConfig.apiUrl + '/user-modules/' + id)
                .then(
                    res => {
                        this.leer()
                    }
                )
            }
        },
        guardar () {
            this.reg.user_id = this.id
            if(this.reg.id){
                this.$http.put(AppConfig.apiUrl + '/user-modules/' + this.reg.id, this.reg)
                .then(
                    res => {
                        $('#edit-module-modal').modal('hide')
                        this.reg = {}
                        this.leer()
                    }
                )
            }else{
                this.$http.post(AppConfig.apiUrl + '/user-modules', this.reg)
                .then(
                    res => {
                        $('#edit-module-modal').modal('hide')
                        this.reg = {}
                        this.leer()
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