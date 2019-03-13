<template>
    <v-layout row wrap>
        <v-flex xs12 md5 text-xs-center>
            <div>
                <v-btn @click="MapStart()"
                        v-if="btnstart != null"
                        :disabled="btnend"
                        :dark="btnstart"
                        large  color="blue">Guardar llegada</v-btn>
            </div>
        </v-flex>

        <v-flex xs12 md2 text-xs-center>
            <div>
                <v-btn @click="getMapGeo2()" dark fab color="yellow"><v-icon color="black">cached</v-icon></v-btn>
            </div>
        </v-flex>

        <v-flex xs12 md5 text-xs-center>
            <div>
                <v-btn @click="MapEnd()" 
                        v-if="btnend != null"
                        :disabled="btnstart"
                        :dark="btnend"
                        large color="red">Guardar Salida</v-btn>
            </div>
        </v-flex>
        <v-flex xs12 sm12 text-xs-center>
            Posicion actual:
            <br>
            Latitud: {{position.position.lat}} , Longitud: {{position.position.lng}} .
            <br>
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
            key: 'AIzaSyAS-tf280pHe2hnXH29cv0SnMMI-HoG5UE',
            libraries: "places" // necessary for places input
        }
    });
    export default {
        name: "GoogleMap",
        data() {
            return {
            // default to Montreal to keep it simple
            // change this to whatever makes sense
                center: { lat: 45.508, lng: -73.587 },
                position: {
                position: null
                },
                markers: [],
                places: [],
                currentPlace: {},
                positionStart: {},
                positionEnd: {},
                btnstart: null,
                btnend: null
            };
        },
        created() {
            this.getMapGeo2();
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
                    this.currentPlace = this.center;
                    this.markers = [this.position,];
                });
            },
            MapStart: function() {
                axios
                    .post('/map', this.currentPlace)
                    .then(response => {
                        this.getMapGeo2();
                        this.Swal('Se ha guardado tu hora de llegada.');
                    console.log(response)
                    })
                    .catch(function (error) {
                    console.log(error)
                    });
            },
            MapEnd: function() {
                axios
                    .post('/map', this.currentPlace)
                    .then(response => {
                        this.getMapGeo2();
                        this.Swal('Se ha guardado tu hora de llegada.');
                    console.log(response)
                    })
                    .catch(function (error) {
                    console.log(error)
                    });
            },
            getMapGeo: function() {
                axios
                    .get('/map/show')
                    .then(response => {
                    this.positionStart = response.data;
                    console.Log(response.data)
                    })
                    .catch(error => {
                    console.log(error)
                    })
            },
            getMapGeo2: function() {

                axios.get('/map/show')
                    .then(response => {
                        if (response.data != null) {
                            this.positionStart = response.data;
                            this.btnstart = false;
                            this.btnend = true;
                            this.currentPlace.status = 2;
                        } else { 
                            this.btnstart = true;
                            this.btnend = false; };
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