<template>
<div class="card col-8 m-5 mx-auto border-dark">

    <h3 class="card-header text-white text-center shadow py-4 blue-gradient rounded mx-auto w-75" style="margin-top: -25px; max-width: calc(100% - 40px);">
        Creación  Nuevo Usuario
    </h3>

    <div class="card-body px-lg-5 pt-0 mx-auto">
        <form class="border-light p-5 form-group" @submit.prevent="CreateNewUser()">

            <label for="textInput">Documento de Identificación:</label>
            <input type="text" v-model="NewUser.document" name="document" class="form-control" placeholder="Identificacion" v-bind:class="{'is-invalid': errors.errors.document}">
                <div v-if="errors.errors.document"  v-for="error in errors.errors.document" class="invalid-feedback">{{error}}</div>

            <input type="text" v-model="NewUser.name" name="name" class="form-control mt-4" placeholder="Nombres" v-bind:class="{'is-invalid': errors.errors.name}">
                <div v-if="errors.errors.name"  v-for="error in errors.errors.name" class="invalid-feedback">{{error}}</div>

            <input type="text" v-model="NewUser.last_name" class="form-control mt-2" placeholder="Apellidos" v-bind:class="{'is-invalid': errors.errors.last_name}">
                <div v-if="errors.errors.last_name"  v-for="error in errors.errors.last_name" class="invalid-feedback">{{error}}</div>

            <input type="email" v-model="NewUser.email" name="email" class="form-control mt-2" placeholder="E-mail" v-bind:class="{'is-invalid': errors.errors.email}" >
                <div v-if="errors.errors.email" v-for="error in errors.errors.email" class="invalid-feedback">{{error}}</div>

            <v-btn
                  :loading="loading"
                  :disabled="loading"
                  color="indigo"
                  @click="CreateNewUser()"
                  class="text-light my-5"
                  large
                >
                    Registrar Nuevo Usuario
                </v-btn>
        </form>
    </div>
</div>
</template>

<script>
    import Vuetify from 'vuetify'
    import Swal from "sweetalert2"
      export default {
        created(){
            this.getDocumento();
        },
    data () {
      return {
        errors: {
            errors: {},
        },
        loader: null,
        loading: false,
        NewUser: {
            name: null,
            last_name: null,
            email: null,
            document: null,
            document_type_id: null,
        },
        tipodocumento: null,
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
            CreateNewUser: function() {
                this.loader = 'loading';
                axios
                  .post('/U', this.NewUser)
                      .then(response => {
                        console.log(response);
                        window.location.href = '/U/' + response.data;
                        this.Swal('Creando Usuario');
                      })
                      .catch(error => {
                          this.errors = error.response.data;
                          console.log(error)
                        })
            },
            Swal: function(texto) {
                Swal({
                          type: 'success',
                          title: texto,
                          showConfirmButton: false,
                          timer: 1500
                        })
            },
        },
    watch: {
      loader () {
        const l = this.loader
        this[l] = !this[l]

        setTimeout(() => (this[l] = false), 3000)

        this.loader = null
      }
    }
  }
</script>