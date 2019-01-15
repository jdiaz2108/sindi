<template>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-12">
                    <div class="card shadow" style="border-radius:25px;">

                        <div class="card-body text-center m-5">
                            <img src="/images/resources/logo_base.svg" class="img-fluid p-3"/>
                            <h1 class="text-primary">Bienvenido</h1>

                            <form method="POST" class="align-middle form-group" @submit.prevent>
                                <input type="hidden" name="_token" :value="csrf">

                                <div class="row">
                                    <template v-if="loginType === 'id'">

                                            <h5 class="text-secondary mx-auto text-center col-8">Ingresa tu usuario</h5>

                                            <div class="form-group" id="logEmail"></div>

                                            <div class="form-group col-md-8 mx-auto" >
                                                <select name="document_type" id="document_type" class="form-control" v-model="selected">
                                                    <option v-for="tdocument in tipodocumento" :value="tdocument.id" selected>{{ tdocument.name }}</option>
                                                </select>
                                            </div>


                                            <div class="form-group col-md-8 mx-auto">
                                                <input v-model="documento" name="document" type="text" class="form-control" @keypress.enter="getCorreo()" required ref="document">
                                            </div>

                                            <div class="col-md-8 text-center mx-auto">
                                                <button type="button" class="btn btn-primary" @click="getCorreo()">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                            </div>

                                    </template>

                                    <template v-if="loginType === 'password'">
                                       <!--      ({{setFocus()}}) -->
                                            <h4 class="text-secondary mx-auto text-center col-8">{{ correo.name }}</h4>

                                            <h5 class="text-secondary mx-auto text-center col-8">Ingresa tu Contraseña</h5>




                                            <div class="form-group col-md-8 mx-auto">
                                                <input type="password" class="form-control" @keypress.enter="tryLogin()" v-model="password" required autofocus>
                                            </div>




                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-primary btn-lg" @click="tryLogin()">Iniciar Sesión</button>
                                            </div>

                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-secondary" @click="loginChange()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
                                            </div>

                                            <div class="jumbotron border p-3 mt-5 mx-auto">
                                                <div class="container">
                                                    <h5 class="py-2">¿Olvidaste tu contraseña?</h5>
                                                    <button type="button" class="btn btn-danger btn" @click="recoveryPassword()">Recuperar Contraseña</button>
                                                </div>
                                            </div>

                                    </template>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    </main>
</template>

<script>
    import Swal from "sweetalert2"
    export default {
        created(){
            this.getDocumento();
        },
        mounted(){ 
            this.setFocus(); 
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                errors: {
                    errors: {
                        email: [],
                        password: []
                    },
                },
                tipodocumento: null,
                selected: 1,
                documento: null,
                correo: {
                    name: 'nombre',
                    email: null
                },
                loginType: 'id',
                password: null,
            }
        },
        methods: {
            setFocus: function()
            {
              this.$refs.document.focus();
            },
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
            getCorreo: function() {
                axios
                  .get('/getCorreo/'+ this.documento)
                  .then(response => {
                    this.correo = response.data
                    this.loginType = 'password'
                  })
                .catch(error => {
                    this.errors = error.response.data;
                        this.Swal(this.errors.error, 'error');
                    console.log(error)
                    })
            },
            loginChange: function() {
                    this.loginType = 'id'
            },
            tryLogin: function() {
                axios.post('/login', {
                    csrf: this.csrf,
                    email: this.correo.email,
                    password: this.password
                  })
                  .then(function (response) {
                    console.log(response);
                    window.location.href = '/';
                    
                  })
                    .catch(error => {
                        this.errors = error.response.data;
                            if (this.errors.errors.email) {
                                this.Swal(this.errors.errors.email[0], 'error');
                            }
                            if (this.errors.errors.password) {
                                this.Swal(this.errors.errors.password[0], 'error');
                            }
                        console.log(error)
                        })


            },
            recoveryPassword: function() {
                axios.post('/password/email', {
                    email: this.correo.email,
                  })
                  .then(function (response) {
                    console.log(response);
                  })
                    .catch(error => {
                        this.errors = error.response.data;
                            if (this.errors.errors.email) {
                                this.Swal(this.errors.errors.email[0], 'error');
                            }
                            if (this.errors.errors.password) {
                                this.Swal(this.errors.errors.password[0], 'error');
                            }
                        console.log(error)
                        }),
                    this.Swal('Revisa tu correo electronico ' + this.correo.email, 'info');


            },
            Swal: function(texto, type) {
                Swal({
                        type: type,
                        title: texto,
                        showConfirmButton: false,
                        timer: 1500
                    })
            },

        }
    }
</script>