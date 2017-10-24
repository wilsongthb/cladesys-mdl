<template id="doctors-edit-component-template">
    <div>
        <h1>EDITAR DOCTOR</h1>
        
        <div class="alert alert-success" v-show="form.success">
            <button type="button" class="close" v-on:click="form.success = false" aria-hidden="true">&times;</button>
            <strong>Exito</strong> Guardado en el sistema
        </div>
        
        <form v-on:submit.prevent="onSubmit">
            <div class="form-group">
                <label for="reg_names">Nombres</label>
                <input class="form-control" type="text" v-model="reg.names" id="reg_names" required>
            </div>
            <!-- <div class="form-group">
                <label for="reg_fam_names">Apellidos</label>
                <input class="form-control" type="text" v-model="reg.fam_names" id="reg_fam_names" required>
            </div> -->
            
            <!-- Raised disabled button -->
            <button 
                type="submit" 
                class="btn btn-default" 
                :disabled="form.sent">
                Guardar
            </button>
        </form>
    </div>
</template>
<script>
const DoctorsEditComponent = {
    template: '#doctors-edit-component-template',
    props: ['id'],
    data () {
        return {
            reg: {},
            form: {
                sent: false,
                success: false
            }
        }
    },
    created () {
        this.$http.get(LabAppConfig.apiUrl + '/clinic-doctors/' + this.id)
        .then(
            res => {
                this.reg = res.body
            }
        )
    },
    methods: {
        onSubmit () {
            this.form.sent = true
            this.$http.put(LabAppConfig.apiUrl + '/clinic-doctors/' + this.reg.id, this.reg).then(
                res => {
                    console.log(res)
                    this.form.success = true
                },
                err => {
                    console.log("agg")
                }
            )
        }
    }
}
</script>