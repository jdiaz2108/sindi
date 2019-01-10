<template>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card" style="border-radius:25px;">

                        <div class="card-body text-center m-5">
                            <img src="/images/resources/logo_base.svg" class="img-fluid p-3"/>
                            <h1 class="text-primary">Bienvenido</h1>

                            <form method="POST" class="align-middle form-group" @submit.prevent>
                                <input type="hidden" name="_token" :value="csrf">

                                <label class="alert alert-danger" id="errorMsg" style="display: none"></label>

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
                                                <input v-model="documento" id="document" type="document"
                                                       class="form-control" @keypress.enter="getCorreo()"
                                                       name="document" required autofocus>

                                                    <span class="invalid-feedback">
                                                        <strong></strong>
                                                    </span>

                                            </div>

                                            <div class="col-md-8 text-center mx-auto">
                                                <button type="button" class="btn btn-primary" @click="getCorreo()">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                            </div>

                                    </template>

                                    <template v-if="loginType === 'password'" >

                                            <h4 class="text-secondary mx-auto text-center col-8">{{ correo.name }}</h4>

                                            <h5 class="text-secondary mx-auto text-center col-8">Ingresa tu Contraseña</h5>

                                            <div class="form-group col-md-8 mx-auto">
                                                <input id="password2" type="password"
                                                           class="form-control" @keypress.enter="tryLogin()"
                                                           name="password2" v-model="password" required autofocus>

                                                    <span class="invalid-feedback">
                                                        <strong></strong>
                                                    </span>

                                            </div>

                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-primary btn-lg" @click="tryLogin()">Iniciar Sesión</button>
                                            </div>

                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-secondary" @click="loginChange()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
                                            </div>

                                            <div class="jumbotron border p-2 mt-5">
                                                <div class="container">
                                                    <h3>Olvidaste tu contraseña?</h3>
                                                    <p class="lead">En caso de no recordar la contraseña comunicate con alguien del personal de Talento Humano.</p>
                                                </div>
                                            </div>

                                    </template>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <pre>
                    <!-- {{$data}} -->
                    
                </pre>

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
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
            getDocumento: function() {
                axios
                  .get('/tiposDocumento')
                  .then(response => {
                    this.tipodocumento = response.data
                  })
                  .catch(error => {
                    console.log(error)
                    this.errored = true
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
                    console.log(error)
                    Swal({
                          position: 'top-end',
                          type: 'error',
                          title: 'No Existe el documento: '+ this.documento +' en nuestro sistema',
                          showConfirmButton: false,
                          timer: 2000
                        })
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
                    .catch(function (error) {
                        Swal({
                          position: 'top-end',
                          type: 'error',
                          title: 'Error acceso, Intente de nuevo',
                          showConfirmButton: false,
                          timer: 1500
                        })
                });


            }

        }
    }
</script>