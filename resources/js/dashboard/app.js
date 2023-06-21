require('../bootstrap');

import Vue from 'vue'
import vuetify from './plugins/vuetify'
import VueMask from 'v-mask'
import VeeValidate from 'vee-validate';
import Croppa from 'vue-croppa';
import store from './store/index';

import DashboardApp from '../layouts/DashboardApp.vue';
import Profile from "./views/profile/Profile";
import Orders from "./views/orders/Orders";
import Trips from "./views/trips/Trips";

if (process.env.MIX_APP_ENV === 'production') {
    Vue.config.devtools = false;
    Vue.config.debug = false;
    Vue.config.silent = true;
}

axios.interceptors.response.use(function (response) {
    return response
}, function (error) {
    if (error.response.status === 419) {
        window.location.reload();
    }
    return Promise.reject(error)
})

const csrf = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');
Vue.prototype.$csrf = csrf;

Vue.use(VeeValidate);
Vue.use(VueMask);
Vue.use(Croppa);

Vue.component('DashboardApp', DashboardApp);
Vue.component('profile', Profile);
Vue.component('orders', Orders);
Vue.component('trips', Trips);

let theme = localStorage.getItem('theme');
theme = theme? JSON.parse(theme): null
store.commit('dark', theme? theme.dark: false);

const app = new Vue({ vuetify, store}).$mount('#app')
