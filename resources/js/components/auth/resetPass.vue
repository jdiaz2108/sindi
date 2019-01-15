<template>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-10 col-12">
                    <div class="card shadow" style="border-radius:25px;">
                        <div class="card-body text-center m-5">
                            <img src="/images/resources/logo_base.svg" class="img-fluid p-3"/>
                            <h3 class="text-primary">Reestablece tu contraseña</h3>

                            <form method="POST" class="align-middle form-group" @submit.prevent>
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="row">
                                    <template v-if="loginType === 'id'">

                                            <h5 class="text-secondary mx-auto text-center col-8 py-3">Ingresa tu identificación</h5>

                                            <div class="form-group" id="logEmail"></div>

            
                                            <div class="form-group col-md-8 mx-auto">
                                                <input v-model="documento" name="document" type="text" class="form-control" @keypress.enter="getCorreo()" required ref="document">
                                            </div>

                                            <div class="col-md-8 text-center mx-auto py-3">
                                                <button type="button" class="btn btn-primary" @click="getCorreo()">Siguiente <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                            </div>

                                    </template>

                                    <template v-if="loginType === 'password'">

                                       <!--      ({{setFocus()}}) -->
                                            <h4 class="text-secondary mx-auto text-center col-8">{{ correo.name }}</h4>

                                            <h5 class="text-secondary mx-auto text-center col-8">Ingresa tu nueva Contraseña</h5>


                                            <div class="form-group col-md-8 mx-auto">
                                                <input name="password" id="password" type="password" class="form-control" v-model="password" required autofocus>
                                            </div>

                                            <h5 class="text-secondary mx-auto text-center col-8">Confirma tu nueva Contraseña</h5>


                                            <div class="form-group col-md-8 mx-auto">
                                                <input  id="password-confirm" name="password_confirmation" type="password" class="form-control" @keypress.enter="tryReset()" v-model="password_confirm" required>
                                            </div>


                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-primary btn-lg" @click="tryReset()">Reestablecer Contraseña</button>
                                            </div>

                                            <div class="col-md-8 text-center mx-auto my-3">
                                                <button type="button" class="btn btn-secondary" @click="loginChange()"><i class="fa fa-arrow-left" aria-hidden="true"></i> Atras</button>
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
        mounted(){
            this.setFocus();
            this.getToken();
        },
        data(){
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                pathArray: window.location.pathname.split('/').slice(-1),
                errors: {
                    errors: {
                        email: [],
                        password: []
                    },
                },
                selected: 1,
                documento: null,
                correo: {
                    name: 'nombre',
                    email: null
                },
                loginType: 'id',
                password: null,
                password_confirm: null,
                token: null,
            }
        },
        methods: {
            getToken: function(){
                this.token = this.pathArray[0]
            },
            setFocus: function()
            {
              this.$refs.document.focus();
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
            tryReset: function() {
                axios.post('/password/reset', {
                    csrf: this.csrf,
                    token: this.token,
                    email: this.correo.email,
                    password: this.password,
                    password_confirmation: this.password_confirm,
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