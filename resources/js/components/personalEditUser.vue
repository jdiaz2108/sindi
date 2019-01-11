<template>
<div class="card pb-3">
    <div class="card-header"><strong class="card-title mb-3">Personal</strong></div>
    <div class="card-body">
        <p class="lead text-center font-weight-bold">Información general</p>
        <div class="row">

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Departamento de residencia:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default">
                                <div v-for="Departament in allDepartaments" v-if="dataPersonal.departament_adress_id == Departament.id">{{ Departament.name }}</div>
                            </label>
                        </div>
                        <div class="form-group" v-if="status == 'editar'">
                            <select @click="getCity()" v-model="dataPersonal.departament_adress_id" class="form-control" >
                                <option  v-for="Departament in allDepartaments" v-bind:value="Departament.id">{{ Departament.name }}</option>
                            </select>
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Ciudad de residencia:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default">
                                <div v-for="uniCity in City" v-if="dataPersonal.city_adress_id == uniCity.id">{{ uniCity.name }}</div>
                            </label>
                        </div>

                        <div class="form-group" v-if="status == 'editar'">
                            <select v-model="dataPersonal.city_adress_id" class="form-control" >
                                <option  v-for="uniCity in City" v-bind:value="uniCity.id">{{ uniCity.name }}</option>
                            </select>
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Direccion de vivienda:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default" for="personal_adress">{{dataPersonal.adress_personal}}</label>
                        </div>
                        <div v-if="status == 'editar'">
                            <input type="text" v-model="dataPersonal.adress_personal" class="form-control">
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5"><label>Teléfono fijo:</label></dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default" for="personal_adress">{{dataPersonal.phone_personal}}</label>
                        </div>
                        <div v-if="status == 'editar'">
                            <input type="text" v-model="dataPersonal.phone_personal" class="form-control">
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Nivel educativo:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="(status == 'ver' || level < 355)">
                            <label class="label label-default">
                            <div v-for="academicLevel in allAcademicLevel" v-if="dataPersonal.academic_level_id == academicLevel.id">{{ academicLevel.name }}</div>
                            </label>
                        </div>

                        <div class="form-group" v-if="(level >= 355 && status == 'editar')">
                            <select v-model="dataPersonal.academic_level_id" class="form-control" >
                                <option  v-for="academicLevel in allAcademicLevel" v-bind:value="academicLevel.id">{{ academicLevel.name }}</option>
                            </select>
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Estudiante activo:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="(status == 'ver' || level < 355)">
                            <label class="label label-default " for="studing">
                                <button v-if="dataPersonal.studing == true" type="button" class="btn btn-success">Si</button>
                                <button v-else type="button" class="btn btn-secondary">No</button>
                            </label>
                        </div>
                        <div v-if="(level >= 355 && status == 'editar')">
                        <v-switch :label="`Estudiante Activo: ${dataPersonal.studing}`" v-model="dataPersonal.studing" success color="green" class="m-0 p-0"></v-switch>
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Profesión:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default">
                                <div v-for="profession in allProfessions" v-if="dataPersonal.profession_id == profession.id">{{ profession.name }}</div>
                            </label>
                        </div>
                        <div class="form-group" v-if="status == 'editar'">
                            <select v-model="dataPersonal.profession_id" class="form-control" >
                                <option  v-for="profession in allProfessions" v-bind:value="profession.id">{{ profession.name }}</option>
                            </select>
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Estado civil:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default">
                                <div v-for="CivilStatus in allCivilStatus" v-if="dataPersonal.civil_status_id == CivilStatus.id">{{ CivilStatus.name }}</div>
                            </label>
                        </div>
                        <div class="form-group" v-if="status == 'editar'">
                            <select v-model="dataPersonal.civil_status_id" class="form-control" >
                                <option  v-for="CivilStatus in allCivilStatus" v-bind:value="CivilStatus.id">{{ CivilStatus.name }}</option>
                            </select>
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Hobbies:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default " for="hobbies">{{dataPersonal.hobbies}}</label>
                        </div>
                        <div v-if="status == 'editar'">
                            <input type="text" v-model="dataPersonal.hobbies" class="form-control">
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Descanso mental:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default " for="mental_rest">{{dataPersonal.mental_rest}}</label>
                        </div>
                        <div v-if="status == 'editar'">
                            <input type="text" v-model="dataPersonal.mental_rest" class="form-control">
                        </div>
                    </dd>
                </dl>
            </div>

            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5">Fecha de nacimiento:</dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default" for="birthdate">{{dataPersonal.birthdate}}</label>
                        </div>
                        <div v-if="status == 'editar'">
                            <v-dialog ref="dialog" v-model="modal" lazy full-width width="290px">
                                <v-text-field class="m-0 p-0" slot="activator" v-model="dataPersonal.birthdate" readonly></v-text-field>
                                <v-date-picker v-model="dataPersonal.birthdate" color="blue-grey darken-2" scrollable></v-date-picker>
                            </v-dialog>
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="col-md-12 col-lg-6">
                <dl class="row">
                    <dt class="col-md-12 col-lg-5"><label>Teléfono personal:</label></dt>
                    <dd class="col-md-12 col-lg-7">
                        <div v-if="status == 'ver'">
                            <label class="label label-default " for="cellphone_personal">{{dataPersonal.cellphone_personal}}</label>
                        </div>
                        <div v-if="status == 'editar'">
                            <input type="text" v-model="dataPersonal.cellphone_personal" class="form-control">
                        </div>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="dropdown-divider"></div>

        <div v-if="status == 'ver'">
        <a role="button" @click="status = 'editar'" class="btn btn-primary float-right text-white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
        </div>
        <div v-if="status == 'editar'">
        <a role="button" @click="status = 'ver'" class="btn btn-danger float-right text-white mx-1">Cancelar</a>
        <a role="button" @click="Update()" class="btn btn-warning float-right mx-1">Guardar</a>

        </div>
 </div>
        <div class="dropdown-divider"></div>
        <p class="lead text-center font-weight-bold">
        Hijos
        </p>


<div class="row justify-content-center">

    <!-- In Se hace un v-for para que se genere el modal del Calendario sin que se deforme dentro de la tabla -->
    <div v-for="Children in Childrens">
        <v-dialog ref="dialog" persistent v-model="Children.modal" lazy full-width width="290px">
            <v-date-picker v-model="Children.birthdate" color="blue-grey darken-2" scrollable>
                <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="Children.modal = false">Ok</v-btn>
            </v-date-picker>
        </v-dialog>
    </div>
    <!-- Fn Se hace un v-for para que se genere el modal del Calendario sin que se deforme dentro de la tabla -->

    <v-dialog ref="dialog" persistent v-model="NewChildren.modal" lazy full-width width="290px">
            <v-date-picker v-model="NewChildren.birthdate" color="blue-grey darken-2" scrollable>
                <v-spacer></v-spacer>
            <v-btn flat color="primary" @click="NewChildren.modal = false">Ok</v-btn>
            </v-date-picker>
        </v-dialog>

    <table class="table table-hover col-10 border rounded">
      <thead>
        <tr>
          <th scope="col">Nombre</th>
          <th scope="col">Fecha de Nacimiento</th>
          <th scope="col">
            <a role="button" @click="UStatusNewChildren()" class="btn btn-primary text-light"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Hijo</a>
            </th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="Children in Childrens">
            <template v-if="! Children.status">
                <td>{{Children.name}}</td>
                <td>{{Children.birthdate}}</td>
            </template>
            <template v-else>
                <td><input type="text" v-model="Children.name" class="form-control"></td>
                <td>
                <v-dialog persistent ref="dialog" v-model="Children.modal" lazy full-width width="290px">
                    <v-text-field class="m-0 p-0" slot="activator" v-model="Children.birthdate" readonly></v-text-field>
                                </v-dialog>
                            </td>
            </template>
          
          <td>
            <div v-if="! Children.status">
                <a role="button" @click="updateStatusIn(Children)" class="btn btn-warning mx-auto"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
            </div>
            <div v-else>
                <a role="button" @click="UpdateChildren(Children)" class="btn btn-success text-light mx-auto"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a>
                <a role="button" @click="cancelStatusIn(Children)" class="btn btn-dark text-light mx-auto"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
                <a role="button" @click="DeleteChildren(Children)" class="btn btn-danger text-white mx-auto"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Borrar</a>
            </div>
        </td>
        </tr>
        <tr v-if="NewChildren.status == true">
            <td><input type="text" v-model="NewChildren.name" class="form-control"></td>
            <td>
             <v-dialog persistent ref="dialog" v-model="NewChildren.modal" lazy full-width width="290px">
                    <v-text-field class="m-0 p-0" slot="activator" v-model="NewChildren.birthdate" readonly></v-text-field>
                                </v-dialog>
                            </td>
            <td>
            <a role="button" @click="CreateChildren()" class="btn btn-success text-light mx-auto"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a>
            <a role="button" @click="CStatusNewChildren()" class="btn btn-dark text-light mx-auto"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
        </td>
        </tr>
      </tbody>
    </table>

</div>

<div class="dropdown-divider"></div>
        <p class="lead text-center font-weight-bold">Contactos de emeregencia</p>
<div class="row justify-content-center">


<table class="table table-hover col-10 border rounded">
  <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Telefono</th>
      <th scope="col">
        <a role="button" @click="UStatusNewEContact()" class="btn btn-primary text-light"><i class="fa fa-plus" aria-hidden="true"></i>Añadir Contacto</a>
        </th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="eContact in eContacts">
        <template v-if="! eContact.status">
            <td>{{eContact.name}}</td>
            <td>{{eContact.phone}}</td>
        </template>
        <template v-else>
            <td><input type="text" v-model="eContact.name" class="form-control"></td>
            <td><input type="text" v-model="eContact.phone" class="form-control"></td>
        </template>
      
      <td>
        <div v-if="! eContact.status">
            <a role="button" @click="updateStatusIn(eContact)" class="btn btn-warning mx-auto"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
        </div>
        <div v-else>
            <a role="button" @click="UpdateEC(eContact)" class="btn btn-success text-light mx-auto"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a>
            <a role="button" @click="cancelStatusIn(eContact)" class="btn btn-dark text-light mx-auto"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
            <a role="button" @click="DeleteEC(eContact)" class="btn btn-danger text-white mx-auto"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Borrar</a>
        </div>
    </td>
    </tr>
    <tr v-if="eNewContact.status == true">
        <td><input type="text" v-model="eNewContact.name" class="form-control"></td>
        <td><input type="text" v-model="eNewContact.phone" class="form-control"></td>
        <td>
        <a role="button" @click="CreateEContact()" class="btn btn-success text-light mx-auto"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</a>
        <a role="button" @click="CStatusNewEContact()" class="btn btn-dark text-light mx-auto"><i class="fa fa-times" aria-hidden="true"></i> Cancelar</a>
    </td>
    </tr>
  </tbody>
</table>

</div>

</div>
</template>

<script>
    import Vuetify from 'vuetify'
    import Swal from "sweetalert2"
    export default {
        created(){
            this.getAllProfessions();
            this.getAllCivilStatus();
            this.getAllAcademicLevels();
            this.getAllDepartaments();
            this.getCity();
            this.geteContacts();
            this.getChildrens();
        },
        props: ['personal', 'level'],
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                dataPersonal: this.personal,
                allProfessions: null,
                allDepartaments: null,
                allCivilStatus: null,
                allAcademicLevel: null,
                City: null,
                status: 'ver',
                modal: false,
                eContacts: null,
                Childrens: null,
                eNewContact: {
                    name: null,
                    phone: null,
                    user_id: this.personal.id,
                    status: false,
                },
                NewChildren: {
                    name: null,
                    birthdate: null,
                    user_id: this.personal.id,
                    status: false,
                },
            }
        },
        methods: {
            // In Carga de Datos Generales por medio de Axios 
            getAllProfessions: function() {
                axios
                  .get('/Data/allProfession')
                  .then(response => {
                    this.allProfessions = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
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
            getAllAcademicLevels: function() {
                axios
                  .get('/Data/allAcademicLevel')
                  .then(response => {
                    this.allAcademicLevel = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            getAllCivilStatus: function() {
                axios
                  .get('/Data/allCivilStatus')
                  .then(response => {
                    this.allCivilStatus = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            getCity: function() {
                axios
                  .get('/Data/getCity/'+ this.personal.departament_adress_id)
                  .then(response => {
                    this.City = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            getChildrens: function() {
                axios
                  .get('/Data/getChildrens/'+ this.personal.user_id)
                  .then(response => {
                    this.Childrens = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            geteContacts: function() {
                axios
                  .get('/Data/getEmergencyContacts/'+ this.personal.user_id)
                  .then(response => {
                    this.eContacts = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            // Fn Carga de Datos Generales por medio de Axios 
            // In Update Status y Cancel Status el In significa Individual y Hace los cambios de estado en la edicion de Hijos y Contactos de Emergencia
            updateStatusIn: function(individal) { 
                Vue.set(individal, 'status', true);
            },
            cancelStatusIn: function(individal) {
                individal.status = false;
            },
            // Fn Update Status y Cancel Status el In significa Individual y Hace los cambios de estado en la edicion de Hijos y Contactos de Emergencia
             // In Funcionalidades de actualización y Eliminación de Hijos
            UpdateChildren: function(Children) {
                axios
                  .put('/Child/'+ Children.id, Children)
                      .then(response => {
                        this.getChildrens();
                        console.log(response);
                        this.Swal('Se han guardado los cambios');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
            DeleteChildren: function(Children) {
                axios
                  .delete('/Child/'+ Children.id, Children)
                      .then(response => {
                        this.getChildrens();
                        console.log(response);
                        this.Swal('Se ha eliminado el Contacto correctamente');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
            // Fn Funcionalidades de actualización y Eliminación de Hijos
            // In Funcionalidades de actualización y Eliminación de los contactos de emergencia
            UpdateEC: function(eContact) {
                axios
                  .put('/Ec/'+ eContact.id, eContact)
                      .then(response => {
                        this.geteContacts();
                        console.log(response);
                        this.Swal('Se han guardado los cambios');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
            DeleteEC: function(eContact) {
                axios
                  .delete('/Ec/'+ eContact.id, eContact)
                      .then(response => {
                        this.geteContacts();
                        console.log(response);
                        this.Swal('Se ha eliminado el Contacto correctamente');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
            // Fn Funcionalidades de actualización y Eliminación de los contactos de emergencia
            // In Los siguientes componentes son para la creacion de un nuevo Hijo asi como el cambio del estado para que aparezca y su creacion en la base de datos con axios
            UStatusNewChildren: function() {
                this.NewChildren.status = true;
            },
            CStatusNewChildren: function() {
                this.NewChildren.status = false;
            },
            CreateChildren: function() {
                axios
                  .post('/Child', this.NewChildren)
                      .then(response => {
                        this.NewChildren.name = null;
                        this.NewChildren.birthdate = null;
                        this.NewChildren.status = false;
                        this.getChildrens();
                        console.log(response);
                        this.Swal('Se ha agregado un nuevo Hijo');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
            // Fn Los siguientes componentes son para la creacion de un nuevo Hijo asi como el cambio del estado para que aparezca y su creacion en la base de datos con axios
            // In Los siguientes componentes son para la creacion de un nuevo contacto de emergencia asi como el cambio del estado para que aparezca y su creacion en la base de datos con axios
            UStatusNewEContact: function() {
                this.eNewContact.status = true;
            },
            CStatusNewEContact: function() {
                this.eNewContact.status = false;
            },
            CreateEContact: function() {
                axios
                  .post('/Ec', this.eNewContact)
                      .then(response => {
                        this.eNewContact.name = null;
                        this.eNewContact.phone = null;
                        this.eNewContact.status = false;
                        this.geteContacts();
                        console.log(response);
                        this.Swal('Se ha agregado un nuevo Contacto');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            },
            // Fn Los siguientes componentes son para la creacion de un nuevo contacto de emergencia asi como el cambio del estado para que aparezca y su creacion en la base de datos con axios
            // In Metodo de alerta con Sweet Alert, este componente es llamado dentro de los otros metodos
            Swal: function(texto) {
                Swal({
                          type: 'success',
                          title: texto,
                          showConfirmButton: false,
                          timer: 1500
                        })
            },
            // Fn Metodo de alerta con Sweet Alert, este componente es llamado dentro de los otros metodos
            // In Actualización de datos de usuario en la tabla de Employee
            Update: function() {
                axios
                  .put('/Em/'+this.dataPersonal.id, this.dataPersonal)
                      .then(response => {
                        this.status = 'ver';
                        console.log(response);
                        this.Swal('Se han guardado los cambios');
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            }
             // Fn Actualización de datos de usuario en la tabla de Employee
        }
    }
</script>