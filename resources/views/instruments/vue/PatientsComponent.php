<template id="patients-component-template">
    <div>
        <router-link to="/patients/create" append>
            <button class="btn btn-success">
                <i class="fa fa-plus"></i> Crear
            </button>
        </router-link>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <!-- <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th></th> -->
                </tr>
            </thead>
            <tbody>
                <tr v-for="d in list.data">
                    <td>{{d.id}} </td>
                    <td>{{d.names}} </td>
                    <!-- <td>{{d.fam_names}} </td>
                    <td>{{d.dni}} </td>
                    <td>{{d.email}} </td>
                    <td>{{d.phone}} </td> -->
                    <td>
                        <div class="btn-group">
                            <a href="" class="btn btn-default" ><i class="fa fa-eye"></i> Ver</a>
                            <router-link class="btn btn-warning" :to="'/patients/edit/' + d.id"><i class="fa fa-edit"></i> Editar</router-link>
                            <a @click="remove(d.id)" class="btn btn-danger"><i class="fa fa-remove"></i> Eliminar</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <pagination :data="list" v-on:pagination-change-page="setPage"></pagination>
    </div>
</template>
<script>
const PatientsComponent = {
    template: '#patients-component-template',
    data () {
        return {
            list: {},
            page: 1,
        }
    },
    methods: {
        setPage (p) {
            this.page = p
            this.get()
        },
        remove (id) {
            if(confirm('Eliminar al registro ' + id)){
                this.$http.delete(LabAppConfig.apiUrl + '/clinic-patients/' + id).then(
                    res => {
                        this.get()
                    }
                )
            }
        },
        get () {
            console.log(this.list)
            this.$http.get(
                LabAppConfig.apiUrl + '/clinic-patients',
                {
                    params: { page: this.page }
                }
            ).then(
                res => {
                    // console.log(res.body)
                    this.list = res.body
                }
            )
        }
    },
    created () {
        this.get()
    }
}
</script>