<template>
    <v-navigation-drawer fixed clipped v-model="$parent.drawer" app>
        <v-list dense>
            <v-list-tile avatar tag="div" v-if="$vuetify.breakpoint.mdAndDown">
                <v-toolbar-side-icon @click.stop="$parent.drawer = !$parent.drawer"></v-toolbar-side-icon>
                <v-list-tile-content>
                    <img src="/images/logo100.png">
                </v-list-tile-content>
            </v-list-tile>
            <v-divider v-if="$vuetify.breakpoint.mdAndDown"></v-divider>

            <v-subheader class="mt-3 grey--text text--darken-1">GESTION USUARIOS</v-subheader>

            <v-list-tile href="/">
                <v-list-tile-action>
                    <v-icon>home</v-icon>
                </v-list-tile-action>
                <v-list-tile-title>Inicio</v-list-tile-title>
            </v-list-tile>

        </v-list>


        <v-list dense>
            <v-list-group
            v-for="item in items"
            :key="item.title"
            v-model="item.active"
            :prepend-icon="item.action"
            no-action
            >
            <template v-slot:activator>
                <v-list-tile>
                    <v-list-tile-title>{{ item.title }}</v-list-tile-title>
                </v-list-tile>
            </template>

            <v-list-tile
            v-for="subItem in item.items" :key="subItem.title" @click="" :href="subItem.action">
                <v-list-tile-title>{{ subItem.title }}</v-list-tile-title>

                <v-list-tile-action>
                    <v-icon light>{{ item.action }}</v-icon>
                </v-list-tile-action>
            </v-list-tile>

            </v-list-group>

            <v-list-tile class="mt-3" @click="">
                <v-list-tile-action>
                    <v-icon color="grey darken-1">add_circle_outline</v-icon>
                </v-list-tile-action>
                <v-list-tile-title class="grey--text text--darken-1">Browse Channels</v-list-tile-title>
            </v-list-tile>
            <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon color="grey darken-1">settings</v-icon>
                </v-list-tile-action>
                <v-list-tile-title class="grey--text text--darken-1">Manage Subscriptions</v-list-tile-title>
            </v-list-tile>

        </v-list>
    </v-navigation-drawer>

</template>

<script>
  import Vuetify from 'vuetify'
  export default {
    props: ['user'],
      data: () => ({
        items: [
          {
            action: 'account_circle',
            title: 'Usuarios',
            active: true,
            items: [
              { title: 'Listar Usuarios',
                action: '/U' },
                { title: 'Crear Usuario',
                action: '/U/create' }
            ]
          },
          {
            action: 'beenhere',
            title: 'Paz y Salvo',
            items: [
              { title: 'Estado',
              action: '/pysEstado' },
              { title: 'Procesos Activos',
              action: '/pys' }
            ]
          },
          {
            action: 'accessibility',
            title: 'Persmisos',
            items: [
              { title: 'Solicitud Permiso',
              action: '/permisos' }
            ]
          },
          {
            action: 'directions_run',
            title: 'Family',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'alarm_add',
            title: 'Health',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'content_cut',
            title: 'Office',
            items: [
              { title: 'List Item' }
            ]
          },
          {
            action: 'local_offer',
            title: 'Promotions',
            items: [
              { title: 'List Item' }
            ]
          }
        ],
    }),
    }
</script>