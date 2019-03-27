<template>
    <v-layout row wrap>
        <v-flex xs12 md6 text-xs-center>
            <div>
                <v-btn @click="MapStart()"
                        v-if="btnstart != null"
                        :disabled="btnstart.disabled"
                        :dark="btnstart.dark"
                        large  color="blue">Guardar llegada</v-btn>
            </div>
        </v-flex>

<!--         <v-flex xs12 md2 text-xs-center>
            <div>
                <v-btn @click="getMapGeo()" dark fab color="yellow"><v-icon color="black">cached</v-icon></v-btn>
            </div>
        </v-flex> -->

        <v-flex xs12 md6 text-xs-center>
            <div>
                <v-btn @click="MapStart()" 
                        v-if="btnend != null"
                        :disabled="btnend.disabled"
                        :dark="btnend.dark"
                        large color="red">Guardar Salida</v-btn>
            </div>
        </v-flex>
        <v-btn v-if="btnact" :disabled="btnload" @click="btnActualizar()" class="mx-auto mt-3" :loading="btnload" large color="amber darken-3" :dark="!btnload">Registrar Otra Entrada este mismo dia
  </v-btn>
        <v-flex xs12 sm12 text-xs-center my-5 >
<!--             Posicion actual:
            <br>
            Latitud: {{position.position.lat}} , Longitud: {{position.position.lng}} .
            <br> -->
                <gmap-map
                :center="center"
                :zoom="16"
                style="width:100%;  height: 500px;"
                >
                    <gmap-marker
                    :key="index"
                    v-for="(m, index) in markers"
                    :position="m.position"
                    @click="center=m.position"
                    ></gmap-marker>
                </gmap-map>
        </v-flex>
    </v-layout>
</template>

<script>
    import * as VueGoogleMaps from "vue2-google-maps";
    import Swal from "sweetalert2"

    Vue.use(VueGoogleMaps, {
        load: {
            key: 'AIzaSyCoJPXuQpiIBxK6gq3OSF_OrSqgEPAUkI4',
            libraries: "places" // necessary for places input
        }
    });
    export default {
        name: "GoogleMap",
        data() {
            return {
            // default to Montreal to keep it simple
            // change this to whatever makes sense
                center: {},
                position: {
                    position: null
                },
                markers: [],
                btnstart: null,
                btnend: null,
                btnact: false,
                btnload: false
            };
        },
        created() {
            this.getMapGeo();
        },
        mounted() {
            this.geolocate();
        },
        methods: {
            // receives a place object via the autocomplete component
            geolocate: function() {
                navigator.geolocation.getCurrentPosition(position => {
                    this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                        status: 1
                    };
                    this.position.position = this.center;
                    this.markers = [this.position,];
                });
            },
            MapStart: function() {
                axios
                    .post('/map', this.center)
                    .then(response => {
                        this.getMapGeo();
                        if (this.center.status == 1) { 
                            this.Swal('Se ha guardado tu hora de Llegada.');
                        } else if (this.center.status == 2) {
                            this.Swal('Se ha guardado tu hora de Salida.');
                        }
                    console.log(response)
                    })
                    .catch(function (error) {
                    console.log(error)
                    });
            },
            btnActualizar: function() {
                this.btnload = true;
                this.btnstart = {
                    disabled: false,
                    dark: true
                };
                setTimeout(() => (this.btnload = false,
                    this.btnact = false), 2000);
                this.Swal('Puedes Registrar otra entrada el dia de Hoy');
            },
            getMapGeo: function() {

                axios.get('/map/show')
                    .then(response => {
                        if (response.data != 'null' && response.data != 'cierre') {
                            this.btnstart = {
                                disabled: true,
                                dark: false
                            };
                            this.btnend = {
                                disabled: false,
                                dark: true
                            };
                            this.center.status = 2;
                        } else if(response.data == 'null') {
                            this.btnstart = {
                                disabled: false,
                                dark: true
                            };
                            this.btnend = {
                                disabled: true,
                                dark: false
                            }; 
                        } else if(response.data == 'cierre') {
                            this.btnstart = {
                                disabled: true,
                                dark: false
                            };
                            this.btnend = {
                                disabled: true,
                                dark: false
                            };
                            this.btnact = true;
                            this.center.status = 1;
                        };
                        console.log(response.data);
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            },
            Swal: function(texto) {
                Swal({
                          type: 'success',
                          title: texto,
                          showConfirmButton: false,
                          timer: 2000
                        })
            }
        }
    };
</script>