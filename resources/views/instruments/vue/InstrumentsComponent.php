<template id="instrument-component-template">
    <div>
        <h1>INSTRUMENTAL</h1>
        
        <form v-on:submit.prevent="onSubmit">
            
            <div class="row">
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                    <div class="form-group">
                        <label for="">Nombre del Instrumento/Producto *</label>
                        <v-select
                            placeholder="Buscar Products"    
                            :debounce="250"
                            :on-search="getProducts"
                            :options="products"
                            :on-change="productOnSelect"
                            label="name"
                        ></v-select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Cantidad</label>
                        <input type="number" v-model="reg.quantity" class="form-control" placeholder="1">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="">Doctor *</label>
                <v-select
                    placeholder="Buscar Doctores"
                    :debounce="250"
                    :on-search="getDoctors"
                    :options="doctors"
                    :on-change="doctorOnSelect"
                    label="names"
                ></v-select>
            </div>
            <div class="form-group">
                <label for="">Doctor Encargado de recoger el instrumental</label>
                <v-select
                    placeholder="Buscar Doctores"
                    :debounce="250"
                    :on-search="getDoctors"
                    :options="doctors"
                    :on-change="doctorCollectorOnSelect"
                    label="names"
                ></v-select>
            </div>
            <div class="form-group">
                <label for="">Paciente</label>
                <v-select
                    placeholder="Buscar Paciente"
                    :debounce="250"
                    :on-search="getPatients"
                    :options="patients"
                    :on-change="patientOnSelect"
                    label="names"
                ></v-select>
            </div>
            
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Movimiento *</label>
                        <select class="form-control" v-model="reg.status">
                            <?php foreach(Config('dev.instrument_history.status') as $key => $value){ ?>
                                <option value="<?= $key ?>"><?= $value ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Fecha de entrega</label>
                        <div class="input-group">
                            <div class="input-group-addon btn" v-on:click="entregaHoy()">Hoy</div>
                            <input type="text" v-model="reg.charge" class="form-control" placeholder="DD/MM/AAAA">    
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="">Fecha de devolución</label>
                        <div class="input-group">
                            <div class="input-group-addon btn" v-on:click="devuelveHoy()">Hoy</div>
                            <input type="text" v-model="reg.deliver" class="form-control" placeholder="DD/MM/AAAA">    
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Instrumento</th>
                    <th>Doctor</th>
                    <th>Movimiento</th>
                    <th>Paciente</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
    </div>
</template>
<script>
const InstrumentsComponent = {
    template: '#instrument-component-template',
    data() {
        return {
            products: [],
            doctors: [],
            patients: [],
            reg: {}
        }
    },
    methods: {
        entregaHoy () {
            let today = new Date()
            this.reg.charge = today.getDate() + '/' + today.getMonth() + '/' + today.getFullYear()
            // this.reg.charge = "2"
        },
        devuelveHoy () {
            let today = new Date()
            this.reg.deliver = today.getDate() + '/' + today.getMonth() + '/' + today.getFullYear()
            // this.reg.charge = "2"
        },
        onSubmit () {
            this.$http.post(LabAppConfig.apiUrl + '/instrument-history', this.regs)
            .then(
                res => {

                    console.log(res)
                }
            )
        },
        productOnSelect (val) {
            this.reg.products_id = val.id
        },
        getProducts(search) {
            this.$http.get(LabAppConfig.apiUrl +  '/products', {
                params: {
                    search: search
                }
            }).then(resp => {
                this.products = resp.body.data
            })
        },
        doctorOnSelect (val) {
            this.reg.clinic_doctors_id = val.id
        },
        doctorCollectorOnSelect (val) {
            this.reg.clinic_doctors_id_collector = val.id
        },
        getDoctors (search) {
            this.$http.get(LabAppConfig.apiUrl +  '/clinic-doctors', {
                params: {
                    search: search
                }
            }).then(resp => {
                this.doctors = resp.body.data
            })
        },
        patientOnSelect (val) {
            this.reg.clinic_patients_id = val.id
        },
        getPatients (search) {
            this.$http.get(LabAppConfig.apiUrl +  '/clinic-patients', {
                params: {
                    search: search
                }
            }).then(resp => {
                this.patients = resp.body.data
            })
        }
    },
    created () {
        this.getProducts()
        this.getDoctors()
        this.getPatients()
    }
}
</script>