<template>
    <div class="card ">
        <div class="card-header"><strong class="card-title mb-3">Laboral</strong></div>
        <div class="card-body">
            <p class="lead text-center font-weight-bold">Datos generales</p>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Cargo:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="position in allPositions" v-if="dataPersonal.position_id == position.id">{{ position.name }}</div>
                                </label>
                            </div>

                            <div class="form-group" v-if="status == 'editar'">
                                <select @click="GetDepend()" v-model="dataPersonal.position_id" class="form-control" >
                                    <option  v-for="position in allPositions" v-bind:value="position.id">{{ position.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Salario:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default" for="personal_adress">$ {{formatPrice(dataPersonal.salary)}}</label>
                            </div>
                            <div v-if="status == 'editar'">
                                <input type="text" v-model="dataPersonal.salary" class="form-control">
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5"><label for="sel1">Select list (select one):</label></dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="Departament in allDepartaments" id="sel1" v-if="dataPersonal.departament_id == Departament.id">{{ Departament.name }}</div>
                                </label>
                            </div>

                            <div class="form-group" v-if="status == 'editar'">
                                <select @click="getCity()" v-model="dataPersonal.departament_id" class="form-control" >
                                    <option  v-for="Departament in allDepartaments" v-bind:value="Departament.id">{{ Departament.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Ciudad:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="uniCity in City" v-if="dataPersonal.city_id == uniCity.id">{{ uniCity.name }}</div>
                                </label>
                            </div>

                            <div class="form-group" v-if="status == 'editar'">
                                <select v-model="dataPersonal.city_id" class="form-control" >
                                    <option  v-for="uniCity in City" v-bind:value="uniCity.id">{{ uniCity.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Número de cuenta:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default" for="personal_adress">{{dataPersonal.Bogota_bank_account_id}}</label>
                            </div>
                            <div v-if="status == 'editar'">
                                <input type="text" v-model="dataPersonal.Bogota_bank_account_id" class="form-control">
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                    <dt class="col-md-12 col-lg-5">Segmento:</dt>
                    <dd class="col-md-12 col-lg-7"><label class="label label-default " for="secment">segmento ??</label></dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Teléfono corporativo:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default" for="personal_adress">{{dataPersonal.cellphone_corporate}}</label>
                            </div>
                            <div v-if="status == 'editar'">
                                <input type="text" v-model="dataPersonal.cellphone_corporate" class="form-control">
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Email corporativo:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default" for="personal_adress">{{dataPersonal.email_corporate}}</label>
                            </div>
                            <div v-if="status == 'editar'">
                                <input type="text" v-model="dataPersonal.email_corporate" class="form-control">
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">Jefe directo:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <label class="label label-default " for="email_corporate">
                            {{getDepend}}
                            </label>
                        </dd>
                    </dl>
                </div>
            </div>
                <div class="dropdown-divider"></div>
                <p class="lead text-center font-weight-bold">Afiliaciones</p>
            <div class="row">
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">EPS:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="eps in allEps" v-if="dataPersonal.eps_id == eps.id">{{ eps.name }}</div>
                                </label>
                            </div>
                            <div class="form-group" v-if="status == 'editar'">
                                <select v-model="dataPersonal.eps_id" class="form-control" >
                                    <option  v-for="eps in allEps" v-bind:value="eps.id">{{ eps.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">CCF:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="ccf in allCcf" v-if="dataPersonal.ccf_id == ccf.id">{{ ccf.name }}</div>
                                </label>
                            </div>
                            <div class="form-group" v-if="status == 'editar'">
                                <select v-model="dataPersonal.ccf_id" class="form-control" >
                                    <option  v-for="ccf in allCcf" v-bind:value="ccf.id">{{ ccf.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">AFP:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="afp in allAfp" v-if="dataPersonal.afp_id == afp.id">{{ afp.name }}</div>
                                </label>
                            </div>
                            <div class="form-group" v-if="status == 'editar'">
                                <select v-model="dataPersonal.afp_id" class="form-control" >
                                    <option  v-for="afp in allAfp" v-bind:value="afp.id">{{ afp.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
                <div class="col-md-12 col-lg-6">
                    <dl class="row">
                        <dt class="col-md-12 col-lg-5">ARL:</dt>
                        <dd class="col-md-12 col-lg-7">
                            <div v-if="status == 'ver'">
                                <label class="label label-default">
                                    <div v-for="arl in allArl" v-if="dataPersonal.arl_id == arl.id">{{ arl.name }}</div>
                                </label>
                            </div>

                            <div class="form-group" v-if="status == 'editar'">
                                <select v-model="dataPersonal.arl_id" class="form-control" >
                                    <option  v-for="arl in allArl" v-bind:value="arl.id">{{ arl.name }}</option>
                                </select>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>

            <div v-if="(level >= 355 && status == 'ver')">
                <a  role="button" @click="status = 'editar'" class="btn btn-primary text-light float-right"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
            </div>
            <div v-if="status == 'editar'">
                <a role="button" @click="status = 'ver'" class="btn btn-danger float-right text-white mx-1">Cancelar</a>
                <a role="button" @click="Update()" class="btn btn-warning float-right mx-1">Guardar</a>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from "sweetalert2"
    export default {
        created(){
            this.getAllDepartaments();
            this.getCity();
            this.AllAfp();
            this.AllEps();
            this.AllArl();
            this.AllCcf();
            this.AllPositions();
            this.GetDepend();
        },
        props: ['personal', 'level'],
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                dataPersonal: this.personal,
                tipodocumento: null,
                allDepartaments: null,
                City: null,
                status: 'ver',
                allEps: null,
                allArl: null,
                allCcf: null,
                allAfp: null,
                allPositions: null,
                getDepend: null
            }
        },
        methods: {
            formatPrice(value) {
                let val = (value/1).toFixed(0).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },
            getAllDepartaments: function() {
                axios
                  .get('/Data/allDepartament')
                  .then(response => {
                    this.allDepartaments = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            getCity: function() {
                axios
                  .get('/Data/getCity/'+ this.personal.departament_id)
                  .then(response => {
                    this.City = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            AllAfp: function() {
                axios
                  .get('/Data/AllAfp')
                  .then(response => {
                    this.allAfp = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            AllCcf: function() {
                axios
                  .get('/Data/AllCcf')
                  .then(response => {
                    this.allCcf = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            AllArl: function() {
                axios
                  .get('/Data/AllArl')
                  .then(response => {
                    this.allArl = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            AllEps: function() {
                axios
                  .get('/Data/AllEps')
                  .then(response => {
                    this.allEps = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            AllPositions: function() {
                axios
                  .get('/Data/allPositions')
                  .then(response => {
                    this.allPositions = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            GetDepend: function() {
                axios
                  .get('/Data/getDepend/'+ this.dataPersonal.position_id)
                  .then(response => {
                    this.getDepend = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            Update: function() {
                axios
                  .put('/Em/'+this.dataPersonal.id, this.dataPersonal)
                      .then(response => {
                        this.status = 'ver';
                        console.log(response);
                         Swal({
                          type: 'success',
                          title: 'Se han Guardado los cambios',
                          showConfirmButton: false,
                          timer: 1500
                        })
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
        }
    }
</script>