<template id="user-locations-template">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <a class="btn btn-success" v-on:click="showCrear()">Crear</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Area</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="um in modulos" >
                        <td>{{um.id}} </td>
                        <td>{{um.locations_name}} </td>
                        <th>
                            <div class="btn-group">
                                <!-- <a class="btn btn-warning" v-on:click="editar(um)"><i class="fa fa-edit"></i> </a> -->
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
                            <select class="form-control" v-model="reg.locations_id">
                                <option v-for="l in locations" :value="l.id">{{l.name}} </option>
                            </select>
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
const UserLocations = {
    template: '#user-locations-template',
    data () {
        return {
            user: {},
            modulos: {},
            reg: {},
            locations: []
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
            this.$http.get(AppConfig.apiUrl + '/user-locations', {
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
        // editar (um) {
        //     this.reg = um
        //     $('#edit-module-modal').modal('show')
        // },
        showCrear () {
            this.reg = {}
            $('#edit-module-modal').modal('show')
        },
        eliminar (id) {
            if(confirm('Eliminar el modulo con id ' + id)){
                this.$http.delete(AppConfig.apiUrl + '/user-locations/' + id)
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
                this.$http.put(AppConfig.apiUrl + '/user-locations/' + this.reg.id, this.reg)
                .then(
                    res => {
                        $('#edit-module-modal').modal('hide')
                        this.reg = {}
                        this.leer()
                    }
                )
            }else{
                this.$http.post(AppConfig.apiUrl + '/user-locations', this.reg)
                .then(
                    res => {
                        $('#edit-module-modal').modal('hide')
                        this.reg = {}
                        this.leer()
                    }
                )
            }
        },
        leerAreas () {
            this.$http.get(AppConfig.apiUrl + '/user-locations/all')
            .then(
                res => this.locations = res.body
            )
        }
    },
    created () {
        this.leer()
        this.leerAreas()
    }
}
</script>