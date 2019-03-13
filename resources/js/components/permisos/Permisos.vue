<template>
    <v-app>
        <v-layout wrap>
            <v-flex xs12 class="mb-1">
                <v-sheet height="500">
                    <v-calendar :now="today"
                    ref="calendar"
                    v-model="start"
                    type="month"
                    :weekdays=[1,2,3,4,5]
                    locale="es"
                    :short-weekdays="false"
                    color="primary"
                    class="elevation-23">
                        <template slot="day" slot-scope="{ date }">
                            <template v-for="event in eventsMap[date]">
                                <v-menu :key="event.title"
                                v-model="event.open"
                                full-width
                                offset-x>
                                    <div v-if="!event.time"
                                    slot="activator"
                                    v-ripple
                                    class="my-event"
                                    v-html="event.title"></div>
                                    <v-card color="grey lighten-4" min-width="350px" flat>
                                        <v-toolbar color="primary" dark>
                                            <v-btn icon><v-icon>edit</v-icon></v-btn>
                                            <v-toolbar-title v-html="event.title"></v-toolbar-title>
                                            <v-spacer></v-spacer>
                                            <!--  <v-btn icon><v-icon>favorite</v-icon></v-btn> -->
                                            <v-btn icon><v-icon>more_vert</v-icon></v-btn>
                                        </v-toolbar>
                                        <v-card-title primary-title>
                                            <span v-html="event.details"></span>
                                        </v-card-title>
                                        <v-card-actions>
                                            <v-btn flat color="secondary">Cerrar</v-btn>
                                        </v-card-actions>
                                    </v-card>
                                </v-menu>
                            </template>
                        </template>
                    </v-calendar>
                </v-sheet>
            </v-flex>
            
            <v-flex sm4 xs12 class="text-sm-left text-xs-center">
                <v-btn @click="$refs.calendar.prev()">
                    <v-icon dark left>keyboard_arrow_left</v-icon> Anterior
                </v-btn>
            </v-flex>


            <v-flex sm4 xs12 class="text-xs-center" >
                <v-dialog v-model="dialog" persistent max-width="800px">
                    <v-btn slot="activator" :large="true" color="primary" dark>Solicitar Permiso</v-btn>
                    <v-card>
                        <v-card-title class="elevation-8 p-0">
                                <v-bottom-nav
                                  :active.sync="bottomNav"
                                  :color="color"
                                  :value="true"
                                  dark
                                >
                                  <v-btn dark class="mx-auto">
                                    <span class="title">Solicitud de Permiso</span>
                                  </v-btn>

                                  <v-btn light class="mx-auto">
                                     <span class="title">Solicitud por Calamidad</span>
                                  </v-btn>

                                </v-bottom-nav>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>

                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="SOLICITADO POR" :value="name" :readonly="true" hint="Nombre del Solicitante" required></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="N° DOCUMENTO" :value="id"  :readonly="true" hint="Identificación del Solicitante"></v-text-field>
                                    </v-flex>

                                    <v-flex xs12 sm6 md4>
                                        <v-text-field label="FECHA DE ELABORACIÓN" :value="today"  :readonly="true" hint="Fecha actual"></v-text-field>
                                    </v-flex>

<v-flex xs12 sm6 md6>
        <v-dialog
          ref="menu3"
          v-model="menu3"
          :close-on-content-click="false"
          :return-value.sync="dates"
          transition="scale-transition"
          offset-y
          persistent
          lazy
          full-width
          width="290px"

        >
          <v-combobox
            slot="activator"
            v-model="dates"
            multiple
            chips
            small-chips
            label="fecha de permiso"
            prepend-icon="event"
          ></v-combobox>
          <v-date-picker v-model="dates" locale="es"
                                        :allowed-dates="allowedDates"
                                        :min="today" multiple scrollable>
            <v-spacer></v-spacer>
            <v-btn raised color="grey darken-2" dark @click="menu3 = false">Cancelar</v-btn>
            <v-btn outline raised color="green darken-2" @click="$refs.menu3.save(dates) ; testfunc()">OK</v-btn>
          </v-date-picker>
        </v-dialog>
      </v-flex>




                                    <v-flex xs11 sm6>
<template v-if="dates.length == 1">


                                        <v-menu
                                        ref="menu2"
                                        v-model="menu2"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="time"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                        >
                                            <v-text-field
                                            slot="activator"
                                            v-model="time"
                                            label="Hora Inicio"
                                            prepend-icon="access_time"
                                            :readonly="true"
                                            ></v-text-field>
                                            <v-time-picker
                                            v-if="menu2"
                                            v-model="time"
                                            :allowed-hours="allowedHours"
                                            :allowed-minutes="allowedMinutes"
                                            full-width
                                            @click:minute="$refs.menu2.save(time)"
                                            scrollable
                                                min="7:00"
                                                max="18:00"
                                            ></v-time-picker>
                                        </v-menu>


                                         <v-menu
                                        ref="menu4"
                                        v-model="menu4"
                                        :close-on-content-click="false"
                                        :nudge-right="40"
                                        :return-value.sync="time2"
                                        lazy
                                        transition="scale-transition"
                                        offset-y
                                        full-width
                                        max-width="290px"
                                        min-width="290px"
                                        >
                                            <v-text-field
                                            slot="activator"
                                            v-model="time2"
                                            label="Hora Final"
                                            prepend-icon="access_time"
                                            :readonly="true"
                                            ></v-text-field>
                                            <v-time-picker
                                            v-if="menu4"
                                            v-model="time2"
                                            :allowed-hours="allowedHours"
                                            :allowed-minutes="allowedMinutes"
                                            full-width
                                            @click:minute="$refs.menu4.save(time2)"
                                            scrollable
                                                :min="time"
                                                max="18:00"
                                            ></v-time-picker>
                                        </v-menu>

</template>
<template>
    </template>
                                    </v-flex>



                                <v-flex xs12 sm6 md4>
            <v-radio-group v-model="motivos" row>
                <v-radio color="info" label="Cita Médica" value="Cita Médica"></v-radio>
                <v-radio color="info" label="Enfermedad" value="Enfermedad"></v-radio>
            </v-radio-group>
          </v-flex>
          <v-flex xs12 sm6 md4>
            <v-radio-group v-model="motivos" row>
                <v-radio color="info" label="Asunto Familiar" value="Asunto Familiar"></v-radio>
                <v-radio color="info" label="Personal" value="Personal"></v-radio>
            </v-radio-group>
          </v-flex>

          <v-flex xs12 sm6 md4>
            <v-radio-group v-model="motivos">
                <v-radio color="info" label="Dia de Familia" value="Dia de Familia"></v-radio>
                <v-radio color="info" label="Otros" value="Otros"></v-radio>
            </v-radio-group>
          </v-flex>


<v-flex xs12>
        <v-textarea outline
          name="input-7-1"
          label="Descripción:"
          hint="Es obligatorio completar la descripción."
        ></v-textarea>
      </v-flex>

                                </v-layout>
                            </v-container>

                        </v-card-text>


<v-card-actions>
    <v-spacer></v-spacer>
    <v-btn color="blue darken-1" flat @click="dialog = false">CANCELAR</v-btn>
    <v-btn color="blue darken-1" flat @click="dialog = false">GENERAR PERMISO</v-btn>
</v-card-actions>


                    </v-card>
                </v-dialog>
            </v-flex>

            <v-flex sm4 xs12 class="text-sm-right text-xs-center">
                <v-btn @click="$refs.calendar.next()">
                    Siguiente <v-icon right dark>keyboard_arrow_right</v-icon>
                </v-btn>
            </v-flex>
        </v-layout>
    </v-app>
</template>


<script>
  import Vuetify from 'vuetify'
  export default {
    created(){
            this.days();
        },
    props: ['auth'],
    data() {
     return {
        motivos: 'Cita Médica',
        name: this.auth.name+' '+this.auth.last_name,
        id: this.auth.document,

        dates: [],

        menu3: false,
        menu4: false,

         bottomNav: 0,

        time: null,
        time2: null,
i: 0,
        menu2: false,
        modal2: false,

        oneDay: 24*60*60*1000,
        firstDate: new Date(),
        secondDate: new Date(2019,2,1),

        today: new Date().toISOString().substr(0, 10),
        todayday: new Date(2019, 1, 28).toISOString().substr(0, 10),

        res: new Date(2019, 2, 1),
        res2: null,

        dialog: false,

test: null,

        start: '',

        events: [
        {
          title: 'Vacation',
          details: 'Going to the beach!',
          date: '2018-12-30',
          open: false
        },
        {
          title: 'Vacation',
          details: 'Going to the beach!',
          date: '2018-12-31',
          open: false
        },
        {
          title: 'Vacation',
          details: 'Going to the beach!',
          date: '2019-01-01',
          open: false
        },
        {
          title: 'Meeting',
          details: 'Spending time on how we do not have enough time',
          date: '2019-01-07',
          open: false
        },
        {
          title: '30th Birthday',
          details: 'Celebrate responsibly',
          date: '2019-01-03',
          open: false
        },
        {
          title: 'New Year',
          details: 'Eat chocolate until you pass out',
          date: '2019-01-01',
          open: false
        },
        {
          title: 'Conference',
          details: 'Mute myself the whole time and wonder why I am on this call',
          date: '2019-02-18',
          open: false
        },
        {
          title: 'Hackathon',
          details: 'Code like there is no tommorrow',
          date: '2019-02-01',
          open: false
        }
      ]
      }
    },
    computed: {
      // convert the list of events into a map of lists keyed by date
      eventsMap () {
        const map = {}
        this.events.forEach(e => (map[e.date] = map[e.date] || []).push(e))
        return map
      },
            color () {
        switch (this.bottomNav) {
          case 0: return 'primary'
          case 1: return 'amber'
          case 2: return 'brown'
          case 3: return 'indigo'
        }
      }
    },
    methods: {
        days: function() {
            // this.res = Math.abs(this.today - this.todayday) / 1000;

            this.res = Math.abs((this.firstDate.getTime() - this.secondDate.getTime())/(this.oneDay));
            this.res2 = new Date;
            this.res2.setDate(this.res2.getDate() + 5);
            // this.res2 = (this.firstDate.getTime() - this.secondDate.getTime());
        },
        testfunc: function() {
            this.test = this.dates.length;

            for (this.i = 0; this.i < this.dates.length; this.i++) {
                this.test = this.test +1;
                if (i === 5) { break; }
            }
        },
      open (event) {
        alert(event.title)
      },
      allowedDates: val => ![5, 6].includes(new Date(val).getDay())
    },
  }
</script>

<style>
  .my-event {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    border-radius: 2px;
    background-color: #1867c0;
    color: #ffffff;
    border: 1px solid #1867c0;
    width: 100%;
    font-size: 12px;
    padding: 3px;
    cursor: pointer;
    margin-bottom: 1px;
  }
</style>

