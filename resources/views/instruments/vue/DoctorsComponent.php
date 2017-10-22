<template id="doctors-component-template">
    <div>
        <router-link to="/doctors/create" append>
            <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
                <i class="material-icons">add</i> Crear
            </button>
        </router-link>
        <table class="mdl-data-table mdl-js-data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>DNI</th>
                    <th>Email</th>
                    <th>Telefono</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="d in list.data">
                    <td>{{d.id}} </td>
                    <td>{{d.names}} </td>
                    <td>{{d.fam_names}} </td>
                    <td>{{d.dni}} </td>
                    <td>{{d.email}} </td>
                    <td>{{d.phone}} </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
const DoctorsComponent = {
    template: '#doctors-component-template',
    data () {
        return {
            list: {}
        }
    },
    created () {
        this.$http.get(LabAppConfig.apiUrl + '/clinic-doctors').then(
            res => {
                // console.log(res.body)
                this.list = res.body
            }
        )
    }
}
</script>