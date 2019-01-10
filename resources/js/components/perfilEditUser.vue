<template>
    <div class="card" id="detailsCard">
        <div class="card-header">
            <label class="label label-default align-baseline font-weight-bold">Información básica</label>
                <a v-if="status == 'ver'" role="button" @click="status = 'editar'" class="btn btn-primary float-right text-white"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
            <div v-if="status == 'editar'">
                <a role="button" @click="status = 'ver'" class="btn btn-danger float-right text-white mx-1">Cancelar</a>
                <a role="button" @click="Update()" class="btn btn-warning float-right mx-1">Guardar</a>
            </div>
        </div>
        <div class="card-body" id="detailsBody">
            <dl class="row my-0">
                <dt class="col-md-12 col-lg-12"><label>Nombres:</label></dt>
                <dd class="col-md-12 col-lg-12">
                    <div v-if="status == 'ver'">
                        <label class="label label-default" for="name">{{dataUser.name}}</label>
                    </div>
                    <div v-if="status == 'editar'">
                        <input type="text" v-model="dataUser.name" class="form-control">
                    </div>
                </dd>
            </dl>
            <dl class="row my-0">
                <dt class="col-md-12 col-lg-12"><label>Apellidos:</label></dt>
                <dd class="col-md-12 col-lg-12">
                    <div v-if="status == 'ver'">
                        <label class="label label-default" for="name">{{dataUser.last_name}}</label>
                    </div>
                    <div v-if="status == 'editar'">
                        <input type="text" v-model="dataUser.last_name" class="form-control">
                    </div>
                </dd>
            </dl>
            <dl class="row my-0">
                <dt class="col-md-12 col-lg-12"><label>Tipo de documento:</label></dt>
                <dd class="col-md-12 col-lg-12">
                    <div v-if="status == 'ver'">
                        <label class="label label-default">
                            <div v-for="tDocumento in tipodocumento" v-if="dataUser.document_type_id == tDocumento.id">{{ tDocumento.name }}</div>
                        </label>
                    </div>

                    <div class="form-group" v-if="status == 'editar'">
                        <select v-model="dataUser.document_type_id" class="form-control" >
                            <option  v-for="tDocumento in tipodocumento" v-bind:value="tDocumento.id">{{ tDocumento.name }}</option>
                        </select>
                    </div>
                </dd>
            </dl>
            <dl class="row my-0">
                <dt class="col-md-12 col-lg-12"><label>Documento:</label></dt>
                <dd class="col-md-12 col-lg-12">
                    <div v-if="status == 'ver'">
                        <label class="label label-default" for="document">{{dataUser.document}}</label>
                    </div>
                    <div v-if="status == 'editar'">
                        <input type="text" v-model="dataUser.document" class="form-control">
                    </div>
                </dd>
            </dl>
            <dl class="row my-0">
                <dt class="col-md-12 col-lg-12"><label>Email:</label></dt>
                <dd class="col-md-12 col-lg-12">
                    <div v-if="status == 'ver'">
                        <label class="label label-default" for="email">{{dataUser.email}}</label>
                    </div>
                    <div v-if="status == 'editar'">
                        <input type="text" v-model="dataUser.email" class="form-control">
                    </div>
                </dd>
            </dl>
            <dl class="row my-0">
                <dt class="col-md-12 col-lg-12"><label>Permisos:</label></dt>
                <dd class="col-md-12 col-lg-12"><label class="label label-default " for="profile_id">$user->profile->name</label></dd>
            </dl>
        </div>
    </div>
</template>

<script>
    import Swal from "sweetalert2"
    export default {
        created(){
            this.getDocumento();
        },
        props: ['user', 'level'],
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                dataUser: this.user,
                tipodocumento: null,
                status: 'ver'
            }
        },
        methods: {
            getDocumento: function() {
                axios
                  .get('/Data/tiposDocumento')
                  .then(response => {
                    this.tipodocumento = response.data
                  })
                  .catch(error => {
                    console.log(error)
                  })
            },
            Update: function() {
                axios
                  .put('/U/'+this.dataUser.id, this.dataUser)
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