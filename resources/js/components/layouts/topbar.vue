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
      <v-btn icon>
        <v-icon>apps</v-icon>
      </v-btn>
      <v-btn icon>
        <v-icon>notifications</v-icon>
      </v-btn>
      <v-btn icon large>
        <v-avatar size="40px">
          <img v-if="user.employee.user_picture_url"
            :src="'/storage/EmployeeImages/tumb.'+user.employee.user_picture_url"
            alt="Vuetify"
          >

          <img
          v-else
            src="/images/avatar.png"
            alt="Vuetify"
            class="blue-gradient p-1"
          >

        </v-avatar>
      </v-btn>
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