<template id="doctors-create-component-template">
    <div>
        <h1>CREAR DOCTOR</h1>
        <form v-on:submit.prevent="onSubmit">
            <p ng-if="form.render">
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" v-model="reg.names" id="reg_names" required>
                    <label class="mdl-textfield__label" for="reg_names">Nombres</label>
                </div>
            </p>
            <p>
                <div class="mdl-textfield mdl-js-textfield">
                    <input class="mdl-textfield__input" type="text" v-model="reg.fam_names" id="reg_fam_names" required>
                    <label class="mdl-textfield__label" for="reg_fam_names">Apellidos</label>
                </div>
            </p>
            
            <!-- Raised disabled button -->
            <button 
                type="submit" 
                class="mdl-button mdl-js-button mdl-button--raised" 
                :disabled="form.sent">
                Button
            </button>
        </form>
    </div>
</template>
<script>
const DoctorsCreateComponent = {
    template: '#doctors-create-component-template',
    data () {
        return {
            reg: {},
            form: {
                sent: false,
                render:false,
            }
        }
    },
    created () {
        setTimeout(() => {
            this.form.render = true
            console.log("incompatbilidad")
        }, 200);
    },
    methods: {
        onSubmit () {
            this.form.sent = true
            this.$http.post(LabAppConfig.apiUrl + '/clinic-doctors', this.reg).then(
                res => {
                    console.log(res)
                },
                err => {
                    console.log("agg")
                }
            )
        }
    }
}
</script>