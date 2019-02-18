<template>
  <div>
    <button @click="MapGeo()">Add</button>
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
  </div>
</template>

<script>
import * as VueGoogleMaps from "vue2-google-maps";
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
      currentPlace: null
    };
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
          lng: position.coords.longitude
        };
        this.position.position = this.center;
        this.currentPlace = this.center;
        this.markers = [this.position,];
        this.MapGeo();
      });
    },

    MapGeo: function() {
                axios
                  .post('/map', this.currentPlace)
                      .then(response => {
                        console.log(response);
                      })
                      .catch(function (error) {
                        console.log(error);
                      });
            }

  }
};
</script>