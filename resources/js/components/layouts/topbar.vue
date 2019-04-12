<template>


	<v-toolbar
     
      fixed
      clipped-left
      app
    >
      <v-toolbar-side-icon @click.stop="$parent.drawer = !$parent.drawer"></v-toolbar-side-icon>
      <v-img src="/images/logo100.png" alt="Logo" max-height="46.5" max-width="145" :aspect-ratio="19/8"></v-img>
      <v-spacer></v-spacer>
<!--       <v-text-field
      v-if="$vuetify.breakpoint.mdAndDown"
      height="40"

        flat
        solo-inverted
        prepend-icon="search"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field> -->
      <v-spacer></v-spacer>
      <!-- <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn> -->
      <v-menu
      v-model="menu"
      :close-on-content-click="false"
      :nudge-width="200"
      offset-y
    >
      <template v-slot:activator="{ on }">
        <v-btn icon large v-on="on">
        <v-avatar size="40px">
          <!-- <img v-if="user.employee.user_picture_url"
            :src="'/storage/EmployeeImages/tumb.'+user.employee.user_picture_url"
            alt="Vuetify"
          > -->
          <img
            src="/images/avatar.png"
            alt="Vuetify"
            class="blue-gradient p-1"
          >
        </v-avatar>
      </v-btn>
      </template>

      <v-card>
        <v-list>
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <!-- <img v-if="user.employee.user_picture_url"
            :src="'/storage/EmployeeImages/tumb.'+user.employee.user_picture_url"
            alt="Vuetify"
          > -->

          <img

            src="/images/avatar.png"
            alt="Vuetify"
            class="blue-gradient p-1"
          >
            </v-list-tile-avatar>

            <v-list-tile-content>
              <v-list-tile-title>{{user.name}} {{user.last_name}}</v-list-tile-title>
              <v-list-tile-sub-title>{{user.email}}</v-list-tile-sub-title>
            </v-list-tile-content>

            <!-- <v-list-tile-action>
              <v-btn
                :class="fav ? 'red--text' : ''"
                icon
                @click="fav = !fav"
              >
                <v-icon>favorite</v-icon>
              </v-btn>
            </v-list-tile-action> -->
          </v-list-tile>
        </v-list>

        <v-divider></v-divider>

        <!-- <v-list>
          <v-list-tile>
            <v-list-tile-action>
              <v-switch v-model="message" color="purple"></v-switch>
            </v-list-tile-action>
            <v-list-tile-title>Enable messages</v-list-tile-title>
          </v-list-tile>

          <v-list-tile>
            <v-list-tile-action>
              <v-switch v-model="hints" color="purple"></v-switch>
            </v-list-tile-action>
            <v-list-tile-title>Enable hints</v-list-tile-title>
          </v-list-tile>
        </v-list> -->

        <v-card-actions>
          <v-spacer></v-spacer>


          <v-btn class="nav-link text-danger" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Cerrar Sesión</v-btn>

          <v-btn flat @click="menu = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-menu>
    </v-toolbar>


<!-- <v-toolbar
      color="blue darken-3"
      dark
      app
      :clipped-left="$vuetify.breakpoint.mdAndUp"
      fixed
    >
      <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <span class="hidden-sm-and-down">Google Contacts</span>
      </v-toolbar-title>
      <v-text-field
        flat
        solo-inverted
        prepend-icon="search"
        label="Search"
        class="hidden-sm-and-down"
      ></v-text-field>
      <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-avatar size="32px" tile>
          <img
            src="https://vuetifyjs.com/static/doc-images/logo.svg"
            alt="Vuetify"
          >
        </v-avatar>
      </v-btn>
    </v-toolbar>
 -->



</template>

<script>
  import Vuetify from 'vuetify'
  export default {
  	props: ['user'],
      data: () => ({
               fav: true,
      menu: false,
      message: false,
      hints: true,
      items: [
        { icon: 'trending_up', text: 'Most Popular' },
        { icon: 'subscriptions', text: 'Subscriptions' },
        { icon: 'history', text: 'History' },
        { icon: 'featured_play_list', text: 'Playlists' },
        { icon: 'watch_later', text: 'Watch Later' }
      ],
      items2: [
        { picture: 28, text: 'Joseph' },
        { picture: 38, text: 'Apple' },
        { picture: 48, text: 'Xbox Ahoy' },
        { picture: 58, text: 'Nokia' },
        { picture: 78, text: 'MKBHD' }
      ]
    }),
    }
</script>

