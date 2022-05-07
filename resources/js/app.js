/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Vuetify from 'vuetify';
Vue.use(Vuetify);


// my import
import moment from "moment";
import VueProgressBar from "vue-progressbar";


// vform
import { HasError, AlertError } from "vform/src/components/bootstrap4";
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// my filters
Vue.filter("myDate", function(created) {
    return moment(created).format("MMMM Do YYYY");
});

Vue.filter("uptext", function(text) {
    return text.charAt(0).toUpperCase() + text.slice(1);
});

// progressbar
Vue.use(VueProgressBar, {
    color: "rgb(143, 255, 199)",
    failedColor: "red",
    height: "2px"
});

// SweetAlert
import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    // timerProgressBar: true,
    // didOpen: (toast) => {
    //   toast.addEventListener('mouseenter', Swal.stopTimer)
    //   toast.addEventListener('mouseleave', Swal.resumeTimer)
    // }
  });
window.Toast = Toast;

// global listener
window.Fire = new Vue();

// pagination
Vue.component("pagination", require("laravel-vue-pagination"));

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
import routes from './routes';

Vue.component('notifications-bar', require('./views/admin/NotificationsBar.vue').default);
Vue.component('notifications-bar-button', require('./views/collaborator/NotificationsBarButton.vue').default);
Vue.component('notifications-bar-provider', require('./views/collaborator/NotificationsBar.vue').default);
Vue.component('change-password', require('./views/collaborator/ChangePassword.vue').default);
Vue.component('change-password-admin', require('./views/admin/ChangePassword.vue').default);
Vue.component('notificationsButton-admin', require('./views/admin/NotificationButton.vue').default);
Vue.component('notifications-admin', require('./views/admin/Notifications.vue').default);
Vue.component('notifications-user', require('./views/collaborator/Notifications.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
  })


    var dt = new Date();
    var hr = dt.getHours();
    if ((21 <= hr && hr <= 23) || (0 <= hr && hr < 4)) {
        document.getElementById('welcome-text-night').style.display = 'block';
    }
    else if(16 <= hr && hr < 21) {
      document.getElementById('welcome-text-evening').style.display = 'block';

    }
    else if(13 <= hr && hr < 16) {
      document.getElementById('welcome-text-afternoon').style.display = 'block';

    }
    else if(4 <= hr && hr < 13) {
      document.getElementById('welcome-text-morning').style.display = 'block';

    }



const app = new Vue({
    el: '#app',
    router,
    vuetify: new Vuetify()
});
