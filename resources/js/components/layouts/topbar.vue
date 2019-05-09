<template>
  <v-toolbar fixed clipped-left app>
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
    <v-menu v-model="menu2" :close-on-content-click="false" :nudge-width="200" offset-y v-if="user.level > 900" :dark="dark">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" icon>
          <v-badge color="purple" overlap>
            <template v-slot:badge>
              <span>{{$parent.conectedUsers.length}}</span>
            </template>
            <v-icon color="grey lighten-1" large>
              account_circle
            </v-icon>
          </v-badge>
        </v-btn>
      </template>

      <v-card>
        <v-list>
          <v-list-tile>
            <v-list-tile-content>
              <v-list-tile-title>Usuarios Conectados</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list>

        <v-divider></v-divider>

        <v-list three-line>
          <template v-for="(item, index) in $parent.conectedUsers">
            <v-subheader v-if="item.header" :key="item.header">
              {{ item.header }}
            </v-subheader>

            <v-divider v-else-if="item.divider" :key="index" :inset="item.inset"></v-divider>

            <v-list-tile v-else :key="item.title" avatar @click="">
              <v-list-tile-avatar>
                 <img src="/images/avatar.png" alt="Vuetify" class="blue-gradient p-1">
              </v-list-tile-avatar>

              <v-list-tile-content>
                <v-list-tile-title v-html="item.name"></v-list-tile-title>
                <v-list-tile-sub-title v-html="item.email"></v-list-tile-sub-title>
              </v-list-tile-content>
            </v-list-tile>
          </template>
        </v-list>

        <v-divider></v-divider>

        <v-list>
          <v-list-tile>
            <v-list-tile-action>
              <v-switch v-model="dark" color="purple"></v-switch>
            </v-list-tile-action>
            <v-list-tile-title>modo nocturno</v-list-tile-title>
          </v-list-tile>
        </v-list>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn flat @click="menu2 = false">Cerrar</v-btn>
        </v-card-actions>
      </v-card>
    </v-menu>

    <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-y>
      <template v-slot:activator="{ on }">
        <v-btn icon large v-on="on">
          <v-avatar size="40px">
            <!-- <img v-if="user.employee.user_picture_url"
  :src="'/storage/EmployeeImages/tumb.'+user.employee.user_picture_url"
  alt="Vuetify"
  > -->
            <img src="/images/avatar.png" alt="Vuetify" class="blue-gradient p-1">
          </v-avatar>
        </v-btn>
      </template>

      <v-card>
        <v-list>
          <v-list-tile avatar>
            <v-list-tile-avatar>

              <img src="/images/avatar.png" alt="Vuetify" class="blue-gradient p-1">
            </v-list-tile-avatar>

            <v-list-tile-content>
              <v-list-tile-title>{{user.name}} {{user.last_name}}</v-list-tile-title>
              <v-list-tile-sub-title>{{user.email}}</v-list-tile-sub-title>
            </v-list-tile-content>

          </v-list-tile>
        </v-list>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn class="nav-link text-danger" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Cerrar Sesión</v-btn>

          <v-btn flat @click="menu = false">Cancelar</v-btn>
        </v-card-actions>
      </v-card>
    </v-menu>
  </v-toolbar>

</template>

<script>
  import Vuetify from 'vuetify'
  export default {
  	props: ['user'],
      data: () => ({
        dark: false,
         menu2: false,
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
    mounted() {
      },
    created() {
      this.$parent.user = this.user;     
    },
    methods: {

    },
    }
</script>

