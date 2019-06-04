<template>
    <v-layout row wrap>
        <v-flex xs12 sm12 text-xs-center mb-5>

            <gmap-map :center="center" :zoom="16" style="width:100%;  height: 500px;">
                <gmap-marker :key="index + '-marker'" v-for="(m, index) in markers" :labelClass="'gmap-marker'"
                    :title="m.title" :clickable="true" :position="m.position" @click="m.window = true"></gmap-marker>

                <gmap-info-window :key="index + '-window'" v-for="(m, index) in markers" :options="{maxWidth: 300}"
                    :position="m.position" :opened="m.window" @closeclick="m.window = false">
                    <div class="ctn-data-maps">
                        <span>Nombre:</span>
                        <span>{{ m.name }} {{ m.lastName }}</span>
                    </div>

                    <div class="ctn-data-maps">
                        <span>Documento:</span>
                        <span>{{m.document}}</span>
                    </div>

                    <div class="ctn-data-maps" v-bind:class="{'f-1': m.status == 1,  'f-2': m.status == 2}">
                        <span>Estado:</span>
                        <span>{{m.status == 1 ? 'Entrada' : 'Salida' }}</span>
                    </div>
                </gmap-info-window>


            </gmap-map>
        </v-flex>
        <v-flex xs12 sm4 md4>
            <v-menu ref="menuStartDate" v-model="menuStartDate" :close-on-content-click="true" :nudge-right="40" lazy
                transition="scale-transition" offset-y full-width min-width="290px">
                <template v-slot:activator="{ on }">
                    <v-text-field v-model="startDate" label="Selecciona la fecha de inicio" prepend-icon="event"
                        readonly v-on="on"></v-text-field>
                </template>
                <v-date-picker v-model="startDate" no-title scrollable :max="endDate">
                </v-date-picker>
            </v-menu>
        </v-flex>
        <v-flex xs12 sm4 md4>
            <v-menu ref="menuEndDate" v-model="menuEndDate" :close-on-content-click="false" :nudge-right="40"
                :return-value.sync="endDate" lazy transition="scale-transition" offset-y full-width min-width="290px">
                <template v-slot:activator="{ on }">
                    <v-text-field v-model="endDate" label="Selecciona la fecha final" prepend-icon="event" readonly
                        v-on="on"></v-text-field>
                </template>
                <v-date-picker v-model="endDate" no-title scrollable :min="startDate" :max="todayDate">
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="menuEndDate = false">Cancel</v-btn>
                    <v-btn flat color="primary" @click="$refs.menuEndDate.save(endDate)">OK</v-btn>
                </v-date-picker>
            </v-menu>
        </v-flex>
        <v-flex xs12 sm4 md4>
            <v-btn color="primary" dark @click="dialogFull = true">Filtrar Usuarios</v-btn>
        </v-flex>

        <v-dialog v-model="dialogFull" fullscreen hide-overlay transition="dialog-bottom-transition">
            <v-card>
                <v-toolbar dark color="primary">
                    <v-btn icon dark @click="dialogFull = false">
                        <v-icon>close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Filtro Usuarios</v-toolbar-title>
                    <v-spacer></v-spacer>
                    <v-toolbar-items>
                        <v-btn dark flat @click="dialogFull = false">Cerrar</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
                <v-card-title>
                    Seleccionar Usuarios
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="search" label="Buscar" single-line hide-details>
                    </v-text-field>
                </v-card-title>
                <v-data-table :rows-per-page-items="rows" v-model="selected" :headers="headers" :items="users"
                    :search="search" select-all class="elevation-1">
                    <template v-slot:items="props">
                        <td>
                            <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                        </td>
                        <td class="text-xs-left">{{ props.item.name }}</td>
                        <td class="text-xs-left">{{ props.item.last_name }}</td>
                        <td class="text-xs-left">{{ props.item.email }}</td>
                    </template>
                </v-data-table>
            </v-card>
        </v-dialog>

        <v-card class="w-100">
            <v-card-title>
                Seleccionar
                <v-spacer></v-spacer>
                <v-text-field v-model="search2" append-icon="search" label="Buscar" single-line hide-details>
                </v-text-field>
            </v-card-title>
            <v-data-table :rows-per-page-items="rows" v-model="selected2" :headers="headers2" :items="allPositions"
                :pagination.sync="pagination2" :search="search2" item-key="id" select-all class="elevation-1">
                <template v-slot:items="props">
                    <td>
                        <v-checkbox v-model="props.selected" primary hide-details></v-checkbox>
                    </td>
                    <td class="text-xs-left">{{ props.item.created_at }}</td>
                    <td class="text-xs-left">{{ props.item.user.name }} {{ props.item.user.last_name }}</td>
                    <td class="text-xs-left">{{ props.item.status == 1 ? 'llegada' : 'Salida' }}</td>
                    <td class="text-xs-left">{{ props.item.latitude }}</td>
                    <td class="text-xs-left">{{ props.item.longitude }}</td>
                </template>
            </v-data-table>
        </v-card>

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
        name: 'AdminMap',
        data() {
            return {
                search2: '',
                msg: '',
                dialogFull: false,
                notificationsFull: false,
                soundFull: true,
                widgetsFull: false,
                todayDate: new Date().toISOString().substr(0, 10),
                startDate: new Date().toISOString().substr(0, 10),
                endDate: new Date().toISOString().substr(0, 10),
                menuStartDate: false,
                menuEndDate: false,
                rows: [20, 30, 50, {
                    "text": "$vuetify.dataIterator.rowsPerPageAll",
                    "value": -1
                }],
                search: '',
                headers: [{
                        text: 'Nombre',
                        align: 'left',
                        value: 'name'
                    },
                    {
                        text: 'Apellido',
                        value: 'last_name'
                    },
                    {
                        text: 'Email',
                        value: 'email'
                    },
                ],
                pagination2: {
                    sortBy: 'created_at',
                    descending: true,
                },
                headers2: [{
                        text: 'Fecha',
                        value: 'created_at'
                    },
                    {
                        text: 'Usuario',
                        align: 'left',
                        value: 'user.name'
                    },
                    {
                        text: 'Estatus',
                        value: 'status'
                    },
                    {
                        text: 'Latitud',
                        value: 'latitude'
                    },
                    {
                        text: 'Longitud',
                        value: 'longitude'
                    },

                ],
                selected: [],
                selected2: [],
                users: [],
                center: {},
                position: {
                    position: null
                },
                infoWindow: {
                    position: {
                        lat: 0,
                        lng: 0
                    },
                    open: false,
                    template: ''
                },
                markers: [],
                btnstart: null,
                btnend: null,
                btnact: false,
                btnload: false,
                allPositions: [],
            };
        },
        created() {
            this.getMapGeo();
            this.getUsers2();
            this.getUsers();
        },
        mounted() {
            this.geolocate();
        },
        methods: {
            getUser2() {
                this.markers = [];
                for (let x = 0; x < this.selected2.length; x++) {
                    let obj = this.selected2[x];
                    this.markers.push({
                        name: obj.user.name,
                        lastName: obj.user.last_name,
                        document: obj.user.document,
                        user: obj.user_id,
                        date: obj.created_at,
                        window: true,
                        status: obj.status,
                        position: {
                            lat: parseFloat(obj.latitude),
                            lng: parseFloat(obj.longitude)
                        }
                    })
                }
            },
            getUser() {
                this.markers = [];
                for (let x = 0; x < this.selected.length; x++) {
                    let obj = this.selected[x];
                    for (let index = 0; index < obj.location.length; index++) {
                        let el = obj.location[index];
                        this.markers.push({
                            name: obj.name,
                            lastName: obj.last_name,
                            document: obj.document,
                            user: obj.id,
                            date: el.created_at,
                            window: true,
                            status: el.status,
                            position: {
                                lat: parseFloat(el.latitude),
                                lng: parseFloat(el.longitude)
                            }
                        })
                    }

                }
            },
            getUsers() {
                this.markers = [];
                axios
                    .get('/mapUsers')
                    .then(response => {
                        this.users = response.data
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            getUsers2() {
                this.markers = [];
                this.allPositions = [];
                axios
                    .get('/mapUsers/' + this.startDate + '/' + this.endDate)
                    .then(response => {
                        this.allPositions = response.data
                    })
                    .catch(function (error) {
                        console.log(error)
                    });
            },
            // receives a place object via the autocomplete component
            geolocate: function () {
                navigator.geolocation.getCurrentPosition(position => {
                    this.center = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude,
                        status: 1
                    };
                    this.position.position = this.center;
                    // this.markers = [this.position,];
                });
            },
            MapStart: function () {
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
            btnActualizar: function () {
                this.btnload = true;
                this.btnstart = {
                    disabled: false,
                    dark: true
                };
                setTimeout(() => (this.btnload = false,
                    this.btnact = false), 2000);
                this.Swal('Puedes Registrar otra entrada el dia de Hoy');
            },
            getMapGeo: function () {

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
                        } else if (response.data == 'null') {
                            this.btnstart = {
                                disabled: false,
                                dark: true
                            };
                            this.btnend = {
                                disabled: true,
                                dark: false
                            };
                        } else if (response.data == 'cierre') {
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
            Swal: function (texto) {
                Swal({
                    type: 'success',
                    title: texto,
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        },
        watch: {
            selected2: function () {
                this.getUser2()
            },
            startDate: function () {
                this.getUsers2()
            },
            endDate: function () {
                this.getUsers2()
            },
            selected() {
                console.log(this.selected)
            }

        },
    };
</script>

<style>

    .poi-info-window div, .poi-info-window a {
        color: #000000 !important; 
    }

    .gm-style .gm-style-iw-c {
        bottom: 0;
        top: 2rem;
        position: relative;
        overflow: initial;
        padding: 5px 0.5rem;
    }

    .gm-style .gm-style-iw-t::after {
        box-shadow: 0 2px 7px 1px rgba(0,0,0,0.3);
        height: 13px;
        width: 13px;
        top: 35%;
        z-index: -1;
    }

    .ctn-data-maps {
        align-items: center;
        color: #000000;
        display: flex;
        font-size: 15px;
        justify-content: space-between;
        line-height: 25px;
    }

    .ctn-data-maps span:last-child {
        font-size: 13px;
        font-weight: 500;
        text-transform: capitalize;
    }

    .gm-ui-hover-effect {
        background-color: #ffffff !important;
        right: -1.25rem !important;
        left: initial !important;
        bottom: 0 !important;
        top: -20px !important;
        border-radius: 50% 50% 50% 0%;
        width: 25px !important;
        height: 25px !important;
        box-shadow: 0 0 2px #000000;
        display: flex !important;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        opacity: 0.7;
    }

    .f-1,
    .f-2 {
        position: relative;
    }

    .f-1:before {
        background-color: #51e451;
    }

    .f-2:before {
        background-color: #ea4335;
    }

    .f-1:before,
    .f-2:before {
        content: '';
        position: absolute;
        top: 90%;
        left: 0;
        width: 100%;
        height: 2px;
        border-radius: 50%;
    }

</style>