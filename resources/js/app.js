
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('login-user', require('./components/auth/loginUser.vue').default);
Vue.component('reset-pass', require('./components/auth/resetPass.vue').default);

Vue.component('l-leftpanel', require('./components/layouts/leftpanel.vue').default);
Vue.component('l-topbar', require('./components/layouts/topbar.vue').default);

Vue.component('vue-permisos', require('./components/permisos/Permisos.vue').default);

Vue.component('laboral-edit-user', require('./components/LaboralEditUser.vue').default);
Vue.component('create-user', require('./components/CreateUser.vue').default);
Vue.component('personal-edit-user', require('./components/personalEditUser.vue').default);
Vue.component('perfil-edit-user', require('./components/perfilEditUser.vue').default);

Vue.component('geo-map', require('./components/geolocalizador/Map.vue').default);
Vue.component('geo-map-admin', require('./components/geolocalizador/MapAdmin.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data() {
    	return {
				drawer: true,
				conectedUsers: [],
				user: null
    	}
		},
		mounted() {
			
			this.join();
		},
		methods: {
			join: function() {
				Echo.join('joinRoom')
        .here((users) => {
					if (this.user.level > 900) {
						this.conectedUsers = users;
					}
            // console.log(users);
        })
        .joining((user) => {
					if (this.user.level > 900) {
					this.conectedUsers.push(user) }
            // console.log(user.name);
        })
        .leaving((user) => {
					if (this.user.level > 900) {
					let i = this.conectedUsers.map(item => item.id).indexOf(user.id) // find index of your object
					this.conectedUsers.splice(i, 1) }
            // console.log(user.name);
        });
      }
		},
});


